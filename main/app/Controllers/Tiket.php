<?php

namespace App\Controllers;

use App\Models\TiketModel;
use App\Models\IsiTiketModel;

date_default_timezone_set('Asia/Jakarta');

class Tiket extends BaseController
{

    protected $tiketModel;
    protected $isitiketModel;
    public function __construct()
    {
        $this->isitiketModel = new IsiTiketModel();
        $this->tiketModel = new TiketModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Tiket | Scraper',
            'title_meta' => view('partials/title-meta', ['title' => 'Tiket']),
            'page_title' => view('partials/page-title', ['title' => 'Tiket', 'li_1' => 'Home', 'li_2' => 'Tiket'])
        ];
        return view('/tiket/index', $data);
    }
    public function create()
    {
        // cek apakah user memiliki tiket yang belum close
        $user = user_id();
        if (in_groups('user')) {
            if ($this->tiketModel->where("status='open' AND pengirim='$user'")->find()) {
                $hasil['error'] = true;
                $hasil['teks'] = 'Saat ini kamu masih memiliki tiket dengan status open.';
                return json_encode($hasil);
            }
        }

        $subject = $this->request->getVar('subject');
        $pesan = $this->request->getVar('pesan');

        $dataTiket = [
            'pengirim' => user_id(),
            'penerima' => (in_groups('admin')) ? $this->request->getVar('penerima') : 1,
            'subject' => htmlentities($subject),
            'tanggal' => date("Y-m-d H:i:s"),
            'status' => 'open',
        ];

        if (!$this->tiketModel->save($dataTiket)) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Coba ulangi lagi.';
            return json_encode($hasil);
        }

        $dataIsiTiket = [
            'tiket_id' => $this->tiketModel->getInsertID(),
            'pengirim' => user_id(),
            'pesan' => htmlentities($pesan),
            'tanggal' => date("Y-m-d H:i:s"),
        ];

        if (!$this->isitiketModel->save($dataIsiTiket)) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Coba ulangi lagi.';
            return json_encode($hasil);
        }

        $hasil['error'] = false;

        return json_encode($hasil);
    }
    public function close($id)
    {
        // cek apakah tiket punya user
        $tiket = $this->tiketModel->getTiket($id);
        if (in_groups('user')) {
            if ($tiket['pengirim'] != user_id()) {
                $hasil['error'] = true;
                $hasil['teks'] = 'Tiket ini tidak bisa ditutup';
                return json_encode($hasil);
            }
        }

        $data = [
            'id' => $id,
            'status' => 'close',
        ];

        if ($this->tiketModel->save($data)) {
            $hasil['error'] = false;
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Gagal, silahkan coba lagi.';
        }

        return json_encode($hasil);
    }
    public function sendIsiTiket($id)
    {
        $tiket = $this->tiketModel->getTiket($id);
        if (in_groups('user')) {
            if ($tiket['pengirim'] != user_id() && $tiket['penerima'] != user_id()) {
                $hasil['error'] = true;
                return json_encode($hasil);
            }
        }

        // cek tiket close atau tidak
        if ($tiket['status'] == 'close') {
            $hasil['error'] = true;
            return json_encode($hasil);
        }

        $pesan = $this->request->getVar('isiTiket');
        $tanggal = date("Y-m-d H:i:s");

        $isiTiket = [
            'tiket_id' => $id,
            'pengirim' => user_id(),
            'pesan' => htmlentities($pesan),
            'tanggal' => $tanggal,
        ];

        if ($this->isitiketModel->save($isiTiket)) {
            $hasil['error'] = false;
            $hasil['tiket'] = $this->isitiketModel->where('tiket_id', $id)->find();
            $hasil['user'] = user_id();
        } else {
            $hasil['error'] = true;
        }
        return json_encode($hasil);
    }
    public function ambilTiket($id)
    {
        $tiket = $this->tiketModel->getTiket($id);
        if (in_groups('user')) {
            if ($tiket['pengirim'] != user_id() && $tiket['penerima'] != user_id()) {
                $hasil['error'] = true;
                $hasil['teks'] = 'Tiket tidak ditemukan!';
                return json_encode($hasil);
            }

            $hasil['role'] = true;
        }

        $hasil['tiket'] = $this->isitiketModel->where('tiket_id', $id)->find();
        $hasil['user'] = user_id();

        // cek tiket close atau tidak
        if ($tiket['status'] == 'open') {
            $hasil['status'] = true;
        }

        return json_encode($hasil);
    }
    public function tabel_tiket()
    {
        $columns = [
            0 => 'tiket.id',
            1 => 'users.username',
            2 => 'tiket.subject',
            3 => 'tiket.status',
            4 => 'tiket.tanggal',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $tiket = new \App\Models\TiketModel();
        $data = $tiket->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $tiket->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
}
