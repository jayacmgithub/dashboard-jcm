<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link"
                href="<?= base_url() ?>laporan/data_umum_mkt/<?= $marketing->getRow()->id_marketing ?>">DATA
                UMUM & FOTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">PROGRESS TENDER & KONTRAK</a>
        </li>
        <?php if ($marketing->getRow()->no_pkp != '' and $marketing->getRow()->tgl_finish > 0) { ?>
            <li class="nav-item">
                <a class="nav-link"
                    href="<?= base_url() ?>laporan/addendum/<?= $marketing->getRow()->id_marketing ?>">PROGRESS
                    ADDENDUM</a>
            </li>
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/data_mkt/<?= $marketing->getRow()->id_marketing ?>">DATA
                KONTRAK</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">

            <?php
            if ($marketing->getRow()->tgl_undangan > 0) {
                $tgl_undangan = date('d-m-Y', strtotime($marketing->getRow()->tgl_undangan));
            } else {
                $tgl_undangan = '';
            }
            if ($marketing->getRow()->tgl_pq > 0) {
                $tgl_pq = date('d-m-Y', strtotime($marketing->getRow()->tgl_pq));
            } else {
                $tgl_pq = '';
            }
            if ($marketing->getRow()->tgl_pq_r > 0) {
                $tgl_pq_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_pq_r));
            } else {
                $tgl_pq_r = '';
            }
            if ($marketing->getRow()->tgl_awz_r > 0) {
                $tgl_awz_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_awz_r));
            } else {
                $tgl_awz_r = '';
            }
            if ($marketing->getRow()->tgl_awz > 0) {
                $tgl_awz = date('d-m-Y', strtotime($marketing->getRow()->tgl_awz));
            } else {
                $tgl_awz = '';
            }
            if ($marketing->getRow()->tgl_admin > 0) {
                $tgl_admin = date('d-m-Y', strtotime($marketing->getRow()->tgl_admin));
            } else {
                $tgl_admin = '';
            }
            if ($marketing->getRow()->tgl_admin_r > 0) {
                $tgl_admin_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_admin_r));
            } else {
                $tgl_admin_r = '';
            }
            if ($marketing->getRow()->tgl_harga > 0) {
                $tgl_harga = date('d-m-Y', strtotime($marketing->getRow()->tgl_harga));
            } else {
                $tgl_harga = '';
            }
            if ($marketing->getRow()->tgl_harga_r > 0) {
                $tgl_harga_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_harga_r));
            } else {
                $tgl_harga_r = '';
            }
            if ($marketing->getRow()->tgl_per_mkt > 0) {
                $tgl_per_mkt = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_mkt));
            } else {
                $tgl_per_mkt = '';
            }
            if ($marketing->getRow()->tgl_per_mkt_r > 0) {
                $tgl_per_mkt_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_mkt_r));
            } else {
                $tgl_per_mkt_r = '';
            }
            if ($marketing->getRow()->tgl_per_ops > 0) {
                $tgl_per_ops = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_ops));
            } else {
                $tgl_per_ops = '';
            }
            if ($marketing->getRow()->tgl_per_ops_r > 0) {
                $tgl_per_ops_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_ops_r));
            } else {
                $tgl_per_ops_r = '';
            }
            if ($marketing->getRow()->tgl_per_sdm > 0) {
                $tgl_per_sdm = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_sdm));
            } else {
                $tgl_per_sdm = '';
            }
            if ($marketing->getRow()->tgl_per_sdm_r > 0) {
                $tgl_per_sdm_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_sdm_r));
            } else {
                $tgl_per_sdm_r = '';
            }
            if ($marketing->getRow()->tgl_per_form > 0) {
                $tgl_per_form = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_form));
            } else {
                $tgl_per_form = '';
            }
            if ($marketing->getRow()->tgl_per_form_r > 0) {
                $tgl_per_form_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_per_form_r));
            } else {
                $tgl_per_form_r = '';
            }
            if ($marketing->getRow()->tgl_teknis > 0) {
                $tgl_teknis = date('d-m-Y', strtotime($marketing->getRow()->tgl_teknis));
            } else {
                $tgl_teknis = '';
            }
            if ($marketing->getRow()->tgl_teknis_r > 0) {
                $tgl_teknis_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_teknis_r));
            } else {
                $tgl_teknis_r = '';
            }
            if ($marketing->getRow()->tgl_pemasukan > 0) {
                $tgl_pemasukan = date('d-m-Y', strtotime($marketing->getRow()->tgl_pemasukan));
            } else {
                $tgl_pemasukan = '';
            }
            if ($marketing->getRow()->tgl_pemasukan_r > 0) {
                $tgl_pemasukan_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_pemasukan_r));
            } else {
                $tgl_pemasukan_r = '';
            }
            if ($marketing->getRow()->tgl_presentasi > 0) {
                $tgl_presentasi = date('d-m-Y', strtotime($marketing->getRow()->tgl_presentasi));
            } else {
                $tgl_presentasi = '';
            }
            if ($marketing->getRow()->tgl_presentasi_r > 0) {
                $tgl_presentasi_r = date('d-m-Y', strtotime($marketing->getRow()->tgl_presentasi_r));
            } else {
                $tgl_presentasi_r = '';
            }
            if ($marketing->getRow()->tgl_draft > 0) {
                $tgl_draft = date('d-m-Y', strtotime($marketing->getRow()->tgl_draft));
            } else {
                $tgl_draft = '';
            }
            if ($marketing->getRow()->tgl_ttd > 0) {
                $tgl_ttd = date('d-m-Y', strtotime($marketing->getRow()->tgl_ttd));
            } else {
                $tgl_ttd = '';
            }
            if ($marketing->getRow()->tgl_memo > 0) {
                $tgl_memo = date('d-m-Y', strtotime($marketing->getRow()->tgl_memo));
            } else {
                $tgl_memo = '';
            }
            ?>
            <div class="panel-body">
                <div class="table-responsive" style="margin-top:-10px;margin-bottom:-15px;">
                    <table class="table">
                        <thead>
                            <tr>
                                <td style="color:black;font-weight:500;border-color:transparent;width:15%;"> <b>PROGRESS
                                        TENDER</b></td>
                                <td style="border-color:transparent;text-align:center;width:2%;"></td>
                                <td style="border-color:transparent;width:32%;" colspan="6"></td>

                                <td style="width:2%;border-color:transparent"></td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    09. PEMASUKAN</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:16%;"
                                    colspan="2">
                                    <?= $tgl_pemasukan ?>
                                </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:16%;"
                                    colspan="2">
                                    <?= $tgl_pemasukan_r ?>
                                </td>

                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>
                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    01. NO. LIST</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="6">
                                    <?= $marketing->getRow()->no_list ?>
                                </td>

                                <td style="width:2%;border-color:transparent"></td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    10. PAGU</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="4">
                                    <?= number_format($marketing->getRow()->pagu, 0, ',', '.') ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    02. DIVISI</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="6">
                                    <?= $marketing->getRow()->divisi ?>
                                </td>

                                <td style="width:2%;border-color:transparent"></td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    11. PRESENTASI / KLARIFIKASI</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:16%;"
                                    colspan="2">
                                    <?= $tgl_presentasi ?>
                                </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:16%;"
                                    colspan="2">
                                    <?= $tgl_presentasi_r ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    03. NAMA PROYEK</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td style="width:32%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;"
                                    colspan="6">
                                    <?= $marketing->getRow()->nama_proyek ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    12. HASIL EVALUASI</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent"
                                    colspan="2"> ADM TEKNIS</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="width:15%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $marketing->getRow()->admin_teknis ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    04. LINGKUP</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:32%;border-radius:10px;"
                                    colspan="6">
                                    <?= $marketing->getRow()->lingkup ?>
                                </td>

                                <td style="width:2%;border-color:transparent"></td>

                                <td style="font-weight:500;width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent"
                                    colspan="2"> HARGA</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="width:15%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= number_format($marketing->getRow()->harga_evaluasi, 2, ',', '.') ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    05. PENGUMUMAN</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td style="width:32%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;"
                                    colspan="6">
                                    <?= $tgl_undangan ?>
                                </td>

                                <td style="width:2%;border-color:transparent"></td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    13. HASIL</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:5%;border-radius:10px;">
                                    <?= $marketing->getRow()->peringkat ?>
                                </td>
                                <td
                                    style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:5%;border-radius:10px;">
                                    <?= $marketing->getRow()->menang ?>
                                </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12%;border-radius:10px;"
                                    colspan="2">
                                    <?= $marketing->getRow()->keterangan ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    06. PQ</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td style="width:8%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_pq ?>
                                </td>
                                <td style="width:8%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_pq_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>

                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>
                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    07. AANWIJZING</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td style="width:16%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_awz ?>
                                </td>
                                <td style="width:16%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_awz_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>

                                <td style="color:black;font-weight:500;border-color:transparent;width:15%;"> <b>PROGRESS
                                        KONTRAK</b></td>



                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:15%;border-radius:10px;border-color:transparent">
                                    08. PROPOSAL</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:5%;border-radius:10px;border-color:transparent">
                                    ADMIN</td>

                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>

                                <td
                                    style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12.5%;border-radius:10px;">
                                    <?= $tgl_admin ?>
                                </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12.5%;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_admin_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    01. SPK</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="4">
                                    <?= $marketing->getRow()->no_spk ?>
                                </td>


                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td style="width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:5%;border-radius:10px;border-color:transparent">
                                    PERSONIL</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>

                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:10%;border-radius:10px;border-color:transparent">
                                    TOR (MKT)</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_mkt ?>
                                </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_mkt_r ?>
                                </td>

                                <td style="width:2%;border-color:transparent"></td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    02. DRAFT</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="4">
                                    <?= $tgl_draft ?>
                                </td>

                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>
                            <tr>
                                <td style="width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td style="width:5%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:10%;border-radius:10px;border-color:transparent">
                                    NAMA PERSONIL (OPS)</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_ops ?>
                                </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_ops_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    03. SURAT PERJANJIAN</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="4">
                                    <?= $tgl_ttd ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>
                            <tr>
                                <td style="width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td style="width:5%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:10%;border-radius:10px;border-color:transparent">
                                    SERTIFIKASI / CV (SDM)</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_sdm ?>
                                </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_sdm_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    04. MEMO PKP</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="4">
                                    <?= $tgl_memo ?>
                                </td>

                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>

                            <tr>
                                <td style="width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td style="width:5%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:10%;border-radius:10px;border-color:transparent">
                                    FORM DATA PERSONIL</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_form ?>
                                </td>
                                <td
                                    style="width:6.5%;border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;">
                                    <?= $tgl_per_form_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;border-radius:10px;border-color:transparent;width:15%;">
                                    05. NO PKP</td>
                                <td style="border-color:transparent;text-align:center;width:2%;"> : </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;border-radius:10px;width:32%;"
                                    colspan="4">
                                    <?= $marketing->getRow()->no_pkp ?>
                                </td>

                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>
                            <tr>
                                <td style="width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:5%;border-radius:10px;border-color:transparent">
                                    TEKNIS</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12.5%;border-radius:10px;">
                                    <?= $tgl_teknis ?>
                                </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12.5%;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_teknis_r ?>
                                </td>

                            </tr>
                            <tr>
                                <td style="border-color:transparent"></td>
                            </tr>
                            <tr>
                                <td style="width:15%;border-radius:10px;border-color:transparent"> </td>
                                <td style="width:2%;border-color:transparent;text-align:center"> </td>
                                <td
                                    style="background-color:lightgray;color:black;font-weight:500;width:5%;border-radius:10px;border-color:transparent">
                                    HARGA</td>
                                <td style="width:2%;border-color:transparent;text-align:center"> : </td>
                                <td
                                    style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12.5%;border-radius:10px;">
                                    <?= $tgl_harga ?>
                                </td>
                                <td style="border-color:transparent;background-color:lightgray;color:black;font-weight:500;width:12.5%;border-radius:10px;"
                                    colspan="3">
                                    <?= $tgl_harga_r ?>
                                </td>
                                <td style="width:2%;border-color:transparent"></td>
                                <td style="color:black;font-weight:500;border-color:transparent;width:15%;" colspan="2">
                                </td>
                                <td style="border-color:transparent;text-align:center;width:2%;"></td>
                                <td style="width:32%;text-align:right;border-color:transparent" colspan="3">
                                    <?php if (level_user('data', 'marketing', $kategoriQNS, 'edit') > 0) { ?>
                                        <a style="font-size:12px;color:white" class="btn btn-success"
                                            href="<?= base_url() ?>laporan/edit_tender/<?= $marketing->getRow()->id_marketing ?>">
                                            UPDATE DATA</a>
                                    <?php } ?>
                                </td>
                                <!--
                                <?php if ($marketing->getRow()->menang == 'MENANG' and $marketing->getRow()->tgl_ttd < 1) { ?>
                                    <td style="color:black;font-weight:500;border-color:transparent;width:15%;" colspan="2"></td>
                                    <td style="border-color:transparent;text-align:center;width:2%;"></td>
                                    <td style="width:32%;text-align:right;border-color:transparent" colspan="3"> <a style="font-size:12px;color:white" class="btn btn-success" href="<?= base_url() ?>laporan/editkontrak/<?= $marketing->getRow()->id_marketing ?>"> UPDATE DATA</a></td>
                                <?php } ?>
                                -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->include('layout/js') ?>

