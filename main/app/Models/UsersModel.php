<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = false;
    protected $allowedFields = ['email', 'username', 'saldo'];

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("file");

        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('id', $arr_katakunci[$x]);
                $builder = $builder->orLike('state', $arr_katakunci[$x]);
                $builder = $builder->orLike('olahraga', $arr_katakunci[$x]);
                $builder = $builder->orLike('kelamin', $arr_katakunci[$x]);
                $builder = $builder->orLike('situs', $arr_katakunci[$x]);
                $builder = $builder->orLike('total_game', $arr_katakunci[$x]);
                $builder = $builder->orLike('harga', $arr_katakunci[$x]);
                $builder = $builder->orLike('tanggal_game', $arr_katakunci[$x]);
                $builder = $builder->orLike('tanggal', $arr_katakunci[$x]);
            }
        }
        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        return $builder->orderBy($order, $dir)->get()->getResult();
    }
}
