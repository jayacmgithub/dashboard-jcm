<ul class="nav nav-tabs" id="myTab" role="tablist">
    <?php if ($pro1 == 1) { ?>
            <?php if ($pro1 == 1 and $pro > 0) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung1-tab" data-toggle="tab" href="#gedung1" role="tab" aria-controls="gedung1" aria-selected="true">GEDUNG 1</a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung1-tab" data-toggle="tab" href="#gedung1" role="tab" aria-controls="gedung1" aria-selected="true">GEDUNG 1</a>
                    </li>
        <?php }
    } ?>
    <?php if ($pro2 == 1) { ?>
            <?php if (($pro2 == 1 and $pro == 1) or ($pro2 == 1 and $pro == 2)) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung2-tab" data-toggle="tab" href="#gedung2" role="tab" aria-controls="gedung2" aria-selected="false">GEDUNG 2</a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung2-tab" data-toggle="tab" href="#gedung2" role="tab" aria-controls="gedung2" aria-selected="false">GEDUNG 2</a>
                    </li>
        <?php }
    } ?>
    <?php if ($pro3 == 1) { ?>
            <?php if ($pro3 == 1 or ($pro3 == 1 and $pro4 == 1)) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung3-tab" data-toggle="tab" href="#gedung3" role="tab" aria-controls="gedung3" aria-selected="false">KTL 1</a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung3-tab" data-toggle="tab" href="#gedung3" role="tab" aria-controls="gedung3" aria-selected="false">KTL 1</a>
                    </li>
        <?php }
    } ?>
    <?php if ($pro4 == 1) { ?>
            <?php if ($pro4 == 1 and $pro == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung4-tab" data-toggle="tab" href="#gedung4" role="tab" aria-controls="gedung4" aria-selected="false">KTL 2</a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung4-tab" data-toggle="tab" href="#gedung4" role="tab" aria-controls="gedung4" aria-selected="false">KTL 2</a>
                    </li>
        <?php }
    } ?>
    <?php if ($pro5 == 1) { ?>
            <?php if ($pro5 == 1 or ($pro5 == 1 and $pro6 == 1)) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung5-tab" data-toggle="tab" href="#gedung5" role="tab" aria-controls="gedung5" aria-selected="false">TRANSPORTASI 1 <?= $pro5 ?></a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung5-tab" data-toggle="tab" href="#gedung5" role="tab" aria-controls="gedung5" aria-selected="false">TRANSPORTASI 1</a>
                    </li>
        <?php }
    } ?>
    <?php if ($pro6 == 1) { ?>
            <?php if ($pro6 == 1 and $pro == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung6-tab" data-toggle="tab" href="#gedung6" role="tab" aria-controls="gedung6" aria-selected="false">TRANSPORTASI 2</a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung6-tab" data-toggle="tab" href="#gedung6" role="tab" aria-controls="gedung6" aria-selected="false">TRANSPORTASI 2</a>
                    </li>
        <?php }
    } ?>
    <?php if ($pro7 == 1) { ?>
            <?php if ($pro7 == 1 and $pro == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="gedung7-tab" data-toggle="tab" href="#gedung7" role="tab" aria-controls="gedung7" aria-selected="false">MARKETING</a>
                    </li>
            <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" id="gedung7-tab" data-toggle="tab" href="#gedung7" role="tab" aria-controls="gedung7" aria-selected="false">MARKETING</a>
                    </li>
        <?php }
    } ?>

