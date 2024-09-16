<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\inventarisModel;
use App\Models\tipeBarangModel;
use App\Models\ruanganModel;
use App\Models\barangModel;
use App\Models\satuanModel;

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
    protected $tipeBarangModel;
    protected $ruanganModel;
    protected $barangModel;
    protected $satuanModel;

    public function __construct()
    {
        $this->inventarisModel = new inventarisModel();
        $this->tipeBarangModel = new tipeBarangModel();
        $this->ruanganModel = new ruanganModel();
        $this->barangModel = new barangModel();
        $this->satuanModel = new satuanModel();
        
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
                return '<div class="dt-checkbox"><input class="check_select_item" type="checkbox" name="select_item" value="1" id="' . $row->qr_code . '">
                <span class="dt-checkbox-label"></span></div>';
            })
            ->add('nama_barang', function ($row) {
                return $row->nama_barang. ' - ' .$row->nama_tipe_barang. '('.$row->nama_inventaris.')';
            })
            ->add('status_inventaris', function ($row) {
                // jika status 0 tidak aktif, 1 aktif, 2 rusak dan 3 hilang
                if ($row->status_inventaris == '0') {
                    return '<span class="badge badge badge-warning">Tidak Aktif</span>';
                } elseif ($row->status_inventaris == '1') {
                    return '<span class="badge badge badge-success">Aktif</span>';
                } elseif ($row->status_inventaris == '2') {
                    return '<span class="badge badge badge-danger">Rusak</span>';
                } elseif ($row->status_inventaris == '3') {
                    return '<span class="badge badge badge-danger">Hilang</span>';
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
           $kode_inventaris = 'BRG-'.date('Ymd').'-'.rand(100,9999);
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
                'qr_code' => $kode_inventaris.'.png',
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

    public function importData(){
        $file_excel = $this->request->getFile('file');
        $validation = \Config\Services::validation();

        // Define validation rules
        $validation->setRules([
            'file' => [
                'rules' => 'uploaded[file]|ext_in[file,xls,xlsx,csv]',
                'errors' => [
                    'uploaded' => 'File tidak boleh kosong',
                    'required' => 'File tidak boleh kosong',
                    'ext_in' => 'File harus berupa xls, xlsx, csv'
                ]
            ]
        ]);

        // Validate the request data
        if (!$validation->run($this->request->getPost())) {
            return $this->response->setJSON([
                'error' => true,
                'data' => $validation->getErrors()
            ]);
        }
    
        
        // get data barang
        $barang = $this->barangModel->findAll();
        $barang = array_column($barang, 'id_barang', 'nama_barang');
        // dd($barang);
        // get data tipe barang
        $tipe_barang = $this->tipeBarangModel->findAll();
        $tipe_barang = array_column($tipe_barang, 'id_tipe_barang', 'nama_tipe_barang');

        // get data ruangan
        $ruangan = $this->ruanganModel->findAll();
        $ruangan = array_column($ruangan, 'id_ruangan', 'nama_ruangan');

        // get data satuan
        $data_satuan = $this->satuanModel->findAll();
        $data_satuan = array_column($data_satuan, 'id_satuan', 'nama_satuan');

        // Initialize the PhpSpreadsheet reader based on the file extension
        $ext = $file_excel->getClientExtension();
        if ($ext == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ($ext == 'xlsx') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } elseif ($ext == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }

        $spreadsheet = $reader->load($file_excel);
        $data = $spreadsheet->getActiveSheet()->toArray();

        // add total data to process
        $total_data = count($data) - 1;
        $no = 0;
        $success = [];
        $failed = [];
        // dd($total_data);
        foreach ($data as $x => $col) {

            if ($x == 0) {
                continue;
            }
            
            $no++;
            
            $kode_inventaris = $col[0];
            $nama_barang = $col[1];
            $nama_tipe_barang = $col[2];
            $nama_inventaris = $col[3];
            $nama_ruangan = $col[4];
            $spek_inventaris = $col[5];
            $satuan = $col[6];
            $qty_inventaris = $col[7];
            $perolehan_inventaris = $col[8];
            $sumber_inventaris = $col[9];
            

            // check data barang
            if($nama_barang != '' && $nama_tipe_barang != '' && $nama_inventaris != '' && $nama_ruangan != '' && $spek_inventaris != '' && $satuan != '' && $qty_inventaris != '' ){
                // check if data nama_tipe_barang exist
                if (!array_key_exists($nama_tipe_barang, $tipe_barang)) {
                    // check nama barang exist
                    if (!array_key_exists($nama_barang, $barang)) {
                        $kode_barang = 'INV-'.date('Ymd').'-'.rand(100,999);
                        $data = [
                            'id_barang' => Uuid::uuid4()->toString(),
                            'kode_barang' => $kode_barang,
                            'nama_barang' => $nama_barang,
                            'jenis_barang' => '1',
                            'status_barang' => '1',
                        ];
                        $this->barangModel->insert($data);
                        $barang[$nama_barang] = $data['id_barang'];
                    }
                    // check nama satuan exist
                    if (!array_key_exists($satuan, $data_satuan)) {
                        $data = [
                            'nama_satuan' => $satuan,
                            'status_satuan' => '1',
                        ];
                        $this->satuanModel->insert($data);
                        // RELAOD DATA SATUAN
                        $data_satuan = $this->satuanModel->findAll();
                        $data_satuan = array_column($data_satuan, 'id_satuan', 'nama_satuan');
                    }
                    // insert data tipe barang
                    $data_tipe_barang = [
                        'id_tipe_barang' => Uuid::uuid4()->toString(),
                        'barang_id' => $barang[$nama_barang],
                        'satuan_id' => $data_satuan[$satuan],
                        'nama_tipe_barang' => $nama_tipe_barang,
                        'status_tipe_barang' => '1',
                    ];
                    $this->tipeBarangModel->insert($data_tipe_barang);
                    $tipe_barang[$nama_tipe_barang] = $data_tipe_barang['id_tipe_barang'];
                }

                // check if data ruangan exist
                if (!array_key_exists($nama_ruangan, $ruangan)) {
                    $data_ruangan = [
                        'id_ruangan' => Uuid::uuid4()->toString(),
                        'nama_ruangan' => $nama_ruangan,
                        'status_ruangan' => '1',
                    ];

                    $this->ruanganModel->insert($data_ruangan);
                    $ruangan[$nama_ruangan] = $data_ruangan['id_ruangan'];
                }

                $kode_inventaris =( $kode_inventaris == '') ? 'BRG-'.date('Ymd').'-'.rand(100,9999) : $kode_inventaris;
                // check if data inventaris exist
                if (!$this->inventarisModel->where(['kode_inventaris' => $kode_inventaris])->first()) {

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
                    // insert data inventaris
                    $data_inventaris = [
                        'id_inventaris' => Uuid::uuid4()->toString(),
                        'tipe_barang_id' => $tipe_barang[$nama_tipe_barang],
                        'ruangan_id' => $ruangan[$nama_ruangan],
                        'kode_inventaris' => $kode_inventaris,
                        'nama_inventaris' => $nama_inventaris,
                        'spek_inventaris' => $spek_inventaris,
                        'qty_inventaris' => $qty_inventaris,
                        'perolehan_inventaris' => $perolehan_inventaris,
                        'sumber_inventaris' => $sumber_inventaris,
                        'qr_code' => $kode_inventaris.'.png',
                        'status_inventaris' => '1',
                    ];
                    $this->inventarisModel->insert($data_inventaris);
                    // push $kode_inventaris.'.png'
                    $success[] = $kode_inventaris.'.png' ;

                } else {
                    $failed[] = [
                        'kode_inventaris' => $kode_inventaris.'-'.$nama_barang.'-'.$nama_tipe_barang.'-'.$nama_inventaris,
                        'message' => 'Kode inventaris sudah ada'
                    ];
                }
            } else {
            $failed[] = [
                'kode_inventaris' => $kode_inventaris.'-'.$nama_barang.'-'.$nama_tipe_barang.'-'.$nama_inventaris,
                'message' => 'Data tidak lengkap'
            ];
            }
            
            $this->response->setJSON([
                'error' => false,
                'status' => '201',
                'data' => [
                    'total_data' => $total_data,
                    'success' => $success,
                    'failed' => $failed,

                ]
            ]);
        }
        
        return $this->response->setJSON([
                'error' => false,
                'status' => '200',
                'data' => 'Data berhasil diimport',
                'total_data' => $total_data,
                'data_success' => $success,
                'data_failed' => $failed
        ]);
    }

    public function pritnQrCode()
    {
        $data_inventaris = $this->request->getPost('qr_code');
        // split data qr_code to array
        $data_inventaris = explode(',', $data_inventaris);
        // dd($data_inventaris);
        return view('Admin/Inventaris/print_qr_code', ['data_inventaris' => $data_inventaris]);

    }
    
    // pengecekan data inventaris
    public function Pengecekan(){
        $data = [
            'main_menu' => 'Inventaris',
            'title' => 'Pengecekan inventaris',
            'active' => 'Pengecekan',
        ];
        return view('Admin/Inventaris/pengecekan', $data);
    }

    
}

?>