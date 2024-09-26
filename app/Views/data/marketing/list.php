<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<?php date_default_timezone_set("Asia/Jakarta");
$now = date("Y-m-d");
$tgl_terawang = date('Y-m-d', strtotime('-365 days', strtotime($now)));
?>
<div class="tab-content" id="myTabContent">
    <!--GEDUNG1-->

    <div class="tab-pane active" id="gedung7" role="tabpanel" aria-labelledby="gedung7-tab">
        <!---->
        <?php if (level_user('data', 'marketing', $kategoriQNS, 'edit') > 0) { ?>
            <div class="d-flex flex-row pull-right">
                <div id="userbox3" class="userbox">
                    <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal" data-target="#tambahData"> TAMBAH DATA</a>

                </div>
            </div>
        <?php } ?>
        <br><br>
        <div>

            <div class="table-scrollable" style="height: 530px;width:100%; overflow-x:auto">
                <table cellspacing="0" id="table-basic" class="table table-sm table-bordered " style="width:100%">
                    <thead style="top: 0;position: sticky">
                        <tr style="background-color:#1b3a59;color:white;">
                            <th style="text-align:center;vertical-align:middle;width:35%" colspan="3">PROYEK</th>
                            <th style="text-align:center;vertical-align:middle;" colspan="4">PROGRESS</th>
                        </tr>
                    </thead>
                    <tr>
                        <td style="border-bottom:0px;" colspan="7"><button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo1" style="font-size:12px;background-color:transparent;border-color:transparent;color:grey;text-align:left">PROGRESS TENDER & KONTRAK <i class="fa fa-sort"></i></button></td>
                    </tr>
                    <tbody class="collapse" id="demo1" style="border:none">
                        <?php
                        $no = 1;
                        $total = 0;
                        $total2 = 0;
                        foreach ($data_marketing1 as $dt_mkt) {
                            if ($dt_mkt->tgl_undangan > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pq_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_awz_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_admin_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pemasukan_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_presentasi_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->admin_teknis > 0) {
                                $total++;
                            }
                            if ($dt_mkt->no_spk != '') {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_draft > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ttd > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ubah > 0) {
                                $tgl_ubah = date('d-m-Y', strtotime($dt_mkt->tgl_ubah));
                            } else {
                                $tgl_ubah = '';
                            }
                        ?>

                            <tr>
                                <td rowspan="2" style="width:3%;text-align:center;vertical-align:middle;"><?php echo $no ?></td>
                                <td rowspan="2" style="border-right:0px">
                                    <a style="font-size: 12px;font-weight: 400;" class="link" href="<?php echo base_url() ?>laporan/data_umum_mkt/<?php echo $dt_mkt->id_marketing ?>"><?php echo $dt_mkt->nama_proyek ?></a><br>

                                    <a style="font-size: 12px;font-weight: 400" class="link" href="<?php echo base_url() ?>laporan/data_umum_mkt/<?php echo $dt_mkt->id_marketing ?>"><i>Last Upd: <b><?php echo $tgl_ubah ?></a>

                                </td>
                                <td rowspan="2" style="border-left: 0px; width: 3%;vertical-align: middle;">
                                    <div class="notify"> <a href="#"></a></div>
                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right">TENDER</td>
                                <td style="border-bottom:0px;border-left:0px" colspan="4">
                                    <?php if ($dt_mkt->tgl_undangan > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#76ADE6;color:white;text-shadow: 1px 1px 3px  black;width: 14%;height:18px;" role="progressbar"><span><small>PENG</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PENG</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_pq_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E99EE;color:white;text-shadow: 1px 1px 3px black;width: 14%;height:18px;" role="progressbar"><span><small>PQ</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar">
                                            <span><small>PQ</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_awz_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E85FE;color:white;text-shadow: 1px 1px 3px black;width: 14%;height:18px;" role="progressbar"><span><small>AWZ</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>AWZ</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_admin_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E6BFA;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PRPS</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar">
                                            <span><small>PRPS</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_pemasukan_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7355F3;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PMSK</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PMSK</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_presentasi_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#5038BB;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PRST</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PRST</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->admin_teknis > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#3E2DA5;color:white;width: 14%;height:18px;" role="progressbar"><span><small>EVAL</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>EVAL</small></span></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:7%;border-top:0px;border-right:0px;text-align:right">KONTRAK</td>
                                <td style="border-top:0px;border-left:0px;" colspan="4">
                                    <?php if ($dt_mkt->no_spk != '') { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#BFEAF5;width: 32.657%;height:18px;" role="progressbar"><span><small>SPK</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 32.657%;height:18px;" role="progressbar"><span><small>SPK</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_draft > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E99EE;width: 32.657%;height:18px;color:white" role="progressbar"><span><small>DRAFT</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 32.657%;height:18px;" role="progressbar"><span><small>DRAFT</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_ttd > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7355F3;width: 32.657%;height:18px;color:white" role="progressbar"><span><small>SPER</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 32.657%;height:18px;" role="progressbar"><span><small>SPER</small></span></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                            $total = 0;
                            $total2 = 0;
                            $no++;
                        }  ?>
                    </tbody>

                    <tr>
                        <td style="border-bottom:0px;" colspan="7"><button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo3" style="font-size:12px;background-color:transparent;border-color:transparent;color:grey;text-align:left">PROGRESS ADDENDUM <i class="fa fa-sort"></i></button></td>
                    </tr>
                    <tbody class="collapse" id="demo3" style="border:none">
                        <?php
                        $no3 = 1;
                        $total = 0;
                        $total2 = 0;
                        foreach ($data_marketing4 as $dt_mkt) {
                            if ($dt_mkt->tgl_ba_surat > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_sph > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_nego > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_draft > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_sper > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_ubah > 0) {
                                $tgl_ubah = date('d-m-Y', strtotime($dt_mkt->tgl_ubah));
                            } else {
                                $tgl_ubah = '';
                            }
                        ?>

                            <tr>
                                <td style="width:3%;text-align:center;vertical-align:middle;"><?php echo $no3 ?></td>
                                <td style="border-right:0px">
                                    <a style="font-size: 12px;font-weight: 400;" class="link" href="<?php echo base_url() ?>laporan/addendum/<?php echo $dt_mkt->id_marketing ?>"><?php echo $dt_mkt->no_pkp . ' : ' . $dt_mkt->nama_proyek ?></a>

                                    <a style="font-size: 12px;font-weight: 400" class="link" href="<?php echo base_url() ?>laporan/addendum/<?php echo $dt_mkt->id_marketing ?>"><i>(Last Upd: <b><?php echo $tgl_ubah ?></b>)</a>
                                <td style="border-left: 0px; width: 3%;vertical-align: middle;">
                                    <div class="notify"> <a href="#"></a></div>
                                </td>
                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right;vertical-align:middle">ADDENDUM <?php echo $dt_mkt->addendum_ke ?></td>
                                <td style="border-bottom:0px;border-left:0px;vertical-align:middle" colspan="4">
                                    <?php if ($total > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#76ADE6;color:white;text-shadow: 1px 1px 3px  black;width: 19.5%;height:18px;" role="progressbar"><span><small>BA/S</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 19.5%;height:18px;" role="progressbar"><span><small>BA/S</small></span></a>
                                    <?php } ?>
                                    <?php if ($total > 1) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E99EE;color:white;text-shadow: 1px 1px 3px  black;width: 19.5%;height:18px;" role="progressbar"><span><small>SPH</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 19.5%;height:18px;" role="progressbar">
                                            <span><small>SPH</small></span></a>
                                    <?php } ?>
                                    <?php if ($total > 2) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E85FE;color:white;text-shadow: 1px 1px 3px  black;width: 19.5%;height:18px;" role="progressbar"><span><small>NEGO</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 19.5%;height:18px;" role="progressbar"><span><small>NEGO</small></span></a>
                                    <?php } ?>
                                    <?php if ($total > 3) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E6BFA;color:white;width: 19.5%;height:18px;" role="progressbar"><span><small>DRAFT</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 19.5%;height:18px;" role="progressbar">
                                            <span><small>DRAFT</small></span></a>
                                    <?php } ?>
                                    <?php if ($total > 4) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7355F3;color:white;width: 19.5%;height:18px;" role="progressbar"><span><small>SPER</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 19.5%;height:18px;" role="progressbar"><span><small>SPER</small></span></a>
                                    <?php } ?>

                                </td>
                            </tr>

                        <?php
                            $total = 0;
                            $total2 = 0;
                            $no3++;
                        }  ?>
                    </tbody>
                    <tr>
                        <td style="border-bottom:0px;" colspan="7"><button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo2" style="font-size:12px;background-color:transparent;border-color:transparent;color:grey;text-align:left">MASA KONSTRUKSI <i class="fa fa-sort"></i></button></td>
                    </tr>
                    <tbody class="collapse" id="demo2" style="border:none">
                        <?php
                        $no2 = 1;
                        $total = 0;
                        $total2 = 0;
                        foreach ($data_marketing2 as $dt_mkt) {
                            if ($dt_mkt->tgl_undangan > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pq_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_awz_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_admin_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pemasukan_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_presentasi_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->admin_teknis > 0) {
                                $total++;
                            }
                            if ($dt_mkt->no_spk != '') {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_draft > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ttd > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ubah > 0) {
                                $tgl_ubah = date('d-m-Y', strtotime($dt_mkt->tgl_ubah));
                            } else {
                                $tgl_ubah = '';
                            }
                            if ($dt_mkt->tgl_start > 0) {
                                $tgl_start = date('d-m-Y', strtotime($dt_mkt->tgl_start));
                            } else {
                                $tgl_start = '';
                            }
                            if ($dt_mkt->tgl_finish_all > 0) {
                                $tgl_finish = date('d-m-Y', strtotime($dt_mkt->tgl_finish_all));
                            } else {
                                $tgl_finish = '';
                            }

                            //MAEN TANGGAL
                            date_default_timezone_set("Asia/Jakarta");
                            $now = date("Y-m-d");
                            $hari = ((abs(strtotime($dt_mkt->tgl_finish_all) - (strtotime($now)))) / 86400);
                            if (strtotime($now) > strtotime($dt_mkt->tgl_finish_all)) {
                                $selisih = $hari * -1;
                            } else {
                                $selisih = $hari;
                            }
                            if ($selisih >= 90) {
                                $hb = '';
                                $pt = '';
                                $ttl = '';
                            } else {
                                if ($selisih < 90 and $selisih > 30) {
                                    $hb = 'heartbitK';
                                    $pt = 'pointK';
                                    $ttl = 'Proyek akan berakhir : ' . $selisih . ' hari lagi, Siapkan pengajuan Addendum.';
                                } else {
                                    $hb = 'heartbitM';
                                    $pt = 'pointM';
                                    $ttl = 'Segera ajukan Addendum, proyek akan berakhir : ' . $selisih . ' hari lagi.';
                                }
                            }
                            if ($selisih < 0) {
                                $ttl = 'Segera ajukan Addendum, proyek sudah terlambat : ' . $selisih * -1 . ' hari dari tanggal finish.';
                            }
                        ?>

                            <tr>
                                <td style="width:3%;text-align:center;vertical-align:middle;"><?php echo $no2 ?></td>
                                <td style="border-right:0px">
                                    <a style="font-size: 12px;font-weight: 400;" class="link" href="<?php echo base_url() ?>laporan/data_mkt/<?php echo $dt_mkt->id_marketing ?>"><?php echo $dt_mkt->no_pkp . ' : ' . $dt_mkt->nama_proyek . '  ' ?></a>

                                    <a style="font-size: 12px;font-weight: 400" class="link" href="<?php echo base_url() ?>laporan/data_mkt/<?php echo $dt_mkt->id_marketing ?>"><i>(Last Upd: <b><?php echo $tgl_ubah  ?></b>)</a>

                                </td>
                                <td style="border-left: 0px; width: 3%;vertical-align: middle;">
                                    <div class="notify"> <a href="<?php echo base_url() ?>laporan/addendum/<?php echo $dt_mkt->id_marketing ?>"><span class="<?php echo $hb ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $ttl ?>"></span> <span class="<?php echo $pt ?>"></span> </a></div>
                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right">TGL START</td>
                                <td style="border-bottom:0px;border-left:0px">
                                    <?php echo $tgl_start ?>
                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right">TGL FINISH</td>
                                <td style="border-bottom:0px;border-left:0px">
                                    <?php echo $tgl_finish ?>
                                </td>
                            </tr>

                        <?php
                            $total = 0;
                            $total2 = 0;
                            $no2++;
                        }  ?>
                    </tbody>

                    <tr>
                        <td style="border-bottom:0px;" colspan="7"><button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo5" style="font-size:12px;background-color:transparent;border-color:transparent;color:grey;text-align:left">SELESAI <i class="fa fa-sort"></i></button></td>
                    </tr>
                    <tbody class="collapse" id="demo5" style="border:none">
                        <?php
                        $no2 = 1;
                        $total = 0;
                        $total2 = 0;
                        foreach ($data_marketing_s as $dt_mkt) {
                            if ($dt_mkt->tgl_undangan > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pq_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_awz_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_admin_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pemasukan_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_presentasi_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->admin_teknis > 0) {
                                $total++;
                            }
                            if ($dt_mkt->no_spk != '') {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_draft > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ttd > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ubah > 0) {
                                $tgl_ubah = date('d-m-Y', strtotime($dt_mkt->tgl_ubah));
                            } else {
                                $tgl_ubah = '';
                            }
                            if ($dt_mkt->tgl_start > 0) {
                                $tgl_start = date('d-m-Y', strtotime($dt_mkt->tgl_start));
                            } else {
                                $tgl_start = '';
                            }
                            if ($dt_mkt->tgl_finish_all > 0) {
                                $tgl_finish = date('d-m-Y', strtotime($dt_mkt->tgl_finish_all));
                            } else {
                                $tgl_finish = '';
                            }
                           

                            //MAEN TANGGAL
                            date_default_timezone_set("Asia/Jakarta");
                            $now = date("Y-m-d");
                            $hari = ((abs(strtotime($dt_mkt->tgl_finish_all) - (strtotime($now)))) / 86400);
                            if (strtotime($now) > strtotime($dt_mkt->tgl_finish_all)) {
                                $selisih = $hari * -1;
                            } else {
                                $selisih = $hari;
                            }
                            if ($selisih >= 90) {
                                $hb = '';
                                $pt = '';
                                $ttl = '';
                            } else {
                                if ($selisih < 90 and $selisih > 30) {
                                    $hb = 'heartbitK';
                                    $pt = 'pointK';
                                    $ttl = 'Proyek akan berakhir : ' . $selisih . ' hari lagi, Siapkan pengajuan Addendum.';
                                } else {
                                    $hb = 'heartbitM';
                                    $pt = 'pointM';
                                    $ttl = 'Segera ajukan Addendum, proyek akan berakhir : ' . $selisih . ' hari lagi.';
                                }
                            }
                            if ($selisih < 0) {
                                $ttl = 'Segera ajukan Addendum, proyek sudah terlambat : ' . $selisih * -1 . ' hari dari tanggal finish.';
                            }
                        ?>

                            <tr>
                                <td style="width:3%;text-align:center;vertical-align:middle;"><?php echo $no2 ?></td>
                                <td style="border-right:0px">
                                    <a style="font-size: 12px;font-weight: 400;" class="link" href="<?php echo base_url() ?>laporan/data_mkt/<?php echo $dt_mkt->id_marketing ?>"><?php echo $dt_mkt->no_pkp . ' : ' . $dt_mkt->nama_proyek . '  ' ?></a>

                                    <a style="font-size: 12px;font-weight: 400" class="link" href="<?php echo base_url() ?>laporan/data_mkt/<?php echo $dt_mkt->id_marketing ?>"><i>(Last Upd: <b><?php echo $tgl_ubah  ?></b>)</a>

                                </td>
                                <td style="border-left: 0px; width: 3%;vertical-align: middle;">
                                <?php
                                    // Initialize message and URL
                                    $message = '';
                                    $url = base_url() . 'laporan/editdata_mkt/' . $dt_mkt->id_marketing;

                                    // Check if bast_1, bast_2, and surat_ref are set and not empty
                                    $bast_1 = !empty($dt_mkt->bast_1) ? $dt_mkt->bast_1 : '';
                                    $bast_2 = !empty($dt_mkt->bast_2) ? $dt_mkt->bast_2 : '';
                                    $surat_ref = !empty($dt_mkt->surat_ref) ? $dt_mkt->surat_ref : '';

                                    // Determine the appropriate message based on conditions
                                    if ($bast_1 == 'TIDAK' && $bast_2 == 'TIDAK') {
                                        if ($surat_ref == 'ADA') {
                                            $message = 'Belum ada BAST, namun ada surat ref';
                                        } elseif ($surat_ref == '' || $surat_ref != 'ADA') {
                                            $message = 'BAST dan surat ref belum ada';
                                        }
                                    } elseif ($bast_1 == 'ADA' && $bast_2 == 'ADA' && ($surat_ref == 'TIDAK' || $surat_ref == '')) {
                                        $message = 'BAST ada dan surat ref belum ada';
                                    }

                                    // Display the notification if a message is set
                                    if ($message) :
                                    ?>
                                        <div class="notify">
                                            <a href="<?php echo $url; ?>">
                                                <span class="heartbitSLS" data-toggle="tooltip" data-placement="right" title="<?php echo $message; ?>"></span>
                                                <span class="pointSLS"></span>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right">TGL START</td>
                                <td style="border-bottom:0px;border-left:0px">
                                    <?php echo $tgl_start ?>
                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right">TGL FINISH</td>
                                <td style="border-bottom:0px;border-left:0px">
                                    <?php echo $tgl_finish ?>
                                </td>
                            </tr>

                        <?php
                            $total = 0;
                            $total2 = 0;
                            $no2++;
                        }  ?>
                    </tbody>
                    <tr>
                        <td style="border-bottom:0px;" colspan="7"><button type="button" class="btn btn-success" data-toggle="collapse" data-target="#demo6" style="font-size:12px;background-color:transparent;border-color:transparent;color:grey;text-align:left">KALAH/MUNDUR <i class="fa fa-sort"></i></button></td>
                    </tr>
                    <tbody class="collapse" id="demo6" style="border:none">
                        <?php
                        $no = 1;
                        $total = 0;
                        $total2 = 0;
                        foreach ($data_marketing_km as $dt_mkt) {
                            if ($dt_mkt->tgl_undangan > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pq_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_awz_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_admin_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_pemasukan_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->tgl_presentasi_r > 0) {
                                $total++;
                            }
                            if ($dt_mkt->admin_teknis > 0) {
                                $total++;
                            }
                            if ($dt_mkt->no_spk != '') {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_draft > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ttd > 0) {
                                $total2++;
                            }
                            if ($dt_mkt->tgl_ubah > 0) {
                                $tgl_ubah = date('d-m-Y', strtotime($dt_mkt->tgl_ubah));
                            } else {
                                $tgl_ubah = '';
                            }
                        ?>

                            <tr>
                                <td rowspan="2" style="width:3%;text-align:center;vertical-align:middle;"><?php echo $no ?></td>
                                <td rowspan="2" style="border-right:0px">
                                    <a style="font-size: 12px;font-weight: 400;" class="link" href="<?php echo base_url() ?>laporan/data_umum_mkt/<?php echo $dt_mkt->id_marketing ?>"><?php echo $dt_mkt->nama_proyek ?></a><br>

                                    <a style="font-size: 12px;font-weight: 400" class="link" href="<?php echo base_url() ?>laporan/data_umum_mkt/<?php echo $dt_mkt->id_marketing ?>"><i>Last Upd: <b><?php echo $tgl_ubah . ' ' ?></a><a style="color:red"><?php echo  ' ' . $dt_mkt->menang ?></b></a>

                                </td>
                                <td rowspan="2" style="border-left: 0px; width: 3%;vertical-align: middle;">
                                    <div class="notify"> <a href="#"></a></div>
                                </td>
                                <td style="width:7%;border-bottom:0px;border-right:0px;text-align:right">TENDER</td>
                                <td style="border-bottom:0px;border-left:0px" colspan="4">
                                    <?php if ($dt_mkt->tgl_undangan > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#76ADE6;color:white;text-shadow: 1px 1px 3px  black;width: 14%;height:18px;" role="progressbar"><span><small>PENG</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PENG</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_pq_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E99EE;color:white;text-shadow: 1px 1px 3px black;width: 14%;height:18px;" role="progressbar"><span><small>PQ</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar">
                                            <span><small>PQ</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_awz_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E85FE;color:white;text-shadow: 1px 1px 3px black;width: 14%;height:18px;" role="progressbar"><span><small>AWZ</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>AWZ</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_admin_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E6BFA;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PRPS</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar">
                                            <span><small>PRPS</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_pemasukan_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7355F3;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PMSK</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PMSK</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_presentasi_r > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#5038BB;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PRST</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PRST</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->admin_teknis > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#3E2DA5;color:white;width: 14%;height:18px;" role="progressbar"><span><small>EVAL</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>EVAL</small></span></a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:7%;border-top:0px;border-right:0px;text-align:right">KONTRAK</td>
                                <td style="border-top:0px;border-left:0px;" colspan="4">
                                    <?php if ($dt_mkt->no_spk != '') { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#BFEAF5;width: 32.657%;height:18px;" role="progressbar"><span><small>SPK</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 32.657%;height:18px;" role="progressbar"><span><small>SPK</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_draft > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7E99EE;width: 32.657%;height:18px;color:white" role="progressbar"><span><small>DRAFT</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 32.657%;height:18px;" role="progressbar"><span><small>DRAFT</small></span></a>
                                    <?php } ?>
                                    <?php if ($dt_mkt->tgl_ttd > 0) { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:#7355F3;width: 32.657%;height:18px;color:white" role="progressbar"><span><small>SPER</small></span></a>
                                    <?php } else { ?>
                                        <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 32.657%;height:18px;" role="progressbar"><span><small>SPER</small></span></a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                            $total = 0;
                            $total2 = 0;
                            $no++;
                        }  ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open(base_url('laporan/tambahtender'), ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Data</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">No. List<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_list" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group  pkp">
                                <label class="col-sm-3 control-label">Divisi<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="divisi" required>
                                        <option value="">Silahkan Pilih Divisi</option>
                                        <option value="GEDUNG">GEDUNG</option>
                                        <option value="KTL">KTL</option>
                                        <option value="TRANSPORTASI">TRANSPORTASI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">Lingkup<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="lingkup" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">Nama Proyek<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_proyek" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Tanggal Undangan<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_undangan" id="tanggal" autocomplete="off" class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitform">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
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
    /*
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 1,
    });*/
    document.getElementById("FormulirTambah").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform").setAttribute('disabled', 'disabled');
        $('#submitform').html('Loading ...');
        var form = $('#FormulirTambah')[0];
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                document.getElementById("submitform").removeAttribute('disabled');
                $('#submitform').html('Submit');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        Swal.fire({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            position: "top-end",
                            showConfirmButton: false,
                            icon: 'error'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform").removeAttribute('disabled');
                $('#tambahData').modal('hide');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');
                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            Swal.fire({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                position: "top-end",
                showConfirmButton: false,
                icon: 'error'

            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
</script>
<?= $this->endSection() ?>