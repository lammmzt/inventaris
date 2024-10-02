<?php

namespace App\Models;

use CodeIgniter\Model;

class tipeBarangModel extends Model
{
    protected $table = 'tipe_barang';
    protected $primaryKey = 'id_tipe_barang';
    protected $allowedFields = [
        'id_tipe_barang',
        'id_barang',
        'id_satuan',
        'nama_tipe_barang',
        'status_tipe_barang',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getTipeBarang($id = false)
    {
        if ($id == false) {
            return $this
                ->select('tipe_barang.id_tipe_barang, tipe_barang.id_barang, tipe_barang.nama_tipe_barang, tipe_barang.status_tipe_barang, barang.nama_barang, barang.kode_barang, satuan.nama_satuan')
                ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
                ->join('barang', 'barang.id_barang = tipe_barang.id_barang');

        }
        return $this
            ->select('tipe_barang.id_tipe_barang, tipe_barang.id_barang, tipe_barang.nama_tipe_barang, tipe_barang.status_tipe_barang, barang.nama_barang , barang.kode_barang, satuan.nama_satuan')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->where(['id_tipe_barang' => $id])
            ->first();
    }


    public function getTipeBarangByBarang($id)
    {
        return $this
            ->select('tipe_barang.id_tipe_barang, tipe_barang.id_barang, tipe_barang.nama_tipe_barang, tipe_barang.status_tipe_barang, barang.nama_barang, barang.kode_barang, satuan.nama_satuan')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->where(['tipe_barang.id_barang' => $id]);  
    }

    public function getTipeBarangByJenisBarang($id){
        return $this
            ->select('tipe_barang.id_tipe_barang, tipe_barang.id_barang, tipe_barang.nama_tipe_barang, tipe_barang.status_tipe_barang, barang.nama_barang, barang.kode_barang, satuan.nama_satuan')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->where(['barang.jenis_barang' => $id])
            ->where(['tipe_barang.status_tipe_barang' => '1'])
            ->findAll();
    }
}