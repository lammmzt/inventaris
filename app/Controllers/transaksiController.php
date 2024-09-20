<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\transaksiModel;
use App\Models\atkModel;
use App\Models\detailTransaksiModel;
use Ramsey\Uuid\Uuid;

class transaksiController extends BaseController
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

    public function index()
    {
        $data = [
            'main_menu' => 'Transaksi',
            'title' => 'Data transaksi',
            'active' => 'Transaksi',
        ];
        return view('Admin/Transaksi/index', $data);
    }
    
    public function ajaxDataTablesMasuk()
    {
        $builder = $this->transaksiModel->getTransaksiMasuk();
        // dd($builder);
        return DataTable::of($builder)
             ->add('status_transaksi', function ($row) {
                if ($row->status_transaksi == 1) {
                    return '<span class="badge badge-warning">Persetujuan</span>';
                } elseif ($row->status_transaksi == 2) {
                    return '<span class="badge badge-primary">Disetujui</span>';
                } elseif ($row->status_transaksi == 3) {
                    return '<span class="badge badge-info">Proses pengadaan</span>';
                } elseif ($row->status_transaksi == 4) {
                    return '<span class="badge badge-success">Selesai</span>';
                } else {
                    return '<span class="badge badge-danger">Ditolak</span>';
                }
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                     ' . ($row->status_transaksi == 1 ? '<a class="dropdown-item " id="' . $row->id_transaksi . '" href="' . base_url('Admin/ATK/Transaksi/Masuk/' . $row->id_transaksi) . '"><i class="dw dw-edit2"></i> Edit</a>' : '') . ' 
                        <button class="dropdown-item detail_trans_masuk" id="' . $row->id_transaksi . '"><i class="dw dw-eye"></i> Detail</button>
                        <a class="dropdown-item " id="' . $row->id_transaksi . '" href="' . base_url('Admin/ATK/Transaksi/Proses/' . $row->id_transaksi) . '"><i class="dw dw-check"></i> Proses</a>
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
                return $row->status_transaksi == 4 ? '<span class="badge badge-success">Selesai</span>' : '<span class="badge badge-warning">Proses</span>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        ' . ($row->status_transaksi == 1 ? '<a class="dropdown-item " id="' . $row->id_transaksi . '" href="' . base_url('Admin/ATK/Transaksi/Keluar/' . $row->id_transaksi) . '"><i class="dw dw-edit2"></i> Edit</a>
                        <a class="dropdown-item " id="' . $row->id_transaksi . '" href="' . base_url('Admin/ATK/Transaksi/Keluar/Proses/' . $row->id_transaksi) . '"><i class="dw dw-check"></i> Proses</a>' : '') . ' 
                        <button class="dropdown-item detail_trans_keluar" id="' . $row->id_transaksi . '"><i class="dw dw-eye"></i> Detail</button>
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

    public function updateTransMasuk()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'ket_transaksi' => [
                'label' => 'Keterangan Transaksi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tanggal_transaksi' => [
                'label' => 'Tanggal Transaksi',
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
                'ket_transaksi' => $this->request->getPost('ket_transaksi'),
                'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            ];
            
            $this->transaksiModel->update($id_transaksi, $data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diubah',
                'status' => '200'
            ]);
        }
    }

    public function updateTransKeluar()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'ket_transaksi' => [
                'label' => 'Keterangan Transaksi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'tanggal_transaksi' => [
                'label' => 'Tanggal Transaksi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'user_id' => [
                'label' => 'Nama Pengguna',
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
                'user_id' => $this->request->getPost('user_id'),
                'ket_transaksi' => $this->request->getPost('ket_transaksi'),
                'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            ];
            
            $this->transaksiModel->update($id_transaksi, $data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diubah',
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