<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    public function getUser()
    {
        return $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, b.kategori_user, c.no_pkp,d.nomor")->join('kategori_user b', 'a.kategori = b.id')->get()->getResult();
    }

    public function allUser()
    {
        $builder = $this->db->table("master_admin a");
        $builder->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor");
        $builder->join('kategori_user b', 'a.kategori = b.id');
        $builder->join('master_pkp c', 'a.pkp_akhir = c.id_pkp');
        $builder->join('master_instansi d', 'c.id_instansi = d.id');
        $builder->where('b.kategori_user !=', 'IT');

        return $builder->get()->getResult();
    }

    public function allDivisi($id_divisi)
    {
        return $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('d.id', $id_divisi)->get();
    }

    public function allProyek($pkp_user)
    {
        return $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('c.id_pkp', $pkp_user)->get();
    }
}

