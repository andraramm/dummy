<?php

namespace App\Controllers;

use App\Libraries\Simple_html_dom;
use App\Models\FileModel;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '-1');

class Scraper extends BaseController
{
    protected $fileModel;
    public function __construct()
    {
        $this->fileModel = new FileModel();
    }

    public function index()
    {
        // https://scraper.my.id/scraper?situs=maxpreps&kelamin=boys&olahraga=baseball&url=https://www.maxpreps.com/baseball/scores/
        $kelamin = $_GET['kelamin'];
        $olahraga = $_GET['olahraga'];
        $situs = $_GET['situs'];
        $url = $_GET['url'];

        // get halaman list state
        $html_root = new Simple_html_dom();
        $html_root->load_file($url);

        // echo $html_root;
        $list_state = $html_root->find('.states-list a');

        foreach ($list_state as $ls) {
            // buka spesifik state
            $html = new Simple_html_dom();
            
            $header = @file_get_contents("https://www.maxpreps.com" . $ls->href);

            if (!$header) {
                continue;
            }
            
            $html->load($header);

            // nama state
            $state = $ls->plaintext;

            $lanjut = 0;

            do {
                date_default_timezone_set('America/Los_Angeles');
                // slash (/) amerika format m/d/y
                // strip (-) europe format d/m/y
                $getDateTeks = explode("&", explode("date=", $html->find('a[class="btn btn-default active"]', 0)->href)[1])[0]; // 6/5/2022
                $dateTeks = date_format(date_create($getDateTeks), "l, F d"); // Sunday, June 05
                $dateName = date_format(date_create($dateTeks), 'd-m-Y'); // 05-06-2022
                $dateFile = str_replace('-', '', $dateName); // 05062022

                $unixMax = strtotime($dateName);
                $unixNow = strtotime(date('d-m-Y')); // jam amerika, format 05-06-2022

                // scrape jika tanggal belum berlalu / hari ini
                if ($unixMax < $unixNow || strlen($dateName) < 5) {
                    // echo 'sudah berlalu';
                    continue;
                }

                // filename 
                $csv = "[$situs] $kelamin-$olahraga-$state-$dateFile.csv";
                // total game
                $igame = 0;

                $list_game = $html->find('.contest-sets .contest-box-item');
                $file = fopen($csv, "w");

                // start write csv
                foreach ($list_game as $l) {

                    if (!$l->find('.teams')) {
                        continue;
                    }

                    $tim1 = ($l->find('.teams .name', 0)) ? str_replace('&#39;', "'", htmlspecialchars_decode($l->find('.teams .name', 0)->plaintext)) : 'unknown';
                    $tim2 = ($l->find('.teams .name', 1)) ? str_replace('&#39;', "'", htmlspecialchars_decode($l->find('.teams .name', 1)->plaintext)) : 'unknown';

                    if ($tim1 == 'TBA' || $tim2 == 'TBA') {
                        continue;
                    }

                    $getJam = ($l->find('.details', 0)) ? (preg_match('/\d/', $l->find('.details', 0)->plaintext)) ? $l->find('.details', 0)->plaintext : false : false;
                    $jam = ($getJam) ? ' @ ' . $getJam . '.' : '.';

                    $deskripsi = "The $tim2 varsity $olahraga team has a game vs. $tim1 on $dateTeks" . $jam;

                    $match = [
                        $tim1,
                        $tim2,
                        $deskripsi,
                    ];
                    fputcsv($file, $match);
                    $igame++;
                }

                // end write csv
                fclose($file);

                if ($igame == 0) {
                    // delete
                    unlink($csv);
                } else {
                    // move csv
                    rename($csv, "csv/$olahraga/$csv");

                    if ($igame < 5) {
                        $harga = $igame;
                    } elseif ($igame < 11) {
                        $harga = 10;
                    } elseif ($igame < 101) {
                        $harga = 100;
                    } elseif ($igame < 201) {
                        $harga = 200;
                    } elseif ($igame > 200) {
                        $harga = 500;
                    } else {
                        $harga = 0;
                    }

                    date_default_timezone_set('Asia/Jakarta');

                    // cek file sudah ada di db atau belum
                    if ($db = $this->fileModel->where('nama', $csv)->first()) {
                        $status = ($igame == $db['total_game']) ? 'lama' : 'update';
                        $data = [
                            'id' => $db['id'],
                            'total_game' => $igame,
                            'harga' => $harga,
                            'status' => $status,
                        ];
                        
                        if($status == 'update'){
                            $data['tanggal'] = date("Y-m-d H:i:s");
                        }
                    } else {
                        $data = [
                            'nama' => $csv,
                            'total_game' => $igame,
                            'kelamin' => $kelamin,
                            'olahraga' => $olahraga,
                            'state' => $state,
                            'situs' => $situs,
                            'harga' => $harga,
                            'status' => 'baru',
                            'tanggal_game' => date_format(date_create($dateTeks), 'Y-m-d H:i:s'),
                            'tanggal' => date("Y-m-d H:i:s"),
                        ];
                    }

                    // save to db
                    $this->fileModel->save($data);
                }

                $lanjut++;

                // cek next day
                $week = $html->find('.week li a');
                $active = $html->find('.week li a', count($week) - 1)->class;

                // selama bukan terkahir, lanjut ke tanggal berikutnya
                if (strpos($active, 'active') == true) {
                    $next = false;
                } else {
                    $next = true;
                    $next_date = $html->find('.week li a', count($week) - 1)->href;
                    $file_get = @file_get_contents("https://www.maxpreps.com" . $next_date);
                    if(!$file_get){
                        $lanjut++;
                    } else {
                        $html = new Simple_html_dom();
                        $html->load($file_get);
                    }
                }

                if ($lanjut > 3) {
                    $next = false;
                }
            } while ($next);
        }
        
        echo 'done';
    }

