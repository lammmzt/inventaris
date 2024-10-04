<?php

namespace App\Models;

use CodeIgniter\Model;

class transaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = [
        'id_transaksi',
        'id_user',
        'tipe_transaksi',
        'ket_transaksi',
        'status_transaksi',
        'tanggal_transaksi',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getTransaksi($id = false)
    {
        if ($id == false) {
            return $this
                ->select('transaksi.id_transaksi, transaksi.id_user, transaksi.tipe_transaksi, transaksi.ket_transaksi, transaksi.status_transaksi, transaksi.tanggal_transaksi, users.nama_user')
                ->join('users', 'users.id_user = transaksi.id_user');
        }
        return $this
            ->select('transaksi.id_transaksi, transaksi.id_user, transaksi.tipe_transaksi, transaksi.ket_transaksi, transaksi.status_transaksi, transaksi.tanggal_transaksi, users.nama_user')
            ->join('users', 'users.id_user = transaksi.id_user')
            ->where(['id_transaksi' => $id])->first();
    }


    public function getTransaksiMasuk()
    {
        return $this
            ->select('transaksi.id_transaksi, transaksi.id_user, transaksi.tipe_transaksi, transaksi.ket_transaksi, transaksi.status_transaksi, transaksi.tanggal_transaksi, users.nama_user') 
            ->join('users', 'users.id_user = transaksi.id_user')
            ->where('tipe_transaksi', '0');
    }

    public function getTransaksiKeluar()
    {
        return $this
            ->select('transaksi.id_transaksi, transaksi.id_user, transaksi.tipe_transaksi, transaksi.ket_transaksi, transaksi.status_transaksi, transaksi.tanggal_transaksi, users.nama_user')
            ->join('users', 'users.id_user = transaksi.id_user')
            ->where('tipe_transaksi', '1');
    }

    public function getTransActive(){
         return $this
                ->select('transaksi.id_transaksi, transaksi.id_user, transaksi.tipe_transaksi, transaksi.ket_transaksi, transaksi.status_transaksi, transaksi.tanggal_transaksi, users.nama_user')
                ->join('users', 'users.id_user = transaksi.id_user')
                ->where('status_transaksi', '1')
                ->orWhere('status_transaksi', '2')
                ->orWhere('status_transaksi', '3');
    }
}