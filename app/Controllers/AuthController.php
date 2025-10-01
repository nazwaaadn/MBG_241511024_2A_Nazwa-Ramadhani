<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Biodata;
use App\Models\Gudang;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function loginView()
    {
        $session = session();

        if ($session->get('isLoggedIn')) {
            // Redirect sesuai role
            $role = $session->get('role');
            if ($role === 'gudang') {
                return redirect()->to('/gudang');
            } elseif ($role === 'dapur') {
                return redirect()->to('/dapur');
            } else {
                return redirect()->to('/home');
            }
        }

        return view('login');
    }


    public function loginProcess()
    {
        $session = session();
        $userModel = new User();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'isLoggedIn' => true,
                    'id'    => $user['id'],
                    'role'       => $user['role'],
                ]);
                
                if ($user['role'] === 'gudang') {
                    return redirect()->to('/gudang');
                } elseif ($user['role'] === 'dapur') {
                    return redirect()->to('/dapur');
                } else {
                    return redirect()->to('/home');
                }

            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->back();
            }
        } else {
            $session->setFlashdata('error', 'email tidak ditemukan');
            return redirect()->back();
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

}
