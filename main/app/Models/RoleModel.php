<?php

namespace App\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table = 'auth_groups_users';
    protected $useTimestamps = false;
    protected $allowedFields = ['group_id', 'user_id'];

    public function getRole($user_id = false)
    {
        if ($user_id == false) {
            return $this->findAll();
        }

        return $this->where(['user_id' => $user_id])->first();
    }
}
