<?php

namespace App\Models;

use CodeIgniter\Model;

class DepositModel extends Model
{
    protected $table = 'riwayat_deposit';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'user_id', 'tipe', 'noref', 'paket', 'nominal', 'metode', 'status', 'expired', 'tanggal'];

    public function getDeposit($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("riwayat_deposit");
        $builder->select('riwayat_deposit.id, riwayat_deposit.noref, riwayat_deposit.paket, riwayat_deposit.nominal, riwayat_deposit.metode, riwayat_deposit.expired, riwayat_deposit.status, riwayat_deposit.tipe, users.email');
        $builder->join('users', 'users.id = riwayat_deposit.user_id');
        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                if (in_groups('user')) {
                    $builder = $builder->orLike('riwayat_deposit.id', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.noref', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.paket', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.nominal', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.metode', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.expired', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.status', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('riwayat_deposit.tipe', $arr_katakunci[$x])->where("user_id", user_id());
                    $builder = $builder->orLike('users.email', $arr_katakunci[$x])->where("user_id", user_id());
                } else {
                    $builder = $builder->orLike('riwayat_deposit.id', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.noref', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.paket', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.nominal', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.metode', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.expired', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.status', $arr_katakunci[$x]);
                    $builder = $builder->orLike('riwayat_deposit.tipe', $arr_katakunci[$x]);
                    $builder = $builder->orLike('users.email', $arr_katakunci[$x]);
                }
            }
        }


        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        if (in_groups('user')) {
            $builder->where("user_id", user_id());
        }

        return $builder->orderBy($order, $dir)->get()->getResult();
    }
}
