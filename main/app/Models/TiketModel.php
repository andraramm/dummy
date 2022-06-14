<?php

namespace App\Models;

use CodeIgniter\Model;

class TiketModel extends Model
{
    protected $table = 'tiket';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'pengirim', 'penerima', 'subject', 'status', 'tanggal'];

    public function getTiket($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("tiket");
        $builder->select('tiket.id, tiket.pengirim, tiket.subject, tiket.status, tiket.tanggal, users.username');
        $builder->join('users', 'users.id = tiket.pengirim');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                if (in_groups('user')) {
                    $builder = $builder->orLike('tiket.id', $arr_katakunci[$x])->where("pengirim", user_id());
                    $builder = $builder->orLike('tiket.subject', $arr_katakunci[$x])->where("pengirim", user_id());
                    $builder = $builder->orLike('tiket.status', $arr_katakunci[$x])->where("pengirim", user_id());
                    $builder = $builder->orLike('tiket.tanggal', $arr_katakunci[$x])->where("pengirim", user_id());
                } else {
                    $builder = $builder->orLike('tiket.id', $arr_katakunci[$x]);
                    $builder = $builder->orLike('tiket.subject', $arr_katakunci[$x]);
                    $builder = $builder->orLike('tiket.status', $arr_katakunci[$x]);
                    $builder = $builder->orLike('tiket.tanggal', $arr_katakunci[$x]);
                    $builder = $builder->orLike('users.username', $arr_katakunci[$x]);
                }
            }
        }


        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        if (in_groups('user')) {
            $builder->where("pengirim", user_id());
        }

        return $builder->orderBy($order, $dir)->get()->getResult();
    }
}
