<?php

namespace App\Models;

use CodeIgniter\Model;

class detailPengadaanModel extends Model
{
    protected $table = 'detail_pengadaan';
    protected $primaryKey = 'id_detail_pengadaan';
    protected $allowedFields = [
        'id_detail_pengadaan',
        'pengadaan_id',
        'tipe_barang_id',
        'qty',
        'spek',
        'status_detail_pengadaan',
        'jenis_detail_pengadaan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getDetailPengadaan($id = false)
    {
        if ($id == false) {
            return $this->select('detail_pengadaan.id_detail_pengadaan, detail_pengadaan.pengadaan_id, detail_pengadaan.tipe_barang_id, detail_pengadaan.qty, detail_pengadaan.spek, detail_pengadaan.status_detail_pengadaan, detail_pengadaan.jenis_detail_pengadaan, pengadaan.kode_pengadaan, tipe_barang.nama_tipe_barang')
                ->join('pengadaan', 'pengadaan.id_pengadaan = detail_pengadaan.pengadaan_id')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = detail_pengadaan.tipe_barang_id');
        }
        return $this->select('detail_pengadaan.id_detail_pengadaan, detail_pengadaan.pengadaan_id, detail_pengadaan.tipe_barang_id, detail_pengadaan.qty, detail_pengadaan.spek, detail_pengadaan.status_detail_pengadaan, detail_pengadaan.jenis_detail_pengadaan, pengadaan.kode_pengadaan, tipe_barang.nama_tipe_barang')
            ->join('pengadaan', 'pengadaan.id_pengadaan = detail_pengadaan.pengadaan_id')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = detail_pengadaan.tipe_barang_id')
            ->where(['id_detail_pengadaan' => $id])
            ->first();
    }
}