</ul>
<div class="tab-content" id="myTabContent">
    <!--GEDUNG1-->
    <?php if ($pro1 == 1) { ?>
            <?php if ($pro1 == 1 and $pro > 0) { ?>
                    <div class="tab-pane active" id="gedung1" role="tabpanel" aria-labelledby="gedung1-tab">
                <?php } else { ?>
                        <div class="tab-pane fade" id="gedung1" role="tabpanel" aria-labelledby="gedung1-tab">
                    <?php } ?>
                    <!---->
                    <div>
                        <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                        <h6 class="card-subtitle">TABEL DATA GEDUNG 1</h6>
                        <div class="table-responsive">

                            <table class="table table-bordered dataTable">
                                <thead>
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
                                                        <?php } else { ?>
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
            <!--GEDUNG2-->
            <?php if ($pro2 == 1) { ?>
                    <?php if (($pro2 == 1 and $pro == 1) or ($pro2 == 1 and $pro == 2)) { ?>
                            <div class="tab-pane active" id="gedung2" role="tabpanel" aria-labelledby="gedung2-tab">
                        <?php } else { ?>
                                <div class="tab-pane fade" id="gedung2" role="tabpanel" aria-labelledby="gedung2-tab">
                            <?php } ?>
                            <div>
                                <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                                <h6 class="card-subtitle">TABEL DATA GEDUNG 2</h6>
                                <div class="table-responsive">

                                    <table class="table table-bordered dataTable">
                                        <thead>
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
                                            <?php foreach ($proyek2 as $det) {
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
                                                                <?php } else { ?>
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
                    <!--GEDUNG3-->
                    <?php if ($pro3 == 1) { ?>
                            <?php if ($pro3 == 1 or ($pro3 == 1 and $pro4 == 1)) { ?>
                                    <div class="tab-pane active" id="gedung3" role="tabpanel" aria-labelledby="gedung3-tab">
                                <?php } else { ?>
                                        <div class="tab-pane fade" id="gedung3" role="tabpanel" aria-labelledby="gedung3-tab">
                                    <?php } ?>
                                    <div>
                                        <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                                        <h6 class="card-subtitle">TABEL DATA KTL 1</h6>
                                        <div class="table-responsive">

                                            <table class="table table-bordered dataTable">
                                                <thead>
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
                                                    <?php foreach ($ktl as $det) {
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
                                                                        <?php } else { ?>
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
                            <!--GEDUNG4-->
                            <?php if ($pro4 == 1) { ?>
                                    <?php if ($pro4 == 1 and $pro == 1) { ?>
                                            <div class="tab-pane active" id="gedung4" role="tabpanel" aria-labelledby="gedung4-tab">
                                        <?php } else { ?>
                                                <div class="tab-pane fade" id="gedung4" role="tabpanel" aria-labelledby="gedung4-tab">
                                            <?php } ?>
                                            <div>
                                                <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                                                <h6 class="card-subtitle">TABEL DATA KTL 2</h6>
                                                <div class="table-responsive">

                                                    <table class="table table-bordered dataTable">
                                                        <thead>
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
                                                            <?php foreach ($ktl2 as $det) {
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
                                                                                <?php } else { ?>
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
                                    <!--GEDUNG5-->
                                    <?php if ($pro5 == 1) { ?>
                                            <?php if ($pro5 == 1 or ($pro5 == 1 and $pro6 == 1)) { ?>
                                                    <div class="tab-pane active" id="gedung5" role="tabpanel" aria-labelledby="gedung5-tab">
                                                <?php } else { ?>
                                                        <div class="tab-pane fade" id="gedung5" role="tabpanel" aria-labelledby="gedung5-tab">
                                                    <?php } ?>
                                                    <div>
                                                        <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                                                        <h6 class="card-subtitle">TABEL DATA TRANSPORTASI</h6>
                                                        <div class="table-responsive">

                                                            <table class="table table-bordered dataTable">
                                                                <thead>
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
                                                                    <?php foreach ($trans as $det) {
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
                                                                                        <?php } else { ?>
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

                                            <!--GEDUNG6-->
                                            <?php if ($pro6 == 1) { ?>
                                                    <?php if ($pro6 == 1 and $pro == 1) { ?>
                                                            <div class="tab-pane active" id="gedung6" role="tabpanel" aria-labelledby="gedung6-tab">
                                                        <?php } else { ?>
                                                                <div class="tab-pane fade" id="gedung6" role="tabpanel" aria-labelledby="gedung6-tab">
                                                            <?php } ?>
                                                            <div>
                                                                <h4 class="card-title">DASHBOARD OPERASIONAL PROYEK</h4>
                                                                <h6 class="card-subtitle">TABEL DATA TRANSPORTASI 2</h6>
                                                                <div class="table-responsive">

                                                                    <table class="table table-bordered dataTable">
                                                                        <thead>
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
                                                                            <?php foreach ($trans2 as $det) {
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
                                                                                                <?php } else { ?>
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
                                                    <!--GEDUNG7-->
                                                    <?php if ($pro7 == 1) { ?>
                                                            <?php if ($pro7 == 1 and $pro == 1) { ?>
                                                                    <div class="tab-pane active" id="gedung7" role="tabpanel" aria-labelledby="gedung7-tab">
                                                                <?php } else { ?>
                                                                        <div class="tab-pane fade" id="gedung7" role="tabpanel" aria-labelledby="gedung7-tab">
                                                                    <?php } ?>
                                                                    <?php
                                                                    if (level_user('marketing', 'index', $kategoriQNS, 'read') > 0) {
                                                                        ?>
                                                                            <div class="d-flex flex-row pull-right">
                                                                                <a class="btn btn-success" href="<?= base_url() ?>proyek/edit_1/<?= $id_pkp2 ?>" style="font-size: 12px;color:white">DATA MARKETING</a>
                                                                            </div>
                                                                    <?php } ?>
                                                                    <span class=" card-subtitle" style="margin-bottom: 5px">DATA PROYEK</span>
                                                                    <div>
                                                                        <div class="table-responsive">

                                                                            <table class="table table-bordered dataTable">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th style="text-align:center;vertical-align:middle" rowspan="2">INS</th>
                                                                                        <th style="text-align:center;vertical-align:middle" rowspan="2">PKP</th>
                                                                                        <th style="text-align:center;vertical-align:middle;" rowspan="2">PROYEK</th>
                                                                                        <th style="text-align:center;vertical-align:middle;" rowspan="2">Nama Sesuai Kontrak</th>
                                                                                        <th style="text-align:center;vertical-align:middle;" colspan="2">Kontrak Induk</th>
                                                                                        <th style="text-align:center;vertical-align:middle;" colspan="2">Jaminan Pelaksanaan</th>
                                                                                        <th style="text-align:center;vertical-align:middle;" colspan="2">File BAST</th>
                                                                                        <th style="font-size:12px;text-align:center;vertical-align:middle;" rowspan="2">FILE SRT REFERENSI</th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th style="text-align:center;">Start</th>
                                                                                        <th style="text-align:center;">Finish</th>
                                                                                        <th style="text-align:center;">Nilai</th>
                                                                                        <th style="text-align:center;">Tanggal</th>
                                                                                        <th style="text-align:center;">I</th>
                                                                                        <th style="text-align:center;">II</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <?php foreach ($marketing as $det) {
                                                                                        ?>
                                                                                            <tr>
                                                                                                <td style="text-align:center;width: 5%;vertical-align: middle;">
                                                                                                    <a style="font-size: 12px;"><?= $det->nomor ?></a>
                                                                                                </td>
                                                                                                <td style="text-align:center;width: 5%;vertical-align: middle;">
                                                                                                    <a style="font-size: 12px;"><?= $det->no_pkp ?></a>
                                                                                                </td>
                                                                                                <td style="width: 15%;vertical-align: middle;">
                                                                                                    <a style="font-size: 12px;"><?= $det->alias ?></a>
                                                                                                </td>
                                                                                                <td style="width: 20%;vertical-align: middle;">
                                                                                                    <a style="font-size: 10px;"><?= $det->proyek ?></a>
                                                                                                </td>
                                                                                                <?php if ($det->tgl_mulai > '2010-01-01') { ?>
                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"><?= (date('d/m/y', strtotime($det->tgl_mulai))); ?></td>
                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"><?= (date('d/m/y', strtotime($det->tgl_selesai))); ?></td>
                                                                                                <?php } else { ?>
                                                                                                        <td></td>
                                                                                                        <td></td>
                                                                                                <?php } ?>
                                                                                                <td style="width: 10%;vertical-align: middle;text-align:right;font-size: 12px;">
                                                                                                    <?= number_format($det->nilai_jaminan, 2, ",", ".") ?>
                                                                                                </td>
                                                                                                <?php if ($det->tgl_jaminan > 0) { ?>
                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"><?= (date('d/m/y', strtotime($det->tgl_jaminan))); ?></td>
                                                                                                <?php } else { ?>
                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"></td>
                                                                                                <?php } ?>
                                                                                                <td style="text-align:center;vertical-align: middle;">
                                                                                                    <a style="font-size: 10px;"><?= $det->bast_1 ?></a>
                                                                                                </td>
                                                                                                <td style="text-align:center;vertical-align: middle;">
                                                                                                    <a style="font-size: 10px;"><?= $det->bast_2 ?></a>
                                                                                                </td>
                                                                                                <td style="text-align:center;vertical-align: middle;">
                                                                                                    <a style="font-size: 10px;"><?= $det->referensi ?></a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            $id_pkp = $det->id_pkp;
                                                                                            $QNS0 = $this->db->query("SELECT * FROM addendum where id_pkp='$id_pkp' ");
                                                                                            if ($QNS0->num_rows() > 0) {
                                                                                                foreach ($QNS0->result() as $row) {
                                                                                                    ?>
                                                                                                            <tr style="background-color:beige ;">
                                                                                                                <td colspan="3"></td>

                                                                                                                <td style="vertical-align: middle;">
                                                                                                                    <a style="font-size: 10px;"><?= $row->keterangan ?></a>
                                                                                                                </td>
                                                                                                                <?php if ($row->tgl_mulai > 0) { ?>
                                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"><?= (date('d/m/y', strtotime($row->tgl_mulai))); ?></td>
                                                                                                                <?php } else { ?>
                                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"></td>
                                                                                                                <?php } ?>
                                                                                                                <?php if ($row->tgl_selesai > 0) { ?>
                                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"><?= (date('d/m/y', strtotime($row->tgl_selesai))); ?></td>
                                                                                                                <?php } else { ?>
                                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"></td>
                                                                                                                <?php } ?>
                                                                                                                <td style="width: 10%;vertical-align: middle;text-align:right;font-size: 12px;">
                                                                                                                    <?= number_format($row->nilai_jaminan, 2, ",", ".") ?>
                                                                                                                </td>
                                                                                                                <?php if ($row->tgl_jaminan > 0) { ?>
                                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"><?= (date('d/m/y', strtotime($row->tgl_jaminan))); ?></td>
                                                                                                                <?php } else { ?>
                                                                                                                        <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;"></td>
                                                                                                                <?php } ?>
                                                                                                                <td style="text-align:center;vertical-align: middle;">
                                                                                                                    <a style="font-size: 10px;"><?= $row->bast_1 ?></a>
                                                                                                                </td>
                                                                                                                <td style="text-align:center;vertical-align: middle;">
                                                                                                                    <a style="font-size: 10px;"><?= $row->bast_2 ?></a>
                                                                                                                </td>
                                                                                                                <td style="text-align:center;vertical-align: middle;">
                                                                                                                    <a style="font-size: 10px;"><?= $row->referensi ?></a>
                                                                                                                </td>
                                                                                                            </tr>
                                                                                                    <?php } ?>
                                                                                            <?php } ?>
                                                                                    <?php } ?>

                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                            <?php } ?>
                                                            </div>

                                                            </section>

                                                            <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $('ul li a').click(function() {
                                                                        $('li a').removeClass("active");
                                                                        $(this).addClass("active");
                                                                    });
                                                                });
                                                            </script>
                                                            </body>

                                                            </html>