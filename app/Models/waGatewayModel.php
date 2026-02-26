<?php

namespace App\Models;

use CodeIgniter\Model;

class waGatewayModel extends Model
{
    protected $table = 'wa_gateway';
    protected $primaryKey = 'id_wa_gateway';
    protected $allowedFields = ['id_wa_gateway', 'nama_perangkat_wa_gateway', 'token_wa_gateway', 'status_wa_gateway', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getWaGateway($id = false)
    {
        if ($id == false) {
            return $this->select('id_wa_gateway, nama_perangkat_wa_gateway, token_wa_gateway, status_wa_gateway,created_at, updated_at');
        }
        return $this->where(['id_wa_gateway' => $id])->first();
    }

    public function getWaGatewayActive()
    {
        return $this->where('status_wa_gateway', '1')->first();
    }

}