<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\pengecekanModel;
use App\Models\inventarisModel;
use Ramsey\Uuid\Uuid;

class pengecekanController extends BaseController
{
    protected $pengecekanModel;
    protected $inventarisModel;

    public function __construct()
    {
        $this->inventarisModel = new inventarisModel();
        $this->pengecekanModel = new pengecekanModel();
    }

    public function index()
    {
        $data = [
            'main_menu' => 'Master Data',
            'title' => 'Data pengecekan',
            'active' => 'pengecekan',
        ];
        return view('Admin/Pengecekan/index', $data);
    }

    public function Pelaporan()
    {
        $data = [
            'main_menu' => 'Inventaris',
            'title' => 'Pelaporan',
            'active' => 'Pelaporan',
        ];
        return view('Admin/Pengecekan/Pelaporan', $data);
    }

    public function fetchAll(){
        $data = $this->pengecekanModel->getpengecekan()->where('status_pengecekan', '1')->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    
    public function fetchInventarisByKodeInventaris()
    {
        $kode_inventaris = $this->request->getPost('kode_inventaris');
        // $kode_inventaris = 'BRG-20240915-9622';
        $data_inventarus = $this->inventarisModel->getInventaris()->where(['kode_inventaris' => $kode_inventaris])->first();
        $data_pelaporan = $this->pengecekanModel->getpengecekan()->where(['inventaris_id' => $data_inventarus['id_inventaris']])->limit(5)->orderBy('id_pengecekan', 'DESC')->findAll();
        if( $data_inventarus != null){
            return $this->response->setJSON([
                'error' => false,
                'data' => [
                    'inventaris' => $data_inventarus,
                    'pelaporan' => $data_pelaporan
                ],
                'status' => '200'
            ]);
        }else{
            return $this->response->setJSON([
                'error' => true,
                'data' => 'Data tidak ditemukan',
                'status' => '404'
            ]);
        }
    }
    public function store()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'ket_pengecekan' => [
                'label' => 'Nama pengecekan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'status_pengecekan' => [
                'label' => 'Status pengecekan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'inventaris_id' => [
                'label' => 'Inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'data' => $validation->getErrors(),
                'status' => '422'
            ]);
        } else {
            $id_user = session()->get('id_user');
            // jika ada request file
            $file = $this->request->getFile('foto_pengecekan');
            $newName = '';
            
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('assets/uploads/pengecekan', $newName);
            }

            $data = [
                'ket_pengecekan' => $this->request->getPost('ket_pengecekan'),
                'status_pengecekan' => $this->request->getPost('status_pengecekan'),
                'inventaris_id' => $this->request->getPost('inventaris_id'),
                'foto_pengecekan' => $newName,
                'user_id' => $id_user,
            ];
            $this->inventarisModel->update($this->request->getPost('inventaris_id'), ['status_inventaris' => $this->request->getPost('status_pengecekan')]);
            $this->pengecekanModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_pengecekan = $this->request->getPost('id_pengecekan');
        $data = $this->pengecekanModel->find($id_pengecekan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }


    public function destroy()
    {
        $id_pengecekan = $this->request->getPost('id_pengecekan');
        $this->pengecekanModel->delete($id_pengecekan);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function fetchDatapengecekan()
    {
        $id_pengecekan = $this->request->getPost('id_pengecekan');
        $data = $this->pengecekanModel->find($id_pengecekan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>