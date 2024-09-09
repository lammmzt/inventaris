<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\barangModel;
use Ramsey\Uuid\Uuid;

class barangController extends BaseController
{
    protected $barangModel;

    public function __construct()
    {
        $this->barangModel = new barangModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Master Data',
            'title' => 'Data Barang',
            'active' => 'Barang',
        ];
        return view('Admin/Barang/index', $data);
    }

    public function ajaxDataTables()
    {
        $builder = $this->barangModel->getBarang();
        // dd($builder);
        return DataTable::of($builder)
            ->add('jenis_barang', function ($row) {
                // jika jenis_barang = 1 maka label inventaris dan sebaliknya atk
                return $row->jenis_barang == 1 ? '<span class="badge badge-primary">Inventaris</span>' : '<span class="badge badge-success">ATK</span>';
            })
            ->add('status_barang', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_barang == 1 ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_barang " data-size="small" data-color="#0099ff" id="'.$row->id_barang.'"> <label class="custom-control-label" for="'.$row->id_barang.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item view_barang" id="' . $row->id_barang . '"><i class="dw dw-eye"></i> View</a>
                            <button class="dropdown-item edit_barang" id="' . $row->id_barang . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_barang" id="' . $row->id_barang . '"><i class="dw dw-delete-3"></i> Delete</button>
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
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required|is_unique[barang.nama_barang]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'jenis_barang' => [
                'label' => 'Jenis Barang',
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
            if($this->request->getPost('jenis_barang') == '1'){
                $kode_barang = 'INV-'.date('Ymd').'-'.rand(100,999);
            }else{
                $kode_barang = 'ATK-'.date('Ymd').'-'.rand(100,999);
            }
            $data = [
                'id_barang' => Uuid::uuid4()->toString(),
                'kode_barang' => $kode_barang,
                'nama_barang' => $this->request->getPost('nama_barang'),
                'jenis_barang' => $this->request->getPost('jenis_barang'),
                'status_barang' => '1',
            ];
            $this->barangModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_barang = $this->request->getPost('id_barang');
        $data = $this->barangModel->find($id_barang);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $nama_barang_old = $this->barangModel->find($this->request->getPost('id_barang'));
        if ($this->request->getPost('nama_barang') == $nama_barang_old['nama_barang']) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[barang.nama_barang]';
        }
        $validation->setRules([
            'nama_barang' => [
                'label' => 'Nama Barang',
                'rules' => 'required'.$is_unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'jenis_barang' => [
                'label' => 'Jenis Barang',
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
                'id_barang' => $this->request->getPost('id_barang'),
                'nama_barang' => $this->request->getPost('nama_barang'),
                'jenis_barang' => $this->request->getPost('jenis_barang'),
            ];
            $this->barangModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_barang = $this->request->getPost('id_barang');
        $this->barangModel->delete($id_barang);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_barang = $this->request->getPost('id_barang');

        $status_barang = $this->barangModel->find($id_barang);
        $data = [
            'status_barang' => $status_barang['status_barang'] == 1 ? '0' : '1',
        ];
        $this->barangModel->update($id_barang, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDataBarang()
    {
        $id_barang = $this->request->getPost('id_barang');
        $data = $this->barangModel->find($id_barang);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>