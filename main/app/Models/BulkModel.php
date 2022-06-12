<?php

namespace App\Models;

use CodeIgniter\Model;

class BulkModel extends Model
{
    protected $table = 'riwayat_bulk_order';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'user_id', 'temp', 'nama', 'harga', 'status', 'tanggal'];

    public function getBulk($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("riwayat_order");
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                if (in_groups('user')) {
                    $builder = $builder->orLike('id', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('nama', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('harga', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('status', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('tanggal', $arr_katakunci[$x])->where('user_id', user_id());
                } else {
                    $builder = $builder->orLike('id', $arr_katakunci[$x]);
                    $builder = $builder->orLike('user_id', $arr_katakunci[$x]);
                    $builder = $builder->orLike('nama', $arr_katakunci[$x]);
                    $builder = $builder->orLike('harga', $arr_katakunci[$x]);
                    $builder = $builder->orLike('status', $arr_katakunci[$x]);
                    $builder = $builder->orLike('tanggal', $arr_katakunci[$x]);
                }
            }
        }


        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }


        return $builder->where("user_id", user_id())->orderBy($order, $dir)->get()->getResult();
    }
}
