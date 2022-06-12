<?php

namespace App\Models;

use CodeIgniter\Model;

class PaketModel extends Model
{
    protected $table = 'paket_deposit';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'nama', 'harga', 'jenis'];

    public function getPaket($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
