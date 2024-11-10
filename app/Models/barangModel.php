<?php

namespace App\Models;

use CodeIgniter\Model;

class barangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $allowedFields = [
        'id_barang',
        'nama_barang',
        'status_barang',
        'jenis_barang',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getBarang($id = false)
    {
        if ($id == false) {
            return $this
            ->select('id_barang, nama_barang, status_barang, jenis_barang');
        }
        return $this
        ->select('id_barang, nama_barang, status_barang, jenis_barang')
        ->where(['id_barang' => $id])->first();
    }

    public function getBarangByCode($code)
    {
        return $this
        ->select('id_barang, nama_barang, status_barang, jenis_barang')
        ->where(['id_barang' => $code])
        ->first();
    }

    public function getBarangByJenisBarang($type)
    {
        return $this
        ->select('id_barang, nama_barang, status_barang, jenis_barang')
        ->where(['jenis_barang' => $type])
        ->findAll();
    }
}