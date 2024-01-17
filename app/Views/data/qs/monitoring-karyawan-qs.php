<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/qs">LAPORAN BULANAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/masalah-qs">PERMASALAHAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">MONITORING KARYAWAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/monitoring-dcr-qs">MONITORING DCR</a>
        </li>

    </ul>

    <?php
    date_default_timezone_set("Asia/Jakarta");
    $now = date("Y-m-d");
    $awal_bulan = date("Y-m-01");
    $tgl_ini = date("d");
    $n_tgl_ini = (int) $tgl_ini;
    $tgl_proyek = $akses->getRow()->tgl_range_proyek;
    $tgl_kadiv = $akses->getRow()->tgl_range_kadiv;
    $tgl_kadirat = $akses->getRow()->tgl_range_kadirat;
    ?>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <div>
                <div class="d-flex flex-row pull-right">

                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if ($proyek->getRow()->tgl_ubah_absensi > 0) { ?>
                                <b>
                                    <?= (date('d-M-Y', strtotime(esc($proyek->getRow()->tgl_ubah_absensi)))) ?>
                                <?php } ?>
                            </b>
                        </h6>
                        <?php
                        if ($n_tgl_ini > 0) {
                            ?>
                            <div id="userbox" class="userbox">
                                <?php if (($n_tgl_ini <= $tgl_proyek and level_user('qs', 'index', $kategoriQNS, 'read') > 0) or ($n_tgl_ini > $tgl_proyek and $n_tgl_ini <= $tgl_kadiv and level_user('proyek', 'data', $kategoriQNS, 'add') > 0 and $proyek->getRow()->ijin_kadiv == 2) or ($n_tgl_ini > $tgl_kadiv and $n_tgl_ini <= $tgl_kadirat and level_user('proyek', 'data', $kategoriQNS, 'add') > 0 and $proyek->getRow()->ijin_kadirat == 2)) { ?>
                                    <!--<a class="btn btn-success" data-toggle="modal" data-target="#tambahData" style="font-size: 12px;color:white"> UPDATE ABSENSI</a>-->
                                    <a class="btn btn-success"
                                        href="<?= base_url() ?>laporan/import_mon_kry/<?= $proyek->getRow()->id_pkp ?>"
                                        style="font-size: 12px;color:white"> UPDATE ABSENSI</a>
                                <?php } else { ?>
                                    <?php if ($n_tgl_ini <= $tgl_kadiv and $proyek->getRow()->ijin_kadiv < 1 and level_user('proyek', 'data', $kategoriQNS, 'add') > 0) { ?>
                                        <a class="btn btn-success" data-toggle="modal" data-target="#tambahData3"
                                            style="font-size: 12px;color:white"> MINTA AKSES KE KADIV</a>
                                    <?php } else { ?>
                                        <?php if ($n_tgl_ini <= $tgl_kadiv and $proyek->getRow()->ijin_kadiv == 1 and level_user('kadiv', 'index', $kategoriQNS, 'read') > 0) { ?>
                                            <a class="btn btn-success" data-toggle="modal" data-target="#tambahData4"
                                                style="font-size: 12px;color:white"> ACC BY KADIV</a>
                                        <?php } else { ?>
                                            <?php if ($n_tgl_ini > $tgl_kadiv and $n_tgl_ini <= $tgl_kadirat and $proyek->getRow()->ijin_kadirat < 1 and level_user('proyek', 'data', $kategoriQNS, 'add') > 0) { ?>
                                                <a class="btn btn-success" data-toggle="modal" data-target="#tambahData5"
                                                    style="font-size: 12px;color:white"> MINTA AKSES KE KADIRAT</a>
                                            <?php } else { ?>
                                                <?php if ($n_tgl_ini <= $tgl_kadirat and $proyek->getRow()->ijin_kadirat == 1 and level_user('kadirat', 'index', $kategoriQNS, 'read') > 0) { ?>
                                                    <a class="btn btn-success" data-toggle="modal" data-target="#tambahData6"
                                                        style="font-size: 12px;color:white"> ACC BY KADIRAT</a>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                } ?>


                                <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">EXPORT

                                </a>
                                <div class="dropdown-menu">
                                    <ul class="list-unstyled">
                                        <li class="divider"></li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/xls3/<?= $proyek->getRow()->id_pkp ?>"
                                                style="font-size: 12px;color:black"> XLS</a>
                                        </li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/pdf2/<?= $proyek->getRow()->id_pkp ?>"
                                                style="font-size: 12px;color:black" target="_blank"> PDF</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                </div>
                <?php
                $bulan22 = '';
                foreach ($detil_karyawan as $det2) {
                    $bulan22 = $det2->bulan;
                    $tahun22 = $det2->tahun;
                } ?>
                <span class=" card-subtitle" style="margin-bottom: 5px">TABEL MOBILISASI/DEMOBILISASI, ABSENSI & AKHIR
                    KONTRAK</span>
                <br>
                <?php if ($bulan22 != '') { ?>
                    <b><span style="font-size: 13px;">Periode:
                            <?= ' ' . $bulan22 . '-' . $tahun22 ?>
                        </span></b>
                <?php } ?>

                <div class="table-scrollable" style="height: 450px;width:100%">
                    <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped"
                        style="min-width: 1200px;">
                        <thead style="background-color:#1b3a59;color:white;">
                            <tr>
                                <th style="text-align:center;vertical-align:middle;font-size:12px" rowspan="2">NO.</th>
                                <th style="text-align:center;vertical-align:middle;width:8%;;font-size:12px"
                                    rowspan="2">NRP</th>
                                <th style="text-align:center;vertical-align:middle;width:15%;;font-size:12px"
                                    rowspan="2">Nama Karyawan</th>
                                <th style="text-align:center;;font-size:12px" colspan="4">Absensi</th>
                                <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px"
                                    rowspan="2">Ket. Absensi</th>
                                <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px"
                                    rowspan="2">Sisa Cuti</th>
                                <th style="text-align:center;vertical-align:middle;font-size:12px" rowspan="2">Jabatan
                                </th>
                                <th style="text-align:center;vertical-align:middle;font-size:12px" rowspan="2">Posisi
                                </th>
                                <th style="text-align:center;vertical-align:middle;width:8%;;font-size:12px"
                                    rowspan="2">TGL KONTRAK</th>
                                <th style="text-align:center;vertical-align:middle;width:8%;;font-size:12px"
                                    rowspan="2">TGL AKHIR KONTRAK</th>
                                <th style="text-align:center;;font-size:12px" colspan="2">MOB</th>
                                <th style="text-align:center;;font-size:12px" colspan="2">DEMOB</th>
                                </th>
                                <th style="text-align:center;vertical-align:middle;font-size:12px" rowspan="2">STATUS
                                </th>
                                <th style="text-align:center;vertical-align:middle;width:20%;font-size:12px"
                                    rowspan="2">KETERANGAN</th>
                                <th style="text-align:center;vertical-align:middle;width:15%;font-size:12px"
                                    rowspan="2">Mutasi/<br>Resign/TF</th>
                            </tr>
                            <tr>
                                <th style="text-align:center;;font-size:12px">S</th>
                                <th style="text-align:center;;font-size:12px">I</th>
                                <th style="text-align:center;;font-size:12px">A</th>
                                <th style="text-align:center;;font-size:12px">C</th>
                                <th style="text-align:center;width:10%;;font-size:12px">Renc</th>
                                <th style="text-align:center;width:10%;;font-size:12px">Real</th>
                                <th style="text-align:center;width:10%;;font-size:12px">Renc</th>
                                <th style="text-align:center;width:10%;;font-size:12px">Real</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detil_karyawan as $sol) {
                                //STYLE
                                $hitam = 'style="text-align:center;background-color:black;color:white;vertical-align:middle;font-size:11px"';
                                $merah = 'style="text-align:center;background-color:firebrick;color:white;vertical-align:middle;font-size:11px"';
                                $kuning = 'style="text-align:center;background-color:gold;color:black;vertical-align:middle;font-size:11px"';
                                $biasa = 'style="text-align:center;vertical-align:middle;font-size:11px"';
                                $golden = 'style="background-color:darkgoldenrod;color:white;vertical-align:middle;font-size:11px"';
                                $biasa2 = 'style="vertical-align:middle;font-size:11px"';
                                $error = 'style="text-align:center;background-color:#ADFF2F;color:black;vertical-align:middle;font-size:11px"';
                                $nama_admin = $sol->nama_admin;
                                $nrp = $sol->username;
                                if ($nrp == '') {
                                    $nrp = 'Error';
                                    $nama_admin = 'NRP ' . $sol->id_user . ' belum ada di data pusat';
                                    $gaya_error = $error;
                                } else {
                                    $gaya_error = $biasa;
                                }
                                if ($sol->id_pkp == $sol->pkp_sebelumnya or $sol->id_pkp == $sol->pkp_akhir) {
                                    $alert = 0;
                                } else {
                                    $alert = 1;
                                }

                                if ($sol->sakit > 0) {
                                    $sakit = $sol->sakit;
                                } else {
                                    $sakit = 0;
                                }
                                if ($sol->ijin > 0) {
                                    $ijin = $sol->ijin;
                                } else {
                                    $ijin = 0;
                                }
                                if ($sol->alpha > 0) {
                                    $alpha = $sol->alpha;
                                } else {
                                    $alpha = 0;
                                }
                                if ($sol->cuti > 0) {
                                    $cuti = $sol->cuti;
                                } else {
                                    $cuti = 0;
                                }
                                if ($sol->tgl_ren_mob > 0) {
                                    $tgl_ren_mob = date('d/m/Y', strtotime($sol->tgl_ren_mob));
                                    $tgl_ren_mob2 = $sol->tgl_ren_mob;
                                } else {
                                    $tgl_ren_mob = '';
                                }
                                if ($sol->tgl_real_mob > 0) {
                                    $tgl_real_mob = date('d/m/Y', strtotime($sol->tgl_real_mob));
                                    $tgl_real_mob2 = $sol->tgl_real_mob;
                                } else {
                                    $tgl_real_mob = '';
                                }
                                if ($sol->tgl_ren_demob > 0) {
                                    $tgl_ren_demob = date('d/m/Y', strtotime($sol->tgl_ren_demob));
                                    $tgl_ren_demob2 = $sol->tgl_ren_demob;
                                } else {
                                    $tgl_ren_demob = '';
                                }
                                if ($sol->tgl_real_demob > 0) {
                                    $tgl_real_demob = date('d/m/Y', strtotime($sol->tgl_real_demob));
                                    $tgl_real_demob2 = $sol->tgl_real_demob;
                                } else {
                                    $tgl_real_demob = '';
                                }
                                if ($sol->tgl_akhir_kontrak > 0) {
                                    $tgl_akhir_kontrak = date('d/m/Y', strtotime($sol->tgl_akhir_kontrak));
                                    $tgl_akhir_kontrak2 = $sol->tgl_akhir_kontrak;
                                } else {
                                    $tgl_akhir_kontrak = '';
                                }
                                if ($sol->tgl_kontrak > 0) {
                                    $tgl_kontrak = date('d/m/Y', strtotime($sol->tgl_kontrak));
                                    $tgl_kontrak2 = $sol->tgl_kontrak;
                                } else {
                                    $tgl_kontrak = '';
                                }
                                ?>

                                <?php



                                if ($tgl_akhir_kontrak > 0) {
                                    if (strtotime($tgl_akhir_kontrak2) >= strtotime($now)) {
                                        $selisih = ((abs(strtotime($tgl_akhir_kontrak2) - (strtotime($now)))) / 86400);
                                    } else {
                                        $selisih = (((abs(strtotime($tgl_akhir_kontrak2) - (strtotime($now)))) / 86400)) * -1;
                                    }
                                } else {
                                    $selisih = 0;
                                }
                                if ($tgl_akhir_kontrak > 0) {
                                    if ($selisih < 1) {
                                        $gaya = $hitam;
                                    } else {
                                        if ($selisih > 90) {
                                            $gaya = $biasa;
                                        } else {
                                            if ($selisih > 30) {
                                                $gaya = $kuning;
                                            } else {
                                                $gaya = $merah;
                                            }
                                        }
                                    }
                                } else {
                                    $gaya = $biasa;
                                }
                                if ($tgl_ren_demob > 0 and $tgl_real_demob < 1) {
                                    if (strtotime($tgl_ren_demob2) >= strtotime($now)) {
                                        $selisih2 = ((abs(strtotime($tgl_ren_demob2) - (strtotime($now)))) / 86400);
                                    } else {
                                        $selisih2 = (((abs(strtotime($tgl_ren_demob2) - (strtotime($now)))) / 86400)) * -1;
                                    }
                                } else {
                                    $selisih2 = 0;
                                }
                                if ($tgl_ren_demob > 0 and $tgl_real_demob < 1) {
                                    if ($selisih2 <= 0) {
                                        $gaya2 = $hitam;
                                    } else {
                                        if ($selisih2 > 30) {
                                            $gaya2 = $biasa;
                                        } else {
                                            $gaya2 = $merah;
                                        }
                                    }
                                } else {
                                    $gaya2 = $biasa;
                                }
                                if ($tgl_ren_mob > 0 and $tgl_real_mob < 1) {
                                    if (strtotime($tgl_ren_mob) >= strtotime($now)) {
                                        $selisih3 = ((abs(strtotime($tgl_ren_mob2) - (strtotime($now)))) / 86400);
                                    } else {
                                        $selisih3 = (((abs(strtotime($tgl_ren_mob2) - (strtotime($now)))) / 86400)) * -1;
                                    }
                                } else {
                                    $selisih3 = 0;
                                }
                                if ($tgl_ren_mob > 0 and $tgl_real_mob < 1) {
                                    if ($selisih3 <= 0) {
                                        $gaya3 = $hitam;
                                    } else {
                                        if ($selisih3 > 30) {
                                            $gaya3 = $biasa;
                                        } else {
                                            $gaya3 = $merah;
                                        }
                                    }
                                } else {
                                    $gaya3 = $biasa;
                                }
                                if ($alert > 0) {
                                    $gaya4 = $golden;
                                } else {
                                    $gaya4 = $biasa2;
                                }
                                ?>
                                <tr>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $no; ?>
                                    </td>
                                    <td <?= $gaya_error ?>>
                                        <?= $nrp; ?>
                                    </td>
                                    <td <?= $gaya4 ?>>
                                        <?= $nama_admin; ?>
                                    </td>

                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $sakit; ?>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $ijin; ?>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $alpha; ?>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $cuti; ?>
                                    </td>
                                    <td style="text-align:left;vertical-align:middle;font-size:11px">
                                        <?= $sol->ket_absensi; ?>
                                    </td>
                                    <td style="text-align:left;vertical-align:middle;font-size:11px">
                                        <?= $sol->sisa_cuti; ?>
                                    </td>
                                    <td style="text-align:left;vertical-align:middle;font-size:11px">
                                        <?= $sol->jabatan; ?>
                                    </td>
                                    <td style="text-align:left;vertical-align:middle;font-size:11px">
                                        <?= $sol->ket_jabatan; ?>
                                    </td>

                                    <td>
                                        <?= $tgl_kontrak; ?>
                                    </td>
                                    <td <?= $gaya ?>>
                                        <?= $tgl_akhir_kontrak; ?>
                                    </td>
                                    <td <?= $gaya3 ?>>
                                        <?= $tgl_ren_mob; ?>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $tgl_real_mob; ?>
                                    </td>
                                    <td <?= $gaya2 ?>>
                                        <?= $tgl_ren_demob; ?>
                                    </td>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $tgl_real_demob; ?>
                                    </td>
                                    <td style="text-align:left;vertical-align:middle;font-size:11px">
                                        <?= $sol->status; ?>
                                    </td>
                                    <?php
                                    $keteranganQ = $sol->ket_mobdemob;
                                    if ($nrp != 'Error') {
                                        if ($alert > 0) {
                                            if ($sol->ket_mobdemob != '' and $sol->ket_mobdemob != '-') {
                                                $keteranganQ = 'Data masih di PKP: ' . $sol->alias . '<br>' . $sol->ket_mobdemob;
                                            } else {
                                                if ($sol->tgl_respon > 0) {
                                                    $keteranganQ = 'Data masih di PKP: ' . $sol->alias . '<br> Mutasi sesuai Dashboard (' . date('d/m/Y', strtotime($sol->tgl_respon)) . '), tunggu SK Mutasi';
                                                } else {
                                                    $keteranganQ = 'Data masih di PKP: ' . $sol->alias;
                                                }
                                            }
                                        } else {
                                            $keteranganQ = $sol->ket_mobdemob;
                                        }
                                    } else {
                                        $keteranganQ = 'Belum ada di data Pusat';
                                    }

                                    ?>
                                    <td <?= $gaya4 ?>>
                                        <?= $keteranganQ; ?>
                                    </td>

                                    <td style="text-align:left;vertical-align:middle;font-size:11px">
                                        <?= $sol->ket_akhir; ?>
                                    </td>
                                </tr>

                                <?php
                                $no++;
                            } ?>
                            <?php
                            foreach ($detil_no_list as $list) {
                                ?>
                                <tr>
                                    <td style="text-align:center;vertical-align:middle;font-size:11px">
                                        <?= $no; ?>
                                    </td>
                                    <td
                                        style="background-color:darkgoldenrod;color:white;vertical-align:middle;font-size:11px">
                                        <?= $list->username; ?>
                                    </td>
                                    <td
                                        style="background-color:darkgoldenrod;color:white;vertical-align:middle;font-size:11px">
                                        <?= $list->nama_admin; ?>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td
                                        style="background-color:darkgoldenrod;color:white;vertical-align:middle;font-size:11px">
                                        Tidak ada isian Absensi</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <?php
                                $no++;
                            } ?>

                        </tbody>

                    </table>

                </div>

                <div style="background-color: white;">

                    <a style="font-size: 12px;">Catatan: Absensi harus di updated tanggal 10 setiap bulan </a><br>

                    <span class="label3 label-info m-r-5 text-success"
                        style="background-color:gold;margin-top: 2px"></span> <a style="font-size: 12px;">
                        < 3 Bulan </a>
                            <span class="label3 label-info m-r-5 text-success"
                                style="background-color:firebrick;margin-top: 2px"></span> <a style="font-size: 12px;">
                                < 1 Bulan</a>
                                    <span class="label3 label-info m-r-5 text-success"
                                        style="background-color:black;margin-top: 2px"></span> <a
                                        style="font-size: 12px;">Telat </a>
                                    <span class="label3 label-info m-r-5 text-success"
                                        style="background-color:darkgoldenrod;margin-top: 2px"></span> <a
                                        style="font-size: 12px;">Data MOB/DEMOB Tidak sama</a>

                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="tambahData" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('proyek/proses_upload_karyawan', ' id="FormulirTambah2"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">IMPORT DATA KARYAWAN</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp58" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Format EXCEL ---></label>
                                <a style="font-size:12px;" class="btn btn-warning"
                                    href="<?= base_url() ?>excel/newformatABSENSI.xlsx" target="_blank"><i
                                        class="fa fa-download"></i> Download Format</a>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform2">Submit</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahData3" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('proyek/akseskadiv', ' id="FormulirTambah3"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">MINTA BUKA AKSES KE KADIV</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group mt-lg proyek">
                        <label class="col-sm-3 control-label">KETERLAMBATAN<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <?php foreach ($buka_akses22 as $buka_akses): ?>
                                <textarea type="text" name="sebab" class="form-control"
                                    placeholder="Isi Sebab Keterlambatan" disabled><?= $buka_akses->keterangan ?></textarea>
                            <?php endforeach; ?>
                            <input type="hidden" name="id_pkp58" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                class="form-control" required />
                            <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>" class="form-control"
                                required />
                        </div>
                    </div>

                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform3">Simpan</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahData4" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('proyek/openkadiv', ' id="FormulirTambah4"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">ACC KADIV</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group mt-lg proyek">
                        <label class="col-sm-3 control-label">KETERLAMBATAN<span class="required">*</span></label>
                        <div class="col-sm-9">

                            <input type="hidden" name="id_pkp58" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                class="form-control" required />
                            <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>" class="form-control"
                                required />
                        </div>
                    </div>

                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform4">ACC Kadiv</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahData5" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('proyek/akseskadirat', ' id="FormulirTambah5"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">MINTA BUKA AKSES KE KADIRAT</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group mt-lg proyek">
                        <label class="col-sm-3 control-label">KETERLAMBATAN<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <?php foreach ($buka_akses22 as $buka_akses): ?>
                                <textarea type="text" name="sebab" class="form-control"
                                    placeholder="Isi Sebab Keterlambatan" disabled><?= $buka_akses->keterangan ?></textarea>
                            <?php endforeach; ?>
                            <input type="hidden" name="id_pkp58" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                class="form-control" required />
                            <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>" class="form-control"
                                required />
                        </div>
                    </div>

                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform5">Simpan</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahData6" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('proyek/openkadirat', ' id="FormulirTambah6"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">ACC KADIRAT</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group mt-lg proyek">
                        <label class="col-sm-3 control-label">KETERLAMBATAN<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_pkp58" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                class="form-control" required />
                            <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>" class="form-control"
                                required />
                        </div>
                    </div>

                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform6">ACC Kadirat</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 3,
    });

    $(document).ready(function () {
        $('ul li a').click(function () {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
    });

    $('.tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm-dd-yyyy', {
        'placeholder': 'mm-dd-yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    document.getElementById("FormulirTambah2").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform2").setAttribute('disabled', 'disabled');
        $('#submitform2').html('Loading22 ...');
        var form = $('#FormulirTambah2')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                document.getElementById("submitform2").removeAttribute('disabled');
                $('#submitform2').html('Submit');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform2").removeAttribute('disabled');
                $('#tambahData2').modal('hide');
                document.getElementById("FormulirTambah2").reset();
                $('#submitform2').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 58",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah3").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform3").setAttribute('disabled', 'disabled');
        $('#submitform3').html('Loading....');
        var form = $('#FormulirTambah3')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                document.getElementById("submitform3").removeAttribute('disabled');
                $('#submitform3').html('Simpan');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform3").removeAttribute('disabled');
                $('#tambahData3').modal('hide');
                document.getElementById("FormulirTambah3").reset();
                $('#submitform2').html('Simpan');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 58",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah4").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform4").setAttribute('disabled', 'disabled');
        $('#submitform4').html('Loading....');
        var form = $('#FormulirTambah4')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                document.getElementById("submitform4").removeAttribute('disabled');
                $('#submitform4').html('Acc Kadiv');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform4").removeAttribute('disabled');
                $('#tambahData4').modal('hide');
                document.getElementById("FormulirTambah4").reset();
                $('#submitform4').html('Acc Kadiv');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 58",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah5").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform5").setAttribute('disabled', 'disabled');
        $('#submitform5').html('Loading....');
        var form = $('#FormulirTambah5')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                document.getElementById("submitform5").removeAttribute('disabled');
                $('#submitform5').html('Simpan');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform5").removeAttribute('disabled');
                $('#tambahData5').modal('hide');
                document.getElementById("FormulirTambah5").reset();
                $('#submitform5').html('Simpan');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 58",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah6").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform6").setAttribute('disabled', 'disabled');
        $('#submitform6').html('Loading....');
        var form = $('#FormulirTambah6')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                document.getElementById("submitform6").removeAttribute('disabled');
                $('#submitform6').html('Acc Kadirat');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform6").removeAttribute('disabled');
                $('#tambahData6').modal('hide');
                document.getElementById("FormulirTambah6").reset();
                $('#submitform6').html('Acc Kadirat');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 58",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
</script>
</body>

</html>
<?= $this->endSection() ?>