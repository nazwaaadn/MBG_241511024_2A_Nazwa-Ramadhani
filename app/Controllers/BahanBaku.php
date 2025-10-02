<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBaku as ModelsBahanBaku;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class BahanBaku extends BaseController
{
    public function index()
    {
        $model = new ModelsBahanBaku();
        $bahan_baku = $model->getBahanBaku();
        $data = [
            'title'   => 'Data Bahan Baku',
            'content' => view('CRUDBahanBaku/table', ['bahan_baku' => $bahan_baku])
        ];
        return view('layoutadmin/main', $data);
    }

    public function detail($id)
{
    $model = new ModelsBahanBaku();
    $bahan_baku = $model->find($id); // ambil 1 data by id

    if (!$bahan_baku) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Data dengan ID $id tidak ditemukan");
    }

    $data = [
        'title'   => 'Detail Bahan Baku',
        'content' => view('CRUDBahanBaku/detail', ['bahan_baku' => $bahan_baku])
    ];

    return view('layoutadmin/main', $data);
}


    public function add()
    {
        $data = [
            'title'   => 'Add Bahan Baku',
            'content' => view('CRUDBahanBaku/add')
        ];
        return view('layoutadmin/main', $data);
    }

    public function store()
{
    $BahanBakuModel = new ModelsBahanBaku();

    $validationRules = [
        'nama' => [
            'rules'  => 'required',
            'errors' => ['required' => 'Nama wajib diisi']
        ],
        'kategori' => [
            'rules'  => 'required',
            'errors' => ['required' => 'Kategori wajib diisi']
        ],
        'jumlah' => [
            'rules'  => 'required|integer',
            'errors' => [
                'required' => 'Jumlah wajib diisi',
                'integer'  => 'Jumlah harus berupa angka'
            ]
        ],
        'satuan' => [
            'rules'  => 'required',
            'errors' => ['required' => 'Satuan wajib diisi']
        ],
        'tanggal_masuk' => [
            'rules'  => 'required|valid_date',
            'errors' => ['required' => 'Tanggal Masuk wajib diisi']
        ],
        'tanggal_kadaluarsa' => [
            'rules'  => 'required|valid_date',
            'errors' => ['required' => 'Tanggal Kadaluarsa wajib diisi']
        ],
    ];

    if (! $this->validate($validationRules)) {
        return redirect()->to('/BahanBaku/add')
                        ->withInput()
                        ->with('errors', $this->validator->getErrors());
    }

    // Ambil input
    $tanggalKadaluarsa = $this->request->getPost('tanggal_kadaluarsa');
    $tanggalMasuk      = $this->request->getPost('tanggal_masuk');

    // Hitung status berdasarkan tanggal
    $now = Time::now('Asia/Jakarta', 'id_ID');
    $hariIni = $now->format('Y-m-d');

    $kadaluarsaDate = new Time($tanggalKadaluarsa, 'Asia/Jakarta', 'id_ID');
    $selisih = $now->diff($kadaluarsaDate)->days;

    if ($tanggalKadaluarsa <= $hariIni) {
        $status = 'kadaluarsa';
    } elseif ($selisih <= 3) {
        $status = 'segera_kadaluarsa';
    } else {
        $status = 'tersedia';
    }

    // Data yang disimpan
    $BahanBakuData = [
        'nama'               => $this->request->getPost('nama'),
        'kategori'           => $this->request->getPost('kategori'),
        'jumlah'             => $this->request->getPost('jumlah'),
        'satuan'             => $this->request->getPost('satuan'),
        'tanggal_masuk'      => $tanggalMasuk,
        'tanggal_kadaluarsa' => $tanggalKadaluarsa,
        'status'             => $status,
    ];

    $BahanBakuModel->insert($BahanBakuData);

    session()->setFlashdata('success', '✅ Data bahan baku berhasil ditambahkan!');

    return redirect()->to('/BahanBaku/display');
}



    public function edit($id)
    {
        $model = new ModelsBahanBaku();
        $BahanBaku = $model->getBahanBaku();
        $BahanBaku = $model->select('bahan_baku.*')
                 ->where('bahan_baku.id', $id)
                 ->get()
                 ->getRowArray();
        $data = [
            'title'   => 'Edit Bahan Baku',
            'content' => view('CRUDBahanBaku/edit', ['BahanBaku' => $BahanBaku])
        ];
        return view('layoutadmin/main', $data);
    }

    public function update($id)
{
    $BahanBakuModel = new ModelsBahanBaku();

    $validationRules = [
        'jumlah' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Jumlah wajib diisi',
                'numeric'  => 'Jumlah harus berupa angka'
            ]
        ]
    ];

    if (! $this->validate($validationRules)) {
        return redirect()->to('/BahanBaku/edit/'.$id)
                        ->withInput()
                        ->with('errors', $this->validator->getErrors());
    }

    // 🔎 Cari data BahanBaku untuk dapetin user_id
    $BahanBaku = $BahanBakuModel->find($id);
    if (!$BahanBaku) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException("Bahan Baku dengan ID $id tidak ditemukan");
    }

    $jumlahInput = (int) $this->request->getPost('jumlah');

    // 🚫 Tolak kalau stok < 0
    if ($jumlahInput < 0) {
        return redirect()->to('/BahanBaku/edit/'.$id)
                        ->withInput()
                        ->with('errors', ['jumlah' => 'Jumlah tidak boleh kurang dari 0']);
    }

    // ✅ Update ke tabel BahanBaku
    $BahanBakuData = [
        'jumlah' => $jumlahInput,
    ];

    $BahanBakuModel->update($id, $BahanBakuData);
    session()->setFlashdata('success', '✅ Data Bahan Baku berhasil diedit!');

    return redirect()->to('/BahanBaku/display');
}



    public function delete($id)
    {
        $model = new ModelsBahanBaku();

        // cek status bahan baku dulu
        $canDelete = $model->deleteBahanBaku($id);

        if ($canDelete) {
            $model->where('id', $id)->delete();
            session()->setFlashdata('success', 'Data berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Data hanya bisa dihapus jika status = kadaluarsa');
        }

        return redirect()->to('/BahanBaku/display');
    }

    public function search()
{
    $keyword = $this->request->getVar('keyword');
    $model   = new ModelsBahanBaku();

    $builder = $model->select('id, nama, kategori, status');

    if ($keyword) {
        $builder->groupStart()
                ->like('nama', $keyword)
                ->orLike('kategori', $keyword)
                ->orLike('status', $keyword)
                ->groupEnd();
    }

    $data['bahan_baku'] = $builder->findAll();

    return view('CRUDBahanBaku/search', $data);
}

}
