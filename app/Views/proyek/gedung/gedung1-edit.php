<?= $this->extend('layout/page_layout') ?>

<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true" style="color:black"><strong>PROGRESS</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_2/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info2" aria-selected="true" style="color:black"><strong>PERMASALAHAN </strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_6/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info6" aria-selected="true" style="color:black"><strong>MONITORING KARYAWAN</strong></a>
        </li>
         <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_3/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info3" aria-selected="true" style="color:black"><strong>DATA UMUM & FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_4/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info4" aria-selected="true" style="color:black"><strong>DATA TEKNIS</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_5/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING DCR</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/s-curve/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info5" aria-selected="true" style="color:black"><strong>S-CURVE</strong></a>
        </li>
    </ul>
    <?php
    if ($nomorQN != '412') {
        ?>
        <!--PROGRESS-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="info1" role="tabpanel" aria-labelledby="info1-tab">
                <div>
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <h6 class="text-muted m-b-0">Diperbaharui:
                            <?php if ($proyek->getRow()->tgl_ubah_progress > 0): ?>
                                <b><?= (date('d-M-Y', strtotime(esc($proyek->getRow()->tgl_ubah_progress)))) ?></b>
                            <?php endif; ?>
                        </h6>
                        <br>

                        <form action="" method="GET" class="ml-auto">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="00">Tahun</option>
                                        <?php foreach ($option_tahun as $data): ?>
                                            <option value="<?php echo $data->tahun; ?>">20<?php echo $data->tahun; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="bulan" id="bulan" class="form-control">
                                        <option value="00">Bulan</option>
                                        <!-- Opsi Bulan akan diisi setelah pengguna memilih Tahun -->
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-lg btn-success" style="font-size:12px;"
                                        type="submit">Filter</button>
                                </div>
                            </div>
                        </form>

                        <div id="userbox" class="userbox">
                            <?php if ($proyek->getRow()->validasi_kapro > 0 && level_user('proyek', 'data', $kategoriQNS, 'add') > 0): ?>
                                <a class="btn btn-success" data-toggle="modal" data-target="#tambahData3"
                                    style="font-size: 12px;color:white"> UPD. PROGRESS</a>
                            <?php endif; ?>
                            <?php if (level_user('kadiv', 'index', $kategoriQNS, 'read') > 0): ?>
                                <a class="btn btn-success" data-toggle="modal" data-target="#tambahData4"
                                    style="font-size: 12px;color:white"> CLOSE PKP</a>
                            <?php endif; ?>
                            <?php if ($proyek->getRow()->validasi_kapro < 1 && level_user('kapro', 'index', $kategoriQNS, 'read') > 0): ?>
                                <a class="btn btn-success" data-toggle="modal" data-target="#tambahData5"
                                    style="font-size: 12px;color:white"> VALIDASI</a>
                            <?php endif; ?>
                            <a class="btn btn-info dropdown-toggle" data-toggle="dropdown"
                                style="font-size: 12px;color:black">EXPORT</a>
                            <div class="dropdown-menu">
                                <ul class="list-unstyled">
                                    <li class="divider"></li>
                                    <li>
                                        <a class="btn btn-info"
                                            href="<?= base_url() ?>proyek/xls1/<?= $proyek->getRow()->id_pkp ?>"
                                            style="font-size: 12px;color:black"> XLS</a>
                                    </li>
                                    <li>
                                        <a class="btn btn-info"
                                            href="<?= base_url() ?>proyek/pdf1/<?= $proyek->getRow()->id_pkp ?>"
                                            style="font-size: 12px;color:black" target="_blank"> PDF</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <?php
                $bulan22 = '';
                foreach ($paket as $det2) {
                    $bulan22 = $det2->bulan;
                    $tahun22 = '20' . $det2->tahun;
                } ?>
                <span class=" card-subtitle" style="margin-bottom: 5px">DATA PROGRESS PER PAKET</span>
                <br>
                <?php if ($bulan22 != '') { ?>
                    <b><span style="font-size: 13px;">Periode: <?= ' ' . $bulan22 . '-' . $tahun22 ?> </span></b>
                <?php } ?>
                <a href="<?= base_url() ?>proyek/s-curve/<?= $proyek->getRow()->id_pkp ?>" class="btn btn-warning font-lg float-right mb-2" target="_blank">Lihat S-Curve</a>
                <div class="table-scrollable" style="height: 490px;width:100%">
                    <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped"
                        style="min-width: 1200px;width:120%">
                        <thead style="background-color:#1b3a59;color:white;">
                            <tr>
                                <th style="vertical-align: middle;text-align:center;width:3%;" rowspan="2">NO</th>
                                <th style="vertical-align: middle;text-align:center;width:30%;" rowspan="2">Nama Paket
                                </th>
                                <th style="vertical-align: middle;text-align:center;width:5%;" rowspan="2">Bobot</th>
                                <th style="text-align:center;vertical-align:middle;" colspan="3">s/d Bulan Lalu</th>
                                <th style="text-align:center;vertical-align:middle;" colspan="3">Bulan Ini</th>

                                <th style="text-align:center;vertical-align:middle;" colspan="3">s/d Bulan Ini</th>
                                <th style="vertical-align: middle;text-align:center;width:5%;" rowspan="2">Sisa Progress
                                </th>
                                <th style="text-align:center;vertical-align: middle;" colspan="2">Kontrak Induk</th>
                                <th style="vertical-align: middle;text-align:center;width:5%;" rowspan="2">Keterangan
                                </th>
                                <th style="text-align:center" colspan="2">Addendum</th>
                                <th style="vertical-align: middle;text-align:center;width:5%;" rowspan="2">Sisa Waktu
                                    (Hr)</th>
                                <th style="vertical-align: middle;text-align:center;width:5%;" rowspan="2">Target Per
                                    Bulan</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;width:5.5%;">Plan</th>
                                <th style="text-align: center;width:5.5%;">Act</th>
                                <th style="text-align: center;width:5.5%;">Dev</th>
                                <th style="text-align: center;width:5.5%;">Plan</th>
                                <th style="text-align: center;width:5.5%;">Act</th>
                                <th style="text-align: center;width:5.5%;">Dev</th>
                                <th style="text-align: center;width:5.5%;">Plan</th>
                                <th style="text-align: center;width:5.5%;">Act</th>
                                <th style="text-align: center;width:5.5%;">Dev</th>
                                <th style="text-align: center;width:7%;">Start</th>
                                <th style="text-align: center;width:7%;">Finish</th>
                                <th style="text-align: center;width:7%;">Start</th>
                                <th style="text-align: center;width:7%;">Finish</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no1 = 1; ?>
                            <?php foreach ($paket as $det) { ?>
                                <tr>
                                    <th style="text-align:center;width:3%;"><?= $no1; ?></th>
                                    <th style="color: dimgrey;width:30%;word-wrap:break-word;font-size:13px">
                                        <?= $det->paket; ?><br><b
                                            style="font-weight: 600;font-size:12px;"><?= $det->kode_pt; ?></b>
                                    </th>
                                    <td style="text-align: right;width:5%;">
                                        <?= number_format($det->bobot_pg, 2, ",", "."); ?>
                                    </td>
                                    <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;width:5.5%;">
                                        <?= number_format($det->rensd_mgll, 2, ",", "."); ?>
                                    </td>
                                    <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;width:5.5%;">
                                        <?= number_format($det->rilsd_mgll, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det->devsd_mgll < 0) { ?>
                                        <td
                                            style="text-align: right;color:crimson;background-color:#A9A9A9;border-color:#A9A9A9;width:5.5%;">
                                            <b><?= number_format($det->devsd_mgll, 2, ",", "."); ?></b>
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;width:5.5%;">
                                            <?= number_format($det->devsd_mgll, 2, ",", "."); ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: right;width:5.5%;">
                                        <?= number_format($det->ren_mgini, 2, ",", "."); ?>
                                    </td>
                                    <td style="text-align: right;width:5.5%;">
                                        <?= number_format($det->ril_mgini, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det->dev_mgini < 0) { ?>
                                        <td style="text-align: right;color:crimson;width:5.5%;">
                                            <b><?= number_format($det->dev_mgini, 2, ",", "."); ?></b>
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td style="text-align: right;width:5.5%;">
                                            <?= number_format($det->dev_mgini, 2, ",", "."); ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0;width:5.5%;">
                                        <?= number_format($det->rensd_mgini, 2, ",", "."); ?>
                                    </td>
                                    <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0;width:5.5%;">
                                        <?= number_format($det->rilsd_mgini, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det->devsd_mgini < 0) { ?>
                                        <td
                                            style="text-align: right;color:crimson;background-color:#C0C0C0;border-color:#C0C0C0;width:5.5%;">
                                            <b><?= number_format($det->devsd_mgini, 2, ",", "."); ?></b>
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0;width:5.5%;">
                                            <?= number_format($det->devsd_mgini, 2, ",", "."); ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: right;width:5%;">
                                        <?= number_format($det->sisa_bobotpg, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det->tgl_mulai > 0) { ?>
                                        <td style="text-align: center;width:8%;">
                                            <?php
                                            $tgl_mulai = strtotime($det->tgl_mulai);
                                            echo $tgl_mulai > 0 ? date('d/m/y', $tgl_mulai) : '';
                                            ?>
                                        </td>
                                        <td style="text-align: center;width:8%;">
                                            <?php
                                            $tgl_selesai = strtotime($det->tgl_selesai);
                                            echo $tgl_selesai > 0 ? date('d/m/y', $tgl_selesai) : '';
                                            ?>
                                        </td>

                                    <?php } else { ?>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <?php if ($det->tgl_sadd > 0) { ?>
                                        <td style="color: red;text-align:center;">Terlambat</td>
                                        <td style="text-align: center;width:8%;">
                                            <?php
                                            $tgl_sadd = strtotime($det->tgl_sadd);
                                            echo $tgl_sadd > 0 ? date('d/m/y', $tgl_sadd) : '';
                                            ?>
                                        </td>
                                        <td style="text-align: center;width:8%;">
                                            <?php
                                            $tgl_fadd = strtotime($det->tgl_fadd);
                                            echo $tgl_fadd > 0 ? date('d/m/y', $tgl_fadd) : '';
                                            ?>
                                        </td>

                                    <?php } else { ?>
                                        <td><?= $det->keterangan; ?></td>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <?php if ($det->tgl_mulai > 0) { ?>
                                        <td style="text-align: right;"><?= $det->sisa_waktu; ?></td>
                                    <?php } else { ?>
                                        <td></td>
                                    <?php } ?>
                                    <td style="text-align: right;width:5%;">
                                        <?= number_format($det->target_minggu, 2, ",", "."); ?>
                                    </td>


                                </tr>
                                <?php
                                $no1++;
                            } ?>
                        </tbody>
                        <footer>
                            <?php foreach ($proyek2 as $det2) { ?>
                                <tr>
                                    <td style="text-align:center" colspan="2">TOTAL</td>
                                    <td style="text-align: right"><?= number_format($det2->bobot_pg, 2, ",", "."); ?></td>
                                    <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                        <?= number_format($det2->rensd_mgll, 2, ",", "."); ?>
                                    </td>
                                    <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                        <?= number_format($det2->rilsd_mgll, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det2->devsd_mgll < 0) { ?>
                                        <td style="text-align: right;color:crimson;background-color:#A9A9A9;border-color:#A9A9A9;">
                                            <b><?= number_format($det2->devsd_mgll, 2, ",", "."); ?></b>
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                            <?= number_format($det2->devsd_mgll, 2, ",", "."); ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: right;"><?= number_format($det2->ren_mgini, 2, ",", "."); ?></td>
                                    <td style="text-align: right;"><?= number_format($det2->ril_mgini, 2, ",", "."); ?></td>
                                    <?php if ($det2->dev_mgini < 0) { ?>
                                        <td style="text-align: right;color:crimson;">
                                            <b><?= number_format($det2->dev_mgini, 2, ",", "."); ?></b>
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td style="text-align: right;"><?= number_format($det2->dev_mgini, 2, ",", "."); ?></td>
                                    <?php } ?>
                                    <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                        <?= number_format($det2->rensd_mgini, 2, ",", "."); ?>
                                    </td>
                                    <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                        <?= number_format($det2->rilsd_mgini, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det2->devsd_mgini < 0) { ?>
                                        <td style="text-align: right;color:crimson;background-color:#C0C0C0;border-color:#C0C0C0;">
                                            <b><?= number_format($det2->devsd_mgini, 2, ",", "."); ?></b>
                                        </td>
                                        <?php
                                    } else { ?>
                                        <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0;">
                                            <?= number_format($det2->devsd_mgini, 2, ",", "."); ?>
                                        </td>
                                    <?php } ?>
                                    <td style="text-align: right;"><?= number_format($det2->sisa_bobotpg, 2, ",", "."); ?>
                                    </td>
                                    <?php if ($det2->tgl_mulai > 0) { ?>
                                        <td style="text-align: center;">
                                            <?php
                                            $tgl_mulai = strtotime($det2->tgl_mulai);
                                            echo $tgl_mulai > 0 ? date('d/m/y', $tgl_mulai) : '';
                                            ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            $tgl_selesai = strtotime($det2->tgl_selesai);
                                            echo $tgl_selesai > 0 ? date('d/m/y', $tgl_selesai) : '';
                                            ?>
                                        </td>

                                        </td>
                                    <?php } else { ?>
                                        <td></td>
                                        <td></td>
                                    <?php } ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: right;"></td>
                                    <td style="text-align: right;"></td>
                                </tr>
                            <?php } ?>
                        </footer>
                    </table>
                </div>
            </div>
        </div>
        </div>
    <?php } else { ?>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="info1" role="tabpanel" aria-labelledby="info1-tab">
                <div>
                    <div class="d-flex flex-row pull-right">
                        <!--<div class="round align-self-center round-danger"><i class="fa fa-calendar" style="font-size: 23px;vertical-align: middle"></i></div> -->
                        <div class="m-l-10 align-self-center">
                            <h6 class="text-muted m-b-0">Diperbaharui :
                                <?php if ($proyek->getRow()->tgl_ubah_progress > 0) { ?>
                                    <b><?= (date('d-M-Y', strtotime(esc($proyek->getRow()->tgl_ubah_progress)))) ?>
                                    <?php } ?> </b>
                            </h6>


                            <div id="userbox" class="userbox">

                                <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">EXPORT

                                </a>
                                <div class="dropdown-menu">
                                    <ul class="list-unstyled">
                                        <li class="divider"></li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/xls1/<?= $proyek->getRow()->id_pkp ?>"
                                                style="font-size: 12px;color:black"> XLS</a>
                                        </li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/pdf1/<?= $proyek->getRow()->id_pkp ?>"
                                                style="font-size: 12px;color:black" target="_blank"> PDF</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <span class=" card-subtitle" style="margin-bottom: 5px">DATA PROYEK</span>
                    <div>
                        <div class="table-responsive">

                            <table class="table table-bordered dataTable">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;vertical-align:middle" rowspan="2">INS</th>
                                        <th style="text-align:center;vertical-align:middle" rowspan="2">PKP</th>
                                        <th style="text-align:center;vertical-align:middle;" rowspan="2">PROYEK</th>
                                        <th style="text-align:center;vertical-align:middle;" rowspan="2">Nama Sesuai Kontrak
                                        </th>
                                        <th style="text-align:center;vertical-align:middle;" colspan="2">Kontrak Induk</th>
                                        <th style="text-align:center;vertical-align:middle;" colspan="2">Jaminan Pelaksanaan
                                        </th>
                                        <th style="text-align:center;vertical-align:middle;" colspan="2">File BAST</th>
                                        <th style="font-size:12px;text-align:center;vertical-align:middle;" rowspan="2">FILE
                                            SRT REFERENSI</th>
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
                                                <a style="font-size: 12px;"
                                                    href="<?= base_url() ?>proyek/marketing/<?= $det->id_pkp ?>"><?= $det->alias ?></a>
                                            </td>
                                            <td style="width: 20%;vertical-align: middle;">
                                                <a style="font-size: 10px;"><?= $det->proyek ?></a>
                                            </td>
                                            <?php if ($det->tgl_mulai > '2010-01-01') { ?>
                                                <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;">
                                                    <?= (date('d/m/y', strtotime($det->tgl_mulai))); ?>
                                                </td>
                                                <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;">
                                                    <?= (date('d/m/y', strtotime($det->tgl_selesai))); ?>
                                                </td>
                                            <?php } else { ?>
                                                <td></td>
                                                <td></td>
                                            <?php } ?>
                                            <td style="width: 10%;vertical-align: middle;text-align:right;font-size: 12px;">
                                                <?= number_format($det->nilai_jaminan, 2, ",", ".") ?>
                                            </td>
                                            <?php if ($det->tgl_jaminan > 0) { ?>
                                                <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;">
                                                    <?= (date('d/m/y', strtotime($det->tgl_jaminan))); ?>
                                                </td>
                                            <?php } else { ?>
                                                <td style="text-align: center;width:5%;font-size: 12px;vertical-align: middle;">
                                                </td>
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

                                        // Loop melalui hasil kueri
                                        foreach ($QNS0 as $row) {
                                            ?>
                                            <tr style="background-color: beige;">
                                                <td colspan="3"></td>
                                                <td style="vertical-align: middle;">
                                                    <a style="font-size: 10px;"><?= $row->keterangan ?></a>
                                                </td>
                                                <td style="text-align: center; width: 5%; font-size: 12px; vertical-align: middle;">
                                                    <?= $row->tgl_mulai > 0 ? date('d/m/y', strtotime($row->tgl_mulai)) : '' ?>
                                                </td>
                                                <td style="text-align: center; width: 5%; font-size: 12px; vertical-align: middle;">
                                                    <?= $row->tgl_selesai > 0 ? date('d/m/y', strtotime($row->tgl_selesai)) : '' ?>
                                                </td>
                                                <td style="width: 10%; vertical-align: middle; text-align: right; font-size: 12px;">
                                                    <?= number_format($row->nilai_jaminan, 2, ",", ".") ?>
                                                </td>
                                                <td style="text-align: center; width: 5%; font-size: 12px; vertical-align: middle;">
                                                    <?= $row->tgl_jaminan > 0 ? date('d/m/y', strtotime($row->tgl_jaminan)) : '' ?>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <a style="font-size: 10px;"><?= $row->bast_1 ?></a>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <a style="font-size: 10px;"><?= $row->bast_2 ?></a>
                                                </td>
                                                <td style="text-align: center; vertical-align: middle;">
                                                    <a style="font-size: 10px;"><?= $row->referensi ?></a>
                                                </td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                        <?php
                                    }

                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
</section>
<!-- end: page -->

<!--IMPORT PROGRESS-->
<div class="modal fade" id="tambahData3" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/upl_progress'), ' id="FormulirTambah3"'); ?>
                <header class="panel-heading bg-primary">
                    <h2 class="panel-title">Migrasi PROGRESS</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Format EXCEL ---></label>
                                <a style="font-size:12px;" class="btn btn-warning"
                                    href="<?= base_url() ?>proyek/xls1/<?= $proyek->getRow()->id_pkp ?>"><i
                                        class="fa fa-download"></i> Download Format</a>
                                <!-- href="<?= base_url() ?>excel/formatuploadPROGRESS.xlsx" target="_blank" -->
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform3">Submit</button>
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
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/upd_close_pkp'), ' id="FormulirTambah4"'); ?>
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title">Close PKP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group excelfile">
                                    <label class="col-sm-3 control-label">Tanggal Close</label>
                                    <div class="col-sm-9">
                                        <?php
                                        $tgl_close = esc($proyek->getRow()->tgl_close);
                                        if ($tgl_close > 0) {
                                            $tanggal_close = date('d-m-Y', strtotime(esc($proyek->getRow()->tgl_close)));
                                        } else {
                                            $tanggal_close = '';
                                        }
                                        ?>
                                        <input type="hidden" name="id_pkp" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                            class="form-control" placeholder="Masukkan Nomor Dokumen" required />
                                        <input type="text" name="tgl_close" value="<?= $tanggal_close ?>"
                                            class="form-control tanggal" data-plugin-datepicker
                                            data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                            data-mask />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary modal-confirm"
                                    style="font-size: 12px;vertical-align: middle" type="submit"
                                    id="submitform4">Submit</button>
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
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/validasi_kapro1'), ' id="FormulirTambah5"'); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Proyek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Validasi</label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="validasi"
                                        placeholder="Silahkan pilih Kategori Dokumen" required>
                                        <option value="">Silahkan Pilih</option>
                                        <option value="OK">OK</option>
                                        <option value="NOT">NOT_OK</option>
                                    </select>
                                    <input type="hidden" name="id_pkp" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                        class="form-control" placeholder="Masukkan Nomor Dokumen" required />

                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform5">Submit</button>
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
<script>
    // Tambahkan event listener untuk perubahan tahun
    document.getElementById('tahun').addEventListener('change', function () {
        const tahun = this.value;
        const bulanSelect = document.getElementById('bulan');
        bulanSelect.innerHTML = ''; // Mengosongkan opsi bulan

        // Kirim permintaan AJAX untuk mengambil data bulan berdasarkan tahun yang dipilih
        fetch(`<?= base_url('proyek/get_bulan'); ?>?id_pkp=<?= $id_pkp; ?>&tahun=${tahun}`)
            .then(response => response.json())
            .then(data => {
                // Tambahkan opsi bulan ke dalam elemen select
                data.forEach(bulan => {
                    const option = document.createElement('option');
                    option.value = bulan.bulan;
                    option.textContent = bulan.nama_bulan;
                    bulanSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
<script type="text/javascript">
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 2,
    });

    $(document).ready(function () {
        $('ul li a').click(function () {
            //$('li a').removeClass("active");
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
    /* TAMBAH Progress */

    document.getElementById("FormulirTambah3").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform3").setAttribute('disabled', 'disabled');
        $('#submitform3').html('Loading ...');
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                document.getElementById("submitform3").removeAttribute('disabled');
                $('#submitform3').html('Submit');
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
                document.getElementById("submitform3").removeAttribute('disabled');
                $('#tambahData3').modal('hide');
                document.getElementById("FormulirTambah3").reset();
                $('#submitform3').html('Submit');
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

        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah4").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform4").setAttribute('disabled', 'disabled');
        $('#submitform4').html('Loading ...');
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                document.getElementById("submitform4").removeAttribute('disabled');
                $('#submitform3').html('Submit');
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
                document.getElementById("submitform4").removeAttribute('disabled');
                $('#tambahData4').modal('hide');
                document.getElementById("FormulirTambah4").reset();
                $('#submitform4').html('Submit');
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

        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah5").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitform5").setAttribute('disabled', 'disabled');
        $('#submitform5').html('Loading ...');
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                document.getElementById("submitform5").removeAttribute('disabled');
                $('#submitform3').html('Submit');
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
                document.getElementById("submitform5").removeAttribute('disabled');
                $('#tambahData5').modal('hide');
                document.getElementById("FormulirTambah5").reset();
                $('#submitform4').html('Submit');
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
        });
        e.preventDefault();
    });
</script>

</body>

</html>
<?= $this->endSection() ?>