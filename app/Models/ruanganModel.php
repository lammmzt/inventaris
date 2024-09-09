<?php

namespace App\Models;

use CodeIgniter\Model;

class ruanganModel extends Model
{
    protected $table = 'ruangan';
    protected $primaryKey = 'id_ruangan';
    protected $allowedFields = [
        'id_ruangan',
        'nama_ruangan',
        'status_ruangan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getRuangan($id = false)
    {
        if ($id == false) {
            return $this->select('id_ruangan, nama_ruangan, status_ruangan');
        }
        return $this->select('id_ruangan, nama_ruangan, status_ruangan')->where(['id_ruangan' => $id])->first();
    }
}