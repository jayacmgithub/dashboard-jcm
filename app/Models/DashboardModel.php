<?php

namespace App\Models;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'dashboards';
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


    public function getId()
    {
        $id = session()->get('idadmin');

        return $this->db->table('master_admin')
            ->where('id', $id)
            ->get()
            ->getRow();
    }

    public function getOne()
    {
        $id = session()->get('idadmin');

        return $this->db->table('master_admin a')
            ->select('b.alias, b.no_pkp, c.nomor')
            ->join('master_pkp b', 'a.pkp_user = b.id_pkp')
            ->join('master_instansi c', 'b.id_instansi = c.id')
            ->join('kategori_user d', 'a.kategori_user = d.id')
            ->where('a.id', $id)
            ->get()
            ->getResult();
    }

    public function getTwo()
    {
        $id = session()->get('idadmin');

        return $this->db->table('master_admin a')
            ->select('b.alias, b.no_pkp, c.nomor, a.nama_admin, d.kategori_user')
            ->join('master_pkp b', 'a.pkp_user = b.id_pkp')
            ->join('master_instansi c', 'b.id_instansi = c.id')
            ->join('kategori_user d', 'a.kategori_user = d.id')
            ->where('a.id', $id)
            ->get()
            ->getRow();
    }

    public function getMaxKode()
    {
        $query = $this->db->table('log')
            ->selectMax('kode', 'masKode')
            ->orderBy('kode', 'desc')
            ->get();
        return $query->getResult();
    }
}
