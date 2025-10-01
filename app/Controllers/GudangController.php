<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class GudangController extends BaseController
{
    public function index()
    {
         $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if ($session->get('role') !== 'gudang') {
            return redirect()->to('/login');
        }
        $data = [
            'content' => view('gudang/dashboard'),
        ];
        return view('layoutadmin/main', $data);
    }
}
