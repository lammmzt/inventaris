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
            
        $builder = $this->detailTransaksiModel->getTransByTransId($id_transaksi);
        // dd($builder);
        
        return DataTable::of($builder)
            ->add('nama_barang', function ($row) {
                return  $row->nama_barang . ' - ' . $row->nama_tipe_barang . ' (' . $row->merek_atk . ') @ ' . $row->nama_satuan;
            })
            ->add('status_detail_transaksi', function ($row) {
                return '<select class="form-control input_status required" id="'. $row->id_detail_transaksi .'">
                            <option value="" '. ($row->status_detail_transaksi == '0' ? 'selected' : '') .'>--Pilih Status--</option>
                            <option value="1" '. ($row->status_detail_transaksi == '1' ? 'selected' : '') .'>Setuju</option>
                            <option value="2" '. ($row->status_detail_transaksi == '2' ? 'selected' : '') .'>Tolak</option>
                        </select>';
            })
            ->add('status_detail', function ($row) {
                if ($row->status_detail_transaksi == '0'){
                    return '<span class="badge badge-warning">Menunggu</span>';
                }elseif($row->status_detail_transaksi == '1'){
                    return '<span class="badge badge-success">Disetujui</span>';
                }else{
                    return '<span class="badge badge-danger">Ditolak</span>';
                }
                
            })
            ->add('catatan_detail_transaksi', function ($row) {
                return '<textarea class="form-control input_catatan" style="min-width: 100px; height: 50px;" placeholder="Catatan" '. ($row->status_detail_transaksi == '1' ? '' : 'readonly') .'
                 id="'. $row->id_detail_transaksi .'">'. $row->catatan_detail_transaksi .'</textarea>';
            })
             ->add('qty', function ($row) {
                return '<input type="number" class="form-control text-center input_qty" '.($row->status_detail_transaksi == '1' ? '' : 'readonly') .' style="min-width: 100px;" min="1" value="' . $row->qty . '" id="'. $row->id_detail_transaksi .'">';
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
        $id_transaksi = $this->request->getPost('id_transaksi');
        // $id_transaksi = 'c21c3d19-d9de-4e95-9f7b-b42dcbd401f1';
            
        $builder = $this->detailTransaksiModel->getTransByTransId($id_transaksi);
        // dd($builder);
        
        return DataTable::of($builder)
            ->add('nama_barang', function ($row) {
                return  $row->nama_barang . ' - ' . $row->nama_tipe_barang . ' (' . $row->merek_atk . ') @ ' . $row->nama_satuan;
            })
            ->add('qty', function ($row) {
                return '<input type="number" class="form-control text-center input_qty" style="min-width: 100px;" min="1" value="' . $row->qty . '" id="'. $row->id_detail_transaksi .'">';
            })
            ->add('status_detail_transaksi', function ($row) {
                return '<select class="form-control input_status required" id="'. $row->id_detail_transaksi .'">
                            <option value="" '. ($row->status_detail_transaksi == '0' ? 'selected' : '') .'>--Pilih Status--</option>
                            <option value="1" '. ($row->status_detail_transaksi == '1' ? 'selected' : '') .'>Setuju</option>
                            <option value="2" '. ($row->status_detail_transaksi == '2' ? 'selected' : '') .'>Tolak</option>
                        </select>';
            })
            ->add('catatan_detail_transaksi', function ($row) {
                return '<textarea class="form-control input_catatan" style="min-width: 100px; height: 50px;" placeholder="Catatan"
                 id="'. $row->id_detail_transaksi .'">'. $row->catatan_detail_transaksi .'</textarea>';
            })
            ->add('action', function ($row) {   
                return '
                <button type="button" class="btn btn-danger deleteTransKeluar" id="'. $row->id_detail_transaksi .'">Hapus</button> 
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

    public function fetchDetailTransByIdTrans()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $data = $this->detailTransaksiModel->getTransByTransId($id_transaksi)->findAll();
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
        
    public function insertTransaksiMasuk(){
        $ket_transaksi = $this->request->getPost('ket_transaksi');
        $tgl_transaksi = $this->request->getPost('tgl_transaksi');

        $data = [   
            'id_transaksi' => Uuid::uuid4()->toString(),
            'id_user' => session()->get('id_user'),
            // 'id_user' => '6f416504-27d9-42fc-8b96-dd23aba4e31b',
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
                'id_transaksi' => $data['id_transaksi'],
                'id_atk' => $detail_transaksi[$i]['id_atk'],
                'qty' => $detail_transaksi[$i]['qty'],
                'status_detail_transaksi' => '0',
            ];

            // insert detail transaksi
            $this->detailTransaksiModel->save($dt_trx);
            
            // // cari data atk
            // $data_atk = $this->atkModel->find($detail_transaksi[$i]['id_atk']);

            // // update qty atk
            // $this->atkModel->update($detail_transaksi[$i]['id_atk'], ['qty_atk' => $data_atk['qty_atk'] + $detail_transaksi[$i]['qty']]);
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

    public function updateDetailATKMasuk(){ 
        $id_transaksi = $this->request->getPost('id_transaksi');
        $qty = $this->request->getPost('qty');
        $id_atk = $this->request->getPost('id_atk');
        
        // find data atk
        // $data_atk = $this->atkModel->find($id_atk);

        // find detail transaksi
        $data_detail = $this->detailTransaksiModel->where('id_transaksi', $id_transaksi)->where('id_atk', $id_atk)->first();

        if ($data_detail) {
            // update qty
            $this->detailTransaksiModel->update($data_detail['id_detail_transaksi'], ['qty' => $data_detail['qty'] + $qty]);

            // update qty atk
            // $this->atkModel->update($id_atk, ['qty_atk' => $data_atk['qty_atk'] + $qty]);

            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }

        $data = [
            'id_transaksi' => $id_transaksi,
            'id_atk' => $id_atk,
            'qty' => $qty,
        ];
        // insert detail transaksi
        $this->detailTransaksiModel->save($data);

        // // update qty atk
        // $this->atkModel->update($id_atk, ['qty_atk' => $data_atk['qty_atk'] + $qty]);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function updateQtyMasuk(){
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');
        $qty = $this->request->getPost('qty');

        // cari data detail transaksi
        $data_detail = $this->detailTransaksiModel->find($id_detail_transaksi);

        // cari data atk
        // $data_atk = $this->atkModel->find($data_detail['id_atk']);

        // update qty detail transaksi
        $this->detailTransaksiModel->update($id_detail_transaksi, ['qty' => $qty]);
        
        // update qty atk
        // $this->atkModel->update($data_detail['id_atk'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty'] + $qty]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
        

    }

    public function destroyTransMasuk()
    {
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');
        // cari data detail transaksi
        $data_detail = $this->detailTransaksiModel->find($id_detail_transaksi);

        // cari data atk
        // $data_atk = $this->atkModel->find($data_detail['id_atk']);

        // update qty atk
        // $this->atkModel->update($data_detail['id_atk'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty']]);
        
        // delete detail transaksi
        $this->detailTransaksiModel->delete($id_detail_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function proses_penerimaan (){
        $id_transaksi = $this->request->getUri()->getSegment(6);
        // dd($id_transaksi);
        $data_transaksi = $this->transaksiModel->getTransaksi($id_transaksi);

        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Proses Transaksi Masuk',
            'active' => 'Transaksi',
            'id_transaksi' => $id_transaksi,
            'tanggal_transaksi' => $data_transaksi['tanggal_transaksi'],
            'ket_transaksi' => $data_transaksi['ket_transaksi'],
            'status_transaksi' => $data_transaksi['status_transaksi'],  
        ];
        return view('Admin/Transaksi/proses_transaksi_masuk', $data);
    }

    public function updatePenerimaanTransMasuk(){
        $status_transaksi = $this->request->getPost('status_transaksi');
        $id_transaksi = $this->request->getPost('id_transaksi');

        // get data detail transaksi
        $data_detail = $this->detailTransaksiModel->where('id_transaksi', $id_transaksi)->findAll();

        if ($status_transaksi == '4') {
            foreach ($data_detail as $key => $value) {
               if($value['status_detail_transaksi'] == '1'){
                    // cari data atk
                    $data_atk = $this->atkModel->find($value['id_atk']);

                    // update qty atk
                    $this->atkModel->update($value['id_atk'], ['qty_atk' => $data_atk['qty_atk'] + $value['qty']]);
               }
            }
        }

        $this->transaksiModel->update($id_transaksi, ['status_transaksi' => $status_transaksi]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }
    

    // ==================== TRANSAKSI KELUAR ====================
    public function transaksi_keluar()
    {
        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Form Transaksi Keluar',
            'active' => 'Transaksi',
        ];
        return view('Admin/Transaksi/transaksi_keluar', $data);
    }

    public function insertTransaksiKeluar(){
        $ket_transaksi = $this->request->getPost('ket_transaksi');
        $tgl_transaksi = $this->request->getPost('tgl_transaksi');
        $id_user = $this->request->getPost('id_user');
        
        if($id_user == null){
            $id_user = session()->get('id_user');
        }

        $data = [   
            'id_transaksi' => Uuid::uuid4()->toString(),
            'id_user' => $id_user,
            // 'id_user' => '6f416504-27d9-42fc-8b96-dd23aba4e31b',
            'tipe_transaksi' => '1',
            'ket_transaksi' => $ket_transaksi,
            'status_transaksi' => '1',
            'tanggal_transaksi' => $tgl_transaksi,
        ];

        $this->transaksiModel->insert($data);
        
        // insert detail transaksi
        $detail_transaksi = $this->request->getPost('detail_transaksi');

        for ($i=0; $i < count($detail_transaksi); $i++) { 
            $dt_trx = [
                'id_transaksi' => $data['id_transaksi'],
                'id_atk' => $detail_transaksi[$i]['id_atk'],
                'qty' => $detail_transaksi[$i]['qty'],
                'status_detail_transaksi' => '0',
            ];

            // insert detail transaksi
            $this->detailTransaksiModel->save($dt_trx);
        }

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function edit_trans_keluar(){
        $id_transaksi = $this->request->getUri()->getSegment(5);
        // dd($id_transaksi);
        $data_transaksi = $this->transaksiModel->getTransaksi($id_transaksi);

        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Edit Transaksi Keluar',
            'active' => 'Transaksi',
            'id_transaksi' => $id_transaksi,
            'tanggal_transaksi' => $data_transaksi['tanggal_transaksi'],
            'ket_transaksi' => $data_transaksi['ket_transaksi'],   
            'id_user' => $data_transaksi['id_user'],
        ];
        return view('Admin/Transaksi/edit_transaksi_keluar', $data);
    }
    
    public function updateDetailATKKeluar(){
        $id_transaksi = $this->request->getPost('id_transaksi');
        $qty = $this->request->getPost('qty');
        $id_atk = $this->request->getPost('id_atk');
        
        // find detail transaksi
        $data_detail = $this->detailTransaksiModel->where('id_transaksi', $id_transaksi)->where('id_atk', $id_atk)->first();

        if ($data_detail) {
            // update qty
            $this->detailTransaksiModel->update($data_detail['id_detail_transaksi'], ['qty' => $data_detail['qty'] + $qty]);

            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }

        $data = [
            'id_transaksi' => $id_transaksi,
            'id_atk' => $id_atk,
            'qty' => $qty,
            'status_detail_transaksi' => '0',
        ];
        // insert detail transaksi
        $this->detailTransaksiModel->save($data);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function updateQtyKeluar(){
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');
        $qty = $this->request->getPost('qty');

        // cari data detail transaksi
        $data_detail = $this->detailTransaksiModel->find($id_detail_transaksi);


        // update qty detail transaksi
        $this->detailTransaksiModel->update($id_detail_transaksi, ['qty' => $qty]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
        

    }

    public function Proses_trans_keluar(){
        $id_transaksi = $this->request->getUri()->getSegment(6);
        // dd($id_transaksi);
        $data_transaksi = $this->transaksiModel->getTransaksi($id_transaksi);

        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Proses Transaksi Keluar',
            'active' => 'Transaksi',
            'id_transaksi' => $id_transaksi,
            'tanggal_transaksi' => $data_transaksi['tanggal_transaksi'],
            'ket_transaksi' => $data_transaksi['ket_transaksi'],   
            'nama_user' => $data_transaksi['nama_user'],
        ];
        return view('Admin/Transaksi/proses_transaksi_keluar', $data);
    }

    public function UpdateprosesTransKeluar(){
        $detail_data = $this->request->getPost('detail_data');
        $id_transaksi = $this->request->getPost('id_transaksi');
        
        for ($i=0; $i < count($detail_data); $i++) { 
            $data = [
                'id_detail_transaksi' => $detail_data[$i]['id'],
                'status_detail_transaksi' => $detail_data[$i]['status'],
            ];

            if ($data['status_detail_transaksi'] == '1') {
                // cari data detail transaksi
                $data_detail = $this->detailTransaksiModel->find($data['id_detail_transaksi']);

                // cari data atk
                $data_atk = $this->atkModel->find($data_detail['id_atk']);

                // update qty atk
                $this->atkModel->update($data_detail['id_atk'], ['qty_atk' => $data_atk['qty_atk'] - $data_detail['qty']]);
            }
            
            $this->detailTransaksiModel->update($data['id_detail_transaksi'], ['status_detail_transaksi' => $data['status_detail_transaksi']]);
            
        }

        $this->transaksiModel->update($id_transaksi, ['status_transaksi' => '4']);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }
    
    public function updatedCatatan(){
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');
        $catatan = $this->request->getPost('catatan');

        // cari data detail transaksi
        $data_detail = $this->detailTransaksiModel->find($id_detail_transaksi);

        // update qty detail transaksi
        $this->detailTransaksiModel->update($id_detail_transaksi, ['catatan_detail_transaksi' => $catatan]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
    }

    public function destroyTransKeluar()
    {
        $id_detail_transaksi = $this->request->getPost('id_detail_transaksi');
        
        // cari data detail transaksi
        $data_detail = $this->detailTransaksiModel->find($id_detail_transaksi);

        // delete detail transaksi
        $this->detailTransaksiModel->delete($id_detail_transaksi);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    
    // ==================== PROSES TRANSAKSI MASUK ====================

    // ================================= KA TU ==============================
    public function proses_setuju(){ 
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
            'nama_user' => $data_transaksi['nama_user'],
        ];
        return view('KaTu/Transaksi/Proses', $data);
    }
    
    public function UpdateProsesPersetujuan(){
        $detail_data = $this->request->getPost('detail_data');
        $id_transaksi = $this->request->getPost('id_transaksi');
        $status_setuju = 0;
        for ($i=0; $i < count($detail_data); $i++) { 
            $data = [
                'id_detail_transaksi' => $detail_data[$i]['id'],
                'status_detail_transaksi' => $detail_data[$i]['status'],
            ];
            if($data['status_detail_transaksi'] == '1'){
                $status_setuju = 1;
            }
            
            $this->detailTransaksiModel->update($data['id_detail_transaksi'], ['status_detail_transaksi' => $data['status_detail_transaksi']]);
            
        }

        if($status_setuju == 1){
            $this->transaksiModel->update($id_transaksi, ['status_transaksi' => '2']);
         }else{
            $this->transaksiModel->update($id_transaksi, ['status_transaksi' => '0']);
        }


        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    // ================================= PETUGAS BOS ==============================
    public function proses_pengadaan(){ 
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
            'nama_user' => $data_transaksi['nama_user'],
            'status_transaksi' => $data_transaksi['status_transaksi'],
        ];
        return view('PetugasBos/Transaksi/Proses', $data);
    }

    public function UpdateProsesPengadaan(){
        $status_transaksi = $this->request->getPost('status_transaksi');
        $id_transaksi = $this->request->getPost('id_transaksi');

        // update status transaksi
        $this->transaksiModel->update($id_transaksi, ['status_transaksi' => $status_transaksi]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);

    }
    
    public function transaksi_keluar_pegawai()
    {
        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Form Transaksi Keluar',
            'active' => 'Transaksi',
        ];
        return view('Pegawai/Transaksi/transaksi_keluar', $data);
    }

    public function edit_trans_keluar_pegawai(){
        $id_transaksi = $this->request->getUri()->getSegment(5);
        // dd($id_transaksi);
        $data_transaksi = $this->transaksiModel->getTransaksi($id_transaksi);

        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Edit Transaksi Keluar',
            'active' => 'Transaksi',
            'id_transaksi' => $id_transaksi,
            'tanggal_transaksi' => $data_transaksi['tanggal_transaksi'],
            'ket_transaksi' => $data_transaksi['ket_transaksi'],   
            'id_user' => $data_transaksi['id_user'],
        ];
        return view('Pegawai/Transaksi/edit_transaksi_keluar', $data);
    }


    
}

?>