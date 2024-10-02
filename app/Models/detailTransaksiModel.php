<?php

namespace App\Models;

use CodeIgniter\Model;

class detailTransaksiModel extends Model
{
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id_detail_transaksi';
    protected $allowedFields = [
        'id_detail_transaksi',
        'id_transaksi',
        'id_atk',
        'qty',
        'status_detail_transaksi',
        'catatan_detail_transaksi',
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
                ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.id_transaksi, detail_transaksi.id_atk, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi, detail_transaksi.catatan_detail_transaksi')
                ->join('atk', 'atk.id_atk = detail_transaksi.id_atk')
                ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi');
        }
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.id_transaksi, detail_transaksi.id_atk, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi, detail_transaksi.catatan_detail_transaksi')
            ->join('atk', 'atk.id_atk = detail_transaksi.id_atk')
            ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
            ->where(['id_detail_transaksi' => $id])
            ->first();
    }

    public function getTransByTransId($id)
    {
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.id_transaksi, detail_transaksi.id_atk, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi, tipe_barang.nama_tipe_barang, barang.nama_barang, satuan.nama_satuan, detail_transaksi.catatan_detail_transaksi, atk.qty_atk')
            ->join('atk', 'atk.id_atk = detail_transaksi.id_atk')
            ->join('tipe_barang', 'tipe_barang.id_tipe_barang = atk.id_tipe_barang')
            ->join('barang', 'barang.id_barang = tipe_barang.id_barang')
            ->join('satuan', 'satuan.id_satuan = tipe_barang.id_satuan')
            ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
            ->where(['detail_transaksi.id_transaksi' => $id]);
    }

    public function getDataInYear($year)
    {
        return $this
            ->select('detail_transaksi.id_detail_transaksi, detail_transaksi.id_transaksi, detail_transaksi.id_atk, detail_transaksi.qty, atk.merek_atk, transaksi.tanggal_transaksi, detail_transaksi.status_detail_transaksi, detail_transaksi.catatan_detail_transaksi, transaksi.tipe_transaksi')
            ->join('atk', 'atk.id_atk = detail_transaksi.id_atk')
            ->join('transaksi', 'transaksi.id_transaksi = detail_transaksi.id_transaksi')
            ->where('YEAR(transaksi.tanggal_transaksi)', $year)
            ->where('transaksi.status_transaksi', '4')
            ->where('detail_transaksi.status_detail_transaksi', '1')
            ->findAll();
    }
}