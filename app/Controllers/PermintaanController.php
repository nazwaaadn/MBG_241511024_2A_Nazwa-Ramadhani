<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
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

    public function detail($id)
{
    $db = \Config\Database::connect();

    $permintaan = $db->table('permintaan p')
    ->select('p.*, u.name as nama_pemohon')
    ->join('user u', 'u.id = p.pemohon_id')
    ->where('p.id', $id)
    ->get()
    ->getRowArray();  // <-- ini


    $detail = $db->table('permintaan_detail d')
        ->select('d.*, b.*')
        ->join('bahan_baku b', 'b.id = d.bahan_id')
        ->where('d.permintaan_id', $id)
        ->get()
        ->getResultArray();

    $data = [
        'title'            => 'Detail Bahan Baku',
        'permintaan'       => $permintaan,
        'detail' => $detail,
    ];

    // kirim langsung ke view layoutadmin/main
    $data['content'] = view('CRUDPermintaan/detail', $data);

    return view('layoutadmin/main', $data);
}


    public function updateStatus()
{
    $db     = \Config\Database::connect();
    $id     = $this->request->getPost('id');       
    $status = $this->request->getPost('status');   
    $alasan = $this->request->getPost('alasan_ditolak'); 

    $permintaanModel       = new Permintaan();
    $permintaanDetailModel = new PermintaanDetail();
    $bahanModel            = new BahanBaku();

    // Data yang akan diupdate
    $dataUpdate = ['status' => $status];

    if ($status == 'ditolak') {
        $dataUpdate['alasan_ditolak'] = $alasan;
    } else {
        $dataUpdate['alasan_ditolak'] = null; // reset kalau bukan ditolak
    }

    // Update status + alasan (kalau ada)
    $permintaanModel->update($id, $dataUpdate);

    // Jika status "disetujui" -> kurangi stok
    if ($status == 'disetujui') {
        $details = $permintaanDetailModel->where('permintaan_id', $id)->findAll();

        foreach ($details as $detail) {
            $bahanId   = $detail['bahan_id'];
            $jumlahReq = $detail['jumlah_diminta'];

            $bahan = $db->table('bahan_baku')->where('id', $bahanId)->get()->getRow();

            if ($bahan) {
                $stokBaru = $bahan->jumlah - $jumlahReq;
                $db->table('bahan_baku')->where('id', $bahanId)->update(['jumlah' => $stokBaru]);
            }
        }
    }

    return redirect()->to(base_url('Permintaan/display'))
        ->with('success', 'Status berhasil diperbarui.');
}


    public function search()
{
    $keyword = $this->request->getVar('keyword');
    $model   = new Permintaan();

    $builder = $model->select('permintaan.id, permintaan.pemohon_id, user.name as nama_pemohon, permintaan.tgl_masak, permintaan.menu_makan, permintaan.jumlah_porsi, permintaan.status')
                     ->join('user', 'user.id = permintaan.pemohon_id')
                     ->where('permintaan.status', 'menunggu');

    if ($keyword) {
        $builder->groupStart()
                ->like('user.name', $keyword)
                ->orLike('permintaan.menu_makan', $keyword)
                ->orLike('permintaan.status', $keyword)
                ->groupEnd();
    }

    $data['permintaan'] = $builder->findAll();
    return view('CRUDPermintaan/search', $data);
}

}
