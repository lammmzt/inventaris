<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\inventarisModel;
use Ramsey\Uuid\Uuid;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;

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
        $builder = $this->inventarisModel->getInventaris();
        // dd($builder);
        return DataTable::of($builder)
            ->add('id_inventaris', function ($row) {
                return '<div class="dt-checkbox"><input class="check_select_item" type="checkbox" name="select_item" value="1" id="' . $row->id_inventaris . '">
                <span class="dt-checkbox-label"></span></div>';
            })
            ->add('nama_barang', function ($row) {
                return $row->nama_barang. ' - ' .$row->nama_tipe_barang. '('.$row->nama_inventaris.')';
            })
            ->add('status_inventaris', function ($row) {
                // jika status 0 tidak aktif, 1 aktif, 2 rusak dan 3 hilang
                if ($row->status_inventaris == '0') {
                    return '<span class="badge badge-pill badge-warning">Tidak Aktif</span>';
                } elseif ($row->status_inventaris == '1') {
                    return '<span class="badge badge-pill badge-success">Aktif</span>';
                } elseif ($row->status_inventaris == '2') {
                    return '<span class="badge badge-pill badge-danger">Rusak</span>';
                } elseif ($row->status_inventaris == '3') {
                    return '<span class="badge badge-pill badge-danger">Hilang</span>';
                }

                return $row->status_inventaris;
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
        
        $validation->setRules([
            'nama_inventaris' => [
                'label' => 'Nama inventaris',
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
            'spek_inventaris' => [
                'label' => 'Spek inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'perolehan_inventaris' => [
                'label' => 'Perolehan inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'sumber_inventaris' => [
                'label' => 'Sumber inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'ruangan_id' => [
                'label' => 'Ruangan',
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
           $kode_inventaris = 'BRG-'.date('Ymd').'-'.rand(100,999);
           $result = Builder::create()
                    ->writer(new PngWriter())
                    ->writerOptions([])
                    ->data($kode_inventaris)
                    ->encoding(new Encoding('UTF-8'))
                    ->errorCorrectionLevel(ErrorCorrectionLevel::High)
                    ->size(300)
                    ->margin(10)
                    ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                    ->logoPath('Assets/LOGO SMANSA.png')
                    ->logoResizeToWidth(50)
                    ->logoPunchoutBackground(true)
                    ->labelText($kode_inventaris)
                    ->labelFont(new NotoSans(20))
                    ->labelAlignment(LabelAlignment::Center)
                    ->validateResult(false)
                    ->build();
                    
            $result->saveToFile('Assets/qr_code/' . $kode_inventaris . '.png');
            $data = [
                'id_inventaris' => Uuid::uuid4()->toString(),
                'tipe_barang_id' => $this->request->getPost('tipe_barang_id'),
                'kode_inventaris' => $kode_inventaris,
                'qty_inventaris' => $this->request->getPost('qty_inventaris'),
                'ruangan_id' => $this->request->getPost('ruangan_id'),
                'nama_inventaris' => $this->request->getPost('nama_inventaris'),
                'spek_inventaris' => $this->request->getPost('spek_inventaris'),
                'perolehan_inventaris' => $this->request->getPost('perolehan_inventaris'),
                'sumber_inventaris' => $this->request->getPost('sumber_inventaris'),
                'qr_code' => $kode_inventaris.'.png',
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
        $data = $this->inventarisModel->getInventaris($id_inventaris);
        // dd($data);
        return $this->response->setJSON([
            'error' => false,   
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $nama_inventaris_old = $this->inventarisModel->find($this->request->getPost('id_inventaris'));
        
        $validation->setRules([
            'nama_inventaris' => [
                'label' => 'Nama inventaris',
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
            'spek_inventaris' => [
                'label' => 'Spek inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'perolehan_inventaris' => [
                'label' => 'Perolehan inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'sumber_inventaris' => [
                'label' => 'Sumber inventaris',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'ruangan_id' => [
                'label' => 'Ruangan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'status_inventaris' => [
                'label' => 'status_inventaris',
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
                'ruangan_id' => $this->request->getPost('ruangan_id'),
                'nama_inventaris' => $this->request->getPost('nama_inventaris'),
                'spek_inventaris' => $this->request->getPost('spek_inventaris'),
                'perolehan_inventaris' => $this->request->getPost('perolehan_inventaris'),
                'sumber_inventaris' => $this->request->getPost('sumber_inventaris'),
                'status_inventaris' => $this->request->getPost('status_inventaris'),
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
        $data = $this->inventarisModel->find($id_inventaris);
        if ($data['qr_code'] != '') {
            unlink('Assets/qr_code/' . $data['qr_code']);
        }
        $this->inventarisModel->delete($id_inventaris);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
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