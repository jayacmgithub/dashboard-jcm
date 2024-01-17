<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/dashboard/index', 'Dashboard::index');
$routes->post('login/auth', 'Login::authLogin');
$routes->get('logout', 'Login::logout');
$routes->get('dashboard/beranda_01', 'Dashboard::beranda_01');
$routes->get('dashboard/beranda_02', 'Dashboard::beranda_02');
$routes->get('dashboard/beranda_03', 'Dashboard::beranda_03');
$routes->get('dashboard/beranda_04', 'Dashboard::beranda_04');
$routes->get('dashboard/beranda_05', 'Dashboard::beranda_05');
$routes->get('dashboard/beranda_06', 'Dashboard::beranda_06');
$routes->get('dashboard/beranda_07', 'Dashboard::beranda_07');

$routes->get('proyek', 'Proyek::index');
$routes->get('proyek/gedung1', 'Proyek::gedung1');
$routes->get('proyek/gedung2', 'Proyek::gedung2');
$routes->get('proyek/gedung3', 'Proyek::gedung3');
$routes->get('proyek/ktl', 'Proyek::ktl1');
$routes->get('proyek/ktl2', 'Proyek::ktl2');
$routes->get('proyek/transportasi', 'Proyek::trans1');
$routes->get('proyek/transportasi2', 'Proyek::trans2');
$routes->get('proyek/kantor', 'Proyek::kantor');
$routes->get('proyek/all', 'Proyek::semua');
$routes->get('proyek/import_mon_kry/(:any)', 'Proyek::import_mon_kry/$1');


$routes->get('laporan', 'Data::index');
$routes->get('laporan/hcm', 'Data::hcm');
$routes->get('laporan/absensi', 'Data::absensi');
$routes->get('laporan/mkt', 'Data::mkt');
$routes->get('laporan/qs', 'Data::qs');
$routes->get('laporan/masalah-qs', 'Data::masalah_qs');
$routes->get('laporan/monitoring-karyawan-qs', 'Data::mon_kar_qs');
$routes->get('laporan/monitoring-dcr-qs', 'Data::mon_dcr_qs');
$routes->get('laporan/import_pembaharuan', 'Data::import_pembaharuan');
$routes->get('laporan/edituser/(:any)', 'Data::edituser/$1');
$routes->post('laporan/useredit_1', 'Data::useredit_1');
$routes->post('laporan/tambahproyekqs', 'Data::tambahproyekqs');
$routes->get('laporan/data_mkt/(:any)', 'Data::data_mkt/$1');
$routes->get('laporan/addendum/(:any)', 'Data::data_addendum/$1');
$routes->get('laporan/marketing/(:any)', 'Data::data_marketing/$1');
$routes->get('laporan/data_umum_mkt/(:any)', 'Data::data_umum_mkt/$1');
$routes->post('laporan/tambahkaryawan', 'Data::tambahkaryawan');
$routes->post('laporan/upload_pembaharuan_1', 'Data::upload_pembaharuan_1');
$routes->post('laporan/upload_karyawan_1', 'Data::upload_karyawan_1');
$routes->get('laporan/dataimport1', 'Data::dataimport1');
$routes->get('laporan/dataimport2', 'Data::dataimport2');
$routes->post('laporan/hapus_pembaharuan_1', 'Data::hapus_pembaharuan_1');
$routes->post('laporan/proses_pembaharuan_1', 'Data::proses_pembaharuan_1');
$routes->post('laporan/mutasi_karyawan', 'Data::mutasi_karyawan');
$routes->get('laporan/import_kry_baru', 'Data::import_kry_baru');


$routes->get('setting', 'Setting::index');
$routes->get('setting/instansi', 'Setting::instansi');
$routes->get('setting/pkp', 'Setting::pkp');
$routes->get('setting/user', 'Setting::user');
$routes->get('setting/edituser/(:any)', 'Setting::edituser/$1');
$routes->post('setting/useredit', 'Setting::useredit');
$routes->get('setting/datamigrasi', 'Data::datamigrasi');
$routes->get('setting/datamigrasi2', 'Data::datamigrasi2');
$routes->get('setting/datamigrasi3', 'Data::datamigrasi3');

$routes->get('profil', 'Profile::index');
$routes->get('profil/password', 'Profile::password');
$routes->get('profil/user', 'Profile::user');

$routes->get('proyek/datagd1', 'Proyek::datagd1');

$routes->get('proyek/edit_1/(:any)', 'Proyek::edit_1/$1');
$routes->get('proyek/edit_2/(:any)', 'Proyek::edit_2/$1');
$routes->get('proyek/edit_3/(:any)', 'Proyek::edit_3/$1');
$routes->get('proyek/edit_4/(:any)', 'Proyek::edit_4/$1');
$routes->get('proyek/edit_5/(:any)', 'Proyek::edit_5/$1');
$routes->get('proyek/edit_6/(:any)', 'Proyek::edit_6/$1');


$routes->post('proyek/proses_upload_solusi', 'Proyek::proses_upload_solusi');
$routes->get('proyek/xls1/(:any)', 'Proyek::xls1/$1');
$routes->get('proyek/pdf1/(:any)', 'Proyek::pdf1/$1');
$routes->get('proyek/pdf2/(:any)', 'Proyek::pdf2/$1');
$routes->post('proyek/upd_close_pkp', 'Proyek::upd_close_pkp');

$routes->get('proyek/xls2/(:any)', 'Proyek::xls2/$1');
$routes->get('proyek/xls3/(:any)', 'Proyek::xls3/$1');

$routes->post('proyek/dtutambah', 'Proyek::dtutambah');
$routes->post('proyek/fototambah', 'Proyek::fototambah');
$routes->post('proyek/teknistambah', 'Proyek::teknistambah');

$routes->get('setting/pkpdetail2/(:any)', 'Setting::pkpdetail2/$1');
$routes->get('setting/userdetail2', 'Setting::userdetail2');
$routes->post('setting/edituserpkp', 'Setting::edituserpkp');
$routes->post('setting/pkptambah', 'Setting::pkptambah');
$routes->post('setting/pkphapus', 'Setting::pkphapus');
$routes->get('setting/migrasipkp', 'Setting::migrasipkp');
$routes->post('setting/view_user3', 'Setting::view_user3');
$routes->post('setting/proses_upload_user', 'Setting::proses_upload_user');
$routes->post('setting/proses_hapus', 'Setting::proses_hapus');

$routes->post('profil/ubah-password', 'Profile::ubahpassword');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
