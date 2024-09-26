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


    function simpandatauserpkp($postData)
    {
        $id_pkp = $postData['id_pkp'];
        $id_user = session('idadmin');
        $pkp_user = $this->db->table("pkp_user")->select("*")->where('id_pkp', $id_pkp)->where('id_user', $id_user)->get();
        if (!empty($_FILES["logo"]["name"])) {
            $id = session('idadmin');
            $QN2 = $this->db->query("SELECT * FROM master_admin WHERE id='$id'");
            foreach ($QN2->getResult() as $row2) {
                $kode = $row2->kode;
            }
            $config['upload_path'] = './assets/foto/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['file_name'] = $kode;
            $config['overwrite'] = true;
            $config['max_size'] = 5024;
            $this->upload = \Config\Services::upload($config);

            if ($this->upload->do_upload('logo')) {
                $this->db->table('master_admin')->where('id', $id_user)->update(['foto' => $this->upload->data("file_name")]);
            }
        }
        $data3 = [
            "pkp_user" => $id_pkp,
            "kategori_user" => $pkp_user->getRow()->id_jabatan,
        ];

        return $this->db->table('master_admin')->where('id', $id_user)->update($data3);
    }




}
