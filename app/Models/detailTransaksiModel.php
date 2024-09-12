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
                ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.transaksi_id, detail_transaksi.atk_id, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi')
                ->join('atk', 'atk.id_atk = detail_transaksi.atk_id')
                ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id');
        }
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.transaksi_id, detail_transaksi.atk_id, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi')
            ->join('atk', 'atk.id_atk = detail_transaksi.atk_id')
            ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id')
            ->where(['id_detail_transaksi' => $id])
            ->first();
    }

    public function getTransMasukByTransId($id)
    {
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.transaksi_id, detail_transaksi.atk_id, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi, tipe_barang.nama_tipe_barang, barang.nama_barang, satuan.nama_satuan')
            ->join('atk', 'atk.id_atk = detail_transaksi.atk_id')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = atk.tipe_barang_id')
            ->join('barang', 'barang.id_barang = tipe_barang.barang_id')
            ->join('satuan', 'satuan.id_satuan = atk.satuan_id')
            ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.transaksi_id')
            ->where(['transaksi_id' => $id]);
    }
}