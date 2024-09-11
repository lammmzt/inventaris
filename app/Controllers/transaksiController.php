<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\transaksiModel;
use Ramsey\Uuid\Uuid;

class transaksiController extends BaseController
{
    protected $transaksiModel;

    public function __construct()
    {
        $this->transaksiModel = new transaksiModel();
    }

    public function index()
    {
        $data = [
            'main_menu' => 'transaksi',
            'title' => 'Data transaksi',
            'active' => 'transaksi',
        ];
        return view('Admin/Transaksi/index', $data);
    }
    

    // ==================== INDEX ====================
    public function ajaxDataTablesMasuk()
    {
        $builder = $this->transaksiModel->getTransaksiMasuk();
        // dd($builder);
        return DataTable::of($builder)
             ->add('status_transaksi', function ($row) {
                // jika status_transaksi = 1 maka label inventaris dan sebaliknya atk
                return $row->status_transaksi == 1 ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Prose</span>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item detail_trans_masuk" id="' . $row->id_transaksi . '"><i class="dw dw-eye"></i> Detail</button>
                            <button class="dropdown-item edit_transaksi_masuk" id="' . $row->id_transaksi . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_transaksi_masuk" id="' . $row->id_transaksi . '"><i class="dw dw-delete-3"></i> Delete</button>
                        </div>
                </div>
                ';
            }, 'last')
            ->toJson(true);
    }
    
    public function ajaxDataTablesKeluar()
    {
        $builder = $this->transaksiModel->getTransaksiKeluar();
        // dd($builder);
        return DataTable::of($builder)
            ->add('status_transaksi', function ($row) {
                // jika status_transaksi = 1 maka label inventaris dan sebaliknya atk
                return $row->status_transaksi == 1 ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Prose</span>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item detail_trans_keluar" id="' . $row->id_transaksi . '"><i class="dw dw-eye"></i> Detail</button>
                            <button class="dropdown-item edit_transaksi" id="' . $row->id_transaksi . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_transaksi_keluar" id="' . $row->id_transaksi . '"><i class="dw dw-delete-3"></i> Delete</button>
                        </div>
                </div>
                ';
            }, 'last')
            ->toJson(true);
    }

    public function fetchAll(){
        $data = $this->transaksiModel->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    
    // ==================== TRANSAKSI MASUK ====================

     public function transaksi_masuk()
    {
        $data = [
            'main_menu' => 'transaksi',
            'title' => 'Form Transaksi Masuk',
            'active' => 'transaksi',
        ];
        return view('Admin/Transaksi/transaksi_masuk', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $tipe_barang_id = $this->request->getPost('tipe_barang_id');
        $merek_transaksi = $this->request->getPost('merek_transaksi');
        $data_merk_by_tipe = $this->transaksiModel->where('tipe_barang_id', $tipe_barang_id)->where('merek_transaksi', $merek_transaksi)->countAllResults();
        
        // dd($data_merk_by_tipe);
        
        if($data_merk_by_tipe > 0){
           $rules = 'required|is_unique[transaksi.merek_transaksi]';
        }else{
            $rules = 'required';
        }

        // dd($rules);  
        
        $validation->setRules([
            'merek_transaksi' => [
                'label' => 'Merek transaksi',
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
            'qty_transaksi' => [
                'label' => 'Qyt transaksi',
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
                'id_transaksi' => Uuid::uuid4()->toString(),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'satuan_id' => $this->request->getPost('satuan_id'),
                'merek_transaksi' => $this->request->getPost('merek_transaksi'),
                'status_transaksi' => '1',
            ];
            $this->transaksiModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $data = $this->transaksiModel->gettransaksi($id_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $merek_transaksi_old = $this->transaksiModel->find($this->request->getPost('id_transaksi'));
        
        $tipe_barang_id = $this->request->getPost('tipe_barang_id');
        $merek_transaksi = $this->request->getPost('merek_transaksi');
        $data_merk_by_tipe = $this->transaksiModel->where('tipe_barang_id', $tipe_barang_id)->where('merek_transaksi', $merek_transaksi)->countAllResults();
        
        if($merek_transaksi_old['merek_transaksi'] == $merek_transaksi){
            $is_unique = '';
        }else{
            if($data_merk_by_tipe > 0){
                $is_unique = '|is_unique[transaksi.merek_transaksi]';
            }else{
                $is_unique = '';
            }
        }
        $validation->setRules([
            'merek_transaksi' => [
                'label' => 'Merek transaksi',
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
                'id_transaksi' => $this->request->getPost('id_transaksi'),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'qty_transaksi' => $this->request->getPost('qty_transaksi'),
                'satuan_id' => $this->request->getPost('satuan_id'),
                'merek_transaksi' => $this->request->getPost('merek_transaksi'),
            ];
            $this->transaksiModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $this->transaksiModel->delete($id_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');

        $status_transaksi = $this->transaksiModel->find($id_transaksi);
        $data = [
            'status_transaksi' => $status_transaksi['status_transaksi'] == '1' ? '0' : '1',
        ];
        $this->transaksiModel->update($id_transaksi, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDatatransaksi()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $data = $this->transaksiModel->find($id_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    

}

?>