<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use App\Models\DashboardModel;
use App\Models\LogModel;

class Login extends BaseController
{
    public function __construct()
    {

        $this->login = new LoginModel();
        $this->dashboard = new DashboardModel();
        $this->log = new LogModel();
        $this->formValidation = \Config\Services::validation();
        helper(['string', 'security', 'form']);
    }

    public function index()
    {
        if (session('login') == TRUE) {
            return redirect()->to(base_url('dashboard/index'));
        } else {
            return view('/login');
        }
    }

    function authLogin()
    {
        $login = $this->login;
        $validation = [
            'username' => 'required',
            'password' => 'required'
        ];
        if (!$this->validate($validation)) {
            $errorMessages = implode('<br>', $this->validator->getErrors());
            $errors['fail'] = $errorMessages;
            $data['errors'] = $errors;
        } else {
            $post = $this->request->getPost();
            $cek_username = $login->auth_user($post["username"]);
            $r = $cek_username->getRowArray();
            if ($r['aktif'] == '0') {
                $errors['username'] = "Akun Anda Terblokir Hubungi Aprhay";
                $data['errors'] = $errors;
            } else {
                if (($cek_username->getNumRows() > 0) and password_verify($post["password"], $r['password']) == TRUE) {
                    $this->session->set('login', TRUE);
                    $this->session->set('nama_admin', $r['nama_admin']);
                    $this->session->set('idadmin', $r['id']);
                    $this->session->set('kategori', $r['kategori']);

                    $kategori = $this->db->table("kategori_user a")
                        ->select("a.kategori_user, b.controller, b.nama_function")
                        ->join('modul b', 'b.id = a.beranda ')
                        ->where('a.id', $r['kategori'])->get()->getRow();
                    $beranda = $kategori->controller == 'index' ? $kategori->controller : $kategori->controller . "/" . $kategori->nama_function;
                    $this->session->set('nama_kategori', $kategori->kategori_user);
                    $data['success'] = true;
                    $data['message'] = "berhasil login";
                    $data['beranda'] = $beranda;

                    $agent = $this->request->getUserAgent();

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
                    date_default_timezone_set("Asia/Jakarta");
                    $now = date("Y-m-d");
                    $jam = date("H:i:s");
                    //$time = date("h:i:sa");
                    $layar = 'Log IN';
                    $aksi = 'Log IN';
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
                    $array = array(
                        'id_log' => $id2,
                        'kode' => $kode,
                        'id_user' => $r['id'],
                        'ip' => $ip,
                        //mac' => $mac,
                        'host' => $currentAgent,
                        'tgl_log' => $now,
                        'jam_log' => $jam,
                        'layar' => $layar,
                        'aksi' => $aksi,

                    );
                    $this->db->table('log')->insert($array);
                } else {
                    $errors['username'] = "No. NRP atau Password salah";
                    $data['errors'] = $errors;
                }
            }
            $data['token'] = csrf_hash();
            echo json_encode($data);
        }

    }

    public function logout()
    {
        // Assuming you have loaded the session service in your constructor or through autoloading

        // Start the session
        $session = session();

        // Destroy the session
        $session->destroy();

        // Redirect to base URL
        return redirect()->to(base_url());
    }
}
