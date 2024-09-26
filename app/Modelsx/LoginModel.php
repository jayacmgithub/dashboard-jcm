<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'master_admin';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function authUser($username)
    {
        $query = $this->db->table('master_admin')
            ->where('username', $username)
            // ->where('aktif', '1') // Uncomment if needed
            ->get();

        return $query->getRow();
    }

    public function rules()
    {
        return [
            'username' => 'required|min_length[5]|max_length[50]|alpha_numeric',
            'password' => 'required|min_length[8]|max_length[255]'
        ];
    }

    public function getKategoriUser($kategoriId)
    {
        $query = $this->db->table('kategori_user a')
            ->select('a.kategori_user, b.controller, b.nama_function')
            ->join('modul b', 'b.id = a.beranda')
            ->where('a.id', $kategoriId)
            ->get();

        return $query->getRowArray();
    }

  function auth_user($username)
    {
        return $this->db->table('master_admin')->getWhere(
            [
                'username' => $username,
                //'aktif' => '1',
            ]
        );
    }
}
