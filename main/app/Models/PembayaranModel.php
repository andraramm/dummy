<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table = 'pembayaran_manual';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'nama', 'atas_nama', 'norek'];

    public function getPembayaran($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
