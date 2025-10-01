<?php

namespace App\Models;

use CodeIgniter\Model;

class TemplateModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'student_id';
    protected $allowedFields = ['student_id', 'user_id', 'entry_year'];
    protected $returnType = 'array';

    // Custom get
    public function getStudents()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT s.student_id, s.entry_year, u.full_name
            FROM students s
            JOIN users u ON s.user_id = u.user_id where u.role = 'student'
        ");
        return $query->getResultArray();
    }

    public function getJob()
    {
        return $this->findAll();
    }

    public function countStudents()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as total FROM students");
        return $query->getRow()->total;
    }
}
