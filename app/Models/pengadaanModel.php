<?php

namespace App\Models;

use CodeIgniter\Model;

class pengadaanModel extends Model
{
    protected $table = 'pengadaan';
    protected $primaryKey = 'id_pengadaan';
    protected $allowedFields = [
        'id_pengadaan',
        'user_id',
        'ket_pengadaan',
        'status_pengadaan',
        'tanggal_proses',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getPengadaan($id = false)
    {
        if ($id == false) {
            return $this->select('pengadaan.id_pengadaan, pengadaan.user_id, pengadaan.ket_pengadaan, pengadaan.status_pengadaan, pengadaan.created_at, pengadaan.tanggal_proses, users.nama_user')
                ->join('users', 'users.id_user = pengadaan.user_id');
        }
        return $this
            ->select('pengadaan.id_pengadaan, pengadaan.user_id, pengadaan.ket_pengadaan, pengadaan.status_pengadaan, pengadaan.created_at, pengadaan.tanggal_proses, users.nama_user')
            ->join('users', 'users.id_user = pengadaan.user_id')
            ->where(['id_pengadaan' => $id])->first();
    }
}