<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('laporan/tambahtender', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Data Tender</h2>
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
                                <label class="col-sm-3 control-label">Tanggal Undangan<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_undangan" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask required />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                id="submitform">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahData2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('laporan/mutasi_karyawan', ' id="FormulirTambah2" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Mutasi Karyawan</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  nama_karyawan">
                                <label class="col-sm-3 control-label">Pilih Karyawan<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="id_user" id="nama_user"
                                        placeholder="Silahkan pilih Karyawan" autofocus required>
                                        <option value=""></option>
                                        <?php foreach ($karyawan as $supp): ?>
                                            <option value="<?= $supp->id; ?>">
                                                <?= $supp->username . '-' . $supp->nama_admin . ': ' . $supp->alias; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">PKP LAMA<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="pkp_lama" id="pkp_lama" class="form-control" disabled
                                        readonly>
                                </div>
                            </div>
                            <div class="form-group  nama_karyawan">
                                <label class="col-sm-3 control-label">Pilih Respon<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="respon"
                                        placeholder="Silahkan pilih Respon" required>
                                        <option value=""></option>
                                        <option value="no_memo">Mutasi Belum Ada SK Mutasi</option>
                                        <option value="memo">Mutasi Sudah Ada SK Mutasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">Nomor SK Mutasi</label>
                                <div class="col-sm-9">
                                    <input type="text" name="memo" class="form-control">
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Tanggal Mobilisasi</label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_mob" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask>
                                </div>
                            </div>
                            <div class="form-group  pkp">
                                <label class="col-sm-3 control-label">PKP TUJUAN</label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="pkp_tujuan">
                                        <option value=""></option>
                                        <?php foreach ($proyek as $pkp): ?>
                                            <option value="<?= $pkp->id_pkp; ?>">
                                                <?= $pkp->nomor . '/' . $pkp->no_pkp . ': ' . $pkp->alias; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">Jabatan</label>
                                <div class="col-sm-9">
                                    <input type="text" name="jabatan" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                id="submitform2">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <?= form_open('laporan/hapusdatamkt', 'id="FormulirHapus" enctype="multipart/form-data"'); ?>
                            <input type="text" name="idd" id="idddelete">
                            <button style="font-size:12px" type="submit" class="btn btn-danger"
                                id="submitformHapus">HAPUS</button>
                            <button style="font-size:12px" type="button" class="btn btn-default"
                                data-dismiss="modal">BATALKAN</button>
                            </form>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </div>
</div>

<!-- Vendor -->




<script type="text/javascript">
    var tableuser = $('#mktdata').DataTable({
        "ajax": {
            url: "<?= base_url() ?>laporan/datamkt",
            type: 'GET'
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        },],
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

    $('#nama_user').change(function () {
        var dataId = $(this).val();
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>laporan/karyawandetil',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response.datarows, function (i, item) {
                    $('#pkp_lama').val(item.no_pkp);
                });

                // $('.listitem').append(datarow);
            }
        });
        return false;
    });

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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitform").removeAttribute('disabled');
                $('#tambahData').modal('hide');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');
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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitformHapus").removeAttribute('disabled');
                $('#modalHapus').modal('hide');
                document.getElementById("FormulirHapus").reset();
                $('#submitformHapus').html('Delete');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    window.location.href = "<?= base_url() ?>laporan/mkt";
                }, 1000);
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
        $('#submitform2').html('Loading ...');
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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitform2").removeAttribute('disabled');
                $('#tambahData2').modal('hide');
                document.getElementById("FormulirTambah2").reset();
                $('#submitform2').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
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
</script>

<?= $this->endSection() ?>