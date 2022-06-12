<?php

namespace App\Controllers;

use App\Models\PaketModel;
use App\Models\PembayaranModel;
use App\Models\DepositModel;
use App\Models\UsersModel;

date_default_timezone_set('Asia/Jakarta');

class Deposit extends BaseController
{
    protected $paketModel;
    protected $pembayaranModel;
    protected $depositModel;
    protected $usersModel;
    public function __construct()
    {
        $this->depositModel = new DepositModel();
        $this->pembayaranModel = new PembayaranModel();
        $this->paketModel = new PaketModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        $data = [
            'paket' => $this->paketModel->findAll(),
            'title_meta' => view('partials/title-meta', ['title' => 'Deposit']),
            'page_title' => view('partials/page-title', ['title' => 'Deposit', 'li_1' => 'Home', 'li_2' => 'Deposit'])
        ];

        return view('/deposit/index', $data);
    }
    public function tabel_depo()
    {
        $columns = [
            0 => 'riwayat_deposit.id',
            1 => 'riwayat_deposit.noref',
            2 => 'riwayat_deposit.paket',
            3 => 'riwayat_deposit.nominal',
            4 => 'riwayat_deposit.metode',
            5 => 'riwayat_deposit.expired',
            6 => 'riwayat_deposit.status',
            7 => 'riwayat_deposit.tipe',
            8 => 'users.email',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $depo = new \App\Models\DepositModel();
        $data = $depo->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $depo->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function cekDepo()
    {
        $user = user_id();
        if ($this->depositModel->where("user_id=$user AND status='BELUM BAYAR'")->first()) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Kamu masih memiliki deposit yang belum dibayar, silahkan bayar/hapus terlebih dahulu.';
        } else {
            $hasil['error'] = false;
        }

        return json_encode($hasil);
    }
    public function metode_pembayaran()
    {
        if (!isset($_POST['data-id'])) {
            return redirect()->to('/dashboard');
        }

        $data = [
            'pembayaran' => $this->pembayaranModel->findAll(),
            'paket' => $this->paketModel->findAll(),
            'paket_detail' => $this->paketModel->getPaket($_POST['data-id']),
            'title_meta' => view('partials/title-meta', ['title' => 'Metode Pembayaran']),
            'page_title' => view('partials/page-title', ['title' => 'Metode Pembayaran', 'li_1' => 'Home', 'li_2' => 'Deposit', 'li_3' => 'Metode Pembayaran'])
        ];

        return view('/deposit/metode_pembayaran', $data);
    }
    public function getDetailPaket($id)
    {
        return json_encode($this->paketModel->getPaket($id));
    }
    public function create()
    {
        $paket = $this->paketModel->getPaket($this->request->getVar('paket'));
        $saveData = [
            'user_id' => user_id(),
            'tipe' => $this->request->getVar('tipe'),
            'noref' => 'RX-' . time() . user_id(),
            'paket' => $paket['nama'],
            'nominal' => $paket['harga'] + rand(100, 200),
            'metode' => $this->request->getVar('pembayaran'),
            'tanggal' => date("Y-m-d H:i:s")
        ];

        if (!$this->depositModel->save($saveData)) {
            return redirect()->to('/deposit');
        }

        $id = $this->depositModel->getInsertID();

        return redirect()->to('/deposit/pembayaran/' . $id);
    }
    public function pembayaran($id)
    {
        // cek id punya user atau bukan
        $deposit = $this->depositModel->getDeposit($id);
        if ($deposit['tipe'] != 'manual') {
            return redirect()->to('/dashboard');
        } else {
            if ($deposit['user_id'] != user_id() && in_groups('user')) {
                return redirect()->to('/dashboard');
            }
        }

        $rek = $this->pembayaranModel->where('nama', $deposit['metode'])->first();

        $data = [
            'rek' => $rek,
            'depo' => $deposit,
            'title_meta' => view('partials/title-meta', ['title' => 'Pembayaran']),
            'page_title' => view('partials/page-title', ['title' => 'Pembayaran', 'li_1' => 'Home', 'li_2' => 'Deposit', 'li_3' => 'Metode Pembayaran', 'li_4' => 'Pembayaran'])
        ];

        return view('/deposit/pembayaran', $data);
    }
    public function delete($id)
    {
        $depo = $this->depositModel->getDeposit($id);
        if (in_groups('admin')) {
            $hasil['role'] = 'admin';
        } else {
            $hasil['role'] = 'user';
            if ($depo['user_id'] != user_id() || $depo['status'] != 'BELUM BAYAR') {
                $hasil['error'] = true;
                $hasil['teks'] = 'Gagal menghapus deposit.';
                return json_encode($hasil);
            }
        }

        if (!$this->depositModel->delete($id)) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Gagal menghapus deposit.';
        } else {
            $hasil['error'] = false;
            $hasil['teks'] = 'Berhasil menghapus deposit';
        }

        return json_encode($hasil);
    }



    // admin function
    public function editDepo($id)
    {
        if (in_groups('user') || in_groups('banned')) {
            return redirect()->to('/');
        }

        $depo = $this->depositModel->getDeposit($id);

        if (!$depo) {
            $hasil['error'] = true;
            $hasil['teks'] = 'Deposit id tidak ditemukan.';
        } else {
            $hasil['error'] = false;
            $hasil['depo'] = $depo;
            $hasil['email'] = $this->usersModel->getUser($depo['user_id'])['email'];
        }

        return json_encode($hasil);
    }
    public function saveChangeDepo()
    {
        if (in_groups('user') || in_groups('banned')) {
            return redirect()->to('/');
        }

        $id = $this->request->getVar('id');
        $depo = $this->depositModel->getDeposit($id);

        $statusLama = $depo['status'];
        $statusBaru = $this->request->getVar('depostatus');

        $data = [
            'id' => $id,
            'status' => $statusBaru,
        ];

        if ($this->depositModel->save($data)) {
            $user = $this->usersModel->getUser($depo['user_id']);
            $paket = $this->paketModel->where('nama', $depo['paket'])->first()['harga'];

            $userData = [
                'id' => $user['id'],
            ];

            if ($statusLama == 'BELUM BAYAR' && $statusBaru == 'LUNAS') {
                // tambahkan user
                $userData['saldo'] = $user['saldo'] + $paket;
            }

            if ($statusLama == 'LUNAS' && $statusBaru == 'BELUM BAYAR') {
                // kurangi saldo user
                $userData['saldo'] = ($user['saldo'] - $paket <  0) ? 0 : $user['saldo'] - $paket;
            }

            $this->usersModel->save($userData);
            $hasil['error'] = false;
            $hasil['teks'] = 'Berhasil menyimpan perubahan.';
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Gagal menyimpan perubahan.';
        }

        return json_encode($hasil);
    }
}
