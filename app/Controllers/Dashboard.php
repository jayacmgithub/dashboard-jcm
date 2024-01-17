<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    protected $loginModel;
    protected $formValidation;

    public function __construct()
    {

        $this->loginModel = new LoginModel();
        $this->formValidation = \Config\Services::validation();
        $this->dashboard = new DashboardModel();
        helper(['string', 'security', 'form']);
    }

    public function index()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;

        if ($data['pro1'] == 1) {
            if ($data['pro'] > 0) {
                return view('beranda/beranda-01', $data);
            } else {
                return view('beranda/beranda', $data);
            }
        } else {
            if ($data['pro7'] == 1) {
                redirect(base_url('dashboard/beranda_07'));
            } else {
                return view('beranda/beranda', $data);
            }
        }
    }

    public function beranda_01()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('beranda/beranda-01', $data);
    }

    public function beranda_02()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('beranda/beranda-02', $data);
    }
    public function beranda_03()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('beranda/beranda-03', $data);
    }
    public function beranda_04()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('beranda/beranda-04', $data);
    }
    public function beranda_05()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('beranda/beranda-05', $data);
    }
    public function beranda_06()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('beranda/beranda-06', $data);
    }
    public function beranda_07()
    {
        $data['kode'] = '01';
        $data['judul'] = 'MAIN DASHBOARD';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_terawan = date('Y-m-d', strtotime('-365 days', strtotime($now)));

        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $id_pkp2 = $isi->pkp_user;
        $username = $isi->username;
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;


        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
            $div = $this->db->table('master_instansi')->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $div->getRow()->nomor;
        }

        if (!level_user('dashboard', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '1', $kategoriQNS, 'read') > 0)) {
            $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro1'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '511')) {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '511')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 1;
            } else {
                $data['proyek1'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro1'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('gedung', '2', $kategoriQNS, 'read') > 0) /*or ($username == '10288')*/) {

            $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro2'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '512')) {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '512')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 1;
            } else {
                $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro2'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '1', $kategoriQNS, 'read') > 0)) {

            $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro3'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '611')) {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '611')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 1;
            } else {
                $data['ktl'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro3'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('ktl', '2', $kategoriQNS, 'read') > 0)) {

            $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro4'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '612')) {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '612')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 1;
            } else {
                $data['ktl2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro4'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '1', $kategoriQNS, 'read') > 0)) {

            $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro5'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '711')) {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '711')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 1;
            } else {
                $data['trans'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro5'] = 0;
            }
        }

        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('trans', '2', $kategoriQNS, 'read') > 0)) {

            $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->orderBy('b.no_pkp', 'DESC')->get()->getResult();
            $data['pro6'] = 1;
        } else {
            if ((level_user('dashboard', 'index', $kategoriQNS, 'proyek') > 0 and $no_divisi == '712')) {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', '712')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 1;
            } else {
                $data['trans2'] = $this->db->table("progress_proyek a")->select("a.tahun,a.bulan,a.alert,b.warning,b.late,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,b.alias,a.tgl_ubah_progress,b.tgl_close,b.validasi_kapro")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.akhir', 'A')->where('c.nomor', 'RAMBO 58')->where('b.id_pkp', $pkp_user)->orderBy('b.no_pkp', 'DESC')->get()->getResult();
                $data['pro6'] = 0;
            }
        }
        if ((level_user('dashboard', 'index', $kategoriQNS, 'all') > 0) or (level_user('dashboard', 'index', $kategoriQNS, 'divisi') > 0 and $no_divisi == '412')) {
            $data['marketing'] = $this->db->table('master_pkp a')->select("b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.tgl_ubah_progress >', '2010-01-01')->orderBy('b.nomor')->orderBy('a.no_pkp', 'DESC')->get()->getResult();
            $data['pro7'] = 1;
        } else {
            $data['pro7'] = 0;
        }
        $data['pro'] = $data['pro1'] + $data['pro2'] + $data['pro3'] + $data['pro4'] + $data['pro5'] + $data['pro6'] + $data['pro7'];
        $data['id_pkp2'] = $id_pkp2;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['data_marketing'] = $this->db->table('data_marketing')->select("*")->where('no_pkp', '')->where('menang !=', 'KALAH')->where('menang !=', 'MUNDUR')->where('menang !=', 'BATAL')->orderBy('tgl_undangan', 'DESC')->get()->getResult();
        return view('beranda/beranda-07', $data);
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
