<?php

namespace App\Models;

use CodeIgniter\Model;

class IsiTiketModel extends Model
{
    protected $table = 'isi_tiket';
    protected $useTimestamps = false;
    protected $allowedFields = ['id', 'tiket_id', 'pengirim', 'pesan', 'dibaca', 'tanggal'];

    public function getIsiTiket($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
}
