<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\inventarisModel;
use Ramsey\Uuid\Uuid;

class inventarisController extends BaseController
{
    protected $inventarisModel;

    public function __construct()
    {
        $this->inventarisModel = new inventarisModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Inventaris',
            'title' => 'Data inventaris',
            'active' => 'Inventaris',
        ];
        return view('Admin/Inventaris/index', $data);
    }

    public function fetchAll()
    {
        $data = $this->inventarisModel->getinventaris()->where(['status_inventaris' => '1'])->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

    public function ajaxDataTables()
    {
        $builder = $this->inventarisModel->getinventaris();
        // dd($builder);
        return DataTable::of($builder)
            ->add('nama_barang', function ($row) {
                return $row->nama_barang. ' - ' .$row->nama_tipe_barang;
            })
            ->add('status_inventaris', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_inventaris == 1 ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_inventaris" data-size="small" data-color="#0099ff" id="'.$row->id_inventaris.'"> <label class="custom-control-label" for="'.$row->id_inventaris.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item edit_inventaris" id="' . $row->id_inventaris . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_inventaris" id="' . $row->id_inventaris . '"><i class="dw dw-delete-3"></i> Delete</button>
                        </div>
                </div>
                ';
            }, 'last')
            ->toJson(true);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $tipe_barang_id = $this->request->getPost('tipe_barang_id');
        $merek_inventaris = $this->request->getPost('merek_inventaris');
        $data_merk_by_tipe = $this->inventarisModel->where('tipe_barang_id', $tipe_barang_id)->where('merek_inventaris', $merek_inventaris)->countAllResults();
        
        // dd($data_merk_by_tipe);
        
        if($data_merk_by_tipe > 0){
           $rules = 'required|is_unique[inventaris.merek_inventaris]';
        }else{
            $rules = 'required';
        }

        // dd($rules);  
        
        $validation->setRules([
            'merek_inventaris' => [
                'label' => 'Merek inventaris',
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada di tipe barang yang sama',
                ],
            ],
            'satuan_id' => [
                'label' => 'Satuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tipe_barang_id' => [
                'label' => 'Tipe Barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'qty_inventaris' => [
                'label' => 'Qyt inventaris',
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
                'id_inventaris' => Uuid::uuid4()->toString(),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'satuan_id' => $this->request->getPost('satuan_id'),
                'merek_inventaris' => $this->request->getPost('merek_inventaris'),
                'status_inventaris' => '1',
            ];
            $this->inventarisModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_inventaris = $this->request->getPost('id_inventaris');
        $data = $this->inventarisModel->getinventaris($id_inventaris);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $merek_inventaris_old = $this->inventarisModel->find($this->request->getPost('id_inventaris'));
        
        $tipe_barang_id = $this->request->getPost('tipe_barang_id');
        $merek_inventaris = $this->request->getPost('merek_inventaris');
        $data_merk_by_tipe = $this->inventarisModel->where('tipe_barang_id', $tipe_barang_id)->where('merek_inventaris', $merek_inventaris)->countAllResults();
        
        if($merek_inventaris_old['merek_inventaris'] == $merek_inventaris){
            $is_unique = '';
        }else{
            if($data_merk_by_tipe > 0){
                $is_unique = '|is_unique[inventaris.merek_inventaris]';
            }else{
                $is_unique = '';
            }
        }
        $validation->setRules([
            'merek_inventaris' => [
                'label' => 'Merek inventaris',
                'rules' => 'required'.$is_unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada di tipe barang yang sama',
                ],
            ],
            'satuan_id' => [
                'label' => 'Satuan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tipe_barang_id' => [
                'label' => 'Tipe Barang',
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
                'id_inventaris' => $this->request->getPost('id_inventaris'),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'qty_inventaris' => $this->request->getPost('qty_inventaris'),
                'satuan_id' => $this->request->getPost('satuan_id'),
                'merek_inventaris' => $this->request->getPost('merek_inventaris'),
            ];
            $this->inventarisModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_inventaris = $this->request->getPost('id_inventaris');
        $this->inventarisModel->delete($id_inventaris);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_inventaris = $this->request->getPost('id_inventaris');

        $status_inventaris = $this->inventarisModel->find($id_inventaris);
        $data = [
            'status_inventaris' => $status_inventaris['status_inventaris'] == '1' ? '0' : '1',
        ];
        $this->inventarisModel->update($id_inventaris, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDatainventaris()
    {
        $id_inventaris = $this->request->getPost('id_inventaris');
        $data = $this->inventarisModel->find($id_inventaris);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>