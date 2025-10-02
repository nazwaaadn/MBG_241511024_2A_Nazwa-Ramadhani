<?php

namespace App\Models;

use CodeIgniter\Model;

class PermintaanDetail extends Model
{
    protected $table = 'permintaan_detail'; // tabel detail
    protected $primaryKey = 'id';
    protected $allowedFields = ['permintaan_id', 'bahan_id', 'jumlah_diminta'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType = 'array';

    public function getPermintaanDenganBahanById($id)
{
    $db = \Config\Database::connect();
    $query = $db->query("
        SELECT 
            pd.*, 
            p.*, 
            u.name AS nama_pemohon, 
            bb.nama AS nama_bahan,
            bb.kategori AS kategori_bahan,
            bb.status AS status_bahan
        FROM permintaan_detail pd
        JOIN permintaan p ON p.id = pd.permintaan_id
        JOIN user u ON u.id = p.pemohon_id
        JOIN bahan_baku bb ON bb.id = pd.bahan_id
        WHERE p.id = ?
    ", [$id]);

    return $query->getResultArray();
}

}

