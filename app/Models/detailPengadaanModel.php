<?php

namespace App\Models;

use CodeIgniter\Model;

class detailPengadaanModel extends Model
{
    protected $table = 'detail_pengadaan';
    protected $primaryKey = 'id_detail_pengadaan';
    protected $allowedFields = [
        'id_detail_pengadaan',
        'id_pengadaan',
        'id_tipe_barang',
        'qty',
        'spek',
        'status_detail_pengadaan',
        'catatan_detail_pengadaan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getDetailPengadaan($id = false)
    {
        if ($id == false) {
            return $this
            ->select('detail_pengadaan.id_detail_pengadaan, detail_pengadaan.id_pengadaan, detail_pengadaan.id_tipe_barang, detail_pengadaan.qty, detail_pengadaan.spek, detail_pengadaan.catatan_detail_pengadaan, detail_pengadaan.status_detail_pengadaan, tipe_barang.nama_tipe_barang, barang.nama_barang, satuan.nama_satuan')
            ->join('pengadaan', 'pengadaan.id_pengadaan = detail_pengadaan.id_pengadaan')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = detail_pengadaan.id_tipe_barang')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan');
        }
        return $this
            ->select('detail_pengadaan.id_detail_pengadaan, detail_pengadaan.id_pengadaan, detail_pengadaan.id_tipe_barang, detail_pengadaan.qty, detail_pengadaan.spek,detail_pengadaan.catatan_detail_pengadaan, detail_pengadaan.status_detail_pengadaan, tipe_barang.nama_tipe_barang, barang.nama_barang, satuan.nama_satuan')
            ->join('pengadaan', 'pengadaan.id_pengadaan = detail_pengadaan.id_pengadaan')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = detail_pengadaan.id_tipe_barang')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->where(['id_detail_pengadaan' => $id])
            ->first();
    }

    public function getDetailPengadaanByID($id){
        return $this
             ->select('detail_pengadaan.id_detail_pengadaan, detail_pengadaan.id_pengadaan, detail_pengadaan.id_tipe_barang, detail_pengadaan.qty, detail_pengadaan.spek, detail_pengadaan.catatan_detail_pengadaan, detail_pengadaan.status_detail_pengadaan, tipe_barang.nama_tipe_barang, barang.nama_barang, satuan.nama_satuan')
            ->join('pengadaan', 'pengadaan.id_pengadaan = detail_pengadaan.id_pengadaan')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = detail_pengadaan.id_tipe_barang')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->where(['detail_pengadaan.id_pengadaan' => $id]);
    }
}