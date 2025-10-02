<?php

namespace App\Models;

use CodeIgniter\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kategori', 'jumlah', 'satuan', 'tanggal_masuk', 'tanggal_kadaluarsa', 'status'];
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $returnType = 'array';

    public function getBahanBaku()
    {
        return $this->findAll();
    }

    public function getBahanTersedia()
    {
        return $this->where('status', 'tersedia')->findAll();
    }

    public function getTotalBahanBaku()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as total FROM bahan_baku");
        return $query->getRow()->total; // ambil nilai COUNT(*) nya
    }

    public function getTotalBahanBakuTersedia()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as total FROM bahan_baku WHERE status = 'tersedia'");
        return $query->getRow()->total;
    }

    public function getTotalBahanBakuKadaluarsa()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT COUNT(*) as total FROM bahan_baku WHERE status = 'kadaluarsa'");
        return $query->getRow()->total;
    }


    public function deleteBahanBaku($id)
    {
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT status FROM bahan_baku WHERE id = ? LIMIT 1
        ", [$id]);

        $result = $query->getRowArray();

        // return true kalau status = kadaluarsa
        return $result && $result['status'] === 'kadaluarsa';
    }
}
