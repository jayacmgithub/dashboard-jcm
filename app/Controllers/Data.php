<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardModel;
use App\Models\LoginModel;
use App\Models\MasterInstansiModel;
use App\Models\LaporanModel;
use App\Models\AksesModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;


class Data extends BaseController
{
    public function __construct()
    {
        $this->akses = new AksesModel();
        $this->loginModel = new LoginModel();
        $this->formValidation = \Config\Services::validation();
        $this->dashboard = new DashboardModel();
        $this->hcm = new MasterInstansiModel();
        $this->laporan = new LaporanModel();
        helper(['string', 'security', 'form', 'esc']);
    }
    public function index()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kode'] = '03';
        $data['judul'] = 'LAPORAN';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;

        return view('data/index', $data);
    }

    public function hcm()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'hcm', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        $pkp_akhir = $proyek->getRow()->pkp_akhir;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if ($pkp_akhir != '') {
            $divisi2 = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_akhir], 1);
            $id_divisi2 = $divisi2->getRow()->id_instansi;
        }

        if (level_user('setting', 'user', $kategoriQNS, 'all') > 0) {
            $data['hcm'] = $this->hcm->InstansiAll();
        } else {
            if (level_user('setting', 'user', $kategoriQNS, 'divisi') > 0) {
                $data['hcm'] = $this->hcm->InstansiDivisi($id_divisi);
            } else {
                $data['hcm'] = $this->hcm->InstansiProyek($pkp_user);
            }
        }
        $data['kategori'] = $kategoriQNS;
        $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();
        $data['karyawan'] = $this->db->table('master_admin a')->select("*")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.pkp_akhir !=', '')->where('aktif', '1')->orderBy('a.nama_admin')->get()->getResult();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['judul'] = '<a href="' . base_url() . 'laporan" style="color:white">HCM | </a> <a style="color:white">Data Karyawan</a>';

        return view('data/hcm/index', $data);
    }


    public function absensi()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'hcm', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        $pkp_akhir = $proyek->getRow()->pkp_akhir;
        //ambil id_proyek admin proyek
        $data['proyek'] = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $data['proyek']->getRow()->pkp_user;
        $data['proyek2'] = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
        $id_instansi = $data['proyek2']->getRow()->id_instansi;
        $data['instansi'] = $this->db->table('master_instansi')->getWhere(['id' => $id_instansi]);

        if (isset($_GET['filter1']) && !empty($_GET['filter1'])) {
            $filter1 = $_GET['filter1'];
        } else {
            $filter1 = '0';
        }
        if (isset($_GET['filter2']) && !empty($_GET['filter2'])) {
            $filter2 = $_GET['filter2'];
        } else {
            $filter2 = '0';
        }
        if (isset($_GET['bulan']) && !empty($_GET['bulan'])) {
            $bulan = $_GET['bulan'];
        } else {
            $bulan = '00';
        }
        if (isset($_GET['tahun']) && !empty($_GET['tahun'])) {
            $tahun = $_GET['tahun'];
        } else {
            $tahun = '00';
        }
        $url_export = '';
        $laporan = $this->laporan->view_laporan_absensi($filter1, $filter2, $tahun, $bulan);
        if ($filter1 = 1) {
            $url_export = 'laporan/export?filter1=1&tahun=' . $tahun . '&filter2=' . $filter2 . '&bulan=' . $bulan;
        }

        $data['option_bulan'] = $this->laporan->option_bulan($filter1);
        $data['option_tahun'] = $this->laporan->option_tahun($filter1);
        $data['laporan'] = $laporan;
        $data['url_export'] = base_url('index.php/' . $url_export);
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['judul'] = '<a href="' . base_url() . 'laporan" style="color:white">HCM | </a> <a style="color:white">Absensi</a>';

        return view('data/hcm/absensi', $data);
    }



    public function mkt()
    {
        $data['kode'] = '03';
        $data['judul'] = 'LIST MARKETING';
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


        $data['data_marketing'] = $this->db->table('data_marketing')->select("*")->orderBy('no_pkp')->get()->getResult();
        // LIST PROGRESS TENDER KONTRAK //
        $data['data_marketing1'] = $this->db->table('data_marketing')->select("*")->where('no_pkp', '')->where('menang !=', 'KALAH')->where('menang !=', 'MUNDUR')->where('menang !=', 'BATAL')->orderBy('tgl_undangan', 'DESC')->get()->getResult();

        // LIST DATA MASA KONTRUKSI //
        $data['data_marketing2'] = $this->db->table('data_marketing')->select("*")->where('no_pkp !=', '')->where('addendum_ke', '')->where('tgl_selesai_kont', null)->orWhere('tgl_finish != tgl_finish_all')->where('proses_add', '')->where('tgl_selesai_kont', null)->orWhere('tgl_finish = tgl_finish_all')->where('proses_add', '')->where('tgl_selesai_kont', null)->orderBy('nama_proyek', 'DESC')->get()->getResult();

        $data['data_marketing3'] = $this->db->table('data_marketing')
            ->select("*")
            ->where('tgl_addendum IS NOT NULL', null, false)
            ->where('addendum_ke !=', '')
            ->orderBy('no_pkp')
            ->get()
            ->getResult();

        $data['data_marketing2a'] = $this->db->table('data_marketing')->select("*")->where('tgl_finish != tgl_finish_all')->orderBy('tgl_finish_all', 'ASCD')->get()->getResult();

        // LIST ADDENDUM //
        $data['data_marketing4'] = $this->db->table("addendum a")->select("a.id_marketing,a.id_addendum,b.no_pkp,b.nama_proyek,a.addendum_ke,a.tgl_ba_surat,a.tgl_sph,a.tgl_nego,a.tgl_draft,a.tgl_sper,b.tgl_ubah")->join('data_marketing b', 'a.id_marketing = b.id_marketing')->where('b.tgl_finish_all >', 0)->where('a.tgl_selesai', null)->orderBy('b.tgl_finish_all')->get()->getResult();

        // LIST SELESAI //
        $data['data_marketing_s'] = $this->db->table('data_marketing')->select("*")->where('tgl_selesai_kont >', 0)->orderBy('tgl_finish_all', 'ASCD')->get()->getResult();

        // LIST KALAH/MUNDUR //
        $data['data_marketing_km'] = $this->db->table('data_marketing')->select("*")->where('menang', 'KALAH')->orWhere('menang', 'MUNDUR')->where('menang', 'BATAL')->get()->getResult();

        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('data/marketing/list', $data);
    }

    public function qs()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('qs', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;

        $data['proyek'] = $this->db->table('master_pkp')->select("*")->where('qs', '')->orderBy('no_pkp')->get()->getResult();
        $data['proyek_qs'] = $this->db->table('master_pkp')->select("*")->where('qs', 'QS')->orderBy('update_qs')->get()->getResult();
        $qs = $this->db->table('master_pkp')->select("*")->where('qs', 'QS')->orderBy('update_qs')->get()->getRow();
        $id_pkp = $qs->id_pkp;
        $builder = $this->db->table('pdf_qs');
        $builder->where('id_pkp', $id_pkp);
        $builder->orderBy('tgl_periode', 'DESC');
        $data['QN'] = $builder->get()->getResult();
        $data['judul'] = '<a href="' . base_url() . 'dashboard/beranda_08" style="color:white">QS | </a> <a style="color:white">Laporan Bulanan</a>';

        return view('data/qs/index', $data);
    }

    public function masalah_qs()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $kode = 'PKPa2113939c967ab231d27916ec7874401d1b68604QNS';
        level_user('qs', 'index', $kategoriQNS, 'read') > 0 ? '' : show_404();
        $data['instansi'] = $this->db->table('master_instansi')->get()->getResult();

        $data['proyek'] = $this->db->table('master_pkp')->where('id_pkp', $kode)->get()->getRow();
        $tgl = $data['proyek']->tgl_ubah_progress;
        $tahun = substr($tgl, 2, 2);
        $bulan = substr($tgl, 5, 2);

        $data['instansiQN'] = $this->db->table('master_pkp a')->select('b.nomor')->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get()->getRow();
        $data['nomorQN'] = $data['instansiQN']->nomor;

        $data['instansi2'] = $this->db->table('master_pkp a')->select('b.nomor')->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get()->getResult();
        $data['instansi3'] = $this->db->table('master_pkp a')->select('b.nomor,b.alias,b.ling')->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get();

        $data['paket'] = $this->db->table('progress_paket a')
            ->select("a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('pt_detil c', 'a.id_pt = c.id', 'left')
            ->join('pt_master d', 'c.id_pt = d.id', 'left')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $tahun)
            ->where('a.bulan', $bulan)
            ->orderBy("a.nomor", "ascd")
            ->get()->getResult();

        $data['proyek2'] = $this->db->table('progress_proyek a')
            ->select("b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $tahun)
            ->where('a.bulan', $bulan)
            ->get()->getResult();

        $data['cek_pro'] = $this->db->table('progress_proyek')->where('id_pkp', $kode)->get();

        $data['cek2'] = $this->db->table('dt_umum')->where('pkp', $kode)->get();

        $data['dt_umum'] = $this->db->table('dt_umum')->where('pkp', $kode)->orderBy('no_urut1', 'ascd')->get()->getResult();

        $data['solusi'] = $this->db->table('solusi a')
            ->select("a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'EKS')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()->getResult();

        $data['solusi2'] = $this->db->table('solusi a')
            ->select("a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'INT')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()->getResult();

        $data['gambar'] = $this->db->table('gambar a')
            ->select("a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_gbr')
            ->orderBy("a.kode", "desc")
            ->get();

        $data['dcr'] = $this->db->table('dcr a')
            ->select("a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.id_dcr = b.id_dcr')
            ->get()->getResult();

        $data['pdf'] = $this->db->table('pdf a')
            ->select("a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_dtt')
            ->orderBy("a.kode", "desc")
            ->get();

        $data['judul'] = '<a href="' . base_url() . 'dashboard/beranda_08" style="color:white">QS | </a><a style="color:white"> PERMASALAHAN </a> ';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;

        return view('data/qs/permasalahan', $data);
    }

    public function mon_kar_qs()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $kode = 'PKPa2113939c967ab231d27916ec7874401d1b68604QNS';
        if (!level_user('qs', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db->table('master_instansi')->get()->getResult();

        $data['proyek'] = $this->db->table('master_pkp')->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_progress;
        $tahun = substr($tgl, 2, 2);
        $bulan = substr($tgl, 5, 2);

        $data['instansiQN'] = $this->db->table('master_pkp a')->select("b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $satu = 1;
        $data['akses'] = $this->db->table('rule_akses')->getWhere(['id' => 'RULE1'], 1);
        $QN = $this->db->query("SELECT max(kode) as masKode FROM buka_akses WHERE id_pkp='$kode' and akses='KADIV' and urut='$satu' order by kode");
        $kode_akses = '';
        foreach ($QN->getResult() as $row) {
            $kode_akses = $row->masKode;
        }
        $data['buka_akses2'] = $this->akses->where('kode', $kode_akses)->findAll();
        $QN2 = $this->db->query("SELECT max(kode) as masKode FROM buka_akses WHERE id_pkp='$kode' and akses='KADIRAT' and urut='$satu' order by kode");
        $kode_akses2 = '';
        foreach ($QN2->getResult() as $row2) {
            $kode_akses2 = $row2->masKode;
        }
        $data['buka_akses22'] = $this->akses->where('kode', $kode_akses2)->findAll();

        $data['instansi2'] = $this->db->table("master_pkp a")->select("b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get()->getResult();
        $data['instansi3'] = $this->db->table("master_pkp a")->select("b.nomor,b.alias,b.ling")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get();

        $data['paket'] = $this->db->table("progress_paket a")->select("a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('pt_detil c', 'a.id_pt = c.id', 'left')->join('pt_master d', 'c.id_pt = d.id', 'left')->where('a.id_pkp', $kode)->where('a.tahun', $tahun)->where('a.bulan', $bulan)->orderBy("a.nomor", "ascd")->get()->getResult();

        $data['proyek2'] = $this->db->table("progress_proyek a")->select("b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.tahun', $tahun)->where('a.bulan', $bulan)->get()->getResult();

        $data['cek_pro'] = $this->db->table("progress_proyek")->where('id_pkp', $kode, 1)->get();

        $data['cek2'] = $this->db->table("dt_umum")->where('pkp', $kode, 1)->get();

        $data['dt_umum'] = $this->db->table("dt_umum")->select("*")->where('pkp', $kode)->orderBy('no_urut1', 'ascd')->get()->getResult();

        $data['solusi'] = $this->db->table("solusi a")->select("a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.type', 'EKS')->where('a.id_solusi = b.id_solusi')->orderBy('a.nomor', 'ascd')->get()->getResult();

        $data['solusi2'] = $this->db->table("solusi a")->select("a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.type', 'INT')->where('a.id_solusi = b.id_solusi')->orderBy('a.nomor', 'ascd')->get()->getResult();

        $data['gambar'] = $this->db->table("gambar a")->select("a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.tgl_ubah = b.tgl_ubah_gbr')->orderBy("a.kode", "desc")->get();

        $data['dcr'] = $this->db->table("dcr a")->select("a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.id_dcr = b.id_dcr')->get()->getResult();

        $data['pdf'] = $this->db->table("pdf a")->select("a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.tgl_ubah = b.tgl_ubah_dtt')->orderBy("a.kode", "desc")->get();

        $data['detil_karyawan'] = $this->db->table("detil_karyawan a")->select("b.sisa_cuti,b.tgl_kontrak,a.kode,a.bulan,a.id_pkp,a.pkp_sebelumnya,a.tahun,b.nama_admin,a.id_user,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,b.jabatan,a.ket_jabatan,a.tgl_ren_mob,a.tgl_ren_demob,a.tgl_real_mob,a.tgl_real_demob,b.habis_kontrak as 'tgl_akhir_kontrak',a.status,a.ket_mobdemob,a.ket_akhir,b.username,d.alias,b.pkp_akhir,b.tgl_respon")->join('master_admin b', 'a.nrp = b.username', 'left')->join('master_pkp c', 'a.id_pkp = c.id_pkp')->join('master_pkp d', 'a.pkp_sebelumnya = d.id_pkp')->where('a.id_pkp', $kode)->where('a.tgl_update = c.tgl_ubah_absensi')->orderBy('a.kode', 'ASCD')->get()->getResult();

        $data['detil_karyawan3'] = $this->db->table("detil_karyawan a")->select("a.kode,a.bulan,a.id_pkp,a.pkp_sebelumnya,a.tahun,b.nama_admin,a.id_user,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,b.jabatan,a.ket_jabatan,a.tgl_ren_mob,a.tgl_ren_demob,a.tgl_real_mob,a.tgl_real_demob,b.habis_kontrak as 'tgl_akhir_kontrak',a.status,a.ket_mobdemob,a.ket_akhir,b.username,d.alias,b.pkp_akhir")->join('master_admin b', 'a.nrp = b.username', 'left')->join('master_pkp c', 'a.id_pkp = c.id_pkp')->join('master_pkp d', 'a.pkp_sebelumnya = d.id_pkp')->where('a.id_pkp', $kode)->where('a.tgl_update = c.tgl_ubah_absensi')->orderBy('a.kode', 'ASCD')->get();

        if ($data['detil_karyawan3']->getNumRows() > 0) {

            $data['detil_karyawan2'] = $this->db->table("detil_karyawan a")->select("a.bulan,a.tahun,b.nama_admin,a.id_user,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,a.jabatan,a.ket_jabatan,a.tgl_ren_mob,a.tgl_ren_demob,a.tgl_real_mob,a.tgl_real_demob,a.tgl_akhir_kontrak,a.status,a.ket_mobdemob,a.ket_akhir,a.nrp")->join('master_admin b', 'a.nrp = b.username', 'left')->join('master_pkp c', 'a.id_pkp = c.id_pkp')->where('a.id_pkp', $kode)->where('a.tgl_update = c.tgl_ubah_absensi')->get()->getResultArray();
            $result2 = array_column($data['detil_karyawan2'], 'nrp');

            $data['detil_no_list'] = $this->db->table('master_admin')->select("*")->orWhereNotIn('username', $result2)->where('pkp_akhir', $kode)->where('aktif', '1')->get()->getResult();
        } else {
            $data['detil_no_list'] = $this->db->table('master_admin')->select("*")->where('pkp_akhir', $kode)->where('aktif', '1')->get()->getResult();
        }

        $data['judul'] = '<a href="' . base_url() . 'proyek" style="color:white">PROYEK | </a><a style="color:white">' . $data['proyek']->getRow()->alias . ' | </a> <a href="' . base_url() . $data['instansi3']->getRow()->ling . '" style="color:white">' . $data['instansi3']->getRow()->alias . '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;

        return view('data/qs/monitoring-karyawan-qs', $data);
    }

    public function mon_dcr_qs()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $kode = 'PKPa2113939c967ab231d27916ec7874401d1b68604QNS';
        if (!level_user('qs', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db->table('master_instansi')->get()->getResult();

        $data['proyek'] = $this->db->table('master_pkp')->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_dcr;
        $tahun = substr($tgl, 2, 2);
        $bulan = substr($tgl, 5, 2);

        $data['instansiQN'] = $this->db->table("master_pkp a")->select("b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $data['instansi2'] = $this->db->table("master_pkp a")->select("b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get()->getResult();
        $data['instansi3'] = $this->db->table("master_pkp a")->select("b.nomor,b.alias,b.ling")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $kode)->get();

        $data['paket'] = $this->db->table("progress_paket a")->select("a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('pt_detil c', 'a.id_pt = c.id', 'left')->join('pt_master d', 'c.id_pt = d.id', 'left')->where('a.id_pkp', $kode)->where('a.tahun', $tahun)->where('a.bulan', $bulan)->orderBy("a.nomor", "ascd")->get()->getResult();

        $data['proyek2'] = $this->db->table("progress_proyek a")->select("b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id_pkp', $kode)->where('a.tahun', $tahun)->where('a.bulan', $bulan)->get()->getResult();

        $data['cek_pro'] = $this->db->table("progress_proyek")->where('id_pkp', $kode, 1)->get();

        $data['cek2'] = $this->db->table("dt_umum")->where('pkp', $kode, 1)->get();

        $data['mon_dcr1'] = $this->db->table("mon_dcr")->select("*")->where('type', 'TOTAL')->where('id_pkp', $kode)->where('tgl_import', $tgl)->get()->getResult();
        $data['mon_dcr2'] = $this->db->table("mon_dcr")->select("*")->where('type !=', 'TOTAL')->where('id_pkp', $kode)->get()->getResult();
        $data['mon_dcr1a'] = $this->db->table("mon_dcr")->select("*")->where('type', 'TOTAL')->where('id_pkp', $kode)->get();

        $data['judul'] = '<a href="' . base_url() . 'proyek" style="color:white">PROYEK | </a><a style="color:white">' . $data['proyek']->getRow()->alias . ' | </a> <a href="' . base_url() . $data['instansi3']->getRow()->ling . '" style="color:white">' . $data['instansi3']->getRow()->alias . '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;

        return view('data/qs/monitoring-dcr-qs', $data);
    }

    public function import_pembaharuan()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'hcm', $kategoriQNS, 'edit') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategori'] = $this->db->table('kategori_user')->get()->getResult();
        $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();

        $data['judul'] = '<a href="' . base_url() . 'laporan" style="color:white">HCM | </a> <a href="' . base_url() . 'laporan/hcm" style="color:white">Pembaharuan Data | </a></a> <a style="color:white">Import</a>';

        $data['total_migrasi'] = $this->db->table("file_migrasi")->select("*")->where('tipe', 'DATA');
        $data['total1'] = $data['total_migrasi']->countAllResults();

        $errNRP = 0;
        $errNAMA = 0;
        $errLP = 0;
        $errMenikah = 0;
        $errDomisili = 0;
        $errKeluarga = 0;
        $QN = $this->db->query("SELECT * FROM file_migrasi where tipe='DATA' order by kode");
        foreach ($QN->getResult() as $row) {
            $m_nrp = $this->db->table("master_admin")->select("*")->where('username', $row->ket_1);
            if ($m_nrp->countAllResults() == 0) {
                $errNRP++;
            }

            $m_nama = $this->db->table("master_admin")->select("*")->where('username', $row->ket_1)->get()->getRow();
            $m_nama0 = $this->db->table("master_admin")->select("*")->where('username', $row->ket_1);
            if ($m_nama0->countAllResults() > 0) {
                if (strtoupper($m_nama->nama_admin) != strtoupper($row->ket_2)) {
                    $errNAMA++;
                }
            } else {
                $errNAMA++;
            }

            if (esc($row->ket_3) != 'L' and esc($row->ket_3) != 'P') {
                $errLP++;
            }
            if (esc($row->ket_10) != 'M' and esc($row->ket_10) != 'B') {
                $errMenikah++;
            }
            if (esc($row->ket_11) != 'LOKAL' and esc($row->ket_11) != 'NON LOKAL') {
                $errDomisili++;
            }
            if (esc($row->ket_12) != 'LOKAL' and esc($row->ket_12) != 'NON LOKAL') {
                $errKeluarga++;
            }
        }

        $data['total2'] = $errNRP + $errNAMA /*+ $errLP + $errDomisili + $errKeluarga*/;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        return view('data/imp_pembaharuan', $data);
    }
    public function dataimport2()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $pkp_user = $isi->pkp_user;
        $list = $this->laporan->getDataImport2();
        $data = array();

        foreach ($list as $r) {
            $m_nrp = $this->db->table("master_admin")->select("*")->where('username', $r->ket_1);
            if ($m_nrp->countAllResults() > 0) {
                $nrp = '<center>' . esc($r->ket_1);
            } else {
                $nrp = '<center style="background-color:red;text-align:center;color:white">' . esc($r->ket_1);
            }

            $m_nama = $this->db->table("master_admin")->select("*")->where('username', $r->ket_1)->get()->getRow();
            $m_nama0 = $this->db->table("master_admin")->select("*")->where('username', $r->ket_1);
            if ($m_nama0->countAllResults() > 0) {
                if (strtoupper($m_nama->nama_admin) != strtoupper($r->ket_2)) {
                    $nama = '<center style="background-color:red;text-align:center;color:white">' . 'x ' . esc($r->ket_2);
                } else {
                    $nama = '<center>' . esc($r->ket_2);
                }
            } else {
                $nama = '<center style="background-color:red;text-align:center;color:white">' . 'x ' . esc($r->ket_2);
            }

            if (esc($r->ket_3) == 'L' or esc($r->ket_3) == 'P') {
                $lp = '<center>' . esc($r->ket_3);
            } else {
                $lp = '<center  style="background-color:red;text-align:center;color:white">' . esc($r->ket_3);
            }

            if (esc($r->ket_10) == 'M' or esc($r->ket_10) == 'B') {
                $menikah = '<center>' . esc($r->ket_10);
            } else {
                $menikah = '<center  style="background-color:red;text-align:center;color:white">' . esc($r->ket_10);
            }
            if (esc($r->ket_11) == 'LOKAL' or esc($r->ket_11) == 'NON LOKAL') {
                $domisili = '<center>' . esc($r->ket_11);
            } else {
                $domisili = '<center  style="background-color:red;text-align:center;color:white">' . esc($r->ket_11);
            }
            if (esc($r->ket_12) == 'LOKAL' or esc($r->ket_12) == 'NON LOKAL') {
                $keluarga = '<center>' . esc($r->ket_12);
            } else {
                $keluarga = '<center  style="background-color:red;text-align:center;color:white">' . esc($r->ket_12);
            }
            if (esc($r->tgl_2) > 0) {
                $tgl_2 = esc(date('d-m-Y', strtotime($r->tgl_2)));
            } else {
                $tgl_2 = '';
            }
            if (esc($r->tgl_3) > 0) {
                $tgl_3 = esc(date('d-m-Y', strtotime($r->tgl_3)));
            } else {
                $tgl_3 = '';
            }
            if (esc($r->tgl_4) > 0) {
                $tgl_4 = esc(date('d-m-Y', strtotime($r->tgl_4)));
            } else {
                $tgl_4 = '';
            }
            $row = [];
            $row[] = $nrp;
            $row[] = $nama;
            $row[] = $lp;
            $row[] = esc(date('d-m-Y', strtotime($r->tgl_1)));
            $row[] = esc($r->ket_4);
            $row[] = esc($r->ket_5);
            $row[] = esc($r->ket_6);
            $row[] = esc($r->ket_7);
            $row[] = esc($r->ket_8);
            $row[] = $tgl_2;
            $row[] = $tgl_3;
            $row[] = $tgl_4;
            $row[] = esc($r->ket_9);
            $row[] = $menikah;
            $row[] = $domisili;
            $row[] = $keluarga;
            $data[] = $row;
        }
        $result = [
            "draw" => $this->request->getVar('draw'),
            "recordsTotal" => $this->laporan->count_all_datatable_import2(),
            "recordsFiltered" => $this->laporan->count_filtered_datatable_import2(),
            "data" => $data,
        ];
        return $this->response->setJSON($result);
    }


    public function edituser($id)
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $nrp = $isi->kode;
        if (!level_user('data', 'hcm', $kategoriQNS, 'edit') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['user2'] = $this->db->table('master_admin')->getWhere(['id' => $id], 1);
        $data['pkp_A'] = $data['user2']->getRow()->pkp_akhir;
        $data['nrp'] = $nrp;
        $data['user4'] = $this->db->table("pkp_user a")->select("d.kategori_user,b.alias, b.no_pkp, b.proyek, c.nomor, a.id, a.status, a.tgl_mutasi")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->join('kategori_user d', 'a.id_jabatan = d.id')->where('a.id_user', $id)->where('a.status', 'AKTIF')->orderBy('a.tgl_mutasi', 'DESC')->get();

        $data['user5'] = $this->db->table("master_pkp")->select("*")->where('id_pkp', $data['pkp_A'])->get();
        $data['kategori'] = $kategoriQNS;
        $data['pkp'] = $this->db->table('master_pkp')->orderBy('no_pkp')->get()->getResult();
        $data['kategori2'] = $this->db->table("master_admin a")->select("b.id, b.kategori_user, a.golongan")->join('kategori_user b', 'a.kategori = b.id')->where('a.id', $id, 1)->get();
        $kategori_id = $data['kategori2']->getRow()->id;
        $data['kategori3'] = $this->db->table('kategori_user')->getWhere(['id !=' => $kategori_id])->getResult();

        $data['golongan2'] = $this->db->table("master_admin a")->select("b.id, b.kode2, b.nilai, a.golongan")->join('master_golongan b', 'a.golongan = b.id')->where('a.id', $id, 1)->get();

        $golongan_id = $data['user2']->getRow()->golongan;
        if ($golongan_id != '') {
            $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->getWhere(['id !=' => $golongan_id])->getResult();
        } else {
            $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->getWhere(['id !=' => 'APRHAY 58'])->getResult();
        }

        $data['pkpuser'] = $this->db->table("pkp_user a")->select("b.alias, b.no_pkp, b.proyek, c.nomor, a.id, a.status, a.tgl_mutasi,d.kategori_user")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->join('kategori_user d', 'a.id_jabatan = d.id')->where('a.id_user', $id)->get()->getResult();

        $data['pkp_karyawan'] = $this->db->table("pkp_karyawan a")->select("b.alias, b.no_pkp, b.proyek, c.nomor, a.id_pkp_karyawan, a.status, a.tgl_mob,a.jabatan")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.id_user', $id)->get()->getResult();

        $data['pkpuser2'] = $this->db->table('pkp_user')->getWhere(['id_user' => $id])->getResult();


        $data['jabatan'] = $this->db->table("kategori_user")->select("*")->get()->getResult();

        $data['judul'] = '<a href="' . base_url() . 'laporan" style="color:white">HCM | </a> <a href="' . base_url() . 'laporan/hcm" style="color:white">Data Karyawan |</a> <a style="color:white">Edit';

        return view('data/hcm/edit-user', $data);
    }

    public function useredit_1()
    {
        $simpan = $this->laporan;
        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'pkp_sebelumnya' => $post['pkp_sebelumnya'],
            'tgl_lahir' => $post['tgl_lahir'],
            'tgl_masuk' => $post['tgl_masuk'],
            'tgl_kontrak' => $post['tgl_kontrak'],
            'tgl_kontrak_1' => $post['tgl_kontrak_1'],
            'pkp_akhir' => $post['pkp_akhir'],
            'nama_admin' => $post['nama_admin'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat'],
            'handphone' => $post['handphone'],
            'email' => $post['email'],
            'jabatan' => $post['jabatan'],
            'jurusan' => $post['jurusan'],
            'status_karyawan' => $post['status_karyawan'],
            'sisa_cuti' => $post['sisa_cuti'],
            'agent' => $this->request->getUserAgent()
        ];
        if ($simpan->updatedatauser_1($postData)) {
            $this->session->setFlashdata('success', 'berhasil menyimpan data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal update data');
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }
    public function useredit_2()
    {
        cekajax();
        $simpan = $this->laporan_model;
        if ($simpan->updatedatauser_2()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }
    public function useredit_3()
    {
        $simpan = $this->laporan;
        if ($simpan->updatedatauser_3()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }


    public function tambahproyekqs()
    {
        $postData =
            [
                'agent' => $this->request->getUserAgent(),
                'id_pkp' => $this->request->getPost('id_pkp'),
            ];
        $simpan = $this->laporan;
        if ($simpan->simpandataproyekqs($postData)) {
            $this->session->setFlashdata('success', 'berhasil menambah data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal menambah data');
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function tambah_lapbul()
    {
        $simpan = $this->laporan;

        if ($simpan->simpandatalapbul()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menambah data";
        } else {
            $errors['fail'] = "gagal melakukan tambah data";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }


    public function data_mkt($id_mkt)
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'marketing', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();
        $data['karyawan'] = $this->db->table('master_admin a')->select("*")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.pkp_akhir !=', '')->where('aktif', '1')->orderBy('a.nama_admin')->get()->getResult();

        $data['marketing'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->get();
        $data['marketing2'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->where('menang', 'MENANG')->where('no_pkp !=', '')->get();

        $data['tombol_edit'] = level_user('data', 'marketing', $kategoriQNS, 'read') > 0 ? '<li><a style="font-size:12px" href="' . base_url() . 'laporan/editdata_mkt/' . $id_mkt . '" onclick="edit(this)" data-id="' . $id_mkt . '">Edit</a></li>' : '';

        $data['data_addendum'] = $this->db->table("addendum a")->select("a.id_marketing,a.id_addendum,b.no_pkp,b.nama_proyek,a.addendum_ke,a.tgl_ba_surat,a.tgl_sph,a.tgl_nego,a.tgl_draft,a.tgl_sper,b.tgl_ubah,a.tgl_mulai,a.tgl_selesai,a.tgl_jaminan,a.nilai_jaminan,a.bast_1,a.bast_2,a.referensi,a.harga")->join('data_marketing b', 'a.id_marketing = b.id_marketing')->where('a.id_marketing', $id_mkt)->where('a.tgl_sper >', 0)->get();

        $data['dt_addendum'] = $this->db->table("addendum a")->select("a.id_marketing,a.id_addendum,b.no_pkp,b.nama_proyek,a.addendum_ke,a.tgl_ba_surat,a.tgl_sph,a.tgl_nego,a.tgl_draft,a.tgl_sper,b.tgl_ubah,a.tgl_mulai,a.tgl_selesai,a.tgl_jaminan,a.nilai_jaminan,a.bast_1,a.bast_2,a.referensi,a.harga")->join('data_marketing b', 'a.id_marketing = b.id_marketing')->where('a.id_marketing', $id_mkt)->where('a.tgl_sper >', 0)->orderBy('a.addendum_ke')->get()->getResult();

        $data['judul'] = '<a href="' . base_url() . 'dashboard/beranda_07" style="color:white">MARKETING | </a> <a href="' . base_url() . 'laporan/mkt" style="color:white">Data Kontrak</a>';

        return view('data/marketing/data-marketing', $data);
    }


    public function data_addendum($id_mkt)
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'marketing', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();
        $data['karyawan'] = $this->db->table('master_admin a')->select("*")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.pkp_akhir !=', '')->where('aktif', '1')->orderBy('a.nama_admin')->get()->getResult();
        $data['marketing'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->get();
        $data['marketing2'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->where('menang', 'MENANG')->where('no_pkp !=', '')->get();

        $data['dt_marketing2'] = $this->db->table("addendum a")->select("a.id_marketing,a.id_addendum,b.no_pkp,b.nama_proyek,a.addendum_ke,a.tgl_ba_surat,a.tgl_sph,a.tgl_nego,a.tgl_draft,a.tgl_sper,a.tgl_mulai,a.tgl_selesai")->join('data_marketing b', 'a.id_marketing = b. id_marketing')->where('a.id_marketing', $id_mkt)->where('b.tgl_finish >', 0)->where('a.tgl_sper', null)->get()->getResult();

        $data['marketing3'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->get();


        $data['judul'] = '<a href="' . base_url() . 'dashboard/beranda_07" style="color:white">MARKETING | </a> <a href="' . base_url() . 'laporan/mkt" style="color:white">Progress Addendum</a>';

        return view('data/marketing/data-addendum', $data);
    }

    public function data_marketing($id_mkt)
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'marketing', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategori'] = $this->db->table('kategori_user')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();
        $data['karyawan'] = $this->db->table('master_admin a')->select("*")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.pkp_akhir !=', '')->where('aktif', '1')->orderBy('a.nama_admin')->get()->getResult();
        $data['judul'] = '<a href="' . base_url() . 'dashboard/beranda_07" style="color:white">MARKETING | </a> <a href="' . base_url() . 'laporan/mkt" style="color:white">Progress Tender & Kontrak</a>';
        $data['marketing'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->get();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('data/marketing/tender', $data);
    }


    public function data_umum_mkt($id_mkt)
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'marketing', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategori'] = $this->db->table('kategori_user')->get()->getResult();
        $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();
        $data['karyawan'] = $this->db->table('master_admin a')->select("*")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.pkp_akhir !=', '')->where('aktif', '1')->orderBy('a.nama_admin')->get()->getResult();

        $data['marketing'] = $this->db->table("addendum a")->select("a.id_marketing,a.id_addendum,b.no_pkp,b.nama_proyek,a.addendum_ke,a.tgl_ba_surat,a.tgl_sph,a.tgl_nego,a.tgl_draft,a.tgl_sper,b.tgl_update_dtu,b.file")->join('data_marketing b', 'a.id_marketing = b. id_marketing')->where('a.id_marketing', $id_mkt)->get();
        $data['marketing2'] = $this->db->table("addendum a")->select("a.id_marketing,a.id_addendum,b.no_pkp,b.nama_proyek,a.addendum_ke,a.tgl_ba_surat,a.tgl_sph,a.tgl_nego,a.tgl_draft,a.tgl_sper")->join('data_marketing b', 'a.id_marketing = b. id_marketing')->where('a.id_marketing', $id_mkt)->where('b.tgl_finish >', 0)->get();
        $data['marketing3'] = $this->db->table("data_marketing")->select("*")->where('id_marketing', $id_mkt)->get();

        $data['gambar'] = $this->db->table("gambar_mkt a")->select("a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5")->join('data_marketing b', 'a.id_pkp = b.id_marketing')->where('a.id_pkp', $id_mkt)->where('a.tgl_ubah = b.tgl_update_foto')->orderBy("a.kode", "desc")->get();

        $data['judul'] = '<a href="' . base_url() . 'dashboard/beranda_07" style="color:white">MARKETING | </a> <a href="' . base_url() . 'laporan/mkt" style="color:white">Data Umum & Foto</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('data/marketing/du-foto', $data);
    }


    public function tambahkaryawan()
    {
        $post = $this->request->getPost();
        $simpan = $this->laporan;
        $validation = [
            'no_nrp' => 'required',
            'nama_admin' => 'required',
            'tgl_masuk' => 'required',
            'tgl_kontrak' => 'required',
            'tgl_lahir' => 'required'

        ];
        $postData = [
            'no_nrp' => $post['no_nrp'],
            'nama_admin' => $post['nama_admin'],
            'tgl_masuk' => $post['tgl_masuk'],
            'tgl_lahir' => $post['tgl_lahir'],
            'tgl_kontrak' => $post['tgl_kontrak'],
            'tgl_awal_kontrak' => $post['tgl_awal_kontrak'],
            'jabatan' => $post['jabatan'],
            'status_kontrak' => $post['status_kontrak'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat'],
            'handphone' => $post['handphone'],
            'email' => $post['email'],
            'jurusan' => $post['jurusan'],
            'pkp' => $post['pkp'],
            'agent' => $this->request->getUserAgent(),
        ];
        if (!$this->validate($validation)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            $this->session->setFlashdata('error', $errorMessages);
            $redirectUrl = previous_url() ?? base_url();

        } else {
            if ($simpan->simpandatakaryawan($postData)) {
                $this->session->setFlashdata('success', 'berhasil menambah data');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata('error', 'gagal menambah data');
                $redirectUrl = previous_url() ?? base_url();
            }
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }


    public function upload_pembaharuan_1()
    {
        $originalFileName = $this->request->getFile('excelfile')->getName();
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        $nama_file = csrf_hash() . '.' . $extension;

        $config = [
            'upload_path' => './excel/',
            'allowed_types' => 'xlsx',
            'file_name' => $nama_file,
            'max_size' => 2048,
            'overwrite' => true,
        ];

        $upload = Services::upload($config);

        $file = $this->request->getFile('excelfile');

        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($config['upload_path'], $config['file_name']);

            // File uploaded successfully
            $data = [
                'file_name' => $file->getName(),
                'file_path' => $config['upload_path'] . $file->getName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
            ];

            $aksi['result'] = 'success';
            $aksi['file'] = $data;
        } else {
            // Upload failed
            $error = $file->getErrorString();
            $aksi['result'] = 'failed';
            $aksi['error'] = $error;
        }

        $arraysub = array();
        if ($aksi['result'] == 'success') {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $data = [];
            $baris = 1;
            //THBL TGL BERJALAN//
            date_default_timezone_set("Asia/Jakarta");
            $now = date("Y-m-d");
            //ambil no urut terakhir//
            //INSTHBL-12345//
            $QN = $this->db->query("SELECT max(kode) as masKode FROM file_migrasi order by kode");
            foreach ($QN->getResult() as $row2) {
                $order = $row2->masKode;
            }
            $noUrut = (int) substr($order, 8, 5);
            $noUrut++;
            //BL masKode//
            $bulanL = substr($order, 5, 2);
            $bln = substr($now, 5, 2);
            $tahun = substr($now, 2, 2);
            if ($bln == $bulanL) {
                $kode = 'MIG' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
            } else {
                $kode = 'MIG' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'MIG' . md5($kode);
            $id2 = 'MIG' . hash("sha1", $id1) . 'QNS';

            foreach ($sheetData as $row) {
                $idQNS = session('idadmin');
                $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
                $pkp_user = $isi->pkp_user;
                if ($baris > 3) {
                    array_push(
                        $data,
                        [
                            'id' => $id2,
                            'kode' => $kode,
                            'tipe' => 'DATA',
                            'ket_1' => $row['B'],
                            'ket_2' => $row['C'],
                            'ket_3' => $row['D'],
                            'tgl_1' => $row['E'],
                            'ket_4' => $row['F'],
                            'ket_5' => $row['G'],
                            'ket_6' => $row['H'],
                            'ket_7' => $row['I'],
                            'ket_8' => $row['J'],
                            'tgl_2' => $row['K'],
                            'tgl_3' => $row['L'],
                            'tgl_4' => $row['M'],
                            'ket_9' => $row['N'],
                            'ket_10' => $row['O'],
                            'ket_11' => $row['P'],
                            'ket_12' => $row['Q'],
                            'ket_13' => $row['R'],
                        ]
                    );
                }
                $baris++;
                $noUrut++;
                $kode = 'MIG' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
                $id1 = 'MIG' . md5($kode);
                $id2 = 'MIG' . hash("sha1", $id1) . 'QNS';
            }
            if ($this->laporan->input_semua($data)) {
                //menghapus data yang tidak ada NRP nya

                $this->db->table('file_migrasi')->where('tipe', 'DATA')->where('ket_1', '');
                $this->session->setFlashdata('success', 'unggah pembaharuan');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata('error', 'gagal mengunggah');
                $redirectUrl = previous_url() ?? base_url();
            }
        } else {
            $errors['fail'] = $aksi['error'];
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function hapus_pembaharuan_1()
    {
        $hapus = $this->laporan;
        if ($hapus->hapusdatapembaharuan_1()) {
            $this->session->setFlashdata('success', 'berhasil menghapus data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal menghapus data');
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function proses_pembaharuan_1()
    {
        $postData = [
            'agent' => $this->request->getUserAgent(),
        ];
        $hapus = $this->laporan;
        if ($hapus->simpandatapembaharuan_1($postData)) {
            $this->session->setFlashdata('success', 'berhasil menambah data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal menyimpan data');
            $redirectUrl = previous_url() ?? base_url();
        }

        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function mutasi_karyawan()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_user' => $post['id_user'],
            'memo' => $post['memo'],
            'tgl_mob' => $post['tgl_mob'],
            'pkp_tujuan' => $post['pkp_tujuan'],
            'jabatan' => $post['jabatan'],
            'respon' => $post['respon'],
            'agent' => $this->request->getUserAgent(),
        ];
        $simpan = $this->laporan;
        if ($simpan->cekmemo($postData) > 0) {
            $this->session->setFlashdata('error', 'No SK Mutasi, TGL MOB & PKP TUJUAN Harus diisi...');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            if ($simpan->ceksudahrespon($postData) > 0) {
                $this->session->setFlashdata('error', 'data ini sudah direspon');
                $redirectUrl = previous_url() ?? base_url();

            } else {
                if ($simpan->mutasi_karyawan($postData)) {
                    $this->session->setFlashdata('success', 'berhasil menambah data');
                    $redirectUrl = previous_url() ?? base_url();
                } else {
                    $this->session->setFlashdata('error', 'gagal menyimpan data');
                    $redirectUrl = previous_url() ?? base_url();
                }
            }
        }
        $data['token'] = csrf_token();
        return redirect()->to($redirectUrl);
    }



    public function import_kry_baru()
    {
        $data['kode'] = '03';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('data', 'hcm', $kategoriQNS, 'edit') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategori'] = $this->db->table('kategori_user')->get()->getResult();
        $data['golongan'] = $this->db->table('master_golongan')->orderBy('kode2')->get()->getResult();
        $data['proyek'] = $this->db->table('master_pkp a')->select("a.no_pkp, a.id_pkp, a.alias , b.nomor")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('no_pkp')->get()->getResult();

        $data['judul'] = '<a href="' . base_url() . 'laporan" style="color:white">HCM | </a> <a href="' . base_url() . 'laporan/hcm" style="color:white">Data Karyawan | </a></a> <a style="color:white">Import</a>';

        $data['total_migrasi'] = $this->db->table("file_migrasi")->select("*")->where('tipe', 'BARU');
        $data['total1'] = $data['total_migrasi']->countAllResults();

        $errNRP = 0;
        $errPKP = 0;
        $errLP = 0;
        $QN = $this->db->query("SELECT * FROM file_migrasi where tipe='BARU' order by kode");
        foreach ($QN->getResult() as $row) {
            $m_nrp = $this->db->table("master_admin")->select("*")->where('username', $row->ket_1);
            if ($m_nrp->countAllResults() > 0) {
                $errNRP++;
            }
            $m_pkp = $this->db->table("master_pkp")->select("*")->where('no_pkp', $row->ket_2);
            if ($m_pkp->countAllResults() < 1) {
                $errPKP++;
            }
            if (esc($row->ket_4) != 'L' and esc($row->ket_4) != 'P') {
                $errLP++;
            }
        }

        $data['total2'] = $errNRP + $errPKP + $errLP;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('data/imp_kry_baru', $data);
    }


    public function dataimport1()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $pkp_user = $isi->pkp_user;
        $list = $this->laporan->getDataImport1();
        $data = array();

        foreach ($list as $r) {
            $m_nrp = $this->db->table("master_admin")->select("*")->where('username', $r->ket_1);
            if ($m_nrp->countAllResults() > 0) {
                $nrp = '<center style="background-color:red;text-align:center;color:white">' . esc($r->ket_1);
            } else {
                $nrp = '<center>' . esc($r->ket_1);
            }
            $m_pkp = $this->db->table("master_pkp")->select("*")->where('no_pkp', $r->ket_2);
            if ($m_pkp->countAllResults() > 0) {
                $pkp = '<center>' . esc($r->ket_2);
            } else {
                $pkp = '<center  style="background-color:red;text-align:center;color:white">' . esc($r->ket_2);
            }

            if (esc($r->ket_4) == 'L' or esc($r->ket_4) == 'P') {
                $lp = '<center>' . esc($r->ket_4);
            } else {
                $lp = '<center  style="background-color:red;text-align:center;color:white">' . esc($r->ket_4);
            }
            $row = array();
            $row[] = $nrp;
            $row[] = $pkp;
            $row[] = esc($r->ket_3);
            $row[] = esc(date('d-m-Y', strtotime($r->tgl_1))) . '<br>' . esc(date('d-m-Y', strtotime($r->tgl_2))) . '<br>' . esc(date('d-m-Y', strtotime($r->tgl_3)));
            $row[] = $lp;
            $row[] = esc($r->ket_5);
            $row[] = esc($r->ket_6);
            $row[] = esc($r->ket_7);
            $row[] = esc($r->ket_8);
            $row[] = esc($r->ket_9);
            $row[] = esc($r->ket_10);
            $data[] = $row;
        }
        $result = [
            "draw" => $this->request->getVar('draw'),
            "recordsTotal" => $this->laporan->count_all_datatable_import1(),
            "recordsFiltered" => $this->laporan->count_filtered_datatable_import1(),
            "data" => $data,
        ];
        return $this->response->setJSON($result);
    }

    public function upload_karyawan_1()
    {
        $originalFileName = $this->request->getFile('excelfile')->getName();
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        $nama_file = csrf_hash() . '.' . $extension;

        $config = [
            'upload_path' => './excel/',
            'allowed_types' => 'xlsx',
            'file_name' => $nama_file,
            'max_size' => 2048,
            'overwrite' => true,
        ];

        $upload = Services::upload($config);
        $file = $this->request->getFile('excelfile');
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($config['upload_path'], $config['file_name']);

            // File uploaded successfully
            $data = [
                'file_name' => $file->getName(),
                'file_path' => $config['upload_path'] . $file->getName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
            ];

            $aksi['result'] = 'success';
            $aksi['file'] = $data;
        } else {
            // Upload failed
            $error = $file->getErrorString();
            $aksi['result'] = 'failed';
            $aksi['error'] = $error;
        }

        $arraysub = array();
        if ($aksi['result'] == "success") {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $data = array();
            $baris = 1;
            //THBL TGL BERJALAN//
            date_default_timezone_set("Asia/Jakarta");
            $now = date("Y-m-d");
            //ambil no urut terakhir//
            //INSTHBL-12345//
            $QN = $this->db->query("SELECT max(kode) as masKode FROM file_migrasi order by kode");
            foreach ($QN->getResult() as $row2) {
                $order = $row2->masKode;
            }
            $noUrut = (int) substr($order, 8, 5);
            $noUrut++;
            //BL masKode//
            $bulanL = substr($order, 5, 2);
            $bln = substr($now, 5, 2);
            $tahun = substr($now, 2, 2);
            if ($bln == $bulanL) {
                $kode = 'MIG' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
            } else {
                $kode = 'MIG' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'MIG' . md5($kode);
            $id2 = 'MIG' . hash("sha1", $id1) . 'QNS';

            foreach ($sheetData as $row) {
                $idQNS = session('idadmin');
                $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
                $pkp_user = $isi->pkp_user;
                if ($baris > 3) {
                    array_push(
                        $data,
                        array(
                            'id' => $id2,
                            'kode' => $kode,
                            'tipe' => 'BARU',
                            'ket_1' => $row['B'],
                            'ket_2' => $row['C'],
                            'ket_3' => $row['D'],
                            'tgl_1' => $row['E'],
                            'tgl_2' => $row['F'],
                            'tgl_3' => $row['G'],
                            'ket_4' => $row['H'],
                            'ket_5' => $row['I'],
                            'ket_6' => $row['J'],
                            'ket_7' => $row['K'],
                            'ket_8' => $row['L'],
                            'ket_9' => $row['M'],
                            'ket_10' => $row['N'],

                        )
                    );
                }
                $baris++;
                $noUrut++;
                $kode = 'MIG' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
                $id1 = 'MIG' . md5($kode);
                $id2 = 'MIG' . hash("sha1", $id1) . 'QNS';
            }
            if ($this->laporan->input_semua($data)) {
                $data['success'] = true;
                $data['message'] = "Terimakasih cek kembali data anda sebelum di proses";
            } else {
                $errors['fail'] = 'gagal mengupload semua data, pastikan format upload';
                $data['errors'] = $errors;
            }
        } else {
            $errors['fail'] = $aksi['error'];
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }
}
