<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DashboardModel;
use App\Models\LoginModel;
use App\Models\ProyekModel;
use App\Models\AksesModel;
use App\Models\InvoiceModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\Files\UploadedFile;
use App\Libraries\FPDF;
use Config\Services;
use Config\Database;

class Proyek extends BaseController
{
    public function __construct()
    {
        $this->akses = new AksesModel();
        $this->loginModel = new LoginModel();
        $this->formValidation = \Config\Services::validation();
        $this->dashboard = new DashboardModel();
        $this->proyek = new ProyekModel();
        $this->session = Services::session();
        $this->invoice = new InvoiceModel();

        helper(['string', 'security', 'form', 'esc']);
    }

    public function index()
    {
        $data['kode'] = '02';
        $data['judul'] = 'PROYEK';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $pkp_user = $isi->pkp_user;
        $kategoriQNS = $isi->kategori_user;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $dennis = $isi->username;
        if ($pkp_user != '') {
            $pkp_user = $isi->pkp_user;
            if ($pkp_user != '') {
                $proyek = $this->db
                    ->table('master_pkp')
                    ->getWhere(['id_pkp' => $pkp_user], 1);
                $id_divisi = $proyek->getRow()->id_instansi;
                $no_pkp = $proyek->getRow()->no_pkp;
            }
            $divisi = $this->db
                ->table('master_instansi')
                ->getWhere(['id' => $id_divisi], 1);
            $no_divisi = $divisi->getRow()->nomor;
            $data['no_divisi'] = $no_divisi;
            $data['no_pkp'] = $no_pkp;
        }
        return view('proyek/index', $data);
    }

    public function gedung1()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">GEDUNG 1</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'Gedung 1';

