<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\waGatewayModel;
use Ramsey\Uuid\Uuid;
use App\Libraries\Fonnte;

class waGatewayController extends BaseController
{
    protected $waGatewayModel;

    public function __construct()
    {
        $this->waGatewayModel = new waGatewayModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Master Data',
            'title' => 'WA Gateway',
            'active' => 'waGateway',
        ];
        return view('Admin/waGateway/index', $data);
    }

    public function fetchAll(){
        $data = $this->waGatewayModel->getwaGateway()->where('status_wa_gateway', '1')->findAll();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function ajaxDataTables()
    {
        $builder = $this->waGatewayModel->getwaGateway();
        // dd($builder);
        return DataTable::of($builder)
            ->add('status_wa_gateway', function ($row) {
                return '<div class="custom-control custom-switch"> <input type="checkbox" 
                '.($row->status_wa_gateway == 1 ? 'checked' : '').' 
                class="custom-control-input switch-btn change_status_wa_gateway " data-size="small" data-color="#0099ff" id="'.$row->id_wa_gateway.'"> <label class="custom-control-label" for="'.$row->id_wa_gateway.'"></label> </div>';
            })
            ->add('action', function ($row) {   
                return '
                <div class="dropdown">
                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item edit_wa_gateway" id="' . $row->id_wa_gateway . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item delete_wa_gateway" id="' . $row->id_wa_gateway . '"><i class="dw dw-delete-3"></i> Delete</button>
                            <button class="dropdown-item test_connection_waGateway" id="' . $row->token_wa_gateway . '"><i class="icon-copy fa fa-refresh" aria-hidden="true"></i> Test Connection</button>
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
            'nama_perangkat_wa_gateway' => [
                'label' => 'Nama waGateway',
                'rules' => 'required|is_unique[wa_gateway.nama_perangkat_wa_gateway]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'token_wa_gateway' => [
                'label' => 'Token waGateway',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ]
            ],

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON([
                'error' => true,
                'data' => $validation->getErrors(),
                'status' => '422'
            ]);
        } else {
            // ubah semua status menjadi 0
            $data_all_status_aktif = $this->waGatewayModel->where('status_wa_gateway', '1')->findAll();
            if($data_all_status_aktif) {
                foreach ($data_all_status_aktif as $key => $value) {
                    $data = [
                        'status_wa_gateway' => '0',
                    ];
                    $this->waGatewayModel->update($value['id_wa_gateway'], $data);
                }
            }
            $data = [
                'nama_perangkat_wa_gateway' => $this->request->getPost('nama_perangkat_wa_gateway'),
                'token_wa_gateway' => $this->request->getPost('token_wa_gateway'),
                'status_wa_gateway' => '1',
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->waGatewayModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_wa_gateway = $this->request->getPost('id_wa_gateway');
        $data = $this->waGatewayModel->find($id_wa_gateway);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $nama_perangkat_wa_gateway_old = $this->waGatewayModel->find($this->request->getPost('id_wa_gateway'));
        if ($this->request->getPost('nama_perangkat_wa_gateway') == $nama_perangkat_wa_gateway_old['nama_perangkat_wa_gateway']) {
            $is_unique = '';
        } else {
            $is_unique = '|is_unique[wa_gateway.nama_perangkat_wa_gateway]';
        }
        if($this->request->getPost('token_wa_gateway') == $nama_perangkat_wa_gateway_old['token_wa_gateway']){
            $is_unique_token = '';
        }else{
            $is_unique_token = '|is_unique[wa_gateway.token_wa_gateway]';
        }
        $validation->setRules([
            'nama_perangkat_wa_gateway' => [
                'label' => 'Nama waGateway',
                'rules' => 'required'.$is_unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'token_wa_gateway' => [
                'label' => 'Token waGateway',
                'rules' => 'required'.$is_unique_token,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ]
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
                'id_wa_gateway' => $this->request->getPost('id_wa_gateway'),
                'nama_perangkat_wa_gateway' => $this->request->getPost('nama_perangkat_wa_gateway'),
                'token_wa_gateway' => $this->request->getPost('token_wa_gateway'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->waGatewayModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_wa_gateway = $this->request->getPost('id_wa_gateway');
        $this->waGatewayModel->delete($id_wa_gateway);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function changeStatus()
    {
        $id_wa_gateway = $this->request->getPost('id_wa_gateway');
        // ubah semua data status
        $data_all_status_aktif = $this->waGatewayModel->where('status_wa_gateway', '1')->findAll();
        if($data_all_status_aktif) {
            foreach ($data_all_status_aktif as $key => $value) {
                $data = [
                    'status_wa_gateway' => '0',
                ];
                $this->waGatewayModel->update($value['id_wa_gateway'], $data);
            }
        }
        $status_wa_gateway = $this->waGatewayModel->find($id_wa_gateway);
        $data = [
            'status_wa_gateway' => $status_wa_gateway['status_wa_gateway'] == 1 ? '0' : '1',
        ];
        $this->waGatewayModel->update($id_wa_gateway, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Status berhasil diubah',
            'status' => '200'
        ]);
    }

    public function fetchDatawaGateway()
    {
        $id_wa_gateway = $this->request->getPost('id_wa_gateway');
        $data = $this->waGatewayModel->find($id_wa_gateway);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }
    
    public function testConnection()
    {
        $token = $this->request->getPost('token_wa_gateway');
        try {
            $wa = new Fonnte();
            $result = $wa->testConnection();

            return $this->response->setJSON([
                'error'  => false,
                'status' => '200',
                'data'   => 'Berhasil terhubung'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'error'   => true,
                'status'  => 'error',
                'data' => $token
            ]);
        }
    }

    // public function send()
    // {
    //     $phone   = $this->request->getPost('phone');
    //     $message = $this->request->getPost('message');

    //     try {
    //         $wa = new Fonnte();
    //         $result = $wa->send($phone, $message);

    //         return $this->response->setJSON($result);
    //     } catch (\Exception $e) {
    //         return $this->response->setJSON([
    //             'success' => false,
    //             'message' => $e->getMessage()
    //         ]);
    //     }
    // }

}

?>