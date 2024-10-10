<?php

namespace App\Models;

use CodeIgniter\Model;

class atkModel extends Model
{
    protected $table = 'atk';
    protected $primaryKey = 'id_atk';
    protected $allowedFields = [
        'id_atk',
        'id_tipe_barang',
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
                ->select('atk.id_atk, atk.merek_atk, atk.qty_atk, atk.status_atk, atk.id_tipe_barang, satuan.nama_satuan, tipe_barang.nama_tipe_barang, barang.nama_barang')
                ->join('tipe_barang', 'tipe_barang.id_tipe_barang = atk.id_tipe_barang')
                ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
                ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan');
        }
        return $this
            ->select('atk.id_atk, atk.id_tipe_barang, atk.merek_atk, atk.qty_atk, atk.status_atk, satuan.nama_satuan, tipe_barang.nama_tipe_barang, barang.nama_barang')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = atk.id_tipe_barang')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->where(['id_atk' => $id])
            ->first();
    }
}