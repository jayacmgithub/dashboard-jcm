<?php $this->load->view("komponen/atas.php") ?>

<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">

<?php
$idQNS = $this->session->userdata('idadmin');
$isi = $this->db->from("master_admin")->where('id', $idQNS, 1)->get()->row();
$kategoriQNS = $isi->kategori_user;
?>

<header class="page-header">
    <h2><a href="<?php echo base_url() ?>proyek" style="color:white">PROJECT</a> | <small><a
                href="<?php echo base_url() . $this->security->xss_clean($instansi3->row()->ling) ?>"
                style="color:white">
                <?php echo $this->security->xss_clean($instansi3->row()->alias) ?> |
            </a></small><small style="color:cyan">
            <?php echo $this->security->xss_clean($proyek->row()->alias) ?>
        </small></h2>
</header>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">PROGRESS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="info2-tab" data-toggle="tab" href="#info2" role="tab" aria-controls="info2"
                aria-selected="false">PERMASALAHAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="info3-tab" data-toggle="tab" href="#info3" role="tab" aria-controls="info3"
                aria-selected="false">DATA UMUM & FOTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="info4-tab" data-toggle="tab" href="#info4" role="tab" aria-controls="info4"
                aria-selected="false">DATA TEKNIS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="info5-tab" data-toggle="tab" href="#info5" role="tab" aria-controls="info5"
                aria-selected="false">MONITORING DCR</a>
        </li>
    </ul>

    <!--PROGRESS-->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info1" role="tabpanel" aria-labelledby="info1-tab">
            <div class="card-body">
                <div class="d-flex flex-row pull-right">
                    <div class="round align-self-center round-danger"><i class="fa fa-calendar"
                            style="font-size: 23px;vertical-align: middle"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Data Diperbaharui</h6>
                        <?php foreach ($proyek2 as $det2) { ?>
                            <h4 class="m-b-0">
                                <?php echo (date('d-M-Y', strtotime($this->security->xss_clean($det2->tgl_ubah_progress)))) ?>
                            </h4>
                        <?php } ?>
                        <h6 class="btn btn-success" style="font-size: 12px;">
                            <?php
                            echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<a style="color:white" href="' . base_url() . 'proyek/edit_progress/' . $this->security->xss_clean($proyek->row()->id_pkp) . '"> ' . 'UPDATE PROGRESS</a>' : '';
                            ?>
                        </h6>
                    </div>
                </div>
                <h4 class="card-title">
                    <?php echo $this->security->xss_clean($proyek->row()->alias) ?>
                </h4>
                <h6 class="card-subtitle" style="margin-bottom: 25px">TABEL DATA PROGRESS PER PAKET</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped dataTable no-footer">
                        <thead>
                            <tr>
                                <td style="vertical-align: middle;text-align:center" rowspan="2">No.</td>
                                <td style="vertical-align: middle;text-align:center" rowspan="2">Nama Paket</td>
                                <td style="vertical-align: middle;text-align:center" rowspan="2">Bobot</td>
                                <td style="text-align:center" colspan="3">s/d Bulan Lalu</td>
                                <td style="text-align:center" colspan="3">Bulan Ini</td>
                                <td style="text-align:center" colspan="3">s/d Bulan Ini</td>
                                <td style="vertical-align: middle;text-align:center" rowspan="2">Sisa Progress</td>
                                <td style="text-align:center" colspan="2">Waktu Pelaksanaan</td>
                                <td style="vertical-align: middle;text-align:center" rowspan="2">Sisa Waktu</td>
                                <td style="vertical-align: middle;text-align:center" rowspan="2">Target Per Bulan</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">Plan</td>
                                <td style="text-align: center;">Actual</td>
                                <td style="text-align: center;">Dev</td>
                                <td style="text-align: center;">Plan</td>
                                <td style="text-align: center;">Actual</td>
                                <td style="text-align: center;">Dev</td>
                                <td style="text-align: center;">Plan</td>
                                <td style="text-align: center;">Actual</td>
                                <td style="text-align: center;">Dev</td>
                                <td style="text-align: center;">Start</td>
                                <td style="text-align: center;">Finish</td>
                            </tr>
                        </thead>
                        <?php
                        $no1 = 1;
                        foreach ($paket as $det) { ?>
                            <tbody>
                                <td>
                                    <?php echo $no1; ?>
                                </td>
                                <td>
                                    <?php echo $det->paket; ?><br><b>
                                        <?php echo $det->alias; ?>
                                    </b>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det->bobot_pg, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                    <?php echo number_format($det->rensd_mgll, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9">
                                    <?php echo number_format($det->rilsd_mgll, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9">
                                    <?php echo number_format($det->devsd_mgll, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det->ren_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det->ril_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det->dev_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                    <?php echo number_format($det->rensd_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                    <?php echo number_format($det->rilsd_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                    <?php echo number_format($det->devsd_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det->sisa_bobotpg, 2) . '%'; ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo (date('d/m/y', strtotime($det->tgl_mulai))); ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php echo (date('d/m/y', strtotime($det->tgl_selesai))); ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo $det->sisa_waktu; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det->target_minggu, 2) . '%'; ?>
                                </td>
                            </tbody>

                            <?php
                            $no1++;
                        } ?>
                        <?php foreach ($proyek2 as $det2) { ?>
                            <tbody>
                                <td style="text-align:center" colspan="2">Total</td>
                                <td style="text-align: right">
                                    <?php echo number_format($det2->bobot_pg, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                    <?php echo number_format($det2->rensd_mgll, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                    <?php echo number_format($det2->rilsd_mgll, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#A9A9A9;border-color:#A9A9A9;">
                                    <?php echo number_format($det2->devsd_mgll, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det2->ren_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det2->ril_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det2->dev_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                    <?php echo number_format($det2->rensd_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                    <?php echo number_format($det2->rilsd_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;background-color:#C0C0C0;border-color:#C0C0C0">
                                    <?php echo number_format($det2->devsd_mgini, 2) . '%'; ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo number_format($det2->sisa_bobotpg, 2) . '%'; ?>
                                </td>
                                <td>
                                    <?php echo (date('d/m/y', strtotime($det2->tgl_mulai))); ?>
                                </td>
                                <td>
                                    <?php echo (date('d/m/y', strtotime($det2->tgl_selesai))); ?>
                                </td>
                                <td style="text-align: right;">
                                    <?php echo $det2->sisa_waktu; ?>
                                </td>
                                <td style="text-align: right;"></td>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        <!---MASALAH--->
        <div class="tab-pane fade" id="info2" role="tabpanel" aria-labelledby="info2-tab">
            <div class="card-body">
                <div class="d-flex flex-row pull-right">
                    <div class="round align-self-center round-danger"><i class="fa fa-calendar"
                            style="font-size: 23px;vertical-align: middle"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Data Diperbaharui</h6>
                        <h5 class="m-b-0">
                            <?php echo (date('d-M-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_ubah_masalah)))) ?>
                        </h5>
                        <h6 class="btn btn-success" style="font-size: 12px;">
                            <?php
                            echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<a data-toggle="modal" data-target="#tambahData"> UPDATE MASALAH</a>' : '';
                            ?>
                        </h6>
                    </div>

                </div>
                <h4 class=" card-title">
                    <?php echo $this->security->xss_clean($proyek->row()->alias) ?>
                </h4>
                <h6 class="card-subtitle" style="margin-bottom: 25px">TABEL DATA PERMASALAHAN POKOK</h6>


                <div class="table-responsive">

                    <table class="table table-bordered dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="text-align:center;width: 3%">NO.</th>
                                <th style="text-align:center;width: 20%">URAIAN</th>
                                <th style="text-align:center;width: 20%">PENYEBAB</th>
                                <th style="text-align:center;width: 20%">DAMPAK</th>
                                <th style="text-align:center;width: 20%">TINDAK LANJUT/SOLUSI</th>
                                <th style="text-align:center;width: 10%">PIC</th>
                                <th style="text-align:center;width: 7%">TARGET</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr style="background-color: #FFEFD5;">
                                <td colspan="7"><b>EKSTERNAL</b></td>
                            </tr>
                            <?php
                            foreach ($solusi as $sol) { ?>
                            <tr>
                                <td style="text-align:left;width: 5%">
                                    <?php echo $sol->nomor ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol->masalah ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol->penyebab ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol->dampak ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol->solusi ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol->pic ?>
                                </td>
                                <?php
                                $target = $sol->target;
                                if ($target > 0) {
                                    $target = date('d-m-Y', strtotime($sol->target));
                                } else {
                                    $target = ' ';
                                }
                                ?>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $target ?>
                                </td>
                            </tr>
                            <?php
                            } ?>
                            <tr style="background-color: #FFEFD5;">
                                <td colspan="7"><b>INTERNAL</b></td>
                            </tr>
                            <?php
                            foreach ($solusi2 as $sol2) { ?>
                            <tr>
                                <td></td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol2->masalah ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol2->penyebab ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol2->dampak ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol2->solusi ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo $sol2->pic ?>
                                </td>
                                <td style="text-align:left;width: 25%">
                                    <?php echo (date('d-m-Y', strtotime($sol2->target))) ?>
                                </td>
                            </tr>
                            <?php
                            } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- DATA UMUM -->
        <div class="tab-pane fade" id="info3" role="tabpanel" aria-labelledby="info3-tab">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-sm-12">
                            <div class="d-flex flex-row pull-right">
                                <h6 class="btn btn-success" style="font-size: 12px;">
                                    <?php
                                    echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<a style="color:white" href="' . base_url() . 'proyek/edit_dtu/' . $this->security->xss_clean($proyek->row()->id_pkp) . '"> ' . 'UPDATE DATA</a>' : '';
                                    ?>
                                </h6>
                            </div>
                            <tr>
                                <table class="table-responsive table-bordered dataTable">
                                    <!--<table class="table table-bordered">-->
                                    <thead>
                                        <tr>
                                            <?php
                                            if ($proyek->row()->tgl_ubah_dtu > 0) {
                                                $tgl_dtu = date('d M Y', strtotime($proyek->row()->tgl_ubah_dtu));
                                            } else {
                                                $tgl_dtu = '';
                                            }
                                            ?>
                                            <th style="text-align:center;width: 60%;font-size: 18px" colspan="4">DATA
                                                UMUM Upd:
                                                <?php echo $tgl_dtu ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="text-align:center;width: 25%" rowspan="5" colspan="2">
                                                <a target='_blank'
                                                    href="<?php echo base_url() ?>/assets/images/dtu/<?php echo $this->security->xss_clean($proyek->row()->foto) ?>"><img
                                                        src="<?php echo base_url(); ?>assets/images/dtu/<?php echo $this->security->xss_clean($proyek->row()->foto) ?>"
                                                        class="rounded img-responsive" alt="foto proyek"> </a>


                                            </td>
                                            <td style="text-align:left;width: 10%"><b>Nama Proyek</b> </span></td>
                                            <td style="text-align:left;width: 25%">
                                                <?php echo $this->security->xss_clean($proyek->row()->dtu_nama) ?>
                                            </td>
                                            <?php
                                            $jumlah2 = $cek2->num_rows() + 5;
                                            ?>

                                        </tr>
                                        <tr>
                                            <td style="text-align:left;width: 10%"><b>Pemilik</b> </span></td>
                                            <td style="text-align:left;width: 25%">
                                                <?php echo $this->security->xss_clean($proyek->row()->dtu_pemilik) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;width: 10%"><b>Jenis Proyek</b> </span></td>
                                            <td style="text-align:left;width: 25%">
                                                <?php echo $this->security->xss_clean($proyek->row()->dtu_jenis) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;width: 10%"><b>Lokasi</b> </span></td>
                                            <td style="text-align:left;width: 25%">
                                                <?php echo $this->security->xss_clean($proyek->row()->dtu_lokasi) ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:left;width: 10%"><b>Periode</b> </span></td>
                                            <td style="text-align:left;width: 25%">
                                                <?php echo $this->security->xss_clean($proyek->row()->dtu_periode) ?>
                                            </td>
                                        </tr>

                                        <?php if ($cek2->num_rows() > 0) {
                                            foreach ($dt_umum as $det2) { ?>
                                                <?php if ($det2->ket1 != ' ') { ?>
                                                    <tr>
                                                        <td></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <?php if ($det2->ket1 != ' ') { ?>
                                                        <td style="text-align:center;width: 2%">
                                                            <?php echo $det2->no_urut1 ?>
                                                        </td>
                                                    <?php } else { ?>
                                                        <td style="text-align:left;width: 2%"></td>
                                                    <?php } ?>
                                                    <td style="text-align:left;width: 10%">
                                                        <?php echo $this->security->xss_clean($det2->ket1) ?>
                                                    </td>
                                                    <td style="text-align:left;width: 10%">
                                                        <?php echo $this->security->xss_clean($det2->ket2) ?>
                                                    </td>
                                                    <td style="text-align:left;width: 10%">
                                                        <?php echo $this->security->xss_clean($det2->ket3) ?>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </tr>
                        </div>
                    </div>
                    <!--FOTO-->
                    <div class="col-md-6">
                        <div class="col-sm-12">
                            <div class="d-flex flex-row pull-right">
                                <h6 class="btn btn-success" style="font-size: 12px;">
                                    <?php
                                    echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<a data-toggle="modal" data-target="#tambahDataFoto"> UPDATE FOTO</a>' : '';
                                    ?>
                                </h6>
                            </div>
                            <tr>
                                <table class="table-responsive table-bordered dataTable">
                                    <!--<table class="table table-bordered">-->
                                    <thead>
                                        <tr>
                                            <?php
                                            if ($proyek->row()->tgl_ubah_gbr > 0) {
                                                $tgl_gbr = date('d M Y', strtotime($proyek->row()->tgl_ubah_gbr));
                                            } else {
                                                $tgl_gbr = '';
                                            }
                                            ?>
                                            <th style="text-align:center;width: 60%;font-size: 18px">FOTO Upd:
                                                <?php echo $tgl_gbr ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($gambar->num_rows() > 0) {
                                                    if ($this->security->xss_clean($gambar->row()->gambar1) != '') {
                                                        ?>
                                                        <a target='_blank'
                                                            href="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar1) ?>"><img
                                                                src="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar1) ?>"
                                                                class="rounded img-responsive" alt="foto proyek"> </a>
                                                        <h5 style="text-align: center;">Gambar 1</h5>
                                                        <?php
                                                    }
                                                    if ($this->security->xss_clean($gambar->row()->gambar2) != '') {
                                                        ?>
                                                        <a target='_blank'
                                                            href="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar2) ?>"><img
                                                                src="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar2) ?>"
                                                                class="rounded img-responsive" alt="foto proyek"> </a>
                                                        <h5 style="text-align: center;">Gambar 2</h5>
                                                        <?php
                                                    }
                                                    if ($this->security->xss_clean($gambar->row()->gambar3) != '') {
                                                        ?>
                                                        <a target='_blank'
                                                            href="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar3) ?>"><img
                                                                src="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar3) ?>"
                                                                class="rounded img-responsive" alt="foto proyek"> </a>
                                                        <h5 style="text-align: center;">Gambar 3</h5>
                                                        <?php
                                                    }
                                                    if ($this->security->xss_clean($gambar->row()->gambar4) != '') {
                                                        ?>
                                                        <a target='_blank'
                                                            href="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar4) ?>"><img
                                                                src="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar4) ?>"
                                                                class="rounded img-responsive" alt="foto proyek"> </a>

                                                        <h5 style="text-align: center;">Gambar 4</h5>
                                                        <?php
                                                    }
                                                    if ($this->security->xss_clean($gambar->row()->gambar5) != '') {
                                                        ?>
                                                        <a target='_blank'
                                                            href="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar5) ?>"><img
                                                                src="<?php echo base_url() . $this->security->xss_clean($gambar->row()->gambar5) ?>"
                                                                class="rounded img-responsive" alt="foto proyek"> </a>
                                                        <h5 style="text-align: center;">Gambar 5</h5>
                                                        <?php
                                                    }
                                                } ?>
                                            </td>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!---TEKNIS--->
        <div class="tab-pane fade" id="info4" role="tabpanel" aria-labelledby="info4-tab">
            <div class="card-body">
                <div class="d-flex flex-row pull-right">
                    <div class="round align-self-center round-danger"><i class="fa fa-calendar"
                            style="font-size: 23px;vertical-align: middle"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Data Diperbaharui</h6>
                        <h5 class="m-b-0">
                            <?php echo (date('d-M-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_ubah_dtt)))) ?>
                        </h5>
                        <h6 class="btn btn-success" style="font-size: 12px;">
                            <?php
                            echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<a data-toggle="modal" data-target="#tambahDataTeknis"> UPLOAD PDF</a>' : '';
                            ?>
                        </h6>
                    </div>

                </div>
                <h4 class=" card-title">
                    <?php echo $this->security->xss_clean($proyek->row()->alias) ?>
                </h4>
                <h6 class="card-subtitle" style="margin-bottom: 25px">DATA TEKNIS</h6>

                <div class="table-responsive">

                    <table class="table table-bordered dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="text-align:center;width: 100%" colspan="2">URAIAN</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($pdf->num_rows() > 0) {

                                if ($this->security->xss_clean($pdf->row()->pdf1) != '') {
                                    ?>
                            <tr>
                                <td style="width: 5%;">STR</td>
                                <td>

                                    <iframe
                                        src="<?php echo base_url() . $this->security->xss_clean($pdf->row()->pdf1) ?>"
                                        width="100%" height="600"></iframe>
                                </td>

                            </tr>
                            <?php
                                }
                                if ($this->security->xss_clean($pdf->row()->pdf2) != '') {
                                    ?>
                            <tr>

                                <td style="width: 5%;">ARS</td>
                                <td>
                                    <iframe
                                        src="<?php echo base_url() . $this->security->xss_clean($pdf->row()->pdf2) ?>"
                                        width="100%" height="600"></iframe>
                                </td>
                            </tr>
                            <?php
                                }
                                if ($this->security->xss_clean($pdf->row()->pdf3) != '') {
                                    ?>
                            <tr>
                                <td style="width: 5%;">MEP</td>
                                <td>
                                    <iframe
                                        src="<?php echo base_url() . $this->security->xss_clean($pdf->row()->pdf3) ?>"
                                        width="100%" height="600"></iframe>
                                </td>
                            </tr>
                            <?php
                                }
                            } ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!---DCR--->
        <div class="tab-pane fade" id="info5" role="tabpanel" aria-labelledby="info5-tab">
            <div class="card-body">
                <div class="d-flex flex-row pull-right">
                    <div class="round align-self-center round-danger"><i class="fa fa-calendar"
                            style="font-size: 23px;vertical-align: middle"></i></div>
                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Data Diperbaharui</h6>
                        <h5 class="m-b-0">
                            <?php echo (date('d-M-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_ubah_dcr)))) ?>
                        </h5>
                        <h6 class="btn btn-success" style="font-size: 12px;">
                            <?php
                            echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<a data-toggle="modal" data-target="#tambahData2"> UPDATE DCR</a>' : '';
                            ?>
                        </h6>
                    </div>

                </div>
                <h4 class=" card-title">
                    <?php echo $this->security->xss_clean($proyek->row()->alias) ?>
                </h4>
                <h6 class="card-subtitle" style="margin-bottom: 25px">TABEL DATA DCR</h6>

                <div class="table-responsive">

                    <table class="table table-bordered dataTable no-footer">
                        <thead>
                            <tr>
                                <th style="text-align:center;width: 5%">NO.</th>
                                <th style="text-align:center;width: 95%" colspan="3">URAIAN</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($dcr as $sol) { ?>
                            <tr>
                                <td style="background-color:#F0FFFF;" rowspan="5">1.</td>
                                <td style="background-color:#F0FFFF;" rowspan="5">SPK </td>
                                <td style="background-color:#F0FFFF;">Tanggal</td>
                                <td style="background-color:#F0FFFF;">
                                    <?php echo $sol->ket1 ?> s/d
                                    <?php echo $sol->ket2 ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F0FFFF;">Durasi SPK </td>
                                <td style="background-color:#F0FFFF;">
                                    <?php echo $sol->ket3 ?> hari
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F0FFFF;">Real waktu terhadap Tanggal Mulai SPK </td>
                                <td style="background-color:#F0FFFF;">
                                    <?php echo $sol->ket4 ?> hari
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F0FFFF;">Prosentase waktu Real </td>
                                <td style="background-color:#F0FFFF;">
                                    <?php echo $sol->ket5 ?> %
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F0FFFF;">Rata-rata Dokumen per hari terhadap tanggal SPK
                                </td>
                                <td style="background-color:#F0FFFF;">
                                    <?php echo $sol->ket10 ?> Dokumen
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#FFFACD;" rowspan="3">2.</td>
                                <td style="background-color:#FFFACD;" rowspan="3">DCR </td>
                                <td style="background-color:#FFFACD;">Start Pakai DCR </td>
                                <td style="background-color:#FFFACD;">
                                    <?php echo $sol->ket6 ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#FFFACD;">Jumlah pemakaian DCR </td>
                                <td style="background-color:#FFFACD;">
                                    <?php echo $sol->ket7 ?> hari
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#FFFACD;">Rata-rata Dokumen per hari terhadap pemakaian DCR
                                </td>
                                <td style="background-color:#FFFACD;">
                                    <?php echo $sol->ket8 ?> Dokumen
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;" rowspan="11">3.</td>
                                <td style="background-color:#F5F5F5;" rowspan="11">DOKUMEN </td>
                                <td style="background-color:#F5F5F5;">Total</td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket9 ?> Dokumen
                                </td>
                            </tr>

                            <tr>
                                <td style="background-color:#F5F5F5;">Total yang Telat </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket11 ?> Dokumen
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Prosentase yang Telat </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket12 ?> %
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Total yang belum kembali ke ADM </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket13 ?> Dokumen
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Prosentase yang belum kembali ke ADM </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket14 ?> %
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Last Update</td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket15 ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">IDLE Time </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket16 ?> Hari
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Kategori yang digunakan </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket17 ?> kategori
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Jumlah per Kategori </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket18 ?> Dokumen
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Total yang sudah diupload PDF </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket19 ?> Dokumen
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:#F5F5F5;">Prosentase yang sudah diupload PDF </td>
                                <td style="background-color:#F5F5F5;">
                                    <?php echo $sol->ket20 ?> %
                                </td>
                            </tr>
                            <?php
                            } ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->
<?php $this->load->view("komponen/bawah.php") ?>

<!--IMPORT SOLUSI-->
<div class="modal fade" id="tambahData" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/proses_upload_solusi', ' id="FormulirTambah"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Migrasi Permasalahan & Solusi</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp58"
                                        value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah"
                                        value="<?php echo $this->session->userdata('idadmin'); ?>" class="form-control"
                                        required />
                                </div>
                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Format EXCEL ---></label>
                                <a style="font-size:12px;" class="btn btn-warning"
                                    href="<?php echo base_url() ?>excel/formatUPsolusi.xlsx" target="_blank"><i
                                        class="fa fa-download"></i> Download Format</a>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform">Submit</button>
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
<!--TAMBAH DATA FOTO -->
<div class="modal fade" id="tambahDataFoto" tabindex="1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/fototambah', ' id="FormulirTambahFoto"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui Data Foto</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id"
                                        value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah"
                                        value="<?php echo $this->session->userdata('idadmin'); ?>" class="form-control"
                                        required />

                                    <input type="file" name="berkas[]" class="form-control" required />

                                </div>
                            </div>
                            <div class="form-group mt-lg file2">
                                <label class="col-sm-3 control-label">FILE 2<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group mt-lg file3">
                                <label class="col-sm-3 control-label">FILE 3<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group mt-lg file4">
                                <label class="col-sm-3 control-label">FILE 4</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 5</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-lg Catatan">
                                <h6> - FOTO Proyek harus menggambarkan progres secara keseluruhan </h6>
                                <h6> - Minimal 3 Foto yang di upload dan maksimal 5 Foto </h6>
                                <h6> </h6>
                                <h6> Format Foto : </h6>
                                <h6> - Jenis File : jpg / jpeg / jpe / png </h6>
                                <h6> - Ukuran File Maximum : 2 mb (perfoto) </h6>
                                <h6> Ukuran Pixel File Maximum : </h6>
                                <h6> - Width : 2048 </h6>
                                <h6> - Height : 1000 </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">


                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitformfoto">Submit</button>
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

<!--TAMBAH DATA TEKNIS -->
<div class="modal fade" id="tambahDataTeknis" tabindex="1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/teknistambah', ' id="FormulirTambahTeknis"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui File PDF Data Teknis</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1 STR</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id"
                                        value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah"
                                        value="<?php echo $this->session->userdata('idadmin'); ?>" class="form-control"
                                        required />

                                    <input type="file" name="berkas[]" class="form-control" />

                                </div>
                            </div>
                            <div class="form-group mt-lg file2">
                                <label class="col-sm-3 control-label">FILE 2 ARS</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file3">
                                <label class="col-sm-3 control-label">FILE 3 MEP</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file4">
                                <label class="col-sm-3 control-label">FILE 4</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 5</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 6</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 7</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 8</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 9</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 10</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">


                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitformteknis">Submit</button>
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

<div class="modal fade" id="tambahData2" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/proses_upload_dcr', ' id="FormulirTambah2"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Migrasi DCR</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp58"
                                        value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah"
                                        value="<?php echo $this->session->userdata('idadmin'); ?>" class="form-control"
                                        required />
                                </div>
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

<div class="modal fade" id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Detail PKP</h2>
                </header>
                <div class="panel-body" id="showdetail">
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('setting/pkpedit', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data PKP</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg kategori">
                        <label class="col-sm-3 control-label">Pilih Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id" value="<?php echo $this->session->userdata('idadmin'); ?>"
                                class="form-control" required />
                            <input type="hidden" name="id_instansi2" id="instansi2" class="form-control" required />
                            <select data-plugin-selectTwo class="form-control" name="id_instansi" id="instansi"
                                required>
                                <?php foreach ($instansi as $kat): ?>
                                    <option value="<?php echo $kat->id; ?>">
                                        <?php echo $kat->nomor; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group mt-lg nomor">
                        <label class="col-sm-3 control-label">Nomor PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nomor" id="no_pkp" class="form-control"
                                onkeypress="return hanyaAngka(event)" required />
                        </div>
                    </div>
                    <div class="form-group mt-lg proyek">
                        <label class="col-sm-3 control-label">Nama PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea rows="4" class="form-control" id="proyek" name="proyek" required></textarea>

                        </div>
                    </div>
                    <div class="form-group mt-lg alias">
                        <label class="col-sm-3 control-label">Nama Singkatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="alias" id="alias" class="form-control" required />
                        </div>
                    </div>


                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" type="submit"
                                id="submitformEdit">Submit</button>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel  panel-danger">
                <header class="panel-heading">
                    <h2 class="panel-title">Konfirmasi Hapus Data</h2>
                </header>
                <div class="panel-body">
                    <div class="modal-wrapper">
                        <div class="modal-icon">
                            <i class="fa fa-question-circle"></i>
                        </div>
                        <div class="modal-text">
                            <h4>Yakin ingin menghapus data ini ?</h4>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <?php echo form_open('setting/pkphapus', ' id="FormulirHapus"'); ?>
                            <input type="hidden" name="idd" id="idddelete">
                            <button type="submit" class="btn btn-danger" id="submitformHapus">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </footer>
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform").removeAttribute('disabled');
                $('#tambahData').modal('hide');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    window.location.href = "<?php echo base_url() ?>proyek/edit_2/" + data.id_pkp
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    /* TAMBAH FOTO */
    document.getElementById("FormulirTambahFoto").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformfoto").setAttribute('disabled', 'disabled');
        $('#submitformfoto').html('Loading ...');
        var form = $('#FormulirTambahFoto')[0];
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                document.getElementById("submitformfoto").removeAttribute('disabled');
                $('#submitformfoto').html('Submit');
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitformfoto").removeAttribute('disabled');
                $('#tambahDataFoto').modal('hide');
                document.getElementById("FormulirTambahFoto").reset();
                $('#submitformfoto').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    //location.reload();
                    window.location.href = "<?php echo base_url() ?>proyek/edit_3/" + data.id_pkp
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    /* TAMBAH FOTO */
    document.getElementById("FormulirTambahTeknis").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformteknis").setAttribute('disabled', 'disabled');
        $('#submitformteknis').html('Loading ...');
        var form = $('#FormulirTambahTeknis')[0];
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                document.getElementById("submitformteknis").removeAttribute('disabled');
                $('#submitformteknis').html('Submit');
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitformteknis").removeAttribute('disabled');
                $('#tambahDataTeknis').modal('hide');
                document.getElementById("FormulirTambahTeknis").reset();
                $('#submitformteknis').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    //location.reload();
                    window.location.href = "<?php echo base_url() ?>proyek/edit_4/" + data.id_pkp
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                    window.location.href = "<?php echo base_url() ?>proyek/edit_5/" + data.id_pkp
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 22",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });

    function detail(elem) {
        var dataId = $(elem).data("id");
        $('#detailData').modal();
        $('#showdetail').html('Loading...');
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>setting/pkpdetail',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                var datarow = '';
                $.each(response, function (i, item) {
                    datarow += '<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                    datarow += "<tr><td>Nomor Instansi</td><td>" + item.nomor + "</td></tr>";
                    datarow += "<tr><td>Nama Instansi</td><td>" + item.instansi + " </td></tr>";
                    datarow += "<tr><td>Nomor PKP</td><td> " + item.no_pkp + "</td></tr>";
                    datarow += "<tr><td>Nama PKP</td><td> " + item.proyek + "</td></tr>";
                    datarow += "<tr><td>Alias</td><td> " + item.alias + "</td></tr>";
                    datarow += "<tr><td>INS/PKP</td><td> " + item.nomor + " / " + item.no_pkp + "</td></tr>";
                    datarow += "</table>";
                });
                $('#showdetail').html(datarow);
            }
        });
        return false;
    }

    function edit(elem) {
        var dataId = $(elem).data("id");
        document.getElementById("idd").setAttribute('value', dataId);
        $('#editData').modal();
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>setting/pkpdetail',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, item) {
                    document.getElementById("no_pkp").setAttribute('value', item.no_pkp);
                    document.getElementById("instansi2").setAttribute('value', item.id_instansi2);
                    document.getElementById("proyek").value = item.proyek;
                    document.getElementById("alias").setAttribute('value', item.alias);
                    $("#instansi").select2("val", item.id_instansi);
                });
            }
        });
        return false;
    }
    document.getElementById("FormulirEdit").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformEdit").setAttribute('disabled', 'disabled');
        $('#submitformEdit').html('Loading ...');
        var form = $('#FormulirEdit')[0];
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                document.getElementById("submitformEdit").removeAttribute('disabled');
                $('#submitformEdit').html('Submit');
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                PNotify.removeAll();
                tableitems.ajax.reload();
                document.getElementById("submitformEdit").removeAttribute('disabled');
                $('#editData').modal('hide');
                document.getElementById("FormulirEdit").reset();
                $('#submitformEdit').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });

    function hapus(elem) {
        var dataId = $(elem).data("id");
        document.getElementById("idddelete").setAttribute('value', dataId);
        $('#modalHapus').modal();
    }
    document.getElementById("FormulirHapus").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformHapus").setAttribute('disabled', 'disabled');
        $('#submitformHapus').html('Loading ...');
        var form = $('#FormulirHapus')[0];
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                document.getElementById("submitformHapus").removeAttribute('disabled');
                $('#submitformHapus').html('Delete');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (key == 'fail') {
                        new PNotify({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            type: 'danger'
                        });
                    }
                }
            } else {
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
                PNotify.removeAll();
                tableitems.ajax.reload();
                document.getElementById("submitformHapus").removeAttribute('disabled');
                $('#modalHapus').modal('hide');
                document.getElementById("FormulirHapus").reset();
                $('#submitformHapus').html('Delete');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
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