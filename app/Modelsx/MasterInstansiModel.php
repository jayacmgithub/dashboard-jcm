<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterInstansiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'master_instansi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function InstansiAll()
    {
        return $this->db->table('master_admin a')
            ->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor,c.alias")
            ->join('kategori_user b', 'a.kategori = b.id')
            ->join('master_pkp c', 'a.pkp_akhir = c.id_pkp', 'left')
            ->join('master_instansi d', 'c.id_instansi = d.id', 'left')
            ->where('b.kategori_user !=', 'IT')
            ->orderBy('a.pkp_akhir')
            ->get()
            ->getResult();
    }

    public function InstansiDivisi($id_divisi)
    {
        return $this->db->table('master_admin a')
            ->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor,c.alias")
            ->join('kategori_user b', 'a.kategori = b.id')
            ->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')
            ->join('master_instansi d', 'c.id_instansi = d.id')
            ->where('d.id', $id_divisi)
            ->orderBy('a.pkp_akhir')
            ->get()
            ->getResult();
    }

    public function InstansiProyek($pkp_user)
    {
        return $this->db->table('master_admin a')
            ->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor,c.alias")
            ->join('kategori_user b', 'a.kategori = b.id')
            ->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')
            ->join('master_instansi d', 'c.id_instansi = d.id')
            ->where('c.id_pkp', $pkp_user)
            ->orderBy('a.pkp_akhir')
            ->get()
            ->getResult();
    }
}
