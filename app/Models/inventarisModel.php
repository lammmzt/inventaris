<?php

namespace App\Models;

use CodeIgniter\Model;

class inventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $allowedFields = [
        'id_inventaris',
        'id_tipe_barang',
        'id_satuan',
        'id_ruangan',
        'kode_inventaris',
        'nama_inventaris',
        'qty_inventaris',
        'spek_inventaris',
        'status_inventaris',
        'perolehan_inventaris',
        'harga_inventaris',
        'sumber_inventaris',
        'qr_code',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getInventaris($id = false)
    {
        if ($id == false) {
            return $this->select('inventaris.id_inventaris, inventaris.id_tipe_barang, inventaris.id_ruangan, inventaris.harga_inventaris, inventaris.kode_inventaris, inventaris.nama_inventaris, inventaris.qty_inventaris, inventaris.qr_code,inventaris.spek_inventaris, inventaris.status_inventaris, inventaris.perolehan_inventaris, inventaris.sumber_inventaris, tipe_barang.nama_tipe_barang, satuan.nama_satuan, ruangan.nama_ruangan, barang.nama_barang')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = inventaris.id_tipe_barang')
                ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
                ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
                ->join('ruangan', 'ruangan.id_ruangan = inventaris.id_ruangan');
            
        }else{
            return $this
                ->select('inventaris.id_inventaris, inventaris.id_tipe_barang, inventaris.id_ruangan, inventaris.harga_inventaris,inventaris.kode_inventaris, inventaris.nama_inventaris, inventaris.qty_inventaris, inventaris.qr_code,inventaris.spek_inventaris, inventaris.status_inventaris, inventaris.perolehan_inventaris, inventaris.sumber_inventaris, tipe_barang.nama_tipe_barang, satuan.nama_satuan, ruangan.nama_ruangan, barang.nama_barang')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = inventaris.id_tipe_barang')
                ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
                ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
                ->join('ruangan', 'ruangan.id_ruangan = inventaris.id_ruangan')
                ->where(['id_inventaris' => $id])->first();
        }
        
    }
}