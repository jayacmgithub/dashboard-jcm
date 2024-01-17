<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfileModel;
use App\Models\DashboardModel;

class Profile extends BaseController
{

    public function __construct()
    {
        $this->dashboard = new DashboardModel();
        $this->profile = new ProfileModel();
        helper(['string', 'security', 'form', 'esc']);
    }
    public function index()
    {
        $data['kode'] = '05';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['judul'] = 'Profil';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('profile/index', $data);
    }

    public function password()
    {
        $data['kode'] = '05';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('password', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['judul'] = 'Ubah Password';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;

        return view('profile/password', $data);
    }

    public function user()
    {
        $data['kode'] = '05';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('password', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $id_ku = session('idadmin');
        $data['pkp'] = $this->profile->getPKP();
        $data['user'] = $this->profile->getUser($id_ku);
        $pkp_id = $data['user']->getRow()->pkp_user;
        $kategori_id = $data['user']->getRow()->kategori_user;
        //data pilihan
        $data['pkpuser'] = $this->profile->getPKPUser($pkp_id, $id_ku);

        //$data['katuser'] = $this->db->select("b.kategori_user, a.id, a.id_jabatan")->from("jabatan_user a")->join('kategori_user b', 'a.id_jabatan = b.id')->where('a.status', 'AKTIF')->where('a.id_jabatan !=', $kategori_id)->where('a.id_user', $id_ku)->get()->getResult();
        //data terecord
        $data['pkpuser2'] = $this->profile->getPKPUser2($pkp_id);

        $data['pkpuser3'] = $this->profile->getPKPUser3($pkp_id, $id_ku);

        $data['judul'] = 'DATA USER';
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('profile/user', $data);
    }

    public function ubahpassword()
    {
        $idQNS = session()->get('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $password = new ProfileModel();
        if (!level_user('password', 'index', $kategoriQNS, 'edit') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $validation = [
            'password' => 'required',
            'repassword' => 'required|matches[password]'
        ];
        if (!$this->validate($validation)) {
            $this->session->setFlashdata('error', 'Konfirmasi password tidak sesuai');
            $redirectUrl = previous_url() ?? base_url();

        } else {
            $post = $this->request->getPost();
            $datapass['password'] = password_hash($post['password'], PASSWORD_BCRYPT);

            if ($password->editpassword($datapass)) {
                $this->session->setFlashdata('success', 'Password berhasil diubah');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata('error', 'Gagal melakukan update password');
                $redirectUrl = previous_url() ?? base_url();
            }
        }

        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }
}
