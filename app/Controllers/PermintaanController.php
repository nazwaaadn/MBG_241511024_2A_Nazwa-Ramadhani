<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permintaan;
use CodeIgniter\HTTP\ResponseInterface;

class PermintaanController extends BaseController
{
    public function index()
{
    $model = new Permintaan();
    $permintaan = $model->getPermintaan(); // ini sudah array hasil perbaikan
    $data = [
        'title'   => 'Data Permintaan',
        'content' => view('CRUDPermintaan/table', ['permintaan' => $permintaan])
    ];
    return view('layoutadmin/main', $data);
}


    public function updateStatus()
{
    $id     = $this->request->getPost('id');
    $status = $this->request->getPost('status');

    $model = new Permintaan();
    $model->update($id, ['status' => $status]);

    return redirect()->to(base_url('Permintaan/display'))->with('success', 'Status berhasil diperbarui.');
}


    public function search()
{
    $keyword = $this->request->getVar('keyword');
    $model   = new Permintaan();

    // JOIN tabel user untuk ambil nama user (misal kolomnya 'nama')
    $builder = $model->select('permintaan.id, permintaan.pemohon_id, user.name as nama_pemohon, permintaan.tgl_masak, permintaan.menu_makan, permintaan.jumlah_porsi, permintaan.status')
                     ->join('user', 'user.id = permintaan.pemohon_id')
                     ->where('permintaan.status', 'menunggu');

    if ($keyword) {
        $builder->groupStart()
                ->like('user.name', $keyword) // cari berdasarkan nama user
                ->orLike('permintaan.menu_makan', $keyword)
                ->orLike('permintaan.status', $keyword)
                ->groupEnd();
    }

    $data['permintaan'] = $builder->findAll();



    return view('CRUDPermintaan/search', $data);
}

}
