<?php

namespace App\Controllers;

use App\Models\FileModel;
use App\Models\OrderModel;
use App\Models\BulkModel;

date_default_timezone_set('Asia/Jakarta');

class AutoDelete extends BaseController
{
    protected $fileModel;
    protected $orderModel;
    protected $bulkModel;
    public function __construct()
    {
        $this->bulkModel = new BulkModel();
        $this->orderModel = new OrderModel();
        $this->fileModel = new FileModel();
    }

    public function index()
    {
        // http://heyha.io/AutoDelete?key=lowdicks
        // hapus setiap hari senin

        // return jika key salah
        if (!isset($_GET['key'])) {
            return false;
        }

        if ($_GET['key'] != 'lowdicks') {
            return false;
        }

        // cek jika bukan hari senin
        if (date('l') != 'Monday') {
            return false;
        }

        // hapus riwayat order 
        $file = $this->orderModel->findAll();
        foreach ($file as $f) {
            if (strtotime($f['tanggal']) < strtotime("-24 hours")) {
                $path = $f['temp_folder'];
                array_map('unlink', glob("temp/$path/*.*"));
                rmdir("temp/$path");
                $data = [
                    'id' => $f['id'],
                    'status' => 'dihapus',
                ];
                $this->orderModel->save($data);
            }
        }

        // hapus riwayat bulk order
        $bulk = $this->bulkModel->findAll();
        foreach ($bulk as $b) {
            if (strtotime($b['tanggal']) < strtotime("-24 hours")) {
                $path = $b['temp'];
                array_map('unlink', glob("temp/$path/*.*"));
                rmdir("temp/$path");
                $dataBulk = [
                    'id' => $b['id'],
                    'status' => 'dihapus',
                ];
                $this->bulkModel->save($dataBulk);
            }
        }

        return 'done';
    }
    public function deleteJadwalLama()
    {
        // http://heyha.io/AutoDelete/deleteJadwalLama?key=lowdicks
        // hapus setiap hari

        // return jika key salah
        if (!isset($_GET['key'])) {
            return false;
        }

        if ($_GET['key'] != 'lowdicks') {
            return false;
        }

        // hapus riwayat order 
        $file = $this->fileModel->findAll();
        foreach ($file as $f) {
            if (strtotime($f['tanggal_game']) < strtotime("-2 days")) {
                $or = $f['olahraga'];
                $filename = $f['nama'];
                unlink("csv/$or/$filename");
                $data = [
                    'id' => $f['id'],
                    'status' => 'dihapus',
                ];
                $this->fileModel->save($data);
            }
        }

        return 'done';
    }
}
