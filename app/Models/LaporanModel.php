<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{

    public function view_laporan_absensi($filter1, $filter2, $tahun, $bulan)
    {
        if ($filter1 == '1' and $filter2 == '1' and $tahun != '00' and $bulan != '00') {
            /*$this->db->where('tahun', $tahun);
            $this->db->where('bulan', $bulan); // Tambahkan where tanggal nya
            $this->db->orderBy('kode', 'ASCD');
            return $this->db->get('detil_karyawan')->getResult();
*/
            return $this->db->table('detil_karyawan a')->select("b.username,b.nama_admin,a.sakit,a.ijin,a.alpha,a.cuti,a.ket_absensi,a.jabatan,a.ket_jabatan,a.tgl_akhir_kontrak,a.tgl_ren_mob,a.tgl_real_mob,a.tgl_ren_demob,a.tgl_real_demob,a.status,a.ket_mobdemob,a.ket_akhir,c.no_pkp,c.alias,d.no_pkp as 'no_pkp2',d.alias as 'alias2'")->join('master_admin b', 'a.id_user = b.id')->join('master_pkp c', 'a.id_pkp=c.id_pkp')->join('master_pkp d', 'a.pkp_sebelumnya=d.id_pkp')->where('a.tahun', $tahun)->where('bulan', $bulan)->orderBy('c.no_pkp', 'ASCD')->get()->getResult();
        } else {
            if ($filter1 == '1' and $filter2 == '1' and $tahun != '00' and $bulan == '00') {
                $builder = $this->db->table('detil_karyawan');
                $builder->where('tahun', $tahun);
                $builder->orderBy('bulan', 'ASC');

                return $builder->get()->getResult();
            } else {
                $builder = $this->db->table('detil_karyawan');
                $builder->where('tahun', 'APRHAY58'); // Add the condition for the year
                $builder->orderBy('bulan', 'ASC');

                return $builder->get()->getResult();
            }
        }
    }

    public function view_by_month($month, $year, $filter2, $pkp_user)
    {
        $builder = $this->db->table($filter2 == '1' || $filter2 == '0' ? 'bp' : 'tdp');

        if ($filter2 == '1' || $filter2 == '0') {
            $builder->select('*');
        } else {
            $builder->select("tgl_tdp as tgl_bp, no_tdp as no_bp, total, total2, status, sts_transfer, kode, keterangan");
        }

        $builder->where('pkp', $pkp_user);
        $builder->where('MONTH(tgl_bp)', $month); // Add the condition for the month
        $builder->where('YEAR(tgl_bp)', $year); // Add the condition for the year
        $builder->orderBy('kode', 'ASC');

        return $builder->get()->getResult();
    }

    public function view_by_year($year, $filter2, $pkp_user)
    {
        $builder = $this->db->table($filter2 == '1' || $filter2 == '0' ? 'bp' : 'tdp');

        if ($filter2 == '1' || $filter2 == '0') {
            $builder->where('pkp', $pkp_user);
            $builder->where('YEAR(tgl_bp)', $year); // Add the condition for the year
            $builder->orderBy('kode', 'ASC');
            return $builder->get()->getResult();
        } else {
            $builder->select("tgl_tdp as tgl_bp, no_tdp as no_bp, total, total2, status, sts_transfer, kode, keterangan");
            $builder->where('pkp', $pkp_user);
            $builder->where('YEAR(tgl_tdp)', $year); // Add the condition for the year
            $builder->orderBy('kode', 'ASC');
            return $builder->get()->getResult();
        }
    }

    public function view_all($filter2, $pkp_user)
    {
        $builder = $this->db->table($filter2 == '1' || $filter2 == '0' ? 'bp' : 'tdp');

        if ($filter2 == '1' || $filter2 == '0') {
            $builder->where('pkp', $pkp_user);
            $builder->orderBy('kode', 'ASC');
            return $builder->get()->getResult();
        } else {
            $builder->select("tgl_tdp as tgl_bp, no_tdp as no_bp, total, total2, status, sts_transfer, kode, keterangan");
            $builder->where('pkp', $pkp_user);
            $builder->orderBy('kode', 'ASC');
            return $builder->get()->getResult();
        }
    }
    public function option_bulan($filter2)
    {

        $builder = $this->db->table('detil_karyawan');

        $builder->select('bulan');
        $builder->orderBy('bulan', 'ASC');
        $builder->groupBy('bulan');

        return $builder->get()->getResult();
    }
    public function option_tahun($filter2)
    {
        $builder = $this->db->table('detil_karyawan');

        $builder->select('tahun');
        $builder->orderBy('tahun', 'ASC');
        $builder->groupBy('tahun');

        return $builder->get()->getResult();
    }

    public function simpandataproyekqs($postData)
    {
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");

        $data = [
            'qs' => 'QS',
            'update_qs' => $now,
        ];

        $this->db->table('master_pkp')->where('id_pkp', $postData['id_pkp'])->update($data);

        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
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

        $pkp = $this->db->table('master_pkp')->getWhere(['id_pkp' => $postData['id_pkp']], 1);

        $layar = 'TAMBAH,PROYEK:QS';
        $aksi = ' (Proyek:' . $pkp->getRow()->no_pkp . ':' . $pkp->getRow()->alias;
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
            'host' => $currentAgent,
            'tgl_log' => $now,
            'jam_log' => $jam,
            'layar' => $layar,
            'aksi' => $aksi,

        ];
        return $this->db->table('log')->insert($array22);
    }

    function simpandatakaryawan($postData)
    {
        $idQNS = session('idadmin');
        $password = password_hash($postData['no_nrp'], PASSWORD_BCRYPT);
        //THBL TGL BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        //ambil no urut terakhir//
        //THBL123//
	$salt = bin2hex(random_bytes(8));
	$id1 = 'USR' . md5($postData['no_nrp']);
	$id2 = 'USR' . hash("sha1", $id1 . $salt) . 'QNS';
        $nama = strtoupper($postData["nama_admin"]);
        $agent = $postData['agent'];
        $id_jabatan = 'JBTa17b2e661e234a22626313b7f01f1fa3c58e0e8fQNS';
        $id_pkp = $postData['pkp'];
        $id_user = $id2;
        $tgl_lahir = date('Y-m-d', strtotime($postData['tgl_lahir']));
        $tgl_masuk = date('Y-m-d', strtotime($postData['tgl_masuk']));
        $tgl_kontrak = date('Y-m-d', strtotime($postData['tgl_kontrak']));
        $tgl_awal_kontrak = date('Y-m-d', strtotime($postData['tgl_awal_kontrak']));
        $status = 'AKTIF';

        $QN2 = $this->db->query("SELECT max(kode) as masKode2 FROM pkp_user order by kode");
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
            $kode2 = 'PUS' . $tahun2 . $bln2 . '-' . sprintf("%05s", $noUrut2);
        } else {
            $kode2 = 'PUS' . $tahun2 . $bln2 . '-' . '00001';
        }
        $id12 = 'PUS' . md5($kode2);
        $id22 = 'PUS' . hash("sha1", $id12) . 'QNS';

        $listPKP = [
            'id' => $id22,
            'kode' => $kode2,
            'id_user' => $id_user,
            'id_pkp' => $id_pkp,
            'status' => $status,
            'tgl_mutasi' => $tgl_masuk,
            'id_jabatan' => $id_jabatan,

        ];
        $this->db->table('pkp_user')->insert($listPKP);

        $QNS1 = $this->db->query("SELECT max(kode) as masKode2 FROM pkp_karyawan order by kode");
        foreach ($QNS1->getResult() as $rQNS1) {
            $orderQNS2 = $rQNS1->masKode2;
        }
        $noUrutQNS2 = (int) substr($orderQNS2, 8, 5);
        $noUrutQNS2++;
        //BL masKode//
        $bulanLQNS2 = substr($orderQNS2, 5, 2);
        $blnQNS2 = substr($now, 5, 2);
        $tahunQNS2 = substr($now, 2, 2);
        if ($blnQNS2 == $bulanLQNS2) {
            $kodeQNS2 = 'KAR' . $tahunQNS2 . $blnQNS2 . '-' . sprintf("%05s", $noUrutQNS2);
        } else {
            $kodeQNS2 = 'KAR' . $tahunQNS2 . $blnQNS2 . '-' . '00001';
        }
        $idQNS12 = 'KAR' . md5($kodeQNS2);
        $idQNS22 = 'KAR' . hash("sha1", $idQNS12) . 'QNS';

        $listQNS = [
            'id_pkp_karyawan' => $idQNS22,
            'kode' => $kodeQNS2,
            'id_user' => $id_user,
            'id_pkp' => $id_pkp,
            'jabatan' => $postData['jabatan'],
            'tgl_mob' => $tgl_masuk,
            'status' => $postData['status_kontrak'],
            'tgl_ubah' => $now,
            'id_ubah' => $idQNS,

        ];
        $this->db->table('pkp_karyawan')->insert($listQNS);

        $array = [
            'id' => $id2,
            'kode' => $postData['no_nrp'],
            'kategori' => $id_jabatan,
            'kategori_user' => $id_jabatan,
            'username' => $postData['no_nrp'],
            'password' => $password,
            'nama_admin' => $nama,
            'jenis_kelamin' => $postData["jenis_kelamin"],
            'alamat' => $postData["alamat"],
            'handphone' => $postData["handphone"],
            'email' => $postData["email"],
            'aktif' => '1',
            'jabatan' => $postData["jabatan"],
            'jurusan' => $postData["jurusan"],
            'status' => $postData["status_kontrak"],
            'pkp_user' => $postData['pkp'],
            'pkp_akhir' => $postData['pkp'],
            'tgl_masuk' => $tgl_masuk,
            'tgl_mutasi' => $tgl_masuk,
            'tgl_awal_kontrak' => $tgl_awal_kontrak,
            'habis_kontrak' => $tgl_kontrak,
            'tgl_lahir' => $tgl_lahir,
            'jml_pkp' => 1,
        ];
        $QN3 = $this->db->query("SELECT kunci FROM kategori_user where id='$id_jabatan'");
        foreach ($QN3->getResult() as $row3) {
            $kunci = $row3->kunci;
        }
        $kunci++;
        $this->kunci = $kunci;
        $this->db->table('kategori_user')
            ->set('kunci', $kunci)
            ->where('id', $id_jabatan)
            ->update();

        $this->db->table('master_admin')->insert($array);

        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");


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

        $pkp = $this->db->table('master_pkp')->getWhere(['id_pkp' => $postData['pkp']], 1);

        $layar = 'SETTING,USER:Tambah User';
        $aksi = 'ID USER:' . $postData['no_nrp'] . ' (Nama:' . $nama . 'PKP AKHIR:' . $pkp->getRow()->no_pkp . ':' . $pkp->getRow()->alias . 'JABATAN :' . $postData['jabatan'];
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
            'host' => $currentAgent,
            'tgl_log' => $now,
            'jam_log' => $jam,
            'layar' => $layar,
            'aksi' => $aksi,

        ];
        return $this->db->table('log')->insert($array22);
    }

    public function input_semua($data)
    {
        return $this->db->table('file_migrasi')->insertBatch($data);
    }


    public function getDataImport1()
    {
        return $this->db->table("file_migrasi")->select("*")->where('tipe', 'BARU')->get()->getResult();
    }

    function count_filtered_datatable_import1()
    {
        return count($this->getDataImport1());
    }

    public function count_all_datatable_import1()
    {
        return $this->db->table('file_migrasi')->where('tipe', 'BARU')->countAllResults();
    }



    public function getDataImport2()
    {
        return $this->db->table("file_migrasi")->select("*")->where('tipe', 'DATA')->get()->getResult();
    }

    function count_filtered_datatable_import2()
    {
        return count($this->getDataImport2());
    }

    public function count_all_datatable_import2()
    {
        return $this->db->table('file_migrasi')->where('tipe', 'DATA')->countAllResults();
    }

    public function hapusdatapembaharuan_1()
    {
        return $this->db->table('file_migrasi')->where('tipe', 'DATA')->delete();
    }
    public function simpandatapembaharuan_1($postData)
    {
        //$d1 = 1;
        //return $d1;
        $idQNS = session('idadmin');
        $QN = $this->db->query("SELECT * FROM file_migrasi where tipe='DATA' order by kode");
        foreach ($QN->getResult() as $row) {
            $kode = $row->ket_1;
            $QNS = $this->db->query("SELECT * FROM master_admin where kode = '$kode'");
            foreach ($QNS->getResult() as $rQNS) {
                $jenis_kelamin = $rQNS->jenis_kelamin;
                $tgl_lahir = $rQNS->tgl_lahir;
                $alamat = $rQNS->alamat;
                $handphone = $rQNS->handphone;
                $email = $rQNS->email;
                $jurusan = $rQNS->jurusan;
                $jabatan = $rQNS->jabatan;
                $tgl_masuk = $rQNS->tgl_masuk;
                $tgl_kontrak = $rQNS->tgl_kontrak;
                $habis_kontrak = $rQNS->habis_kontrak;
                $status = $rQNS->status;
                $kawin = $rQNS->kawin;
                $domisili = $rQNS->domisili;
                $keluarga = $rQNS->keluarga;
                $sisa_cuti = $rQNS->sisa_cuti;
            }
            $r3 = substr($row->ket_3, 0, 1);
            $r4 = substr($row->ket_4, 0, 1);
            $r5 = substr($row->ket_5, 0, 1);
            $r6 = substr($row->ket_6, 0, 1);
            $r7 = substr($row->ket_7, 0, 1);
            $r8 = substr($row->ket_8, 0, 1);
            $r9 = substr($row->ket_9, 0, 1);
            $r10 = substr($row->ket_10, 0, 1);
            $r11 = substr($row->ket_11, 0, 1);
            $r12 = substr($row->ket_12, 0, 1);
            $r13 = substr($row->ket_13, 0, 1);

            if ($row->ket_3 != '' and $r3 != ' ') {
                if ($row->ket_3 == 'L') {
                    $lp = 'laki-laki';
                } else {
                    $lp = 'perempuan';
                }
            } else {
                $lp = $jenis_kelamin;
            }
            if ($row->ket_4 != '' and $r4 != ' ') {
                $alamat2 = $row->ket_4;
            } else {
                $alamat2 = $alamat;
            }
            if ($row->ket_5 != '' and $r5 != ' ') {
                $handphone2 = $row->ket_5;
            } else {
                $handphone2 = $handphone;
            }
            if ($row->ket_6 != '' and $r6 != ' ') {
                $email2 = $row->ket_6;
            } else {
                $email2 = $email;
            }
            if ($row->ket_7 != '' and $r7 != ' ') {
                $jurusan2 = $row->ket_7;
            } else {
                $jurusan2 = $jurusan;
            }
            if ($row->ket_8 != '' and $r8 != ' ') {
                $jabatan2 = $row->ket_8;
            } else {
                $jabatan2 = $jabatan;
            }
            if ($row->ket_9 != '' and $r9 != ' ') {
                $status2 = $row->ket_9;
            } else {
                $status2 = $status;
            }
            if ($row->ket_10 != '' and $r10 != ' ') {
                $kawin2 = $row->ket_10;
            } else {
                $kawin2 = $kawin;
            }
            if ($row->ket_11 != '' and $r11 != ' ') {
                $domisili2 = $row->ket_11;
            } else {
                $domisili2 = $domisili;
            }
            if ($row->ket_12 != '' and $r12 != ' ') {
                $keluarga2 = $row->ket_12;
            } else {
                $keluarga2 = $keluarga;
            }
            if ($row->ket_13 != '' and $r13 != ' ' and is_numeric($row->ket_13)) {
                $sisa_cuti2 = $row->ket_13;
            } else {
                $sisa_cuti2 = $sisa_cuti;
            }
            $array = [

                'jenis_kelamin' => $lp,
                'tgl_lahir' => $row->tgl_1,
                'alamat' => $alamat2,
                'handphone' => $handphone2,
                'email' => $email2,
                'jurusan' => $jurusan2,
                'jabatan' => $jabatan2,
                'tgl_masuk' => $row->tgl_2,
                'tgl_kontrak' => $row->tgl_3,
                'habis_kontrak' => $row->tgl_4,
                'status' => $status2,
                'kawin' => $kawin2,
                'domisili' => $domisili2,
                'keluarga' => $keluarga2,
                'sisa_cuti' => $sisa_cuti2,

            ];
            $this->db->table('master_admin')->where('kode', $row->ket_1)->update($array);
            //ADD LOG BP//
            //THBL TGL BERJALAN DAN JAM BERJALAN//
            date_default_timezone_set("Asia/Jakarta");
            $now = date("Y-m-d");
            $jam = date("H:i:s");

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

            $layar = 'SETTING,USER:Tambah User';
            $aksi = 'IMPORT PEMBAHARUAN:' . $row->ket_1 . ' (Nama:' . $row->ket_2 . ')';
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
            $this->db->table('log')->insert($array22);
        }
        return $this->db->table('file_migrasi')->where('tipe', 'DATA')->delete();
    }

    public function cekmemo($postData)
    {
        if ($postData['respon'] == 'memo' and $postData['memo'] != '' and $postData['tgl_mob'] != '' and $postData['pkp_tujuan'] != '' and $postData['jabatan'] != '') {
            $isi = 0;
        } else {
            if ($postData['respon'] != 'memo') {
                $isi = 0;
            } else {
                $isi = 1;
            }
        }
        return $isi;
    }

    public function ceksudahrespon($postData)
    {
        $id_user = $postData['id_user'];
        if ($postData['respon'] != 'memo') {
            $QN3 = $this->db->query("SELECT tgl_respon FROM master_admin where id='$id_user'");
            foreach ($QN3->getResult() as $row3) {
                $tgl_respon = $row3->tgl_respon;
            }
            if ($tgl_respon > 0) {
                $isi = 1;
            } else {
                $isi = 0;
            }
        } else {
            $isi = 0;
        }
        return $isi;
    }

    public function mutasi_karyawan($postData)
    {
        //UPDATE RESPON TANPA MEMO
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");

        if ($postData['respon'] != 'memo') {
            $data3 = array(
                'tgl_respon' => $now,
            );
            return $this->db->table('master_admin')->where('id', $postData['id_user'])->update($data3);
        } else {
            //1 TAMBAH pkp_karyawan
            $QNS1 = $this->db->query("SELECT max(kode) as masKode2 FROM pkp_karyawan order by kode");
            foreach ($QNS1->getResult() as $rQNS1) {
                $orderQNS2 = $rQNS1->masKode2;
            }
            $noUrutQNS2 = (int) substr($orderQNS2, 8, 5);
            $noUrutQNS2++;
            $bulanLQNS2 = substr($orderQNS2, 5, 2);
            $blnQNS2 = substr($now, 5, 2);
            $tahunQNS2 = substr($now, 2, 2);
            if ($blnQNS2 == $bulanLQNS2) {
                $kodeQNS2 = 'KAR' . $tahunQNS2 . $blnQNS2 . '-' . sprintf("%05s", $noUrutQNS2);
            } else {
                $kodeQNS2 = 'KAR' . $tahunQNS2 . $blnQNS2 . '-' . '00001';
            }
            $idQNS12 = 'KAR' . md5($kodeQNS2);
            $idQNS22 = 'KAR' . hash("sha1", $idQNS12) . 'QNS';
            $id_user = $postData['id_user'];
            $tgl_mob = date('Y-m-d', strtotime($postData['tgl_mob']));
            $QN3 = $this->db->query("SELECT * FROM master_admin where id='$id_user'");
            foreach ($QN3->getResult() as $row3) {
                $status = $row3->status;
                $pkp_lama = $row3->pkp_akhir;
                $nama_admin = $row3->nama_admin;
                $username = $row3->username;
            }
            $listQNS = [
                'id_pkp_karyawan' => $idQNS22,
                'kode' => $kodeQNS2,
                'id_user' => $postData['id_user'],
                'id_pkp' => $postData['pkp_tujuan'],
                'jabatan' => $postData['jabatan'],
                'tgl_mob' => $tgl_mob,
                'status' => $status,
                'tgl_ubah' => $now,
                'id_ubah' => $idQNS,

            ];
            $this->db->table('pkp_karyawan')->insert($listQNS);
            //END 1

            //2 UBAH PKP KARYAWAN LAMA
            $data3 = [
                'tgl_demob' => $tgl_mob,
            ];

            $this->db->table('pkp_karyawan')->where('id_pkp', $pkp_lama)->where('id_user', $postData['id_user'])->update($data3);
            //END 2

            //3 UBAH DATA KARYAWAN
            $data4 = [
                'tgl_mutasi' => $tgl_mob,
                'pkp_akhir' => $postData['pkp_tujuan'],
            ];

            $this->db->table('master_admin')->where('id', $postData['id_user'])->update($data4);
            //END 3

            //4 LOG
            date_default_timezone_set("Asia/Jakarta");
            $now = date("Y-m-d");
            $jam = date("H:i:s");

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

            $layar = 'Data,HCM:Mutasi Data Karyawan';
            $aksi = ' (NRP:' . $username . ':' . $nama_admin . ')';
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
            //END 4
        }
    }


    public function updatedatauser_1($postData)
    {
        $idQNS = session('idadmin');
        $tgl_lahir = date('Y-m-d', strtotime($postData['tgl_lahir']));
        $tgl_masuk = date('Y-m-d', strtotime($postData['tgl_masuk']));
        $tgl_kontrak = date('Y-m-d', strtotime($postData['tgl_kontrak']));
        $tgl_kontrak_1 = date('Y-m-d', strtotime($postData['tgl_kontrak_1']));
        $data3 = array(
            "pkp_akhir" => $postData["pkp_akhir"],
            "nama_admin" => $postData["nama_admin"],
            "tgl_lahir" => $tgl_lahir,
            "jenis_kelamin" => $postData["jenis_kelamin"],
            "alamat" => $postData["alamat"],
            "handphone" => $postData["handphone"],
            "email" => $postData["email"],
            "tgl_masuk" => $tgl_masuk,
            "tgl_kontrak" => $tgl_kontrak_1,
            "habis_kontrak" => $tgl_kontrak,
            "jabatan" => $postData["jabatan"],
            "jurusan" => $postData["jurusan"],
            "status" => $postData["status_karyawan"],
            "sisa_cuti" => $postData["sisa_cuti"],
        );

        $this->db->table('master_admin')->where('id', $postData['idd'])->update($data3);

        $data4 = array(
            "id_pkp" => $postData["pkp_akhir"],
        );
        $this->db->table('pkp_karyawan')->where('id_user', $postData['idd'])->where('id_pkp', $postData['pkp_sebelumnya'])->update($data4);

        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");

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

        $layar = 'Data,HCM:Update Data Karyawan';
        $aksi = ' (Nama:' . $postData['nama_admin'] . ')';
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
    public function updatedatauser_2($postData)
    {
        $idQNS = session('idadmin');
        $tgl_lahir = date('Y-m-d', strtotime($postData['tgl_lahir']));
        $tgl_masuk = date('Y-m-d', strtotime($postData['tgl_masuk']));
        $data3 = array(
            "nama_admin" => $postData["nama_admin"],
            "tgl_lahir" => $tgl_lahir,
            "jenis_kelamin" => $postData["jenis_kelamin"],
            "alamat" => $postData["alamat"],
            "handphone" => $postData["handphone"],
            "email" => $postData["email"],
            "tgl_masuk" => $tgl_masuk,
            "jabatan" => $postData["jabatan"],
            "jurusan" => $postData["jurusan"],
            "status" => $postData["status_karyawan"],
            "sisa_cuti" => $postData["sisa_cuti"],
        );

        $this->db->table('master_admin')->where('id', $postData['idd'])->update($data3);



        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");

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

        $layar = 'Data,HCM:Update Data Karyawan';
        $aksi = ' (Nama:' . $postData['nama_admin'] . ')';
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
    public function updatedatauser_3($postData)
    {
        $idQNS = session('idadmin');
        $tgl_lahir = date('Y-m-d', strtotime($postData['tgl_lahir']));
        $tgl_masuk = date('Y-m-d', strtotime($postData['tgl_masuk']));
        $data3 = array(
            "nama_admin" => $postData["nama_admin"],
            "tgl_lahir" => $tgl_lahir,
            "jenis_kelamin" => $postData["jenis_kelamin"],
            "alamat" => $postData["alamat"],
            "handphone" => $postData["handphone"],
            "email" => $postData["email"],
            "tgl_masuk" => $tgl_masuk,
            "jabatan" => $postData["jabatan"],
            "jurusan" => $postData["jurusan"],
            "status" => $postData["status_karyawan"],
            "sisa_cuti" => $postData["sisa_cuti"],
            'aktif' => $postData["aktif"],
        );

        $this->db->table('master_admin')->where('id', $postData['idd'])->update($data3);



        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");

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

        $layar = 'Data,HCM:Update Data Karyawan';
        $aksi = ' (Nama:' . $postData['nama_admin'] . ')';
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

    public function get_karyawan($idd)
    {
        return $this->db->table("master_admin a")->select("a.id,b.id_pkp,b.no_pkp,b.alias")->join('master_pkp b', 'a.pkp_akhir = b.id_pkp')->where('a.id', $idd, '1')->get()->getResultArray();
    }

    function simpandatatender($postData)
    {
        $idQNS = session('idadmin');

        //THBL TGL BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_undangan = date('Y-m-d', strtotime($postData['tgl_undangan']));
        //ambil no urut terakhir//
        //THBL123//

        $QN2 = $this->db->query("SELECT max(kode) as masKode2 FROM data_marketing order by kode");
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
            $kode2 = 'MKT' . $tahun2 . $bln2 . '-' . sprintf("%05s", $noUrut2);
        } else {
            $kode2 = 'MKT' . $tahun2 . $bln2 . '-' . '00001';
        }
        $id12 = 'MKT' . md5($kode2);
        $id22 = 'MKT' . hash("sha1", $id12) . 'QNS';

        $listMKT = array(
            'id_marketing' => $id22,
            'kode' => $kode2,
            'no_list' => $postData['no_list'],
            'divisi' => $postData['divisi'],
            'lingkup' => $postData['lingkup'],
            'nama_proyek' => $postData['nama_proyek'],
            'tgl_undangan' => $tgl_undangan,
            'harga_penawaran' => 0,
            'admin_teknis' => 0,
        );
        $this->db->table("data_marketing")->insert($listMKT);



        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");


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



        $layar = 'MARKETING,TENDER:Tambah Data';
        $aksi = 'ID TENDER:' . $postData['no_list'] . ' (Nama:' . $postData['nama_proyek'] . ')';
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

    public function updatedatamkt_1($postData)
    {
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        if ($postData['tgl_undangan'] > 0) {
            $tgl_undangan = date('Y-m-d', strtotime($postData['tgl_undangan']));
        } else {
            $tgl_undangan = null;
        }
        if ($postData['tgl_pq'] > 0) {
            $tgl_pq = date('Y-m-d', strtotime($postData['tgl_pq']));
        } else {
            $tgl_pq = null;
        }
        if ($postData['tgl_pq_r'] > 0) {
            $tgl_pq_r = date('Y-m-d', strtotime($postData['tgl_pq_r']));
        } else {
            $tgl_pq_r = null;
        }
        if ($postData['tgl_awz'] > 0) {
            $tgl_awz = date('Y-m-d', strtotime($postData['tgl_awz']));
        } else {
            $tgl_awz = null;
        }
        if ($postData['tgl_awz_r'] > 0) {
            $tgl_awz_r = date('Y-m-d', strtotime($postData['tgl_awz_r']));
        } else {
            $tgl_awz_r = null;
        }
        if ($postData['tgl_admin'] > 0) {
            $tgl_admin = date('Y-m-d', strtotime($postData['tgl_admin']));
        } else {
            $tgl_admin = null;
        }
        if ($postData['tgl_admin_r'] > 0) {
            $tgl_admin_r = date('Y-m-d', strtotime($postData['tgl_admin_r']));
        } else {
            $tgl_admin_r = null;
        }
        if ($postData['tgl_per_mkt'] > 0) {
            $tgl_per_mkt = date('Y-m-d', strtotime($postData['tgl_per_mkt']));
        } else {
            $tgl_per_mkt = null;
        }
        if ($postData['tgl_per_mkt_r'] > 0) {
            $tgl_per_mkt_r = date('Y-m-d', strtotime($postData['tgl_per_mkt_r']));
        } else {
            $tgl_per_mkt_r = null;
        }
        if ($postData['tgl_per_ops'] > 0) {
            $tgl_per_ops = date('Y-m-d', strtotime($postData['tgl_per_ops']));
        } else {
            $tgl_per_ops = null;
        }
        if ($postData['tgl_per_ops_r'] > 0) {
            $tgl_per_ops_r = date('Y-m-d', strtotime($postData['tgl_per_ops_r']));
        } else {
            $tgl_per_ops_r = null;
        }
        if ($postData['tgl_per_sdm'] > 0) {
            $tgl_per_sdm = date('Y-m-d', strtotime($postData['tgl_per_sdm']));
        } else {
            $tgl_per_sdm = null;
        }
        if ($postData['tgl_per_sdm_r'] > 0) {
            $tgl_per_sdm_r = date('Y-m-d', strtotime($postData['tgl_per_sdm_r']));
        } else {
            $tgl_per_sdm_r = null;
        }
        if ($postData['tgl_per_form'] > 0) {
            $tgl_per_form = date('Y-m-d', strtotime($postData['tgl_per_form']));
        } else {
            $tgl_per_form = null;
        }
        if ($postData['tgl_per_form_r'] > 0) {
            $tgl_per_form_r = date('Y-m-d', strtotime($postData['tgl_per_form_r']));
        } else {
            $tgl_per_form_r = null;
        }
        if ($postData['tgl_harga'] > 0) {
            $tgl_harga = date('Y-m-d', strtotime($postData['tgl_harga']));
        } else {
            $tgl_harga = null;
        }
        if ($postData['tgl_harga_r'] > 0) {
            $tgl_harga_r = date('Y-m-d', strtotime($postData['tgl_harga_r']));
        } else {
            $tgl_harga_r = null;
        }
        if ($postData['tgl_teknis'] > 0) {
            $tgl_teknis = date('Y-m-d', strtotime($postData['tgl_teknis']));
        } else {
            $tgl_teknis = null;
        }
        if ($postData['tgl_teknis_r'] > 0) {
            $tgl_teknis_r = date('Y-m-d', strtotime($postData['tgl_teknis_r']));
        } else {
            $tgl_teknis_r = null;
        }
        if ($postData['tgl_pemasukan'] > 0) {
            $tgl_pemasukan = date('Y-m-d', strtotime($postData['tgl_pemasukan']));
        } else {
            $tgl_pemasukan = null;
        }
        if ($postData['tgl_pemasukan_r'] > 0) {
            $tgl_pemasukan_r = date('Y-m-d', strtotime($postData['tgl_pemasukan_r']));
        } else {
            $tgl_pemasukan_r = null;
        }
        if ($postData['tgl_presentasi'] > 0) {
            $tgl_presentasi = date('Y-m-d', strtotime($postData['tgl_presentasi']));
        } else {
            $tgl_presentasi = null;
        }
        if ($postData['tgl_presentasi_r'] > 0) {
            $tgl_presentasi_r = date('Y-m-d', strtotime($postData['tgl_presentasi_r']));
        } else {
            $tgl_presentasi_r = null;
        }
        if ($postData['tgl_draft'] > 0) {
            $tgl_draft = date('Y-m-d', strtotime($postData['tgl_draft']));
        } else {
            $tgl_draft = null;
        }
        if ($postData['tgl_ttd'] > 0) {
            $tgl_ttd = date('Y-m-d', strtotime($postData['tgl_ttd']));
        } else {
            $tgl_ttd = null;
        }
        if ($postData['tgl_memo'] > 0) {
            $tgl_memo = date('Y-m-d', strtotime($postData['tgl_memo']));
        } else {
            $tgl_memo = null;
        }

        $data3 = array(
            "no_list" => $postData["no_list"],
            "divisi" => $postData["divisi"],
            "lingkup" => $postData["lingkup"],
            "nama_proyek" => $postData["nama_proyek"],
            "tgl_undangan" => $tgl_undangan,
            "tgl_pq" => $tgl_pq,
            "tgl_awz" => $tgl_awz,
            "tgl_admin" => $tgl_admin,
            "tgl_per_mkt" => $tgl_per_mkt,
            "tgl_per_ops" => $tgl_per_ops,
            "tgl_per_sdm" => $tgl_per_sdm,
            "tgl_per_form" => $tgl_per_form,
            "tgl_harga" => $tgl_harga,
            "tgl_teknis" => $tgl_teknis,
            "tgl_pemasukan" => $tgl_pemasukan,
            "tgl_presentasi" => $tgl_presentasi,
            "tgl_pq_r" => $tgl_pq_r,
            "tgl_awz_r" => $tgl_awz_r,
            "tgl_admin_r" => $tgl_admin_r,
            "tgl_per_mkt_r" => $tgl_per_mkt_r,
            "tgl_per_ops_r" => $tgl_per_ops_r,
            "tgl_per_sdm_r" => $tgl_per_sdm_r,
            "tgl_per_form_r" => $tgl_per_form_r,
            "tgl_harga_r" => $tgl_harga_r,
            "tgl_teknis_r" => $tgl_teknis_r,
            "tgl_pemasukan_r" => $tgl_pemasukan_r,
            "tgl_presentasi_r" => $tgl_presentasi_r,
            "pagu" => str_replace(',', '', $postData['pagu']),
            //"harga" => $postData['harga'],
            //"jml_personil" => $postData['jml_personil'],
            "admin_teknis" => str_replace(',', '', $postData['nilai_admin']),
            "harga_evaluasi" => str_replace(',', '', $postData['evaluasi_harga']),
            "menang" => $postData['menang'],
            "peringkat" => $postData['peringkat'],
            "keterangan" => $postData['keterangan'],
            "nama_kontrak" => $postData["nama_kontrak"],
            "no_spk" => $postData["no_spk"],
            "no_pkp" => $postData["no_pkp"],
            "tgl_draft" => $tgl_draft,
            "tgl_ttd" => $tgl_ttd,
            "tgl_memo" => $tgl_memo,
            "tgl_ubah" => $now,
            "id_ubah" => $idQNS,

        );
        if ($postData['clear'] == 'OK') {
            return $this->db->table('data_marketing')->where('id_marketing', $postData['idd'])->delete();
        } else {
            return $this->db->table('data_marketing')->where('id_marketing', $postData['idd'])->update($data3);

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

            $layar = 'Data,MKT:Update Data TENDER';
            $aksi = ' (Nama:' . $postData['no_list'] . ')';
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
    }

    function simpandataaddendum($postData)
    {
        $idQNS = session('idadmin');

        //THBL TGL BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $tgl_ba_surat = date('Y-m-d', strtotime($postData['tgl_ba_surat']));
        //ambil no urut terakhir//
        //THBL123//

        $QN2 = $this->db->query("SELECT max(kode) as masKode2 FROM addendum order by kode");
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
            $kode2 = 'ADD' . $tahun2 . $bln2 . '-' . sprintf("%05s", $noUrut2);
        } else {
            $kode2 = 'ADD' . $tahun2 . $bln2 . '-' . '00001';
        }
        $id12 = 'ADD' . md5($kode2);
        $id22 = 'ADD' . hash("sha1", $id12) . 'QNS';

        $listMKT = array(
            'id_addendum' => $id22,
            'kode' => $kode2,
            'id_marketing' => $postData['id_marketing'],
            'addendum_ke' => $postData['addendum_ke'],
            'tgl_ba_surat' => $tgl_ba_surat,

        );
        $this->db->table('addendum')->insert($listMKT);
        //UPDATE ke marketing
        $array = array(
            'addendum_ke' => $postData['addendum_ke'],
            'tgl_addendum' => $tgl_ba_surat,

        );
        $this->db->table('data_marketing')->where('id_marketing', $postData['id_marketing'])->update($array);

        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");


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



        $layar = 'MARKETING,ADDENDUM:Tambah Data';
        $aksi = 'ID ADDENDUM:' . $kode2 . 'TGL BA/SURAT: ' . $tgl_ba_surat;
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

    public function updatedataaddendum_1($postData)
    {
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        if ($postData['tgl_ba_surat'] > 0) {
            $tgl_ba_surat = date('Y-m-d', strtotime($postData['tgl_ba_surat']));
        } else {
            $tgl_ba_surat = null;
        }
        if ($postData['tgl_sph'] > 0) {
            $tgl_sph = date('Y-m-d', strtotime($postData['tgl_sph']));
        } else {
            $tgl_sph = null;
        }
        if ($postData['tgl_nego'] > 0) {
            $tgl_nego = date('Y-m-d', strtotime($postData['tgl_nego']));
        } else {
            $tgl_nego = null;
        }
        if ($postData['tgl_draft'] > 0) {
            $tgl_draft = date('Y-m-d', strtotime($postData['tgl_draft']));
        } else {
            $tgl_draft = null;
        }
        if ($postData['tgl_sper'] > 0) {
            $tgl_sper = date('Y-m-d', strtotime($postData['tgl_sper']));
        } else {
            $tgl_sper = null;
        }

        $data3 = array(
            "tgl_ba_surat" => $tgl_ba_surat,
            "tgl_sph" => $tgl_sph,
            "tgl_nego" => $tgl_nego,
            "tgl_draft" => $tgl_draft,
            "tgl_sper" => $tgl_sper,
            "tgl_ubah" => $now,
            "id_ubah" => $idQNS,
        );
        $this->db->table('addendum')->where('id_addendum', $postData['idd'])->update($data3);

        $data4 = array(
            "tgl_addendum" => $now,
        );
        $this->db->table('data_marketing')->where('id_marketing', $postData['idd'])->update($data4);

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

        $layar = 'Data,MKT:Update Data ADDENDUM';
        $aksi = ' (ID:' . $postData['idd'] . ')';
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


    public function updatedataaddendum_2($postData)
    {
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        
        if ($postData['tgl_mulai'] > 0) {
            $tgl_mulai = date('Y-m-d', strtotime($postData['tgl_mulai']));
        } else {
            $tgl_mulai = null;
        }
        if ($postData['tgl_selesai'] > 0) {
            $tgl_selesai = date('Y-m-d', strtotime($postData['tgl_selesai']));
            $proses_add = '';
        } else {
            $tgl_selesai = null;
            $proses_add = 'P';
        }
        if ($postData['tgl_jaminan'] > 0) {
            $tgl_jaminan = date('Y-m-d', strtotime($postData['tgl_jaminan']));
        } else {
            $tgl_jaminan = null;
        }

        $data3 = array(
            "tgl_mulai" => $tgl_mulai,
            "tgl_selesai" => $tgl_selesai,
            "tgl_jaminan" => $tgl_jaminan,
            "harga" => $postData['harga'],
            "ppn" => $postData['ppn'],
            "nett_porsi" => str_replace(',', '', $postData['nett_porsi']),
            "nett_porsi_kso" => $postData['nett_porsi_kso'],
            "nilai_jaminan" => $postData['nilai_jaminan'],
            "tgl_ubah" => $now,
            "id_ubah" => $idQNS,
        );
        $this->db->table('addendum')->where('id_addendum', $postData['idd'])->update($data3);

        $data4 = array(
            "tgl_addendum" => $now,
            "tgl_finish_all" => date('Y-m-d', strtotime($postData['tgl_selesai'])),
            "proses_add" => $proses_add,
	    "tgl_finish_upd" => date('Y-m-d', strtotime($postData['tgl_selesai']))
        );

        $this->db->table('data_marketing')->where('id_marketing', $postData['id_marketing'])->update($data4);

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

        $layar = 'Data,MKT:Update Data KONT ADD';
        $aksi = ' (ID:' . $postData['idd'] . ')';
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
        return $this->db->table("log")->insert($array22);
    }



    function hapusdataaddendum($postData)
    {
        $idQNS = session('idadmin');
        $id_addendum = $postData['idd'];

        $YS = $this->db->query("SELECT * FROM addendum where id_addendum='$id_addendum' ");
        foreach ($YS->getResult() as $rys) {
            $id_marketing = $rys->id_marketing;
            $add_ke = $rys->addendum_ke;
        }

        $YS2 = $this->db->query("SELECT * FROM data_marketing where id_marketing='$id_marketing' ");
        foreach ($YS2->getResult() as $rys2) {
            $nama_proyek = $rys2->nama_proyek;
        }

        //ADD LOG BP//
        //THBL TGL BERJALAN DAN JAM BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");

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

        $layar = 'MARKETING,ADDENDUM:Hapus Data';
        $aksi = 'ADDENDUM KE:' . $add_ke . 'PROYEK: ' . $nama_proyek;
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
        $this->db->table("log")->insert($array22);

        //hapus data addendum
        $idd = $postData['idd'];
        return $this->db->table('addendum')->where('id_addendum', $idd)->delete();
    }


    public function updatedatamkt_3($postData)
    {
        $idQNS = session('idadmin');
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");

        if ($postData['tgl_start'] > 0) {
            $tgl_start = date('Y-m-d', strtotime($postData['tgl_start']));
        } else {
            $tgl_start = null;
        }
        if ($postData['tgl_finish'] > 0) {
            $tgl_finish = date('Y-m-d', strtotime($postData['tgl_finish']));
        } else {
            $tgl_finish = null;
        }
        if ($postData['jaminan_tgl'] > 0) {
            $jaminan_tgl = date('Y-m-d', strtotime($postData['jaminan_tgl']));
        } else {
            $jaminan_tgl = null;
        }
        if ($postData['tgl_selesai_kont'] > 0) {
            $tgl_selesai_kont = date('Y-m-d', strtotime($postData['tgl_selesai_kont']));
        } else {
            $tgl_selesai_kont = null;
        }

        $data3 = array(
            "jaminan_nilai" => str_replace(',', '', $postData['jaminan_nilai']),
            "harga_penawaran" => str_replace(',', '', $postData['harga_penawaran']),
            "nett_porsi" => str_replace(',', '', $postData['nett_porsi']),
            "nett_porsi_kso" => $postData["nett_porsi_kso"],
            "ppn" => $postData["ppn"],
            "bast_1" => $postData["bast_1"],
            "bast_1" => $postData["bast_1"],
            "bast_2" => $postData["bast_2"],
            "surat_ref" => $postData["surat_ref"],
            "tgl_start" => $tgl_start,
            "tgl_finish" => $tgl_finish,
            "tgl_finish_all" => $tgl_finish,
            "jaminan_tgl" => $jaminan_tgl,
            "tgl_ubah" => $now,
            "id_ubah" => $idQNS,
            "tgl_selesai_kont" => $tgl_selesai_kont,
        );
        $this->db->table('data_marketing')->where('id_marketing', $postData['idd'])->update($data3);
        ;



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

        $layar = 'Data,MKT:Update Data Marketing';
        $aksi = ' (LIST:' . $postData['no_list'] . ')';
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
        return $this->db->table("log")->insert($array22);
    }
    public function getProyekQs()
    {
        // Query untuk mengambil proyek QS
        $query = $this->db->table('master_pkp')->where('qs', 'QS')
            ->orderBy('update_qs')
            ->get();

        return $query->getResult(); // Mengembalikan hasil query dalam bentuk array objek
    }
    public function getPdfQsByIdPkp($id_pkp)
    {
        // Query untuk mengambil data PDF QS berdasarkan id_pkp
        return $this->db->query("SELECT * FROM pdf_qs WHERE id_pkp = ?", [$id_pkp])->getResult();
    }
    
        public function cekusernrp($postData)
    {
        $array = ['username' => $postData['no_nrp'], 'username' => $postData['no_nrp']];
        return $this->db->table('master_admin')->where($array)->countAllResults();
    }



}
