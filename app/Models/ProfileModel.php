<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfileModel extends Model
{

    public function getPKP()
    {
        return $this->db->table('master_pkp')->get()->getResult();
    }

    public function getUser($id_ku)
    {
        return $this->db->table("master_admin")->select("*")->where('id', $id_ku, 1)->get();
    }

    public function getPKPUser($id_ku, $pkp_id)
    {
        return $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, b.id_pkp, c.nomor")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.status', 'AKTIF')->where('a.id_pkp !=', $pkp_id)->where('a.id_user', $id_ku)->get()->getResult();
    }

    public function getPKPUser2($pkp_id)
    {
        return $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, b.id_pkp, c.nomor")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.id_pkp', $pkp_id, 1)->get();
    }

    public function getPKPUser3($id_ku, $pkp_id)
    {
        return $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, b.id_pkp, c.nomor")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.id_pkp !=', $pkp_id)->where('a.id_user', $id_ku)->get();
    }

    public function editpassword($datapass)
    {
        extract($datapass);
        return $this->db->table('master_admin')->where('id', session('idadmin'))->update(['password' => $password]);

    }

}
