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
        $data['pkpuser'] = $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, b.id_pkp, c.nomor")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.status', 'AKTIF')->where('a.id_pkp !=', $pkp_id)->where('a.id_user', $id_ku)->get()->getResult();

        $data['pkpuser2'] = $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, b.id_pkp, c.nomor")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.id_pkp', $pkp_id, 1)->get();

        $data['pkpuser3'] = $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, b.id_pkp, c.nomor")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.id_pkp !=', $pkp_id)->where('a.id_user', $id_ku)->get();
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

    public function gantiuserpkp()
    {
        $simpan = new ProfileModel();
        $post = $this->request->getPost();
        $postData = [
            'id_pkp' => $post['id_pkp'],
            'agent' => $this->request->getUserAgent(),

        ];
        $validation = [
            'id_pkp' => 'required',
        ];
        if (!$this->validate($validation)) {
            $this->session->setFlashdata('error', 'PKP harus dipilih');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            if ($simpan->simpandatauserpkp($postData)) {
                $this->session->setFlashdata('success', 'Berhasil update data');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata('error', 'Gagal melakukan update data');
                $redirectUrl = previous_url() ?? base_url();
            }

            $data['token'] = csrf_hash();
            return redirect()->to($redirectUrl);
        }
    }
}
