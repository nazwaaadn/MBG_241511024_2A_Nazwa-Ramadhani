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


    // public function edit($student_id)
    // {
    //     $model = new ModelsBahanBaku();
    //     $BahanBaku = $model->select('BahanBaku.*, users.username, users.full_name, users.role')
    //              ->join('users', 'users.user_id = BahanBaku.user_id')
    //              ->where('BahanBaku.student_id', $student_id)
    //              ->get()
    //              ->getRowArray();
    //     $data = [
    //         'title'   => 'Edit Bahan Baku',
    //         'content' => view('CRUDBahanBaku/edit', ['BahanBaku' => $BahanBaku])
    //     ];
    //     return view('layoutadmin/main', $data);
    // }

    //     public function update($student_id)
    //     {
    //         $BahanBakuModel = new ModelsBahanBaku();
    //         $userModel    = new Users();

    //         $validationRules = [
    //             'student_id' => [
    //                 'rules'  => 'required|max_length[10]',
    //                 'errors' => [
    //                     'required'   => 'NIM wajib diisi',
    //                     'max_length' => 'NIM maksimal 10 karakter'
    //                 ]
    //             ],
    //             'username' => [
    //                 'rules'  => 'required|max_length[10]',
    //                 'errors' => [
    //                     'required'   => 'Username wajib diisi',
    //                     'max_length' => 'Username maksimal 10 karakter'
    //                 ]
    //             ],
    //             'entry_year' => [
    //                 'rules'  => 'required|exact_length[4]|numeric',
    //                 'errors' => [
    //                     'required'     => 'Tahun masuk wajib diisi',
    //                     'exact_length' => 'Tahun masuk harus 4 karakter',
    //                     'numeric'      => 'Tahun masuk harus berupa angka'
    //                 ]
    //             ],
    //             'password' => [
    //                 'rules'  => 'permit_empty|min_length[6]', // biar password opsional saat update
    //                 'errors' => [
    //                     'min_length' => 'Password minimal 6 karakter'
    //                 ]
    //             ],
    //             'full_name' => [
    //                 'rules'  => 'required|max_length[20]',
    //                 'errors' => [
    //                     'required'   => 'Nama wajib diisi',
    //                     'max_length' => 'Nama maksimal 20 karakter'
    //                 ]
    //             ]
    //         ];

    //         if (! $this->validate($validationRules)) {
    //             return redirect()->to('/BahanBaku/edit/'.$student_id)
    //                             ->withInput()
    //                             ->with('errors', $this->validator->getErrors());
    //         }

    //         // 🔎 Cari data student untuk dapetin user_id
    //         $student = $BahanBakuModel->find($student_id);
    //         if (!$student) {
    //             throw new \CodeIgniter\Exceptions\PageNotFoundException("Bahan Baku dengan ID $student_id tidak ditemukan");
    //         }
    //         $user_id = $student['user_id'];

    //         // 1️⃣ Update ke tabel users
    //         $userData = [
    //             'username'  => $this->request->getPost('username'),
    //             'full_name' => $this->request->getPost('full_name'),
    //         ];

    //         // kalau password diisi, update juga
    //         $password = $this->request->getPost('password');
    //         if (!empty($password)) {
    //             $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    //         }

    //         $userModel->update($user_id, $userData);

    //         // 2️⃣ Update ke tabel BahanBaku
    //         $studentData = [
    //             'student_id' => $this->request->getPost('student_id'),
    //             'entry_year' => $this->request->getPost('entry_year'),
    //         ];

    //         $BahanBakuModel->update($student_id, $studentData);
    //         session()->setFlashdata('success', '✅ Data mahasiswa berhasil Diedit!');

    //         return redirect()->to('/BahanBaku/display');
    //     }


    // public function delete($student_id)
    // {
    //     $model = new ModelsBahanBaku();
    //     $model->where('student_id', $student_id)->delete();

    //     return redirect()->to('/BahanBaku/display');
    // }
}
