<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\ruanganModel;
use Ramsey\Uuid\Uuid;

class ruanganController extends BaseController
{
    protected $ruanganModel;

    public function __construct()
    {
        $this->ruanganModel = new ruanganModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Master Data',
            'title' => 'Data Ruangan',
            'active' => 'Ruangan',
        ];
        return view('Admin/Ruangan/index', $data);
    }

    public function fetchAll(){
        $data = $this->ruanganModel->getRuangan()->where('status_ruangan', '1')->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function ajaxDataTables()
    {
        $builder = $this->ruanganModel->getruangan();
        // dd($builder);
        return DataTable::of($builder)
            ->add('status_ruangan', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_ruangan == 1 ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_ruangan " data-size="small" data-color="#0099ff" id="'.$row->id_ruangan.'"> <label class="custom-control-label" for="'.$row->id_ruangan.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item edit_ruangan" id="' . $row->id_ruangan . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_ruangan" id="' . $row->id_ruangan . '"><i class="dw dw-delete-3"></i> Delete</button>
                        </div>
                </div>
                ';
            }, 'last')
            ->toJson(true);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_ruangan' => [
                'label' => 'Nama ruangan',
                'rules' => 'required|is_unique[ruangan.nama_ruangan]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
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
                'id_ruangan' => Uuid::uuid4()->toString(),
                'nama_ruangan' => $this->request->getPost('nama_ruangan'),
                'status_ruangan' => '1',
            ];
            $this->ruanganModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $data = $this->ruanganModel->find($id_ruangan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $nama_ruangan_old = $this->ruanganModel->find($this->request->getPost('id_ruangan'));
        if ($this->request->getPost('nama_ruangan') == $nama_ruangan_old['nama_ruangan']) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[ruangan.nama_ruangan]';
        }
        $validation->setRules([
            'nama_ruangan' => [
                'label' => 'Nama ruangan',
                'rules' => 'required'.$is_unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
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
                'id_ruangan' => $this->request->getPost('id_ruangan'),
                'nama_ruangan' => $this->request->getPost('nama_ruangan'),
            ];
            $this->ruanganModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $this->ruanganModel->delete($id_ruangan);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');

        $status_ruangan = $this->ruanganModel->find($id_ruangan);
        $data = [
            'status_ruangan' => $status_ruangan['status_ruangan'] == 1 ? '0' : '1',
        ];
        $this->ruanganModel->update($id_ruangan, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDataRuangan()
    {
        $id_ruangan = $this->request->getPost('id_ruangan');
        $data = $this->ruanganModel->find($id_ruangan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>