<?php

namespace App\Models;

use CodeIgniter\Model;

class detailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $allowedFields = [
        'id_detail_transaksi',
        'transaksi_id',
        'atk_id',
        'qty',
        'status_detail_transaksi',
        'created_at',
        'updated_at'
    ];
    // protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getDetailTransaksi($id = false)
    {
        if ($id == false) {
            return $this
                ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.transaksi_id, detail_transaksi.atk_id, detail_transaksi.qty, atk.nama_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi')
                ->join('atk', 'atk.id_atk = detail_transaksi.atk_id')
                ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id');
        }
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.transaksi_id, detail_transaksi.atk_id, detail_transaksi.qty, atk.nama_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi')
            ->join('atk', 'atk.id_atk = detail_transaksi.atk_id')
            ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id')
            ->where(['id_detail_transaksi' => $id])
            ->first();
    }

    public function getTransMasukByTransId($id)
    {
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.transaksi_id, detail_transaksi.atk_id, detail_transaksi.qty, atk.nama_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi')
            ->join('atk', 'atk.id_atk = detail_transaksi.atk_id')
            ->join('transaksi', 'transaksi.id_transaksi')
            ->where(['transaksi_id' => $id])
            ->findAll();
    }
}