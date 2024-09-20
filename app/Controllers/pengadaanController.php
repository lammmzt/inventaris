<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\pengadaanModel;
use App\Models\atkModel;
use App\Models\detailpengadaanModel;
use Ramsey\Uuid\Uuid;

class pengadaanController extends BaseController
{
    protected $pengadaanModel;
    protected $detailpengadaanModel;

    public function __construct()
    {
        $this->detailpengadaanModel = new detailpengadaanModel();
        $this->pengadaanModel = new pengadaanModel();
    }

    public function index()
    {
        $data = [
            'main_menu' => 'Pengadaan',
            'title' => 'Data pengadaan',
            'active' => 'Pengadaan',
        ];
        return view('Admin/Pengadaan/index', $data);
    }
    
    public function ajaxDataTables()
    {
        $builder = $this->pengadaanModel->getPengadaan();
       
        // dd($builder->findAll());
        return DataTable::of($builder)
             ->add('status_pengadaan', function ($row) {
                if($row->status_pengadaan == 1){
                    return '<span class="badge badge-secondary">Permintaan</span>';
                }else if($row->status_pengadaan == 2){
                    return '<span class="badge badge-warning">Proses</span>';
                }else if($row->status_pengadaan == 3){
                    return '<span class="badge badge-success">Pengadaan</span>';
                }else if($row->status_pengadaan == 4){
                    return '<span class="badge badge-info">Selesai</span>';
                }else{
                    return '<span class="badge badge-danger">Ditolak</span>';
                }
                
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>    
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        '.($row->status_pengadaan == '1' ? '<a class="dropdown-item " id="' . $row->id_pengadaan . '" href="' . base_url('Admin/Pengadaan/Masuk/' . $row->id_pengadaan) . '"><i class="dw dw-edit2"></i> Edit</a>
                        ' : '').'
                        <button class="dropdown-item detail_pengadaan" id="' . $row->id_pengadaan . '"><i class="dw dw-eye"></i> Detail</button>
                        </div>
                </div>
                ';
            }, 'last')
            ->toJson(true);
    }
    
    public function fetchAll(){
        $data = $this->pengadaanModel->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function tambah_pengadaan()
    {
        $data = [
            'main_menu' => 'Pengadaan',
            'title' => 'Tambah pengadaan',
            'active' => 'Pengadaan',
        ];
        return view('Admin/Pengadaan/tambah_pengadaan', $data);
    }

    public function edit()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        $data = $this->pengadaanModel->getpengadaan($id_pengadaan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    public function updateTransMasuk()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'ket_pengadaan' => [
                'label' => 'Keterangan pengadaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tanggal_pengadaan' => [
                'label' => 'Tanggal pengadaan',
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
            $data = [
                'ket_pengadaan' => $this->request->getPost('ket_pengadaan'),
                'tanggal_pengadaan' => $this->request->getPost('tanggal_pengadaan'),
            ];
            
            $this->pengadaanModel->update($id_pengadaan, $data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diubah',
                'status' => '200'
            ]);
        }
    }

    public function updateTransKeluar()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'ket_pengadaan' => [
                'label' => 'Keterangan pengadaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tanggal_pengadaan' => [
                'label' => 'Tanggal pengadaan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'user_id' => [
                'label' => 'Nama Pengguna',
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
            $data = [
                'user_id' => $this->request->getPost('user_id'),
                'ket_pengadaan' => $this->request->getPost('ket_pengadaan'),
                'tanggal_pengadaan' => $this->request->getPost('tanggal_pengadaan'),
            ];
            
            $this->pengadaanModel->update($id_pengadaan, $data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diubah',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        $this->pengadaanModel->delete($id_pengadaan);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    

}

?>