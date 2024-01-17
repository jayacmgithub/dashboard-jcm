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
            return redirect()->to(base_url());
        } else {
            return view('/login');
        }
    }

    public function authLogin()
    {
        $session = session();
        $validation = \Config\Services::validation();
        $post = $this->request->getPost();
        $username = $post["username"];
        // Set validation rules
        $validation->setRules($this->login->rules());

        // Run validation
        if ($validation->withRequest($this->request)->run() === false) {
            // Validation failed
            $errors = $validation->getErrors();
            $data['errors'] = $errors;
        } else {
            // Validation passed
            // Check if the user account is blocked
            $cek_username = $this->login->where('username', $username)->countAllResults();
            $r = $this->login->where('username', $post["username"])->first();
            if ($r['aktif'] == '0') {
                $errors['username'] = "Akun Anda Terblokir Hubungi Aprhay";
                $data['errors'] = $errors;
            } else {

                if (($cek_username > 0) and password_verify($post["password"], $r['password']) == TRUE) {
                    $session->set('login', true);
                    $session->set('nama_admin', $r['nama_admin']);
                    $session->set('idadmin', $r['id']);
                    $session->set('kategori', $r['kategori']);
                    $kategoriUser = $r['kategori'];
                    $kategori = $this->login->getKategoriUser($kategoriUser);
                    $controller = isset($kategori['controller']) ? $kategori['controller'] : '';
                    $namaFunction = isset($kategori['nama_function']) ? $kategori['nama_function'] : '';
                    $beranda = ($controller == 'index') ? $controller : $controller . '/' . $namaFunction;
                    $session->set('nama_kategori', $kategori['kategori_user']);
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
                    $QN = $this->dashboard->getMaxKode();
                    foreach ($QN as $row) {
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
                    $array = [
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

                    ];
                    $this->log->insert($array);
                } else {
                    $errors['username'] = "No. NRP atau Password salah";
                    $data['errors'] = $errors;
                }
            }
            $data['token'] = csrf_token();
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
