<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DapurController extends BaseController
{
    public function index()
    {
         $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if ($session->get('role') !== 'dapur') {
            return redirect()->to('/login');
        }

        $data = [
            'content' => view('dapur/dashboard'),
        ];
        return view('layoutstudents/main', $data);
    }
}
