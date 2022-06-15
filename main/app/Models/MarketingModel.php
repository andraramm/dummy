<?php

namespace App\Models;

use CodeIgniter\Model;

class MarketingModel extends Model
{
    protected $table = 'tim_marketing';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'user_id', 'status', 'tanggal', 'payment', 'norek', 'atasnama'];

    public function getMarketing($user_id = false)
    {
        if ($user_id == false) {
            return $this->findAll();
        }

        return $this->where(['user_id' => $user_id])->first();
    }
    function searchAndDisplay($katakunci = null, $start = 0, $length = 0, $order = 0, $dir = 0)
    {
        $builder = $this->table("tim_marketing");
        $builder->select('tim_marketing.id, users.email, users.username, tim_marketing.status');
        $builder->join('users', 'users.id = tim_marketing.user_id');

        if ($katakunci) {
            $arr_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($arr_katakunci); $x++) {
                $builder = $builder->orLike('tim_marketing.id', $arr_katakunci[$x]);
                $builder = $builder->orLike('users.email', $arr_katakunci[$x]);
                $builder = $builder->orLike('users.username', $arr_katakunci[$x]);
                $builder = $builder->orLike('tim_marketing.status', $arr_katakunci[$x]);
            }
        }


        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        return $builder->orderBy($order, $dir)->get()->getResult();
    }
}
