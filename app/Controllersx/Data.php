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

        $data['total2'] = $errNRP + $errNAMA /*+ $errLP + $errDomisili + $errKeluarga*/ ;
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


    public function datausers()
    {
        $requestData = $this->request->getPost();
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        //ambil id_proyek admin proyek 
        $proyek = $this->db->table('master_admin')->getWhere(array('id' => $idQNS), 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        $pkp_akhir = $proyek->getRow()->pkp_akhir;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(array('id_pkp' => $pkp_user), 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if ($pkp_akhir != '') {
            $divisi2 = $this->db->table('master_pkp')->getWhere(array('id_pkp' => $pkp_akhir), 1);
            $id_divisi2 = $divisi2->getRow()->id_instansi;
        }

        //ALL
        if (level_user('setting', 'user', $kategoriQNS, 'all') > 0) {
            $builder = $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor,c.alias")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp', 'left')->join('master_instansi d', 'c.id_instansi = d.id', 'left')->where('b.kategori_user !=', 'IT')->orderBy('a.pkp_akhir')->get();
        } else {
            //divisi
            if (level_user('setting', 'user', $kategoriQNS, 'divisi') > 0) {
                $builder = $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor,c.alias")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('d.id', $id_divisi)->orderBy('a.pkp_akhir')->get();
            } else {
                //proyek
                $builder = $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor,c.alias")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('c.id_pkp', $pkp_user)->orderBy('a.pkp_akhir')->get();
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder->groupStart()
                ->like('a.username', $searchValue)
                ->orLike('a.nama_admin', $searchValue)
                ->orLike('a.jenis_kelamin', $searchValue)
                ->orLike('b.kategori_user', $searchValue)
                ->orLike('c.no_pkp', $searchValue)
                ->orLike('c.alias', $searchValue)
                ->orLike('d.nomor', $searchValue)
                ->groupEnd();
        }

        // Sorting
        if (isset($requestData['order']) && is_array($requestData['order']) && count($requestData['order']) > 0) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => null, // Kolom pertama tidak diurutkan
                1 => 'a.username', // Kolom tanggal
                2 => 'a.nama_admin', // Kolom kode dokumen
                3 => 'a.jenis_kelamin', // Kolom kode disiplin
                4 => 'b.kategori_user', // Kolom nomor DCR
                5 => 'c.no_pkp', // Kolom nomor dokumen
                6 => 'c.alias', // Kolom perihal
                7 => 'd.nomor' // Kolom status dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (array_key_exists($columnIndex, $columnMap) && $columnMap[$columnIndex] !== null) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('c.no_pkp', 'DESC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        // Apply limit and offset for pagination
        $builder->limit($requestData['length'], $requestData['start']);

        $list = $builder->get()->getResult();

        $no = 1;
        $data = [];
        foreach ($builder as $r) {
            $status = $r->aktif == '1' ? "<span class='btn btn-xs btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";

            //$kunci = esc($r->jml_pkp);
            $aktif = esc($r->aktif);
            if ($aktif > 0) {
                $tombolhapus = '';
            } else {
                $tombolhapus = level_user('setting', 'user', $kategoriQNS, 'delete') > 0 ? '<li><a style="font-size:12px" href="#" onclick="hapus(this)" data-id="' . $r->id . '">Hapus</a></li>' : '';
            }


          $tomboledit = level_user('setting', 'user', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="' . base_url('setting/edituser/' . $r->id) . '" onclick="edit(this)" data-id="' . $r->id . '">Edit</a></li>' : '';
            //$tomboledit = level_user('setting', 'user', $kategoriQNS, 'edit') > 0 ? '<li><a href="#" onclick="edit(this)" data-id="' . $r->id . '">Edit</a></li>' : '';

            $data[] = array(
                ' 
                    <div class="btn-group">
                        <button  style="font-size:12px" type="button" class="btn btn-primary" data-toggle="dropdown" aria-expanded="true">Action <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                             
                            ' . $tomboledit . '
                            ' . $tombolhapus . ' 
                        </ul>
                    </div>
            ',
                esc($r->nomor) . '/' . esc($r->no_pkp) . '<br>' . esc($r->alias),
                esc($r->nama_admin),
                esc($r->username),
                esc($r->email),
                esc($r->kategori_user),
                esc($r->jenis_kelamin),
                esc($status),
            );
            $no++;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
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

        // Generate a unique file name for the uploaded Excel file
        $randomBytes = random_bytes(16); // Adjust the length as needed
        $randomString = bin2hex($randomBytes);

        // Concatenate the random string with the file extension
        $nama_file = $randomString . '.' . $extension;

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

        // Generate a unique file name for the uploaded Excel file
        $randomBytes = random_bytes(16); // Adjust the length as needed
        $randomString = bin2hex($randomBytes);

        // Concatenate the random string with the file extension
        $nama_file = $randomString . '.' . $extension;

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

    public function export()
    {
        $filter1 = $_GET['filter1'];
        $filter2 = $_GET['filter2'];
        $bulan = $_GET['bulan'];
        $tahun = $_GET['tahun'];

        $excel = new Spreadsheet();
        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Karyawan")
            ->setSubject("Karyawan")
            ->setDescription("Laporan Semua Data Karyawan")
            ->setKeywords("Data Karyawan");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '535454'],
            ]
        ];

        $style_subjudul = [
            // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    // 'color' => ['rgb' => 'FFFFFF'],
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E8AC52'],
            ]
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_TOP // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN], // Set border top dengan garis tipis
            ]
        ];

        $style_alert = [
            // Set font nya jadi bold
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FFFF00'],
            ]
        ];
        if ($filter1 == '1' and $filter2 == '1') {
            $nos = -1;


            //REKAPAN TOTAL PROYEK
            $nos++;
            $objWorkSheet = $excel->createSheet($nos);
            $excel->setActiveSheetIndex($nos);
            $alias30 = substr('Rekapan ' . $bulan . '-' . $tahun, 0, 30);
            $objWorkSheet->setTitle($alias30);
            $excel->getActiveSheet();
            $YS00 = $this->db->table("master_admin a")->select("b.alias,b.id_pkp")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.pkp_akhir !=', '')->where('a.aktif', '1')->groupBy("b.id_pkp")->orderBy('b.no_pkp', 'ASCD')->get();
            $numrow = 2;
            //JUDUL
            $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "LAPORAN REKAP ABSENSI PT. JAYA CM");
            $numrow++;
            //JUDUL
            $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, 'NO.');
            $excel->setActiveSheetIndex($nos)->setCellValue('C' . $numrow, 'NAMA PROYEK');
            $excel->setActiveSheetIndex($nos)->setCellValue('D' . $numrow, 'JML KARYAWAN');
            $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, 'ABSENSI');
            $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, 'PENEMPATAN PKP');
            $numrow++;
            $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, 'SUDAH KIRIM');
            $excel->setActiveSheetIndex($nos)->setCellValue('F' . $numrow, 'BELUM KIRIM');
            $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, 'SESUAI');
            $excel->setActiveSheetIndex($nos)->setCellValue('H' . $numrow, 'TDK SESUAI');

            $numrowmin1 = $numrow - 1;
            //MERGE HEADER //numrow sudah di 6
            $excel->getActiveSheet($nos)->mergeCells('B' . $numrowmin1 . ':B' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('C' . $numrowmin1 . ':C' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('D' . $numrowmin1 . ':D' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('E' . $numrowmin1 . ':F' . $numrowmin1);
            $excel->getActiveSheet($nos)->mergeCells('G' . $numrowmin1 . ':H' . $numrowmin1);
            //STYLE HEADER
            $excel->getActiveSheet($nos)->getStyle('B' . $numrowmin1 . ':H' . $numrow)->applyFromArray($style_col);
            $excel->getActiveSheet($nos)->getStyle('B' . $numrowmin1 . ':H' . $numrow)->getAlignment()->setWrapText(true);
            //LEBAR
            $excel->getActiveSheet($nos)->getColumnDimension('A')->setWidth(1);
            $excel->getActiveSheet($nos)->getColumnDimension('B')->setWidth(5);
            $excel->getActiveSheet($nos)->getColumnDimension('C')->setWidth(40);
            $excel->getActiveSheet($nos)->getColumnDimension('D')->setWidth(20);
            $excel->getActiveSheet($nos)->getColumnDimension('E')->setWidth(10);
            $excel->getActiveSheet($nos)->getColumnDimension('F')->setWidth(10);
            $excel->getActiveSheet($nos)->getColumnDimension('G')->setWidth(10);
            $excel->getActiveSheet($nos)->getColumnDimension('H')->setWidth(10);

            $numrow++;
            $no = 1;
            foreach ($YS00->getResult() as $rys00) {
                $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, $no);
                $excel->setActiveSheetIndex($nos)->setCellValue('C' . $numrow, $rys00->alias);
                //jumlah orang
                $YS00A = $this->db->table("master_admin")->select("*")->where('pkp_akhir', $rys00->id_pkp)->where('aktif', '1')->get();
                $excel->setActiveSheetIndex($nos)->setCellValue('D' . $numrow, $YS00A->getNumRows());
                //jumlah sudah kirim data
                $YS00B = $this->db->table("detil_karyawan")->select("*")->where('tahun', $tahun)->where('bulan', $bulan)->where('id_pkp', $rys00->id_pkp)->get();
                if ($YS00B->getNumRows() > 0) {
                    $sudah = $YS00B->getNumRows();
                } else {
                    $sudah = '';
                }
                $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, $sudah);
                //jumlah belum kirim data
                if ($YS00A->getNumRows() > 0) {
                    $belum = $YS00A->getNumRows() - $YS00B->getNumRows();
                } else {
                    $belum = '';
                }
                $excel->setActiveSheetIndex($nos)->setCellValue('F' . $numrow, $belum);
                //sesuai
                $YS00C = $this->db->table("detil_karyawan")->select("*")->where('tahun', $tahun)->where('bulan', $bulan)->where('id_pkp', $rys00->id_pkp)->where('id_pkp = pkp_sebelumnya')->get();
                if ($YS00C->getNumRows() > 0) {
                    $sesuai = $YS00C->getNumRows();
                } else {
                    $sesuai = '';
                }
                $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, $sesuai);
                $YS00D = $this->db->table("detil_karyawan")->select("*")->where('tahun', $tahun)->where('bulan', $bulan)->where('id_pkp', $rys00->id_pkp)->where('id_pkp != pkp_sebelumnya')->get();
                if ($YS00D->getNumRows() > 0) {
                    $tdk_sesuai = $YS00D->getNumRows();
                } else {
                    $tdk_sesuai = '';
                }
                $excel->setActiveSheetIndex($nos)->setCellValue('H' . $numrow, $tdk_sesuai);
                //STYE ISIAN
                $excel->getActiveSheet($nos)->getStyle('B' . $numrow . ':H' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet($nos)->getStyle('B' . $numrow . ':H' . $numrow)->getAlignment()->setWrapText(true);
                if ($YS00B->getNumRows() < 1) {
                    $excel->getActiveSheet($nos)->getStyle('B' . $numrow . ':H' . $numrow)->applyFromArray($style_alert);
                }
                $numrow++;
                $no++;
            }


            //NAMA KARYAWAN YG SDH ABSENSI
            $nos++;
            $objWorkSheet = $excel->createSheet($nos);
            $excel->setActiveSheetIndex($nos);
            $alias30 = substr('Absensi ' . $bulan . '-' . $tahun, 0, 30);
            $objWorkSheet->setTitle($alias30);
            $excel->getActiveSheet();
            $QN00 = $this->db->table("detil_karyawan a")->select("b.alias,b.id_pkp")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.tahun', $tahun)->where('a.bulan', $bulan)->groupBy("b.id_pkp")->get();
            $numrow = 2;
            foreach ($QN00->getResult() as $data00) {
                //JUDUL
                $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "LAPORAN MOBILISASI/ DEMOBILISASI, ABSENSI DAN AKHIR KONTRAK KARYAWAN");
                $numrow++;
                $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "PROYEK : " . $data00->alias);
                $numrow++;
                $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "PERIODE : " . $bulan . ' ' . $tahun);
                $numrow++;
                //HEADER
                $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "NO");
                $excel->setActiveSheetIndex($nos)->setCellValue('C' . $numrow, "NRP");
                $excel->setActiveSheetIndex($nos)->setCellValue('D' . $numrow, "NAMA KARYAWAN");
                $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, "ABSENSI");

                $excel->setActiveSheetIndex($nos)->setCellValue('I' . $numrow, "KET. ABSENSI");
                $excel->setActiveSheetIndex($nos)->setCellValue('J' . $numrow, "JABATAN");
                $excel->setActiveSheetIndex($nos)->setCellValue('K' . $numrow, "POSISI");
                $excel->setActiveSheetIndex($nos)->setCellValue('L' . $numrow, "TGL AKHIR KONTRAK");
                $excel->setActiveSheetIndex($nos)->setCellValue('M' . $numrow, "MOB");
                $excel->setActiveSheetIndex($nos)->setCellValue('O' . $numrow, "DEMOB");
                $excel->setActiveSheetIndex($nos)->setCellValue('Q' . $numrow, "STATUS");
                $excel->setActiveSheetIndex($nos)->setCellValue('R' . $numrow, "Ket. MOB/DEMOB");
                $excel->setActiveSheetIndex($nos)->setCellValue('S' . $numrow, "MUTASI/ RESIGN");
                $numrow++;
                $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, "Sakit");
                $excel->setActiveSheetIndex($nos)->setCellValue('F' . $numrow, "Ijin");
                $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, "Alpha");
                $excel->setActiveSheetIndex($nos)->setCellValue('H' . $numrow, "Cuti");
                $excel->setActiveSheetIndex($nos)->setCellValue('M' . $numrow, "Renc");
                $excel->setActiveSheetIndex($nos)->setCellValue('N' . $numrow, "Real");
                $excel->setActiveSheetIndex($nos)->setCellValue('O' . $numrow, "Renc");
                $excel->setActiveSheetIndex($nos)->setCellValue('P' . $numrow, "Real");

                $numrowmin1 = $numrow - 1;
                //MERGE HEADER //numrow sudah di 6
                $excel->getActiveSheet($nos)->mergeCells('B' . $numrowmin1 . ':B' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('C' . $numrowmin1 . ':C' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('D' . $numrowmin1 . ':D' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('E' . $numrowmin1 . ':H' . $numrowmin1);
                $excel->getActiveSheet($nos)->mergeCells('I' . $numrowmin1 . ':I' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('J' . $numrowmin1 . ':J' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('K' . $numrowmin1 . ':K' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('L' . $numrowmin1 . ':L' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('M' . $numrowmin1 . ':N' . $numrowmin1);
                $excel->getActiveSheet($nos)->mergeCells('O' . $numrowmin1 . ':P' . $numrowmin1);
                $excel->getActiveSheet($nos)->mergeCells('Q' . $numrowmin1 . ':Q' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('R' . $numrowmin1 . ':R' . $numrow);
                $excel->getActiveSheet($nos)->mergeCells('S' . $numrowmin1 . ':S' . $numrow);
                //STYLE HEADER
                $excel->getActiveSheet($nos)->getStyle('B' . $numrowmin1 . ':S' . $numrow)->applyFromArray($style_col);
                $excel->getActiveSheet($nos)->getStyle('B' . $numrowmin1 . ':S' . $numrow)->getAlignment()->setWrapText(true);
                //LEBAR
                $excel->getActiveSheet($nos)->getColumnDimension('A')->setWidth(1);
                $excel->getActiveSheet($nos)->getColumnDimension('B')->setWidth(5);
                $excel->getActiveSheet($nos)->getColumnDimension('C')->setWidth(8);
                $excel->getActiveSheet($nos)->getColumnDimension('D')->setWidth(35);
                $excel->getActiveSheet($nos)->getColumnDimension('E')->setWidth(7);
                $excel->getActiveSheet($nos)->getColumnDimension('F')->setWidth(7);
                $excel->getActiveSheet($nos)->getColumnDimension('G')->setWidth(7);
                $excel->getActiveSheet($nos)->getColumnDimension('H')->setWidth(7);
                $excel->getActiveSheet($nos)->getColumnDimension('I')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('J')->setWidth(25);
                $excel->getActiveSheet($nos)->getColumnDimension('K')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('L')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('M')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('N')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('O')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('P')->setWidth(20);
                $excel->getActiveSheet($nos)->getColumnDimension('Q')->setWidth(20);
                $excel->getActiveSheet($nos)->getColumnDimension('R')->setWidth(15);
                $excel->getActiveSheet($nos)->getColumnDimension('S')->setWidth(15);

                //ISI DATA
                $QN01 = $this->db->table("detil_karyawan a")->select("a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,c.jabatan,a.ket_jabatan,a.tgl_akhir_kontrak,a.tgl_ren_mob,a.tgl_real_mob,a.tgl_ren_demob,a.tgl_real_demob,a.status,a.ket_mobdemob,a.ket_akhir,b.alias,c.username,c.nama_admin")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_admin c', 'a.id_user=c.id')->where('a.tahun', $tahun)->where('a.bulan', $bulan)->where('a.id_pkp', $data00->id_pkp)->orderBy('c.kode', 'ASCD')->get();
                $no = 1;
                $numrow++;
                foreach ($QN01->getResult() as $data01) {
                    if ($data01->tgl_akhir_kontrak > 0) {
                        $tgl_akhir_kontrak = (date('d-M-Y', strtotime(esc($data01->tgl_akhir_kontrak))));
                    } else {
                        $tgl_akhir_kontrak = '';
                    }
                    if ($data01->tgl_ren_mob > 0) {
                        $tgl_ren_mob = (date('d-M-Y', strtotime(esc($data01->tgl_ren_mob))));
                    } else {
                        $tgl_ren_mob = '';
                    }
                    if ($data01->tgl_real_mob > 0) {
                        $tgl_real_mob = (date('d-M-Y', strtotime(esc($data01->tgl_real_mob))));
                    } else {
                        $tgl_real_mob = '';
                    }
                    if ($data01->tgl_ren_demob > 0) {
                        $tgl_ren_demob = (date('d-M-Y', strtotime(esc($data01->tgl_ren_demob))));
                    } else {
                        $tgl_ren_demob = '';
                    }
                    if ($data01->tgl_real_demob > 0) {
                        $tgl_real_demob = (date('d-M-Y', strtotime(esc($data01->tgl_real_demob))));
                    } else {
                        $tgl_real_demob = '';
                    }
                    if ($data01->sakit > 0) {
                        $sakit = $data01->sakit;
                    } else {
                        $sakit = '';
                    }
                    if ($data01->ijin > 0) {
                        $ijin = $data01->ijin;
                    } else {
                        $ijin = '';
                    }
                    if ($data01->alpha > 0) {
                        $alpha = $data01->alpha;
                    } else {
                        $alpha = '';
                    }
                    if ($data01->cuti > 0) {
                        $cuti = $data01->cuti;
                    } else {
                        $cuti = '';
                    }
                    $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, $no);
                    $excel->setActiveSheetIndex($nos)->setCellValue('C' . $numrow, $data01->username);
                    $excel->setActiveSheetIndex($nos)->setCellValue('D' . $numrow, $data01->nama_admin);
                    $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, $sakit);
                    $excel->setActiveSheetIndex($nos)->setCellValue('F' . $numrow, $ijin);
                    $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, $alpha);
                    $excel->setActiveSheetIndex($nos)->setCellValue('H' . $numrow, $cuti);
                    $excel->setActiveSheetIndex($nos)->setCellValue('I' . $numrow, $data01->ket_absensi);
                    $excel->setActiveSheetIndex($nos)->setCellValue('J' . $numrow, $data01->jabatan);
                    $excel->setActiveSheetIndex($nos)->setCellValue('K' . $numrow, $data01->ket_jabatan);
                    $excel->setActiveSheetIndex($nos)->setCellValue('L' . $numrow, $tgl_akhir_kontrak);
                    $excel->setActiveSheetIndex($nos)->setCellValue('M' . $numrow, $tgl_ren_mob);
                    $excel->setActiveSheetIndex($nos)->setCellValue('N' . $numrow, $tgl_real_mob);
                    $excel->setActiveSheetIndex($nos)->setCellValue('O' . $numrow, $tgl_ren_demob);
                    $excel->setActiveSheetIndex($nos)->setCellValue('P' . $numrow, $tgl_real_demob);
                    $excel->setActiveSheetIndex($nos)->setCellValue('Q' . $numrow, $data01->status);
                    $excel->setActiveSheetIndex($nos)->setCellValue('R' . $numrow, $data01->ket_mobdemob);
                    $excel->setActiveSheetIndex($nos)->setCellValue('S' . $numrow, $data01->ket_akhir);
                    //STYE ISIAN
                    $excel->getActiveSheet($nos)->getStyle('B' . $numrow . ':S' . $numrow)->applyFromArray($style_row);
                    $excel->getActiveSheet($nos)->getStyle('B' . $numrow . ':S' . $numrow)->getAlignment()->setWrapText(true);
                    $no++;
                    $numrow++;
                }
                $numrow++;
                $numrow++;
            }
            //TAMPILKAN DATA BERMASALAH PKP
            $nos++;
            $objWorkSheet = $excel->createSheet($nos);
            $alias30 = substr('Data Tidak Sesuai ' . $bulan . '-' . $tahun, 0, 30);
            $objWorkSheet->setTitle($alias30);

            $numrow = 2;
            $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "LAPORAN KARYAWAN BELUM DIPINDAHKAN KE PROYEK BARU");
            $numrow++;
            $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "PERIODE : " . $bulan . ' ' . $tahun);
            $numrow++;
            //HEADER
            $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, "NO");
            $excel->setActiveSheetIndex($nos)->setCellValue('C' . $numrow, "NRP");
            $excel->setActiveSheetIndex($nos)->setCellValue('D' . $numrow, "NAMA KARYAWAN");
            $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, "PKP ABSENSI");
            $excel->setActiveSheetIndex($nos)->setCellValue('F' . $numrow, "PKP KARYAWAN");
            $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, "JABATAN");
            $excel->setActiveSheetIndex($nos)->setCellValue('H' . $numrow, "POSISI");
            $excel->setActiveSheetIndex($nos)->setCellValue('I' . $numrow, "TGL AKHIR KONTRAK");
            $excel->setActiveSheetIndex($nos)->setCellValue('J' . $numrow, "MOB");
            $excel->setActiveSheetIndex($nos)->setCellValue('L' . $numrow, "DEMOB");
            $excel->setActiveSheetIndex($nos)->setCellValue('N' . $numrow, "STATUS");
            $excel->setActiveSheetIndex($nos)->setCellValue('O' . $numrow, "Ket. MOB/DEMOB");
            $excel->setActiveSheetIndex($nos)->setCellValue('P' . $numrow, "MUTASI/ RESIGN");
            $numrow++;
            $excel->setActiveSheetIndex($nos)->setCellValue('J' . $numrow, "Renc");
            $excel->setActiveSheetIndex($nos)->setCellValue('K' . $numrow, "Real");
            $excel->setActiveSheetIndex($nos)->setCellValue('L' . $numrow, "Renc");
            $excel->setActiveSheetIndex($nos)->setCellValue('M' . $numrow, "Real");
            $numrowmin1 = $numrow - 1;
            //MERGE HEADER //numrow sudah di 6
            $excel->getActiveSheet($nos)->mergeCells('B' . $numrowmin1 . ':B' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('C' . $numrowmin1 . ':C' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('D' . $numrowmin1 . ':D' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('E' . $numrowmin1 . ':E' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('F' . $numrowmin1 . ':F' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('G' . $numrowmin1 . ':G' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('H' . $numrowmin1 . ':H' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('I' . $numrowmin1 . ':I' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('J' . $numrowmin1 . ':K' . $numrowmin1);
            $excel->getActiveSheet($nos)->mergeCells('L' . $numrowmin1 . ':M' . $numrowmin1);
            $excel->getActiveSheet($nos)->mergeCells('N' . $numrowmin1 . ':N' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('O' . $numrowmin1 . ':O' . $numrow);
            $excel->getActiveSheet($nos)->mergeCells('P' . $numrowmin1 . ':P' . $numrow);
            //STYLE HEADER
            $excel->getActiveSheet($nos)->getStyle('B' . $numrowmin1 . ':P' . $numrow)->applyFromArray($style_col);
            $excel->getActiveSheet($nos)->getStyle('B' . $numrowmin1 . ':P' . $numrow)->getAlignment()->setWrapText(true);
            //LEBAR
            $excel->getActiveSheet($nos)->getColumnDimension('A')->setWidth(1);
            $excel->getActiveSheet($nos)->getColumnDimension('B')->setWidth(5);
            $excel->getActiveSheet($nos)->getColumnDimension('C')->setWidth(10);
            $excel->getActiveSheet($nos)->getColumnDimension('D')->setWidth(35);
            $excel->getActiveSheet($nos)->getColumnDimension('E')->setWidth(35);
            $excel->getActiveSheet($nos)->getColumnDimension('F')->setWidth(35);
            $excel->getActiveSheet($nos)->getColumnDimension('G')->setWidth(20);
            $excel->getActiveSheet($nos)->getColumnDimension('H')->setWidth(20);
            $excel->getActiveSheet($nos)->getColumnDimension('I')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('J')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('K')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('L')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('M')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('N')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('O')->setWidth(15);
            $excel->getActiveSheet($nos)->getColumnDimension('P')->setWidth(15);
            //ISI DATA YG SALAH
            $QN02 = $this->db->table("detil_karyawan a")->select("a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,c.jabatan,a.ket_jabatan,a.tgl_akhir_kontrak,a.tgl_ren_mob,a.tgl_real_mob,a.tgl_ren_demob,a.tgl_real_demob,a.status,a.ket_mobdemob,a.ket_akhir,b.alias,c.username,c.nama_admin,d.alias as 'alias2'")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_admin c', 'a.id_user=c.id')->join('master_pkp d', 'a.pkp_sebelumnya = d.id_pkp')->where('a.tahun', $tahun)->where('a.bulan', $bulan)->where('a.id_pkp != a.pkp_sebelumnya')->where('c.aktif', '1')->orderBy('a.id_pkp', 'ASCD')->get();
            $no = 1;
            $numrow++;
            foreach ($QN02->getResult() as $data02) {
                if ($data02->tgl_akhir_kontrak > 0) {
                    $tgl_akhir_kontrak = (date('d-M-Y', strtotime(esc($data02->tgl_akhir_kontrak))));
                } else {
                    $tgl_akhir_kontrak = '';
                }
                if ($data02->tgl_ren_mob > 0) {
                    $tgl_ren_mob = (date('d-M-Y', strtotime(esc($data02->tgl_ren_mob))));
                } else {
                    $tgl_ren_mob = '';
                }
                if ($data02->tgl_real_mob > 0) {
                    $tgl_real_mob = (date('d-M-Y', strtotime(esc($data02->tgl_real_mob))));
                } else {
                    $tgl_real_mob = '';
                }
                if ($data02->tgl_ren_demob > 0) {
                    $tgl_ren_demob = (date('d-M-Y', strtotime(esc($data02->tgl_ren_demob))));
                } else {
                    $tgl_ren_demob = '';
                }
                if ($data02->tgl_real_demob > 0) {
                    $tgl_real_demob = (date('d-M-Y', strtotime(esc($data02->tgl_real_demob))));
                } else {
                    $tgl_real_demob = '';
                }
                $excel->setActiveSheetIndex($nos)->setCellValue('B' . $numrow, $no);
                $excel->setActiveSheetIndex($nos)->setCellValue('C' . $numrow, $data02->username);
                $excel->setActiveSheetIndex($nos)->setCellValue('D' . $numrow, $data02->nama_admin);
                $excel->setActiveSheetIndex($nos)->setCellValue('E' . $numrow, $data02->alias);
                $excel->setActiveSheetIndex($nos)->setCellValue('F' . $numrow, $data02->alias2);

                $excel->setActiveSheetIndex($nos)->setCellValue('G' . $numrow, $data02->jabatan);
                $excel->setActiveSheetIndex($nos)->setCellValue('H' . $numrow, $data02->ket_jabatan);
                $excel->setActiveSheetIndex($nos)->setCellValue('I' . $numrow, $tgl_akhir_kontrak);
                $excel->setActiveSheetIndex($nos)->setCellValue('J' . $numrow, $tgl_ren_mob);
                $excel->setActiveSheetIndex($nos)->setCellValue('K' . $numrow, $tgl_real_mob);
                $excel->setActiveSheetIndex($nos)->setCellValue('L' . $numrow, $tgl_ren_demob);
                $excel->setActiveSheetIndex($nos)->setCellValue('M' . $numrow, $tgl_real_demob);
                $excel->setActiveSheetIndex($nos)->setCellValue('N' . $numrow, $data02->status);
                $excel->setActiveSheetIndex($nos)->setCellValue('O' . $numrow, $data02->ket_mobdemob);
                $excel->setActiveSheetIndex($nos)->setCellValue('P' . $numrow, $data02->ket_akhir);

                //STYE ISIAN
                $excel->getActiveSheet()->getStyle('B' . $numrow . ':P' . $numrow)->applyFromArray($style_row);
                $excel->getActiveSheet()->getStyle('B' . $numrow . ':P' . $numrow)->getAlignment()->setWrapText(true);
                $no++;
                $numrow++;
            }
        }
        $nos++;
        $excel->removeSheetByIndex($nos);
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya


        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="LapMobDemob.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($excel);

        // Save the spreadsheet to a file (or output it to the browser)
        $writer->save('php://output');
        exit();
    }

public function karyawandetail()
    {
        $idd = $this->request->getGet("id");
        $query = $this->laporan->get_karyawan($idd);
        foreach ($query as $karyawan_data) {
            $instansi = $karyawan_data['no_pkp'];
            $pkp = $karyawan_data['alias'];
            $nomor_pkp = $instansi . ' / ' . $pkp;
            $result = array(
                "no_pkp" => $nomor_pkp
            );
        }
        $array[] = $result;
        echo '{"datarows":' . json_encode($array) . '}';
    }


    public function cetak_mon()
    {

        // Panggil class PHPExcel nya
        $excel = new Spreadsheet();

        // Settingan awal fil excel
        $excel->getProperties()->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle("Data Transaksi")
            ->setSubject("Transaksi")
            ->setDescription("Laporan Semua Data Transaksi")
            ->setKeywords("Data Transaksi");


        $style_header = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E1E0F7'],
            ],
            'font' => [
                'bold' => true,
            ]
        ];

        $warna_hijau = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '00FF00'],
            ]
        ];

        $gaya_tebal = [
            'font' => ['bold' => true]
        ];

        $gaya_kanan = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_RIGHT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        ];

        $gaya_tengah = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        ];

        $gaya_kiri = [
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ]
        ];

        $gaya_all_border = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];

        $gaya_border = [
            'borders' => [
                'top' => ['borderStyle' => Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle' => Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle' => Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle' => Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $gaya_samping_border = [
            'borders' => [
                'right' => ['borderStyle' => Border::BORDER_THIN],  // Set border right dengan garis tipis
                'left' => ['borderStyle' => Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $gaya_bawah_border = [
            'borders' => [
                'top' => ['borderStyle' => Border::BORDER_THIN], // Set border top dengan garis tipis
            ]
        ];



        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_updt = date("dd-mm-yyyy");
        $tgl_now = date('d-m-Y', strtotime($now));
        $tgl_1a = strtotime($now) - (7 * 24 * 60 * 60);
        $tgl_1 = date("d-m-Y", $tgl_1a);
        $tgl_1b = date("Y-m-d", $tgl_1a);
        $excel->setActiveSheetIndex(0);
        $excel->getActiveSheet()->setCellValue('B2', "MONITORING");
        $excel->getActiveSheet()->setCellValue('B3', 'DATA UPDATE DASHBOARD');
        $excel->getActiveSheet()->setCellValue('L5', 'Update :');
        $excel->getActiveSheet()->setCellValue('M5', $tgl_updt);
        $excel->getActiveSheet()->getStyle('B2:M5')->getFont()->setBold(TRUE);

        $excel->getActiveSheet()->setCellValue('B6', "No");
        $excel->getActiveSheet()->setCellValue('C6', "INS");
        $excel->getActiveSheet()->setCellValue('D6', "PKP");
        $excel->getActiveSheet()->setCellValue('E6', "Nama Proyek");
        $excel->getActiveSheet()->setCellValue('F6', "Start Proyek");
        $excel->getActiveSheet()->setCellValue('G6', "Laporan");
        $excel->getActiveSheet()->setCellValue('G7', "PROGRESS");
        $excel->getActiveSheet()->setCellValue('H7', "PERMASALAHAN");
        $excel->getActiveSheet()->setCellValue('I7', "MONITORING KARYAWAN");
        $excel->getActiveSheet()->setCellValue('J7', "FOTO");
        $excel->getActiveSheet()->setCellValue('K7', "DATA UMUM");
        $excel->getActiveSheet()->setCellValue('L7', "DATA TEKNIS");
        $excel->getActiveSheet()->setCellValue('M6', "KET");

        $excel->getActiveSheet()->mergeCells('B6:B8');
        $excel->getActiveSheet()->mergeCells('C6:C8');
        $excel->getActiveSheet()->mergeCells('D6:D8');
        $excel->getActiveSheet()->mergeCells('E6:E8');
        $excel->getActiveSheet()->mergeCells('F6:F8');
        $excel->getActiveSheet()->mergeCells('G6:L6');
        $excel->getActiveSheet()->mergeCells('G7:G8');
        $excel->getActiveSheet()->mergeCells('H7:H8');
        $excel->getActiveSheet()->mergeCells('I7:I8');
        $excel->getActiveSheet()->mergeCells('J7:J8');
        $excel->getActiveSheet()->mergeCells('K7:K8');
        $excel->getActiveSheet()->mergeCells('L7:L8');
        $excel->getActiveSheet()->mergeCells('M6:M8');

        //mainkan gaya header
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(2);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(6);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(6);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $excel->getActiveSheet()->getStyle('B6:M8')->applyFromArray($style_header);
        $excel->getActiveSheet()->getStyle('B6:M8')->applyFromArray($gaya_tengah);
        $excel->getActiveSheet()->getStyle('B6:M9')->applyFromArray($gaya_all_border);
        $excel->getActiveSheet()->getStyle('L5')->applyFromArray($gaya_kanan);



        // looping instansi
        $qns01 = $this->db->table("master_instansi")->select("*")->where('ling !=', '')->orderBy('ling', 'ASCD')->get();
        $numrow = 10;
        if ($qns01->getNumRows() > 0) {
            foreach ($qns01->getResult() as $rqns01) {
                $excel->getActiveSheet()->setCellValue('B' . $numrow, $rqns01->nama);
                $numrow++;
                //looping proyek
                $qns02 = $this->db->table("master_pkp")->select("*")->where('id_instansi', $rqns01->id)->where('tgl_ubah_progress >', 0)->where('no_pkp !=', 000)->orderBy('no_pkp', 'ASCD')->get();
                $urut = 1;
                if ($qns02->getNumRows() > 0) {
                    foreach ($qns02->getResult() as $rqns02) {
                        if ($rqns02->tgl_ubah_progress == '0001-11-30') {
                            $tgl_progress = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_progress > 0) {
                            $tgl_progress = date('d-m-Y', strtotime($rqns02->tgl_ubah_progress));
                        } else {
                            $tgl_progress = ' ';
                        }
                        // =================================================================================================           
                        if ($rqns02->tgl_ubah_masalah == '0001-11-30') {
                            $tgl_masalah = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_masalah > 0) {
                            $tgl_masalah = date('d-m-Y', strtotime($rqns02->tgl_ubah_masalah));
                        } else {
                            $tgl_masalah = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_absensi == '0001-11-30') {
                            $tgl_absensi = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_absensi > 0) {
                            $tgl_absensi = date('d-m-Y', strtotime($rqns02->tgl_ubah_absensi));
                        } else {
                            $tgl_absensi = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_dtu == '0001-11-30') {
                            $tgl_dtu = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_dtu > 0) {
                            $tgl_dtu = date('d-m-Y', strtotime($rqns02->tgl_ubah_dtu));
                        } else {
                            $tgl_dtu = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_gbr == '0001-11-30') {
                            $tgl_gbr = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_gbr > 0) {
                            $tgl_gbr = date('d-m-Y', strtotime($rqns02->tgl_ubah_gbr));
                        } else {
                            $tgl_gbr = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_dtt == '0001-11-30') {
                            $tgl_dtt = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_dtt > 0) {
                            $tgl_dtt = date('d-m-Y', strtotime($rqns02->tgl_ubah_dtt));
                        } else {
                            $tgl_dtt = ' ';
                        }
                        //masukkan data kedalam cell
                        $excel->getActiveSheet()->setCellValue('B' . $numrow, $urut);
                        $excel->getActiveSheet()->setCellValue('C' . $numrow, $rqns01->nomor);
                        $excel->getActiveSheet()->setCellValue('D' . $numrow, $rqns02->no_pkp);
                        $excel->getActiveSheet()->setCellValue('E' . $numrow, $rqns02->alias);
                        $excel->getActiveSheet()->setCellValue('F' . $numrow, "TGL MULAI");
                        $excel->getActiveSheet()->setCellValue('G' . $numrow, $tgl_progress);
                        $excel->getActiveSheet()->setCellValue('H' . $numrow, $tgl_masalah);
                        $excel->getActiveSheet()->setCellValue('I' . $numrow, $tgl_absensi);
                        $excel->getActiveSheet()->setCellValue('J' . $numrow, $tgl_gbr);
                        $excel->getActiveSheet()->setCellValue('K' . $numrow, $tgl_dtu);
                        $excel->getActiveSheet()->setCellValue('L' . $numrow, $tgl_dtt);
                        $excel->getActiveSheet()->setCellValue('M' . $numrow, "");

                        //add style
                        $rnumrow = $numrow - 1;
                        $excel->getActiveSheet()->getStyle('B' . $numrow . ':D' . $numrow)->applyFromArray($gaya_tengah);
                        $excel->getActiveSheet()->getStyle('G' . $numrow . ':L' . $numrow)->applyFromArray($gaya_tengah);
                        $excel->getActiveSheet()->getStyle('B' . $rnumrow . ':M' . $numrow)->applyFromArray($gaya_all_border);

                        $numrow++;
                        $urut++;
                    }
                }
            }
        }
        $numrow++;
        $excel->getActiveSheet()->setCellValue('B' . $numrow, 'DIVISI/Biro :');
        $numrow++;
        $urut = 1;
        $qns01 = $this->db->table("master_instansi")->select("*")->orderBy('ling', 'ASCD')->get();
        if ($qns01->getNumRows() > 0) {
            foreach ($qns01->getResult() as $rqns01) {
                //looping proyek
                $qns02 = $this->db->table("master_pkp")->select("*")->where('id_instansi', $rqns01->id)->where('no_pkp', '000')->orderBy('no_pkp', 'ASCD')->get();
                if ($qns02->getNumRows() > 0) {
                    foreach ($qns02->getResult() as $rqns02) {
                        //hitung total
                        if ($rqns02->tgl_ubah_progress == '0001-11-30') {
                            $tgl_progress = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_progress > 0) {
                            $tgl_progress = date('d-m-Y', strtotime($rqns02->tgl_ubah_progress));
                        } else {
                            $tgl_progress = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_masalah == '0001-11-30') {
                            $tgl_masalah = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_masalah > 0) {
                            $tgl_masalah = date('d-m-Y', strtotime($rqns02->tgl_ubah_masalah));
                        } else {
                            $tgl_masalah = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_absensi == '0001-11-30') {
                            $tgl_absensi = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_absensi > 0) {
                            $tgl_absensi = date('d-m-Y', strtotime($rqns02->tgl_ubah_absensi));
                        } else {
                            $tgl_absensi = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_dtu == '0001-11-30') {
                            $tgl_dtu = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_dtu > 0) {
                            $tgl_dtu = date('d-m-Y', strtotime($rqns02->tgl_ubah_dtu));
                        } else {
                            $tgl_dtu = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_gbr == '0001-11-30') {
                            $tgl_gbr = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_gbr > 0) {
                            $tgl_gbr = date('d-m-Y', strtotime($rqns02->tgl_ubah_gbr));
                        } else {
                            $tgl_gbr = ' ';
                        }
                        // =================================================================================================
                        if ($rqns02->tgl_ubah_dtt == '0001-11-30') {
                            $tgl_dtt = 'SUDAH INPUT ?';
                        } else if ($rqns02->tgl_ubah_dtt > 0) {
                            $tgl_dtt = date('d-m-Y', strtotime($rqns02->tgl_ubah_dtt));
                        } else {
                            $tgl_dtt = ' ';
                        }
                        //hitung total
                        //masukkan data kedalam cell
                        $excel->getActiveSheet()->setCellValue('B' . $numrow, $urut);
                        $excel->getActiveSheet()->setCellValue('C' . $numrow, $rqns01->nomor);
                        $excel->getActiveSheet()->setCellValue('D' . $numrow, $rqns02->no_pkp);
                        $excel->getActiveSheet()->setCellValue('E' . $numrow, $rqns02->alias);
                        $excel->getActiveSheet()->setCellValue('F' . $numrow, "TGL MULAI");
                        $excel->getActiveSheet()->setCellValue('G' . $numrow, $tgl_progress);
                        $excel->getActiveSheet()->setCellValue('H' . $numrow, $tgl_masalah);
                        $excel->getActiveSheet()->setCellValue('I' . $numrow, $tgl_absensi);
                        $excel->getActiveSheet()->setCellValue('J' . $numrow, $tgl_gbr);
                        $excel->getActiveSheet()->setCellValue('K' . $numrow, $tgl_dtu);
                        $excel->getActiveSheet()->setCellValue('L' . $numrow, $tgl_dtt);
                        $excel->getActiveSheet()->setCellValue('M' . $numrow, "");

                        //add style
                        $rnumrow = $numrow - 1;
                        $excel->getActiveSheet()->getStyle('B' . $numrow . ':D' . $numrow)->applyFromArray($gaya_tengah);
                        $excel->getActiveSheet()->getStyle('G' . $numrow . ':L' . $numrow)->applyFromArray($gaya_tengah);
                        $excel->getActiveSheet()->getStyle('B' . $rnumrow . ':M' . $numrow)->applyFromArray($gaya_all_border);

                        $numrow++;
                        $urut++;
                    }
                }
            }
        }
        $excel->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        // Set judul file excel nya
        $excel->getActiveSheet()->setTitle("Monitoring-Updt-Dashboard");
        $excel->getActiveSheet();

        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Mon-Dashboard.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($excel);

        // Save the spreadsheet to a file (or output it to the browser)
        $writer->save('php://output');
        exit();
    }

 public function useredit_1()
    {
        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'tgl_lahir' => $post['tgl_lahir'],
            'tgl_masuk' => $post['tgl_masuk'],
            'tgl_kontrak' => $post['tgl_kontrak'],
            'tgl_kontrak_1' => $post['tgl_kontrak_1'],
            'pkp_sebelumnya' => $post['pkp_sebelumnya'],
            'pkp_akhir' => $post['pkp_akhir'],
            'nama_admin' => $post['nama_admin'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat'],
            "handphone" => $post["handphone"],
            "email" => $post["email"],
            "jabatan" => $post["jabatan"],
            "jurusan" => $post["jurusan"],
            "status_karyawan" => $post["status_karyawan"],
            "sisa_cuti" => $post["sisa_cuti"],
            'agent' => $this->request->getUserAgent()
        ];
        $simpan = new LaporanModel();
        if ($simpan->updatedatauser_1($postData)) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function useredit_2()
    {

        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'tgl_lahir' => $post['tgl_lahir'],
            'tgl_masuk' => $post['tgl_masuk'],
            'nama_admin' => $post['nama_admin'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat'],
            "handphone" => $post["handphone"],
            "email" => $post["email"],
            "jabatan" => $post["jabatan"],
            "jurusan" => $post["jurusan"],
            "status_karyawan" => $post["status_karyawan"],
            "sisa_cuti" => $post["sisa_cuti"],
            'agent' => $this->request->getUserAgent()
        ];


        $simpan = new LaporanModel();
        if ($simpan->updatedatauser_2($postData)) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }
    public function useredit_3()
    {
        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'tgl_lahir' => $post['tgl_lahir'],
            'tgl_masuk' => $post['tgl_masuk'],
            'nama_admin' => $post['nama_admin'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat'],
            "handphone" => $post["handphone"],
            "email" => $post["email"],
            "jabatan" => $post["jabatan"],
            "jurusan" => $post["jurusan"],
            "status" => $post["status_karyawan"],
            "sisa_cuti" => $post["sisa_cuti"],
            'agent' => $this->request->getUserAgent()
        ];

        $simpan = new LaporanModel();
        if ($simpan->updatedatauser_3($postData)) {
            $data['success'] = true;
            $data['message'] = "Berhasil menyimpan data";
        } else {
            $errors['fail'] = "gagal melakukan update data";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }
}
