<?php

namespace App\Models;

use CodeIgniter\Model;

class pengecekanModel extends Model
{
    protected $table = 'pengecekan';
    protected $primaryKey = 'id_pengecekan';
    protected $allowedFields = [
        'id_pengecekan',
        'user_id',
        'inventaris_id',
        'ket_pengecekan',
        'status_pengecekan',
        'foto_pengecekan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getPengecekan($id = false)
    {
        if ($id == false) {
            return $this
                ->select('pengecekan.id_pengecekan, pengecekan.user_id, pengecekan.inventaris_id, pengecekan.ket_pengecekan, pengecekan.foto_pengecekan, pengecekan.status_pengecekan, users.nama_user, inventaris.nama_inventaris')
                ->join('users', 'users.id_user = pengecekan.user_id')
                ->join('inventaris', 'inventaris.id_inventaris = pengecekan.inventaris_id');
        }
        return $this
            ->select('pengecekan.id_pengecekan, pengecekan.user_id, pengecekan.inventaris_id, pengecekan.ket_pengecekan, pengecekan.status_pengecekan, pengecekan.foto_pengecekan, users.nama_user, inventaris.nama_inventaris')
            ->join('users', 'users.id_user = pengecekan.user_id')
            ->join('inventaris', 'inventaris.id_inventaris = pengecekan.inventaris_id')
            ->where(['id_pengecekan' => $id])->first();
    }
}