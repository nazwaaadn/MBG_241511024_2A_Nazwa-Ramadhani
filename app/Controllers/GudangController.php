<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBaku;
use App\Models\Permintaan;
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

        $model = new BahanBaku();
        $modelPermintaan = new Permintaan();
        $totalBahanBaku = $model->getTotalBahanBaku();
        $totalKadaluarsa = $model->getTotalBahanBakuKadaluarsa();
        $totalTersedia = $model->getTotalBahanBakuTersedia();
        $totalPermintaan = $modelPermintaan->countPermintaan();
        $data = [
            'content' => view('gudang/dashboard', ['totalBahanBaku' => $totalBahanBaku, 'totalKadaluarsa' => $totalKadaluarsa, 'totalTersedia' => $totalTersedia, 'totalPermintaan' => $totalPermintaan]),
        ];
        return view('layoutadmin/main', $data);
    }
}
