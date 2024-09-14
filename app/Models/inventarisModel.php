<?php

namespace App\Models;

use CodeIgniter\Model;

class inventarisModel extends Model
{
    protected $table = 'inventaris';
    protected $primaryKey = 'id_inventaris';
    protected $allowedFields = [
        'id_inventaris',
        'tipe_barang_id',
        'satuan_id',
        'ruangan_id',
        'kode_inventaris',
        'nama_inventaris',
        'qty_inventaris',
        'spek_inventaris',
        'status_inventaris',
        'perolehan_inventaris',
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
            return $this->select('inventaris.id_inventaris, inventaris.tipe_barang_id, inventaris.ruangan_id, inventaris.kode_inventaris, inventaris.nama_inventaris, inventaris.qty_inventaris, inventaris.qr_code,inventaris.spek_inventaris, inventaris.status_inventaris, inventaris.perolehan_inventaris, inventaris.sumber_inventaris, tipe_barang.nama_tipe_barang, satuan.nama_satuan, ruangan.nama_ruangan, barang.nama_barang')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = inventaris.tipe_barang_id')
                ->join('barang', 'barang.id_barang = tipe_barang.barang_id')
                ->join('satuan', 'satuan.id_satuan = tipe_barang.satuan_id')
                ->join('ruangan', 'ruangan.id_ruangan = inventaris.ruangan_id');
            
        }else{
            return $this
                ->select('inventaris.id_inventaris, inventaris.tipe_barang_id, inventaris.ruangan_id, inventaris.kode_inventaris, inventaris.nama_inventaris, inventaris.qty_inventaris, inventaris.qr_code,inventaris.spek_inventaris, inventaris.status_inventaris, inventaris.perolehan_inventaris, inventaris.sumber_inventaris, tipe_barang.nama_tipe_barang, satuan.nama_satuan, ruangan.nama_ruangan, barang.nama_barang')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = inventaris.tipe_barang_id')
                ->join('barang', 'barang.id_barang = tipe_barang.barang_id')
                ->join('satuan', 'satuan.id_satuan = tipe_barang.satuan_id')
                ->join('ruangan', 'ruangan.id_ruangan = inventaris.ruangan_id')
                ->where(['id_inventaris' => $id])->first();
        }
        
    }
}