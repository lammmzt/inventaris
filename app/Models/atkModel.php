<?php

namespace App\Models;

use CodeIgniter\Model;

class atkModel extends Model
{
    protected $table = 'atk';
    protected $primaryKey = 'id_atk';
    protected $allowedFields = [
        'id_atk',
        'satuan_id',
        'kode_atk',
        'nama_atk',
        'qty',
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
                ->select('atk.id_atk, atk.satuan_id, atk.kode_atk, atk.nama_atk, atk.qty, atk.status_atk, satuan.nama_satuan')
                ->join('satuan', 'satuan.id_satuan = atk.satuan_id');
        }
        return $this
            ->select('atk.id_atk, atk.satuan_id, atk.kode_atk, atk.nama_atk, atk.qty, atk.status_atk, satuan.nama_satuan')
            ->join('satuan', 'satuan.id_satuan = atk.satuan_id')
            ->where(['id_atk' => $id])
            ->first();
    }
}