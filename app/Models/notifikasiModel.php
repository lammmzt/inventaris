<?php

namespace App\Models;

use CodeIgniter\Model;

class notifikasiModel extends Model
{
    protected $table = 'notifikasi';
    protected $primaryKey = 'id_notifikasi';
    protected $allowedFields = ['id_notifikasi', 'pengirim_notifikasi','isi_notifikasi', 'penerima_notifikasi', 'status_notifikasi', 'created_at', 'updated_at'];


    public function getActiveNotifikasi($id_user)
    {
        return $this
            ->where('penerima_notifikasi', $id_user)
            ->where('status_notifikasi', '1')
            ->orderBy('created_at', 'DESC')
            ->findAll();
    }
}