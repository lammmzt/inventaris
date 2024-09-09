<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class usersController extends BaseController
{
    protected $usersModel;

    public function __construct()
    {
        $this->userModel = new usersModel();
    }
    public function index()
    {
        $data = [
            'main_menu' => 'Users',
            'title' => 'Data User',
            'active' => 'Users',
        ];
        return view('Admin/Users/index', $data);
    }

    public function ajaxDataTables()
    {
        $builder = $this->userModel->getUser();
        // dd($builder);
        return DataTable::of($builder)
            ->add('action', function ($row) {
                return '
                <div class="dropdown">
					<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown"> <i class="dw dw-more"></i></a>
						<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                            <button class="dropdown-item view_user" id="' . $row->id_user . '"><i class="dw dw-eye"></i> View</a>
                            <button class="dropdown-item edit_user" id="' . $row->id_user . '"><i class="dw dw-edit2"></i> Edit</button>
                            <button class="dropdown-item reset_pass" id="' . $row->id_user . '"><i class="dw dw-refresh2"></i> Reset Password</button>
							<button class="dropdown-item delete_user" id="' . $row->id_user . '"><i class="dw dw-delete-3"></i> Delete</button>
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
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'nama_user' => [
                'label' => 'Nama User',
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
            $uuid = Uuid::uuid4();
            $id_user = $uuid->toString();
            $data = [
                'id_user' => $id_user,
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('username'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
                'nama_user' => $this->request->getPost('nama_user'),
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $this->userModel->insert($data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil disimpan',
                'status' => '200'
            ]);
        }
    }

    public function edit()
    {
        $id_user = $this->request->getPost('id_user');
        $data = $this->userModel->find($id_user);
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function fetchDataUser()
    {
        $username = $this->request->getPost('username');
        $data = $this->userModel->where('username', $username)->first();
        return $this->response->setJSON([
            'error' => false,
            'data' => $data,
            'status' => '200'
        ]);
    }

    public function update()
    {
        $validation =  \Config\Services::validation();
        $id = $this->request->getPost('id_user');
        $validation->setRules([
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username,id_user,' . $id . ']',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'nama_user' => [
                'label' => 'Nama User',
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
                'username' => $this->request->getPost('username'),
                'role' => $this->request->getPost('role'),
                'nama_user' => $this->request->getPost('nama_user'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
            $this->userModel->update($id, $data);
            return $this->response->setJSON([
                'error' => false,
                'data' => 'Data berhasil diupdate',
                'status' => '200'
            ]);
        }
    }

    public function destroy()
    {
        $id_user = $this->request->getPost('id_user');
        $this->userModel->delete($id_user);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Data berhasil dihapus',
            'status' => '200'
        ]);
    }

    public function reset()
    {
        $id_user = $this->request->getPost('id_user');
        $data = $this->userModel->find($id_user);
        $data = [
            'password' => password_hash($data['username'], PASSWORD_DEFAULT),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->userModel->update($id_user, $data);
        return $this->response->setJSON([
            'error' => false,
            'data' => 'Password berhasil direset menjadi username',
            'status' => '200'
        ]);
    }


    public function Setting()
    {
        $data = [
            'title' => 'Setting',
            'active' => 'Dashboard',
        ];
        return view('Admin/Setting/index', $data);
    }

    public function updatePass()
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'last_pass' => [
                'label' => 'Password Lama',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'new_pass' => [
                'label' => 'Password Baru',
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
            $newPass = $this->request->getPost('new_pass');
            $reNewPass = $this->request->getPost('re_new_pass');
            if ($newPass != $reNewPass) {
                return $this->response->setJSON([
                    'error' => true,
                    'data' => 'Password baru tidak sama',
                    'status' => '422'
                ]);
            } else {
                $id = $this->request->getPost('id_user');
                $data = $this->userModel->find($id);
                if (password_verify($this->request->getPost('last_pass'), $data['password'])) {
                    $data = [
                        'password' => password_hash($newPass, PASSWORD_DEFAULT),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];
                    $this->userModel->update($id, $data);
                    return $this->response->setJSON([
                        'error' => false,
                        'data' => 'Password berhasil diubah',
                        'status' => '200'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'error' => true,
                        'data' => 'Password lama salah',
                        'status' => '422'
                    ]);
                }
            }
        }
    }
}