    public function proxy()
    {
        $url = $_GET['url'];
        
        $file = @file_get_contents(urldecode($url));
        if(!$file){
            return false;
        } else {
            return $file;
        }
    }
    public function post_scraper()
    {
        $kelamin = $_GET['kelamin'];
        $olahraga = $_GET['olahraga'];
        $situs = $_GET['situs'];
        $url = $_GET['url'];
        $state = $_GET['state'];
        $total_game = $_GET['total_game'];
        $tanggal_game = $_GET['tanggal_game'];

        // domain/tes?kelamin=boys&olahraga=football&situs=maxpreps&url=loalhost/file.csv&state=alabama&total_game=100&tanggal_game=Sunday, June 05

        // Use basename() function to return the base name of file
        $file_name = basename($url);

        // Use file_get_contents() function to get the file
        // from url and use file_put_contents() function to
        // save the file by using base name
        if (file_put_contents("csv/$olahraga/$file_name", file_get_contents(str_replace(" ", "%20", $url)))) {
            // echo "File downloaded successfully";
        } else {
            // echo "File downloading failed.";
            return false;
        }

        if (!file_exists("csv/$olahraga/$file_name")) {
            return false;
        }

        if ($total_game < 10) {
            $harga = $total_game;
        } elseif ($total_game < 101) {
            $harga = 100;
        } elseif ($total_game < 201) {
            $harga = 200;
        } elseif ($total_game > 200) {
            $harga = 500;
        } else {
            $harga = 0;
        }

        date_default_timezone_set('Asia/Jakarta');

        // cek file sudah ada di db atau belum
        if ($db = $this->fileModel->where('nama', $file_name)->first()) {
            $status = ($total_game == $db['total_game']) ? 'lama' : 'update';
            $data = [
                'id' => $db['id'],
                'total_game' => $total_game,
                'harga' => $harga,
                'status' => $status,
            ];

            if ($status == 'update') {
                $data['tanggal'] = date("Y-m-d H:i:s");
            }
        } else {
            $data = [
                'nama' => $file_name,
                'total_game' => $total_game,
                'kelamin' => $kelamin,
                'olahraga' => $olahraga,
                'state' => $state,
                'situs' => $situs,
                'harga' => $harga,
                'status' => 'baru',
                'tanggal_game' => date_format(date_create($tanggal_game), 'Y-m-d H:i:s'),
                'tanggal' => date("Y-m-d H:i:s"),
            ];
        }

        $this->fileModel->save($data);
    }
    public function tes(){
        $file_name = 'tes.csv';
        $url = 'http://103.146.202.238/dl/Layanan 1 - KodeOTP.html';
        file_put_contents("csv/$file_name", file_get_contents(str_replace(" ", "%20", $url)));
    }
}
