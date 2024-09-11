<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\atkModel;
use Ramsey\Uuid\Uuid;

class atkController extends BaseController
{
    protected $atkModel;

    public function __construct()
    {
        $this->atkModel = new atkModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'ATK',
            'title' => 'Data ATK',
            'active' => 'ATK',
        ];
        return view('Admin/ATK/index', $data);
    }

    public function fetchAll()
    {
        $data = $this->atkModel->getAtk()->where(['status_atk' => '1'])->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

    public function ajaxDataTables()
    {
        $builder = $this->atkModel->getatk();
        // dd($builder);
        return DataTable::of($builder)
            ->add('status_atk', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_atk == 1 ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_atk" data-size="small" data-color="#0099ff" id="'.$row->id_atk.'"> <label class="custom-control-label" for="'.$row->id_atk.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item edit_atk" id="' . $row->id_atk . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_atk" id="' . $row->id_atk . '"><i class="dw dw-delete-3"></i> Delete</button>
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
        $merek_atk = $this->request->getPost('merek_atk');
        $data_merk_by_tipe = $this->atkModel->where('tipe_barang_id', $tipe_barang_id)->where('merek_atk', $merek_atk)->countAllResults();
        
        // dd($data_merk_by_tipe);
        
        if($data_merk_by_tipe > 0){
           $rules = 'required|is_unique[atk.merek_atk]';
        }else{
            $rules = 'required';
        }

        // dd($rules);  
        
        $validation->setRules([
            'merek_atk' => [
                'label' => 'Merek ATK',
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
            'qty_atk' => [
                'label' => 'Qyt ATK',
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
                'id_atk' => Uuid::uuid4()->toString(),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'satuan_id' => $this->request->getPost('satuan_id'),
                'merek_atk' => $this->request->getPost('merek_atk'),
                'status_atk' => '1',
            ];
            $this->atkModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_atk = $this->request->getPost('id_atk');
        $data = $this->atkModel->getAtk($id_atk);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $merek_atk_old = $this->atkModel->find($this->request->getPost('id_atk'));
        
        $tipe_barang_id = $this->request->getPost('tipe_barang_id');
        $merek_atk = $this->request->getPost('merek_atk');
        $data_merk_by_tipe = $this->atkModel->where('tipe_barang_id', $tipe_barang_id)->where('merek_atk', $merek_atk)->countAllResults();
        
        if($merek_atk_old['merek_atk'] == $merek_atk){
            $is_unique = '';
        }else{
            if($data_merk_by_tipe > 0){
                $is_unique = '|is_unique[atk.merek_atk]';
            }else{
                $is_unique = '';
            }
        }
        $validation->setRules([
            'merek_atk' => [
                'label' => 'Merek ATK',
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
                'id_atk' => $this->request->getPost('id_atk'),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'qty_atk' => $this->request->getPost('qty_atk'),
                'satuan_id' => $this->request->getPost('satuan_id'),
                'merek_atk' => $this->request->getPost('merek_atk'),
            ];
            $this->atkModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_atk = $this->request->getPost('id_atk');
        $this->atkModel->delete($id_atk);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_atk = $this->request->getPost('id_atk');

        $status_atk = $this->atkModel->find($id_atk);
        $data = [
            'status_atk' => $status_atk['status_atk'] == '1' ? '0' : '1',
        ];
        $this->atkModel->update($id_atk, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDataatk()
    {
        $id_atk = $this->request->getPost('id_atk');
        $data = $this->atkModel->find($id_atk);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>