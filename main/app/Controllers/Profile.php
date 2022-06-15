<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\MarketingModel;

date_default_timezone_set('Asia/Jakarta');

class Profile extends BaseController
{
    protected $usersModel;
    protected $marketingModel;
    public function __construct()
    {
        $this->marketingModel = new MarketingModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        $tipe_komisi = (in_groups('marketing')) ? 'komisi_marketing' : 'komisi';
        if ($data_users = $this->usersModel->where('ref', user()->refCode)->findColumn($tipe_komisi)) {
            $komisi = array_sum($data_users);
        } else {
            $komisi = 0;
        }

        $data = [
            'marketing' => $this->marketingModel->getMarketing(user_id()),
            'komisi' => $komisi,
            'refCode' => user()->refCode,
            'username' => user()->username,
            'email' => user()->email,
            'tanggal' => date_format(date_create(user()->created_at), 'l, d F Y'),
            'title_meta' => view('partials/title-meta', ['title' => 'Profile']),
            'page_title' => view('partials/page-title', ['title' => 'Profile', 'li_1' => 'Home', 'li_2' => 'Profile'])
        ];

        return view('/profile/index', $data);
    }
    public function tabel_referral()
    {
        $columns = [
            0 => 'created_at',
            1 => 'username',
            2 => 'komisi',
            3 => 'komisi_marketing'
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $referral = new \App\Models\UsersModel();
        $data = $referral->ref($search_value, $start, $length, $order, $dir);
        $total_count = $referral->ref($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function generate()
    {

        if (!user()->refCode) {
            $refCode =  'RF' . user_id() . time();

            $data = [
                'id' => user_id(),
                'refCode' => $refCode
            ];

            if ($this->usersModel->save($data)) {
                $hasil['error'] = false;
                $hasil['teks'] = 'Generate Berhasil!';
                $hasil['url'] = site_url('register?ref=' . $refCode);
            } else {
                $hasil['error'] = true;
                $hasil['teks'] = 'Gagal, coba ulangi.';
            }
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Maaf kamu sudah pernah generate.';
        }

        return json_encode($hasil);
    }
    public function daftar_marketing()
    {
        $data = [
            'user_id' => user_id(),
            'tanggal' => date("Y-m-d H:i:s"),
            'payment' => $this->request->getVar('payment'),
            'norek' => $this->request->getVar('norek'),
            'atasnama' => $this->request->getVar('atasnama'),
        ];

        if ($id = $this->request->getVar('id')) {
            $data['id'] = $id;
        } else {
            // cek apakah usaer sudah daftar
            if ($this->marketingModel->getMarketing(user_id())) {
                $hasil['error'] = true;
                $hasil['teks'] = 'Kamu sudah terdaftar!';
                return json_encode($hasil);
            }
        }

        if ($this->marketingModel->save($data)) {
            $hasil['error'] = false;
        } else {
            $hasil['error'] = true;
            $hasil['teks'] = 'Silahkan coba lagi.';
        }
        return json_encode($hasil);
    }
}
