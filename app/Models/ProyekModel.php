<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use Config\Services;

class ProyekModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'master_pkp';
    protected $primaryKey = 'id_pkp';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        "kode",
        "id_instansi",
        "no_pkp",
        "proyek",
        "alias",
        "dtu_nama",
        "dtu_pemilik",
        "dtu_jenis",
        "dtu_lokasi",
        "dtu_periode",
        "foto",
        "tgl_mulai",
        "tgl_selesai",
        "id_kapro",
        "id_admin",
        "alamat",
        "kota",
        "telp_proyek",
        "email_proyek",
        "keterangan",
        "status",
        "status_proyek",
        "kunci",
        "tgl_ubah",
        "id_ubah",
        "tgl_ubah_dtu",
        "file_dtu",
        "id_solusi",
        "tgl_ubah_masalah",
        "id_dcr",
        "tgl_awal_dcr",
        "tgl_ubah_dcr",
        "tgl_ubah_gbr",
        "tgl_ubah_dtt",
        "tgl_ubah_progress",
        "tgl_ubah_absensi",
        "tgl_ubah_inventaris",
        "tgl_close",
        "warning",
        "late",
        "qr_bp",
        "acc_bp",
        "ijin_kadiv",
        "ijin_kadirat",
        "validasi_kapro",
        "nilai_jaminan",
        "tgl_jaminan",
        "bast_1",
        "bast_2",
        "referensi",
        "qs",
        "periode_akhir",
        "update_qs"
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];



    public function option_bulan($id_pkp, $tahun)
    {
        $builder = $this->db->table('progress_paket');
        $builder->select('bulan');
        $builder->where('id_pkp', $id_pkp);
        $builder->where('tahun', $tahun);
        $builder->distinct();
        $builder->orderBy('bulan', 'ASC');

        return $builder->get()->getResult();
    }
    public function option_tahun($id_pkp)
    {
        $builder = $this->db->table('progress_paket');

        $builder->select('tahun');
        $builder->where('id_pkp', $id_pkp);
        $builder->orderBy('tahun', 'ASC');
        $builder->distinct();
        $builder->groupBy('tahun', 'ASC');

        return $builder->get()->getResult();
    }


    public function view_progress_proyek($tahun, $bulan, $id_pkp, $id_progress_proyek)
    {
        $query = $this->db->table("progress_proyek a")
            ->select("a.bulan,a.tahun,b.proyek,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,a.tgl_ubah_progress")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $id_pkp)
            ->where('a.id', $id_progress_proyek);

        if (!empty($tahun) && !empty($bulan)) {
            $query->where("a.bulan", $bulan)
                ->where("a.tahun", $tahun);
        }

        $result = $query->get()->getResult();
        return $result;

    }


    public function view_progress_paket($tahun, $bulan, $id_pkp)
    {
        $builder = $this->db->table("progress_paket a");
        $builder->select("a.tahun, a.tgl_sadd,a.tgl_fadd,a.bulan,a.kode_pt,b.proyek,a.paket,a.id_pkp,a.bobot_pg,a.rensd_mgll,a.rilsd_mgll,a.devsd_mgll,a.ren_mgini,a.ril_mgini,a.dev_mgini,a.rensd_mgini,a.rilsd_mgini,a.devsd_mgini,a.sisa_bobotpg,a.tgl_mulai,a.tgl_selesai,a.sisa_waktu,a.target_minggu,d.alias,a.keterangan");
        $builder->join('master_pkp b', 'a.id_pkp = b.id_pkp');
        $builder->join('pt_detil c', 'a.id_pt = c.id', 'left');
        $builder->join('pt_master d', 'c.id_pt = d.id', 'left');
        $builder->where('a.id_pkp', $id_pkp);
        $builder->distinct();

        if (!empty($tahun) && !empty($bulan)) {
            $builder->where("a.bulan", $bulan)
                ->where("a.tahun", $tahun);
        }

        $result = $builder->get()->getResult();
        return $result;

    }


    public function getFilteredData($tahun = null, $bulan = null)
    {
        $builder = $this->db->table("solusi a")
            ->select('*');

        if (!empty($tahun) && !empty($bulan)) {
            $builder->where("YEAR(tgl_ubah)", $tahun)
                ->where("MONTH(tgl_ubah)", $bulan);
        } else {
            // Jika tidak ada filter, tampilkan data saat ini
            $builder->where("YEAR(tgl_ubah)", date('Y'))
                ->where("MONTH(tgl_ubah)", date('m'));
        }

        return $builder->get()->getResult();
    }

    public function view_progress_solusi($tahun, $bulan, $id_pkp)
    {
        $query = $this->db->table("solusi a")
            ->select("a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target,a.nama_kontraktor,a.nama_paket,a.status,a.lampiran,a.kode")
            ->where('a.id_pkp', $id_pkp)
            ->where('a.type', 'EKS')
            ->orderBy('a.nomor', 'ASC');

        if (!empty($tahun) && !empty($bulan)) {
            $query->where("MONTH(a.tgl_ubah)", $bulan)
                ->where("YEAR(a.tgl_ubah)", $tahun);
        }

        $result = $query->get()->getResult();
        return $result;
    }

    public function view_progress_solusi2($tahun, $bulan, $id_pkp)
    {
        $query = $this->db->table("solusi a")
            ->select("a.nomor,a.type,a.masalah,a.penyebab,a.dampak,a.solusi,a.pic,a.target,a.nama_kontraktor,a.nama_paket,a.status,a.lampiran,a.kode")
            ->where('a.id_pkp', $id_pkp)
            ->where('a.type', 'INT')
            ->orderBy('a.nomor', 'ASC');

        if (!empty($tahun) && !empty($bulan)) {
            $query->where("MONTH(a.tgl_ubah)", $bulan)
                ->where("YEAR(a.tgl_ubah)", $tahun);
        }

        $result = $query->get()->getResult();
        return $result;
    }



    public function view_progress_absensi($tahun, $bulan, $id_pkp)
    {
        $query = $this->db->table('detil_karyawan a')
            ->select('b.sisa_cuti, b.tgl_kontrak, a.kode, a.bulan, a.id_pkp, a.pkp_sebelumnya, a.tahun, b.nama_admin, a.id_user, a.sakit, a.ijin, a.alpha, a.cuti, a.ket_absensi, b.jabatan, a.ket_jabatan, a.tgl_ren_mob, a.tgl_ren_demob, a.tgl_real_mob, a.tgl_real_demob, b.habis_kontrak AS tgl_akhir_kontrak, a.status, a.ket_mobdemob, a.ket_akhir, b.username, d.alias, b.pkp_akhir, b.tgl_respon, a.nama, a.nrp')
            ->join('master_admin b', 'a.nrp = b.username', 'left')
            ->join('master_pkp c', 'a.id_pkp = c.id_pkp', 'left')
            ->join('master_pkp d', 'a.pkp_sebelumnya = d.id_pkp', 'left')
            ->where('a.id_pkp', $id_pkp)
            ->where('a.bulan', $bulan)
            ->where('a.tahun', $tahun)
            ->orderBy('a.kode', 'ASC')
            ->get();
        $result = $query->getResult();
        return $result;
    }


    public function option_bulan_scurve($id_pkp, $tahun)
    {
        $builder = $this->db->table('scurve');
        $builder->select('MONTH(tgl_upd_scurve) as bulan');
        $builder->where('id_pkp', $id_pkp);
        $builder->where('YEAR(tgl_upd_scurve)', $tahun);
        $builder->distinct();
        $builder->orderBy('MONTH(tgl_upd_scurve)', 'ASC');

        return $builder->get()->getResult();
    }

    public function option_bulan_msl($id_pkp, $tahun)
    {
        $builder = $this->db->table('solusi');
        $builder->select('MONTH(tgl_ubah) as bulan');
        $builder->where('id_pkp', $id_pkp);
        $builder->where('YEAR(tgl_ubah)', $tahun);
        $builder->distinct();
        $builder->orderBy('MONTH(tgl_ubah)', 'ASC');

        return $builder->get()->getResult();
    }

    public function option_tahun_msl($id_pkp)
    {

        $builder = $this->db->table('solusi');
        $builder->select('tgl_ubah');
        $builder->distinct();
        $builder->where('id_pkp', $id_pkp);
        $builder->orderBy('YEAR(tgl_ubah)', 'ASC');

        return $builder->get()->getResult();
    }


    public function option_tahun_absensi($id_pkp)
    {

        $builder = $this->db->table('detil_karyawan');
        $builder->select('tahun');
        $builder->distinct();
        $builder->where('id_pkp', $id_pkp);
        $builder->orderBy('tahun', 'ASC');

        return $builder->get()->getResult();
    }
    public function option_bulan_absensi($id_pkp, $tahun)
    {
        $builder = $this->db->table('detil_karyawan');
        $builder->select('bulan');
        $builder->where('id_pkp', $id_pkp);
        $builder->where('tahun', $tahun);
        $builder->distinct();
        $builder->orderBy('bulan', 'ASC');

        return $builder->get()->getResult();
    }
    public function option_bulan_gbr($id_pkp, $tahun)
    {
        $builder = $this->db->table('gambar');
        $builder->select('MONTH(tgl_ubah) as bulan');
        $builder->where('id_pkp', $id_pkp);
        $builder->where('YEAR(tgl_ubah)', $tahun);
        $builder->distinct();
        $builder->orderBy('MONTH(tgl_ubah)', 'ASC');

        return $builder->get()->getResult();
    }

    public function option_tahun_gbr($id_pkp)
    {

        $builder = $this->db->table('gambar');
        $builder->select('YEAR(tgl_ubah) as tahun');
        $builder->distinct();
        $builder->where('id_pkp', $id_pkp);
        $builder->orderBy('YEAR(tgl_ubah)', 'ASC');

        return $builder->get()->getResult();
    }

    public function view_progress_gambar($tahun, $bulan, $id_pkp)
    {
        $query = $this->db->table("gambar a")
            ->select("a.tgl_ubah,a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5")
            ->where('a.id_pkp', $id_pkp)
            ->orderBy("a.kode", "desc");

        if (!empty($tahun) && !empty($bulan)) {
            $query->where("MONTH(a.tgl_ubah)", $bulan)
                ->where("YEAR(a.tgl_ubah)", $tahun);
        }
        return $query->get(); // Return the query result object
    }


    public function view_scurve_paket($tahun, $bulan, $id_pkp, $nama_paket)
    {
        $query = $this->db->table('scurve')
            ->select('*')
            ->where('id_pkp', $id_pkp)
            ->where('nama_paket', $nama_paket)
            ->orderBy('id', 'DESC');

        if (!empty($tahun) && !empty($bulan)) {
            $query->where("MONTH(tgl_upd_scurve)", $bulan)
                ->where("YEAR(tgl_upd_scurve)", $tahun);
        }
        return $query->get(); // Return the query result object
    }


    public function getAllPKP()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '511')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratPKP()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '511')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiPKP($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '511')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekPKP($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '511')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getAllPKP2()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratPKP2()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiPKP2($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekPKP2($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }



    public function getAllPKP3()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratPKP3()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiPKP3($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekPKP3($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '613')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getAllKtlPKP1()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '611')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratKtlPKP1()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '611')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiKtlPKP1($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '611')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekKtlPKP1($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '611')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getAllKtlPKP2()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '612')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratKtlPKP2()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '612')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiKtlPKP2($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '612')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekKtlPKP2($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '612')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getAllTransPKP1()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratTransPKP1()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiTransPKP1($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekTransPKP1($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getAllTransPKP2()
    {
        return $this->db->table("master_pkp a")
            ->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getWakadiratTransPKP2()
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getDivisiTransPKP2($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('b.id', $id_divisi)
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekTransPKP2($pkp_user)
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp, a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_pkp', $pkp_user)
            ->where('b.nomor', '712')
            ->where('a.no_pkp !=', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }



    public function getAllKantorPKP()
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.no_pkp', '000')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekKantorPKP($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.no_pkp', '000')
            ->where('a.id_instansi', $id_divisi)
            ->get() // Perform the query
            ->getResult(); // Return the resul
    }

    public function getAllSemuaPKP()
    {
        // PROYEK
        return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->orderBy('a.no_pkp')
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getProyekSemuaPKP($id_divisi)
    {
        return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")
            ->join('master_instansi b', 'a.id_instansi = b.id')
            ->where('a.id_instansi', $id_divisi)
            ->get() // Perform the query
            ->getResult(); // Return the result
    }

    public function getBukaAkses2($kode_akses)
    {
        return $this->db->table("buka_akses")->select("*")->where('kode', $kode_akses)->get()->getResult();
    }

    public function getBukaAkses22($kode_akses2)
    {
        return $this->db->table("buka_akses")->select("*")->where('kode', $kode_akses2)->get()->getResult();
    }

    public function getInvent1($kode)
    {
        return $this->db->table("inventaris a")
            ->select("a.nomor, a.sn, a.status, a.jns_brng, a.merek, a.spek, a.kondisi, a.pemakai, a.foto, a.kode")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'FURNITURE')
            ->orderBy('a.nomor', 'ASC')->get()->getResult();
    }

    public function getInvent2($kode)
    {
        return $this->db->table("inventaris a")
            ->select("a.nomor, a.sn, a.status, a.jns_brng, a.merek, a.spek, a.kondisi, a.pemakai, a.foto, a.kode")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'KOMPUTER/ACC')
            ->orderBy('a.nomor', 'ASC')->get()->getResult();
    }

    public function getInvent3($kode)
    {
        return $this->db->table("inventaris a")
            ->select("a.nomor, a.sn, a.status, a.jns_brng, a.merek, a.spek, a.kondisi, a.pemakai, a.foto, a.kode")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.type', 'KENDARAAN')
            ->orderBy('a.nomor', 'ASC')->get()->getResult();
    }

    public function getGambar($kode)
    {
        return $this->db->table("gambar a")
            ->select("a.gambar1,a.gambar2,a.gambar3,a.gambar4,a.gambar5")
            ->join('master_pkp b', 'a.id_pkp = b.id_pkp')
            ->where('a.id_pkp', $kode)
            ->where('a.tgl_ubah = b.tgl_ubah_gbr')
            ->orderBy("a.kode", "desc")->get();
    }

    public function upload_file($nama_file)
    {
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
    }

    public function input_semua3b($data)
    {
        return $this->db->table('solusi')->insertBatch($data);
    }

    public function simpantglclose($postData)
    {
        //THBL TGL BERJALAN//
        $tgl_mutasi2 = $postData['tgl_close'];
        $tgl_mutasi = date('Y-m-d', strtotime($tgl_mutasi2));


        $dataend = [
            "tgl_close" => $tgl_mutasi,
        ];
        return $this->db->table('master_pkp')->where('id_pkp', $postData['id_pkp'])->update($dataend);
    }

    public function simpandatadtu($id_pkp, $files)
    {
        helper(['form', 'url']);
        $db = db_connect();

        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");

        // Fetch data from database
        $masterPKP = $this->where('id_pkp', $id_pkp)->first();
        $no_pkp = $masterPKP['no_pkp'];
        $id_instansi = $masterPKP['id_instansi'];

        $masterInstansiModel = new MasterInstansiModel(); // Assume you have this model
        $masterInstansi = $masterInstansiModel->find($id_instansi);
        $no_instansi = $masterInstansi['nomor'];

        $lokasi = WRITEPATH . 'assets/' . $no_instansi . '/' . $no_pkp;

        if ($files) {
            $u = 1;
            foreach ($files['berkas'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = 'dtu' . $no_pkp . '_' . $u . '.' . $file->getExtension();
                    $file->move($lokasi, $newName);

                    if ($u == 1) {
                        $this->update($id_pkp, ['file_dtu' => $lokasi . '/' . $newName]);
                    }
                    $u++;
                }
            }
        }

        return $this->update($id_pkp, ['tgl_ubah_dtu' => $now]);
    }

    public function get_pkp_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '511')->where('a.no_pkp !=', '000')->get()->getResult();
        } else {
            //WAKADIRAT (DENNIS)
            if ($isi->username == '10288') {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '511')->where('a.no_pkp !=', '000')->get()->getResult();
            } else {
                //DIVISI
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '511')->where('a.no_pkp !=', '000')->get()->getResult();
                } else {
                    //PROYEK
                    return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '511')->where('a.no_pkp !=', '000')->get()->getResult();
                }
            }
        }
    }

    public function count_filtered_datatable_pkp()
    {
        return count($this->get_pkp_datatable());
    }

    public function count_all_datatable_pkp()
    {
        return $this->db->table('master_pkp')->countAllResults();
    }

    public function get_pkp2_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '512')->where('a.no_pkp !=', '000')->get()->getResult();
        } else {
            //WAKADIRAT (DENNIS)
            if ($isi->username == '10288') {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '512')->where('a.no_pkp !=', '000')->get()->getResult();
            } else {
                //DIVISI
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '512')->where('a.no_pkp !=', '000')->get()->getResult();
                    ;
                } else {
                    //PROYEK
                    return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '512')->where('a.no_pkp !=', '000')->get()->getResult();
                    ;
                }
            }
        }
    }
    public function count_filtered_datatable_pkp2()
    {
        return count($this->get_pkp2_datatable());
    }

    public function get_pkp3_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '613')->where('a.no_pkp !=', '000')->get()->getResult();
            ;
        } else {
            //WAKADIRAT (DENNIS)
            if ($isi->username == '10288') {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '613')->where('a.no_pkp !=', '000')->get()->getResult();
                ;
            } else {
                //DIVISI
                if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                    return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '613')->where('a.no_pkp !=', '000')->get()->getResult();
                    ;
                } else {
                    //PROYEK
                    return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '613')->where('a.no_pkp !=', '000')->get()->getResult();
                    ;
                }
            }
        }
    }


    public function count_filtered_datatable_pkp3()
    {
        return count($this->get_pkp3_datatable());
    }

    public function get_pkp4_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '611')->where('a.no_pkp !=', '000')->get()->getResult();
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '611')->where('a.no_pkp !=', '000')->get()->getResult();
            } else {
                //PROYEK
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '611')->where('a.no_pkp !=', '000')->get()->getResult();
            }
        }

    }

    public function count_filtered_datatable_pkp4()
    {
        return count($this->get_pkp4_datatable());
    }


    public function get_pkp4b_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '612')->where('a.no_pkp !=', '000')->get()->getResult();
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '612')->where('a.no_pkp !=', '000')->get()->getResult();
            } else {
                //PROYEK
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '612')->where('a.no_pkp !=', '000')->get()->getResult();
            }
        }

    }

    public function count_filtered_datatable_pkp4b()
    {
        return count($this->get_pkp4b_datatable());
    }


    public function get_pkp5_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '711')->where('a.no_pkp !=', '000')->get()->getResult();
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '711')->where('a.no_pkp !=', '000')->get()->getResult();
                ;
            } else {
                //PROYEK
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '711')->where('a.no_pkp !=', '000')->get()->getResult();
                ;
            }
        }

    }

    public function count_filtered_datatable_pkp5()
    {
        return count($this->get_pkp5_datatable());
    }

    public function get_pkp5b_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.nomor', '712')->where('a.no_pkp !=', '000')->get()->getResult();
        } else {
            //DIVISI
            if (level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) {
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('b.id', $id_divisi)->where('b.nomor', '712')->where('a.no_pkp !=', '000')->get()->getResult();
            } else {
                //PROYEK
                return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_pkp', $pkp_user)->where('b.nomor', '712')->where('a.no_pkp !=', '000')->get()->getResult();
            }
        }


    }

    public function count_filtered_datatable_pkp5b()
    {
        return count($this->get_pkp5b_datatable());
    }


    public function get_pkp6_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.no_pkp', '000')->get()->getResult();
        } else {

            //PROYEK
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.no_pkp', '000')->where('a.id_instansi', $id_divisi)->get()->getResult();
        }


    }

    public function count_filtered_datatable_pkp6()
    {
        return count($this->get_pkp6_datatable());
    }


    public function get_pkp7_datatable()
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
        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->orderBy('a.no_pkp')->get()->getResult();
        } else {
            //PROYEK
            return $this->db->table("master_pkp a")->select("a.id_pkp,a.tgl_ubah_progress, a.alias, a.no_pkp, a.proyek, a.status, a.id_instansi, a.tgl_ubah, a.kunci, b.id, b.nomor, b.nama")->join('master_instansi b', 'a.id_instansi = b.id')->where('a.id_instansi', $id_divisi)->get()->getResult();
        }



    }

    public function count_filtered_datatable_pkp7()
    {
        return count($this->get_pkp7_datatable());
    }


    public function input_semua($data)
    {
        return $this->db->table('progress_invoice')->insertBatch($data);
    }


    function simpandatainvoice($postData)
    {
        //THBL TGL BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $jam = date("H:i:s");
        $idQNS = session('idadmin');
        $agent = $postData['agent'];

        // Get the maximum existing 'kode' from the database
        $query = $this->db->query("SELECT MAX(kode) as maxKode FROM progress_invoice");
        $row = $query->getRow();
        $order = $row->maxKode;

        // Extract information for generating unique 'kode'
        $noUrut = (int) substr($order, 10); // Extract the numerical part of the code
        $bulanL = substr($order, 5, 2);
        $bln = substr($now, 5, 2);
        $tahun = substr($now, 2, 2);

        // Check if it's a new month, reset the counter if so
        if ($bln != $bulanL) {
            $noUrut = 0;
        }

        // Increment the counter
        $noUrut++;

        // Generate the new invoice code
        $kode = 'INV' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);

        $id1 = 'INV' . md5($kode) . 'QNS';
        $id2 = 'INV' . hash("sha1", $id1) . 'QNS';

        $array = [
            'id' => $id1,
            'kode' => $kode,
            'periode' => $postData["periode"],
            'laporan_progress' => $postData["laporan_progress"],
            'tanggal_bap' => $postData["tanggal_bap"],
            'nominal_bap' => $postData["nominal_bap"],
            'nomor_bap' => $postData["nomor_bap"],
            'id_pkp' => $postData["id_pkp"],
        ];

        return $this->db->table('progress_invoice')->insert($array);
    }

 public function simpanvalidasi_kapro1($postData)
    {
        $id_pkp = $postData["id_pkp"];
        $validasi = $postData["validasi"];
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");

        if ($validasi == 'OK') {
            $dataend = [
                "validasi_kapro" => 1,
                "tgl_validasi" => $now,
            ];
            $this->db->table('progress_proyek')
                     ->where('akhir', 'A')
                     ->where('id_pkp', $id_pkp)
                     ->update($dataend);
        } else {
            // Mengambil data proyek yang sesuai
            $progressProyek = $this->db->table('progress_proyek')
                                       ->where('id_pkp', $id_pkp)
                                       ->where('akhir', 'A')
                                       ->get()
                                       ->getRow();

            if ($progressProyek) {
                $id_progress_p = $progressProyek->id;

                // Hapus data paket
                $this->db->table('progress_paket')
                         ->where('progress_proyek', $id_progress_p)
                         ->delete();

                // Hapus data proyek
                $this->db->table('progress_proyek')
                         ->where('id', $id_progress_p)
                         ->delete();

                // Periksa proyek lainnya dengan id_pkp yang sama
                $remainingProyek = $this->db->table('progress_proyek')
                                            ->where('id_pkp', $id_pkp)
                                            ->get()
                                            ->getResult();

                if (count($remainingProyek) > 0) {
                    // Tandai 'akhir' yang terakhir dengan 'A'
                    $kodemax = $this->db->table('progress_proyek')
                                        ->selectMax('kode')
                                        ->where('id_pkp', $id_pkp)
                                        ->get()
                                        ->getRow()
                                        ->kodemax;
                    $dataend00 = [
                        "akhir" => 'A',
                    ];

                    $this->db->table('progress_proyek')
                             ->where('kode', $kodemax)
                             ->update($dataend00);
                }
            }
        }

        // Update validasi di tabel master_pkp
        $dataend = [
            "validasi_kapro" => 1,
        ];

        return $this->db->table('master_pkp')
                        ->where('id_pkp', $id_pkp)
                        ->update($dataend);
    }

    function simpanvalidasi_kapro12($postData)
    {
        $id_pkp = $postData["id_pkp"];
        $validasi = $postData["validasi"];
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        //ubah data progress proyek
        if ($validasi == 'OK') {
            $dataend = array(
                "validasi_kapro" => 1,
                "tgl_validasi" => $now,
            );
            $this->db->table('progress_proyek')->where('akhir', 'A')->where('id_pkp', $id_pkp)->update($dataend);
        } else {
            //hapus data paket
            $QNS00 = $this->db->query("SELECT * FROM progress_proyek where id_pkp='$id_pkp' and akhir='A'");
            foreach ($QNS00->getResult() as $row0) {
                $id_progress_p = $row0->id;
            }
            $this->db->table('progress_paket')->where('progress_proyek', $id_progress_p)->delete();
            //hapus data proyek
            $this->db->table('progress_proyek')->where('id', $id_progress_p)->delete();

            $QN0 = $this->db->query("SELECT * FROM progress_proyek where id_pkp='$id_pkp' ");
            if ($QN0->getNumRows() > 0) {

                //tandai A yang terakhir 
                $QNS1 = $this->db->query("SELECT max(kode) as kodemax FROM progress_proyek where id_pkp='$id_pkp' order by kode");
                foreach ($QNS1->getResult() as $row1) {
                    $kode = $row1->kodemax;
                }
                $dataend00 = array(
                    "akhir" => 'A',
                );
                $this->db->table('progress_proyek')->where('kode', $kode)->update($dataend00);
            }
        }
        //update tanda2 validasi di PKP
        $dataend = array(
            "validasi_kapro" => 1,
        );
        return $this->db->table('master_pkp')->where('id_pkp', $id_pkp)->update($dataend);
    }

    public function input_semua3m($data)
    {
        return $this->db->table('progress_paket')->insertBatch($data);
    }
    public function input_semua3mm($data)
    {
        return $this->db->table('file_migrasi')->insertBatch($data);
    }


    public function hapusdatamon_1($postData)
    {
        return $this->db->table('file_migrasi')->where('tipe', 'DT_KR')->where('id_pkp', $postData['id_pkp58'])->delete();
    }
    public function simpandatamon_1($postData)
    {
        $id_pkp = $postData['id_pkp58'];
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        $bln_lalu = date('m', strtotime('-1 month', strtotime($now)));
        $thn_lalu = date('Y', strtotime('-1 month', strtotime($now)));
        //Menghapus DATA YANG SAMA 

        $QN0 = $this->db->query("SELECT * FROM detil_karyawan where id_pkp='$id_pkp' and tahun='$thn_lalu' and bulan='$bln_lalu' ");
        if ($QN0->getNumRows() > 0) {
            $this->db->table('detil_karyawan')->where('id_pkp', $id_pkp)->where('tahun', $thn_lalu)->where('bulan', $bln_lalu)->delete();
        }
        $QN = $this->db->query("SELECT * FROM file_migrasi where tipe='DT_KR' and id_pkp='$id_pkp' order by kode");
        foreach ($QN->getResult() as $row) {
            //add detil_karyawan
            $QN = $this->db->query("SELECT max(kode) as masKode FROM detil_karyawan order by kode");
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
                $kode = 'DKY' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
            } else {
                $kode = 'DKY' . $tahun . $bln . '-' . '00001';
            }
            $id1 = 'DKY' . md5($kode);
            $id2 = 'DKY' . hash("sha1", $id1) . 'QNS';

if ($row->ket_1 != '') {
    $nrp = $row->ket_1;
    $QNS01 = $this->db->query("SELECT * FROM master_admin where username='$nrp' ");
    if ($QNS01->getNumRows() > 0) {
        $id_admin = $QNS01->getRow()->id;
        $pkp_sebelumnya = $QNS01->getRow()->pkp_akhir;
    } else {
        $id_admin = $nrp . ' (' . $row->ket_2 . ')';
        $pkp_sebelumnya = ''; // Set a default value here as well
    }
} else {
    $nrp = 'TIDAK DIISI';
    $pkp_sebelumnya = ''; // Default value for $pkp_sebelumnya
}
            $data1 = array(
                'id' => $id2,
                'kode' => $kode,
                'id_pkp' => $id_pkp,
                'pkp_sebelumnya' => $pkp_sebelumnya,
                'id_user' => $id_admin,
                'nrp' => $nrp,
                'nama' => $row->ket_2,
                'tgl_update' => $now,
                'tahun' => $thn_lalu,
                'bulan' => $bln_lalu,
                'sakit' => $row->ket_3,
                'ijin' => $row->ket_4,
                'alpha' => $row->ket_5,
                'cuti' => $row->ket_6,
                'ket_absensi' => $row->ket_7,
                'ket_jabatan' => $row->ket_8,
                'tgl_ren_mob' => $row->tgl_1,
                'tgl_real_mob' => $row->tgl_2,
                'tgl_ren_demob' => $row->tgl_3,
                'tgl_real_demob' => $row->tgl_4,
                'ket_mobdemob' => $row->ket_9,
                'ket_akhir' => $row->ket_10,
            );
            $this->db->table("detil_karyawan")->insert($data1);
        }
        $data5 = array(
            'tgl_ubah_absensi' => $now,
        );
        $this->db->table('master_pkp')->where('id_pkp', $id_pkp)->update($data5);
        return $this->db->table('file_migrasi')->where('id_pkp', $id_pkp)->where('tipe', 'DT_KR')->delete();

    }

    public function getAbsensi($pkp_user)
    {
        $builder = $this->db->table('file_migrasi');
        $builder->select("*");
        $builder->where('id_pkp', $pkp_user);
        $builder->where('tipe', 'DT_KR');
        $builder = $builder->get();
        return $builder->getResult();
    }


    function count_filtered_datatable_import($pkp_user)
    {
        return count($this->getAbsensi($pkp_user));
    }

    public function count_all_datatable_import()
    {
        return $this->db->table('file_migrasi')->countAllResults();
    }

    public function simpandataaddendum($postData)
    {
        //add file buka akses
        //THBL TGL BERJALAN//
        date_default_timezone_set("Asia/Jakarta");
        $now = date("Y-m-d");
        //ambil no urut terakhir//
        //INSTHBL-12345//
        $QN = $this->db->query("SELECT max(kode) as masKode FROM addendum order by kode");
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
            $kode = 'ADD' . $tahun . $bln . '-' . sprintf("%05s", $noUrut);
        } else {
            $kode = 'ADD' . $tahun . $bln . '-' . '00001';
        }
        $id1 = 'ADD' . md5($kode);
        $id2 = 'ADD' . hash("sha1", $id1) . 'QNS';

        if ($postData['tgl_mulai'] != '') {
            $tgl_mulai2 = $postData['tgl_mulai'];
            $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai2));
        } else {
            $tgl_mulai = null;
        }
        if ($postData['tgl_selesai'] != '') {
            $tgl_selesai2 = $postData['tgl_selesai'];
            $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai2));
        } else {
            $tgl_selesai = null;
        }
        if ($postData['tgl_jaminan'] != '') {
            $tgl_jaminan2 = $postData['tgl_jaminan'];
            $tgl_jaminan = date('Y-m-d', strtotime($tgl_jaminan2));
        } else {
            $tgl_jaminan = null;
        }

        $array = array(
            'id_addendum' => $id2,
            'id_pkp' => $postData["id_pkp0"],
            'kode' => $kode,
            "keterangan" => $postData['keterangan'],
            "tgl_mulai" => $tgl_mulai,
            "tgl_selesai" => $tgl_selesai,
            "tgl_jaminan" => $tgl_jaminan,
            "nilai_jaminan" => $postData['nilai_jaminan'],
            "bast_1" => $postData['bast_1'],
            "bast_2" => $postData['bast_2'],
            "referensi" => $postData['referensi'],
        );
        $this->db->table('addendum')->insert($array);
    }


    public function cekaliaspkp($postData)
    {
        if (($postData['alias0'] != $postData['alias'])) {
            $array = array('alias' => $postData['alias']);
        } else {

            $array = array('alias' => 'RAMBO 58');
        }

        return $this->db->table('master_pkp')->where($array)->countAllResults();
    }
    public function ceknamakontrakpkp($postData)
    {
        if (($postData['proyek0'] != $postData['proyek'])) {
            $array = array('proyek' => $postData['proyek']);
        } else {

            $array = array('proyek' => 'RAMBO 58');
        }

        return $this->db->table('master_pkp')->where($array)->countAllResults();
    }

    public function simpandataeditmarketing($postData)
    {
        if ($postData['tgl_mulai'] != '') {
            $tgl_mulai2 = $postData['tgl_mulai'];
            $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai2));
        } else {
            $tgl_mulai = null;
        }
        if ($postData['tgl_selesai'] != '') {
            $tgl_selesai2 = $postData['tgl_selesai'];
            $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai2));
        } else {
            $tgl_selesai = null;
        }
        if ($postData['tgl_jaminan'] != '') {
            $tgl_jaminan2 = $postData['tgl_jaminan'];
            $tgl_jaminan = date('Y-m-d', strtotime($tgl_jaminan2));
        } else {
            $tgl_jaminan = null;
        }
        $datapkp = array(
            "alias" => $postData['alias'],
            "proyek" => $postData['proyek'],
            "tgl_mulai" => $tgl_mulai,
            "tgl_selesai" => $tgl_selesai,
            "tgl_jaminan" => $tgl_jaminan,
            "nilai_jaminan" => $postData['nilai_jaminan'],
            "bast_1" => $postData['bast_1'],
            "bast_2" => $postData['bast_2'],
            "referensi" => $postData['referensi'],
        );
        return $this->db->table('master_pkp')->where('id_pkp', $postData['id_pkp0'])->update($datapkp);
    }

    public function simpantglspk($postData)
    {
        //THBL TGL BERJALAN//
        $tgl_mulai2 = $postData['tgl_mulai'];
        if ($tgl_mulai2 > 0) {
            $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai2));
        } else {
            $tgl_mulai = null;
        }
        $tgl_selesai2 = $postData['tgl_selesai'];
        if ($tgl_selesai2 > 0) {
            $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai2));
        } else {
            $tgl_selesai = null;
        }


        $dataend = array(
            "tgl_mulai" => $tgl_mulai,
            "tgl_selesai" => $tgl_selesai,
            "warning" => $postData["warning"],
            "late" => $postData["late"],
        );
        return $this->db->table('master_pkp')->where('id_pkp', $postData['id_pkp'])->update($dataend);
    }



}
