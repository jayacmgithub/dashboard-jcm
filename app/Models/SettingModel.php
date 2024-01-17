<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    public function getInstansi()
    {
        return $this->db->table('master_instansi')->get()->getResult();
    }

    public function getPKP()
    {
        $idQNS = session('idadmin');
        $isi = $this->db->table("master_admin")->where('id', $idQNS, 1)->get()->getRow();
        $kategoriQNS = $isi->kategori_user;
        //ambil id_proyek admin proyek 
        $proyek = $this->db->table('master_admin')->getWhere(['id' => $idQNS], 1);
        $pkp_user = $proyek->getRow()->pkp_user;
        //end
        //ambil divisi
        if ($pkp_user != '') {
            $divisi = $this->db->table('master_pkp')->getWhere(['id_pkp' => $pkp_user], 1);
            $id_divisi = $divisi->getRow()->id_instansi;
        }
        //ALL
        if (level_user('setting', 'pkp', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->get()->getResult();
        } else {
            //DIVISI
            if (level_user('setting', 'pkp', $kategoriQNS, 'divisi') > 0) {
                return $this->db->table("master_pkp a")->select("a.id_pkp, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->get()->getResult();
            } else {
                //PROYEK
                return $this->db->table("master_pkp a")->select("a.id_pkp, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->get()->getResult();
            }
        }
    }

    public function updatedatauser($postData)
    {

        if ($postData["password"] != '') {
            $password = password_hash($postData['password'], PASSWORD_BCRYPT);
        } else {
            $password = $postData['passlama'];
        }
        $data3 = [
            "username" => $postData["username"],
            "nama_admin" => $postData["nama_admin"],
            "jenis_kelamin" => $postData["jenis_kelamin"],
            "alamat" => $postData["alamat"],
            "handphone" => $postData["handphone"],
            "email" => $postData["email"],
            "aktif" => $postData["aktif"],
            "pkp_akhir" => $postData["pkp_akhir"],
            "password" => $password,
        ];

        return $this->db->table('master_admin')->where('id', $postData['idd'])->update($data3);
    }

    public function get_pkp($idd)
    {
        $builder = $this->db->table('master_pkp a');
        $builder->select('a.id_pkp, a.id_instansi, a.no_pkp, a.proyek, b.nomor, b.id');
        $builder->join('master_instansi b', 'a.id_instansi = b.id');
        $builder->where('a.id_pkp', $idd);
        return $builder->get()->getResultArray();
    }

    public function updatedatauserpkp($postData)
    {
        $tgl_mutasi2 = $postData["tgl_mutasi"];
        $tgl_mutasi = date('Y/m/d', strtotime($tgl_mutasi2));
        //$tgl_mutasi = $tgl_mutasi2;
        $aktif = $postData["aktif"];
        if ($aktif == "AKTIF") {
            $pkp_user = $postData["id_pkp"];
        } else {
            $pkp_user = '';
        }

        $data4 = array(
            "pkp_user" => $pkp_user,
            "pkp_akhir" => $pkp_user,
            "kategori_user" => $postData['id_jabatan'],
        );
        $this->db->table('master_admin')->where(['id' => $postData['id_user'], 'pkp_user' => $postData['id_pkp']])->update($data4);


        $data3 = array(
            "status" => $aktif,
            "tgl_mutasi" => $tgl_mutasi,
            "keterangan" => $tgl_mutasi,
            "id_jabatan" => $postData['id_jabatan'],
        );

        $this->db->table('pkp_user')->where('id', $postData['idd'])->update($data3);

        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        $idQNS = session('idadmin');
        $agent = $postData['agent'];

        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //$ipnya = $this->agent->ip_address();
        //THBL TGL BERJALAN//
        //$time = date("h:i:sa");
        $user = $this->db->table('master_admin')->getWhere(['id' => $postData['id_user']], 1);
        $pkp = $this->db->table('master_pkp')->getWhere(['id_pkp' => $postData['id_pkp']], 1);
        $jabatan = $this->db->table('kategori_user')->getWhere(['id' => $postData['id_jabatan']], 1);
        $layar = 'SETTING,USER:Edit User';
        $aksi = 'ID USER:' . $user->getRow()->kode . ' (Nama:' . $user->getRow()->nama_admin . 'PKP AKHIR:' . $pkp->getRow()->no_pkp . ':' . $pkp->getRow()->alias . 'JABATAN :' . $jabatan->getRow()->kategori_user . ')';
        //ambil no urut terakhir//
        //LOGTHBL-12345//
        //THBLTG1234567//
        $QN = $this->db->query("SELECT max(kode) as masKode FROM log order by kode");
        foreach ($QN->getResult() as $row) {
            $order = $row->masKode;
        }
        $noUrut = (int) substr($order, 6, 7);
        $noUrut++;
        //BL masKode//
        $bulanL = substr($order, 0, 6);
        //2020-10-30
        $bln = substr($now, 5, 2);
        $tahun = substr($now, 2, 2);
        $tgln = substr($now, 8, 2);
        $thbltg = $tahun . $bln . $tgln;
        if ($thbltg == $bulanL) {
            $kode = $thbltg . sprintf("%07s", $noUrut);
        } else {
            $kode = $thbltg . '0000001';
        }

        $id1 = 'LOG' . md5($kode);
        $id2 = 'LOG' . hash("sha1", $id1) . 'QNS';
        $array22 = array(
            'id_log' => $id2,
            'kode' => $kode,
            'id_user' => $idQNS,
            'ip' => $ip,
            //mac' => $mac,
            'host' => $currentAgent,
            'tgl_log' => $now,
            'jam_log' => $jam,
            'layar' => $layar,
            'aksi' => $aksi,

        );
        return $this->db->table('log')->insert($array22);
    }

    public function cekpkp($postData)
    {
        $pkp = $postData['nomor'];
        $ins = $postData['id_instansi'];
        $query = $this->db->table('master_pkp')->where("id_instansi='$ins' and no_pkp='$pkp'");
        return $query->countAllResults();
    }

    function simpandatapkp($postData)
    {
        //THBL TGL BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        $idQNS = session('idadmin');
        $agent = $postData['agent'];
        //ambil no urut terakhir//
        //INSTHBL-12345//
        $QN = $this->db->query("SELECT max(kode) as masKode FROM master_pkp order by kode");
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
            $kode = 'PKP' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
        } else {
            $kode = 'PKP' . $tahun . $bln . '-' . '00001';
        }


        $id1 = 'PKP' . md5($kode);
        $id2 = 'PKP' . hash("sha1", $id1) . 'QNS';

        $array = [
            'id_pkp' => $id2,
            'id_instansi' => $postData["id_instansi"],
            'no_pkp' => $postData["nomor"],
            'proyek' => $postData["proyek"],
            'alias' => strtoupper($postData["alias"]),
            'kode' => $kode,
            'status' => 'AKTIF',
            'kunci' => 0,
            'id_ubah' => $postData["id"],
            'warning' => 0,
            'late' => 0,
            'qr_bp' => 0,
            'acc_bp' => 1,
        ];

        //ADD LOG//
        //THBL TGL BERJALAN DAN JAM BERJALAN//

        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //$ipnya = $this->agent->ip_address();
        //THBL TGL BERJALAN//
        //$time = date("h:i:sa");
        $layar = 'PKP:tambah';
        $aksi = 'NOMOR:' . $postData['nomor'] . ' PROYEK:' . $postData['proyek'];
        $QN04 = $this->db->query("SELECT max(kode) as masKode04 FROM log order by kode");
        foreach ($QN04->getResult() as $row04) {
            $order04 = $row04->masKode04;
        }
        $noUrut04 = (int) substr($order04, 6, 7);
        $noUrut04++;
        //BL masKode//
        $bulanL04 = substr($order04, 0, 6);
        //2020-10-30
        $bln04 = substr($now, 5, 2);
        $tahun04 = substr($now, 2, 2);
        $tgln04 = substr($now, 8, 2);
        $thbltg04 = $tahun04 . $bln04 . $tgln04;
        if ($thbltg04 == $bulanL04) {
            $kode04 = $thbltg04 . sprintf("%07s", $noUrut04);
        } else {
            $kode04 = $thbltg04 . '0000001';
        }

        $id104 = 'LOG' . md5($kode04);
        $id204 = 'LOG' . hash("sha1", $id104) . 'QNS';
        $array2 = array(
            'id_log' => $id204,
            'kode' => $kode04,
            'id_user' => $idQNS,
            'ip' => $ip,
            //mac' => $mac,
            'host' => $currentAgent,
            'tgl_log' => $now,
            'jam_log' => $jam,
            'layar' => $layar,
            'aksi' => $aksi,

        );
        $this->db->table('log')->insert($array2);
        $id_instansi = $postData["id_instansi"];
        $QN2 = $this->db->query("SELECT kunci FROM master_instansi WHERE id='$id_instansi'");
        foreach ($QN2->getResult() as $row2) {
            $kunci = $row2->kunci;
        }
        $kunci++;

        $this->db->table('master_instansi')
            ->set('kunci', $kunci)
            ->where('id', $postData['id_instansi'])
            ->update();


        return $this->db->table('master_pkp')->insert($array);
    }

    public function hapusdatapkp($postData)
    {
        $pkp = $postData['idd'];
        $QN1 = $this->db->query("SELECT id_instansi FROM master_pkp where id_pkp='$pkp'");
        foreach ($QN1->getResult() as $row1) {
            $id_instansi = $row1->id_instansi;
        }
        $QN2 = $this->db->query("SELECT kunci FROM master_instansi where id='$id_instansi'");
        foreach ($QN2->getResult() as $row2) {
            $kunci = $row2->kunci;
        }
        $kunci--;
        $this->db->table('master_instansi')->set('kunci', $kunci)->where('id', $id_instansi)->update();
        return $this->db->table('master_pkp')->where('id_pkp', $postData['idd'])->delete();
    }

    public function input_semua3($data)
    {
        return $this->db->table('migrasi_pkp')->insertBatch($data);
    }

    public function uploadFile($nama_file)
    {
        $file = $this->request->getFile('excelfile'); // Assuming you have a file input named 'excelfile'

        if ($file->isValid() && !$file->hasMoved()) {
            $file->move(WRITEPATH . 'uploads/excel/', $nama_file . '.xlsx');

            return ['result' => 'success', 'file' => $nama_file, 'error' => ''];
        } else {
            return ['result' => 'failed', 'file' => '', 'error' => $file->getErrorString()];
        }
    }



    public function prosesdatauploaduser()
    {
        //PANGGIL data migrasi
        $YS = $this->db->query("SELECT * FROM migrasi_pkp");
        foreach ($YS->getResult() as $rys) {
            $no_instansi = $rys->instansi;
            $no_pkp = $rys->pkp;
            $username = $rys->proyek;
            $nama = $rys->alias;
            $status = $rys->status;
            $alamat = $rys->ket1;
            $no_hp = $rys->ket2;
            $email = $rys->ket3;
            $jabatan = $rys->ket4;
            $jurusan = $rys->ket5;
            $status = $rys->status;
            $tgl_kontrak = $rys->tgl1;
            //cek user apa sudah ada kalau sudah ada di update datanya 
            $YS1 = $this->db->query("SELECT * FROM master_instansi where nomor='$no_instansi'");
            foreach ($YS1->getResult() as $rys1) {
                $id_instansi = $rys1->id;
            }
            if ($no_pkp == '000') {
                $YS2 = $this->db->query("SELECT * FROM master_pkp where no_pkp = '$no_pkp' and id_instansi='$id_instansi'");
            } else {
                $YS2 = $this->db->query("SELECT * FROM master_pkp where no_pkp = '$no_pkp'");
            }
            foreach ($YS2->getResult() as $rys2) {
                $id_pkp = $rys2->id_pkp;
            }

            $QN01 = $this->db->query("SELECT * FROM master_admin where username='$username'");
            if ($QN01->getNumRows() > 0) {
                foreach ($QN01->getResult() as $row1) {
                    $data_user = array(
                        "nama_admin" => $nama,
                        "habis_kontrak" => $tgl_kontrak,
                        "jurusan" => $jurusan,
                        "jabatan" => $jabatan,
                        "status" => $status,
                        "alamat" => $alamat,
                        "handphone" => $no_hp,
                        "email" => $email,
                        "pkp_akhir" => $id_pkp,
                    );
                    $this->db->table('master_admin')->where('id', $row1->id)->update($data_user);
                }
            } else {

                $password = password_hash($username, PASSWORD_BCRYPT);
                //THBL TGL BERJALAN//
                date_default_timezone_set("Asia/Jakarta");
                $now = date("Y-m-d");
                //ambil no urut terakhir//
                //THBL123//
                $id1 = 'USR' . md5($username);
                $id2 = 'USR' . hash("sha1", $id1) . 'QNS';



                $id_user = $id2;
                $tgl_mutasi2 = $now;
                $tgl_mutasi = date('Y-m-d', strtotime($tgl_mutasi2));
                $status = 'AKTIF';

                $array_user = [
                    'id' => $id2,
                    'kode' => $username,
                    'kategori' => 'JBTa17b2e661e234a22626313b7f01f1fa3c58e0e8fQNS',
                    'kategori_user' => 'JBTa17b2e661e234a22626313b7f01f1fa3c58e0e8fQNS',
                    'username' => $username,
                    'password' => $password,
                    'nama_admin' => $nama,
                    'jenis_kelamin' => 'L',
                    'alamat' => $alamat,
                    'telepon' => '',
                    'handphone' => $no_hp,
                    'email' => $email,
                    'aktif' => 'AKTIF',
                    'golongan' => '',
                    'pkp_user' => $id_pkp,
                    'pkp_akhir' => $id_pkp,
                    'jurusan' => $jurusan,
                    'jabatan' => $jabatan,
                    'status' => $status,
                    "habis_kontrak" => $tgl_kontrak,
                    "aktif" => '1',
                    'jml_pkp' => 1,
                ];
                $this->db->table('master_admin')->insert($array_user);
                //delete file migrasi
                //   $this->db->where('id', $rys->id);
                //  $this->db->delete('migrasi_pkp');
            }
        }
        //delete file migrasi
        return $this->db->table('migrasi_pkp')->where('id !=', '')->delete();
    }

    public function hapusdataupload()
    {
        $sql = "DELETE t1 FROM migrasi_pkp t1 JOIN master_pkp t2 ON t1.pkp = t2.no_pkp";
        return $this->db->query($sql);
    }

    function simpandatalapbul()
    {
        $post = $this->request->getPost();
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        $pkp = $this->db->table('master_pkp')->getWhere(['id_pkp' => $post['id_pkp']], 1);
        $tgl_periode = date('Y-m-01', strtotime($post['tgl_periode']));
        $lokasi = '/qs/pdf/' . $pkp->getRow()->no_pkp . '/' . $tgl_periode . '.pdf';
        //CEK FILE PDF QS ADA

        $isi = $this->db->table("pdf_qs")->select("*")->where('id_pkp', $post['id_pkp'])->where('tgl_periode', $tgl_periode)->get();
        if ($isi->getNumRows() > 0) {
            $sudah = $isi->getNumRows();
        } else {
            $sudah = '';
        }

        if ($sudah != '') {
            $this->db->table('pdf_qs')->where('id_pdf_qs', $isi->getRow()->id_pdf_qs)->delete();
        }
        //INSERT pdf qs
        $QN2 = $this->db->query("SELECT max(kode) as masKode2 FROM pdf_qs order by kode");
        foreach ($QN2->getResult() as $row2) {
            $order2 = $row2->masKode2;
        }
        $noUrut2 = (int) substr($order2, 8, 5);
        $noUrut2++;
        //BL masKode//
        $bulanL2 = substr($order2, 5, 2);
        $bln2 = substr($now, 5, 2);
        $tahun2 = substr($now, 2, 2);
        if ($bln2 == $bulanL2) {
            $kode2 = 'QSP' . $tahun2 . $bln2 . '-' . sprintf("%05s", $noUrut2);
        } else {
            $kode2 = 'QSP' . $tahun2 . $bln2 . '-' . '00001';
        }
        $id12 = 'QSP' . md5($kode2);
        $id22 = 'QSP' . hash("sha1", $id12) . 'QNS';

        $listMKT = [
            'id_pdf_qs' => $id22,
            'kode' => $kode2,
            'id_pkp' => $post['id_pkp'],
            'tgl_upload' => $now,
            'id_ubah' => $idQNS,
            'tgl_periode' => $tgl_periode,
            'file' => $lokasi,
        ];
        $this->db->table('pdf_qs')->insert($listMKT);

        //update pkp
        if ($pkp->getRow()->periode_akhir > 0) {
            if (strtotime($pkp->getRow()->periode_akhir) < strtotime($tgl_periode)) {
                $tgl_periode2 = $tgl_periode;
            } else {
                $tgl_periode2 = $pkp->getRow()->periode_akhir;
            }
        } else {
            $tgl_periode2 = $tgl_periode;
        }

        $data3 = [
            "periode_akhir" => $tgl_periode2,
            "update_qs" => $now,
        ];

        $this->db->table('master_pkp')->where('id_pkp', $pkp->getRow()->id_pkp)->update($data3);

        //PDF FILE
        //CEK & BUAT FOLDER
        if (!is_dir('./assets/qs/pdf/' . $pkp->getRow()->no_pkp)) {
            mkdir('./assets/qs/pdf/' . $pkp->getRow()->no_pkp, 0777, TRUE);
        }

        $lokasi2 = './assets/qs/pdf/' . $pkp->getRow()->no_pkp;
        $config['upload_path'] = $lokasi2;
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 102400;
        $config['overwrite'] = TRUE;

        $jumlah_berkas = count($_FILES['berkas']['name']);

        for ($i = 0; $i < $jumlah_berkas; $i++) {
            if (!empty($_FILES['berkas']['name'][$i])) {
                $config['file_name'] = $tgl_periode;
                $this->load->library('upload', $config);
                $_FILES['file']['name'] = $_FILES['berkas']['name'][$i];
                $_FILES['file']['type'] = $_FILES['berkas']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['berkas']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['berkas']['error'][$i];
                $_FILES['file']['size'] = $_FILES['berkas']['size'][$i];
                $this->upload->do_upload('file');
            }
        }
        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
        $this->load->library('user_agent');

        if ($this->agent->is_browser()) {
            $browser = $this->agent->browser() . ' ' . $this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $browser = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $browser = $this->agent->mobile();
        } else {
            $browser = 'Unidentified User Agent';
        }
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        //$ipnya = $this->agent->ip_address();
        //THBL TGL BERJALAN//
        //$time = date("h:i:sa");
        $layar = 'TAMBAH,PDF:QS';
        $aksi = ' (Proyek:' . $pkp->getRow()->no_pkp . ':' . $pkp->getRow()->alias . ') Periode :' . $tgl_periode;
        //ambil no urut terakhir//
        //LOGTHBL-12345//
        //THBLTG1234567//
        $QN = $this->db->query("SELECT max(kode) as masKode FROM log order by kode");
        foreach ($QN->getResult() as $row) {
            $order = $row->masKode;
        }
        $noUrut = (int) substr($order, 6, 7);
        $noUrut++;
        //BL masKode//
        $bulanL = substr($order, 0, 6);
        //2020-10-30
        $bln = substr($now, 5, 2);
        $tahun = substr($now, 2, 2);
        $tgln = substr($now, 8, 2);
        $thbltg = $tahun . $bln . $tgln;
        if ($thbltg == $bulanL) {
            $kode = $thbltg . sprintf("%07s", $noUrut);
        } else {
            $kode = $thbltg . '0000001';
        }

        $id1 = 'LOG' . md5($kode);
        $id2 = 'LOG' . hash("sha1", $id1) . 'QNS';
        $array22 = [
            'id_log' => $id2,
            'kode' => $kode,
            'id_user' => $idQNS,
            'ip' => $ip,
            //mac' => $mac,
            'host' => $browser,
            'tgl_log' => $now,
            'jam_log' => $jam,
            'layar' => $layar,
            'aksi' => $aksi,

        ];
        return $this->db->insert("log", $array22);
    }

    public function getMigrasiData()
    {
        return $this->db->table("migrasi_pkp a")->select("a.pkp, a.instansi, a.proyek, a.alias, a.status")->join('master_instansi b', 'a.instansi = b.nomor', 'left')->where('b.nomor', null)->get()->getResult();
    }

    function count_filtered_datatable_migrasi()
    {
        return count($this->getDataImport1());
    }
    public function count_all_datatable_migrasi()
    {
        return $this->db->table('migrasi_pkp')->countAllResults();
    }

    public function getMigrasiData2()
    {
        return $this->db->table("migrasi_pkp a")->select("a.pkp, a.instansi, a.proyek, a.alias, a.status")->join('master_instansi b', 'a.instansi = b.nomor')->get()->getResult();
    }

    function count_filtered_datatable_migrasi2()
    {
        return count($this->getDataImport2());
    }
    public function count_all_datatable_migrasi2()
    {
        return $this->db->table('migrasi_pkp')->countAllResults();
    }


    public function getMigrasiData3()
    {
        return $this->db->table("migrasi_pkp a")->select("a.pkp, a.instansi, a.proyek, a.alias, a.status")->join('master_pkp b', 'a.pkp = b.no_pkp')->get()->getResult();
    }

    function count_filtered_datatable_migrasi3()
    {
        return count($this->getDataImport1());
    }
    public function count_all_datatable_migrasi3()
    {
        return $this->db->table('migrasi_pkp')->countAllResults();
    }

}

