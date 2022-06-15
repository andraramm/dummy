<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\MarketingModel;
use App\Models\RoleModel;
use JsonException;

date_default_timezone_set('Asia/Jakarta');

class ManageUsers extends BaseController
{
    protected $usersModel;
    protected $marketingModel;
    protected $roleModel;
    public function __construct()
    {
        $this->roleModel = new RoleModel();
        $this->marketingModel = new MarketingModel();
        $this->usersModel = new UsersModel();
    }
    public function index()
    {
        if (!in_groups('admin')) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Manage Users']),
            'page_title' => view('partials/page-title', ['title' => 'Manage Users', 'li_1' => 'Home', 'li_2' => 'Manage Users'])
        ];
        return view('/ManageUsers/index', $data);
    }
    public function marketing()
    {
        if (!in_groups('admin')) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title_meta' => view('partials/title-meta', ['title' => 'Marketing']),
            'page_title' => view('partials/page-title', ['title' => 'Marketing', 'li_1' => 'Home', 'li_2' => 'Marketing'])
        ];
        return view('/ManageUsers/marketing', $data);
    }
    public function tabel_users()
    {
        if (!in_groups('admin')) {
            return redirect()->to('/dashboard');
        }
        $columns = [
            0 => 'id',
            1 => 'email',
            2 => 'username',
            3 => 'saldo',
            4 => 'created_at',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $users = new \App\Models\UsersModel();
        $data = $users->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $users->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function tabel_marketing()
    {
        if (!in_groups('admin')) {
            return redirect()->to('/dashboard');
        }
        $columns = [
            0 => 'tim_marketing.id',
            1 => 'users.email',
            2 => 'users.username',
            3 => 'tim_marketing.status',
        ];
        $param['draw'] = isset($_REQUEST['draw']) ? $_REQUEST['draw'] : '';
        $start = isset($_REQUEST['start']) ? $_REQUEST['start'] : '';
        $length = isset($_REQUEST['length']) ? $_REQUEST['length'] : '';
        $search_value = isset($_REQUEST['search']['value']) ? $_REQUEST['search']['value'] : '';
        $order = $columns[$_REQUEST['order']['0']['column']];
        $dir = $_REQUEST['order']['0']['dir'];

        $marketing = new \App\Models\MarketingModel();
        $data = $marketing->searchAndDisplay($search_value, $start, $length, $order, $dir);
        $total_count = $marketing->searchAndDisplay($search_value);

        $json_data = array(
            'draw' => intval($param['draw']),
            'recordsTotal' => count($total_count),
            'recordsFiltered' => count($total_count),
            'data' => $data,
        );

        echo json_encode($json_data);
    }
    public function marketingDetail($id)
    {
        if (!in_groups('admin')) {
            return redirect()->to('/dashboard');
        }

        if ($marketing = $this->marketingModel->where('id', $id)->first()) {
            $user = $this->usersModel->getUser($marketing['user_id']);
            $hasil['error'] = false;
            $hasil['marketing'] = $marketing;
            $hasil['user'] = $user;
        } else {
            $hasil['error'] = true;
        }
        return json_encode($hasil);
    }
    public function editMarketing()
    {
        if (!in_groups('admin')) {
            return redirect()->to('/dashboard');
        }

        $id = $this->request->getPost('id');
        $marketingOld = $this->marketingModel->where('id', $id)->first();

        $statusOld = $marketingOld['status'];
        $statusBaru = $this->request->getPost('status');

        $data = [
            'id' => $id,
            'payment' => $this->request->getPost('payment'),
            'norek' => $this->request->getPost('norek'),
            'atasnama' => $this->request->getPost('atasnama'),
            'status' => $statusBaru,
        ];

        if ($this->marketingModel->save($data)) {
            $marketing = $this->marketingModel->where('id', $id)->first();
            $role = [
                'group_id' => 3, // 3 marketing , 2 user ,  1 admin
                'user_id' => $marketing['user_id'],
            ];
            if ($statusOld != 'aktif' && $statusBaru == 'aktif') {
                $this->roleModel->save($role);
            } else if ($statusBaru != 'aktif' && $statusOld == 'aktif') {
                $this->roleModel->where($role)->delete();
            }
            $hasil['error'] = false;
        } else {
            $hasil['error'] = true;
        }

        return json_encode($hasil);
    }
}
