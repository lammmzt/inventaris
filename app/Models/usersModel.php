<?php

namespace App\Models;

use CodeIgniter\Model;

class usersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'username', 'password', 'role', 'nama_user', 'last_login', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getUser($id = false)
    {
        if ($id == false) {
            return $this->select('id_user, username, role, nama_user, last_login, created_at, updated_at');
        }
        return $this->where(['id_user' => $id])->first();
    }

}