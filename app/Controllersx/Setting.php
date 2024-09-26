<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Models\UserModel;
use Config\Services;


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;

class Setting extends BaseController
{

    public function __construct()
    {
        $this->setting = new SettingModel();
        $this->user = new UserModel();
        helper(['string', 'security', 'form', 'esc', 'rupiah']);
    }

    public function index()
    {
        $data['kode'] = '04';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $data['kategoriQNS'] = $kategoriQNS;
        if (!level_user('setting', 'index', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        // Mengambil total baris dari tabel master_instansi
        $data['total_instansi'] = $this->db->table('master_instansi')->countAllResults();

        // Mengambil total baris dari tabel master_pkp
        $data['total_pkp'] = $this->db->table('master_pkp')->countAllResults();

        $data['judul'] = 'SETTING';
        $data['kategori'] = $kategoriQNS;
        $data['kategoris'] = $this->db->table('kategori_user')->get()->getResult();
        $data['golongan'] = $this->setting->getGolongan();
        $data['proyek'] = $this->setting->getProyekPKP();
        return view('setting/index', $data);
    }

    public function pkp()
    {
        $data['kode'] = '04';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $pkp_user = $isi->pkp_user;
        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        if (!level_user('setting', 'pkp', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        if (level_user('setting', 'pkp', $kategoriQNS, 'all') > 0) {
            $data['instansi'] = $this->db->table('master_instansi')->get()->getResult();
        } else {
            $data['instansi'] = $this->db->table('master_instansi')->where('id', $id_divisi)->get()->getResult();
        }

        $data['judul'] = '<a href="' . base_url() . 'setting" style="color:black">SETTING | </a> <a style="color:red">PKP</a>';
        $data['pkp'] = $this->setting->getPKP();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('setting/pkp', $data);
    }

    public function instansi()
    {
        $data['kode'] = '04';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $data['kategoriQNS'] = $kategoriQNS;
        if (!level_user('setting', 'instansi', $kategoriQNS, 'index') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['kadirat'] = $this->db->table('master_admin')->get()->getResult();
        $data['judul'] = '<a href="' . base_url() . 'setting" style="color:black">SETTING | </a> <a style="color:red">INSTANSI</a>';
        $data['instansi'] = $this->setting->getInstansi();
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('setting/instansi', $data);
    }

    public function user()
    {
        $data['kode'] = '04';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('setting', 'user', $kategoriQNS, 'read') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        //ambil id_proyek admin proyek 
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

        $data['kategoris'] = $this->db->table('kategori_user')->get()->getResult();
        $data['golongan'] = $this->setting->getGolongan();
        $data['proyek'] = $this->setting->getProyekPKP();
        $data['judul'] = 'USER';

        //ALL
        if (level_user('setting', 'user', $kategoriQNS, 'all') > 0) {
            $data['user'] = $this->user->allUser();
        } else {
            //divisi
            if (level_user('setting', 'user', $kategoriQNS, 'divisi') > 0) {
                $data['user'] = $this->user->allDivisi($id_divisi);
            } else {
                //proyek
                $data['user'] = $this->user->allProyek($pkp_user);
            }
        }
        $data['pkp_user'] = $pkp_user;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('setting/user', $data);
    }
    public function edituser($id)
    {
        $data['kode'] = '04';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        if (!level_user('setting', 'user', $kategoriQNS, 'edit') > 0) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data['user2'] = $this->db->table('master_admin')->getWhere(['id' => $id], 1);
        $pkp_A = $data['user2']->getRow()->pkp_akhir;

        $data['user4'] = $this->db->table("pkp_user a")->select("d.kategori_user,b.alias, b.no_pkp, b.proyek, c.nomor, a.id, a.status, a.tgl_mutasi")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->join('kategori_user d', 'a.id_jabatan = d.id')->where('a.id_user', $id)->where('a.status', 'AKTIF')->orderBy('a.tgl_mutasi', 'DESC')->get();

        $data['user5'] = $this->db->table("master_pkp")->select("*")->where('id_pkp', $pkp_A)->get();

        $data['kategoris'] = $this->db->table('kategori_user')->get()->getResult();
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

        $data['pkpuser2'] = $this->db->table('pkp_user')->getWhere(['id_user' => $id])->getResult();
        $data['jabatan'] = $this->db->table("kategori_user")->select("*")->get()->getResult();
        $data['judul'] = '<a href="' . base_url() . 'setting" style="color:black">SETTING | </a> <a href="' . base_url() . 'setting/user" style="color:black">USER | </a> <a style="color:red">EDIT</a>';
        $data['kategoriQNS'] = $kategoriQNS;
        $data['kategori'] = $kategoriQNS;
        return view('setting/edit-user', $data);
    }


    public function useredit()
    {
        $simpan = $this->setting;
        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'username' => $post['username'],
            'nama_admin' => $post['nama_admin'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            'alamat' => $post['alamat'],
            'handphone' => $post['handphone'],
            'email' => $post['email'],
            'aktif' => $post['aktif'],
            'pkp_akhir' => $post['pkp_akhir'],
            'password' => $post['password'],
            'passlama' => $post['passlama']
        ];
        if ($simpan->updatedatauser($postData)) {
            $this->session->setFlashdata('success', 'berhasil menyimpan data');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'gagal menyimpan data');
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['token'] = csrf_token();
        return redirect()->to($redirectUrl);
    }

    public function pkpdetail2($idd)
    {
        $query = $this->setting->get_pkp($idd);
        foreach ($query as $pkp_data) {
            $instansi = ($pkp_data['nomor']);
            $pkp = ($pkp_data['no_pkp']);
            $nomor_pkp = $instansi . '/' . $pkp;
            $result = array(

                "proyek" => ($pkp_data['proyek']),
                "no_pkp" => ($nomor_pkp)
            );
        }
        $array[] = $result;
        return $this->response->setStatusCode(200)->setJSON($array);
    }


    public function userdetail2()
    {
        $idd = $this->request->getGet("id");
        $query = $this->db->table("pkp_user a")->select("a.id, a.status, a.id_pkp, a.id_user, a.tgl_mutasi, a.id_jabatan,b.alias, b.no_pkp, b.proyek, c.nomor ")->join('master_pkp b', 'a.id_pkp = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->where('a.id', $idd, 1)->get();
        $tgl_mutasi2 = ($query->getRow()->tgl_mutasi);
        $tgl_mutasi = date('d/m/Y', strtotime($tgl_mutasi2));
        $result = array(
            "id_pkp2" => ($query->getRow()->id_pkp),
            "id_user2" => ($query->getRow()->id_user),
            "nomor2" => ($query->getRow()->nomor),
            "no_pkp2" => ($query->getRow()->no_pkp),
            "alias2" => ($query->getRow()->alias),
            "proyek2" => ($query->getRow()->proyek),
            "status2" => ($query->getRow()->status),
            "tgl_mutasi2" => ($tgl_mutasi),
            "id_jabatan2" => ($query->getRow()->id_jabatan),
        );
        return $this->response->setJSON([$result]);
    }


    public function edituserpkp()
    {
        $postData = [
            'tgl_mutasi' => $this->request->getPost('tgl_mutasi'),
            'aktif' => $this->request->getPost('aktif'),
            'id_pkp' => $this->request->getPost('id_pkp'),
            'id_jabatan' => $this->request->getPost('id_jabatan'),
            'id_user' => $this->request->getPost('id_user'),
            'idd' => $this->request->getPost('idd'),
            'agent' => $this->request->getUserAgent(),
        ];
        $hapus = new SettingModel;
        if ($hapus->updatedatauserpkp($postData)) {
            $this->session->setFlashdata('success', 'mengupdate data pkp user');
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'update data');
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function pkptambah()
    {
        $simpan = new SettingModel();
        $postData = [
            'alias' => $this->request->getPost('alias'),
            'id_instansi' => $this->request->getPost('id_instansi'),
            'proyek' => $this->request->getPost('proyek'),
            'nomor' => $this->request->getPost('nomor'),
            'id' => $this->request->getPost('id'),
            'agent' => $this->request->getUserAgent(),
        ];
        if ($simpan->cekpkp($postData) > 0) {
            $this->session->setFlashdata('error', 'Data ini sudah ada, Cek kembali INS/PKP anda');
            // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
            $redirectUrl = previous_url() ?? base_url();
        } else {
            if ($simpan->simpandatapkp($postData)) {
                $this->session->setFlashdata('success', 'menyimpan data');
                // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata('error', 'mengupdate data');
                // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
                $redirectUrl = previous_url() ?? base_url();
            }
        }

        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function pkphapus()
    {
        $postData = [
            'idd' => $this->request->getPost('idd'),
        ];
        $hapus = new SettingModel;
        if ($hapus->hapusdatapkp($postData)) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data";
            $this->session->setFlashdata('success', 'menghapus data');
            // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
            $redirectUrl = previous_url() ?? base_url();
        } else {
            $this->session->setFlashdata('error', 'menghapus data');
            // $redirectUrl = base_url("dcr/detail-kasbon/{$id27}");
            $redirectUrl = previous_url() ?? base_url();
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function migrasipkp()
    {
        $data['kode'] = '04';
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        // Menghitung total migrasi
        $data['total_migrasi'] = $this->db->table('migrasi_pkp')->countAll();

        // Menghitung total migrasi2 dengan join dan where condition
        $data['total_migrasi2'] = $this->db->table('migrasi_pkp a')
            ->select('a.pkp, a.instansi, a.proyek, a.alias, a.status')
            ->join('master_instansi b', 'a.instansi = b.nomor', 'left')
            ->where('b.nomor', null)
            ->countAllResults();

        // Menghitung total migrasi3 dengan join
        $data['total_migrasi3'] = $this->db->table('migrasi_pkp a')
            ->select('a.pkp, a.instansi, a.proyek, a.alias, a.status')
            ->join('master_pkp b', 'a.pkp = b.no_pkp')
            ->countAllResults();

        // Total2 dan Total3
        $data['total2'] = $data['total_migrasi2'];
        $data['total3'] = $data['total_migrasi3'];
        $data['kategori'] = $kategoriQNS;
        $data['kategoriQNS'] = $kategoriQNS;
        $data['judul'] = '<a href="' . base_url() . 'setting" style="color:black">SETTING | </a><a href="' . base_url() . 'setting/pkp" style="color:black">PKP | </a> <a style="color:red">IMPORT</a>';
        return view('setting/pkp-migrasi', $data);
    }


    public function datamigrasi()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $list = $this->setting->getMigrasiData();
        $data = [];
        foreach ($list as $r) {

            $row = [];
            $row[] = esc($r->instansi);
            $row[] = esc($r->pkp);
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $row[] = esc($r->status);
            $data[] = $row;
        }
        $result = array(
            "draw" => $this->request->getVar('draw'),
            "recordsTotal" => $this->setting->count_all_datatable_migrasi(),
            "recordsFiltered" => $this->setting->count_filtered_datatable_migrasi(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function datamigrasi2()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $list = $this->setting->getMigrasiData2();
        $data = [];
        foreach ($list as $r) {

            $row = [];
            $row[] = esc($r->instansi);
            $row[] = esc($r->pkp);
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $row[] = esc($r->status);
            $data[] = $row;
        }
        $result = array(
            "draw" => $this->request->getVar('draw'),
            "recordsTotal" => $this->setting->count_all_datatable_migrasi2(),
            "recordsFiltered" => $this->setting->count_filtered_datatable_migrasi2(),
            "data" => $data,
        );
        echo json_encode($result);
    }
    public function datamigrasi3()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $list = $this->setting->getMigrasiData3();
        $data = [];
        foreach ($list as $r) {

            $row = [];
            $row[] = esc($r->instansi);
            $row[] = esc($r->pkp);
            $row[] = esc($r->proyek);
            $row[] = esc($r->alias);
            $row[] = esc($r->status);
            $data[] = $row;
        }
        $result = array(
            "draw" => $this->request->getVar('draw'),
            "recordsTotal" => $this->setting->count_all_datatable_migrasi3(),
            "recordsFiltered" => $this->setting->count_filtered_datatable_migrasi3(),
            "data" => $data,
        );
        echo json_encode($result);
    }


    public function view_user3()
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
        if ($aksi['result'] == "success") {
            $spreadsheet = IOFactory::load('excel/' . $nama_file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $data = [];
            $baris = 1;
            //THBL TGL BERJALAN//
            date_default_timezone_set("Asia/Jakarta");
            $now = date("Y-m-d");
            //ambil no urut terakhir//
            //INSTHBL-12345//
            $QN = $this->db->query("SELECT max(kode) as masKode FROM migrasi_pkp order by kode");
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
                $kode = 'PKP' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
            } else {
                $kode = 'PKP' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'PKP' . md5($kode);
            $id2 = 'PKP' . hash("sha1", $id1) . 'QNS';

            foreach ($sheetData as $row) {
                $idadmin = session('idadmin');

                if ($baris > 3) {
                    array_push(
                        $data,
                        [
                            'id' => $id2,
                            'kode' => $kode,
                            'instansi' => $row['I'], //no_instansi
                            'pkp' => $row['J'], //no_pkp
                            'proyek' => $row['B'], //nrp
                            'alias' => $row['C'], //nama
                            'ket1' => $row['D'], //alamat
                            'ket2' => $row['E'],  //no_hp
                            'ket3' => $row['F'], //email
                            'ket4' => $row['G'], //jabatan
                            'ket5' => $row['H'],  //jurusan
                            'tgl1' => $row['K'], //tgl_kontrak
                            'status' => $row['L'], //status
                        ]
                    );
                }
                $baris++;
                $noUrut++;
                $kode = 'PKP' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
                $id1 = 'PKP' . md5($kode);
                $id2 = 'PKP' . hash("sha1", $id1) . 'QNS';
            }
            if ($this->setting->input_semua3($data)) {
                $data['success'] = true;
                $data['message'] = "Berhasil upload file ke database migrasi PKP";
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


    public function proses_upload_user()
    {
        $hapus = $this->setting;
        if ($hapus->prosesdatauploaduser()) {
            //if ($hapus->prosesdatauploaduser2()) {
            $data['success'] = true;
            $data['message'] = "Berhasil migrasi USER PKP";
        } else {
            $errors = "fail";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function proses_hapus()
    {
        $hapus = $this->setting;
        if ($hapus->hapusdataupload()) {
            $data['success'] = true;
            $data['message'] = "Berhasil menghapus data double";
        } else {
            $errors = "fail";
            $data['errors'] = $errors;
        }
        $data['token'] = csrf_hash();
        echo json_encode($data);
    }

    public function pkpdetail()
    {
        $idd = $this->request->getGet("id");

        $query = $this->db->table("master_pkp a")->select("a.tgl_ubah_progress, a.warning, a.late, a.no_pkp, a.proyek, a.alias, a.kode, a.dtu_nama, a.dtu_pemilik, a.dtu_jenis, a.dtu_lokasi, a.dtu_periode, a.foto, a.tgl_awal_dcr, a.tgl_mulai, a.tgl_selesai, a.status_proyek, b.nomor, b.id, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where(['a.id_pkp' => $idd], 1)->get();

        $tgl_awal_dcr2 = $query->getRow()->tgl_awal_dcr;
        $tgl_awal_dcr = date('d/m/Y', strtotime($tgl_awal_dcr2));
        $spk_mulai2 = $query->getRow()->tgl_mulai;
        $spk_mulai = date('d/m/Y', strtotime($spk_mulai2));
        $spk_akhir2 = $query->getRow()->tgl_selesai;
        $spk_akhir = date('d/m/Y', strtotime($spk_akhir2));

        $tgl_ubah_progress2 = $query->getRow()->tgl_ubah_progress;
        $tgl_ubah_progress = date('d/m/Y', strtotime($tgl_ubah_progress2));

        $result = [
            "kode" => $query->getRow()->kode,
            "nomor" => $query->getRow()->nomor,
            "instansi" => $query->getRow()->nama,
            "id_instansi" => $query->getRow()->id,
            "id_instansi2" => $query->getRow()->id,
            "no_pkp" => $query->getRow()->no_pkp,
            "no_pkp2" => $query->getRow()->no_pkp,
            "proyek" => $query->getRow()->proyek,
            "alias" => $query->getRow()->alias,
            "warning" => $query->getRow()->warning,
            "late" => $query->getRow()->late,
            "tgl_dcr" => $tgl_awal_dcr,
            "tgl_progress" => $tgl_ubah_progress,
            "spk_mulai" => $spk_mulai,
            "spk_akhir" => $spk_akhir,
            "status_akhir" => $query->getRow()->status_proyek,
        ];
        echo '[' . json_encode($result) . ']';
    }

    public function pkpedit()
    {
        $post = $this->request->getPost();
        $postData = [
            'idd' => $post['idd'],
            'tgl_dcr' => $post['tgl_dcr'],
            'tgl_ubah_progress' => $post['tgl_ubah_progress'],
            'spk_mulai' => $post['spk_mulai'],
            'spk_akhir' => $post['spk_akhir'],
            'id_instansi' => $post['id_instansi'],
            'alias' => $post['alias'],
            'proyek' => $post['proyek'],
            'warning' => $post['warning'],
            'late' => $post['late'],
            'status_akhir' => $post['status_akhir'],

        ];
        $simpan = $this->setting;
        $validation = [
            'id_instansi' => 'required',
            'nomor2' => 'required',
            'alias' => 'required',
            'proyek' => 'required',

        ];
        if (!$this->validate($validation)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            $this->session->setFlashdata('error', $errorMessages);
            $redirectUrl = previous_url() ?? base_url();

        } else {
            if ($simpan->updatedatapkp($postData)) {
                $this->session->setFlashdata('success', 'berhasil menyimpan data');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                $this->session->setFlashdata('error', 'gagal menyimpan data');
                $redirectUrl = previous_url() ?? base_url();
            }
        }

        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }

    public function tambahuserpkp()
    {
        $post = $this->request->getPost();
        $simpan = $this->setting;
        $validation = [
            'id_pkp' => 'required',
            'tgl_mutasi' => 'required',

        ];
        $postData = [
            'idd' => $post['idd'],
            'id_pkp' => $post['id_pkp'],
            'tgl_mutasi' => $post['tgl_mutasi'],
            'idjabatan_pkp' => $post['idjabatan_pkp'],
            'agent' => $this->request->getUserAgent(),

        ];
        if (!$this->validate($validation)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            $this->session->setFlashdata('error', $errorMessages);
            $redirectUrl = previous_url() ?? base_url();

        } else {
            if ($simpan->cekuserpkp($postData) > 0) {
                $this->session->setFlashdata('error', 'data pkp sudah tersedia');
                $redirectUrl = previous_url() ?? base_url();
            } else {
                if ($simpan->simpandatauserpkp($postData)) {
                    $this->session->setFlashdata('success', 'berhasil menyimpan data');
                    $redirectUrl = previous_url() ?? base_url();
                } else {
                    $this->session->setFlashdata('error', 'gagal menyimpan data');
                    $redirectUrl = previous_url() ?? base_url();
                }
            }
        }
        $data['token'] = csrf_hash();
        return redirect()->to($redirectUrl);
    }
    public function datausers()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        $requestData = $this->request->getPost();
        $pkp_user = session('pkp_user');

        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user])->getFirstRow();
            $id_divisi = $divisi ? $divisi->id_instansi : '';
        }

        //ALL
        if (level_user('setting', 'user', $kategoriQNS, 'all') > 0) {
            $builder = $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('b.kategori_user !=', 'IT');
        } else {
            //divisi
            if (level_user('setting', 'user', $kategoriQNS, 'divisi') > 0) {
                $builder = $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('d.id', $id_divisi);
            } else {
                //proyek
                $builder = $this->db->table("master_admin a")->select("a.id, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.jml_pkp, b.kategori_user,c.no_pkp,d.nomor")->join('kategori_user b', 'a.kategori = b.id')->join('master_pkp c', 'a.pkp_akhir = c.id_pkp')->join('master_instansi d', 'c.id_instansi = d.id')->where('c.id_pkp', $pkp_user);
            }
        }

        // Apply search filter if search value is provided
        if (!empty($requestData['search']['value'])) {
            $searchValue = $requestData['search']['value'];
            $builder->groupStart()
                ->like('a.username', $searchValue)
                ->orLike('a.nama_admin', $searchValue)
                ->orLike('a.email', $searchValue)
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
                1 => 'c.no_pkp', // Kolom tanggal
                2 => 'a.nama_admin', // Kolom kode dokumen
                3 => 'a.username', // Kolom kode disiplin
                4 => 'a.email', // Kolom nomor DCR
                5 => 'b.kategori_user', // Kolom nomor dokumen
                6 => 'a.jenis_kelamin', // Kolom perihal
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

        $builder->orderBy('d.nomor', 'DESC');
        $totalRecords = $builder->countAllResults(false); // Count all records without pagination

        $builder->limit($requestData['length'], $requestData['start']);
        $list = $builder->get()->getResult();
        $data = array();
        foreach ($list as $r) {
            $status = $r->aktif == '1' ? "<span class='btn btn-xs btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";

            //$kunci = esc($r->jml_pkp);
            $aktif = $r->aktif;
            if ($aktif > 0) {
                $tombolhapus = '';
            } else {
                $tombolhapus = level_user('setting', 'user', $kategoriQNS, 'delete') > 0 ? '<li><a style="font-size:12px" href="#" onclick="hapus(this)" data-id="' . $r->id . '">Hapus</a></li>' : '';
            }
            $tomboledit = level_user('setting', 'user', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="edituser/' . $r->id . '" onclick="edit(this)" data-id="' . $r->id . '">Edit</a></li>' : '';

            $row = array();
            $row[] =
                ' 
                    <div class="btn-group">
                        <button  style="font-size:12px" type="button" class="btn btn-primary" data-toggle="dropdown" aria-expanded="true">Action <span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a style="font-size:12px" href="#" onclick="detail(this)" data-id="' . $r->id . '">Detail</a></li>  
                            ' . $tomboledit . '
                            ' . $tombolhapus . ' 
                        </ul>
                    </div>
            ';
            $row[] = esc($r->nomor) . '/' . esc($r->no_pkp);
            $row[] = esc($r->nama_admin);
            $row[] = esc($r->username);
            $row[] = esc($r->email);
            $row[] = esc($r->kategori_user);
            $row[] = esc($r->jenis_kelamin);
            $row[] = $status;
            $data[] = $row;
        }
        return $this->response->setJSON([
            'draw' => intval($requestData['draw']),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data,
        ]);
    }
    public function userdetail()
    {

        $idd = $this->request->getGet("id");
        $query = $this->db->table("master_admin a")->select("a.id, a.kategori, a.username, a.nama_admin, a.email, a.jenis_kelamin, a.aktif, a.alamat, a.handphone, a.email, a.password,a.jabatan,a.jurusan,a.status,b.kategori_user")->join('kategori_user b', 'a.kategori = b.id')->where('a.id', $idd, 1)->get();
        $status = $query->getRow()->aktif == '1' ? "<span class='btn   btn-xs  btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";
        $result = array(
            "kategori" => esc($query->getRow()->kategori_user),
            "kategori_value" => esc($query->getRow()->kategori),
            "kategori2" => esc($query->getRow()->kategori),
            "passlama" => esc($query->getRow()->password),
            "username" => esc($query->getRow()->username),
            "nama_admin" => esc($query->getRow()->nama_admin),
            "jenis_kelamin" => esc($query->getRow()->jenis_kelamin),
            "alamat" => esc($query->getRow()->alamat),
            "handphone" => esc($query->getRow()->handphone),
            "email" => esc($query->getRow()->email),
            "aktif_value" => esc($query->getRow()->aktif),
            "jabatan" => esc($query->getRow()->jabatan),
            "jurusan" => esc($query->getRow()->jurusan),
            "status" => esc($query->getRow()->status),
            "aktif" => $status,
        );
        echo '[' . json_encode($result) . ']';
    }

}
