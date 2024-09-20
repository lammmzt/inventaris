<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\pengadaanModel;
use App\Models\atkModel;
use App\Models\detailPengadaanModel;
use Ramsey\Uuid\Uuid;

class detailPengadaanController extends BaseController
{
    protected $pengadaanModel;
    protected $detailPengadaanModel;
    protected $atkModel;

    public function __construct()
    {
        $this->detailPengadaanModel = new detailPengadaanModel();
        $this->pengadaanModel = new pengadaanModel();
        $this->atkModel = new atkModel();
    }

    // ==================== INDEX ====================
    public function ajaxDataTables()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        // $id_pengadaan = 'c21c3d19-d9de-4e95-9f7b-b42dcbd401f1';
            
        $builder = $this->detailPengadaanModel->getDetailPengadaanByID($id_pengadaan);
        // dd($builder);
        
        return DataTable::of($builder)
            ->add('nama_barang', function ($row) {
                return  $row->nama_barang . ' - ' . $row->nama_tipe_barang . ' @ ' . $row->nama_satuan;
            })
             ->add('qty', function ($row) {
                return '<input type="number" class="form-control text-center input_qty" style="min-width: 100px;" min="1" value="' . $row->qty . '" id="'. $row->id_detail_pengadaan .'">';
            })
            ->add('action', function ($row) {   
                return '
                <button type="button" class="btn btn-danger deleteTransMasuk" id="'. $row->id_detail_pengadaan .'">Hapus</button> 
                ';
            }, 'last')
            ->toJson(true);
    }
    
    public function ajaxDataTablesProses()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        // $id_pengadaan = 'c21c3d19-d9de-4e95-9f7b-b42dcbd401f1';
            
        $builder = $this->detailPengadaanModel->getDetailPengadaanByID($id_pengadaan);
        // dd($builder);
        
        return DataTable::of($builder)
            ->add('nama_barang', function ($row) {
                return  $row->nama_barang . ' - ' . $row->nama_tipe_barang . ' @ ' . $row->nama_satuan;
            })
            ->add('qty', function ($row) {
                return '<input type="number" class="form-control text-center input_qty" style="min-width: 100px;" min="1" value="' . $row->qty . '" id="'. $row->id_detail_pengadaan .'">';
            })
            ->add('status_detail_pengadaan', function ($row) {
                return '<select class="form-control input_status required" id="'. $row->id_detail_pengadaan .'">
                            <option value="" '. ($row->status_detail_pengadaan == '0' ? 'selected' : '') .'>--Pilih Status--</option>
                            <option value="1" '. ($row->status_detail_pengadaan == '1' ? 'selected' : '') .'>Setuju</option>
                            <option value="2" '. ($row->status_detail_pengadaan == '2' ? 'selected' : '') .'>Tolak</option>
                        </select>';
            })
            ->add('catatan_detail_pengadaan', function ($row) {
                return '<textarea class="form-control input_catatan" style="min-width: 100px; height: 50px;" placeholder="Catatan"
                 id="'. $row->id_detail_pengadaan .'">'. $row->catatan_detail_pengadaan .'</textarea>';
            })
            ->add('action', function ($row) {   
                return '
                <button type="button" class="btn btn-danger deleteTransKeluar" id="'. $row->id_detail_pengadaan .'">Hapus</button> 
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

    public function pengadaan_masuk()
    {
        $data = [
            'main_menu' => 'pengadaan',
            'title' => 'Form pengadaan Masuk',
            'active' => 'pengadaan',
        ];
        return view('Admin/pengadaan/pengadaan_masuk', $data);
    }
        
    public function fetchPengadaanById()
    {
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        $data = $this->detailPengadaanModel->getDetailPengadaanByID($id_pengadaan)->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function store(){
        $ket_pengadaan = $this->request->getPost('ket_pengadaan');

        $data = [   
            'id_pengadaan' => Uuid::uuid4()->toString(),
            'user_id' => session()->get('id_user'),
            // 'user_id' => '6f416504-27d9-42fc-8b96-dd23aba4e3
            'ket_pengadaan' => $ket_pengadaan,
            'status_pengadaan' => '1',
        ];

        $this->pengadaanModel->insert($data);
        
        // insert detail pengadaan
        $detail_pengadaan = $this->request->getPost('item_pengadaan');

        // dd($detail_pengadaan);
        for ($i=0; $i < count($detail_pengadaan); $i++) { 
            $dt_trx = [
                'pengadaan_id' => $data['id_pengadaan'],
                'tipe_barang_id' => $detail_pengadaan[$i]['tipe_barang_id'],
                'qty' => $detail_pengadaan[$i]['qty'],
                'spek' => $detail_pengadaan[$i]['spek'],
                'status_detail_pengadaan' => '0',
            ];

            // insert detail pengadaan
            $this->detailPengadaanModel->save($dt_trx);
            
        }

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function edit_pengadaan(){
        $id_pengadaan = $this->request->getUri()->getSegment(5);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data = [
            'main_menu' => 'pengadaan',
            'title' => 'Edit pengadaan Masuk',
            'active' => 'pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tgl_pengadaan' => $data_pengadaan['tanggal_pengadaan'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'],    
        ];
        return view('Admin/pengadaan/edit_pengadaan_masuk', $data);
    }

    public function updateQtyMasuk(){
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        $qty = $this->request->getPost('qty');

        // cari data detail pengadaan
        $data_detail = $this->detailPengadaanModel->find($id_detail_pengadaan);

        // cari data atk
        $data_atk = $this->atkModel->find($data_detail['atk_id']);

        // update qty detail pengadaan
        $this->detailPengadaanModel->update($id_detail_pengadaan, ['qty' => $qty]);
        
        // update qty atk
        $this->atkModel->update($data_detail['atk_id'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty'] + $qty]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
        

    }

    public function destroyTransMasuk()
    {
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        // cari data detail pengadaan
        $data_detail = $this->detailPengadaanModel->find($id_detail_pengadaan);

        // cari data atk
        $data_atk = $this->atkModel->find($data_detail['atk_id']);

        // update qty atk
        $this->atkModel->update($data_detail['atk_id'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty']]);
        
        // delete detail pengadaan
        $this->detailPengadaanModel->delete($id_detail_pengadaan);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    // ==================== pengadaan KELUAR ====================
     public function pengadaan_keluar()
    {
        $data = [
            'main_menu' => 'pengadaan',
            'title' => 'Form pengadaan Keluar',
            'active' => 'pengadaan',
        ];
        return view('Admin/pengadaan/pengadaan_keluar', $data);
    }

    public function insertpengadaanKeluar(){
        $ket_pengadaan = $this->request->getPost('ket_pengadaan');
        $tgl_pengadaan = $this->request->getPost('tgl_pengadaan');
        $user_id = $this->request->getPost('user_id');
        
        if($user_id == null){
            $user_id = session()->get('id_user');
        }

        $data = [   
            'id_pengadaan' => Uuid::uuid4()->toString(),
            'user_id' => $user_id,
            // 'user_id' => '6f416504-27d9-42fc-8b96-dd23aba4e31b',
            'tipe_pengadaan' => '1',
            'ket_pengadaan' => $ket_pengadaan,
            'status_pengadaan' => '0',
            'tanggal_pengadaan' => $tgl_pengadaan,
        ];

        $this->pengadaanModel->insert($data);
        
        // insert detail pengadaan
        $detail_pengadaan = $this->request->getPost('detail_pengadaan');

        for ($i=0; $i < count($detail_pengadaan); $i++) { 
            $dt_trx = [
                'pengadaan_id' => $data['id_pengadaan'],
                'atk_id' => $detail_pengadaan[$i]['atk_id'],
                'qty' => $detail_pengadaan[$i]['qty'],
                'status_detail_pengadaan' => '0',
            ];

            // insert detail pengadaan
            $this->detailPengadaanModel->save($dt_trx);
        }

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function edit_trans_keluar(){
        $id_pengadaan = $this->request->getUri()->getSegment(5);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data = [
            'main_menu' => 'pengadaan',
            'title' => 'Edit pengadaan Keluar',
            'active' => 'pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tanggal_pengadaan' => $data_pengadaan['tanggal_pengadaan'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'],   
            'user_id' => $data_pengadaan['user_id'],
        ];
        return view('Admin/pengadaan/edit_pengadaan_keluar', $data);
    }
    
    public function updateDetailATKKeluar(){
        $pengadaan_id = $this->request->getPost('id_pengadaan');
        $qty = $this->request->getPost('qty');
        $atk_id = $this->request->getPost('atk_id');
        
        // find detail pengadaan
        $data_detail = $this->detailPengadaanModel->where('pengadaan_id', $pengadaan_id)->where('atk_id', $atk_id)->first();

        if ($data_detail) {
            // update qty
            $this->detailPengadaanModel->update($data_detail['id_detail_pengadaan'], ['qty' => $data_detail['qty'] + $qty]);

            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }

        $data = [
            'pengadaan_id' => $pengadaan_id,
            'atk_id' => $atk_id,
            'qty' => $qty,
            'status_detail_pengadaan' => '1',
        ];
        // insert detail pengadaan
        $this->detailPengadaanModel->save($data);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function updateQtyKeluar(){
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        $qty = $this->request->getPost('qty');

        // cari data detail pengadaan
        $data_detail = $this->detailPengadaanModel->find($id_detail_pengadaan);


        // update qty detail pengadaan
        $this->detailPengadaanModel->update($id_detail_pengadaan, ['qty' => $qty]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
        

    }

    public function Proses_trans_keluar(){
        $id_pengadaan = $this->request->getUri()->getSegment(6);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data = [
            'main_menu' => 'pengadaan',
            'title' => 'Proses pengadaan Keluar',
            'active' => 'pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tanggal_pengadaan' => $data_pengadaan['tanggal_pengadaan'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'],   
            'nama_user' => $data_pengadaan['nama_user'],
        ];
        return view('Admin/pengadaan/proses_pengadaan_keluar', $data);
    }

    public function UpdateprosesTransKeluar(){
        $detail_data = $this->request->getPost('detail_data');
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        
        for ($i=0; $i < count($detail_data); $i++) { 
            $data = [
                'id_detail_pengadaan' => $detail_data[$i]['id'],
                'status_detail_pengadaan' => $detail_data[$i]['status'],
            ];

            if ($data['status_detail_pengadaan'] == '1') {
                // cari data detail pengadaan
                $data_detail = $this->detailPengadaanModel->find($data['id_detail_pengadaan']);

                // cari data atk
                $data_atk = $this->atkModel->find($data_detail['atk_id']);

                // update qty atk
                $this->atkModel->update($data_detail['atk_id'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty']]);
            }
            
            $this->detailPengadaanModel->update($data['id_detail_pengadaan'], ['status_detail_pengadaan' => $data['status_detail_pengadaan']]);
            
        }

        $this->pengadaanModel->update($id_pengadaan, ['status_pengadaan' => '1']);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }
    
    public function updatedCatatan(){
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        $catatan = $this->request->getPost('catatan');

        // cari data detail pengadaan
        $data_detail = $this->detailPengadaanModel->find($id_detail_pengadaan);

        // update qty detail pengadaan
        $this->detailPengadaanModel->update($id_detail_pengadaan, ['catatan_detail_pengadaan' => $catatan]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
    }

    public function destroyTransKeluar()
    {
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        
        // cari data detail pengadaan
        $data_detail = $this->detailPengadaanModel->find($id_detail_pengadaan);

        // delete detail pengadaan
        $this->detailPengadaanModel->delete($id_detail_pengadaan);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }
}

?>