<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table = 'file';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'nama', 'total_game', 'kelamin', 'olahraga', 'state', 'situs', 'harga', 'status', 'tanggal_game', 'tanggal'];

    public function getFile($id = false)
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
                $builder = $builder->orLike('id', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('state', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('olahraga', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('kelamin', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('situs', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('total_game', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('harga', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('tanggal_game', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
                $builder = $builder->orLike('tanggal', $arr_katakunci[$x])->whereNotIn('status', ['dihapus']);
            }
        }
        if ($start != 0 or $length != 0) {
            $builder = $builder->limit($length, $start);
        }

        return $builder->orderBy($order, $dir)->get()->getResult();
    }
    function cariFile($gender = null, $olahraga = null, $state = null, $tanggal = null)
    {
        $builder = $this->table('file');

        if ($gender && $gender != 'all') {
            $builder = $builder->where('kelamin', $gender)->whereNotIn('status', ['dihapus']);
        }

        if ($state && $state != 'all') {
            $builder = $builder->where('state', $state)->whereNotIn('status', ['dihapus']);
        }

        if ($olahraga && $olahraga != 'all') {
            $builder = $builder->where('olahraga', $olahraga)->whereNotIn('status', ['dihapus']);
        }

        if ($tanggal) {
            if (count($tanggal) != 0) {
                $builder = $builder->whereIn('tanggal_game', $tanggal)->whereNotIn('status', ['dihapus']);
            }
        }

        return $builder;
    }
}
