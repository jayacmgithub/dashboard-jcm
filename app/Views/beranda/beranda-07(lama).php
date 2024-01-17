<?php $this->load->view("komponen/atas.php") ?>

<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">
<?php
$idQNS = $this->session->userdata('idadmin');
$isi = $this->db->from("master_admin")->where('id', $idQNS, 1)->get()->row();
$kategoriQNS = $isi->kategori_user;
?>

<ul class="nav nav-tabs" id="myTab" role="tablist">

    <?php if ($pro1 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_01" role="tab" aria-controls="gedung1" aria-selected="true">GEDUNG 1</a>
        </li>
    <?php } ?>
    <?php if ($pro2 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_02" role="tab" aria-controls="gedung2" aria-selected="true">GEDUNG 2</a>
        </li>
    <?php } ?>
    <?php if ($pro3 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_03" role="tab" aria-controls="gedung3" aria-selected="true">KTL 1</a>
        </li>
    <?php } ?>
    <?php if ($pro4 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_04" role="tab" aria-controls="gedung4" aria-selected="true">KTL 2</a>
        </li>
    <?php } ?>

    <?php if ($pro5 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_05" role="tab" aria-controls="gedung5" aria-selected="true">TRANSPORTASI 1</a>
        </li>

    <?php } ?>
    <?php if ($pro6 == 1) { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>dashboard/beranda_06" role="tab" aria-controls="gedung6" aria-selected="true">TRANSPORTASI 2</a>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link active" id="gedung7-tab" data-toggle="tab" href="#gedung7" role="tab" aria-controls="gedung7" aria-selected="true">MARKETING</a>
    </li>
</ul>
<?php date_default_timezone_set("Asia/Jakarta");
$now = date("Y-m-d");
$tgl_terawang = date('Y-m-d', strtotime('-365 days', strtotime($now)));
?>

<div class="tab-content" id="myTabContent">
    <!--GEDUNG1-->
    <?php if ($pro7 == 1) { ?>
        <div class="tab-pane active" id="gedung7" role="tabpanel" aria-labelledby="gedung7-tab">
            <!---->
            <div>
                <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                <h6 class="card-subtitle">TABEL DATA MARKETING</h6>
                <div class="table-scrollable" style="height: 480px;width:100%">
                    <table cellspacing="0" id="table-basic" class="table table-sm table-bordered " style="width:100%">
                        <thead>
                            <tr style="background-color:#1b3a59;color:white;">
                                <th style="text-align:center;vertical-align:middle;">PROYEK</th>
                                <th style="text-align:center;vertical-align:middle;" colspan="3">PROGRESS</th>
                                <th style="text-align:center;vertical-align:middle;" colspan="2">TOTAL</th>
                            </tr>
                            <?php
                            if ($jml_undangan > 0) {
                                $prosen1a = ($jml_undangan / $total_tender) * 100;
                            } else {
                                $prosen1a = 0;
                            }
                            $prosen1b = 100 - $prosen1a;
                            $rencana1a = 'style="width:' . $prosen1a . '%;height:18px;"';
                            $rencana1b = 'style="width:' . $prosen1b . '%;height:18px;"';

                            if ($jml_pq > 0) {
                                $prosen2a = ($jml_pq / $total_tender) * 100;
                            } else {
                                $prosen2a = 0;
                            }
                            $prosen2b = 100 - $prosen2a;
                            $rencana2a = 'style="width:' . $prosen2a . '%;height:18px;"';
                            $rencana2b = 'style="width:' . $prosen2b . '%;height:18px;"';

                            if ($jml_awz > 0) {
                                $prosen3a = ($jml_awz / $total_tender) * 100;
                            } else {
                                $prosen3a = 0;
                            }
                            $prosen3b = 100 - $prosen3a;
                            $rencana3a = 'style="width:' . $prosen3a . '%;height:18px;"';
                            $rencana3b = 'style="width:' . $prosen3b . '%;height:18px;"';

                            if ($jml_admin > 0) {
                                $prosen4a = ($jml_admin / $total_tender) * 100;
                            } else {
                                $prosen4a = 0;
                            }
                            $prosen4b = 100 - $prosen4a;
                            $rencana4a = 'style="width:' . $prosen4a . '%;height:18px;"';
                            $rencana4b = 'style="width:' . $prosen4b . '%;height:18px;"';

                            if ($jml_pemasukan > 0) {
                                $prosen5a = ($jml_pemasukan / $total_tender) * 100;
                            } else {
                                $prosen5a = 0;
                            }
                            $prosen5b = 100 - $prosen5a;
                            $rencana5a = 'style="width:' . $prosen5a . '%;height:18px;"';
                            $rencana5b = 'style="width:' . $prosen5b . '%;height:18px;"';

                            if ($jml_presentasi > 0) {
                                $prosen6a = ($jml_presentasi / $total_tender) * 100;
                            } else {
                                $prosen6a = 0;
                            }
                            $prosen6b = 100 - $prosen6a;
                            $rencana6a = 'style="width:' . $prosen6a . '%;height:18px;"';
                            $rencana6b = 'style="width:' . $prosen6b . '%;height:18px;"';

                            if ($jml_evaluasi > 0) {
                                $prosen7a = ($jml_evaluasi / $total_tender) * 100;
                            } else {
                                $prosen7a = 0;
                            }
                            $prosen7b = 100 - $prosen7a;
                            $rencana7a = 'style="width:' . $prosen7a . '%;height:18px;"';
                            $rencana7b = 'style="width:' . $prosen7b . '%;height:18px;"';

                            if ($jml_proses > 0) {
                                $prosen8a = ($jml_proses / $total_kontrak) * 100;
                            } else {
                                $prosen8a = 0;
                            }
                            $prosen8b = 100 - $prosen8a;
                            $rencana8a = 'style="width:' . $prosen8a . '%;height:18px;"';
                            $rencana8b = 'style="width:' . $prosen8b . '%;height:18px;"';

                            if ($jml_spk > 0) {
                                $prosen9a = ($jml_spk / $total_kontrak) * 100;
                            } else {
                                $prosen9a = 0;
                            }
                            $prosen9b = 100 - $prosen9a;
                            $rencana9a = 'style="width:' . $prosen9a . '%;height:18px;"';
                            $rencana9b = 'style="width:' . $prosen9b . '%;height:18px;"';

                            if ($jml_draft > 0) {
                                $prosen10a = ($jml_draft / $total_kontrak) * 100;
                            } else {
                                $prosen10a = 0;
                            }
                            $prosen10b = 100 - $prosen10a;
                            $rencana10a = 'style="width:' . $prosen10a . '%;height:18px;"';
                            $rencana10b = 'style="width:' . $prosen10b . '%;height:18px;"';

                            if ($jml_ttd > 0) {
                                $prosen11a = ($jml_ttd / $total_kontrak) * 100;
                            } else {
                                $prosen11a = 0;
                            }
                            $prosen11b = 100 - $prosen11a;
                            $rencana11a = 'style="width:' . $prosen11a . '%;height:18px;"';
                            $rencana11b = 'style="width:' . $prosen11b . '%;height:18px;"';

                            $prosen12a = 0;
                            $prosen12b = 0;
                            if ($total_dt_mkt > 0) {
                                $prosen12a = 100;
                                $prosen12b = 0;
                            } else {
                                $prosen12b = 100;
                                $prosen12a = 0;
                            }
                            $rencana12a = 'style="width:' . $prosen12a . '%;height:18px;"';
                            $rencana12b = 'style="width:' . $prosen12b . '%;height:18px;"';

                            if ($jml_bast_1 > 0) {
                                $prosen13a = ($jml_bast_1 / $total_dt_mkt) * 100;
                            } else {
                                $prosen13a = 0;
                            }
                            $prosen13b = 100 - $prosen13a;
                            $rencana13a = 'style="width:' . $prosen13a . '%;height:18px;"';
                            $rencana13b = 'style="width:' . $prosen13b . '%;height:18px;"';

                            if ($jml_bast_2 > 0) {
                                $prosen14a = ($jml_bast_2 / $total_dt_mkt) * 100;
                            } else {
                                $prosen14a = 0;
                            }
                            $prosen14b = 100 - $prosen14a;
                            $rencana14a = 'style="width:' . $prosen14a . '%;height:18px;"';
                            $rencana14b = 'style="width:' . $prosen14b . '%;height:18px;"';

                            if ($jml_surat_ref > 0) {
                                $prosen15a = ($jml_surat_ref / $total_dt_mkt) * 100;
                            } else {
                                $prosen15a = 0;
                            }
                            $prosen15b = 100 - $prosen15a;
                            $rencana15a = 'style="width:' . $prosen15a . '%;height:18px;"';
                            $rencana15b = 'style="width:' . $prosen15b . '%;height:18px;"';
                            ?>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="text-align:left;width:25%;border-bottom:0px;"><a href="<?php echo base_url() ?>laporan/marketing" style="color:black;font-size:14px;font-weight:600">PROGRESS TENDER</a></td>
                                <td style="text-align:right;width:12%;border-bottom:0px;font-size:14px;">UNDANGAN</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen1a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana1a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana1b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-bottom:0px;"><?php echo $jml_undangan . ' PROYEK'; ?></td>
                                <td style="text-align:center;vertical-align:middle;width:10%;border-bottom:0px;" rowspan="7"><?php echo $total_tender . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;width:25%;border-top:0px;border-bottom:0px;" rowspan="6"></td>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">PQ</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen2a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana2a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana2b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_pq . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">AANWIJZING</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen3a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana3a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana3b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_awz . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">PROPOSAL</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen4a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana4a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana4b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_admin . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">PEMASUKAN</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen5a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana5a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana5b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_pemasukan . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">PRESENTASI</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen6a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana6a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana6b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_presentasi . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;font-size:14px;">HASIL EVALUASI</td>
                                <td style="text-align:center;width:30%;border-top:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen7a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana7a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana7b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;"><?php echo $jml_evaluasi . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;width:25%;border-bottom:0px;" rowspan="4"><a href="<?php echo base_url() ?>laporan/kontrak" style="color:black;font-size:14px;font-weight:600">PROGRESS KONTRAK</a></td>
                                <td style="text-align:right;width:12%;border-bottom:0px;font-size:14px;">PROSES SPK</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen8a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana8a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana8b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-bottom:0px;"><?php echo $jml_proses . ' PROYEK'; ?></td>
                                <td style="text-align:center;vertical-align:middle;width:10%;border-bottom:0px;" rowspan="4"><?php echo $total_kontrak . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">SPK</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen9a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana9a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana9b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_spk . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">DRAFT</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen10a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana10a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana10b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_draft . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">TTD</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen11a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana11a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana11b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_ttd . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;width:25%;border-bottom:0px;"><a href="<?php echo base_url() ?>laporan/data_mkt" style="color:black;font-size:14px;font-weight:600">DATA MARKETING</a></td>
                                <td style="text-align:right;width:12%;border-bottom:0px;font-size:14px;">TOTAL PROYEK</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen12a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana12a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana12b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-bottom:0px;"><?php echo $total_dt_mkt . ' PROYEK'; ?></td>
                                <td style="text-align:center;vertical-align:middle;width:10%;border-bottom:0px;" rowspan="4"></td>
                            </tr>
                            <tr>
                                <td style="text-align:left;width:25%;border-top:0px;border-bottom:0px;" rowspan="4"></td>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">BAST 1</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen13a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana13a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana13b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_bast_1 . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">BAST 2</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen14a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana14a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana14b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_bast_2 . ' PROYEK'; ?></td>
                            </tr>
                            <tr>
                                <td style="text-align:right;width:12%;border-top:0px;border-bottom:0px;font-size:14px;">SURAT REF.</td>
                                <td style="text-align:center;width:30%;border-top:0px;border-bottom:0px;">
                                    <div><span style="font-size: 12px;font-weight: 600;color:black;position:fixed"><?php echo number_format($prosen15a, 0, '.', ',') ?> %</span>
                                        <a class="progress-bar bg-info3 wow animated progress-animated" <?php echo $rencana15a ?> role="progressbar"></a>
                                        <a class="progress-bar bg-infoA wow animated progress-animated" <?php echo $rencana15b ?> role="progressbar"></a>
                                    </div>
                                </td>
                                <td style="text-align:right;width:10%;border-top:0px;border-bottom:0px;"><?php echo $jml_surat_ref . ' PROYEK'; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

</section>
</body>

</html>

<!-- end: page -->
<?php $this->load->view("komponen/bawah.php") ?>
<!-- JS -->
<?php $this->load->view("komponen/js.php") ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('ul li a').click(function() {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
    });
    /*
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 1,
    });*/
</script>