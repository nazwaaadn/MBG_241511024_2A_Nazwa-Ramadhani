<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TemplateController extends BaseController
{
    public function index()
    {
        $model = new Students();
        $students = $model->getStudents();
        $data = [
            'title'   => 'Data Mahasiswa',
            'content' => view('CRUDstudent/table', ['students' => $students])
        ];
        return view('layouts/main', $data);
    }

    public function detail($student_id)
    {
            $model = new Students();
            $students = $model->select('students.*, users.username, users.full_name, users.role')
                 ->join('users', 'users.user_id = students.user_id')
                 ->where('students.student_id', $student_id)
                 ->get()
                 ->getRowArray();


            $data = [
                'title'   => 'Data Mahasiswa',
                'content' => view('CRUDstudent/detail', ['students' => $students])
            ];
        
        return view('layouts/main', $data);
    }

    public function add()
    {
        $data = [
            'title'   => 'Add Mahasiswa',
            'content' => view('CRUDstudent/add')
        ];
        return view('layouts/main', $data);
    }

    public function store()
{
    $studentModel = new Students();
    $userModel    = new Users(); // Model untuk tabel users

    $validationRules = [
        'student_id' => [
            'rules'  => 'required|max_length[10]',
            'errors' => [
                'required'   => 'NIM wajib diisi',
                'max_length' => 'NIM maksimal 10 karakter'
            ]
        ],
        'username' => [
            'rules'  => 'required|max_length[10]',
            'errors' => [
                'required'   => 'Username wajib diisi',
                'max_length' => 'Username maksimal 10 karakter'
            ]
        ],
        'entry_year' => [
            'rules'  => 'required|exact_length[4]|numeric',
            'errors' => [
                'required'     => 'Tahun masuk wajib diisi',
                'exact_length' => 'Tahun masuk harus 4 karakter',
                'numeric'      => 'Tahun masuk harus berupa angka'
            ]
        ],
        'password' => [
            'rules'  => 'required|min_length[6]',
            'errors' => [
                'required'   => 'Password wajib diisi',
                'min_length' => 'Password minimal 6 karakter'
            ]
        ],
        'full_name' => [
            'rules'  => 'required|max_length[20]',
            'errors' => [
                'required'   => 'Nama wajib diisi',
                'max_length' => 'Nama maksimal 20 karakter'
            ]
        ]
    ];

    if (! $this->validate($validationRules)) {
        return redirect()->to('/students/add')
                        ->withInput()
                        ->with('errors', $this->validator->getErrors());
    }

    // 1️⃣ Insert ke tabel users
    $userData = [
        'username'  => $this->request->getPost('username'),
        'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'      => 'student', // default role mahasiswa
        'full_name' => $this->request->getPost('full_name'),
    ];

    $userModel->insert($userData);
    $user_id = $userModel->getInsertID(); // ambil user_id terbaru

    // 2️⃣ Insert ke tabel students
    $studentData = [
        'student_id' => $this->request->getPost('student_id'),
        'entry_year' => $this->request->getPost('entry_year'),
        'user_id'    => $user_id, // relasi ke tabel users
    ];

    $studentModel->insert($studentData);
    session()->setFlashdata('success', '✅ Data mahasiswa berhasil ditambahkan!');

    return redirect()->to('/students/display');
}


    public function edit($student_id)
    {
        $model = new Students();
        $students = $model->select('students.*, users.username, users.full_name, users.role')
                 ->join('users', 'users.user_id = students.user_id')
                 ->where('students.student_id', $student_id)
                 ->get()
                 ->getRowArray();
        $data = [
            'title'   => 'Edit Mahasiswa',
            'content' => view('CRUDstudent/edit', ['students' => $students])
        ];
        return view('layouts/main', $data);
    }

        public function update($student_id)
        {
            $studentModel = new Students();
            $userModel    = new Users();

            $validationRules = [
                'student_id' => [
                    'rules'  => 'required|max_length[10]',
                    'errors' => [
                        'required'   => 'NIM wajib diisi',
                        'max_length' => 'NIM maksimal 10 karakter'
                    ]
                ],
                'username' => [
                    'rules'  => 'required|max_length[10]',
                    'errors' => [
                        'required'   => 'Username wajib diisi',
                        'max_length' => 'Username maksimal 10 karakter'
                    ]
                ],
                'entry_year' => [
                    'rules'  => 'required|exact_length[4]|numeric',
                    'errors' => [
                        'required'     => 'Tahun masuk wajib diisi',
                        'exact_length' => 'Tahun masuk harus 4 karakter',
                        'numeric'      => 'Tahun masuk harus berupa angka'
                    ]
                ],
                'password' => [
                    'rules'  => 'permit_empty|min_length[6]', // biar password opsional saat update
                    'errors' => [
                        'min_length' => 'Password minimal 6 karakter'
                    ]
                ],
                'full_name' => [
                    'rules'  => 'required|max_length[20]',
                    'errors' => [
                        'required'   => 'Nama wajib diisi',
                        'max_length' => 'Nama maksimal 20 karakter'
                    ]
                ]
            ];

            if (! $this->validate($validationRules)) {
                return redirect()->to('/students/edit/'.$student_id)
                                ->withInput()
                                ->with('errors', $this->validator->getErrors());
            }

            // 🔎 Cari data student untuk dapetin user_id
            $student = $studentModel->find($student_id);
            if (!$student) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException("Mahasiswa dengan ID $student_id tidak ditemukan");
            }
            $user_id = $student['user_id'];

            // 1️⃣ Update ke tabel users
            $userData = [
                'username'  => $this->request->getPost('username'),
                'full_name' => $this->request->getPost('full_name'),
            ];

            // kalau password diisi, update juga
            $password = $this->request->getPost('password');
            if (!empty($password)) {
                $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $userModel->update($user_id, $userData);

            // 2️⃣ Update ke tabel students
            $studentData = [
                'student_id' => $this->request->getPost('student_id'),
                'entry_year' => $this->request->getPost('entry_year'),
            ];

            $studentModel->update($student_id, $studentData);
            session()->setFlashdata('success', '✅ Data mahasiswa berhasil Diedit!');

            return redirect()->to('/students/display');
        }


    public function delete($student_id)
    {
        $model = new Students();
        $model->where('student_id', $student_id)->delete();

        return redirect()->to('/students/display');
    }

    public function search()
    {
        $keyword = $this->request->getVar('keyword');
        $model   = new Students();

        $builder = $model->select('students.student_id, students.entry_year, users.full_name, users.username')
                        ->join('users', 'users.user_id = students.user_id');

        if ($keyword) {
            $builder->groupStart()
                    ->like('students.student_id', $keyword)
                    ->orLike('users.full_name', $keyword)
                    ->orLike('users.username', $keyword)
                    ->groupEnd();
        }

        $data['students'] = $builder->findAll();

        // return hanya isi <tr> supaya bisa replace tbody via ajax
        return view('CRUDstudent/mhs_table', $data);
    }
}
