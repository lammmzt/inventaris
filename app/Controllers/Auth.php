<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\usersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Login',
            'active' => 'Login',
        ];
        if(session()->get('logged_in')){
            return redirect()->to(base_url('Admin/Dashboard'));
        }else{
            return view('Auth/login', $data);
        }
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        // dd($username, $password);
        $model = new usersModel();
        $user = $model->where('username', $username)->first();

        if($user){
            
            if(password_verify($password, $user['password'])){
                $ses_data = [
                    'username' => $user['username'],
                    'nama_user' => $user['nama_user'],
                    'role' => $user['role'],
                    'logged_in' => TRUE,
                ];
                $model->update($user['id_user'], ['last_login' => date('Y-m-d H:i:s')]);
                session()->set($ses_data);
                return $this->response->setJSON([
                    'error' => false,
                    'status' => 200,
                    'data' => 'Login Berhasil',
                ]);
            }else{
                return $this->response->setJSON([
                    'error' => true,
                    'status' => 401,
                    'data' => 'Password Salah',
                ]);
            }
        }else{
            return $this->response->setJSON([
                'error' => true,
                'status' => 401,
                'data' => 'Username Tidak Ditemukan',
            ]);
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('Auth'));
    }
}


?>