<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'riwayat_order';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'file_id', 'user_id', 'temp_folder', 'total_game', 'harga', 'status', 'tanggal'];

    public function getOrder($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {

        $builder = $this->table("riwayat_order");
        $builder->select('riwayat_order.id, file.kelamin, riwayat_order.total_game, riwayat_order.harga, file.tanggal_game, riwayat_order.tanggal, file.olahraga, file.state, file.situs, riwayat_order.status');
        $builder->join('file', 'file.id = riwayat_order.file_id');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                if (in_groups('user')) {
                    $builder = $builder->orLike('riwayat_order.id', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('file.kelamin', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('riwayat_order.total_game', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('riwayat_order.harga', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('file.tanggal_game', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('riwayat_order.tanggal', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('file.olahraga', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('file.state', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('file.situs', $arr_katakunci[$x])->where('user_id', user_id());
                    $builder = $builder->orLike('riwayat_order.status', $arr_katakunci[$x])->where('user_id', user_id());
                } else {
                    $builder = $builder->orLike('riwayat_order.id', $arr_katakunci[$x]);
                    $builder = $builder->orLike('file.kelamin', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_order.total_game', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_order.harga', $arr_katakunci[$x]);
                    $builder = $builder->orLike('file.tanggal_game', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_order.tanggal', $arr_katakunci[$x]);
                    $builder = $builder->orLike('file.olahraga', $arr_katakunci[$x]);
                    $builder = $builder->orLike('file.state', $arr_katakunci[$x]);
                    $builder = $builder->orLike('file.situs', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_order.status', $arr_katakunci[$x]);
                }
            }
        }


        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }


        return $builder->where("user_id", user_id())->orderBy($order, $dir)->get()->getResult();
    }
}
