<?php

namespace App\Models;

use CodeIgniter\Model;

class atkModel extends Model
{
    protected $table = 'atk';
    protected $primaryKey = 'id_atk';
    protected $allowedFields = [
        'id_atk',
        'tipe_barang_id',
        'satuan_id',
        'kode_atk',
        'merek_atk',
        'qty_atk',
        'status_atk',
        'created_at',
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getAtk($id = false)
    {
        if ($id == false) {
            return $this
                ->select('atk.id_atk, atk.satuan_id, atk.kode_atk, atk.merek_atk, atk.qty_atk, atk.status_atk, atk.tipe_barang_id, atk.satuan_id, satuan.nama_satuan, tipe_barang.nama_tipe_barang, barang.nama_barang')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = atk.tipe_barang_id')
                ->join('barang', 'barang.id_barang = tipe_barang.barang_id')
                ->join('satuan', 'satuan.id_satuan = atk.satuan_id');
        }
        return $this
            ->select('atk.id_atk, atk.satuan_id, atk.tipe_barang_id, atk.satuan_id, atk.kode_atk, atk.merek_atk, atk.qty_atk, atk.status_atk, satuan.nama_satuan, tipe_barang.nama_tipe_barang, barang.nama_barang')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = atk.tipe_barang_id')
            ->join('barang', 'barang.id_barang = tipe_barang.barang_id')
            ->join('satuan', 'satuan.id_satuan = atk.satuan_id')
            ->where(['id_atk' => $id])
            ->first();
    }
}