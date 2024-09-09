<?php

namespace App\Models;

use CodeIgniter\Model;

class satuanModel extends Model
{
    protected $table = 'satuan';
    protected $primaryKey = 'id_satuan';
    protected $allowedFields = [
        'id_satuan',
        'nama_satuan',
        'status_satuan',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $useAutoIncrement = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';


    public function getSatuan($id = false)
    {
        if ($id == false) {
            return $this->select('id_satuan, nama_satuan, status_satuan');
        }
        return $this->select('id_satuan, nama_satuan, status_satuan')->where(['id_satuan' => $id])->first();
    }
}
