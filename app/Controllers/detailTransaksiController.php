<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\transaksiModel;
use App\Models\atkModel;
use App\Models\detailTransaksiModel;
use Ramsey\Uuid\Uuid;

class detailTransaksiController extends BaseController
{
    protected $transaksiModel;
    protected $detailTransaksiModel;
    protected $atkModel;

    public function __construct()
    {
        $this->detailTransaksiModel = new detailTransaksiModel();
        $this->transaksiModel = new transaksiModel();
        $this->atkModel = new atkModel();
    }

    // ==================== INDEX ====================
    public function ajaxDataTablesMasuk()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        // $id_transaksi = 'c21c3d19-d9de-4e95-9f7b-b42dcbd401f1';
            
        $builder = $this->detailTransaksiModel->getTransMasukByTransId($id_transaksi);
        // dd($builder);
        
        return DataTable::of($builder)
            ->add('nama_barang', function ($row) {
                return  $row->nama_barang . ' - ' . $row->nama_tipe_barang . ' (' . $row->merek_atk . ') @ ' . $row->nama_satuan;
            })
             ->add('qty', function ($row) {
                return '<input type="number" class="form-control text-center input_qty" style="min-width: 100px;" min="1" value="' . $row->qty . '" id="' . $row->id_detail_transaksi . '">';
            })
            ->add('action', function ($row) {   
                return '
                <button type="button" class="btn btn-danger deleteTransMasuk" id="'. $row->id_detail_transaksi .'">Hapus</button> 
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
            'main_menu' => 'Transaksi',
            'title' => 'Form Transaksi Masuk',
            'active' => 'Transaksi',
        ];
        return view('Admin/Transaksi/transaksi_masuk', $data);
    }
        
    public function fetchDetailTransByIdTrans()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $data = $this->detailTransaksiModel->getTransMasukByTransId($id_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function insertTransaksiMasuk(){
        $ket_transaksi = $this->request->getPost('ket_transaksi');
        $tgl_transaksi = $this->request->getPost('tgl_transaksi');

        $data = [   
            'id_transaksi' => Uuid::uuid4()->toString(),
            'user_id' => session()->get('id_user'),
            // 'user_id' => '6f416504-27d9-42fc-8b96-dd23aba4e31b',
            'tipe_transaksi' => '0',
            'ket_transaksi' => $ket_transaksi,
            'status_transaksi' => '1',
            'tanggal_transaksi' => $tgl_transaksi,
        ];

        $this->transaksiModel->insert($data);
        
        // insert detail transaksi
        $detail_transaksi = $this->request->getPost('detail_transaksi');

        for ($i=0; $i < count($detail_transaksi); $i++) { 
            $dt_trx = [
                'transaksi_id' => $data['id_transaksi'],
                'atk_id' => $detail_transaksi[$i]['atk_id'],
                'qty' => $detail_transaksi[$i]['qty'],
                'status_detail_transaksi' => '1',
            ];

            // insert detail transaksi
            $this->detailTransaksiModel->save($dt_trx);
            
            // cari data atk
            $data_atk = $this->atkModel->find($detail_transaksi[$i]['atk_id']);

            // update qty atk
            $this->atkModel->update($detail_transaksi[$i]['atk_id'], ['qty_atk' => $data_atk['qty_atk'] + $detail_transaksi[$i]['qty']]);
        }

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function edit_trans_masuk(){
        $id_transaksi = $this->request->getUri()->getSegment(5);
        // dd($id_transaksi);
        $data_transaksi = $this->transaksiModel->getTransaksi($id_transaksi);

        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Edit Transaksi Masuk',
            'active' => 'Transaksi',
            'id_transaksi' => $id_transaksi,
            'tgl_transaksi' => $data_transaksi['tanggal_transaksi'],
            'ket_transaksi' => $data_transaksi['ket_transaksi'],    
        ];
        return view('Admin/Transaksi/edit_transaksi_masuk', $data);
    }

    public function saveDetailATKMasuk(){
        $transaksi_id = $this->request->getPost('id_transaksi');
        $qty = $this->request->getPost('qty');
        $atk_id = $this->request->getPost('atk_id');
        
        // find data atk
        $data_atk = $this->atkModel->find($atk_id);

        // find detail transaksi
        $data_detail = $this->detailTransaksiModel->where('transaksi_id', $transaksi_id)->where('atk_id', $atk_id)->first();

        if ($data_detail) {
            // update qty
            $this->detailTransaksiModel->update($data_detail['id_detail_transaksi'], ['qty' => $data_detail['qty'] + $qty]);

            // update qty atk
            $this->atkModel->update($atk_id, ['qty_atk' => $data_atk['qty_atk'] + $qty]);

            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }

        $data = [
            'transaksi_id' => $transaksi_id,
            'atk_id' => $atk_id,
            'qty' => $qty,
            'status_detail_transaksi' => '1',
        ];
        // insert detail transaksi
        $this->detailTransaksiModel->save($data);

        // update qty atk
        $this->atkModel->update($atk_id, ['qty_atk' => $data_atk['qty_atk'] + $qty]);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function destroyTransMasuk()
    {
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');
        // cari data detail transaksi
        $data_detail = $this->detailTransaksiModel->find($id_detail_transaksi);

        // cari data atk
        $data_atk = $this->atkModel->find($data_detail['atk_id']);

        // update qty atk
        $this->atkModel->update($data_detail['atk_id'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty']]);
        
        // delete detail transaksi
        $this->detailTransaksiModel->delete($id_detail_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
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


    public function changeStatus()
    {
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');

        $status_transaksi = $this->detailTransaksiModel->find($id_detail_transaksi);
        $data = [
            'status_transaksi' => $status_transaksi['status_transaksi'] == '1' ? '0' : '1',
        ];
        $this->detailTransaksiModel->update($id_detail_transaksi, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }
}

?>