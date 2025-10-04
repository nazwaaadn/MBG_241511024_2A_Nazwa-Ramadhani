<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBaku;
use App\Models\Permintaan;
use App\Models\PermintaanDetail;
use CodeIgniter\HTTP\ResponseInterface;

class DapurController extends BaseController
{
    protected $permintaanModel;
    protected $detailModel;
    protected $bahanModel;

    public function index()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        if ($session->get('role') !== 'dapur') {
            return redirect()->to('/login');
        }

        $userId = $session->get('id');

        $model = new Permintaan();
        $permintaan = $model->getPermintaanByUser($userId); 
        $disetujui = $model->getPermintaanByUserDisetujui($userId); 
        $menunggu = $model->getPermintaanByUserMenunggu($userId);
        $ditolak = $model->getPermintaanByUserDitolak($userId);
        $data = [
            'content' => view('dapur/dashboard', ['permintaan' => $permintaan, 'disetujui' => $disetujui,  'menunggu' => $menunggu,  'ditolak' => $ditolak]),
        ];
        return view('layoutstudents/main', $data);
    }

    public function detail($id)
{
    $session = session();

    if (!$session->get('isLoggedIn')) {
        return redirect()->to('/login');
    }

    if ($session->get('role') !== 'dapur') {
        return redirect()->to('/login');
    }

    $model = new \App\Models\PermintaanDetail();
    $result = $model->getPermintaanDenganBahanById($id);
    // Struktur data untuk view
    $permintaan = [
        'id' => $result[0]['permintaan_id'],
        'nama_pemohon' => $result[0]['nama_pemohon'],
        'tgl_masak' => $result[0]['tgl_masak'],
        'menu_makan' => $result[0]['menu_makan'],
        'jumlah_porsi' => $result[0]['jumlah_porsi'],
        'status' => $result[0]['status'],
        'alasan_ditolak' => $result[0]['alasan_ditolak'],
        'bahan' => []
    ];

    foreach ($result as $row) {
        $permintaan['bahan'][] = [
            'id' => $row['bahan_id'],
            'nama' => $row['nama_bahan'],
            'kategori' => $row['kategori_bahan'],
            'jumlah_diminta' => $row['jumlah_diminta'],
            'status' => $row['status_bahan'] ?? 'tersedia'
        ];
    }

    $data = [
        'content' => view('dapur/permintaanDetail', ['permintaan' => $permintaan])
    ];

    return view('layoutstudents/main', $data);
}

public function add()
{
    $model = new BahanBaku();
    $bahan = $model->getBahanTersedia();

    $data = [
        'title' => 'Tambah Permintaan',
        'content' => view('dapur/addPermintaan', ['bahan_baku' => $bahan])
    ];

    return view('layoutstudents/main', $data);
}

    public function __construct()
    {
        $this->permintaanModel = new Permintaan();
        $this->detailModel = new PermintaanDetail();
        $this->bahanModel = new BahanBaku();
    }

    public function store()
    {
        // Validation rules
        $validationRules = [
            'tgl_masak'    => ['rules' => 'required|valid_date', 'errors' => ['required' => 'Tanggal masak wajib diisi']],
            'menu_makan'   => ['rules' => 'required', 'errors' => ['required' => 'Menu wajib diisi']],
            'jumlah_porsi' => ['rules' => 'required|integer', 'errors' => ['required' => 'Jumlah porsi wajib diisi', 'integer' => 'Harus berupa angka']],
            'bahan_nama.*' => ['rules' => 'required', 'errors' => ['required' => 'Nama bahan wajib dipilih']],
            'bahan_jumlah.*' => ['rules' => 'required|integer', 'errors' => ['required' => 'Jumlah bahan wajib diisi', 'integer' => 'Harus berupa angka']],
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user_id = session()->get('id'); // ambil dari session

        $post = $this->request->getPost();

        // Simpan permintaan
        $permintaan_id = $this->permintaanModel->insert([
            'pemohon_id'   => $user_id,
            'tgl_masak'    => $post['tgl_masak'],
            'menu_makan'   => $post['menu_makan'],
            'jumlah_porsi' => $post['jumlah_porsi'],
            'status'       => 'menunggu'
        ], true); // true = return inserted ID

        // Simpan detail permintaan (many-to-many)
        if (isset($post['bahan_nama']) && is_array($post['bahan_nama'])) {
            foreach ($post['bahan_nama'] as $key => $nama) {
                $jumlah = $post['bahan_jumlah'][$key];

                if (!empty($nama) && !empty($jumlah)) {
                    // Cari bahan_baku ID
                    $bahan = $this->bahanModel->where('nama', $nama)->first();
                    if ($bahan) {
                        $this->detailModel->insert([
                            'permintaan_id' => $permintaan_id,
                            'bahan_id'      => $bahan['id'],
                            'jumlah_diminta'=> $jumlah
                        ]);
                    }
                }
            }
        }

        session()->setFlashdata('success', '✅ Permintaan berhasil ditambahkan!');

        return redirect()->to('/dapur');
    }

}
