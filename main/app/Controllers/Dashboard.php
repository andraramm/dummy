<?php

namespace App\Controllers;

use App\Models\FileModel;
use App\Models\UsersModel;
use App\Models\OrderModel;
use App\Models\BulkModel;
use PDO;

class Dashboard extends BaseController
{
    protected $fileModel;
    protected $usersModel;
    protected $orderModel;
    protected $bulkModel;
    public function __construct()
    {
        $this->bulkModel = new BulkModel();
        $this->orderModel = new OrderModel();
        $this->usersModel = new UsersModel();
        $this->fileModel = new FileModel();
    }
    public function index()
    {
        $data = [
            'file' => $this->fileModel->findAll(),
            'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
            'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'li_1' => 'Home', 'li_2' => 'Dashboard'])
        ];

        if (in_groups('admin')) {
            $users = $this->usersModel->findAll();
            $data['saldo'] = array_sum($this->usersModel->findColumn('saldo'));
            $data['pemasukan'] = array_sum($this->orderModel->findColumn('harga'));
            $data['user'] = count($users);
        }

        return view('/dashboard/index', $data);
    }
    public function riwayat_order()
    {
        $columns = [
            0 => 'riwayat_order.id',
            1 => 'file.kelamin',
            2 => 'riwayat_order.harga',
            3 => 'riwayat_order.total_game',
            4 => 'file.tanggal_game',
            5 => 'riwayat_order.tanggal', // tanggal order
            6 => 'file.olahraga',
            7 => 'file.state',
            8 => 'file.situs',
            9 => 'riwayat_order.status',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $riwayat_order = new \App\Models\OrderModel();
        $data = $riwayat_order->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $riwayat_order->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function riwayat_order_bulk()
    {
        $columns = [
            0 => 'id',
            1 => 'user_id',
            2 => 'nama',
            3 => 'harga',
            4 => 'status',
            5 => 'tanggal',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $riwayat_order = new \App\Models\BulkModel();
        $data = $riwayat_order->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $riwayat_order->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function tabel_jadwal()
    {
        $columns = [
            0 => 'id',
            1 => 'state',
            2 => 'olahraga',
            3 => 'kelamin',
            4 => 'situs',
            5 => 'total_game',
            6 => 'harga',
            7 => 'tanggal_game',
            8 => 'tanggal',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $file = new \App\Models\FileModel();
        $data = $file->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $file->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function selectGender()
    {
        $gender = $this->request->getVar('gender');

        if (!$this->fileModel->cariFile($gender)->find()) {
            $hasil['error'] = true;
        } else {
            $data = $this->fileModel->cariFile($gender);
            $hasil['error'] = false;
            $hasil['olahraga'] = array_unique($data->findColumn('olahraga'));
        }

        return json_encode($hasil);
    }
    public function selectOlahraga()
    {
        $gender = $this->request->getVar('gender');
        $olahraga = $this->request->getVar('olahraga');

        if (!$this->fileModel->cariFile($gender, $olahraga)->find()) {
            $hasil['error'] = true;
        } else {
            $data = $this->fileModel->cariFile($gender, $olahraga);
            $hasil['error'] = false;
            $hasil['state'] = array_unique($data->findColumn('state'));
        }

        return json_encode($hasil);
    }
    public function selectState()
    {
        $gender = $this->request->getVar('gender');
        $olahraga = $this->request->getVar('olahraga');
        $state = $this->request->getVar('state');

        if (!$this->fileModel->cariFile($gender, $olahraga, $state)->find()) {
            $hasil['error'] = true;
        } else {
            $data = $this->fileModel->cariFile($gender, $olahraga, $state);
            $hasil['error'] = false;
            $hasil['tanggal'] = array_unique($data->findColumn('tanggal_game'));
        }

        return json_encode($hasil);
    }
    public function selectTanggal()
    {
        $gender = $this->request->getVar('gender');
        $olahraga = $this->request->getVar('olahraga');
        $state = $this->request->getVar('state');
        $tanggal = $this->request->getVar('tanggal_value');

        if (!$this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->find()) {
            $hasil['error'] = true;
        } else {
            $hasil['error'] = false;
            $hasil['total_file'] = ($this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->find()) ? count($this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->find()) : 0;
            $hasil['game'] = array_sum($this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->findColumn('total_game'));
            $hasil['harga'] = array_sum($this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->findColumn('harga'));
        }

        return json_encode($hasil);
    }
    public function bulkBuy()
    {
        function joinFiles(array $files, $result)
        {
            $wH = fopen($result, "w+");

            foreach ($files as $file) {
                $fh = fopen($file, "r");
                while (!feof($fh)) {
                    fwrite($wH, fgets($fh));
                }
                fclose($fh);
                unset($fh);
                // fwrite($wH, "\n"); //usually last line doesn't have a newline
            }
            fclose($wH);
            unset($wH);
        }

        $gender = $this->request->getVar('gender');
        $olahraga = $this->request->getVar('olahraga');
        $state = $this->request->getVar('state');
        $tanggal = $this->request->getVar('tanggal_value');

        if (!$this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->find()) {
            $hasil['error'] = true;
            return json_encode($hasil);
        }

        $get_file = $this->fileModel->cariFile($gender, $olahraga, $state, $tanggal);
        $list_file = $get_file->find();

        // cek saldo apakah cukup atau tidak
        $harga = array_sum($this->fileModel->cariFile($gender, $olahraga, $state, $tanggal)->findColumn('harga'));
        $saldo = user()->saldo;
        if ($harga > $saldo) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Saldo tidak cukup, silahkan deposit terlebih dahulu.';
            return json_encode($hasil);
        }

        $file_arr = [];
        foreach ($list_file as $l) {
            $or = $l['olahraga'];
            $csv = $l['nama'];
            array_push($file_arr, "csv/$or/$csv");
        }

        $folderTempUser = md5(time() + user_id());

        mkdir('temp/' . $folderTempUser);

        $date = date('sHidmY');
        joinFiles($file_arr, "temp/$folderTempUser/bulk-$date.csv");

        // kurangi saldo user
        $dataUser = [
            'id' => user_id(),
            'saldo' => $saldo - $harga
        ];

        // send error jika gagal update data user
        if (!$this->usersModel->save($dataUser)) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Pembelian gagal, coba ulangi lagi.';
            return json_encode($hasil);
        }

        // save riwayat order
        $dataOrder = [
            'user_id' => user_id(),
            'temp' => $folderTempUser,
            'nama' => "bulk-$date.csv",
            'harga' => $harga,
            'status' => 'ada',
        ];

        $this->bulkModel->save($dataOrder);

        // sukses
        $hasil['error'] = false;
        $hasil['url'] = site_url("temp/$folderTempUser/bulk-$date.csv");
        $hasil['saldo'] = number_format($saldo - $harga, 0, ",", ".");

        return json_encode($hasil);
    }
    public function getDetailFile($id)
    {
        if ($file = $this->fileModel->getFile($id)) {
            $hasil['error'] = false;
            $hasil['id'] = $file['id'];
            $hasil['state'] = $file['state'];
            $hasil['olahraga'] = $file['olahraga'];
            $hasil['kelamin'] = $file['kelamin'];
            $hasil['situs'] = $file['situs'];
            $hasil['total_game'] = $file['total_game'];
            $hasil['tanggal_game'] = $file['tanggal_game'];
            $hasil['tanggal'] = $file['tanggal'];
            $hasil['harga'] = $file['harga'];
        } else {
            $hasil['error'] = true;
        }

        return json_encode($hasil);
    }
    public function buyFile($id)
    {
        $file = $this->fileModel->getFile($id);
        $saldo = user()->saldo;

        // send error jika saldo tidak cukup
        if ($file['harga'] > $saldo) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Pembelian gagal, saldo tidak cukup!';
            return json_encode($hasil);
        }

        $filename = $file['nama'];
        $olahraga = $file['olahraga'];

        $folderTempUser = md5(time() + user_id());

        mkdir('temp/' . $folderTempUser);

        // send error jika gagal copy file
        if (!copy("csv/$olahraga/$filename", "temp/$folderTempUser/$filename")) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Pembelian gagal, coba ulangi lagi.';
            return json_encode($hasil);
        }

        // kurangi saldo user
        $dataUser = [
            'id' => user_id(),
            'saldo' => $saldo - $file['harga']
        ];

        // send error jika gagal update data user
        if (!$this->usersModel->save($dataUser)) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Pembelian gagal, coba ulangi lagi.';
            return json_encode($hasil);
        }

        // save riwayat order
        $dataOrder = [
            'file_id' => $id,
            'user_id' => user_id(),
            'temp_folder' => $folderTempUser,
            'total_game' => $file['total_game'],
            'harga' => $file['harga'],
            'status' => 'ada',
        ];

        $this->orderModel->save($dataOrder);

        // sukses
        $hasil['error'] = false;
        $hasil['url'] = site_url("temp/$folderTempUser/$filename");
        $hasil['saldo'] = number_format($saldo - $file['harga'], 0, ",", ".");
        return json_encode($hasil);
    }
    public function downloadFile($id)
    {
        // cek apakah file punya user
        $file = $this->orderModel->getOrder($id);
        if ($file['user_id'] != user_id()) {
            $hasil['error'] = true;
            $hasil['teks'] = 'File tidak ditemukan.';
            return json_encode($hasil);
        }

        // cek apakah file sudah di hapus oleh sistem
        $path = $file['temp_folder'];
        if ($detailFile = $this->fileModel->getFile($file['file_id'])) {
            $filename = $detailFile['nama'];
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Maaf file sudah dihapus secara otomatis oleh sistem.';
            return json_encode($hasil);
        }

        if (file_exists("temp/$path/$filename")) {
            $hasil['error'] = false;
            $hasil['url'] = site_url("/temp/$path/$filename");
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Maaf file sudah dihapus secara otomatis oleh sistem.';
        }

        return json_encode($hasil);
    }
    public function downloadFileBulk($id)
    {
        // cek apakah file punya user
        $file = $this->bulkModel->getBulk($id);
        if ($file['user_id'] != user_id()) {
            $hasil['error'] = true;
            $hasil['teks'] = 'File tidak ditemukan.';
            return json_encode($hasil);
        }

        // cek apakah file sudah di hapus oleh sistem
        $path = $file['temp'];
        if ($file['status'] == 'ada') {
            $filename = $file['nama'];
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Maaf file sudah dihapus secara otomatis oleh sistem.';
            return json_encode($hasil);
        }

        if (file_exists("temp/$path/$filename")) {
            $hasil['error'] = false;
            $hasil['url'] = site_url("/temp/$path/$filename");
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Maaf file sudah dihapus secara otomatis oleh sistem.';
        }

        return json_encode($hasil);
    }
}
