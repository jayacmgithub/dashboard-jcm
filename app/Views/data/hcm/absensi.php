<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/hcm">DATA KARYAWAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">ABSENSI</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <div class="card-body">
                <form method="get" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group nomor">
                                <label class="col-sm-3 control-label">Laporan<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select name="filter1" id="filter1" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="1">1. Absensi</option>
                                        <option value="2">2. Karyawan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group nomor" id="form-filter">
                                <label class="col-sm-3 control-label">Filter berdasarkan<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select name="filter2" id="filter2" class="form-control" requred>
                                        <option value="">Pilih</option>
                                        <option value="1">1. Per Bulan</option>
                                        <option value="2">2. Per Tahun</option>
                                        <option value="2">3. Per Karyawan (*)</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group nomor" id="form-bulan">
                                <label class="col-sm-3 control-label">Bulan<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select name="bulan" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                        foreach ($option_bulan as $data0) {
                                            if ($data0->bulan == '01') {
                                                $bulan = '01. Januari';
                                            } else {
                                                if ($data0->bulan == '02') {
                                                    $bulan = '02. Februari';
                                                } else {
                                                    if ($data0->bulan == '03') {
                                                        $bulan = '03. Maret';
                                                    } else {
                                                        if ($data0->bulan == '04') {
                                                            $bulan = '04. April';
                                                        } else {
                                                            if ($data0->bulan == '05') {
                                                                $bulan = '05. Mei';
                                                            } else {
                                                                if ($data0->bulan == '06') {
                                                                    $bulan = '06. Juni';
                                                                } else {
                                                                    if ($data0->bulan == '07') {
                                                                        $bulan = '07. Juli';
                                                                    } else {
                                                                        if ($data0->bulan == '08') {
                                                                            $bulan = '08. Agustus';
                                                                        } else {
                                                                            if ($data0->bulan == '09') {
                                                                                $bulan = '09. September';
                                                                            } else {
                                                                                if ($data0->bulan == '10') {
                                                                                    $bulan = '10. Oktober';
                                                                                } else {
                                                                                    if ($data0->bulan == '11') {
                                                                                        $bulan = '11. November';
                                                                                    } else {
                                                                                    }
                                                                                    $bulan = '12. Desember';
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            echo '<option value="' . $data0->bulan . '">' . $bulan . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group nomor" id="form-tahun">
                                <label class="col-sm-3 control-label">Tahun<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select name="tahun" class="form-control">
                                        <option value="">Pilih</option>
                                        <?php
                                        foreach ($option_tahun as $data) { // Ambil data tahun dari model yang dikirim dari controller
                                            echo '<option value="' . $data->tahun . '">' . $data->tahun . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group nomor" id="tombol">

                            <a href="<?= $url_export; ?>" class="btn btn-success btn-xs" style="font-size: 12px;">EXPORT
                                EXCEL</a>

                            <button class="btn btn-primary modal-confirm" type="submit" id="submitform"
                                style="font-size: 12px;">Tampilkan</button>
                            <button class="btn btn-default" style="background-color:dimgrey;color:white;font-size:12px"
                                href="<?= base_url() ?>lampiran/lampiran/">Reset</button>
                            <?php if ($instansi->getRow()->nomor == '270') { ?>
                                <a href="<?= base_url() ?>laporan/cetak_mon" class="btn btn-warning btn-xs"
                                    style="font-size: 12px;">CETAK Monitoring</a>
                            <?php } ?>
                        </div>
                    </div>

                </form>
            </div>

            <div class="table-scrollable" style="height: 580px;width:100%">
                <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped"
                    style="min-width: 1200px;width:200%;">
                    <thead style="background-color:dimgrey;color:white;">

                        <tr>
                            <th style="text-align:center;vertical-align:middle" rowspan="2">NO.</th>
                            <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">NRP</th>
                            <th style="text-align:center;vertical-align:middle;width:15%;" rowspan="2">Nama Karyawan
                            </th>
                            <th style="text-align:center;vertical-align:middle;width:10%;" rowspan="2">PKP ABSEN</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;" rowspan="2">PKP USER</th>
                            <th style="text-align:center;" colspan="4">Absensi</th>
                            <th style="text-align:center;vertical-align:middle;width:10%" rowspan="2">Ket. Absensi</th>
                            <th style="text-align:center;vertical-align:middle" rowspan="2">Jabatan</th>
                            <th style="text-align:center;vertical-align:middle" rowspan="2">Ket. Jabatan</th>
                            <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">Tgl Akhir Kontrak
                            </th>
                            <th style="text-align:center;" colspan="2">MOB</th>
                            <th style="text-align:center;" colspan="2">DEMOB</th>
                            </th>
                            <th style="text-align:center;vertical-align:middle" rowspan="2">STATUS</th>
                            <th style="text-align:center;vertical-align:middle;width:10%" rowspan="2">Ket. MOB/DEMOB
                            </th>
                            <th style="text-align:center;vertical-align:middle;width:10%;" rowspan="2">Mutasi / Resign
                            </th>
                        </tr>
                        <tr>
                            <th style="text-align:center;">S</th>
                            <th style="text-align:center;">I</th>
                            <th style="text-align:center;">A</th>
                            <th style="text-align:center;">C</th>
                            <th style="text-align:center;width:6%;">Renc</th>
                            <th style="text-align:center;width:6%;">Real</th>
                            <th style="text-align:center;width:6%;">Renc</th>
                            <th style="text-align:center;width:6%;">Real</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($laporan)) {
                            $no = 1;
                            foreach ($laporan as $data) {
                                if ($data->tgl_akhir_kontrak > 0) {
                                    $tgl_akhir_kontrak = (date('d-M-Y', strtotime(($data->tgl_akhir_kontrak))));
                                } else {
                                    $tgl_akhir_kontrak = '';
                                }
                                if ($data->tgl_ren_mob > 0) {
                                    $tgl_ren_mob = (date('d-M-Y', strtotime(($data->tgl_ren_mob))));
                                } else {
                                    $tgl_ren_mob = '';
                                }
                                if ($data->tgl_real_mob > 0) {
                                    $tgl_real_mob = (date('d-M-Y', strtotime(($data->tgl_real_mob))));
                                } else {
                                    $tgl_real_mob = '';
                                }
                                if ($data->tgl_ren_demob > 0) {
                                    $tgl_ren_demob = (date('d-M-Y', strtotime(($data->tgl_ren_demob))));
                                } else {
                                    $tgl_ren_demob = '';
                                }
                                if ($data->tgl_real_demob > 0) {
                                    $tgl_real_demob = (date('d-M-Y', strtotime(($data->tgl_real_demob))));
                                } else {
                                    $tgl_real_demob = '';
                                }
                                ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?= $no; ?>
                                    </td>

                                    <td style="text-align: center;">
                                        <?= $data->username; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->nama_admin; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->no_pkp . ' ' . $data->alias; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->no_pkp2 . ' ' . $data->alias2; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->sakit; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->ijin; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->alpha; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->cuti; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->ket_absensi; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->jabatan; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->ket_jabatan; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $tgl_akhir_kontrak; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $tgl_ren_mob; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $tgl_real_mob; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $tgl_ren_demob; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $tgl_real_demob; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->status; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->ket_mobdemob; ?>
                                    </td>
                                    <td style="text-align: left;">
                                        <?= $data->ket_akhir; ?>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
</section>
<!-- end: page -->
</section>

<?= $this->include('layout/js') ?>
</body>

</html>
<?= $this->endSection() ?>