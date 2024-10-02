<?php

namespace App\Models;

use CodeIgniter\Model;

class pengecekanModel extends Model
{
    protected $table = 'pengecekan';
    protected $primaryKey = 'id_pengecekan';
    protected $allowedFields = [
        'id_pengecekan',
        'id_user',
        'id_inventaris',
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
                ->select('pengecekan.id_pengecekan, pengecekan.id_user, pengecekan.id_inventaris, pengecekan.ket_pengecekan, pengecekan.foto_pengecekan, pengecekan.status_pengecekan, pengecekan.created_at, users.nama_user, inventaris.nama_inventaris')
                ->join('users', 'users.id_user = pengecekan.id_user')
                ->join('inventaris', 'inventaris.id_inventaris = pengecekan.id_inventaris');
        }
        return $this
            ->select('pengecekan.id_pengecekan, pengecekan.id_user, pengecekan.id_inventaris, pengecekan.ket_pengecekan, pengecekan.status_pengecekan, pengecekan.foto_pengecekan, users.nama_user,pengecekan.created_at, inventaris.nama_inventaris')
            ->join('users', 'users.id_user = pengecekan.id_user')
            ->join('inventaris', 'inventaris.id_inventaris = pengecekan.id_inventaris')
            ->where(['id_pengecekan' => $id])->first();
    }

    public function getPengecekanActive()
    {
        return $this
            ->select('pengecekan.id_pengecekan, pengecekan.id_user, pengecekan.id_inventaris, pengecekan.ket_pengecekan, pengecekan.foto_pengecekan, pengecekan.status_pengecekan, pengecekan.created_at, users.nama_user, inventaris.nama_inventaris,  ruangan.nama_ruangan, tipe_barang.nama_tipe_barang')
            ->join('users', 'users.id_user = pengecekan.id_user')
            ->join('inventaris', 'inventaris.id_inventaris = pengecekan.id_inventaris')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = inventaris.id_tipe_barang')
            ->join('ruangan', 'ruangan.id_ruangan = inventaris.id_ruangan');
    }
}