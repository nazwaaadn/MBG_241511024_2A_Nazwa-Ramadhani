<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BahanBaku as ModelsBahanBaku;
use CodeIgniter\HTTP\ResponseInterface;

class BahanBaku extends BaseController
{
    public function index()
    {
        $model = new ModelsBahanBaku();
        $BahanBaku = $model->getBahanBaku();
        $data = [
            'title'   => 'Data Bahan Baku',
            'content' => view('CRUDBahanBaku/table', ['BahanBaku' => $BahanBaku])
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
                'errors' => [
                    'required'   => 'Nama wajib diisi'
                ]
            ],
            'kategori' => [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Kategori wajib diisi'
                ]
            ],
            'jumlah' => [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Jumlah wajib diisi'
                ]
            ],
            'satuan' => [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Satuan wajib diisi'
                ]
            ],
            'tanggal_masuk' => [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Tanggal Masuk wajib diisi'
                ]
            ],
            'tanggal_kadaluarsa' => [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Tanggal Kadaluarsa wajib diisi'
                ]
            ],
        ];

        if (! $this->validate($validationRules)) {
            return redirect()->to('/BahanBaku/add')
                            ->withInput()
                            ->with('errors', $this->validator->getErrors());
        }

        //  Insert ke tabel BahanBaku
        $BahanBakuData = [
            'nama' => $this->request->getPost('nama'),
            'kategori' => $this->request->getPost('kategori'),
            'jumlah' => $this->request->getPost('jumlah'),
            'satuan' => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'tanggal_kadaluarsa' => $this->request->getPost('tanggal_kadaluarsa'),
            'status' => 'Tersedia',
        ];

        $BahanBakuModel->insert($BahanBakuData);
        session()->setFlashdata('success', '✅ Data mahasiswa berhasil ditambahkan!');

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
                    'rules'  => 'required',
                    'errors' => [
                        'required'   => 'Jumlah wajib diisi'
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
            $id = $BahanBaku['id'];

            // 2️⃣ Update ke tabel BahanBaku
            $BahanBakuData = [
                'jumlah' => $this->request->getPost('jumlah'),
            ];

            $BahanBakuModel->update($id, $BahanBakuData);
            session()->setFlashdata('success', '✅ Data Bahan Baku berhasil Diedit!');

            return redirect()->to('/BahanBaku/display');
        }


    // public function delete($id)
    // {
    //     $model = new ModelsBahanBaku();
    //     $model->where('id', $id)->delete();

    //     return redirect()->to('/BahanBaku/display');
    // }
}
