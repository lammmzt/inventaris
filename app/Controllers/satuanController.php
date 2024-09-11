<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\satuanModel;
use Ramsey\Uuid\Uuid;

class satuanController extends BaseController
{
    protected $satuanModel;

    public function __construct()
    {
        $this->satuanModel = new satuanModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Master Data',
            'title' => 'Data Satuan',
            'active' => 'Satuan',
        ];
        return view('Admin/Satuan/index', $data);
    }

    public function fetchAll(){
        $data = $this->satuanModel->getsatuan()->where('status_satuan', '1')->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function ajaxDataTables()
    {
        $builder = $this->satuanModel->getsatuan();
        // dd($builder);
        return DataTable::of($builder)
            ->add('status_satuan', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_satuan == 1 ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_satuan " data-size="small" data-color="#0099ff" id="'.$row->id_satuan.'"> <label class="custom-control-label" for="'.$row->id_satuan.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item edit_satuan" id="' . $row->id_satuan . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_satuan" id="' . $row->id_satuan . '"><i class="dw dw-delete-3"></i> Delete</button>
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
            'nama_satuan' => [
                'label' => 'Nama satuan',
                'rules' => 'required|is_unique[satuan.nama_satuan]',
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
                'id_satuan' => Uuid::uuid4()->toString(),
                'nama_satuan' => $this->request->getPost('nama_satuan'),
                'status_satuan' => '1',
            ];
            $this->satuanModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_satuan = $this->request->getPost('id_satuan');
        $data = $this->satuanModel->find($id_satuan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $nama_satuan_old = $this->satuanModel->find($this->request->getPost('id_satuan'));
        if ($this->request->getPost('nama_satuan') == $nama_satuan_old['nama_satuan']) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[satuan.nama_satuan]';
        }
        $validation->setRules([
            'nama_satuan' => [
                'label' => 'Nama satuan',
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
                'id_satuan' => $this->request->getPost('id_satuan'),
                'nama_satuan' => $this->request->getPost('nama_satuan'),
            ];
            $this->satuanModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_satuan = $this->request->getPost('id_satuan');
        $this->satuanModel->delete($id_satuan);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_satuan = $this->request->getPost('id_satuan');

        $status_satuan = $this->satuanModel->find($id_satuan);
        $data = [
            'status_satuan' => $status_satuan['status_satuan'] == 1 ? '0' : '1',
        ];
        $this->satuanModel->update($id_satuan, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDatasatuan()
    {
        $id_satuan = $this->request->getPost('id_satuan');
        $data = $this->satuanModel->find($id_satuan);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>