<?php

namespace App\Models;

use CodeIgniter\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['pemohon_id', 'tgl_masak', 'menu_makan', 'jumlah_porsi', 'status'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType = 'array';

    public function getPermintaan()
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT p.id, p.pemohon_id, u.name AS nama_pemohon, 
                p.tgl_masak, p.menu_makan, p.jumlah_porsi, p.status
            FROM permintaan p
            JOIN user u ON u.id = p.pemohon_id
            WHERE p.status = 'menunggu'
        ");
        return $query->getResultArray();

    }

}
