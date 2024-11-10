<?php 

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\notifikasiModel;
use App\Models\usersModel;

class notifikasiController extends BaseController
{
    protected $notifikasiModel;

    public function __construct()
    {
        $this->notifikasiModel = new notifikasiModel();
        $this->usersModel = new usersModel();
    }

    public function fetchNotifikasi()
    {
        $id_user = session()->get('id_user');
        $notifikasi = $this->notifikasiModel->getActiveNotifikasi($id_user);
        return $this->response->setJSON([
            'error' => false,
            'status' => '200',
            'data' => $notifikasi,
        ]);
    }

    public function createNotifikasi()
    {
        $pengirim = session()->get('nama_user') . ' (' . session()->get('role') . ')';
        $penerima = $this->request->getPost('penerima_notifikasi');
        $isi = $this->request->getPost('isi_notifikasi');
       
        if($penerima == ''){
            $role = $this->request->getPost('role');
            $users = $this->usersModel->getUsersByRole($role);
            foreach($users as $user){
                $this->notifikasiModel->save([
                    'pengirim_notifikasi' => $pengirim,
                    'penerima_notifikasi' => $user['id_user'],
                    'isi_notifikasi' => $isi,
                    'status_notifikasi' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
            }
            
            return $this->response->setJSON([
                'error' => false,
                'status' => '200',
                'message' => 'Notifikasi berhasil dikirim',
            ]);
        }else{
            $this->notifikasiModel->save([
                'pengirim_notifikasi' => $pengirim,
                'penerima_notifikasi' => $penerima,
                'isi_notifikasi' => $isi,
                'status_notifikasi' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            
            return $this->response->setJSON([
                'error' => false,
                'status' => '200',
                'message' => 'Notifikasi berhasil dikirim',
            ]);
        }
       
    }
    
    public function readNotifikasi()
    {
        $id_notifikasi = $this->request->getPost('id_notifikasi');
        $this->notifikasiModel->update($id_notifikasi, ['status_notifikasi' => '0', 'updated_at' => date('Y-m-d H:i:s')]);
        return $this->response->setJSON([
            'error' => false,
            'status' => '200',
            'message' => 'Notifikasi telah dibaca',
        ]);
    }
}
?>