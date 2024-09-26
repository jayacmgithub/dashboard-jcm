<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>

<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="gedung1-tab" data-toggle="tab" href="#gedung1" role="tab" aria-controls="gedung1" aria-selected="true">GEDUNG 1</a>
        </li>
        <?php if ($pro2 == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/beranda_02" role="tab" aria-controls="gedung2" aria-selected="true">GEDUNG 2</a>
            </li>
        <?php } ?>
        <?php if ($pro3 == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/beranda_03" role="tab" aria-controls="gedung3" aria-selected="true">KTL 1 <?php $pro4 . ':' . $pro3 ?> </a>
            </li>
        <?php } ?>
        <?php if ($pro4 == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/beranda_04" role="tab" aria-controls="gedung4" aria-selected="true">KTL 2 <?php $pro4 ?></a>
            </li>
        <?php } ?>
        <?php if ($pro5 == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/beranda_05" role="tab" aria-controls="gedung5" aria-selected="true">TRANSPORTASI 1</a>
            </li>
        <?php } ?>
        <?php if ($pro6 == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/beranda_06" role="tab" aria-controls="gedung6" aria-selected="true">TRANSPORTASI 2</a>
            </li>
        <?php } ?>
        <?php if ($pro7 == 1) { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/beranda_07" role="tab" aria-controls="gedung7" aria-selected="true">MARKETING</a>
            </li>
        <?php } ?>
        <!-- <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>dashboard/invoice" role="tab" aria-controls="gedung8" aria-selected="true">INVOICE</a>
            </li> -->    </ul>
    <?php date_default_timezone_set("Asia/Jakarta");
    $now = date("Y-m-d");
    $tgl_terawang = date('Y-m-d', strtotime('-365 days', strtotime($now)));
    ?>

    <div class="tab-content" id="myTabContent">
        <!--GEDUNG1-->
        <?php if ($pro1 == 1) { ?>
            <div class="tab-pane active" id="gedung1" role="tabpanel" aria-labelledby="gedung1-tab">
                <!---->
                <div>
                    <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                    <h6 class="card-subtitle">TABEL DATA GEDUNG 1</h6>
                    <div class="table-scrollable" style="height: 480px;width:100%">
                        <table cellspacing="0" class="table table-sm table-bordered table-striped" style="width:100%" id="example">
                            <thead style="background-color:#1b3a59;color:white;">
                                <tr>
                                    <th style="text-align:center" colspan="2">PROYEK</th>
                                    <th style="text-align:center" colspan="2">PROGRESS</th>
                                    <th style="text-align:center;width: 5%">DEVIASI
                                    </th>
                                    <th style="text-align:center;width: 8%">BATAS TELAT %
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($proyek1 as $det) {
                                    if ($det->validasi_kapro < 1) {
                                        $valid = 'Data belum tervalidasi';
                                    } else {
                                        $valid = 'Data tervalidasi';
                                    }
                                    $tgl_close = $det->tgl_close;
                                    $sisa1 = 100 - $det->rensd_mgini;
                                    $sisa2a = 100 - $det->rilsd_mgini;
                                    $sisa3 = $det->rilsd_mgini - $det->rensd_mgini;
                                    if ($sisa3 < 0) {
                                        $reala = $det->rilsd_mgini;
                                        $dev = $det->devsd_mgini * -1;
                                        $sisa2 = $sisa2a - $dev;
                                    } else {
                                        $reala = $det->rensd_mgini;
                                        $dev = $det->devsd_mgini;
                                        $sisa2 = $sisa2a;
                                    }
                                    $rencana = 'style="width: ' . $det->rensd_mgini . '%;height:18px;"';
                                    $rencana2 = 'style="width: ' . $sisa1 . '%;height:18px;"';

                                    $realisasi = 'style="width: ' . $det->rilsd_mgini . '%;height:18px;"';

                                    $realisasi2 = 'style="width: ' . $sisa2 . '%;height:18px;"';

                                    $deviasi2 = 'style="width: ' . $dev . '%;height:18px;"';
                                    $real = 'style="width: ' . $reala . '%;height:18px;"';
                                ?>
                                    <?php
                                    if ($tgl_close < 1 or ($tgl_close > 0 and $tgl_close > $tgl_terawang)) {
                                    ?>
                                        <tr>
                                            <td style="border-right: 5px;width: 25%;vertical-align: middle;">
                                                <a style="font-size: 16px;font-weight: 400" class="link" href="<?= base_url() ?>proyek/edit_1/<?= $det->id_pkp ?>"><?= $det->alias ?></a><br>
                                                <a style="font-size: 12px;font-weight: 400" class="link" href="<?= base_url() ?>proyek/edit_1/<?= $det->id_pkp ?>"><i>Last Upd: <b><?= (date('d-M-Y', strtotime($det->tgl_ubah_progress))) ?></b><?= ' (Periode: ' . $det->bulan . '/' . $det->tahun . ')' ?></i><small> <b><?= $valid ?></b></small></a>
                                            </td>
                                            <td style="border-left: 5px; width: 3%;vertical-align: middle;">
                                                <?php if ($det->devsd_mgini <= $det->late and $det->rensd_mgini > 0) { ?>
                                                    <div class="notify"> <a href="<?= base_url() ?>proyek/edit_2/<?= $det->id_pkp ?>"><span class="heartbitM" data-toggle="tooltip" data-placement="top" title="Terdapat Pekerjaan sudah telat lebih dari <?= number_format($det->late, 2) ?>%"></span> <span class="pointM"></span> </a></div>
                                                <?php } else { ?>
                                                    <?php if ($det->devsd_mgini > $det->late and $det->devsd_mgini <= $det->warning and $det->rilsd_mgini < 100) { ?>
                                                        <div class="notify"> <a href="<?= base_url() ?>proyek/edit_2/<?= $det->id_pkp ?>"><span class="heartbitK" data-toggle="tooltip" data-placement="top" title="Terdapat Pekerjaan yang berpotensi terlambat, batas telat <?= number_format($det->late, 2) ?>%"></span> <span class="pointK"></span></a> </div>
                                                    <?php } else { ?>
                                                        <?php if ($det->alert > 0) { ?>
                                                            <div class="notify"> <a href="<?= base_url() ?>proyek/edit_2/<?= $det->id_pkp ?>"> </a></div>
                                                <?php }
                                                    }
                                                } ?>
                                            </td>
                                            <td style="text-align:center;width: 5%;vertical-align: middle;">
                                                <div class="progress-bar bg-light text-dark wow animated progress-animated" role="progressbar" role="progressbar">PLAN</div>
                                                <br>
                                                <div class="progress-bar bg-light text-dark wow animated progress-animated" role="progressbar" role="progressbar">ACTUAL</div>
                                            </td>
                                            <td style="width: 20%;line-height: 10px; vertical-align: middle;">
                                                <div class="progress-bar bg-info3 wow animated progress-animated" <?= $rencana ?> role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"><?= number_format($det->rensd_mgini, 2) ?> %</span></div>
                                                <div class="progress-bar bg-infoA wow animated progress-animated" <?= $rencana2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>
                                                <br><br>
                                                <?php
                                                if ($det->devsd_mgini < 0) { ?>
                                                    <div class="progress-bar bg-info2 wow animated progress-animated" role="progressbar" <?= $real ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap"><?= number_format($det->rilsd_mgini, 2) ?> %</span> </div>
                                                    <div class="progress-bar bg-infoM wow animated progress-animated" <?= $deviasi2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>
                                                    <div class="progress-bar bg-infoA wow animated progress-animated" <?= $realisasi2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>
                                                    <?php
                                                } else {
                                                    if ($det->devsd_mgini > 1) {
                                                    ?>

                                                        <div class="progress-bar bg-info2 wow animated progress-animated" role="progressbar" <?= $real ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap"><?= number_format($det->rilsd_mgini, 2) ?> %</span> </div>
                                                        <div class="progress-bar bg-infoH wow animated progress-animated" <?= $deviasi2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>
                                                        <div class="progress-bar bg-infoA wow animated progress-animated" <?= $realisasi2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>

                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="progress-bar bg-info2 wow animated progress-animated" role="progressbar" <?= $real ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap"><?= number_format($det->rilsd_mgini, 2) ?> %</span> </div>
                                                        <div class="progress-bar bg-infoH wow animated progress-animated" <?= $deviasi2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>
                                                        <div class="progress-bar bg-infoA wow animated progress-animated" <?= $realisasi2 ?>role="progressbar"> <span style="font-size: 12px;font-weight: 600;color:#fafafa;white-space: nowrap;"></span></div>
                                                <?php
                                                    }
                                                } ?>

                                            </td>
                                            <?php if ($det->devsd_mgini < 0) { ?>
                                                <td style="text-align:center;width: 5%;color:#F84037;vertical-align: middle; font-size:medium"><b><?= number_format($det->devsd_mgini, 2) ?>%</b></span></td>
                                            <?php  } else { ?>
                                                <td style="text-align:center;width: 5%;vertical-align: middle; font-size:medium;"><b><?= number_format($det->devsd_mgini, 2) ?>%</b></span></td>
                                            <?php } ?>
                                            <td style="text-align:center;width: 5%;vertical-align: middle; font-size:medium;"><b><?= number_format($det->late, 2) ?>%</b></span></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="row ">
                        <div class="col-lg-12">
                            <span class="label3 label-info m-r-5 text-success" style="background-color: #66DA40;margin-top: 2px"></span> <a style="font-size: 12px;">Ahead </a>
                            <span class="label3 label-info m-r-5 text-success" style="background-color: #F9F950;margin-top: 2px"></span> <a style="font-size: 12px;">Warning</a>
                            <span class="label3 label-info m-r-5 text-success" style="background-color: #F84037;margin-top: 2px"></span> <a style="font-size: 12px;">Late</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('ul li a').click(function() {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
    });
    $(".table-scrollable").freezeTable({
        'scrollable': true,
    });
    /* $(".table-scrollable").freezeTable({
         'scrollable': true,
         'columnNum': 1,
     }); */
</script>

<?= $this->endSection() ?>