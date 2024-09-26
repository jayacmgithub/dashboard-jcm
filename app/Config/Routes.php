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
$routes->post('login/auth', 'Login::authLogin');
$routes->get('dashboard/logout', 'Login::logout');
$routes->group('', ['filter' => 'auth'], function ($routes) {
$routes->get('dashboard/dashboard/index', 'Dashboard::index');
$routes->get('dashboard/dashboard/beranda_01', 'Dashboard::beranda_01');
$routes->get('dashboard/dashboard/beranda_02', 'Dashboard::beranda_02');
$routes->get('dashboard/dashboard/beranda_03', 'Dashboard::beranda_03');
$routes->get('dashboard/dashboard/beranda_04', 'Dashboard::beranda_04');
$routes->get('dashboard/dashboard/beranda_05', 'Dashboard::beranda_05');
$routes->get('dashboard/dashboard/beranda_06', 'Dashboard::beranda_06');
$routes->get('dashboard/dashboard/beranda_07', 'Dashboard::beranda_07');
$routes->get('dashboard/dashboard/invoice', 'Dashboard::invoice');

$routes->get('dashboard/proyek', 'Proyek::index');
$routes->get('dashboard/proyek/gedung1', 'Proyek::gedung1');
$routes->get('dashboard/proyek/gedung2', 'Proyek::gedung2');
$routes->get('dashboard/proyek/gedung3', 'Proyek::gedung3');
$routes->get('dashboard/proyek/ktl', 'Proyek::ktl1');
$routes->get('dashboard/proyek/ktl2', 'Proyek::ktl2');
$routes->get('dashboard/proyek/transportasi', 'Proyek::trans1');
$routes->get('dashboard/proyek/transportasi2', 'Proyek::trans2');
$routes->get('dashboard/proyek/kantor', 'Proyek::kantor');
$routes->get('dashboard/proyek/all', 'Proyek::semua');
$routes->get('dashboard/proyek/import_mon_kry/(:any)', 'Proyek::import_mon_kry/$1');
$routes->get('dashboard/proyek/datagd1', 'Proyek::datagd1');
$routes->get('dashboard/proyek/datagd2', 'Proyek::datagd2');
$routes->get('dashboard/proyek/datagd3', 'Proyek::datagd3');
$routes->get('dashboard/proyek/dataktl', 'Proyek::dataktl');
$routes->get('dashboard/proyek/dataktl2', 'Proyek::dataktl2');
$routes->get('dashboard/proyek/datatrans', 'Proyek::datatrans');
$routes->get('dashboard/proyek/datatrans2', 'Proyek::datatrans2');
$routes->get('dashboard/proyek/datakantor', 'Proyek::datakantor');
$routes->get('dashboard/proyek/datasemua', 'Proyek::datasemua');
$routes->post('dashboard/proyek/tambahDataInvoice', 'Proyek::tambahDataInvoice');
$routes->get('dashboard/proyek/marketing/(:any)', 'Data::marketing/$1');

$routes->get('dashboard/laporan', 'Data::index');
$routes->get('dashboard/laporan/hcm', 'Data::hcm');
$routes->get('dashboard/laporan/absensi', 'Data::absensi');
$routes->get('dashboard/laporan/mkt', 'Data::mkt');
$routes->get('dashboard/laporan/qs', 'Data::qs');
$routes->get('dashboard/laporan/masalah-qs', 'Data::masalah_qs');
$routes->get('dashboard/laporan/monitoring-karyawan-qs', 'Data::mon_kar_qs');
$routes->get('dashboard/laporan/monitoring-dcr-qs', 'Data::mon_dcr_qs');
$routes->get('dashboard/laporan/import_pembaharuan', 'Data::import_pembaharuan');
$routes->get('dashboard/laporan/edituser/(:any)', 'Data::edituser/$1');
$routes->post('dashboard/laporan/useredit_1', 'Data::useredit_1');
$routes->post('dashboard/laporan/useredit_11', 'Data::useredit_11');
$routes->post('dashboard/laporan/useredit_2', 'Data::useredit_2');
$routes->post('dashboard/laporan/useredit_3', 'Data::useredit_3');
$routes->post('dashboard/laporan/tambah_dtu_mkt', 'Data::tambah_dtu_mkt');
$routes->post('dashboard/laporan/fototambah', 'Data::fototambah');
$routes->post('dashboard/laporan/tambahproyekqs', 'Data::tambahproyekqs');
$routes->get('dashboard/laporan/data_mkt/(:any)', 'Data::data_mkt/$1');
$routes->get('dashboard/laporan/addendum/(:any)', 'Data::data_addendum/$1');
$routes->get('dashboard/laporan/marketing/(:any)', 'Data::data_marketing/$1');
$routes->get('dashboard/laporan/data_umum_mkt/(:any)', 'Data::data_umum_mkt/$1');
$routes->post('dashboard/laporan/tambahkaryawan', 'Data::tambahkaryawan');
$routes->post('dashboard/laporan/tambah_lapbul', 'Data::tambah_lapbul');
$routes->post('dashboard/laporan/upload_pembaharuan_1', 'Data::upload_pembaharuan_1');
$routes->post('dashboard/laporan/upload_karyawan_1', 'Data::upload_karyawan_1');
$routes->get('dashboard/laporan/dataimport1', 'Data::dataimport1');
$routes->post('dashboard/laporan/dataimport2', 'Data::dataimport2');
$routes->post('dashboard/laporan/hapus_pembaharuan_1', 'Data::hapus_pembaharuan_1');
$routes->post('dashboard/laporan/proses_pembaharuan_1', 'Data::proses_pembaharuan_1');
$routes->post('dashboard/laporan/mutasi_karyawan', 'Data::mutasi_karyawan');
$routes->get('dashboard/laporan/import_kry_baru', 'Data::import_kry_baru');
$routes->get('dashboard/laporan/export', 'Data::export');
$routes->get('dashboard/laporan/cetak_mon', 'Data::cetak_mon');
$routes->post('dashboard/laporan/datausers', 'Setting::datausers');
$routes->get('dashboard/laporan/karyawandetail', 'Data::karyawandetail');
$routes->get('dashboard/laporan/edit_tender/(:any)', 'Data::edit_tender/$1');
$routes->post('dashboard/laporan/update_mkt', 'Data::update_mkt');
$routes->post('dashboard/laporan/tambahaddendum', 'Data::tambahaddendum');
$routes->post('dashboard/laporan/hapusaddendum', 'Data::hapusaddendum');
$routes->get('dashboard/laporan/editaddendum/(:any)', 'Data::editaddendum/$1');
$routes->post('dashboard/laporan/update_addendum', 'Data::update_addendum');
$routes->post('dashboard/laporan/update_addendum2', 'Data::update_addendum2');
$routes->get('dashboard/laporan/editdata_mkt/(:any)', 'Data::editdata_mkt/$1');
$routes->post('dashboard/laporan/update_data_mkt', 'Data::update_data_mkt');
$routes->get('dashboard/laporan/editaddendum2/(:any)', 'Data::editaddendum2/$1');
$routes->post('dashboard/laporan/tambahtender', 'Data::tambahtender');
$routes->get('dashboard/laporan/import_mon_kry/(:any)', 'Data::import_mon_kry/$1');

$routes->get('dashboard/setting', 'Setting::index');
$routes->get('dashboard/setting/instansi', 'Setting::instansi');
$routes->get('dashboard/setting/pkp', 'Setting::pkp');
$routes->get('dashboard/setting/user', 'Setting::user');
$routes->get('dashboard/setting/edituser/(:any)', 'Setting::edituser/$1');
$routes->post('dashboard/setting/useredit', 'Setting::useredit');
$routes->get('dashboard/setting/datamigrasi', 'Data::datamigrasi');
$routes->get('dashboard/setting/datamigrasi2', 'Data::datamigrasi2');
$routes->get('dashboard/setting/datamigrasi3', 'Data::datamigrasi3');
$routes->get('dashboard/setting/pkpdetail', 'Setting::pkpdetail');
$routes->post('dashboard/setting/pkpedit', 'Setting::pkpedit');
$routes->post('dashboard/setting/tambahuser', 'Setting::tambahuser');
$routes->post('dashboard/setting/tambahuserpkp', 'Setting::tambahuserpkp');
$routes->get('dashboard/setting/userdetail', 'Setting::userdetail');


$routes->get('dashboard/profil', 'Profile::index');
$routes->get('dashboard/profil/password', 'Profile::password');
$routes->get('dashboard/profil/user', 'Profile::user');

$routes->get('dashboard/proyek/edit_1/(:any)', 'Proyek::edit_1/$1');
$routes->get('dashboard/proyek/edit_2/(:any)', 'Proyek::edit_2/$1');
$routes->get('dashboard/proyek/edit_3/(:any)', 'Proyek::edit_3/$1');
$routes->get('dashboard/proyek/edit_4/(:any)', 'Proyek::edit_4/$1');
$routes->get('dashboard/proyek/edit_5/(:any)', 'Proyek::edit_5/$1');
$routes->get('dashboard/proyek/edit_6/(:any)', 'Proyek::edit_6/$1');
$routes->get('dashboard/proyek/progress-invoice/(:any)', 'Proyek::progressInvoice/$1');
$routes->get('dashboard/proyek/invoice-detail', 'Proyek::invoiceDetail');
$routes->post('dashboard/proyek/invoice-detail', 'Proyek::invoiceDetail');
$routes->get('dashboard/proyek/get_bulan', 'Proyek::get_bulan');
$routes->get('dashboard/proyek/get_bulan_msl', 'Proyek::get_bulan_msl');
$routes->get('dashboard/proyek/get_bulan_absensi', 'Proyek::get_bulan_absensi');
$routes->get('dashboard/proyek/get_bulan_gbr', 'Proyek::get_bulan_gbr');


$routes->post('dashboard/proyek/proses_upload_solusi', 'Proyek::proses_upload_solusi');
$routes->get('dashboard/proyek/xls1/(:any)', 'Proyek::xls1/$1');
$routes->get('dashboard/proyek/pdf1/(:any)', 'Proyek::pdf1/$1');
$routes->get('dashboard/proyek/pdf2/(:any)', 'Proyek::pdf2/$1');
$routes->post('dashboard/proyek/upd_close_pkp', 'Proyek::upd_close_pkp');
$routes->post('dashboard/proyek/upload_mon_1', 'Proyek::upload_mon_1');
$routes->post('dashboard/proyek/hapus_mon_1', 'Proyek::hapus_mon_1');
$routes->post('dashboard/proyek/dataimportmon1', 'Proyek::dataimportmon1');
$routes->post('dashboard/proyek/proses_mon_1', 'Proyek::proses_mon_1');

$routes->get('dashboard/proyek/xls2/(:any)', 'Proyek::xls2/$1');
$routes->get('dashboard/proyek/xls3/(:any)', 'Proyek::xls3/$1');

$routes->post('dashboard/proyek/dtutambah', 'Proyek::dtutambah');
$routes->post('dashboard/proyek/fototambah', 'Proyek::fototambah');
$routes->post('dashboard/proyek/teknistambah', 'Proyek::teknistambah');
$routes->post('dashboard/proyek/tambah-invoice', 'Proyek::tambahInvoice');
$routes->post('dashboard/proyek/invoice-edit', 'Proyek::invoiceEdit');
$routes->post('dashboard/proyek/upl_progress', 'Proyek::upl_progress');
$routes->get('dashboard/proyek/upload_mon_1', 'Proyek::upload_mon_1');
$routes->post('dashboard/proyek/upd_data_spk', 'Proyek::upd_data_spk');

$routes->get('dashboard/setting/pkpdetail2/(:any)', 'Setting::pkpdetail2/$1');
$routes->get('dashboard/setting/userdetail2', 'Setting::userdetail2');
$routes->post('dashboard/setting/edituserpkp', 'Setting::edituserpkp');
$routes->post('dashboard/setting/pkptambah', 'Setting::pkptambah');
$routes->post('dashboard/setting/pkphapus', 'Setting::pkphapus');
$routes->get('dashboard/setting/migrasipkp', 'Setting::migrasipkp');
$routes->post('dashboard/setting/view_user3', 'Setting::view_user3');
$routes->post('dashboard/setting/proses_upload_user', 'Setting::proses_upload_user');
$routes->post('dashboard/setting/proses_hapus', 'Setting::proses_hapus');

$routes->post('dashboard/profil/ubah-password', 'Profile::ubahpassword');
$routes->post('dashboard/password/gantiuserpkp', 'Profile::gantiuserpkp');

$routes->post('dashboard/proyek/datagd1', 'Proyek::datagd1');
$routes->post('dashboard/proyek/datagd2', 'Proyek::datagd2');
$routes->post('dashboard/proyek/datagd3', 'Proyek::datagd3');
$routes->post('dashboard/proyek/dataktl', 'Proyek::dataktl');
$routes->post('dashboard/proyek/dataktl2', 'Proyek::dataktl2');
$routes->post('dashboard/proyek/datatrans', 'Proyek::datatrans');
$routes->post('dashboard/proyek/datatrans2', 'Proyek::datatrans2');
$routes->post('dashboard/proyek/datakantor', 'Proyek::datakantor');
$routes->post('dashboard/proyek/datasemua', 'Proyek::datasemua');
$routes->post('dashboard/proyek/validasi_kapro1', 'Proyek::validasi_kapro1');
$routes->get('dashboard/proyek/marketing/(:any)', 'Proyek::marketing/$1');
$routes->post('dashboard/proyek/editmarketing', 'Proyek::editmarketing');
$routes->post('dashboard/proyek/tambahaddendum', 'Proyek::tambahaddendum');


});

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
