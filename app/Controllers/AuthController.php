<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Admin;
use App\Models\Biodata;
use App\Models\Users;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function loginView()
    {
        $session = session();

        if ($session->get('isLoggedIn')) {
            // Redirect sesuai role
            $role = $session->get('role');
            if ($role === 'admin') {
                return redirect()->to('/admin');
            } elseif ($role === 'student') {
                return redirect()->to('/student');
            } else {
                return redirect()->to('/home');
            }
        }

        return view('login');
    }


    public function loginProcess()
    {
        $session = session();
        $userModel = new Users();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'isLoggedIn' => true,
                    'user_id'    => $user['user_id'],
                    'role'       => $user['role'],
                ]);
                
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin');
                } elseif ($user['role'] === 'student') {
                    return redirect()->to('/student');
                } else {
                    return redirect()->to('/home');
                }

            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function data_mahasiswa()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $users = new Users();
        $mahasiswa = $users->getMahasiswa();
        $data = [
            'title'   => 'Data Mahasiswa',
            'content' => view('authentication/table', ['mahasiswa' => $mahasiswa])
        ];
        
        return view('authentication/template_02', $data);
    }

    public function homepage()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $data = [
            'title'   => 'Ini Home',
            'content' => view('welcome')
        ];
        return view('authentication/template_02', $data);
    }

    public function detail($nim)
    {
            if (! session()->get('isLoggedIn')) {
                return redirect()->to('/login');
            }

            $users = new Users();
            $mahasiswa = $users->where('nim', $nim)->findAll();
            $data = [
                'title'   => 'Data Mahasiswa',
                'content' => view('authentication/detail', ['mahasiswa' => $mahasiswa])
            ];
        
        return view('authentication/template_02', $data);
    }
}
