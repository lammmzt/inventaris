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
            ->add('spek', function ($row) {
                return '<textarea class="form-control input_spek" style="min-width: 200px; height: 50px;" '. ($row->status_detail_pengadaan == '1' ? '' : 'readonly') .' placeholder="Masukan spesifikasi" id="'. $row->id_detail_pengadaan .'">'. $row->spek .'</textarea>';
            })
            ->add('status_detail_pengadaan', function ($row) {
                return '<select class="form-control input_status required" id="'. $row->id_detail_pengadaan .'">
                            <option value="" '. ($row->status_detail_pengadaan == '0' ? 'selected' : '') .'>--Pilih Status--</option>
                            <option value="1" '. ($row->status_detail_pengadaan == '1' ? 'selected' : '') .'>Setuju</option>
                            <option value="2" '. ($row->status_detail_pengadaan == '2' ? 'selected' : '') .'>Tolak</option>
                        </select>';
            })
            ->add('status_detail', function ($row) {
                if ($row->status_detail_pengadaan == '0'){
                    return '<span class="badge badge-warning">Menunggu</span>';
                }elseif($row->status_detail_pengadaan == '1'){
                    return '<span class="badge badge-success">Disetujui</span>';
                }else{
                    return '<span class="badge badge-danger">Ditolak</span>';
                }
            })
            ->add('catatan_detail_pengadaan', function ($row) {
                return '<textarea class="form-control input_catatan text-black" style="min-width: 100px; height: 50px;" '. ($row->status_detail_pengadaan == '1' ? '' : 'readonly') .' placeholder="Catatan"
                 id="'. $row->id_detail_pengadaan .'">'. $row->catatan_detail_pengadaan .'</textarea>';
            })
             ->add('nama_spek', function ($row) {
                return '<textarea class="form-control input_spek" style="min-width: 200px; height: 50px;" '. ($row->status_detail_pengadaan == '1' ? '' : 'readonly') .' placeholder="Masukan spesifikasi" id="'. $row->id_detail_pengadaan .'">'. $row->spek .'</textarea>';
            })
             ->add('qty', function ($row) {
                return '<input type="number" class="form-control text-center input_qty" '. ($row->status_detail_pengadaan == '1' ? '' : 'readonly') .' style="min-width: 50px;" min="1" value="' . $row->qty . '" id="'. $row->id_detail_pengadaan .'">';
            })
            ->add('action', function ($row) {   
                return '
                <button type="button" class="btn btn-danger delete_pengadaan" id="'. $row->id_detail_pengadaan .'">Hapus</button> 
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
        // $id_pengadaan = '23fbc3b8-7c4c-4a5d-8566-0b4067fe9d02';
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
        $id_pengadaan = $this->request->getUri()->getSegment(3);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data_pengadaan['created_at'] = date('Y-m-d', strtotime($data_pengadaan['created_at']));
        $data = [
            'main_menu' => 'Pengadaan',
            'title' => 'Edit pengadaan Masuk',
            'active' => 'Pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tgl_pengadaan' => $data_pengadaan['created_at'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'],    
        ];
        // dd($data);
        return view('Admin/Pengadaan/edit_pengadaan', $data);
    }

    public function updateDetail(){
        $pengadaan_id = $this->request->getPost('id_pengadaan');
        $tipe_barang_id = $this->request->getPost('tipe_barang_id');
        $qty = $this->request->getPost('qty');
        
        // get data detail pengadaan
        $data_detail = $this->detailPengadaanModel->where('pengadaan_id', $pengadaan_id)->where('tipe_barang_id', $tipe_barang_id)->first();


        // cek jika data detail pengadaan sudah ada
        if($data_detail){
            $qty = $data_detail['qty'] + 1;
            $this->detailPengadaanModel->update($data_detail['id_detail_pengadaan'], ['qty' => $qty]);
        } else {
            // insert detail pengadaan
            $data = [
                'pengadaan_id' => $pengadaan_id,
                'tipe_barang_id' => $tipe_barang_id,
                'qty' => '1',
                'spek' => '',
                'status_detail_pengadaan' => '0',
            ];
        
            $this->detailPengadaanModel->save($data);
        }
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
    }

    public function updateQty(){
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        $qty = $this->request->getPost('qty');

        // update qty detail pengadaan
        $this->detailPengadaanModel->update($id_detail_pengadaan, ['qty' => $qty]);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
        

    }

    public function updateSpek(){
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        $spek = $this->request->getPost('spek');

        // update qty detail pengadaan
        $this->detailPengadaanModel->update($id_detail_pengadaan, ['spek' => $spek]);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);
    }

    public function updateCatatan(){
        $id_detail_pengadaan = $this->request->getPost('id_detail_pengadaan');
        $catatan = $this->request->getPost('catatan');

        // update qty detail pengadaan
        $this->detailPengadaanModel->update($id_detail_pengadaan, ['catatan_detail_pengadaan' => $catatan]);
        
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil diupdate',
            'status' => '200'
        ]);

    }

    public function destroyPengadaan()
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

    public function proses_penerimaan(){
        $id_pengadaan = $this->request->getUri()->getSegment(4);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data_pengadaan['created_at'] = date('Y-m-d', strtotime($data_pengadaan['created_at']));
        $data = [
            'main_menu' => 'Pengadaan',
            'title' => 'Edit pengadaan Masuk',
            'active' => 'Pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tgl_pengadaan' => $data_pengadaan['created_at'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'], 
            'nama_user' => $data_pengadaan['nama_user'], 
            'status_pengadaan' => $data_pengadaan['status_pengadaan'],
        ];
        // dd($data);
        return view('Admin/Pengadaan/Proses', $data);
    }

    public function UpdateProsesPenerimaan(){
        $status_pengadaan = $this->request->getPost('status_pengadaan');
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        
        $this->pengadaanModel->update($id_pengadaan, ['status_pengadaan' => $status_pengadaan]);

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    // ==================== PROSES PENGADAAN ====================
    public function persetujuan_pengadaan(){
        $id_pengadaan = $this->request->getUri()->getSegment(4);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data_pengadaan['created_at'] = date('Y-m-d', strtotime($data_pengadaan['created_at']));
        $data = [
            'main_menu' => 'Pengadaan',
            'title' => 'Edit pengadaan Masuk',
            'active' => 'Pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tgl_pengadaan' => $data_pengadaan['created_at'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'], 
            'nama_user' => $data_pengadaan['nama_user'], 
        ];
        // dd($data);
        return view('KaTU/Pengadaan/Proses', $data);
    }

    public function UpdateProsesPersetujuan(){
        $detail_data = $this->request->getPost('detail_data');
        $id_pengadaan = $this->request->getPost('id_pengadaan');
        $status_setuji = 0;
        for ($i=0; $i < count($detail_data); $i++) { 
            $data = [
                'id_detail_pengadaan' => $detail_data[$i]['id'],
                'status_detail_pengadaan' => $detail_data[$i]['status'],
            ];
            if($detail_data[$i]['status'] == '1'){
                $status_setuji++;
            }
            $this->detailPengadaanModel->update($data['id_detail_pengadaan'], ['status_detail_pengadaan' => $data['status_detail_pengadaan']]);
            
        }
        
        // jika setuju tidak sama denan 0
        if($status_setuji != 0){
            $this->pengadaanModel->update($id_pengadaan, ['status_pengadaan' => '2']);
        }else{
            $this->pengadaanModel->update($id_pengadaan, ['status_pengadaan' => '0']);
        }

        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil disimpan',
            'status' => '200'
        ]);
    }

    public function proses_pengadaan(){
        $id_pengadaan = $this->request->getUri()->getSegment(4);
        // dd($id_pengadaan);
        $data_pengadaan = $this->pengadaanModel->getpengadaan($id_pengadaan);

        $data_pengadaan['created_at'] = date('Y-m-d', strtotime($data_pengadaan['created_at']));
        $data = [
            'main_menu' => 'Pengadaan',
            'title' => 'Edit pengadaan Masuk',
            'active' => 'Pengadaan',
            'id_pengadaan' => $id_pengadaan,
            'tgl_pengadaan' => $data_pengadaan['created_at'],
            'ket_pengadaan' => $data_pengadaan['ket_pengadaan'], 
            'status_pengadaan' => $data_pengadaan['status_pengadaan'],
            'nama_user' => $data_pengadaan['nama_user'], 
        ];
        // dd($data);
        return view('PetugasBOS/Pengadaan/Proses', $data);
    }


}

?>