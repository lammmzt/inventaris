<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\tipeBarangModel;
use App\Models\barangModel;
use Ramsey\Uuid\Uuid;

class tipeBarangController extends BaseController
{
    protected $tipeBarangModel;
    protected $barangModel;

    public function __construct()
    {
        $this->tipeBarangModel = new tipeBarangModel();
        $this->barangModel = new barangModel();
    }

    public function index()
    {
        $id_barang = $this->request->getUri()->getSegment(4);
        // dd($id_barang);
        $data_barang = $this->barangModel->getBarang($id_barang);
        if ($data_barang == null) {
            return redirect()->to(base_url('Admin/Barang'));    
        }
        $data = [
            'main_menu' => 'Data Barang',
            'title' => 'Detail Barang',
            'active' => 'detail_barang',
            'id_barang' => $id_barang,
            'nama_barang' => $data_barang['nama_barang'],
            'jenis_barang' => $data_barang['jenis_barang'],
            'id_barang' => $data_barang['id_barang'],
        ];
        return view('Admin/Barang/tipe_barang', $data);
    }

    public function fetchAll(){
        $data = $this->tipeBarangModel->getTipeBarang()->where('status_tipe_barang', '1')->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    
    public function fetchTipeBarangByJenisBarang()
    {
        $jenis_barang = $this->request->getPost('jenis_barang');
        $data = $this->tipeBarangModel->getTipeBarangByJenisBarang($jenis_barang);
        if ($data == null) {
            return $this->response->setJSON([
                'error' => true,
                'data' => 'Data tidak ditemukan',
                'status' => '404'
            ]);
        }else{
            return $this->response->setJSON([
                'error' => false,
                'data' => $data,
                'status' => '200'
            ]);
        }
    }
    
    public function fetchTipeBarangByIdBarang()
    {
        $id_barang = $this->request->getPost('id_barang');
        $data = $this->tipeBarangModel->getTipeBarangByBarang($id_barang);
        if ($data == null) {
            return $this->response->setJSON([
                'error' => true,
                'data' => 'Data tidak ditemukan',
                'status' => '404'
            ]);
        }else{
            return $this->response->setJSON([
                'error' => false,
                'data' => $data,
                'status' => '200'
            ]);
        }
    }

    public function ajaxDataTables()
    {
        $id_barang = $this->request->getPost('id_barang');
        $builder = $this->tipeBarangModel->getTipeBarangByBarang($id_barang);
        return DataTable::of($builder)
            ->add('status_tipe_barang', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_tipe_barang == '1' ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_tipe_barang " data-size="small" data-color="#0099ff" id="'.$row->id_tipe_barang.'"> <label class="custom-control-label" for="'.$row->id_tipe_barang.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item edit_tipe_barang" id="' . $row->id_tipe_barang . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_tipe_barang" id="' . $row->id_tipe_barang . '"><i class="dw dw-delete-3"></i> Delete</button>
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
            'nama_tipe_barang' => [
                'label' => 'Nama Tipe Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'id_barang' => [
                'label' => 'Jenis tipeBarang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'id_satuan' => [
                'label' => 'Satuan',
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
                'id_tipe_barang' => Uuid::uuid4()->toString(),
                'id_barang' => $this->request->getPost('id_barang'),
                'nama_tipe_barang' => $this->request->getPost('nama_tipe_barang'),
                'id_satuan' => $this->request->getPost('id_satuan'),
                'status_tipe_barang' => '1',
            ];
            $this->tipeBarangModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_tipe_barang = $this->request->getPost('id_tipe_barang');
        $data = $this->tipeBarangModel->find($id_tipe_barang);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_tipe_barang' => [
                'label' => 'Nama tipeBarang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'id_satuan' => [
                'label' => 'Satuan',
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
                'id_tipe_barang' => $this->request->getPost('id_tipe_barang'),
                'nama_tipe_barang' => $this->request->getPost('nama_tipe_barang'),
                'id_satuan' => $this->request->getPost('id_satuan'),
            ];
            $this->tipeBarangModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_tipe_barang = $this->request->getPost('id_tipe_barang');
        $this->tipeBarangModel->delete($id_tipe_barang);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_tipe_barang = $this->request->getPost('id_tipe_barang');

        $status_tipe_barang = $this->tipeBarangModel->find($id_tipe_barang);
        $data = [
            'status_tipe_barang' => $status_tipe_barang['status_tipe_barang'] == 1 ? '0' : '1',
        ];
        $this->tipeBarangModel->update($id_tipe_barang, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }
}

?>