<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>
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
                <h4 class="card-title">DASHBOARD MARKETING</h4>
                <div class="table-scrollable" style="height: 500px;width:100%; overflow-x:auto">
                    <table cellspacing="0" id="table-basic" class="table table-sm table-bordered " style="width:100%">
                        <thead style="top: 0;position: sticky">
                            <tr style="background-color:#1b3a59;color:white;">
                                <th style="text-align:center;vertical-align:middle;width:35%" colspan="2">PROYEK</th>
                                <th style="text-align:center;vertical-align:middle;" colspan="3">PROGRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $total = 0;
                            $total2 = 0;
                            foreach ($data_marketing as $dt_mkt) {
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
                                    <td rowspan="2">
                                        <a style="font-size: 12px;font-weight: 400;"><?php echo $no ?></a>
                                    </td>
                                    <td rowspan="2">
                                        <a style="font-size: 12px;font-weight: 400;" class="link" href="<?php echo base_url() ?>laporan/data_umum_mkt/<?php echo $dt_mkt->id_marketing ?>"><?php echo $dt_mkt->nama_proyek ?></a><br>

                                        <a style="font-size: 12px;font-weight: 400" class="link" href="<?php echo base_url() ?>laporan/data_umum_mkt/<?php echo $dt_mkt->id_marketing ?>"><i>Last Upd: <b><?php echo $tgl_ubah ?></a>

                                    </td>

                                    <?php

                                    //MAEN TANGGAL
                                    date_default_timezone_set("Asia/Jakarta");
                                    $now = date("Y-m-d");

                                    // ALERT BELUM MEMILIKI TGL RENCANA //
                                    $hitung = 0;
                                    $posisi = 0;
                                    if ($dt_mkt->tgl_pq == 0 or ($dt_mkt->tgl_pq > 0 and $dt_mkt->tgl_pq_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        $posisi = 1;
                                    }
                                    if ($dt_mkt->tgl_awz == 0 or ($dt_mkt->tgl_awz > 0 and $dt_mkt->tgl_awz_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 2;
                                        }
                                    }
                                    if ($dt_mkt->tgl_admin == 0 or ($dt_mkt->tgl_admin > 0 and $dt_mkt->tgl_admin_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 3;
                                        }
                                    }
                                    if ($dt_mkt->tgl_per_mkt == 0 or ($dt_mkt->tgl_per_mkt > 0 and $dt_mkt->tgl_per_mkt_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 4;
                                        }
                                    }
                                    if ($dt_mkt->tgl_per_ops == 0 or ($dt_mkt->tgl_per_ops > 0 and $dt_mkt->tgl_per_ops_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 5;
                                        }
                                    }
                                    if ($dt_mkt->tgl_per_sdm == 0 or ($dt_mkt->tgl_per_sdm > 0 and $dt_mkt->tgl_per_sdm_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 6;
                                        }
                                    }
                                    if ($dt_mkt->tgl_per_form == 0 or ($dt_mkt->tgl_per_form > 0 and $dt_mkt->tgl_per_form_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 7;
                                        }
                                    }
                                    if ($dt_mkt->tgl_teknis == 0 or ($dt_mkt->tgl_teknis > 0 and $dt_mkt->tgl_teknis_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 8;
                                        }
                                    }
                                    if ($dt_mkt->tgl_harga == 0 or ($dt_mkt->tgl_harga > 0 and $dt_mkt->tgl_harga_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 9;
                                        }
                                    }
                                    if ($dt_mkt->tgl_pemasukan == 0 or ($dt_mkt->tgl_pemasukan > 0 and $dt_mkt->tgl_pemasukan_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 10;
                                        }
                                    }
                                    if ($dt_mkt->tgl_presentasi == 0 or ($dt_mkt->tgl_presentasi > 0 and $dt_mkt->tgl_presentasi_r > 0)) {
                                        $hitung = $hitung + 0;
                                    } else {
                                        $hitung = $hitung + 1;
                                        if ($posisi == 0) {
                                            $posisi = 11;
                                        }
                                    }
                                    if ($dt_mkt->tgl_presentasi_r > 0) {
                                        $hitung = $hitung + 1;
                                    }
                                    if ($dt_mkt->peringkat > 0) {
                                        $hitung = $hitung + 1;
                                    }

                                    if ($hitung == 0) {
                                        $hb = 'heartbitB';
                                        $pt = 'pointB';
                                        $ttl = 'Belum memiliki tanggal rencana proses selanjutnya';
                                    } else {
                                        if ($posisi > 0) {
                                            $hb = '';
                                            $pt = '';
                                            $ttl = '';
                                            $selisih = 100;
                                            if ($posisi == 1) {
                                                $ttl = 'Tanggal PQ akan dilaksanakan: ' . date('d-m-Y', strtotime($dt_mkt->tgl_pq));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_pq) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_pq)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 2) {
                                                $ttl = 'Tanggal AANWIJZING akan dilaksanakan: ' . date('d-m-Y', strtotime($dt_mkt->tgl_awz));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_awz) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_awz)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 3) {
                                                $ttl = 'Tanggal ADMIN Proposal akan dilaksanakan: ' . date('d-m-Y', strtotime($dt_mkt->tgl_admin));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_admin) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_admin)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 4) {
                                                $ttl = 'Target TOR Marketing: ' . date('d-m-Y', strtotime($dt_mkt->tgl_per_mkt));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_per_mkt) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_per_mkt)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 5) {
                                                $ttl = 'Target Nama dari OPS: ' . date('d-m-Y', strtotime($dt_mkt->tgl_per_ops));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_per_ops) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_per_ops)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 6) {
                                                $ttl = 'Target sertivikasi/CV SDM: ' . date('d-m-Y', strtotime($dt_mkt->tgl_per_sdm));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_per_sdm) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_per_sdm)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 7) {
                                                $ttl = 'Target pengisian FORM personil: ' . date('d-m-Y', strtotime($dt_mkt->tgl_per_form));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_per_form) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_per_form)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 8) {
                                                $ttl = 'Target Penyerahan Proposal Teknis: ' . date('d-m-Y', strtotime($dt_mkt->tgl_teknis));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_teknis) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_teknis)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 9) {
                                                $ttl = 'Target Penyampaian Harga: ' . date('d-m-Y', strtotime($dt_mkt->tgl_harga));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_harga) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_harga)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 10) {
                                                $ttl = 'Batas Tanggal Pemasukan: ' . date('d-m-Y', strtotime($dt_mkt->tgl_pemasukan));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_pemasukan) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_pemasukan)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                            if ($posisi == 11) {
                                                $ttl = 'Tanggal Rencana Presentasi: ' . date('d-m-Y', strtotime($dt_mkt->tgl_presentasi));
                                                $hari = ((abs(strtotime($dt_mkt->tgl_presentasi) - (strtotime($now)))) / 86400);
                                                if (strtotime($now) > strtotime($dt_mkt->tgl_presentasi)) {
                                                    $selisih = $hari * -1;
                                                } else {
                                                    $selisih = $hari;
                                                }
                                                if ($selisih >= 7 and $selisih <= 11) {
                                                    $hb = 'heartbitK';
                                                    $pt = 'pointK';
                                                }
                                                if ($selisih < 7 and $selisih >= 0) {
                                                    $hb = 'heartbitM';
                                                    $pt = 'pointM';
                                                }
                                                if ($selisih < 0) {
                                                    $hb = 'heartbitZ';
                                                    $pt = 'pointZ';
                                                    $ttl = 'Terlewati ' . $ttl;
                                                }
                                            }
                                        } else {
                                            $hb = '';
                                            $pt = '';
                                            $ttl = '';
                                        }
                                    }


                                    ?>
                                    <td style="width:3%;border-bottom:0px;border-right:0px;text-align:center;vertical-align: middle;" rowspan="2">
                                        <div class="notify"> <a href="<?php echo base_url() ?>laporan/marketing/<?php echo $dt_mkt->id_marketing ?>"><span class="<?php echo $hb ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $ttl ?>"></span> <span class="<?php echo $pt ?>"></span> </a></div>
                                    </td>

                                    <td style="width:5%;border-bottom:0px;border-right:0px;border-left:0px;text-align:right">TENDER</td>
                                    <td style="border-bottom:0px;border-left:0px">
                                        <?php if ($dt_mkt->tgl_undangan > 0) { ?>
                                            <a class="progress-bar wow animated progress-animated" style="background-color:#76ADE6;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PENG</small></span></a>
                                        <?php } else { ?>
                                            <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar"><span><small>PENG</small></span></a>
                                        <?php } ?>
                                        <?php if ($dt_mkt->tgl_pq_r > 0) { ?>
                                            <a class="progress-bar wow animated progress-animated" style="background-color:#7E99EE;color:white;width: 14%;height:18px;" role="progressbar"><span><small>PQ</small></span></a>
                                        <?php } else { ?>
                                            <a class="progress-bar wow animated progress-animated" style="background-color:white;border-style:solid;border-width:1px;border-color:#DCDCDC;width: 14%;height:18px;" role="progressbar">
                                                <span><small>PQ</small></span></a>
                                        <?php } ?>
                                        <?php if ($dt_mkt->tgl_awz_r > 0) { ?>
                                            <a class="progress-bar wow animated progress-animated" style="background-color:#7E85FE;color:white;width: 14%;height:18px;" role="progressbar"><span><small>AWZ</small></span></a>
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
                                    <td style="width:10%;border-top:0px;border-right:0px;text-align:right;border-left:0px">KONTRAK</td>
                                    <td style="border-top:0px;border-left:0px;">
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
    <?php } ?>
</div>

</section>
</body>

</html>

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
<?= $this->endSection() ?>