        return view('proyek/gedung/gedung1', $data);
    }

    public function gedung2()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">GEDUNG 1</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'GEDUNG 2';

        return view('proyek/gedung/gedung2', $data);
    }

    public function gedung3()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">GEDUNG 1</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'GEDUNG 3';

        return view('proyek/gedung/gedung3', $data);
    }

    public function ktl1()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $data['ktl1'] = $this->proyek->getAllKtlPKP1();
        } else {
            if ($isi->username == '10288') {
                $data['ktl1'] = $this->proyek->getWakadiratKtlPKP1();
            } else {
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $data['ktl1'] = $this->proyek->getDivisiKtlPKP1($id_divisi);
                } else {
                    $data['ktl1'] = $this->proyek->getProyekKtlPKP1($pkp_user);
                }
            }
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">KTL 1</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'KTL 1';

        return view('proyek/ktl/ktl', $data);
    }

    public function ktl2()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $data['ktl2'] = $this->proyek->getAllKtlPKP2();
        } else {
            if ($isi->username == '10288') {
                $data['ktl2'] = $this->proyek->getWakadiratKtlPKP2();
            } else {
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $data['ktl2'] = $this->proyek->getDivisiKtlPKP2($id_divisi);
                } else {
                    $data['ktl2'] = $this->proyek->getProyekKtlPKP2($pkp_user);
                }
            }
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">KTL 2</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'KTL 2';
        return view('proyek/ktl/ktl2', $data);
    }

    public function trans1()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $data['trans1'] = $this->proyek->getAllTransPKP1();
        } else {
            if ($isi->username == '10288') {
                $data['trans1'] = $this->proyek->getWakadiratTransPKP1();
            } else {
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $data['trans1'] = $this->proyek->getDivisiTransPKP1(
                        $id_divisi
                    );
                } else {
                    $data['trans1'] = $this->proyek->getProyekTransPKP1(
                        $pkp_user
                    );
                }
            }
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">TRANSPORTASI 1</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'TRANS 1';
        return view('proyek/transportasi/transportasi', $data);
    }

    public function trans2()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $data['trans2'] = $this->proyek->getAllTransPKP2();
        } else {
            if ($isi->username == '10288') {
                $data['trans2'] = $this->proyek->getWakadiratTransPKP2();
            } else {
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $data['trans2'] = $this->proyek->getDivisiTransPKP2(
                        $id_divisi
                    );
                } else {
                    $data['trans2'] = $this->proyek->getProyekTransPKP2(
                        $pkp_user
                    );
                }
            }
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">TRANSPORTASI 2</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'TRANS 2';
        return view('proyek/transportasi/transportasi2', $data);
    }

    public function kantor()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $data['kantor'] = $this->proyek->getAllKantorPKP();
        } else {
            $data['kantor'] = $this->proyek->getProyekKantorPKP($id_divisi);
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">KANTOR</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'TRANS 3';
        return view('proyek/kantor/kantor', $data);
    }

    public function semua()
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $proyek = $this->db
            ->table('master_admin')
            ->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $data['semua'] = $this->proyek->getAllSemuaPKP();
        } else {
            $data['semua'] = $this->proyek->getProyekSemuaPKP($id_divisi);
        }

        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a> <a style="color:white">SEMUA DATA</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['tes0'] = $this->dashboard->getId();
        $data['tes1'] = $this->dashboard->getOne();
        $data['tes2'] = $this->dashboard->getTwo();
        $data['kategori'] = $kategoriQNS;
        $data['title'] = 'SEMUA';
        return view('proyek/semua/index', $data);
    }

    public function edit_1($kode)
    {
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        $id_pkp = $this->request->uri->getSegment(4);
        $data['kode'] = '02';

        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_progress;
        $data['tahun'] = substr($tgl, 2, 2);
        $data['bulan'] = substr($tgl, 5, 2);
        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();

        $data['proyek23'] = $this->db
            ->table('progress_proyek')
            ->selectMax('kode')
            ->where('id_pkp', $kode)
            ->get();
        $kode_proyek = $data['proyek23']->getRow()->kode;
        $data['proyek22'] = $this->db
            ->table('progress_proyek')
            ->getWhere(['kode' => $kode_proyek]);

        if ($data['proyek22']->getNumRows() > 0) {
            $id_progress_proyek = $data['proyek22']->getRow()->id;
        } else {
            $id_progress_proyek = '';
        }

        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();

        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();

        $data['dt_umum'] = $this->db
            ->table('dt_umum')
            ->select('*')
            ->where('pkp', $kode)
            ->orderBy('no_urut1', 'ascd')
            ->get()
            ->getResult();

        $data['solusi'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'EKS')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['solusi2'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'INT')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['gambar'] = $this->db
            ->table('gambar a')
            ->select('a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5')
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_gbr')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['dcr'] = $this->db
            ->table('dcr a')
            ->select(
                'a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.id_dcr = b.id_dcr')
            ->get()
            ->getResult();

        $data['pdf'] = $this->db
            ->table('pdf a')
            ->select(
                'a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_dtt')
            ->get();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';

        $bulan = $this->request->getGet('bulan') ?? '00';
        $tahun = $this->request->getGet('tahun') ?? '00';

        if ($bulan === '00' && $tahun === '00') {
            $data['paket'] = $this->db
                ->table('progress_paket a')
                ->select(
                    'a.tahun,a.tgl_sadd,a.tgl_fadd,a.bulan,a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias,a.keterangan'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->join('pt_detil c', 'a.id_pt = c.id', 'left')
                ->join('pt_master d', 'c.id_pt = d.id', 'left')
                ->where('a.progress_proyek', $id_progress_proyek)
                ->orderBy('a.nomor', 'ascd')
                ->get()
                ->getResult();

            $data['proyek2'] = $this->db
                ->table('progress_proyek a')
                ->select(
                    'a.bulan,a.tahun,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->where('a.id_pkp', $id_pkp)
                ->where('a.id', $id_progress_proyek)
                ->get()
                ->getResult();
        } else {
            // Subquery to get the max kode for each nomor, tahun, bulan
            $subquery = $this->db
                ->table('progress_paket')
                ->select('MAX(kode) AS max_kode, nomor, tahun, bulan')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun)
                ->where('bulan', $bulan)
                ->groupBy('nomor, tahun, bulan')
                ->getCompiledSelect();

            // Main query
            $query = $this->db
                ->table('progress_paket a')
                ->select(
                    'a.tahun, a.tgl_sadd, a.tgl_fadd, a.bulan, a.kode_pt, b.proyek, a.paket, a.id_pkp, a.bobot_pg, a.rensd_mgll, a.rilsd_mgll, a.devsd_mgll, a.ren_mgini, a.ril_mgini, a.dev_mgini, a.rensd_mgini, a.rilsd_mgini, a.devsd_mgini, a.sisa_bobotpg, a.tgl_mulai, a.tgl_selesai, a.sisa_waktu, a.target_minggu, d.alias, a.keterangan'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->join('pt_detil c', 'a.id_pt = c.id', 'left')
                ->join('pt_master d', 'c.id_pt = d.id', 'left')
                ->join(
                    "($subquery) max_pp",
                    'a.kode = max_pp.max_kode AND a.nomor = max_pp.nomor AND a.tahun = max_pp.tahun AND a.bulan = max_pp.bulan'
                )
                ->where('a.id_pkp', $id_pkp);

            if (!empty($tahun) && !empty($bulan)) {
                $query->where('a.bulan', $bulan)->where('a.tahun', $tahun);
            }

            $result = $query->get()->getResult();
            $data['paket'] = $result;

            $query = $this->db
                ->table('progress_proyek a')
                ->select(
                    'a.bulan,a.tahun,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->where('a.id_pkp', $id_pkp)
                ->where('a.id', $id_progress_proyek);

            if (!empty($tahun) && !empty($bulan)) {
                $query->where('a.bulan', $bulan)->where('a.tahun', $tahun);
            }

            $result2 = $query->get()->getResult();
            $data['proyek2'] = $result2;
        }

        // $data['paket'] = $this->db->table("progress_paket a")
        //     ->select("a.tgl_sadd,a.tgl_fadd,a.bulan,a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias,a.keterangan")
        //     ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
        //     ->join('pt_detil c', 'a.id_pt = c.id', 'left')
        //     ->join('pt_master d', 'c.id_pt = d.id', 'left')
        //     ->where('a.progress_proyek', $id_progress_proyek)
        //     ->orderBy("a.nomor", "ascd")->get()->getResult();
        $data['option_tahun'] = $this->proyek->option_tahun($id_pkp);
        $data['$id_progress_proyek'] = $id_progress_proyek;
        // $data['proyek2'] = $this->db->table("progress_proyek a")->select("a.bulan,a.tahun,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->where('a.id', $id_progress_proyek)->get()->getResult();
        // ;
        $data['marketing'] = $this->db
            ->table('master_pkp a')
            ->select(
                'b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp'
            )
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.tgl_ubah_progress >', '2010-01-01')
            ->orderBy('b.nomor')
            ->orderBy('a.no_pkp', 'DESC')
            ->get()
            ->getResult();
        $marketing = $this->db
            ->table('master_pkp a')
            ->select(
                'b.nomor,a.no_pkp,a.alias,a.proyek,a.tgl_mulai,a.tgl_selesai,a.nilai_jaminan,a.tgl_jaminan,a.bast_1,a.bast_2,a.referensi,a.id_pkp'
            )
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.tgl_ubah_progress >', '2010-01-01')
            ->orderBy('b.nomor')
            ->orderBy('a.no_pkp', 'DESC')
            ->get()
            ->getRow();

        if ($marketing) {
            $id_pkp = $marketing->id_pkp;
            $QNS0 = $this->db
                ->table('addendum')
                ->select('*')
                ->where('id_marketing', $id_pkp)
                ->get();
            if ($QNS0->getNumRows() > 0) {
                $data['QNS0'] = $QNS0->getResult();
            }
        }

        $data['QNS0'] = $QNS0->getResult();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('proyek/gedung/gedung1-edit', $data);
    }

    public function get_bulan()
    {
        $request = \Config\Services::request();
        $id_pkp = $request->getGet('id_pkp');
        $tahun = $request->getGet('tahun');

        // Mengambil daftar bulan berdasarkan id_pkp dan tahun yang dipilih
        $bulan_list = $this->proyek->option_bulan($id_pkp, $tahun);

        // Format nama bulan
        $nama_bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $data = [];
        foreach ($bulan_list as $bulan) {
            $data[] = [
                'bulan' => $bulan->bulan,
                'nama_bulan' => $nama_bulan[$bulan->bulan],
            ];
        }

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json'); // Atur header untuk menjamin respons JSON
        echo json_encode($data);
        exit(); // Hentikan eksekusi kode setelah ini
    }



    public function get_bulan_msl()
    {
        $request = \Config\Services::request();
        $id_pkp = $request->getGet('id_pkp');
        $tahun = $request->getGet('tahun');
        $data['id_pkp'] = $request->getGet('id_pkp');
        // Mengambil daftar bulan berdasarkan id_pkp dan tahun yang dipilih
        $bulan_list = $this->proyek->option_bulan_msl($id_pkp, $tahun);

        // Format nama bulan
        $nama_bulan = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $data = [];
        foreach ($bulan_list as $bulan) {
            $data[] = [
                'bulan' => $bulan->bulan,
                'nama_bulan' => $nama_bulan[$bulan->bulan],
            ];
        }

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json'); // Atur header untuk menjamin respons JSON
        echo json_encode($data);
        exit(); // Hentikan eksekusi kode setelah ini
    }

    public function edit_2($kode)
    {
        $id_pkp = $this->request->uri->getSegment(4);
        $data['kode'] = '02';
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();

        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah;
        $data['tahun'] = substr($tgl, 2, 2);
        $data['bulan'] = substr($tgl, 5, 2);

        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;
        $data['option_tahun'] = $this->proyek->option_tahun_msl($id_pkp);
        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();

        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();

        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();

        $data['dt_umum'] = $this->db
            ->table('dt_umum')
            ->select('*')
            ->where('pkp', $kode)
            ->orderBy('no_urut1', 'ascd')
            ->get()
            ->getResult();

        $bulan = $this->request->getGet('bulan') ?? '00';
        $tahun = $this->request->getGet('tahun') ?? '00';

        if ($bulan === '00' && $tahun === '00') {
            $data['solusi'] = $this->db
                ->table('solusi a')
                ->select(
                    'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target,a.nama_kontraktor,a.nama_paket,a.status,a.lampiran,a.kode'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->where('a.id_pkp', $kode)
                ->where('a.type', 'EKS')
                ->where('a.id_solusi = b.id_solusi')
                ->orderBy('a.nomor', 'ascd')
                ->get()
                ->getResult();

            $data['solusi2'] = $this->db
                ->table('solusi a')
                ->select(
                    'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target,a.nama_kontraktor,a.nama_paket,a.status,a.lampiran,a.kode'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->where('a.id_pkp', $kode)
                ->where('a.type', 'INT')
                ->where('a.id_solusi = b.id_solusi')
                ->orderBy('a.nomor', 'ascd')
                ->get()
                ->getResult();
        } else {
            $solusi = $this->proyek->view_progress_solusi(
                $tahun,
                $bulan,
                $id_pkp
            );
            $solusi2 = $this->proyek->view_progress_solusi2(
                $tahun,
                $bulan,
                $id_pkp
            );
            $data['solusi'] = $solusi;
            $data['solusi2'] = $solusi2;
        }

        

        $data['gambar'] = $this->db
            ->table('gambar a')
            ->select('a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5')
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_gbr')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['dcr'] = $this->db
            ->table('dcr a')
            ->select(
                'a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.id_dcr = b.id_dcr')
            ->get()
            ->getResult();

        $data['pdf'] = $this->db
            ->table('pdf a')
            ->select(
                'a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_dtt')
            ->orderBy('a.kode', 'desc')
            ->get();
        
        
        
        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;

        return view('proyek/gedung/gedung1-edit2', $data);
    }

    public function get_bulan_gbr()
    {
        $request = \Config\Services::request();
        $id_pkp = $request->getGet('id_pkp');
        $tahun = $request->getGet('tahun');
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        // Mengambil daftar bulan berdasarkan id_pkp dan tahun yang dipilih
        $bulan_list = $this->proyek->option_bulan_gbr($id_pkp, $tahun);

        // Format nama bulan
        $nama_bulan = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $data = [];
        foreach ($bulan_list as $bulan) {
            $data[] = [
                'bulan' => $bulan->bulan,
                'nama_bulan' => $nama_bulan[$bulan->bulan],
            ];
        }

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json'); // Atur header untuk menjamin respons JSON
        echo json_encode($data);
        exit(); // Hentikan eksekusi kode setelah ini
    }

    public function edit_3($kode)
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $id_pkp = $this->request->uri->getSegment(4);
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_progress;
        $data['tahun'] = substr($tgl, 2, 2);
        $data['bulan'] = substr($tgl, 5, 2);

        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();

        $data['paket'] = $this->db
            ->table('progress_paket a')
            ->select(
                'a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('pt_detil c', 'a.id_pt = c.id', 'left')
            ->join('pt_master d', 'c.id_pt = d.id', 'left')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['proyek2'] = $this->db
            ->table('progress_proyek a')
            ->select(
                'b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->get()
            ->getResult();

        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();

        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();

        $data['dt_umum'] = $this->db
            ->table('dt_umum')
            ->select('*')
            ->where('pkp', $kode)
            ->orderBy('no_urut1', 'ascd')
            ->get()
            ->getResult();

        $data['solusi'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'EKS')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['solusi2'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'INT')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['option_tahun'] = $this->proyek->option_tahun_gbr($id_pkp);

        $bulan = $this->request->getGet('bulan') ?? '00';
        $tahun = $this->request->getGet('tahun') ?? '00';

        if ($bulan === '00' && $tahun === '00') {
            $data['gambar'] = $this->db
                ->table('gambar a')
                ->select(
                    'a.tgl_ubah,a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5'
                )
                ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
                ->where('a.id_pkp', $kode)
                ->where('a.tgl_ubah = b.tgl_ubah_gbr')
                ->orderBy('a.kode', 'desc')
                ->get();
        } else {
            $gambar = $this->proyek->view_progress_gambar(
                $tahun,
                $bulan,
                $id_pkp
            );

            $data['gambar'] = $gambar;
        }

        $data['dcr'] = $this->db
            ->table('dcr a')
            ->select(
                'a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.id_dcr = b.id_dcr')
            ->get()
            ->getResult();

        $data['pdf'] = $this->db
            ->table('pdf a')
            ->select(
                'a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_dtt')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;

        return view('proyek/gedung/gedung1-edit3', $data);
    }
    public function edit_4($kode)
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_progress;
        $data['tahun'] = substr($tgl, 2, 2);
        $data['bulan'] = substr($tgl, 5, 2);

        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();

        $data['paket'] = $this->db
            ->table('progress_paket a')
            ->select(
                'a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('pt_detil c', 'a.id_pt = c.id', 'left')
            ->join('pt_master d', 'c.id_pt = d.id', 'left')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['proyek2'] = $this->db
            ->table('progress_proyek a')
            ->select(
                'b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->get()
            ->getResult();

        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();

        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();

        $data['dt_umum'] = $this->db
            ->table('dt_umum')
            ->select('*')
            ->where('pkp', $kode)
            ->orderBy('no_urut1', 'ascd')
            ->get()
            ->getResult();

        $data['solusi'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'EKS')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['solusi2'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'INT')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['gambar'] = $this->db
            ->table('gambar a')
            ->select('a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5')
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_gbr')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['dcr'] = $this->db
            ->table('dcr a')
            ->select(
                'a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.id_dcr = b.id_dcr')
            ->get()
            ->getResult();

        $data['pdf'] = $this->db
            ->table('pdf a')
            ->select(
                'a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_dtt')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;

        return view('proyek/gedung/gedung1-edit4', $data);
    }
    public function edit_5($kode)
    {
        $data['kode'] = '02';
        //dzaki
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $data['now1'] = date('d-m-Y');
        //end-dzaki
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['tgl'] = $data['proyek']->getRow()->tgl_ubah_dcr;
        $data['tahun'] = substr($data['tgl'], 2, 2);
        $data['bulan'] = substr($data['tgl'], 5, 2);
        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;
        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['paket'] = $this->db
            ->table('progress_paket a')
            ->select(
                'a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('pt_detil c', 'a.id_pt = c.id', 'left')
            ->join('pt_master d', 'c.id_pt = d.id', 'left')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();
        $data['proyek2'] = $this->db
            ->table('progress_proyek a')
            ->select(
                'b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->get()
            ->getResult();
        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();
        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();
        $data['mon_dcr1'] = $this->db
            ->table('mon_dcr')
            ->select('*')
            ->where('type', 'TOTAL')
            ->where('id_pkp', $kode)
            ->where('tgl_import', $data['tgl'])
            ->get()
            ->getResult();
        $data['mon_dcr2'] = $this->db
            ->table('mon_dcr')
            ->select('*')
            ->where('type !=', 'TOTAL')
            ->where('id_pkp', $kode)
            ->get()
            ->getResult();
        $data['mon_dcr1a'] = $this->db
            ->table('mon_dcr')
            ->select('*')
            ->where('type', 'TOTAL')
            ->where('id_pkp', $kode)
            ->get();
        $data['no_pkp'] = $data['proyek']->getRow()->no_pkp;

        $queryBuilder2 = \Config\Database::connect('qns_dcrv7')
            ->table('dokumen a')
            ->select(
                "MAX(d.nama_admin) AS nama_admin, b.keterangan, b.id_pkp, b.no_pkp, b.alias, MIN(a.tgl_system) as tgl_min, MAX(a.tgl_system) as tgl_max, COUNT(a.id) as total1, sum(if(a.file!='',1,0)) as upload, sum(if((a.tgl_keluar > 0 and a.tgl_keluar > a.tgl_target) or (a.tgl_keluar < 1 and $now > a.tgl_target),1,0)) as telat, sum(if(a.status_dokumen = 'OUT-K' or a.status_dokumen = 'OUT-O' or a.status_dokumen = 'OUT-L',1,0)) as blm_kembali"
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('master_instansi c', 'b.id_instansi = c.id')
            ->join('master_admin d', 'b.id_admin = d.username', 'left')
            ->where('b.no_pkp', $data['no_pkp']);

        $data['datadcr'] = $queryBuilder2->get()->getResult();

        $qns_dcr_ikn = Database::connect('qns_dcr_ikn');

        $data['datadcrikn'] = $qns_dcr_ikn
            ->table('dokumen a')
            ->select(
                "MAX(d.nama_admin) AS nama_admin, b.keterangan, b.id_pkp, b.no_pkp, b.alias, MIN(a.tgl_system) as tgl_min, MAX(a.tgl_system) as tgl_max, COUNT(a.id) as total1, sum(if(a.file!='',1,0)) as upload, sum(if((a.tgl_keluar > 0 and a.tgl_keluar > a.tgl_target) or (a.tgl_keluar < 1 and $now > a.tgl_target),1,0)) as telat, sum(if(a.status_dokumen = 'OUT-K' or a.status_dokumen = 'OUT-O' or a.status_dokumen = 'OUT-L',1,0)) as blm_kembali"
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('master_instansi c', 'b.id_instansi = c.id')
            ->join('master_admin d', 'b.id_admin = d.username', 'left')
            ->where('b.no_pkp', $data['no_pkp'])
            ->get()
            ->getResult();

        // Sambungkan ke database qns_dcrv7
        $db_dcr = \Config\Database::connect('qns_dcrv7');

        // Langkah 1: Cek $kode di tabel master_pkp di database qns_dashv7
        $no_pkp = $this->db
            ->table('master_pkp')
            ->select('no_pkp')
            ->where('id_pkp', $kode)
            ->get()
            ->getRow();

        // Langkah 2: Jika no_pkp ditemukan, ambil id_pkp dari database qns_dcrv7
        if ($no_pkp) {
            $id_pkp_dcr = $db_dcr
                ->table('master_pkp')
                ->select('id_pkp')
                ->where('no_pkp', $no_pkp->no_pkp)
                ->get()
                ->getRow();

            // Simpan hasil ke $data['dcr_ok'] jika ditemukan
            if ($id_pkp_dcr) {
                $data['dcr_ok'] = $id_pkp_dcr->id_pkp;
            } else {
                $data['dcr_ok'] = 'Data id_pkp tidak ditemukan di qns_dcrv7';
            }
        } else {
            $data['dcr_ok'] = 'Data no_pkp tidak ditemukan di qns_dashv7';
        }
        // end dzaki - load database 2

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;

        return view('proyek/gedung/gedung1-edit5', $data);
    }

    public function s_curve($kode)
    {
        $data['id_pkp'] = $this->request->uri->getSegment(3);
        $id_pkp = $this->request->uri->getSegment(3);
        $data['kode'] = '02';
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $data['now1'] = date("d-m-Y");
        $data['proyek'] = $this->db->table('master_pkp')->getWhere(['id_pkp' => $kode], 1);
        $id_pkp = $this->request->uri->getSegment(4);
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        //end-dzaki
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        $data['option_tahun'] = $this->proyek->option_tahun_gbr($kode);
        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        return view('proyek/s-curve', $data);
    }

    public function scurvetambah()
    {
        $now = date('Y-m-d');
        $id_pkp = $this->request->getPost('id'); // Assuming you get this from POST or GET request

        // Retrieve no_pkp and id_instansi from the database
        $QN2 = $this->db->query(
            "SELECT * FROM master_pkp where id_pkp='$id_pkp'"
        );
        foreach ($QN2->getResult() as $row2) {
            $no_pkp = $row2->no_pkp;
            $id_instansi = $row2->id_instansi;
        }

        // Retrieve no_instansi from the database
        $QN3 = $this->db->query(
            "SELECT * FROM master_instansi where id='$id_instansi'"
        );
        foreach ($QN3->getResult() as $row3) {
            $no_instansi = $row3->nomor;
        }

        // Define the location for storing the uploaded PDF
        $lokasi = './assets/pdf/scurve/' . $no_instansi . '/' . $no_pkp;

        // Check if directory exists, if not create it
        if (!file_exists($lokasi)) {
            mkdir($lokasi, 0777, true);
        }

        $teknis = 'scurve';
        $fileName = $teknis . $no_pkp . '.pdf'; // Define the file name

        // Delete the old PDF file
        $oldFilePath = $lokasi . '/' . $teknis . $no_pkp . '.pdf';
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        $file = $this->request->getFile('berkas'); // Get the uploaded file

        // Check file size and type
        if ($file->getSize() > 100000000 || $file->getExtension() != 'pdf') {
            $this->session->setFlashdata(
                'error',
                'Ukuran file harus kurang dari 100MB'
            );
        }

        // Move the file to the defined location with the defined file name
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($lokasi, $fileName);
            $datagbr1 = [
                'file_scurve' => $lokasi . '/' . $fileName,
            ];
            $this->db
                ->table('master_pkp')
                ->where('id_pkp', $id_pkp)
                ->update($datagbr1);
        }

        $dataend = [
            'tgl_ubah_scurve' => $now,
        ];
        $this->db
            ->table('master_pkp')
            ->where('id_pkp', $id_pkp)
            ->update($dataend);
        $this->session->setFlashdata('success', 'upload pdf');
        $redirectUrl = previous_url() ?? base_url();
        return redirect()->to($redirectUrl);
    }



    public function scurvetambahpaket()
    {
        $now = date("Y-m-d");
        $id_pkp = $this->request->getPost('id'); // Assuming you get this from POST or GET request

        // Retrieve no_pkp and id_instansi from the database
        $QN2 = $this->db->query("SELECT * FROM master_pkp where id_pkp='$id_pkp'");
        foreach ($QN2->getResult() as $row2) {
            $no_pkp = $row2->no_pkp;
            $id_instansi = $row2->id_instansi;
        }

        // Retrieve no_instansi from the database
        $QN3 = $this->db->query("SELECT * FROM master_instansi where id='$id_instansi'");
        foreach ($QN3->getResult() as $row3) {
            $no_instansi = $row3->nomor;
        }

        // Define the location for storing the uploaded PDF
        $lokasi = './assets/pdf/scurvepaket/' . $no_instansi . '/' . $no_pkp;

        // Check if directory exists, if not create it
        if (!file_exists($lokasi)) {
            mkdir($lokasi, 0777, true);
        }

        $teknis = 'SCRVPKT';
        $uniqueCode = bin2hex(random_bytes(5)); // Menghasilkan string acak sepanjang 10 karakter   
        $fileName = $teknis . $no_pkp . '_' . $uniqueCode . '.pdf'; 
        // Delete the old PDF file
        $oldFilePath = $lokasi . '/' . $teknis . $no_pkp . '.pdf';
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        $file = $this->request->getFile('berkas'); // Get the uploaded file

        // Check file size and type
        if ($file->getSize() > 100000000 || $file->getExtension() != 'pdf') {
            $this->session->setFlashdata('error', 'Ukuran file harus kurang dari 100MB');
        }

        // Move the file to the defined location with the defined file name
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($lokasi, $fileName);
            $datagbr1 = [
                "file_scurve" => $lokasi . '/' . $fileName,
                "id_pkp" => $id_pkp,
                "tgl_ubah_scurve" => $now,
                "nama_paket" => $this->request->getPost('nama_paket'),
                "tgl_upd_scurve" => $this->request->getPost('tgl_upd_scurve')
            ];
        }
        $this->db->table('scurve')->where('id_pkp', $id_pkp)->insert($datagbr1);
        $this->session->setFlashdata('success', 'upload pdf');
        $redirectUrl = previous_url() ?? base_url();
        return redirect()->to($redirectUrl);
    }

    public function get_bulan_absensi()
    {
        $request = \Config\Services::request();
        $id_pkp = $request->getGet('id_pkp');
        $tahun = $request->getGet('tahun');
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        // Mengambil daftar bulan berdasarkan id_pkp dan tahun yang dipilih
        $bulan_list = $this->proyek->option_bulan_absensi($id_pkp, $tahun);

        // Format nama bulan
        $nama_bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $data = [];
        foreach ($bulan_list as $bulan) {
            $data[] = [
                'bulan' => $bulan->bulan,
                'nama_bulan' => $nama_bulan[$bulan->bulan],
            ];
        }

        // Mengembalikan data dalam format JSON
        header('Content-Type: application/json'); // Atur header untuk menjamin respons JSON
        echo json_encode($data);
        exit(); // Hentikan eksekusi kode setelah ini
    }

    public function edit_6($kode)
    {
        $data['kode'] = '02';
        $data['id_pkp'] = $this->request->uri->getSegment(4);
        $id_pkp = $this->request->uri->getSegment(4);
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db
            ->table('master_instansi')
            ->get()
            ->getResult();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['tgl'] = $data['proyek']->getRow()->tgl_ubah_dcr;
        $data['tahun'] = substr($data['tgl'], 2, 2);
        $data['bulan'] = substr($data['tgl'], 5, 2);
        $data['option_tahun'] = $this->proyek->option_tahun_absensi($id_pkp);
        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $satu = 1;
        $data['akses'] = $this->db
            ->table('rule_akses')
            ->getWhere(['id' => 'RULE1'], 1);

        // First query
        $QN = $this->db->query(
            "SELECT max(kode) as masKode FROM buka_akses WHERE id_pkp='$kode' and akses='KADIV' and urut='$satu' order by kode"
        );
        $kode_akses = '';
        foreach ($QN->getResult() as $row) {
            $kode_akses = $row->masKode;
        }
        $data['buka_akses2'] = $this->db
            ->table('buka_akses')
            ->select('*')
            ->where('kode', $kode_akses)
            ->get()
            ->getResult();

        // Second query
        $QN2 = $this->db->query(
            "SELECT max(kode) as masKode FROM buka_akses WHERE id_pkp='$kode' and akses='KADIRAT' and urut='$satu' order by kode"
        );
        $kode_akses2 = '';
        foreach ($QN2->getResult() as $row2) {
            $kode_akses2 = $row2->masKode;
        }

        $data['buka_akses22'] = $this->db
            ->table('buka_akses')
            ->select('*')
            ->where('kode', $kode_akses2)
            ->get()
            ->getResult();
        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['paket'] = $this->db
            ->table('progress_paket a')
            ->select(
                'a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('pt_detil c', 'a.id_pt = c.id', 'left')
            ->join('pt_master d', 'c.id_pt = d.id', 'left')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['proyek2'] = $this->db
            ->table('progress_proyek a')
            ->select(
                'b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->get()
            ->getResult();

        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();

        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();

        $data['dt_umum'] = $this->db
            ->table('dt_umum')
            ->select('*')
            ->where('pkp', $kode)
            ->orderBy('no_urut1', 'ascd')
            ->get()
            ->getResult();

        $data['solusi'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'EKS')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['solusi2'] = $this->db
            ->table('solusi a')
            ->select(
                'a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'INT')
            ->where('a.id_solusi = b.id_solusi')
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['gambar'] = $this->db
            ->table('gambar a')
            ->select('a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5')
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_gbr')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['dcr'] = $this->db
            ->table('dcr a')
            ->select(
                'a.ket1,a.ket2,a.ket3,a.ket4,a.ket5,a.ket6,a.ket7,a.ket8,a.ket9,a.ket10,a.ket11,a.ket12,a.ket13,a.ket14,a.ket15,a.ket16,a.ket17,a.ket18,a.ket19,a.ket20,a.ket21'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.id_dcr = b.id_dcr')
            ->get()
            ->getResult();

        $data['pdf'] = $this->db
            ->table('pdf a')
            ->select(
                'a.pdf1,a.pdf2,a.pdf3,a.pdf4,a.pdf5,a.pdf6,a.pdf7,a.pdf8,a.pdf9,a.pdf10'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_dtt')
            ->orderBy('a.kode', 'desc')
            ->get();

        $data['detil_karyawan3'] = $this->db
            ->table('detil_karyawan a')
            ->select(
                "a.kode,a.bulan,a.id_pkp,a.pkp_sebelumnya,a.tahun,b.nama_admin,a.id_user,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,b.jabatan,a.ket_jabatan,a.tgl_ren_mob,a.tgl_ren_demob,a.tgl_real_mob,a.tgl_real_demob,b.habis_kontrak as 'tgl_akhir_kontrak',a.status,a.ket_mobdemob,a.ket_akhir,b.username,d.alias,b.pkp_akhir"
            )
            ->join('master_admin b', 'a.nrp = b.username', 'left')
            ->join('master_pkp c', 'a.id_pkp = c.id_pkp')
            ->join('master_pkp d', 'a.pkp_sebelumnya = d.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_update = c.tgl_ubah_absensi')
            ->orderBy('a.kode', 'ASCD')
            ->get();

        if ($data['detil_karyawan3']->getNumRows() > 0) {
            $data['detil_karyawan2'] = $this->db
                ->table('detil_karyawan a')
                ->select(
                    'a.bulan,a.tahun,b.nama_admin,a.id_user,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,a.jabatan,a.ket_jabatan,a.tgl_ren_mob,a.tgl_ren_demob,a.tgl_real_mob,a.tgl_real_demob,a.tgl_akhir_kontrak,a.status,a.ket_mobdemob,a.ket_akhir,a.nrp'
                )
                ->join('master_admin b', 'a.nrp = b.username', 'left')
                ->join('master_pkp c', 'a.id_pkp = c.id_pkp')
                ->where('a.id_pkp', $kode)
                ->where('a.tgl_update = c.tgl_ubah_absensi')
                ->get()
                ->getResultArray();
            $result2 = array_column($data['detil_karyawan2'], 'nrp');

            $data['detil_no_list'] = $this->db
                ->table('master_admin')
                ->select('*')
                ->orWhereNotIn('username', $result2)
                ->where('pkp_akhir', $kode)
                ->where('aktif', '1')
                ->get()
                ->getResult();
        } else {
            $data['detil_no_list'] = $this->db
                ->table('master_admin')
                ->select('*')
                ->where('pkp_akhir', $kode)
                ->where('aktif', '1')
                ->get()
                ->getResult();
        }

        $bulan = $this->request->getGet('bulan') ?? '00';
        $tahun = $this->request->getGet('tahun') ?? '00';

        if ($bulan === '00' && $tahun === '00') {
            $data['detil_karyawan'] = $this->db
                ->table('detil_karyawan a')
                ->select(
                    "b.sisa_cuti,b.tgl_kontrak,a.kode,a.bulan,a.id_pkp,a.pkp_sebelumnya,a.tahun,b.nama_admin,a.id_user,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,b.jabatan,a.ket_jabatan,a.tgl_ren_mob,a.tgl_ren_demob,a.tgl_real_mob,a.tgl_real_demob,b.habis_kontrak as 'tgl_akhir_kontrak',a.status,a.ket_mobdemob,a.ket_akhir,b.username,d.alias,b.pkp_akhir,b.tgl_respon,a.nama,a.nrp"
                )
                ->join('master_admin b', 'a.nrp = b.username', 'left')
                ->join('master_pkp c', 'a.id_pkp = c.id_pkp')
                ->join('master_pkp d', 'a.pkp_sebelumnya = d.id_pkp', 'left')
                ->where('a.id_pkp', $kode)
                ->where('a.tgl_update = c.tgl_ubah_absensi')
                ->orderBy('a.kode', 'ASCD')
                ->get()
                ->getResult();
        } else {
            $absensi = $this->proyek->view_progress_absensi(
                $tahun,
                $bulan,
                $id_pkp
            );

            $data['detil_karyawan'] = $absensi;
        }

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;

        return view('proyek/gedung/gedung1-edit6', $data);
    }

    public function edit_7($kode)
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['instansi'] = $this->db->get('master_instansi')->getResult();
        $data['breadcumb'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['divisi'] = $this->db
            ->table('master_pkp a')
            ->select('b.alias')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->db->getWhere(['id_pkp' => $kode], 1);
        $data['tgl'] = $data['proyek']->getRow()->tgl_ubah_inventaris;
        $data['tahun'] = substr($data['tgl'], 2, 2);
        $data['bulan'] = substr($data['tgl'], 5, 2);

        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;

        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();

        $data['paket'] = $this->db
            ->table('progress_paket a')
            ->select(
                'a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->join('pt_detil c', 'a.id_pt = c.id', 'left')
            ->join('pt_master d', 'c.id_pt = d.id', 'left')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->orderBy('a.nomor', 'ascd')
            ->get()
            ->getResult();

        $data['proyek2'] = $this->db
            ->table('progress_proyek a')
            ->select(
                'b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress'
            )
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tahun', $data['tahun'])
            ->where('a.bulan', $data['bulan'])
            ->get()
            ->getResult();

        $data['cek_pro'] = $this->db
            ->table('progress_proyek')
            ->where('id_pkp', $kode, 1)
            ->get();

        $data['cek2'] = $this->db
            ->table('dt_umum')
            ->where('pkp', $kode, 1)
            ->get();

        $data['invent1'] = $this->proyek->getInvent1($kode);

        $data['invent2'] = $this->proyek->getInvent2($kode);

        $data['invent3'] = $this->proyek->getInvent3($kode);

        $data['gambar'] = $this->proyek->getGambar($kode);

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';

        return view('proyek/gedung/gedung1-edit7', $data);
    }

    public function progressInvoice($kode)
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $data['instansiQN'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['nomorQN'] = $data['instansiQN']->getRow()->nomor;
        $data['instansi2'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get()
            ->getResult();
        $data['instansi3'] = $this->db
            ->table('master_pkp a')
            ->select('b.nomor,b.alias,b.ling')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $kode)
            ->get();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        $data['inv'] = $this->db
            ->table('progress_invoice')
            ->where('id_pkp', $kode)
            ->get()
            ->getResult();
        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek" style="color:white">PROYEK | </a><a style="color:white">' .
            $data['proyek']->getRow()->alias .
            ' | </a> <a href="' .
            base_url() .
            $data['instansi3']->getRow()->ling .
            '" style="color:white">' .
            $data['instansi3']->getRow()->alias .
            '</a>';
        return view('proyek/progress_invoice', $data);
    }

    public function tambahInvoice()
    {
        helper('text');
        // Get the original file name and extension
        $originalFileName = $this->request->getFile('excelfile')->getName();
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Generate a unique file name for the uploaded Excel file
        $randomBytes = random_bytes(16); // Adjust the length as needed
        $randomString = bin2hex($randomBytes);

        // Concatenate the random string with the file extension
        $nama_file = $randomString . '.' . $extension;

        // Configuration for file upload
        $config = [
            'upload_path' => './excel/',
            'allowed_types' => 'xlsx',
            'file_name' => $nama_file,
            'max_size' => 2048,
            'overwrite' => true,
        ];

        // Perform file upload
        $upload = Services::upload($config);

        // Get the uploaded file
        $file = $this->request->getFile('excelfile');

        // Check if the file upload is successful
        if ($file->isValid() && !$file->hasMoved()) {
            // Move the uploaded file to the specified location
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

        // Check if the file upload was successful
        if ($aksi['result'] == 'success') {
            // Clear existing data for the current session
            $this->db->table('progress_invoice')->emptyTable();

            $existingCodes = [];
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet
                ->getActiveSheet()
                ->toArray(null, true, true, true);
            $data = [];
            $baris = 1;

            // Set timezone and current date
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d');

            // Get the maximum existing 'kode' from the database
            $QN = $this->db->query(
                'SELECT max(kode) as masKode FROM progress_invoice order by kode'
            );
            foreach ($QN->getResult() as $row2) {
                $order = $row2->masKode;
            }

            // Extract information for generating unique 'kode'
            $noUrut = (int) substr($order, 8, 5);
            $bulanL = substr($order, 5, 2);
            $bln = substr($now, 5, 2);
            $tahun = substr($now, 2, 2);

            foreach ($sheetData as $baris => $row) {
                // Exclude the last row
                if ($baris > 3) {
                    // Generate initial 'kode' and check for duplicate entry
                    do {
                        $kode =
                            'INV' .
                            $tahun .
                            $bln .
                            '-' .
                            sprintf('%05s', $noUrut);
                        $noUrut++;
                    } while (in_array($kode, $existingCodes));

                    // Add the current row to the $data array
                    $data[] = [
                        'id' => 'INV' . hash('sha1', md5($kode)) . 'QNS',
                        'kode' => $kode,
                        'id_pkp' => $this->request->getPost('id'),
                        'periode' => $row['A'],
                        'laporan_progress' => $row['B'],
                        'nomor_bap' => $row['C'],
                        'tanggal_bap' => $row['D'],
                        'nominal_bap' => $row['E'],
                        'tgl_ubah' => $now,
                    ];

                    $existingCodes[] = $kode; // Add the new code to the list
                }
            }
            // Insert all rows into the 'progress_invoice' table
            $this->db->table('progress_invoice')->insertBatch($data);

            $this->session->setFlashdata('success', 'unggah pembaharuan');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal mengunggah');
            $redirectUrl = previous_url() ?? base_url();
        }

        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function tambahDataInvoice()
    {
        $simpan = new ProyekModel();
        $postData = [
            'periode' => $this->request->getPost('periode'),
            'nomor_bap' => $this->request->getPost('nomor_bap'),
            'nominal_bap' => $this->request->getPost('nominal_bap'),
            'laporan_progress' => $this->request->getPost('laporan_progress'),
            'tanggal_bap' => $this->request->getPost('tanggal_bap'),
            'id_pkp' => $this->request->getPost('id_pkp'),
            'agent' => $this->request->getUserAgent(),
        ];
        if ($simpan->simpandatainvoice($postData)) {
            $this->session->setFlashdata('success', 'menyimpan data');
            // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'menyimpan data');
            // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
            $redirectUrl = previous_url() ?? base_url();
        }
        return redirect()->to($redirectUrl);
    }

    // public function tambahInvoice()
    // {
    //     $db = \Config\Database::connect();
    //     $file_excel = $this->request->getFile('excelfile');
    //     $ext = $file_excel->getClientExtension();
    //     if ($ext == 'xls') {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
    //     } else {
    //         $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    //     }
    //     $spreadsheet = $reader->load($file_excel);

    //     // Step 1: Remove existing data
    //     $db->table('progress_invoice')->truncate();

    //     $QN = $this->db->query("SELECT max(kode) as masKode FROM file_migrasi order by kode");
    //     foreach ($QN->getResult() as $row2) {
    //         $order = $row2->masKode;
    //     }
    //     $noUrut = (int) substr($order, 8, 5);
    //     $noUrut++;

    //     //BL masKode//
    //     $bulanL = substr($order, 5, 2);
    //     $now = date("Y-m-d");
    //     $bln = substr($now, 5, 2);
    //     $tahun = substr($now, 2, 2);

    //     if ($bln == $bulanL) {
    //         $kode = 'INV' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
    //     } else {
    //         $kode = 'INV' . $tahun . $bln . '-' . '00001';
    //     }

    //     $id1 = 'INV' . md5($kode);
    //     $id2 = 'INV' . hash("sha1", $id1) . 'QNS';

    //     $id_pkp = $this->request->getPost('id');
    //     $data = $spreadsheet->getActiveSheet()->toArray();

    //     foreach ($data as $x => $row) {
    //         if ($x < 2) {
    //             continue;
    //         }

    //         // Step 2: Upload new data
    //         $item = isset($row[1]) ? $row[1] : null;  // Kolom B
    //         $rencana = isset($row[2]) ? $row[2] : null;  // Kolom C
    //         $ba = isset($row[3]) ? $row[3] : null;  // Kolom D
    //         $keterangan = isset($row[7]) ? $row[7] : null;  // Kolom H
    //         $noUrut++;
    //         $kode = 'INV' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
    //         $id1 = 'INV' . md5($kode);
    //         $id2 = 'INV' . hash("sha1", $id1) . 'QNS';

    //         $cekItem = $db->table('progress_invoice')->getWhere(['item' => $item])->getResult();

    //         if (count($cekItem) > 0) {
    //             session()->setFlashdata('message', '<b style="color:red">Data Gagal di Import NIS ada yang sama</b>');
    //         } else {
    //             $simpandata = [
    //                 'id' => $id2,
    //                 'kode' => $kode,
    //                 'id_pkp' => $id_pkp,
    //                 'item' => $item,
    //                 'rencana' => $rencana,
    //                 'ba' => $ba,
    //                 'keterangan' => $keterangan
    //             ];

    //             $db->table('progress_invoice')->insert($simpandata);
    //             session()->setFlashdata('success', 'unggah pembaharuan');
    //             $redirectUrl = previous_url() ?? base_url();
    //         }
    //     }

    //     return redirect()->to($redirectUrl);
    // }

    public function invoiceEdit()
    {
        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'memo_tagihan' => $post['memo_tagihan'],
            'kwitansi' => $post['kwitansi'],
            'keterangan' => $post['keterangan'],
            'realisasi' => $post['realisasi'],
        ];
        $simpan = $this->invoice;
        if ($simpan->updateInvoice($postData)) {
            $this->session->setFlashdata('success', 'berhasil menyimpan data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal menyimpan data');
            $redirectUrl = previous_url() ?? base_url();
        }

        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function invoiceDetail()
    {
        $idd = $this->request->getGet('id');

        $query = $this->db
            ->table('progress_invoice')
            ->select('*')
            ->where(['id' => $idd], 1)
            ->get();
        $result = [
            'periode' => $query->getRow()->periode,
            'laporan_progress' => $query->getRow()->laporan_progress,
            'nomor_bap' => $query->getRow()->nomor_bap,
            'tanggal_bap' => $query->getRow()->tanggal_bap,
            'nominal_bap' => $query->getRow()->nominal_bap,
            'tanggal_memo' => $query->getRow()->tanggal_memo,
            'nominal_memo' => $query->getRow()->nominal_memo,
            'tgl_kwitansi' => $query->getRow()->tgl_kwitansi,
            'realisasi_cair_tgl' => $query->getRow()->realisasi_cair_tgl,
            'realisasi_cair_nominal' => $query->getRow()
                ->realisasi_cair_nominal,
            'piutang_kwitansi' => $query->getRow()->piutang_kwitansi,
            'piutang_nonkwitansi' => $query->getRow()->piutang_nonkwitansi,
            'keterangan' => $query->getRow()->keterangan,
        ];
        echo '[' . json_encode($result) . ']';
    }

    public function proses_upload_solusi()
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

        $arraysub = [];
        if ($aksi['result'] == 'success') {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheet = $spreadsheet
                ->getActiveSheet()
                ->toArray(true, true, true, true, true);
            $data = [];
            $baris = 1;
            //THBL TGL BERJALAN//
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d');
            $post = $this->request->getPost();
            $id_pkp58 = $post['id_pkp58'];
            //HAPUS DATA TANGGAL HARI INI
            $QN01 = $this->db->query(
                "SELECT * FROM solusi where tgl_ubah='$now' and id_pkp='$id_pkp58'"
            );
            if ($QN01->getNumRows() > 0) {
                $this->db
                    ->table('solusi')
                    ->where('tgl_ubah', $now)
                    ->where('id_pkp', $id_pkp58)
                    ->delete();
            }
            //ambil no urut terakhir//
            //INSTHBL-12345//
            //KODE-SOLUSI BERSAMA//
            $QN3 = $this->db->query(
                'SELECT max(id_solusi) as masKode3 FROM master_pkp order by id_solusi'
            );
            foreach ($QN3->getResult() as $row3) {
                $order3 = $row3->masKode3;
            }
            $noUrut3 = (int) substr($order3, 8, 5);
            $noUrut3++;
            //BL masKode//
            $bulanL3 = substr($order3, 5, 2);
            $bln3 = substr($now, 5, 2);
            $tahun3 = substr($now, 2, 2);
            if ($bln3 == $bulanL3) {
                $kode3 =
                    'IDS' . $tahun3 . $bln3 . '-' . sprintf('%05s', $noUrut3);
            } else {
                $kode3 = 'IDS' . $tahun3 . $bln3 . '-' . '00001';
            }

            $data0 = [
                'tgl_ubah_masalah' => $now,
                'id_solusi' => $kode3,
            ];
            $this->db
                ->table('master_pkp')
                ->where('id_pkp', $id_pkp58)
                ->update($data0);
            //ambil no urut terakhir//
            //INSTHBL-12345//
            $QN = $this->db->query(
                'SELECT max(kode) as masKode FROM solusi order by kode'
            );
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
                $kode = 'SOL' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
            } else {
                $kode = 'SOL' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'SOL' . md5($kode);
            $id2 = 'SOL' . hash('sha1', $id1) . 'QNS';
            $idQNS = session('idadmin');
            $no = -1;
            foreach ($sheet as $row) {
                if ($baris > 2) {
                    $C = $row['C'];
                    $D = $row['D'];
                    $E = $row['E'];
                    $F = $row['F'];
                    $G = $row['G'];
                    $H = $row['H'];
                    $I = $row['I'];
                    $J = $row['J'];
                    $K = $row['K'];
                    $L = $row['L'];

                    if ($C == '1') {
                        $C = '';
                    }
                    if ($D == '1') {
                        $D = '';
                    }
                    if ($E == '1') {
                        $E = '';
                    }
                    if ($F == '1') {
                        $F = '';
                    }
                    if ($G == '1') {
                        $G = '';
                    }
                    if ($H == '1') {
                        $H = '';
                    }
                    if ($I == '1') {
                        $I = '';
                    }
                    if ($J == '1') {
                        $J = '';
                    }
                    if ($K == '1') {
                        $K = '';
                    }
                    if ($L == '1') {
                        $L = '';
                    }

                    array_push($data, [
                        'id' => $id2,
                        'kode' => $kode,
                        'id_pkp' => $id_pkp58,
                        'id_solusi' => $kode3,
                        'tgl_ubah' => $now,
                        'id_ubah' => $idQNS,

                        'nomor' => $no,
                        'nama_kontraktor' => $C,
                        'nama_paket' => $D,
                        'type' => $E,
                        'masalah' => $F,
                        'penyebab' => $G,
                        'dampak' => $H,
                        'solusi' => $I,
                        'pic' => $J,
                        'target' => $K,
                        'status' => $L,
                    ]);
                }
                $baris++;
                $noUrut++;
                $no++;
                $kode = 'SOL' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
                $id1 = 'SOL' . md5($kode);
                $id2 = 'SOL' . hash('sha1', $id1) . 'QNS';
            }
            if ($this->proyek->input_semua3b($data)) {
                $data['success'] = true;
                $data['message'] = 'Upload Solusi sukses';
            } else {
                $errors['fail'] =
                    'gagal mengupload semua data, pastikan format upload';
                $data['errors'] = $errors;
            }
        } else {
            $errors['fail'] = $aksi['error'];
            $data['errors'] = $errors;
        }
        $data['id_pkp'] = $id_pkp58;
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function proses_upload_solusix()
    {
        $nama_file = csrf_hash();
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

        $arraysub = [];
        if ($aksi['result'] == 'success') {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet
                ->getActiveSheet()
                ->toArray(true, true, true, true, true);
            $data = [];
            $baris = 1;
            //THBL TGL BERJALAN//
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d');
            $post = $this->request->getPost();
            $id_pkp58 = $post['id_pkp58'];
            //HAPUS DATA TANGGAL HARI INI
            $QN01 = $this->db->query(
                "SELECT * FROM solusi where tgl_ubah='$now' and id_pkp='$id_pkp58'"
            );
            if ($QN01->getNumRows() > 0) {
                $this->db
                    ->table('solusi')
                    ->where('tgl_ubah', $now)
                    ->where('id_pkp', $id_pkp58)
                    ->delete();
            }
            //ambil no urut terakhir//
            //INSTHBL-12345//
            //KODE-SOLUSI BERSAMA//
            $QN3 = $this->db->query(
                'SELECT max(id_solusi) as masKode3 FROM master_pkp order by id_solusi'
            );
            foreach ($QN3->getResult() as $row3) {
                $order3 = $row3->masKode3;
            }
            $noUrut3 = (int) substr($order3, 8, 5);
            $noUrut3++;
            //BL masKode//
            $bulanL3 = substr($order3, 5, 2);
            $bln3 = substr($now, 5, 2);
            $tahun3 = substr($now, 2, 2);
            if ($bln3 == $bulanL3) {
                $kode3 =
                    'IDS' . $tahun3 . $bln3 . '-' . sprintf('%05s', $noUrut3);
            } else {
                $kode3 = 'IDS' . $tahun3 . $bln3 . '-' . '00001';
            }

            $data0 = [
                'tgl_ubah_masalah' => $now,
                'id_solusi' => $kode3,
            ];
            $this->db
                ->table('master_pkp')
                ->where('id_pkp', $id_pkp58)
                ->update($data0);
            //ambil no urut terakhir//
            //INSTHBL-12345//
            $QN = $this->db->query(
                'SELECT max(kode) as masKode FROM solusi order by kode'
            );
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
                $kode = 'SOL' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
            } else {
                $kode = 'SOL' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'SOL' . md5($kode);
            $id2 = 'SOL' . hash('sha1', $id1) . 'QNS';
            $idQNS = session('idadmin');
            $no = -1;
            foreach ($sheetData as $row) {
                if ($baris > 2) {
                    $C = $row['C'];
                    $D = $row['D'];
                    $E = $row['E'];
                    $F = $row['F'];
                    $G = $row['G'];
                    $H = $row['H'];
                    $I = $row['I'];

                    if ($C == '1') {
                        $C = '';
                    }
                    if ($D == '1') {
                        $D = '';
                    }
                    if ($E == '1') {
                        $E = '';
                    }
                    if ($F == '1') {
                        $F = '';
                    }
                    if ($G == '1') {
                        $G = '';
                    }
                    if ($H == '1') {
                        $H = '';
                    }
                    if ($I == '1') {
                        $I = '';
                    }

                    array_push($data, [
                        'id' => $id2,
                        'kode' => $kode,
                        'id_pkp' => $id_pkp58,
                        'id_solusi' => $kode3,
                        'tgl_ubah' => $now,
                        'id_ubah' => $idQNS,

                        'nomor' => $no,
                        'fillType' => $C,
                        'masalah' => $D,
                        'penyebab' => $E,
                        'dampak' => $F,
                        'solusi' => $G,
                        'pic' => $H,
                        'target' => $I,
                    ]);
                }
                $baris++;
                $noUrut++;
                $no++;
                $kode = 'SOL' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
                $id1 = 'SOL' . md5($kode);
                $id2 = 'SOL' . hash('sha1', $id1) . 'QNS';
            }
            if ($this->proyek->input_semua3b($data)) {
                $this->session->setFlashdata('success', 'upload solusi sukses');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata(
                    'gagal',
                    'mengupload semua data, pastikan data yang diinput benar'
                );
                $redirectUrl = previous_url() ?? base_url();
            }

            $data['id_pkp'] = $id_pkp58;
            $data['token'] = csrf_hash();
            return redirect()->to($redirectUrl);
        }
    }

    public function xls1($kode)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_progress;

        $data['22'] = $this->db
            ->table('progress_proyek')
            ->orderBy('kode', 'desc')
            ->getWhere(['id_pkp' => $kode, 'tgl_ubah_progress' => $tgl]);
        if ($data['22']->getNumRows() > 0) {
            $tahun22 = $data['22']->getRow()->tahun;
            $bulan22 = $data['22']->getRow()->bulan;
        } else {
            $bulan22 = substr($now, 5, 2);
            $tahun22 = substr($now, 2, 2);
            //$tahun22 = '';
            //$bulan22 = '';
        }

        // Panggil class PHPExcel nya
        $excel = new Spreadsheet();
        // Settingan awal fil excel
        $excel
            ->getProperties()
            ->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle('Data Proyek')
            ->setSubject('Proyek')
            ->setDescription('Laporan Semua Data Proyek')
            ->setKeywords('Data Proyek');
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '535454'],
            ],
        ];
        $style_subjudul = [
            // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    // 'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E8AC52'],
            ],
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN, // Set border dengan garis tipis
                ],
            ],
        ];
        $style_left = [
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
        ];

        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue(
                'B2',
                'LAPORAN PROGRESS, Proyek: ' . $data['proyek']->getRow()->alias
            );
        $excel->setActiveSheetIndex(0)->setCellValue('B3', 'BULAN : ');
        $excel->setActiveSheetIndex(0)->setCellValue('C3', $bulan22);
        $excel->setActiveSheetIndex(0)->setCellValue('B4', 'TAHUN : ');
        $excel->setActiveSheetIndex(0)->setCellValue('C4', '20' . $tahun22);

        $excel
            ->getActiveSheet()
            ->getStyle('C3:C4')
            ->applyFromArray($style_left);

        $excel->setActiveSheetIndex(0)->setCellValue('B5', 'PAKET PEKERJAAN');
        $excel->setActiveSheetIndex(0)->setCellValue('C5', 'KONTRAKTOR');
        $excel->setActiveSheetIndex(0)->setCellValue('D5', 'BOBOT');

        $excel->setActiveSheetIndex(0)->setCellValue('E5', 'S/D BULAN LALU');
        $excel->setActiveSheetIndex(0)->setCellValue('E6', 'Plan');
        $excel->setActiveSheetIndex(0)->setCellValue('F6', 'Actual');
        $excel->setActiveSheetIndex(0)->setCellValue('G6', 'Deviasi');

        $excel->setActiveSheetIndex(0)->setCellValue('H5', 'BULAN INI');
        $excel->setActiveSheetIndex(0)->setCellValue('H6', 'Plan');
        $excel->setActiveSheetIndex(0)->setCellValue('I6', 'Actual');
        $excel->setActiveSheetIndex(0)->setCellValue('J6', 'Deviasi');

        $excel->setActiveSheetIndex(0)->setCellValue('K5', 'S/D BULAN INI');
        $excel->setActiveSheetIndex(0)->setCellValue('K6', 'Plan');
        $excel->setActiveSheetIndex(0)->setCellValue('L6', 'Actual');
        $excel->setActiveSheetIndex(0)->setCellValue('M6', 'Deviasi');

        $excel->setActiveSheetIndex(0)->setCellValue('N5', 'Waktu Pelaksanaan');
        $excel->setActiveSheetIndex(0)->setCellValue('N6', 'Start');
        $excel->setActiveSheetIndex(0)->setCellValue('O6', 'Finis');

        $excel->setActiveSheetIndex(0)->setCellValue('P5', 'Target /Bulan');

        $excel->setActiveSheetIndex(0)->setCellValue('Q5', 'Adendum');
        $excel->setActiveSheetIndex(0)->setCellValue('Q6', 'Start');
        $excel->setActiveSheetIndex(0)->setCellValue('R6', 'Finish');

        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue('S5', 'Tanggal Real Selesai');
        $excel->setActiveSheetIndex(0)->setCellValue('T5', 'Keterangan');

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel
            ->getActiveSheet()
            ->getStyle('B5:T6')
            ->applyFromArray($style_col);

        $excel->getActiveSheet()->mergeCells('B5:B6');
        $excel->getActiveSheet()->mergeCells('C5:C6');
        $excel->getActiveSheet()->mergeCells('D5:D6');
        $excel->getActiveSheet()->mergeCells('E5:G5');
        $excel->getActiveSheet()->mergeCells('H5:J5');
        $excel->getActiveSheet()->mergeCells('K5:M5');
        $excel->getActiveSheet()->mergeCells('N5:O5');
        $excel->getActiveSheet()->mergeCells('P5:P6');
        $excel->getActiveSheet()->mergeCells('Q5:R5');
        $excel->getActiveSheet()->mergeCells('S5:S6');
        $excel->getActiveSheet()->mergeCells('T5:T6');

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 3

        $QN4 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$kode' and tahun='$tahun22' and bulan='$bulan22' order by kode"
        );
        if ($QN4->getNumRows() > 0) {
            foreach ($QN4->getResult() as $data) {
                if ($data->tgl_mulai > 0) {
                    $tgl_mulai = $data->tgl_mulai;
                } else {
                    $tgl_mulai = '';
                }
                if ($data->tgl_selesai > 0) {
                    $tgl_selesai = $data->tgl_selesai;
                } else {
                    $tgl_selesai = '';
                }
                if ($data->tgl_sadd > 0) {
                    $tgl_sadd = $data->tgl_sadd;
                } else {
                    $tgl_sadd = '';
                }
                if ($data->tgl_fadd > 0) {
                    $tgl_fadd = $data->tgl_fadd;
                } else {
                    $tgl_fadd = '';
                }
                if ($data->tgl_rf > 0) {
                    $tgl_rf = $data->tgl_rf;
                } else {
                    $tgl_rf = '';
                }
                //$excel->getActiveSheet()->getStyle('A' . $numrow . ':' . 'O' . $numrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('B' . $numrow, $data->paket);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C' . $numrow, $data->kode_pt);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'D' . $numrow,
                        number_format($data->bobot_pg, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'E' . $numrow,
                        number_format($data->rensd_mgll, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'F' . $numrow,
                        number_format($data->rilsd_mgll, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'G' . $numrow,
                        number_format($data->devsd_mgll, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'H' . $numrow,
                        number_format($data->ren_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'I' . $numrow,
                        number_format($data->ril_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'J' . $numrow,
                        number_format($data->dev_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'K' . $numrow,
                        number_format($data->rensd_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'L' . $numrow,
                        number_format($data->rilsd_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'M' . $numrow,
                        number_format($data->devsd_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('N' . $numrow, $tgl_mulai);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('O' . $numrow, $tgl_selesai);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'P' . $numrow,
                        number_format($data->target_minggu, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('Q' . $numrow, $tgl_sadd);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('R' . $numrow, $tgl_fadd);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('S' . $numrow, $tgl_rf);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('T' . $numrow, $data->keterangan);

                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $numrow . ':T' . $numrow)
                    ->applyFromArray($style_row);
                //$excel->getActiveSheet()->getStyle('B' . $numrow . ':P' . $numrow)->getAlignment()->setWrapText(true);
                //$excel->getActiveSheet()->getStyle('A' . $numrow . ':' . 'P' . $numrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
            }
        } else {
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('B' . $numrow, 'Isi Nama Paket');
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('C' . $numrow, 'Isi Nama Singkat Kontraktor');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, 100);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, 20.5);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, 17.5);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, -2.5);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, 5);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, 6);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, 1);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 25.5);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 23.5);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, -2);
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('N' . $numrow, '2022-01-01');
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('O' . $numrow, '2023-01-01');
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, 6.29);
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '');

            $excel
                ->getActiveSheet()
                ->getStyle('B' . $numrow . ':T' . $numrow)
                ->applyFromArray($style_row);
            //$excel->getActiveSheet()->getStyle('B' . $numrow . ':P' . $numrow)->getAlignment()->setWrapText(true);
            //$excel->getActiveSheet()->getStyle('A' . $numrow . ':' . 'P' . $numrow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);

            $no++; // Tambah 1 setiap kali looping
            $numrow++;
        }
        $QN5 = $this->db->query(
            "SELECT * FROM progress_proyek where id_pkp='$kode' and tahun='$tahun22' and bulan='$bulan22' order by kode"
        );
        if ($QN5->getNumRows() > 0) {
            foreach ($QN5->getResult() as $data2) {
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('B' . $numrow, 'TOTAL');
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C' . $numrow, '-');
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'D' . $numrow,
                        number_format($data2->bobot_pg, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'E' . $numrow,
                        number_format($data2->rensd_mgll, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'F' . $numrow,
                        number_format($data2->rilsd_mgll, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'G' . $numrow,
                        number_format($data2->devsd_mgll, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'H' . $numrow,
                        number_format($data2->ren_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'I' . $numrow,
                        number_format($data2->ril_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'J' . $numrow,
                        number_format($data2->dev_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'K' . $numrow,
                        number_format($data2->rensd_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'L' . $numrow,
                        number_format($data2->rilsd_mgini, 2, '.', ',')
                    );
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue(
                        'M' . $numrow,
                        number_format($data2->devsd_mgini, 2, '.', ',')
                    );
                $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, '');
                $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, '');
                $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, '');
                $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, '');
                $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '');
                $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '');
                $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '');
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $numrow . ':T' . $numrow)
                    ->applyFromArray($style_row);
            }
        } else {
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('B' . $numrow, 'TOTAL');
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, 100);
            $excel->setActiveSheetIndex(0)->setCellValue('E' . $numrow, 20.5);
            $excel->setActiveSheetIndex(0)->setCellValue('F' . $numrow, 17.5);
            $excel->setActiveSheetIndex(0)->setCellValue('G' . $numrow, -2.5);
            $excel->setActiveSheetIndex(0)->setCellValue('H' . $numrow, 5);
            $excel->setActiveSheetIndex(0)->setCellValue('I' . $numrow, 6);
            $excel->setActiveSheetIndex(0)->setCellValue('J' . $numrow, 1);
            $excel->setActiveSheetIndex(0)->setCellValue('K' . $numrow, 25.5);
            $excel->setActiveSheetIndex(0)->setCellValue('L' . $numrow, 23.5);
            $excel->setActiveSheetIndex(0)->setCellValue('M' . $numrow, -2);
            $excel->setActiveSheetIndex(0)->setCellValue('N' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('O' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('P' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('Q' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('R' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('S' . $numrow, '');
            $excel->setActiveSheetIndex(0)->setCellValue('T' . $numrow, '');
            $excel
                ->getActiveSheet()
                ->getStyle('B' . $numrow . ':T' . $numrow)
                ->applyFromArray($style_row);
        }
        // Set width kolom

        $excel
            ->getActiveSheet()
            ->getColumnDimension('A')
            ->setWidth(1); // Set width kolom A
        $excel
            ->getActiveSheet()
            ->getColumnDimension('B')
            ->setWidth(30);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('C')
            ->setWidth(30);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel
            ->getActiveSheet()
            ->getDefaultRowDimension()
            ->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel
            ->getActiveSheet()
            ->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle('Data Progress');
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="DataProgress.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = new Xlsx($excel);
        $write->save('php://output');
        exit();
    }

    public function pdf1()
    {
        $kode = $this->request->uri->getSegment(4);
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_progress;
        $tahun = substr($tgl, 2, 2);
        $bulan = substr($tgl, 5, 2);
        $no = 1;
        $fpdf = new FPDF('L', 'mm', 'A3');
        global $title;
        $fpdf->SetTitle($title);
        $fpdf->AliasNbPages();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Ln();
        $fpdf->Cell(50, 1, 'DATA PROGRESS', 0, 0, 'L');
        $fpdf->Ln(8);
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->Cell(10, 5, 'NO', 'LTR', 0, 'C', 0);
        $fpdf->Cell(80, 5, 'NAMA PAKET', 'LTR', 0, 'C', 0);
        $fpdf->Cell(20, 5, 'BOBOT', 'LTR', 0, 'C', 0);
        $fpdf->Cell(60, 5, 'S/D BULAN LALU', 'LTR', 0, 'C', 0);
        $fpdf->Cell(60, 5, 'BULAN INI', 'LTR', 0, 'C', 0);
        $fpdf->Cell(60, 5, 'S/D BULAN INI', 'LTR', 0, 'C', 0);
        $fpdf->Cell(20, 5, 'SISA', 'LTR', 0, 'C', 0);
        $fpdf->Cell(50, 5, 'WAKTU PELAKSANAAN', 'LTR', 0, 'C', 0);
        $fpdf->Cell(20, 5, 'SISA', 'LTR', 0, 'C', 0);
        $fpdf->Cell(20, 5, 'TARGET/', 'LTR', 1, 'C', 0);
        $fpdf->Cell(10, 5, '', 'LBR', 0, 'C', 0);
        $fpdf->Cell(80, 5, '', 'LBR', 0, 'C', 0);
        $fpdf->Cell(20, 5, '', 'LBR', 0, 'C', 0);
        $fpdf->Cell(20, 5, 'PLAN', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'ACTUAL', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'DEVIASI', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'PLAN', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'ACTUAL', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'DEVIASI', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'PLAN', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'ACTUAL', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'DEVIASI', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'PROGRES', 'LBR', 0, 'C', 0);
        $fpdf->Cell(25, 5, 'TGL MULAI', 1, 0, 'C', 0);
        $fpdf->Cell(25, 5, 'TGL SELESAI', 1, 0, 'C', 0);
        $fpdf->Cell(20, 5, 'WAKTU', 'LBR', 0, 'C', 0);
        $fpdf->Cell(20, 5, 'BULAN', 'LBR', 1, 'C', 0);

        $no = 1;
        $QN4 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$kode' and tahun='$tahun' and bulan='$bulan' order by kode"
        );
        foreach ($QN4->getResult() as $data) {
            $fpdf->SetFont('Arial', '', 9);
            $fpdf->Cell(10, 5, $no, 1, 0, 'C', 0);
            $fpdf->Cell(80, 5, $data->paket, 1, 0, 'L', 0);
            $fpdf->Cell(
                20,
                5,
                number_format($data->bobot_pg, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->rensd_mgll, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->rilsd_mgll, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->devsd_mgll, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->ren_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->ril_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->dev_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->rensd_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->rilsd_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->devsd_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data->sisa_bobotpg, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(25, 5, $data->tgl_mulai, 1, 0, 'C', 0);
            $fpdf->Cell(25, 5, $data->tgl_selesai, 1, 0, 'C', 0);
            $fpdf->Cell(20, 5, $data->sisa_waktu, 1, 0, 'C', 0);
            $fpdf->Cell(
                20,
                5,
                number_format($data->target_minggu, 2, ',', '.'),
                1,
                1,
                'C',
                0
            );
            $no++;
        }
        $QN5 = $this->db->query(
            "SELECT * FROM progress_proyek where id_pkp='$kode' and tahun='$tahun' and bulan='$bulan' order by kode"
        );
        foreach ($QN5->getResult() as $data2) {
            $fpdf->SetFont('Arial', '', 9);
            $fpdf->Cell(90, 5, 'TOTAL', 1, 0, 'C', 0);
            $fpdf->Cell(
                20,
                5,
                number_format($data2->bobot_pg, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->rensd_mgll, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->rilsd_mgll, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->devsd_mgll, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->ren_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->ril_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->dev_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->rensd_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->rilsd_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->devsd_mgini, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(
                20,
                5,
                number_format($data2->sisa_bobotpg, 2, ',', '.'),
                1,
                0,
                'C',
                0
            );
            $fpdf->Cell(25, 5, '', 1, 0, 'C', 0);
            $fpdf->Cell(25, 5, '', 1, 0, 'C', 0);
            $fpdf->Cell(20, 5, '', 1, 0, 'C', 0);
            $fpdf->Cell(20, 5, '', 1, 1, 'C', 0);
        }
        $this->response->setContentType('application/pdf');
        $fpdf->Output();
    }

    public function pdf2($kode)
    {
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_absensi;
        $bln_lalu = date('m', strtotime('-1 month', strtotime($tgl)));
        $thn_lalu = date('Y', strtotime('-1 month', strtotime($tgl)));

        //Cari periode

        if ($bln_lalu == '01') {
            $bulan = 'Januari';
        } else {
            if ($bln_lalu == '02') {
                $bulan = 'Februari';
            } else {
                if ($bln_lalu == '03') {
                    $bulan = 'Maret';
                } else {
                    if ($bln_lalu == '04') {
                        $bulan = 'April';
                    } else {
                        if ($bln_lalu == '05') {
                            $bulan = 'Mei';
                        } else {
                            if ($bln_lalu == '06') {
                                $bulan = 'Juni';
                            } else {
                                if ($bln_lalu == '07') {
                                    $bulan = 'Juli';
                                } else {
                                    if ($bln_lalu == '08') {
                                        $bulan = 'Agustus';
                                    } else {
                                        if ($bln_lalu == '09') {
                                            $bulan = 'September';
                                        } else {
                                            if ($bln_lalu == '10') {
                                                $bulan = 'Oktober';
                                            } else {
                                                if ($bln_lalu == '11') {
                                                    $bulan = 'November';
                                                } else {
                                                    $bulan = 'Desember';
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $no = 1;
        $fpdf = new FPDF('L', 'mm', 'A3');
        global $title;
        $fpdf->SetTitle($title);
        $fpdf->SetLeftMargin(2);
        $fpdf->AliasNbPages();
        $fpdf->AddPage();
        $fpdf->SetFont('Arial', '', 6);
        $fpdf->Ln();
        $fpdf->Cell(
            1,
            2,
            'LAPORAN MOBILISASI/ DEMOBILISASI, ABSENSI DAN AKHIR KONTRAK KARYAWAN',
            0,
            0,
            'L'
        );
        $fpdf->Ln();
        $fpdf->Cell(
            1,
            2,
            'PROYEK  : ' . $data['proyek']->getRow()->alias,
            0,
            0,
            'L'
        );
        $fpdf->Ln();
        $fpdf->Cell(1, 2, 'PERIODE : ' . $bulan . ' ' . $thn_lalu, 0, 0, 'L');
        $fpdf->Ln(4);
        $fpdf->SetFont('Arial', '', 5);
        $fpdf->SetFillColor(220, 220, 220);
        $fpdf->Cell(5, 10, 'NO', 'LRT', 0, 'C', true);
        $fpdf->Cell(10, 10, 'NRP', 'LRT', 0, 'C', true);
        $fpdf->Cell(30, 10, 'NAMA KARYAWAN', 'LRT', 0, 'C', true);
        $fpdf->Cell(28, 5, 'ABSENSI', 1, 0, 'C', true);
        $fpdf->Cell(25, 10, 'KET.ABSENSI', 'LRT', 0, 'C', true);
        $fpdf->Cell(20, 10, 'JABATAN', 'LRT', 0, 'C', true);
        $fpdf->Cell(20, 10, 'KET.JABATAN', 'LRT', 0, 'C', true);
        $fpdf->Cell(20, 5, 'TGL AKHIR', 'LRT', 0, 'C', true);
        $fpdf->Cell(34, 5, 'MOBILISASI', 1, 0, 'C', true);
        $fpdf->Cell(34, 5, 'DEMOBILISASI', 1, 0, 'C', true);
        $fpdf->Cell(20, 10, 'STATUS', 'LRT', 0, 'C', true);
        $fpdf->Cell(25, 5, 'KETERANGAN', 'LRT', 0, 'C', true);
        $fpdf->Cell(20, 10, 'MUTASI/RESIGN', 'LRT', 0, 'C', true);
        $fpdf->Cell(1, 5, '', 0, 1, 'C');
        $fpdf->Cell(5, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(10, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(30, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(7, 5, 'Sakit', 1, 0, 'C', true);
        $fpdf->Cell(7, 5, 'Ijin', 1, 0, 'C', true);
        $fpdf->Cell(7, 5, 'Alpha', 1, 0, 'C', true);
        $fpdf->Cell(7, 5, 'Cuti', 1, 0, 'C', true);
        $fpdf->Cell(25, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(20, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(20, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(20, 5, 'KONTRAK', 'LRB', 0, 'C', true);
        $fpdf->Cell(17, 5, 'Rencana', 1, 0, 'C', true);
        $fpdf->Cell(17, 5, 'Aktual', 1, 0, 'C', true);
        $fpdf->Cell(17, 5, 'Rencana', 1, 0, 'C', true);
        $fpdf->Cell(17, 5, 'Aktual', 1, 0, 'C', true);
        $fpdf->Cell(20, 5, '', 'LRB', 0, 'C');
        $fpdf->Cell(25, 5, 'MOB/DEMOB', 'LRB', 0, 'C', true);
        $fpdf->Cell(20, 5, '', 'LRB', 1, 'C');
        $fpdf->Ln(0);
        //isi absensi
        $QN01 = $this->db->query(
            "SELECT * FROM detil_karyawan where id_pkp='$kode' and tgl_update='$tgl' order by kode"
        );
        if ($QN01->getNumRows() > 0) {
            $no01 = 1;
            foreach ($QN01->getResult() as $data01) {
                $user = $this->db
                    ->table('master_admin')
                    ->where('id', $data01->id_user)
                    ->limit(1)
                    ->get()
                    ->getRow();

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
                if ($data01->tgl_akhir_kontrak > 0) {
                    $tgl_akhir_kontrak = date(
                        'd-m-Y',
                        strtotime($data01->tgl_akhir_kontrak)
                    );
                } else {
                    $tgl_akhir_kontrak = '';
                }
                if ($data01->tgl_ren_mob > 0) {
                    $tgl_ren_mob = date(
                        'd-m-Y',
                        strtotime($data01->tgl_ren_mob)
                    );
                } else {
                    $tgl_ren_mob = '';
                }
                if ($data01->tgl_real_mob > 0) {
                    $tgl_real_mob = date(
                        'd-m-Y',
                        strtotime($data01->tgl_real_mob)
                    );
                } else {
                    $tgl_real_mob = '';
                }
                if ($data01->tgl_ren_demob > 0) {
                    $tgl_ren_demob = date(
                        'd-m-Y',
                        strtotime($data01->tgl_ren_demob)
                    );
                } else {
                    $tgl_ren_demob = '';
                }
                if ($data01->tgl_real_demob > 0) {
                    $tgl_real_demob = date(
                        'd-m-Y',
                        strtotime($data01->tgl_real_demob)
                    );
                } else {
                    $tgl_real_demob = '';
                }
                $fpdf->Cell(5, 5, $no01, 1, 0, 'R');
                $fpdf->Cell(10, 5, $user->username, 1, 0, 'C');
                $fpdf->Cell(30, 5, $user->nama_admin, 1, 0, 'L');
                $fpdf->Cell(7, 5, $sakit, 1, 0, 'C');
                $fpdf->Cell(7, 5, $ijin, 1, 0, 'C');
                $fpdf->Cell(7, 5, $alpha, 1, 0, 'C');
                $fpdf->Cell(7, 5, $cuti, 1, 0, 'C');
                $fpdf->Cell(25, 5, $data01->ket_absensi, 1, 0, 'C');
                $fpdf->Cell(20, 5, $data01->jabatan, 1, 0, 'L');
                $fpdf->Cell(20, 5, $data01->ket_jabatan, 1, 0, 'C');
                $fpdf->Cell(20, 5, $tgl_akhir_kontrak, 1, 0, 'C');
                $fpdf->Cell(17, 5, $tgl_ren_mob, 1, 0, 'C');
                $fpdf->Cell(17, 5, $tgl_real_mob, 1, 0, 'C');
                $fpdf->Cell(17, 5, $tgl_ren_demob, 1, 0, 'C');
                $fpdf->Cell(17, 5, $tgl_real_demob, 1, 0, 'C');
                $fpdf->Cell(20, 5, $data01->status, 1, 0, 'C');
                $fpdf->Cell(25, 5, $data01->ket_mobdemob, 1, 0, 'C');
                $fpdf->Cell(20, 5, $data01->ket_akhir, 1, 1, 'C');
                $no01++;
            }
        }
        $this->response->setContentType('application/pdf');
        $fpdf->Output('I', 'report.pdf');
    }

    public function upd_close_pkp()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_pkp' => $this->request->getPost('id_pkp'),
            'tgl_close' => $this->request->getPost('tgl_close'),
        ];
        $simpan = $this->proyek;
        if ($simpan->simpantglclose($postData)) {
            $this->session->setFlashdata('success', 'update data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'update data');
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['id_pkp'] = $postData['id_pkp'];
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function xls2($kode)
    {
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_masalah;
        $tahun = substr($tgl, 2, 2);
        $bulan = substr($tgl, 5, 2);

        // Panggil class PHPExcel nya
        $excel = new Spreadsheet();
        // Settingan awal fil excel
        $excel
            ->getProperties()
            ->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle('Data')
            ->setSubject('')
            ->setDescription('Laporan Semua Data')
            ->setKeywords('Data');
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '535454'],
            ],
        ];

        $style_subjudul = [
            // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    // 'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E8AC52'],
            ],
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_TOP, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN], // Set border top dengan garis tipis
            ],
        ];
        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue('B2', 'LAPORAN PERMASALAHAN POKOK'); // Set kolom A1 dengan tulisan "NO"
        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue(
                'B3',
                'PROYEK : ' . $data['proyek']->getRow()->alias
            ); // Set kolom B1 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('B5', 'NO'); // Set kolom C1 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('C5', 'URAIAN'); // Set kolom D1 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('D5', 'PENYEBAB');
        $excel->setActiveSheetIndex(0)->setCellValue('E5', 'DAMPAK');
        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue('F5', 'TINDAK LANJUT/SOLUSI');
        $excel->setActiveSheetIndex(0)->setCellValue('G5', 'NAMA PIC'); // Set kolom E1 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H5', 'TARGET');

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel
            ->getActiveSheet()
            ->getStyle('B5:H5')
            ->applyFromArray($style_col);
        $QN01 = $this->db->query(
            "SELECT * FROM solusi where id_pkp='$kode' and tgl_ubah='$tgl' and type='EKS' order by kode"
        );
        $baris = 6;
        if ($QN01->getNumRows() > 0) {
            $no01 = 1;
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('B' . $baris, 'EKSTERNAL');
            $excel
                ->getActiveSheet()
                ->getStyle('B' . $baris . ':H' . $baris)
                ->applyFromArray($style_subjudul);
            $excel->getActiveSheet()->mergeCells('B' . $baris . ':H' . $baris);
            $baris++;
            foreach ($QN01->getResult() as $data01) {
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('B' . $baris, $no01);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C' . $baris, $data01->masalah);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('D' . $baris, $data01->penyebab);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('E' . $baris, $data01->dampak);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('F' . $baris, $data01->solusi);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('G' . $baris, $data01->pic);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('H' . $baris, $data01->target);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $baris . ':H' . $baris)
                    ->applyFromArray($style_row);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $baris . ':H' . $baris)
                    ->getAlignment()
                    ->setWrapText(true);
                $no01++;
                $baris++;
            }
        }
        // Set width kolom
        $QN01 = $this->db->query(
            "SELECT * FROM solusi where id_pkp='$kode' and tgl_ubah='$tgl' and type='INT' order by kode"
        );
        if ($QN01->getNumRows() > 0) {
            $no01 = 1;
            $excel
                ->setActiveSheetIndex(0)
                ->setCellValue('B' . $baris, 'INTERNAL');
            $excel
                ->getActiveSheet()
                ->getStyle('B' . $baris . ':H' . $baris)
                ->applyFromArray($style_subjudul);
            $excel->getActiveSheet()->mergeCells('B' . $baris . ':H' . $baris);
            $baris++;
            foreach ($QN01->getResult() as $data01) {
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('B' . $baris, $no01);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C' . $baris, $data01->masalah);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('D' . $baris, $data01->penyebab);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('E' . $baris, $data01->dampak);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('F' . $baris, $data01->solusi);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('G' . $baris, $data01->pic);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('H' . $baris, $data01->target);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $baris . ':H' . $baris)
                    ->applyFromArray($style_row);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $baris . ':H' . $baris)
                    ->getAlignment()
                    ->setWrapText(true);
                $no01++;
                $baris++;
            }
        }
        $excel
            ->getActiveSheet()
            ->getColumnDimension('B')
            ->setWidth(5); // Set width kolom A
        $excel
            ->getActiveSheet()
            ->getColumnDimension('C')
            ->setWidth(35); // Set width kolom B
        $excel
            ->getActiveSheet()
            ->getColumnDimension('D')
            ->setWidth(35);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('E')
            ->setWidth(35);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('F')
            ->setWidth(35);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('G')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('H')
            ->setWidth(15);
        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel
            ->getActiveSheet()
            ->getDefaultRowDimension()
            ->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel
            ->getActiveSheet()
            ->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nyap
        $excel->getActiveSheet(0)->setTitle('Masalah Pokok');
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="DataMasalah.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = new Xlsx($excel);
        $write->save('php://output');
        exit();
    }

    public function xls3($kode)
    {
        $data['proyek'] = $this->db
            ->table('master_pkp')
            ->getWhere(['id_pkp' => $kode], 1);
        $tgl = $data['proyek']->getRow()->tgl_ubah_absensi;
        $tahun = substr($tgl, 2, 2);
        $bulan = substr($tgl, 5, 2);

        // Panggil class PHPExcel nya
        $excel = new Spreadsheet();
        // Settingan awal fil excel
        $excel
            ->getProperties()
            ->setCreator('My Notes Code')
            ->setLastModifiedBy('My Notes Code')
            ->setTitle('Data')
            ->setSubject('Proyek')
            ->setDescription('Laporan Semua Data ')
            ->setKeywords('Data');
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => Alignment::VERTICAL_CENTER, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '535454'],
            ],
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => Alignment::VERTICAL_TOP, // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN], // Set border top dengan garis tipis
            ],
        ];
        //Cari periode
        $QN00 = $this->db->query(
            "SELECT * FROM detil_karyawan where id_pkp='$kode' and tgl_update='$tgl' order by kode"
        );
        foreach ($QN00->getResult() as $row00) {
            $tahun = $row00->tahun;
            if ($row00->bulan = '01') {
                $bulan = 'Januari';
            } else {
                if ($row00->bulan = '02') {
                    $bulan = 'Februari';
                } else {
                    if ($row00->bulan = '03') {
                        $bulan = 'Maret';
                    } else {
                        if ($row00->bulan = '04') {
                            $bulan = 'April';
                        } else {
                            if ($row00->bulan = '05') {
                                $bulan = 'Mei';
                            } else {
                                if ($row00->bulan = '06') {
                                    $bulan = 'Juni';
                                } else {
                                    if ($row00->bulan = '07') {
                                        $bulan = 'Juli';
                                    } else {
                                        if ($row00->bulan = '08') {
                                            $bulan = 'Agustus';
                                        } else {
                                            if ($row00->bulan = '09') {
                                                $bulan = 'September';
                                            } else {
                                                if ($row00->bulan = '10') {
                                                    $bulan = 'Oktober';
                                                } else {
                                                    if ($row00->bulan = '11') {
                                                        $bulan = 'November';
                                                    } else {
                                                        $bulan = 'Desember';
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //JUDUL
        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue(
                'B2',
                'LAPORAN MOBILISASI/ DEMOBILISASI, ABSENSI DAN AKHIR KONTRAK KARYAWAN'
            );
        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue(
                'B3',
                'PROYEK : ' . $data['proyek']->getRow()->alias
            );
        $excel
            ->setActiveSheetIndex(0)
            ->setCellValue('B4', 'PERIODE : ' . $bulan . ' ' . $tahun);
        //HEADER
        $excel->setActiveSheetIndex(0)->setCellValue('B5', 'NO');
        $excel->setActiveSheetIndex(0)->setCellValue('C5', 'NRP');
        $excel->setActiveSheetIndex(0)->setCellValue('D5', 'NAMA KARYAWAN');
        $excel->setActiveSheetIndex(0)->setCellValue('E5', 'ABSENSI');
        $excel->setActiveSheetIndex(0)->setCellValue('E6', 'Sakit');
        $excel->setActiveSheetIndex(0)->setCellValue('F6', 'Ijin');
        $excel->setActiveSheetIndex(0)->setCellValue('G6', 'Alpha');
        $excel->setActiveSheetIndex(0)->setCellValue('H6', 'Cuti');
        $excel->setActiveSheetIndex(0)->setCellValue('I5', 'KET. ABSENSI');
        $excel->setActiveSheetIndex(0)->setCellValue('J5', 'JABATAN');
        $excel->setActiveSheetIndex(0)->setCellValue('K5', 'POSISI');
        $excel->setActiveSheetIndex(0)->setCellValue('L5', 'KONTRAK');
        $excel->setActiveSheetIndex(0)->setCellValue('L6', 'TGL AWAL');
        $excel->setActiveSheetIndex(0)->setCellValue('M6', 'TGL AKHIR');
        $excel->setActiveSheetIndex(0)->setCellValue('N5', 'MOB');
        $excel->setActiveSheetIndex(0)->setCellValue('N6', 'Renc');
        $excel->setActiveSheetIndex(0)->setCellValue('O6', 'Real');
        $excel->setActiveSheetIndex(0)->setCellValue('P5', 'DEMOB');
        $excel->setActiveSheetIndex(0)->setCellValue('P6', 'Renc');
        $excel->setActiveSheetIndex(0)->setCellValue('Q6', 'Real');
        $excel->setActiveSheetIndex(0)->setCellValue('R5', 'STATUS');
        $excel->setActiveSheetIndex(0)->setCellValue('S5', 'Ket. MOB/DEMOB');
        $excel->setActiveSheetIndex(0)->setCellValue('T5', 'MUTASI/ RESIGN/TF');

        //MERGE HEADER
        $excel->getActiveSheet()->mergeCells('B5:B6');
        $excel->getActiveSheet()->mergeCells('C5:C6');
        $excel->getActiveSheet()->mergeCells('D5:D6');
        $excel->getActiveSheet()->mergeCells('E5:H5');
        $excel->getActiveSheet()->mergeCells('I5:I6');
        $excel->getActiveSheet()->mergeCells('J5:J6');
        $excel->getActiveSheet()->mergeCells('K5:K6');
        $excel->getActiveSheet()->mergeCells('L5:M5');
        $excel->getActiveSheet()->mergeCells('N5:O5');
        $excel->getActiveSheet()->mergeCells('P5:Q5');
        $excel->getActiveSheet()->mergeCells('R5:R6');
        $excel->getActiveSheet()->mergeCells('S5:S6');
        $excel->getActiveSheet()->mergeCells('T5:T6');
        //STYLE HEADER
        $excel
            ->getActiveSheet()
            ->getStyle('B5:T6')
            ->applyFromArray($style_col);
        $excel
            ->getActiveSheet()
            ->getStyle('B5:T6')
            ->getAlignment()
            ->setWrapText(true);

        //isi absensi
        $QN01 = $this->db->query(
            "SELECT * FROM detil_karyawan where id_pkp='$kode' and tgl_update='$tgl' order by kode"
        );
        $baris = 7;
        if ($QN01->getNumRows() > 0) {
            $no01 = 1;
            foreach ($QN01->getResult() as $data01) {
                $id_user = $data01->id_user;
                $QN02 = $this->db->query(
                    "SELECT * FROM master_admin where id='$id_user'"
                );
                if ($QN02->getNumRows() > 0) {
                    foreach ($QN02->getResult() as $data02) {
                        $nama = $data02->nama_admin;
                        $nrp = $data02->username;
                    }
                } else {
                    $nama = $id_user;
                    $nrp = '';
                }
                if ($data02->tgl_kontrak > 0) {
                    $tgl_awal_kontrak = $data02->tgl_kontrak;
                } else {
                    $tgl_awal_kontrak = '';
                }
                if ($data02->habis_kontrak > 0) {
                    $tgl_akhir_kontrak = $data02->habis_kontrak;
                } else {
                    $tgl_akhir_kontrak = '';
                }
                if ($data01->tgl_ren_mob > 0) {
                    $tgl_ren_mob = $data01->tgl_ren_mob;
                } else {
                    $tgl_ren_mob = '';
                }
                if ($data01->tgl_real_mob > 0) {
                    $tgl_real_mob = $data01->tgl_real_mob;
                } else {
                    $tgl_real_mob = '';
                }
                if ($data01->tgl_ren_demob > 0) {
                    $tgl_ren_demob = $data01->tgl_ren_demob;
                } else {
                    $tgl_ren_demob = '';
                }
                if ($data01->tgl_real_demob > 0) {
                    $tgl_real_demob = $data01->tgl_real_demob;
                } else {
                    $tgl_real_demob = '';
                }
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('B' . $baris, $no01);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('C' . $baris, $nrp);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('D' . $baris, $nama);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('E' . $baris, $data01->sakit);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('F' . $baris, $data01->ijin);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('G' . $baris, $data01->alpha);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('H' . $baris, $data01->cuti);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('I' . $baris, $data01->ket_absensi);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('J' . $baris, $data02->jabatan);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('K' . $baris, $data01->ket_jabatan);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('L' . $baris, $tgl_awal_kontrak);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('M' . $baris, $tgl_akhir_kontrak);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('N' . $baris, $tgl_ren_mob);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('O' . $baris, $tgl_real_mob);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('P' . $baris, $tgl_ren_demob);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('Q' . $baris, $tgl_real_demob);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('R' . $baris, $data02->status);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('S' . $baris, $data01->ket_mobdemob);
                $excel
                    ->setActiveSheetIndex(0)
                    ->setCellValue('T' . $baris, $data01->ket_akhir);

                //STYLE ISI
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $baris . ':T' . $baris)
                    ->applyFromArray($style_row);
                $excel
                    ->getActiveSheet()
                    ->getStyle('J' . $baris . ':J' . $baris)
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('L' . $baris . ':M' . $baris)
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('R' . $baris . ':R' . $baris)
                    ->applyFromArray($style_col);
                $excel
                    ->getActiveSheet()
                    ->getStyle('B' . $baris . ':T' . $baris)
                    ->getAlignment()
                    ->setWrapText(true);

                $no01++;
                $baris++;
            }
        } else {
            //JIKA BELUM ISI ABSEN
            $QN03 = $this->db->query(
                "SELECT * FROM master_admin where pkp_akhir='$kode' order by kode"
            );
            $baris = 7;
            if ($QN03->getNumRows() > 0) {
                $no01 = 1;
                foreach ($QN03->getResult() as $data03) {
                    if ($data03->tgl_kontrak > 0) {
                        $tgl_awal_kontrak = $data03->tgl_kontrak;
                    } else {
                        $tgl_awal_kontrak = '';
                    }
                    if ($data03->habis_kontrak > 0) {
                        $tgl_akhir_kontrak = $data03->habis_kontrak;
                    } else {
                        $tgl_akhir_kontrak = '';
                    }
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('B' . $baris, $no01);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('C' . $baris, $data03->username);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('D' . $baris, $data03->nama_admin);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('E' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('F' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('G' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('H' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('I' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('J' . $baris, $data03->jabatan);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('K' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('L' . $baris, $tgl_awal_kontrak);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('M' . $baris, $tgl_akhir_kontrak);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('N' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('O' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('P' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('Q' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('R' . $baris, $data03->status);
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('S' . $baris, '');
                    $excel
                        ->setActiveSheetIndex(0)
                        ->setCellValue('T' . $baris, '');
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $baris . ':T' . $baris)
                        ->applyFromArray($style_row);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('J' . $baris . ':J' . $baris)
                        ->applyFromArray($style_col);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('L' . $baris . ':M' . $baris)
                        ->applyFromArray($style_col);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('R' . $baris . ':R' . $baris)
                        ->applyFromArray($style_col);
                    $excel
                        ->getActiveSheet()
                        ->getStyle('B' . $baris . ':T' . $baris)
                        ->getAlignment()
                        ->setWrapText(true);
                    $no01++;
                    $baris++;
                }
            }
        }

        $excel
            ->getActiveSheet()
            ->getColumnDimension('A')
            ->setWidth(1);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('B')
            ->setWidth(5);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('C')
            ->setWidth(8);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('D')
            ->setWidth(35);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('E')
            ->setWidth(7);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('F')
            ->setWidth(7);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('G')
            ->setWidth(7);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('H')
            ->setWidth(7);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('I')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('J')
            ->setWidth(20);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('K')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('L')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('M')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('N')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('O')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('P')
            ->setWidth(20);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('Q')
            ->setWidth(20);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('R')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('S')
            ->setWidth(15);
        $excel
            ->getActiveSheet()
            ->getColumnDimension('T')
            ->setWidth(15);

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $excel
            ->getActiveSheet()
            ->getDefaultRowDimension()
            ->setRowHeight(-1);
        // Set orientasi kertas jadi LANDSCAPE
        $excel
            ->getActiveSheet()
            ->getPageSetup()
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle('Mob Demob');
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment; filename="DataAbsensi.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = new Xlsx($excel);
        $write->save('php://output');
        exit();
    }

    public function tambahsolusiform()
    {
        //THBL TGL BERJALAN//
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        //ambil no urut terakhir//
        //INSTHBL-12345//
        //KODE-SOLUSI BERSAMA//
        $QN3 = $this->db->query(
            'SELECT max(id_solusi) as masKode3 FROM master_pkp order by id_solusi'
        );
        foreach ($QN3->getResult() as $row3) {
            $order3 = $row3->masKode3;
        }
        $post = $this->request->getPost();
        $id_pkp58 = $post['id_pkp58'];
        $noUrut3 = (int) substr($order3, 8, 5);
        //BL masKode//
        $bulanL3 = substr($order3, 5, 2);
        $bln3 = substr($now, 5, 2);
        $tahun3 = substr($now, 2, 2);
        if ($bln3 == $bulanL3) {
            $kode3 =
                'IDS' . $tahun3 . $bln3 . '-' . sprintf('%05s', $noUrut3);
        } else {
            $kode3 = 'IDS' . $tahun3 . $bln3 . '-' . '00001';
        }
        
        $data0 = [
            'tgl_ubah_masalah' => $now,
            'id_solusi' =>$kode3
        ];
        $this->db
            ->table('master_pkp')
            ->where('id_pkp', $id_pkp58)
            ->update($data0);
        //ambil no urut terakhir//
        //INSTHBL-12345//
        $QN = $this->db->query(
            'SELECT max(kode) as masKode FROM solusi order by kode'
        );
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
            $kode = 'SOL' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
        } else {
            $kode = 'SOL' . $tahun . $bln . '-' . '00001';
        }
        $id1 = 'SOL' . md5($kode);
        $id2 = 'SOL' . hash('sha1', $id1) . 'QNS';
        $idQNS = session('idadmin');
        // $baris++;
        $noUrut++;
        $no = $this->db->table('solusi')->where('id_solusi', $order3)->selectMax('nomor')->get()->getRow();
        $no = $no->nomor;
        $no++;
        $kode = 'SOL' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
        $id1 = 'SOL' . md5($kode);
        $id2 = 'SOL' . hash('sha1', $id1) . 'QNS';

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_kontraktor' => 'required',
            'nama_paket'      => 'required',    
            'type'            => 'required',    
            'uraian'          => 'required',
            'penyebab'        => 'required',
            'dampak'          => 'required',
            'solusi'          => 'required',
            'pic'             => 'required',
            'target'          => 'required',
            'status'          => 'required',
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Menggunakan Query Builder untuk menyimpan data
        $builder = $this->db->table('solusi');
        $data = [
            'id'              => $id2,
            'kode'            => $kode,
            'id_pkp'          => $id_pkp58,
            'id_solusi'       => $kode3,
            'tgl_ubah'        => $now,
            'id_ubah'         => $idQNS,
            'nomor'           => $no,
            'nama_kontraktor' => $this->request->getPost('nama_kontraktor'),
            'nama_paket'      => $this->request->getPost('nama_paket'),
            'type'            => $this->request->getPost('type'),
            'masalah'         => $this->request->getPost('uraian'),
            'penyebab'        => $this->request->getPost('penyebab'),
            'dampak'          => $this->request->getPost('dampak'),
            'solusi'          => $this->request->getPost('solusi'),
            'pic'             => $this->request->getPost('pic'),
            'target'          => $this->request->getPost('target'),
            'status'          => $this->request->getPost('status'),
        ];

        if ($builder->insert($data)) {
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data');
        }
    }



    public function lampiransolusitambah()
    {
        $now = date('Y-m-d');
        $id_pkp = $this->request->getPost('id_pkp'); // Assuming you get this from POST or GET request
        $kode = $this->request->getPost('id_kode'); 
        // Retrieve no_pkp and id_instansi from the database
        $QN2 = $this->db->query(
            "SELECT * FROM master_pkp where id_pkp='$id_pkp'"
        );
        foreach ($QN2->getResult() as $row2) {
            $no_pkp = $row2->no_pkp;
            $id_instansi = $row2->id_instansi;
        }

        // Retrieve no_instansi from the database
        $QN3 = $this->db->query(
            "SELECT * FROM master_instansi where id='$id_instansi'"
        );
        foreach ($QN3->getResult() as $row3) {
            $no_instansi = $row3->nomor;
        }

        // Define the location for storing the uploaded PDF
        $lokasi = 'assets/pdf/solusi/' . $no_instansi . '/' . $no_pkp;

        // Check if directory exists, if not create it
        if (!file_exists($lokasi)) {
            mkdir($lokasi, 0777, true);
        }

        $fileName =  $kode . '.pdf'; // Define the file name

        // Delete the old PDF file
        $oldFilePath = $lokasi . '/' . $no_pkp . '.pdf';
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        $file = $this->request->getFile('berkas'); // Get the uploaded file

        // Check file size and type
        if ($file->getSize() > 100000000 || $file->getExtension() != 'pdf') {
            $this->session->setFlashdata(
                'error',
                'Ukuran file harus kurang dari 100MB'
            );
        }

        // Move the file to the defined location with the defined file name
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($lokasi, $fileName);
            $datagbr1 = [
                'lampiran' => $lokasi . '/' . $fileName,
            ];
            $this->db
                ->table('solusi')
                ->where('kode', $kode)
                ->update($datagbr1);
        }

        $dataend = [
            'tgl_ubah' => $now,
        ];
        $this->db
            ->table('master_pkp')
            ->where('id_pkp', $id_pkp)
            ->update($dataend);
        $this->session->setFlashdata('success', 'upload pdf');
        $redirectUrl = previous_url() ?? base_url();
        return redirect()->to($redirectUrl);
    }

    public function editsolusi($kode)
    {
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');

        // // Cek apakah $kode ada
        // if (empty($kode)) {
        //     return $this->response->setJSON(['success' => false, 'message' => 'Kode tidak ditemukan atau kosong.']);
        // }

        $validation = \Config\Services::validation();
        
        // Validasi input
        $validation->setRules([
            'nama_kontraktor' => 'required',
            'nama_paket' => 'required',
            'uraian' => 'required',
            'penyebab' => 'required',
            'dampak' => 'required',
            'solusi' => 'required',
            'pic' => 'required',
            'target' => 'required',
            'status' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data tidak valid']);
        }

        // Data yang akan diupdate
        $data = [
            'nama_kontraktor' => $this->request->getPost('nama_kontraktor'),
            'nama_paket' => $this->request->getPost('nama_paket'),
            'masalah' => $this->request->getPost('uraian'),
            'penyebab' => $this->request->getPost('penyebab'),
            'dampak' => $this->request->getPost('dampak'),
            'solusi' => $this->request->getPost('solusi'),
            'pic' => $this->request->getPost('pic'),
            'target' => $this->request->getPost('target'),
            'status' => $this->request->getPost('status'),
            'tgl_ubah' => $now

        ];

        // // Log data yang akan diupdate
        // log_message('debug', 'Data yang diterima: ' . json_encode($data));

        // Koneksi database
        $db = \Config\Database::connect();
        
        // Cek apakah data dengan $kode ada di tabel solusi
        $builder = $db->table('solusi');
        // $dataLama = $builder->where('kode', $kode)->get()->getRow();

        // if (!$dataLama) {
        //     return $this->response->setJSON(['success' => false, 'message' => 'Data tidak ditemukan untuk kode: ' . $kode]);
        // }

        // Update data di tabel solusi
        $update = $builder->where('kode', $kode)->update($data);
        
        if (!$update) {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal mengupdate data.']);
        }

        return $this->response->setJSON(['success' => true, 'message' => 'Data berhasil diupdate']);
    }


    public function dtutambah()
    {
        $now = date('Y-m-d');
        $id_pkp = $this->request->getPost('id'); // Assuming you get this from POST or GET request

        // Retrieve no_pkp and id_instansi from the database
        $QN2 = $this->db->query(
            "SELECT * FROM master_pkp where id_pkp='$id_pkp'"
        );
        foreach ($QN2->getResult() as $row2) {
            $no_pkp = $row2->no_pkp;
            $id_instansi = $row2->id_instansi;
        }

        // Retrieve no_instansi from the database
        $QN3 = $this->db->query(
            "SELECT * FROM master_instansi where id='$id_instansi'"
        );
        foreach ($QN3->getResult() as $row3) {
            $no_instansi = $row3->nomor;
        }

        // Define the location for storing the uploaded PDF
        $lokasi = './assets/pdf/dtu/' . $no_instansi . '/' . $no_pkp;

        // Check if directory exists, if not create it
        if (!file_exists($lokasi)) {
            mkdir($lokasi, 0777, true);
        }

        $teknis = 'dtu';
        $fileName = $teknis . $no_pkp . '.pdf'; // Define the file name

        // Delete the old PDF file
        $oldFilePath = $lokasi . '/' . $teknis . $no_pkp . '.pdf';
        if (file_exists($oldFilePath)) {
            unlink($oldFilePath);
        }

        $file = $this->request->getFile('berkas'); // Get the uploaded file

        // Check file size and type
        if ($file->getSize() > 100000000 || $file->getExtension() != 'pdf') {
            $this->session->setFlashdata(
                'error',
                'Ukuran file harus kurang dari 100MB'
            );
        }

        // Move the file to the defined location with the defined file name
        if ($file->isValid() && !$file->hasMoved()) {
            $file->move($lokasi, $fileName);
            $datagbr1 = [
                'file_dtu' => $lokasi . '/' . $fileName,
            ];
            $this->db
                ->table('master_pkp')
                ->where('id_pkp', $id_pkp)
                ->update($datagbr1);
        }

        $dataend = [
            'tgl_ubah_dtu' => $now,
        ];
        $this->db
            ->table('master_pkp')
            ->where('id_pkp', $id_pkp)
            ->update($dataend);
        $this->session->setFlashdata('success', 'upload pdf');
        $redirectUrl = previous_url() ?? base_url();
        return redirect()->to($redirectUrl);
    }

    public function fototambah()
    {
        //THBL TGL BERJALAN//
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $now2 = date('Ymd');

        //ambil no urut terakhir//
        //INSTHBL-12345//
        $QN = $this->db->query(
            'SELECT max(kode) as masKode FROM gambar order by kode'
        );
        foreach ($QN->getResult() as $row) {
            $order = $row->masKode;
        }
        $noUrut = (int) substr($order, 8, 5);
        $noUrut++;
        //BL masKode//
        $bulanL = substr($order, 5, 2);
        $bln = substr($now, 5, 2);
        $tahun = substr($now, 2, 2);
        if ($bln == $bulanL) {
            $kode = 'GBR' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
        } else {
            $kode = 'GBR' . $tahun . $bln . '-' . '00001';
        }

        $post = $this->request->getPost();
        $id1 = 'GBR' . md5($kode);
        $id2 = 'GBR' . hash('sha1', $id1) . 'QNS';

        $array = [
            'id' => $id2,
            'id_pkp' => $post['id'],
            'kode' => $kode,
            'tgl_ubah' => $now,
            'id_ubah' => $post['id_ubah'],
        ];
        $this->db->table('gambar')->insert($array);
        $id_pkp = $post['id'];
        $QN2 = $this->db->query(
            "SELECT * FROM master_pkp where id_pkp='$id_pkp'"
        );
        foreach ($QN2->getResult() as $row2) {
            $no_pkp = $row2->no_pkp;
            $id_instansi = $row2->id_instansi;
        }
        $QN3 = $this->db->query(
            "SELECT * FROM master_instansi where id='$id_instansi'"
        );
        foreach ($QN3->getResult() as $row3) {
            $no_instansi = $row3->nomor;
        }
        $u = 0;
        $lokasi = './assets/images/dtu/' . $no_instansi . '/' . $no_pkp;

        if ($this->request->getFileMultiple('berkas')) {
            $files = $this->request->getFileMultiple('berkas');

            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $extension = $file->getExtension();
                    $newName =
                        $tahun . $bln . '-' . $kode . $u + 1 . '.' . $extension;
                    $file->move($lokasi, $newName);
                    // Update database for each image
                    $updateData = [
                        'gambar' . ($u + 1) => $lokasi . '/' . $newName,
                    ];

                    $this->db
                        ->table('gambar')
                        ->where('id', $id2)
                        ->update($updateData);

                    $u++;
                }
            }
        }

        if ($u < 3 || $u > 5) {
            return redirect()
                ->back()
                ->with('error', 'Choose between 3 and 5 images.');
        }
        $dataend = [
            'tgl_ubah_gbr' => $now,
        ];

        $this->db
            ->table('master_pkp')
            ->where('id_pkp', $id_pkp)
            ->update($dataend);

        return redirect()
            ->back()
            ->with('success', $u . ' File/s uploaded successfully.');
    }

    public function teknistambah()
    {
        //THBL TGL BERJALAN//
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $now2 = date('Ymd');
        $post = $this->request->getPost();
        $id_pkp = $post['id'];

        //ambil no urut terakhir//
        //INSTHBL-12345//
        $QN0 = $this->db->query("SELECT * FROM pdf where id_pkp='$id_pkp'");

        if ($QN0->getNumRows() > 0) {
            $data0 = [
                'tgl_ubah' => $now,
                'id_ubah' => $post['id_ubah'],
            ];
            $this->db
                ->table('pdf')
                ->where('id_pkp', $id_pkp)
                ->update($data0);
        } else {
            $QN = $this->db->query(
                'SELECT max(kode) as masKode FROM pdf order by kode'
            );
            foreach ($QN->getResult() as $row) {
                $order = $row->masKode;
            }
            $noUrut = (int) substr($order, 8, 5);
            $noUrut++;
            //BL masKode//
            $bulanL = substr($order, 5, 2);
            $bln = substr($now, 5, 2);
            $tahun = substr($now, 2, 2);
            if ($bln == $bulanL) {
                $kode = 'PDF' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
            } else {
                $kode = 'PDF' . $tahun . $bln . '-' . '00001';
            }

            $id1 = 'PDF' . md5($kode);
            $id2 = 'PDF' . hash('sha1', $id1) . 'QNS';

            $array = [
                'id' => $id2,
                'id_pkp' => $post['id'],
                'kode' => $kode,
                'tgl_ubah' => $now,
                'id_ubah' => $post['id_ubah'],
            ];

            $this->db->table('pdf')->insert($array);
        }

        $QN2 = $this->db->query(
            "SELECT * FROM master_pkp where id_pkp='$id_pkp'"
        );
        foreach ($QN2->getResult() as $row2) {
            $no_pkp = $row2->no_pkp;
            $id_instansi = $row2->id_instansi;
        }
        $QN3 = $this->db->query(
            "SELECT * FROM master_instansi where id='$id_instansi'"
        );
        foreach ($QN3->getResult() as $row3) {
            $no_instansi = $row3->nomor;
        }
        $lokasi = './assets/pdf/teknis/' . $no_instansi . '/' . $no_pkp;
        $config['upload_path'] = $lokasi;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 102400;
        $config['overwrite'] = true; // Set overwrite ke true

        $teknis = 'teknis';

        $jumlah_berkas = count($_FILES['berkas']['name']);
        $u = 1;
        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['berkas']['name'][$i])) {
                $upload = $this->request->getFileMultiple('berkas')[$i];

                // Lakukan upload file
                if ($upload->isValid() && !$upload->hasMoved()) {
                    $originalName = $upload->getClientName(); // Dapatkan nama file asli
                    $fileExt = $upload->getClientExtension(); // Dapatkan ekstensi file
                    $newFileName = $teknis . $i . '.' . $fileExt; // Buat nama file baru dengan nomor urut dan ekstensi yang sama
                    $config['file_name'] = $newFileName; // Set nama file pada konfigurasi

                    // Hapus file lama jika ada
                    $oldFilePath = $lokasi . '/' . $newFileName;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }

                    $upload->move($lokasi, $newFileName);
                    $namagam = $upload->getName(); // Mendapatkan nama file

                    // Update database sesuai dengan nama file yang diunggah
                    if ($i == 0) {
                        $this->db
                            ->table('pdf')
                            ->where('id_pkp', $id_pkp)
                            ->update(['pdf1' => $lokasi . '/teknis0.pdf']);
                    } elseif ($i == 1) {
                        $this->db
                            ->table('pdf')
                            ->where('id_pkp', $id_pkp)
                            ->update(['pdf2' => $lokasi . '/teknis1.pdf']);
                    } elseif ($i == 2) {
                        $this->db
                            ->table('pdf')
                            ->where('id_pkp', $id_pkp)
                            ->update(['pdf3' => $lokasi . '/teknis2.pdf']);
                    } elseif ($i >= 3 && $i < 10) {
                        $this->db
                            ->table('pdf')
                            ->where('id_pkp', $id_pkp)
                            ->update([
                                'pdf' . ($i + 1) => $lokasi . '/' . $namagam,
                            ]);
                    }
                }
            }
        }
        $dataend = [
            'tgl_ubah_dtt' => $now,
        ];
        $this->db
            ->table('master_pkp')
            ->where('id_pkp', $id_pkp)
            ->update($dataend);
        $this->session->setFlashdata('success', 'Berhasil upload');
        $redirectUrl = previous_url() ?? base_url();
        return redirect()->to($redirectUrl);
    }

    // public function teknistambah()
    // {
    //     $now = date("Y-m-d");
    //     $post = $this->request->getPost();
    //     $id_pkp = $post['id']; // Assuming you get this from POST or GET request
    //     $QN0 = $this->db->query("SELECT * FROM pdf where id_pkp='$id_pkp'");
    //     if ($QN0->getNumRows() > 0) {
    //         $data0 = array(
    //             'tgl_ubah' => $now,
    //             'id_ubah' => $post["id_ubah"],
    //         );
    //         $this->db->table('pdf')->where('id_pkp', $id_pkp)->update($data0);
    //     } else {

    //         $QN = $this->db->query("SELECT max(kode) as masKode FROM pdf order by kode");
    //         foreach ($QN->getResult() as $row) {
    //             $order = $row->masKode;
    //         }
    //         $noUrut = (int) substr($order, 8, 5);
    //         $noUrut++;
    //         //BL masKode//
    //         $bulanL = substr($order, 5, 2);
    //         $bln = substr($now, 5, 2);
    //         $tahun = substr($now, 2, 2);
    //         if ($bln == $bulanL) {
    //             $kode = 'PDF' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
    //         } else {
    //             $kode = 'PDF' . $tahun . $bln . '-' . '00001';
    //         }

    //         $id1 = 'PDF' . md5($kode);
    //         $id2 = 'PDF' . hash("sha1", $id1) . 'QNS';

    //         $array = [
    //             'id' => $id2,
    //             'id_pkp' => $post["id"],
    //             'kode' => $kode,
    //             'tgl_ubah' => $now,
    //             'id_ubah' => $post["id_ubah"],
    //         ];

    //         $this->db->table('pdf')->insert($array);
    //     }
    //     // Retrieve no_pkp and id_instansi from the database
    //     $QN2 = $this->db->query("SELECT * FROM master_pkp where id_pkp='$id_pkp'");
    //     foreach ($QN2->getResult() as $row2) {
    //         $no_pkp = $row2->no_pkp;
    //         $id_instansi = $row2->id_instansi;
    //     }

    //     // Retrieve no_instansi from the database
    //     $QN3 = $this->db->query("SELECT * FROM master_instansi where id='$id_instansi'");
    //     foreach ($QN3->getResult() as $row3) {
    //         $no_instansi = $row3->nomor;
    //     }

    //     // Define the location for storing the uploaded PDF
    //     $lokasi = './assets/pdf/teknis/' . $no_instansi . '/' . $no_pkp;

    //     $teknis = 'teknis';
    //     $fileName = $teknis . $no_pkp . '.pdf'; // Define the file name
    //     // Check if directory exists, if not create it
    //     if (!file_exists($lokasi)) {
    //         mkdir($lokasi, 0777, true);
    //     }

    //     // Delete the old PDF file
    //     $oldFilePath = $lokasi . '/' . $teknis . $no_pkp . '.pdf';
    //     if (file_exists($oldFilePath)) {
    //         unlink($oldFilePath);
    //     }

    //     if ($this->request->getFileMultiple('berkas')) {
    //         $files = $this->request->getFileMultiple('berkas');
    //         $jumlah_berkas = count($this->request->getFileMultiple('berkas'));

    //         // Move the file to the defined location with the defined file name
    //         foreach ($files as $file) {

    //             if ($this->request->getFileMultiple('berkas')) {
    //                 $files = $this->request->getFileMultiple('berkas');
    //                 $jumlah_berkas = count($files);

    //                 for ($i = 0; $i < $jumlah_berkas; $i++) {
    //                     $fileName = $teknis . $i . '.pdf';
    //                     $file = $files[$i];

    //                     if ($file->isValid() && !$file->hasMoved()) {
    //                         $file->move($lokasi, $fileName);
    //                         $namagam = $file->getName();

    //                         // Dynamically update the database based on the current $i
    //                         if ($i == 0) {
    //                             $this->db->table('pdf')->where('id_pkp', $id_pkp)->update(["pdf1" => $lokasi . '/teknis0.pdf']);
    //                         } elseif ($i == 1) {
    //                             $this->db->table('pdf')->where('id_pkp', $id_pkp)->update(["pdf2" => $lokasi . '/teknis1.pdf']);
    //                         } elseif ($i == 2) {
    //                             $this->db->table('pdf')->where('id_pkp', $id_pkp)->update(["pdf3" => $lokasi . '/teknis2.pdf']);
    //                         } elseif ($i >= 3 && $i < 10) {
    //                             $this->db->table('pdf')->where('id_pkp', $id_pkp)->update(["pdf" . ($i + 1) => $lokasi . '/' . $namagam]);
    //                         }

    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     $dataend = [
    //         "tgl_ubah_dtt" => $now,
    //     ];
    //     $this->db->table('master_pkp')->where('id_pkp', $id_pkp)->update($dataend);
    //     $this->session->setFlashdata('success', 'unggah pembaharuan');
    //     $redirectUrl = previous_url() ?? base_url();
    //     return redirect()->to($redirectUrl);
    // }

    public function import_mon_kry($id_pkp)
    {
        $data['kode'] = '02';
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kategori'] = $this->db
            ->table('kategori_user')
            ->get()
            ->getResult();
        $data['golongan'] = $this->db
            ->table('master_golongan')
            ->orderBy('kode2')
            ->get()
            ->getResult();
        $data['proyek'] = $this->db
            ->table('master_pkp a')
            ->select('a.no_pkp, a.id_pkp, a.alias , b.nomor')
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->orderBy('no_pkp')
            ->get()
            ->getResult();

        $data['judul'] =
            '<a href="' .
            base_url() .
            'proyek/edit_6/' .
            $id_pkp .
            '" style="color:white">MON.Karyawan | </a> <a style="color:white">Import</a>';

        $data['total_migrasi'] = $this->db
            ->table('file_migrasi')
            ->select('*')
            ->where('tipe', 'DT_KR')
            ->where('id_pkp', $id_pkp);
        $data['total1'] = $data['total_migrasi']->countAllResults();

        $errABS = 0;
        $errKETabs = 0;
        $errPOS = 0;
        $errMOB1 = 0;
        $errMOB2 = 0;
        $errDEMOB1 = 0;
        $errDEMOB2 = 0;
        $errUJG = 0;
        $errDOBEL = 0;

        $QN = $this->db
            ->table('file_migrasi')
            ->select('*')
            ->where('tipe', 'DT_KR')
            ->where('id_pkp', $id_pkp)
            ->orderBy('kode')
            ->get();
        // $QN = $this->db->table("file_migrasi")->select("*")->where('tipe', 'DT_KR')->where('id_pkp', $id_pkp)->groupBy("ket_1")->orderBy('kode')->get();
        //$QN = $this->db->query("SELECT * FROM file_migrasi where tipe='DT_KR' and id_pkp='$id_pkp' order by kode");
        foreach ($QN->getResult() as $row) {
            if ($row->ket_3 == '') {
                $errABS++;
            }
            if ($row->ket_4 == '') {
                $errABS++;
            }
            if ($row->ket_5 == '') {
                $errABS++;
            }
            if ($row->ket_6 == '') {
                $errABS++;
            }
            if ($row->ket_3 != '' and is_numeric($row->ket_3) != true) {
                $errABS++;
            }
            if ($row->ket_4 != '' and is_numeric($row->ket_4) != true) {
                $errABS++;
            }
            if ($row->ket_5 != '' and is_numeric($row->ket_5) != true) {
                $errABS++;
            }
            if ($row->ket_6 != '' and is_numeric($row->ket_6) != true) {
                $errABS++;
            }

            if (
                $row->ket_3 != '0' and
                is_numeric($row->ket_3) == true and
                $row->ket_7 == ''
            ) {
                $errKETabs++;
            }
            if (
                $row->ket_4 != '0' and
                is_numeric($row->ket_4) == true and
                $row->ket_7 == ''
            ) {
                $errKETabs++;
            }
            if (
                $row->ket_5 != '0' and
                is_numeric($row->ket_5) == true and
                $row->ket_7 == ''
            ) {
                $errKETabs++;
            }
            if (
                $row->ket_6 != '0' and
                is_numeric($row->ket_6) == true and
                $row->ket_7 == ''
            ) {
                $errKETabs++;
            }
            $n1_k7 = substr($row->ket_7, 0, 1);
            if ($n1_k7 == ' ') {
                $errKETabs++;
            }
            if (
                $row->ket_7 != '' and
                $n1_k7 != ' ' and
                $row->ket_3 == '0' and
                $row->ket_4 == '0' and
                $row->ket_5 == '0' and
                $row->ket_6 == '0'
            ) {
                $errKETabs++;
            }
            $n1_k8 = substr($row->ket_8, 0, 1);
            if ($n1_k8 == ' ') {
                $errPOS++;
            }
            if ($row->ket_8 == '') {
                $errPOS++;
            }
            if ($row->tgl_1 == 0) {
                $errMOB1++;
            }
            if ($row->tgl_2 == 0) {
                $errMOB2++;
            }
            if ($row->tgl_3 == 0) {
                $errDEMOB1++;
            }
            if (
                $row->tgl_4 == 0 and
                ($row->ket_10 == 'MUTASI' or $row->ket_10 == 'RESIGN')
            ) {
                $errDEMOB2++;
            }
            if (
                $row->tgl_4 > 0 and
                ($row->ket_10 != 'MUTASI' and $row->ket_10 != 'RESIGN')
            ) {
                $errUJG++;
            }
            if ($row->tgl_4 > 0 and $row->ket_10 == 'TASK FORCE') {
                $errUJG++;
            }
            if ($row->ket_1 != '') {
                $errDOBEL++;
            }
        }

        $data['total2'] =
            $errABS +
            $errKETabs +
            $errPOS +
            $errMOB1 +
            $errMOB2 +
            $errDEMOB1 +
            $errDEMOB2 +
            $errUJG +
            ($data['total1'] - $errDOBEL);
        $data['total3'] = $data['total1'] - $errDOBEL;
        $data['total2a'] = $errABS;
        $data['total2b'] = $errKETabs;
        $data['total2c'] = $errPOS;
        $data['total2d'] = $errMOB1;
        $data['total2e'] = $errMOB2;
        $data['total2f'] = $errDEMOB1;
        $data['total2g'] = $errDEMOB2;
        $data['total2h'] = $errUJG;
        $data['id_pkp'] = $id_pkp;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('proyek/import_mon_kry', $data);
    }

    public function datagd1()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '511')
                ->where('a.no_pkp !=', '000');
        } else {
            if ($isi->username == '10288') {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.nomor', '511')
                    ->where('a.no_pkp !=', '000');
            } else {
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $builder = $this->db
                        ->table('master_pkp a')
                        ->select(
                            'a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                        )
                        ->join('master_instansi b', 'a.id_instansi = b.id')
                        ->where('b.id', $id_divisi)
                        ->where('b.nomor', '511')
                        ->where('a.no_pkp !=', '000');
                } else {
                    $builder = $this->db
                        ->table('master_pkp a')
                        ->select(
                            'a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                        )
                        ->join('master_instansi b', 'a.id_instansi = b.id')
                        ->where('a.id_pkp', $pkp_user)
                        ->where('b.nomor', '511')
                        ->where('a.no_pkp !=', '000');
                }
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = $r->proyek;
            $row[] = $r->alias;
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function datagd2()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '512')
                ->where('a.no_pkp !=', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //WAKADIRAT (DENNIS)
            if ($isi->username == '10288') {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.nomor', '512')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            } else {
                //DIVISI
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $builder = $this->db
                        ->table('master_pkp a')
                        ->select(
                            'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                        )
                        ->join('master_instansi b', 'a.id_instansi = b.id')
                        ->where('b.id', $id_divisi)
                        ->where('b.nomor', '512')
                        ->where('a.no_pkp !=', '000')
                        ->orderBy('a.no_pkp', 'ASC');
                } else {
                    //PROYEK
                    $builder = $this->db
                        ->table('master_pkp a')
                        ->select(
                            'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                        )
                        ->join('master_instansi b', 'a.id_instansi = b.id')
                        ->where('a.id_pkp', $pkp_user)
                        ->where('b.nomor', '512')
                        ->where('a.no_pkp !=', '000')
                        ->orderBy('a.no_pkp', 'ASC');
                }
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');

        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function datagd3()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '613')
                ->where('a.no_pkp !=', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //WAKADIRAT (DENNIS)
            if ($isi->username == '10288') {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.nomor', '613')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            } else {
                //DIVISI
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    $builder = $this->db
                        ->table('master_pkp a')
                        ->select(
                            'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                        )
                        ->join('master_instansi b', 'a.id_instansi = b.id')
                        ->where('b.id', $id_divisi)
                        ->where('b.nomor', '613')
                        ->where('a.no_pkp !=', '000')
                        ->orderBy('a.no_pkp', 'ASC');
                } else {
                    //PROYEK
                    $builder = $this->db
                        ->table('master_pkp a')
                        ->select(
                            'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                        )
                        ->join('master_instansi b', 'a.id_instansi = b.id')
                        ->where('a.id_pkp', $pkp_user)
                        ->where('b.nomor', '613')
                        ->where('a.no_pkp !=', '000')
                        ->orderBy('a.no_pkp', 'ASC');
                }
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function dataktl()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '611')
                ->where('a.no_pkp !=', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.id', $id_divisi)
                    ->where('b.nomor', '611')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            } else {
                //PROYEK
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('a.id_pkp', $pkp_user)
                    ->where('b.nomor', '611')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function dataktl2()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '612')
                ->where('a.no_pkp !=', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.id', $id_divisi)
                    ->where('b.nomor', '612')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            } else {
                //PROYEK
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('a.id_pkp', $pkp_user)
                    ->where('b.nomor', '612')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }
    public function datatrans()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '711')
                ->where('a.no_pkp !=', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.id', $id_divisi)
                    ->where('b.nomor', '711')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            } else {
                //PROYEK
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('a.id_pkp', $pkp_user)
                    ->where('b.nomor', '711')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function datatrans2()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('b.nomor', '712')
                ->where('a.no_pkp !=', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('b.id', $id_divisi)
                    ->where('b.nomor', '712')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            } else {
                //PROYEK
                $builder = $this->db
                    ->table('master_pkp a')
                    ->select(
                        'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                    )
                    ->join('master_instansi b', 'a.id_instansi = b.id')
                    ->where('a.id_pkp', $pkp_user)
                    ->where('b.nomor', '712')
                    ->where('a.no_pkp !=', '000')
                    ->orderBy('a.no_pkp', 'ASC');
            }
        }
        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function datakantor()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('a.no_pkp', '000')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //PROYEK
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('a.no_pkp', '000')
                ->where('a.id_instansi', $id_divisi)
                ->orderBy('a.no_pkp', 'ASC');
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function datasemua()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = $isi->pkp_user;

        if ($pkp_user != '') {
            $divisi = $this->db
                ->table('master_pkp')
                ->getWhere(['id_pkp' => $pkp_user])
                ->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->orderBy('a.no_pkp', 'ASC');
        } else {
            //PROYEK
            $builder = $this->db
                ->table('master_pkp a')
                ->select(
                    'a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama'
                )
                ->join('master_instansi b', 'a.id_instansi = b.id')
                ->where('a.id_instansi', $id_divisi)
                ->orderBy('a.no_pkp', 'ASC');
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder
                ->groupStart()
                ->like('a.id_pkp', $searchValue)
                ->orLike('a.proyek', $searchValue)
                ->orLike('a.alias', $searchValue)
                ->groupEnd();
        }
        // Sorting
        if (
            isset($requestData['order']) &&
            is_array($requestData['order']) &&
            count($requestData['order']) > 0
        ) {
            $columnIndex = $requestData['order'][0]['column'];
            $columnName = $requestData['columns'][$columnIndex]['data'];
            $columnSortOrder = $requestData['order'][0]['dir'];

            // Mapping nama kolom dari DataTables ke nama kolom dalam tabel database jika diperlukan
            $columnMap = [
                0 => 'a.no_pkp', // Kolom pertama tidak diurutkan
                1 => 'a.proyek', // Kolom tanggal
                2 => 'a.alias', // Kolom kode dokumen
            ];

            // Periksa apakah indeks kolom ditemukan dalam map
            if (
                array_key_exists($columnIndex, $columnMap) &&
                $columnMap[$columnIndex] !== null
            ) {
                // Jika ditemukan, gunakan nama kolom yang sesuai
                $columnName = $columnMap[$columnIndex];
            }

            // Jika nama kolom ditemukan, lakukan pengurutan
            if ($columnName !== null) {
                $builder->orderBy($columnName, $columnSortOrder);
            }
        }

        $builder->orderBy('a.no_pkp', 'ASC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = [];
        foreach ($list as $r) {
            $proyek = '';
            if (
                $r->tgl_ubah_progress == '0000-00-00' or
                $r->tgl_ubah_progress == '0001-11-30'
            ) {
                $proyek =
                    '<strong><center><a class="text-dark">' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            } else {
                $proyek =
                    '<strong><center><a href="' .
                    base_url() .
                    'proyek/edit_1/' .
                    $r->id_pkp .
                    '" > ' .
                    $r->nomor .
                    '/' .
                    $r->no_pkp .
                    '</a></strong>';
            }

            $row = [];
            $row[] = $proyek;
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }

    public function validasi_kapro1()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_pkp' => $post['id_pkp'],
            'validasi' => $post['validasi'],
        ];
        $id_pkp = $post['id_pkp'];
        $validasi = $post['validasi'];
        if ($validasi == 'OK') {
            $val = 'Berhasil Memvalidasi Progress Baru';
        } else {
            $val = 'Data Progress dikembalikan ke data sebelumnya';
        }
        $simpan = $this->proyek;
        if ($simpan->simpanvalidasi_kapro1($postData)) {
            $data['success'] = true;
            $data['message'] = $val;
        } else {
            $errors['fail'] = 'gagal melakukan validasi data';
            $data['errors'] = $errors;
        }
        $data['id_pkp'] = $id_pkp;
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function upd_data_spk()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_pkp' => $post['id_pkp'],
            'tgl_mulai' => $post['tgl_mulai'],
            'tgl_selesai' => $post['tgl_selesai'],
            'warning' => $post['warning'],
            'late' => $post['late'],
        ];
        $id_pkp = $post['id_pkp'];
        $simpan = new ProyekModel();
        if ($simpan->simpantglspk($postData)) {
            $data['success'] = true;
            $data['message'] = 'Berhasil menyimpan tgl close';
        } else {
            $errors['fail'] = 'gagal melakukan update data';
            $data['errors'] = $errors;
        }
        $data['id_pkp'] = $id_pkp;
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function upl_progress()
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

        $arraysub = [];
        if ($aksi['result'] == 'success') {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet
                ->getActiveSheet()
                ->toArray(null, true, true, true);
            $data = [];
            $baris = 1;

            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d');

            $post = $this->request->getPost();
            $id_pkp = $post['id_pkp'];
            $id_ubah = $post['id_ubah'];
            $bln2 = substr($now, 5, 2);
            $tahun2 = substr($now, 2, 2);

            //UPDATE PKP
            $data5 = [
                'tgl_ubah_progress' => $now,
            ];
            $this->db
                ->table('master_pkp')
                ->where('id_pkp', $id_pkp)
                ->update($data5);

            $no = -1;
            $QN = $this->db->query(
                'SELECT max(kode) as masKode FROM progress_paket order by kode'
            );
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
                $kode = 'PPK' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
            } else {
                $kode = 'PPK' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'PPK' . md5($kode);
            $id2 = 'PPK' . hash('sha1', $id1) . 'QNS';

            foreach ($sheetData as $row) {
                if ($baris == 3) {
                    //ambil bulan
                    //cek data
                    $bulan22 = $row['C'];
                }
                if ($baris == 4) {
                    //ambil tahun

                    $tahun22 = substr($row['C'], 2, 2);

                    //UBAH akhiran A
                    $dataend = [
                        'akhir' => '',
                    ];
                    $this->db
                        ->table('progress_proyek')
                        ->where('akhir', 'A')
                        ->where('id_pkp', $id_pkp)
                        ->update($dataend);

                    //UBAH validasi kapro1 PKP
                    $dataend2 = [
                        'validasi_kapro' => 0,
                    ];

                    $this->db
                        ->table('master_pkp')
                        ->where('id_pkp', $id_pkp)
                        ->update($dataend2);
                    //TAMBAH PROGRESS PROYEK
                    $QN1 = $this->db->query(
                        'SELECT max(kode) as masKode1 FROM progress_proyek order by kode'
                    );
                    foreach ($QN1->getResult() as $row1) {
                        $order1 = $row1->masKode1;
                    }
                    $noUrut1 = (int) substr($order1, 8, 5);
                    $noUrut1++;
                    //BL masKode//
                    $bulanL1 = substr($order1, 5, 2);
                    $bln1 = substr($now, 5, 2);
                    $tahun1 = substr($now, 2, 2);
                    if ($bln1 == $bulanL1) {
                        $kode1 =
                            'PPY' .
                            $tahun1 .
                            $bln1 .
                            '-' .
                            sprintf('%05s', $noUrut1);
                    } else {
                        $kode1 = 'PPY' . $tahun1 . $bln1 . '-' . '00001';
                    }
                    $id11 = 'PPY' . md5($kode1);
                    $id21 = 'PPY' . hash('sha1', $id11) . 'QNS';

                    $data1 = [
                        'id' => $id21,
                        'id_pkp' => $id_pkp,
                        'kode' => $kode1,
                        'tgl_ubah_progress' => $now,
                        'tahun' => $tahun22,
                        'bulan' => $bulan22,
                        'id_ubah' => $id_ubah,
                        'akhir' => 'A',
                    ];
                    $this->db->table('progress_proyek')->insert($data1);
                    //Hapus Progress paket di bulan yang sama
                }

                if ($baris > 6) {
                    if ($row['R'] > 0 and $row['L'] < 100) {
                        $selisih2 =
                            abs(strtotime($row['R']) - strtotime($now)) / 86400;
                        if (strtotime($row['R']) < strtotime($now)) {
                            $selisih = -1 * $selisih2;
                        } else {
                            $selisih = $selisih2;
                        }
                    } else {
                        if ($row['O'] > 0 and $row['L'] < 100) {
                            $selisih2 =
                                abs(strtotime($row['O']) - strtotime($now)) /
                                86400;
                            if (strtotime($row['O']) < strtotime($now)) {
                                $selisih = -1 * $selisih2;
                            } else {
                                $selisih = $selisih2;
                            }
                        } else {
                            $selisih = 0;
                        }
                    }

                    $sisa = 100 - $row['L'];

                    if ($row['O'] > 0 and $row['P'] == '0') {
                        if ($selisih < 30) {
                            $target = 100 - $row['L'];
                        } else {
                            $target = (100 - $row['L']) / ($selisih / 30);
                        }
                    } else {
                        $target = $row['P'];
                    }

                    array_push($data, [
                        'id' => $id2,
                        'id_pkp' => $id_pkp,
                        'progress_proyek' => $id21,
                        'nomor' => $no,
                        'kode' => $kode,
                        'kode_pt' => $row['C'],
                        'paket' => $row['B'],
                        'tahun' => $tahun22,
                        'bulan' => $bulan22,
                        'tgl_mulai' => $row['N'],
                        'tgl_selesai' => $row['O'],
                        'bobot_pg' => $row['D'], //Bobot isi manual

                        //---- INPUTAN PROGRESS ----//
                        'rensd_mgll' => $row['E'],
                        'rilsd_mgll' => $row['F'],
                        'devsd_mgll' => $row['G'],

                        'ren_mgini' => $row['H'],
                        'ril_mgini' => $row['I'],
                        'dev_mgini' => $row['J'],

                        'rensd_mgini' => $row['K'],
                        'rilsd_mgini' => $row['L'],
                        'devsd_mgini' => $row['M'],
                        //--------------------------//
                        'sisa_bobotpg' => $sisa,

                        'sisa_waktu' => $selisih,
                        'target_minggu' => $target,

                        'tgl_sadd' => $row['Q'],
                        'tgl_fadd' => $row['R'],
                        'tgl_rf' => $row['S'],
                        'keterangan' => $row['T'],
                    ]);
                }
                $baris++;
                $noUrut++;
                $no++;
                $kode =
                    'PPK' . $tahun2 . $bln2 . '-' . sprintf('%05s', $noUrut);
                $id1 = 'PPK' . md5($kode);
                $id2 = 'PPK' . hash('sha1', $id1) . 'QNS';
            }

            if ($this->proyek->input_semua3m($data)) {
                $data['success'] = true;
                $data['message'] = 'Upload Progress sukses';
            } else {
                $errors['fail'] =
                    'gagal mengupload semua data, pastikan format upload';
                $data['errors'] = $errors;
            }
        } else {
            $errors['fail'] = $aksi['error'];
            $data['errors'] = $errors;
        }
        //RAHAZIA BULAN NGAWUR
        $SY01 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$id_pkp' and bulan!='01' and bulan!='02' and bulan!='03' and bulan!='04' and bulan!='05' and bulan!='06' and bulan!='06' and bulan!='07' and bulan!='08' and bulan!='09' and bulan!='10' and bulan!='11' and bulan!='12' "
        );
        if ($SY01->getNumRows() > 0) {
            $this->db
                ->table('progress_paket')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun22)
                ->where('bulan !=', '01')
                ->where('bulan !=', '02')
                ->where('bulan !=', '03')
                ->where('bulan !=', '04')
                ->where('bulan !=', '05')
                ->where('bulan !=', '06')
                ->where('bulan !=', '07')
                ->where('bulan !=', '08')
                ->where('bulan !=', '09')
                ->where('bulan !=', '10')
                ->where('bulan !=', '11')
                ->where('bulan !=', '12')
                ->delete();
        }
        $SY01a = $this->db->query(
            "SELECT * FROM progress_proyek where id_pkp='$id_pkp' and bulan!='01' and bulan!='02' and bulan!='03' and bulan!='04' and bulan!='05' and bulan!='06' and bulan!='06' and bulan!='07' and bulan!='08' and bulan!='09' and bulan!='10' and bulan!='11' and bulan!='12' "
        );
        if ($SY01a->getNumRows() > 0) {
            $this->db
                ->table('progress_proyek')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun22)
                ->where('bulan !=', '01')
                ->where('bulan !=', '02')
                ->where('bulan !=', '03')
                ->where('bulan !=', '04')
                ->where('bulan !=', '05')
                ->where('bulan !=', '06')
                ->where('bulan !=', '07')
                ->where('bulan !=', '08')
                ->where('bulan !=', '09')
                ->where('bulan !=', '10')
                ->where('bulan !=', '11')
                ->where('bulan !=', '12')
                ->delete();
        }
        //RAHAZIA TAHUN NGAWUR
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d');
        $tahun_terawang = date(
            'Y-m-d',
            strtotime('-365 days', strtotime($now))
        );
        $batas_tahun1 = substr($now, 2, 2);
        $batas_tahun2 = substr($tahun_terawang, 2, 2);
        $SY02 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$id_pkp' and tahun!='$batas_tahun1' and tahun!='$batas_tahun2' "
        );
        if ($SY02->getNumRows() > 0) {
            $this->db
                ->table('progress_paket')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun22)
                ->where('tahun !=', $batas_tahun1)
                ->where('tahun !=', $batas_tahun2)
                ->delete();
        }
        $SY02a = $this->db->query(
            "SELECT * FROM progress_proyek where id_pkp='$id_pkp' and tahun!='$batas_tahun1' and tahun!='$batas_tahun2' "
        );
        if ($SY02a->getNumRows() > 0) {
            $this->db
                ->table('progress_proyek')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun22)
                ->where('tahun !=', $batas_tahun1)
                ->where('tahun !=', $batas_tahun2)
                ->delete();
        }

        //RAHAZIA JIKA PAKET SUDAH DI VALIDASI
        //HAPUS PROGRESS PROYEK
        /*
        $QN0 = $this->db->query("SELECT * FROM progress_proyek where id_pkp='$id_pkp' and tahun='$tahun22' and bulan='$bulan22' and validasi_kapro > 0");
        if ($QN0->getNumRows() > 0) {
            $this->db->where('id_pkp', $id_pkp)->where('tahun', $tahun22)->where('bulan', $bulan22)->where('validasi_kapro', null)
                ->or_where('id_pkp', $id_pkp)->where('tahun', $tahun22)->where('bulan', $bulan22)->where('validasi_kapro <', 1);
            $this->db->delete('progress_proyek');
        }
        //HAPUS PROGRESS PAKET
        $QN0 = $this->db->query("SELECT * FROM progress_paket where id_pkp='$id_pkp' and tahun='$tahun22' and bulan='$bulan22' and validasi_kapro > 0");
        if ($QN0->getNumRows() > 0) {
            $this->db->where('id_pkp', $id_pkp)->where('tahun', $tahun22)->where('bulan', $bulan22)->where('validasi_kapro', null)
                ->or_where('id_pkp', $id_pkp)->where('tahun', $tahun22)->where('bulan', $bulan22)->where('validasi_kapro <', 1);
            $this->db->delete('progress_paket');
        }

*/
        //UPDATE TERAKHIR UNTUK Progres proyek
        //AMBIL DATA DARI PAKET TOTAL
        $QN5 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$id_pkp' and tahun='$tahun22' and bulan='$bulan22' and devsd_mgini < 0 and paket !='TOTAL' "
        );
        $alert = 0;
        if ($QN5->getNumRows() > 0) {
            foreach ($QN5->getResult() as $row5) {
                $alert++;
                $bulan33 = $row5->bulan;
            }
        }
        $QN4 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$id_pkp' and tahun='$tahun22' and bulan='$bulan22' and paket='TOTAL'"
        );
        if ($QN4->getNumRows() > 0) {
            foreach ($QN4->getResult() as $row4) {
                $p_bobot_pg = $row4->bobot_pg;
                $p_rensd_mgll = $row4->rensd_mgll;
                $p_rilsd_mgll = $row4->rilsd_mgll;
                $p_devsd_mgll = $row4->devsd_mgll;
                $p_ren_mgini = $row4->ren_mgini;
                $p_ril_mgini = $row4->ril_mgini;
                $p_dev_mgini = $row4->dev_mgini;
                $p_rensd_mgini = $row4->rensd_mgini;
                $p_rilsd_mgini = $row4->rilsd_mgini;
                $p_devsd_mgini = $row4->devsd_mgini;
                $p_sisa_bobotpg = $row4->sisa_bobotpg;
            }
            $data4 = [
                'bobot_pg' => $p_bobot_pg,
                'rensd_mgll' => $p_rensd_mgll,
                'rilsd_mgll' => $p_rilsd_mgll,
                'devsd_mgll' => $p_devsd_mgll,
                'ren_mgini' => $p_ren_mgini,
                'ril_mgini' => $p_ril_mgini,
                'dev_mgini' => $p_dev_mgini,
                'rensd_mgini' => $p_rensd_mgini,
                'rilsd_mgini' => $p_rilsd_mgini,
                'devsd_mgini' => $p_devsd_mgini,
                'sisa_bobotpg' => $p_sisa_bobotpg,
                'alert' => $alert,
            ];
            $this->db
                ->table('progress_proyek')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun22)
                ->where('bulan', $bulan22)
                ->update($data4);
        }
        //hapus data paket total
        $QN2 = $this->db->query(
            "SELECT * FROM progress_paket where id_pkp='$id_pkp' and bulan='$bulan22' and tahun='$tahun22' and paket='TOTAL'"
        );
        if ($QN2->getNumRows() > 0) {
            $this->db
                ->table('progress_paket')
                ->where('id_pkp', $id_pkp)
                ->where('tahun', $tahun22)
                ->where('bulan', $bulan22)
                ->where('paket', 'TOTAL')
                ->delete();
        }

        $data['id_pkp'] = $id_pkp;
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function upload_mon_1()
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
        $arraysub = [];
        if ($aksi['result'] == 'success') {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet
                ->getActiveSheet()
                ->toArray(null, true, true, true);
            $data = [];
            $baris = 1;
            //THBL TGL BERJALAN//
            date_default_timezone_set('Asia/Jakarta');
            $now = date('Y-m-d');
            //ambil no urut terakhir//
            //INSTHBL-12345//
            $QN = $this->db->query(
                'SELECT max(kode) as masKode FROM file_migrasi order by kode'
            );
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
                $kode = 'MIG' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
            } else {
                $kode = 'MIG' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'MIG' . md5($kode);
            $id2 = 'MIG' . hash('sha1', $id1) . 'QNS';

            $post = $this->request->getPost();
            $id_pkp = $post['id_pkp58'];

            foreach ($sheetData as $row) {
                if ($baris > 6) {
                    array_push($data, [
                        'id' => $id2,
                        'kode' => $kode,
                        'tipe' => 'DT_KR',
                        'id_pkp' => $id_pkp,
                        'ket_1' => $row['C'],
                        'ket_2' => $row['D'],
                        'ket_3' => $row['E'], //absensi
                        'ket_4' => $row['F'],
                        'ket_5' => $row['G'],
                        'ket_6' => $row['H'], //end absensi
                        'ket_7' => $row['I'], //KET absensi
                        'ket_8' => $row['K'], //posisi
                        'tgl_1' => $row['N'], //tgl mob
                        'tgl_2' => $row['O'],
                        'tgl_3' => $row['P'], //tgl demob
                        'tgl_4' => $row['Q'],
                        'ket_9' => $row['S'], //ket demob
                        'ket_10' => $row['T'], //mutasi/resign/tf
                    ]);
                }
                $baris++;
                $noUrut++;
                $kode = 'MIG' . $tahun . $bln . '-' . sprintf('%05s', $noUrut);
                $id1 = 'MIG' . md5($kode);
                $id2 = 'MIG' . hash('sha1', $id1) . 'QNS';
            }
            if ($this->proyek->input_semua3mm($data)) {
                $data['success'] = true;
                $data['message'] =
                    'Data berhasil di import, cek kembali data anda sebelum di proses';
            } else {
                $errors['fail'] =
                    'gagal mengupload semua data, pastikan format upload';
                $data['errors'] = $errors;
            }
        } else {
            $errors['fail'] = $aksi['error'];
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function dataimportmon1()
    {
        $idQNS = session('idadmin');
        $isi = $this->db
            ->table('master_admin')
            ->where('id', $idQNS, 1)
            ->get()
            ->getRow();
        $pkp_user = $isi->pkp_user;
        $list = $this->proyek->getAbsensi($pkp_user);
        $data = [];
        $no = 1;
        foreach ($list as $r) {
            //GAYA
            $karyawan = $this->db
                ->table('master_admin')
                ->where('username', $r->ket_1)
                ->get();
            if ($karyawan->getNumRows() > 0) {
                $karyawan = $this->db
                    ->table('master_admin')
                    ->where('username', $r->ket_1)
                    ->get()
                    ->getRow();
                $sisa_cuti = $karyawan->sisa_cuti;
            } else {
                $sisa_cuti = 0;
            }
            $normal = '<div style="text-align:center;">';
            $gaya_merah =
                '<div style="text-align:center;color:red;"><i class="fa fa-exclamation-triangle fa-2x"></i>';
            $gaya_kuning =
                '<div style="text-align:center;background-color:yellow;color:black;">';
            $gaya_ungu =
                '<div style="text-align:center;background-color:purple;color:white;">';
            $tutup = '</div>';
            if (esc($r->tgl_1) > 0) {
                $tgl_1 = esc($r->tgl_1);
            } else {
                $tgl_1 = '';
            }
            if (esc($r->tgl_2) > 0) {
                $tgl_2 = esc($r->tgl_2);
            } else {
                $tgl_2 = '';
            }
            if (esc($r->tgl_3) > 0) {
                $tgl_3 = esc($r->tgl_3);
            } else {
                $tgl_3 = '';
            }
            if (esc($r->tgl_4) > 0) {
                $tgl_4 = esc($r->tgl_4);
            } else {
                $tgl_4 = '';
            }

            $row = [];
            $row[] = $no;
            $row[] = $r->ket_1;
            $row[] = $r->ket_2;
            if (is_numeric(esc($r->ket_3)) != true) {
                $row[] = $gaya_kuning . '_' . $tutup;
            } else {
                if (esc($r->ket_3) == '') {
                    $row[] = $gaya_merah . $tutup;
                } else {
                    $row[] = $normal . esc($r->ket_3) . $tutup;
                }
            }
            if (is_numeric(esc($r->ket_4)) != true) {
                $row[] = $gaya_kuning . '_' . $tutup;
            } else {
                if (esc($r->ket_4) == '') {
                    $row[] = $gaya_merah . $tutup;
                } else {
                    $row[] = $normal . esc($r->ket_4) . $tutup;
                }
            }
            if (is_numeric(esc($r->ket_5)) != true) {
                $row[] = $gaya_kuning . '_' . $tutup;
            } else {
                if (esc($r->ket_5) == '') {
                    $row[] = $gaya_merah . $tutup;
                } else {
                    $row[] = $normal . esc($r->ket_5) . $tutup;
                }
            }
            if (is_numeric(esc($r->ket_6)) != true) {
                $row[] = $gaya_kuning . '_' . $tutup;
            } else {
                if (esc($r->ket_6) == '') {
                    $row[] = $gaya_merah . $tutup;
                } else {
                    $row[] = $normal . esc($r->ket_6) . $tutup;
                }
            }
            $row[] = $sisa_cuti;
            $n1_k7 = substr($r->ket_7, 0, 1);
            if (
                $r->ket_7 == '' and
                (is_numeric($r->ket_3) == true or
                    is_numeric($r->ket_4) == true or
                    is_numeric($r->ket_5) == true or
                    is_numeric($r->ket_6) == true) and
                ($r->ket_3 != 0 or
                    $r->ket_4 != 0 or
                    $r->ket_5 != 0 or
                    $r->ket_6 != 0)
            ) {
                $row[] = $gaya_merah . $tutup;
            } else {
                if ($n1_k7 == ' ') {
                    $row[] = $gaya_kuning . '_' . $tutup;
                } else {
                    if (
                        $n1_k7 != ' ' and
                        $r->ket_7 != '' and
                        ($r->ket_3 == 0 and
                            $r->ket_4 == 0 and
                            $r->ket_5 == 0 and
                            $r->ket_6 == 0)
                    ) {
                        $row[] = $gaya_kuning . esc($r->ket_7) . $tutup;
                    } else {
                        $row[] = $normal . esc($r->ket_7) . $tutup;
                    }
                }
            }
            $n1_k8 = substr($r->ket_8, 0, 1);
            if ($n1_k8 == ' ') {
                $row[] = $gaya_kuning . '_' . $tutup;
            } else {
                if (esc($r->ket_8) != '') {
                    $row[] = $normal . esc($r->ket_8) . $tutup;
                } else {
                    $row[] = $gaya_merah . $tutup;
                }
            }
            if (esc($r->tgl_1) > 0) {
                $row[] = $normal . $tgl_1 . $tutup;
            } else {
                $row[] = $gaya_merah . $tutup;
            }
            if (esc($r->tgl_2) > 0) {
                $row[] = $normal . $tgl_2 . $tutup;
            } else {
                $row[] = $gaya_merah . $tutup;
            }
            if (esc($r->tgl_3) > 0) {
                $row[] = $normal . $tgl_3 . $tutup;
            } else {
                $row[] = $gaya_merah . $tutup;
            }
            if (
                (esc($r->ket_10) == 'MUTASI' or esc($r->ket_10) == 'RESIGN') and
                esc($r->tgl_4) == 0
            ) {
                $row[] = $gaya_merah . $tutup;
            } else {
                $row[] = $normal . $tgl_4 . $tutup;
            }
            $row[] = $r->ket_9;
            if (
                esc($r->ket_10) != '' and
                (esc($r->ket_10) != 'MUTASI' and
                    esc($r->ket_10) != 'RESIGN' and
                    esc($r->ket_10) != 'TASK FORCE')
            ) {
                $row[] = $gaya_kuning . esc($r->ket_10) . $tutup;
            } else {
                if (esc($r->tgl_4) > 0 and esc($r->ket_10) == '') {
                    $row[] = $gaya_merah . $tutup;
                } else {
                    if (
                        esc($r->tgl_4) > 0 and
                        esc($r->ket_10) == 'TASK FORCE'
                    ) {
                        $row[] = $gaya_ungu . esc($r->ket_10) . $tutup;
                    } else {
                        $row[] = $normal . esc($r->ket_10) . $tutup;
                    }
                }
            }
            $data[] = $row;
            $no++;
        }
        $result = [
            'draw' => $this->request->getVar('draw'),
            'recordsTotal' => $this->proyek->count_all_datatable_import(),
            'recordsFiltered' => $this->proyek->count_filtered_datatable_import(
                $pkp_user
            ),
            'data' => $data,
        ];
        return $this->response->setJSON($result);
    }

    public function hapus_mon_1()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_pkp58' => $post['id_pkp58'],
        ];
        $hapus = new ProyekModel();
        if ($hapus->hapusdatamon_1($postData)) {
            $data['success'] = true;
            $data['message'] = 'Berhasil menghapus data';
        } else {
            $errors['fail'] = 'gagal menghapus data';
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }
    public function proses_mon_1()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_pkp58' => $post['id_pkp58'],
        ];
        $hapus = new ProyekModel();
        if ($hapus->simpandatamon_1($postData)) {
            $data['success'] = true;
            $data['message'] = 'Berhasil menambah data';
        } else {
            $errors['fail'] = 'gagal menyimpan data';
            $data['errors'] = $errors;
        }

        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function editmarketing()
    {
        $post = $this->request->getPost();
        $postData = [
            'id_pkp0' => $post['id_pkp0'],
            'alias' => $post['alias'],
            'alias0' => $post['alias0'],
            'proyek' => $post['proyek'],
            'proyek0' => $post['proyek0'],
            'tgl_mulai' => $post['tgl_mulai'],
            'tgl_selesai' => $post['tgl_selesai'],
            'tgl_jaminan' => $post['tgl_jaminan'],
            'nilai_jaminan' => $post['nilai_jaminan'],
            'bast_1' => $post['bast_1'],
            'bast_2' => $post['bast_2'],
            'referensi' => $post['referensi'],
        ];
        $simpan = new ProyekModel();
        if ($simpan->cekaliaspkp($postData) > 0) {
            $errors['fail'] = 'Data ini (nama alias) sudah ada...';
            $data['errors'] = $errors;
        } else {
            if ($simpan->ceknamakontrakpkp($postData) > 0) {
                $errors['fail'] = 'Data ini (nama kontrak) sudah ada...';
                $data['errors'] = $errors;
            } else {
                if ($simpan->simpandataeditmarketing($postData)) {
                    $data['success'] = true;
                    $data['message'] = 'Berhasil menyimpan data';
                } else {
                    $errors['fail'] = 'gagal melakukan update data';
                    $data['errors'] = $errors;
                }
            }
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function tambahaddendum()
    {
        $post = $this->request->getPost();
        $postData = [
            'tgl_mulai' => $post['tgl_mulai'],
            'tgl_selesai' => $post['tgl_selesai'],
            'tgl_jaminan' => $post['tgl_jaminan'],
            'id_pkp0' => $post['id_pkp0'],
            'keterangan' => $post['keterangan'],
            'nilai_jaminan' => $post['nilai_jaminan'],
            'bast_1' => $post['bast_1'],
            'bast_2' => $post['bast_2'],
            'referensi' => $post['referensi'],
        ];
        $simpan = new ProyekModel();
        if ($simpan->simpandataaddendum($postData)) {
            $data['success'] = true;
            $data['message'] = 'Berhasil menyimpan data';
        } else {
            $errors['fail'] = 'gagal melakukan update data';
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }
}
