<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kategori', 'jumlah', 'satuan', 'tanggal_masuk', 'status'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Custom get
    // public function getStudents()
    // {
    //     $db = \Config\Database::connect();
    //     $query = $db->query("
    //         SELECT s.student_id, s.entry_year, u.full_name
    //         FROM students s
    //         JOIN users u ON s.user_id = u.user_id where u.role = 'student'
    //     ");
    //     return $query->getResultArray();
    // }

    public function getBahanBaku()
    {
        return $this->findAll();
    }

}
