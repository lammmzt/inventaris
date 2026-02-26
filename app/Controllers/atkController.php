<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\atkModel;
use App\Models\tipeBarangModel;
use App\Models\barangModel;
use App\Models\satuanModel;
use Ramsey\Uuid\Uuid;

class atkController extends BaseController
{
    protected $atkModel;
    protected $tipeBarangModel;
    protected $barangModel;
    protected $satuanModel;

    public function __construct()
    {
        $this->atkModel = new atkModel();
        $this->tipeBarangModel = new tipeBarangModel();
        $this->barangModel = new barangModel();
        $this->satuanModel = new satuanModel();
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
            // add foto atk
            ->add('foto_atk', function ($row) {
                if($row->foto_atk != null){
                    return '
                        <a href="' . base_url('Assets/img/atk/' . $row->foto_atk) . '" target="_blank">
                            <img src="' . base_url('Assets/img/atk/' . $row->foto_atk) . '" width="100" height="100" class="rounded-circle">
                        </a>
                    ';
                }
                return '-';
            })
            ->add('nama_barang', function ($row) {
                return $row->nama_barang. ' - ' .$row->nama_tipe_barang;
            })
            ->add('barcode', function ($row) {
                // Jika barcode kosong atau null
                if (empty($row->barcode_atk)) {
                    return '';
                }
                
                    // <svg class="barcode"
                    //     jsbarcode-value="'.$row->barcode_atk.'"
                    //     jsbarcode-format="CODE128"
                    //     jsbarcode-displayvalue="false"
                    //     jsbarcode-width="1"
                    //     jsbarcode-height="40">
                    // </svg> <br>
                // Jika barcode ada, tampilkan SVG
                return '
                    <span class="text-center">' . $row->barcode_atk . '</span>
                ';
            })


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

        $id_tipe_barang = $this->request->getPost('id_tipe_barang');
        $merek_atk = $this->request->getPost('merek_atk');
        $data_merk_by_tipe = $this->atkModel->where('id_tipe_barang', $id_tipe_barang)->where('merek_atk', $merek_atk)->countAllResults();
        
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
            'id_tipe_barang' => [
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
            // validasi barcode atk
            if($this->request->getPost('barcode_atk') != null){
                $data_barcode_atk = $this->atkModel->where('barcode_atk', $this->request->getPost('barcode_atk'))->countAllResults();
                if($data_barcode_atk > 0){
                    return $this->response->setJSON([
                        'error' => true,
                        'data' => 'Barcode ATK sudah ada',
                        'status' => '422'
                    ]);
                }
            }
            //jika ada upload file
            $file = $this->request->getFile('foto_atk');
            $newName = '';
            
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('Assets/img/atk/', $newName);
            }
            $data = [
                'id_atk' => Uuid::uuid4()->toString(),
                'id_tipe_barang' => $this->request->getPost('id_tipe_barang'),
                'merek_atk' => $this->request->getPost('merek_atk'),
                'barcode_atk' => $this->request->getPost('barcode_atk'),
                'foto_atk' => $newName,
                'qty_atk' => $this->request->getPost('qty_atk'),
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
        
        $id_tipe_barang = $this->request->getPost('id_tipe_barang');
        $merek_atk = $this->request->getPost('merek_atk');
        $data_merk_by_tipe = $this->atkModel->where('id_tipe_barang', $id_tipe_barang)->where('merek_atk', $merek_atk)->countAllResults();
        
        if($merek_atk_old['merek_atk'] == $merek_atk){
            $is_unique = '';
        }else{
            if($data_merk_by_tipe > 0){
                $is_unique = '|is_unique[atk.merek_atk]';
            }else{
                $is_unique = '';
            }
        }

        // chack apakah barcode sudah ada atau belum
        if($this->request->getPost('barcode_atk') != null){
            // chck barcode apakah sama dengan data sebelumnya
            if($this->request->getPost('barcode_atk') != $merek_atk_old['barcode_atk']){
                $data_barcode_atk = $this->atkModel->where('barcode_atk', $this->request->getPost('barcode_atk'))->countAllResults();
                if($data_barcode_atk > 0){
                    return $this->response->setJSON([
                        'error' => true,
                        'data' => 'Barcode ATK sudah ada',
                        'status' => '422'
                    ]);
                }
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
            'id_tipe_barang' => [
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
             //jika ada upload file
            $file = $this->request->getFile('foto_atk');
            $newName = '';
            
            if ($file->isValid() && !$file->hasMoved()) {
                // check apakah ada file sebelumnya
                if($merek_atk_old['foto_atk'] != null){
                    if(file_exists('Assets/img/atk/'.$merek_atk_old['foto_atk'])){
                        unlink('Assets/img/atk/'.$merek_atk_old['foto_atk']);
                    }
                }
                $newName = $file->getRandomName();
                $file->move('Assets/img/atk/', $newName);
            }
            $data = [
                'id_atk' => $this->request->getPost('id_atk'),
                'id_tipe_barang' => $this->request->getPost('id_tipe_barang'),
                'qty_atk' => $this->request->getPost('qty_atk'),
                'merek_atk' => $this->request->getPost('merek_atk'),
                'barcode_atk' => $this->request->getPost('barcode_atk'),
                'foto_atk' => $newName,
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
    
    public function getAtkByBarcode()
    {
        $barcode_atk = $this->request->getPost('barcode_atk');
        $data = $this->atkModel->getAtkByBarcode($barcode_atk);
        if($data == null){
            return $this->response->setJSON([
                'error' => true,
                'data' => 'Data tidak ditemukan',
                'status' => '422'
            ]);
        }else{
            return $this->response->setJSON([
                'error' => false,
                'data' => $data,
                'status' => '200'
            ]);
        }
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
                'data' => $validation->getErrors(),
                'status' => '422'
            ]);
        }
    
         // get barcode 
        $data_barcode_atk = $this->atkModel->findAll();
        $data_barcode_atk = array_column($data_barcode_atk, 'barcode_atk'); 
        // get data barang
        $barang = $this->barangModel->where('jenis_barang', '0')->findAll();
        $barang = array_column($barang, 'id_barang', 'nama_barang');
        // dd($barang);
        // get data tipe barang
        $tipe_barang = $this->tipeBarangModel->findAll();
        $tipe_barang = array_column($tipe_barang, 'id_tipe_barang', 'nama_tipe_barang');

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
            
            $nama_barang = $col[0];
            $nama_tipe_barang = $col[1];
            $satuan_atk = $col[2];
            $merek_atk = $col[3];
            $barcode_atk = $col[4];
            $qty_atk = $col[5];
            
            // check data barang
            if($nama_barang != '' && $nama_tipe_barang != '' && $satuan_atk != '' && $merek_atk != '' && $barcode_atk != '' && $qty_atk != ''){
                // check if barcode exist
                if (in_array($barcode_atk, $data_barcode_atk)) {
                    $failed[] = [
                        'id_atk' => $nama_barang.'-'.$nama_tipe_barang.'-'.$merek_atk,
                        'message' => 'Data dengan barcode '.$barcode_atk.' sudah ada'
                    ];
                    continue;
                }
                // check if data nama_tipe_barang exist
                if (!array_key_exists($nama_tipe_barang, $tipe_barang)) {
                    // check nama barang exist
                    if (!array_key_exists($nama_barang, $barang)) {
                        $id_barang = 'ATK-'.date('Ymd').'-'.rand(100,999);
                        $data = [
                            'id_barang' => $id_barang,
                            'nama_barang' => $nama_barang,
                            'jenis_barang' => '0',
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
                        'id_barang' => $barang[$nama_barang],
                        'id_satuan' => $data_satuan[$satuan],
                        'nama_tipe_barang' => $nama_tipe_barang,
                        'status_tipe_barang' => '1',
                    ];
                    $this->tipeBarangModel->insert($data_tipe_barang);
                    $tipe_barang[$nama_tipe_barang] = $data_tipe_barang['id_tipe_barang'];
                }

                $id_atk = Uuid::uuid4()->toString(); 
                // check apakah data atk sudah ada berdasarkan nama_atk id_tipe_barang dan merek_atk
                if (!$this->atkModel->where('id_tipe_barang', $tipe_barang[$nama_tipe_barang])->where('merek_atk', $merek_atk)->first()) {
                    $data = [
                        'id_atk' => $id_atk,
                        'id_tipe_barang' => $tipe_barang[$nama_tipe_barang],
                        'merek_atk' => $merek_atk,
                        'barcode_atk' => $barcode_atk,
                        'qty_atk' => $qty_atk,
                        'status_atk' => '1',
                    ];
                    $this->atkModel->insert($data);
                    $success[] = [
                        'id_atk' => $nama_barang.'-'.$nama_tipe_barang.'-'.$merek_atk,
                        'message' => 'Data berhasil diimport'
                    ];
                    continue;
                }else{
                    $failed[] = [
                        'id_atk' => $nama_barang.'-'.$nama_tipe_barang.'-'.$merek_atk,
                        'message' => 'Data dengan barcode '.$barcode_atk.' sudah ada'
                    ];
                    continue;
                }
            } else {
                $failed[] = [
                    'id_atk' => $nama_barang.'-'.$nama_tipe_barang.'-'.$merek_atk,
                    'message' => 'Data tidak lengkap'
                ];
                continue;
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
}

?>