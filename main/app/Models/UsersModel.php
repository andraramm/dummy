<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = false;
    protected $allowedFields = ['email', 'username', 'saldo', 'ref', 'refCode', 'komisi', 'komisi_marketing'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    function ref($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("users");

        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('created_at', $arr_katakunci[$x])->where('ref', user()->refCode);
                $builder = $builder->orLike('username', $arr_katakunci[$x])->where('ref', user()->refCode);
                $builder = $builder->orLike('komisi', $arr_katakunci[$x])->where('ref', user()->refCode);
                $builder = $builder->orLike('komisi_marketing', $arr_katakunci[$x])->where('ref', user()->refCode);
            }
        }
        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        return $builder->where('ref', user()->refCode)->orderBy($order, $dir)->get()->getResult();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("users");

        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('id', $arr_katakunci[$x]);
                $builder = $builder->orLike('email', $arr_katakunci[$x]);
                $builder = $builder->orLike('username', $arr_katakunci[$x]);
                $builder = $builder->orLike('saldo', $arr_katakunci[$x]);
                $builder = $builder->orLike('created_at', $arr_katakunci[$x]);
            }
        }


        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        return $builder->orderBy($order, $dir)->get()->getResult();
    }
}
