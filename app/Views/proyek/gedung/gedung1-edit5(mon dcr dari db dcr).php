<?php $this->load->view("komponen/atas.php") ?>

<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">

<?php
$idQNS = $this->session->userdata('idadmin');
$isi = $this->db->from("master_admin")->where('id', $idQNS, 1)->get()->row();
$kategoriQNS = $isi->kategori_user;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_1/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info1" aria-selected="true" style="color:black"><strong>PROGRESS</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
        ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_2/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info2" aria-selected="true" style="color:black"><strong>PERMASALAHAN</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_6/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info6" aria-selected="true" style="color:black"><strong>MONTORING KARYAWAN</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
        ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_3/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info3" aria-selected="true" style="color:black"><strong>DATA UMUM & FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_4/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info4" aria-selected="true" style="color:black"><strong>DATA TEKNIS</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link active" id="info5-tab" data-toggle="tab" href="#info5" role="tab" aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING DCR</strong></a>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">
        <!---DCR--->
        <div class="tab-pane active" id="info5" role="tabpanel" aria-labelledby="info5-tab">
            <div>
                <div class="d-flex flex-row pull-right">

                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if ($proyek->row()->tgl_ubah_dcr > 0) { ?>
                                <b><?php echo (date('d-M-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_ubah_dcr)))) ?>
                                <?php } ?> </b>
                        </h6>

                        <div id="userbox" class="userbox">
                            <?php
                            if (level_user('proyek', 'data', $kategoriQNS, 'posting') > 0) {
                            ?>
                                <a class="btn btn-success" data-toggle="modal" data-target="#tambahData2" style="font-size: 12px;color:white"> UPDATE DCR</a>

                            <?php } ?>
                            <a class="btn btn-success" data-toggle="modal" data-target="#tambahData3" style="font-size: 12px;color:white"> UPDATE DATA</a>
                        </div>

                    </div>

                </div>

                <h4 class="card-subtitle" style="margin-bottom: 5px;font-size:15px">TABEL DATA DCR</h4>
                <div class="table-responsive">
                    <table class="table table-bordered dataTable">
                        <thead style="background-color:#1b3a59">
                            <tr>
                                <th style="width:20%;text-align:center">KETERANGAN</th>
                                <th style="width:80%;text-align:center;width:70%" colspan="4">URAIAN</th>
                                </th>
                            </tr>
                            <tr>
                                <td style="width: 20%;border-right: 5px;vertical-align: middle;background-color:white;">
                                    <a style="font-size: 14px;font-weight: 400;color:black" class="link">SPK</a>
                                </td>
                                <td style="width: 20%;vertical-align: middle;background-color:white;">
                                    <a style="font-size: 14px;font-weight: 100;color:black">TANGGAL MULAI</a>
                                    </br>
                                    <a style="font-size: 14px;font-weight: 100;color:black">TANGGAL SELESAI</a>
                                </td>
                                <td style="width: 40%;vertical-align: middle;background-color:white;" colspan="2">
                                    <?php
                                    if ($proyek->row()->tgl_mulai > 0) {
                                        $tgl_mulai = date('d-M-Y', strtotime($proyek->row()->tgl_mulai));
                                    } else {
                                        $tgl_mulai = '';
                                    }
                                    if ($proyek->row()->tgl_selesai > 0) {
                                        $tgl_selesai = date('d-M-Y', strtotime($proyek->row()->tgl_selesai));
                                    } else {
                                        $tgl_selesai = '';
                                    }
                                    ?>
                                    <a style="font-size: 14px;font-weight: 100;color:black"><?php echo $tgl_mulai ?></a>
                                    </br>
                                    <a style="font-size: 14px;font-weight: 100;color:black"><?php echo $tgl_selesai ?></a>
                                </td>

                            </tr>

                            <tr>
                                <?php foreach ($mon_dcr1 as $mon1) { ?>
                                    <?php
                                    $merah = 'style="text-align:center;background-color:firebrick;color:white;vertical-align:middle"';
                                    $biasa = 'style="text-align:center;vertical-align:middle;color:black"';
                                    if ($mon1->tgl_awal > 0) {
                                        $tgl_awal_dcr = date('d-M-Y', strtotime($mon1->tgl_awal));
                                    } else {
                                        $tgl_awal_dcr = '';
                                    }
                                    if ($mon1->tgl_akhir > 0) {
                                        $tgl_akhir_dcr = date('d-M-Y', strtotime($mon1->tgl_akhir));
                                        $selisih = ((abs(strtotime($proyek->row()->tgl_ubah_dcr) - (strtotime($mon1->tgl_akhir)))) / 86400);
                                    } else {
                                        $tgl_akhir_dcr = '';
                                        $selsisih = 0;
                                    }
                                    if ($selisih > 30) {
                                        $gaya = $merah;
                                    } else {
                                        $gaya = $biasa;
                                    }
                                    $durasi = (strtotime($mon1->tgl_akhir) - strtotime($mon1->tgl_awal)) / 60 / 60 / 24;
                                    if ($durasi > 0) {
                                        $rata2 = floor(($mon1->total / $durasi) * 30);
                                    } else {
                                        $rata2 = 0;
                                    }
                                    ?>
                                    <td style="width: 20%;border-right: 5px;vertical-align: middle;background-color:white;">
                                        <a style="font-size: 14px;font-weight: 400;color:black" class="link">DCR</a>
                                    </td>
                                    <td style="width: 20%;vertical-align: middle;background-color:white;">
                                        <a style="font-size: 14px;font-weight: 100;color:black">TANGGAL MULAI INPUT</a>
                                        </br>
                                        <a style="font-size: 14px;font-weight: 100;color:black">TANGGAL TERAKHIR INPUT</a>
                                        </br>
                                        <a style="font-size: 14px;font-weight: 100;color:black">DURASI PEMAKAIAN</a>
                                        </br>
                                        <a style="font-size: 14px;font-weight: 100;color:black">RATA-RATA / BULAN</a>
                                    </td>
                                    <td style="width: 60%;vertical-align: middle;background-color:white;" colspan="2">
                                        <a style="font-size: 14px;font-weight: 100;color:black"><?php echo $tgl_awal_dcr ?></a>
                                        </br>
                                        <a <?php echo $gaya ?>><?php echo $tgl_akhir_dcr . ' (sudah ' . $selisih . ' hari dari tanggal diperbarui)' ?></a>
                                        </br>
                                        <a style="font-size: 14px;font-weight: 100;color:black"><?php echo $durasi ?> Hari</a>
                                        </br>
                                        <a style="font-size: 14px;font-weight: 100;color:black"><?php echo $rata2 ?> Dokumen</a>
                                    </td>
                            </tr>


                            <?php
                                    $total = $mon1->total;
                                    $per_telat = ($mon1->telat / $mon1->total) * 100;
                                    $per_upload = ($mon1->upload / $mon1->total) * 100;
                                    $per_blm_upload = 100 - $per_upload;
                                    $per_blm_kembali = ($mon1->blm_kembali / $mon1->total) * 100;


                                    $telat = 'style="width:' . $per_telat . '%;height:18px;"';
                                    $per_sisa_telat = 100 - $per_telat;
                                    $sisa_telat = 'style="width:' . $per_sisa_telat . '%;height:18px;"';
                                    if ($per_telat >= 50) {
                                        $telat2 = 'bg-infoM';
                                    } else {
                                        if ($per_telat >= 35) {
                                            $telat2 = 'bg-infoK';
                                        } else {
                                            $telat2 = 'bg-info3';
                                        }
                                    }
                                    $telat3 = 'class="progress-bar ' . $telat2 .  ' wow animated progress-animated"';
                                    $abu2 = 'class="progress-bar bg-infoA wow animated progress-animated"';

                                    $upload = 'style="width:' . $per_upload . '%;height:18px;"';
                                    $per_sisa_upload = 100 - $per_upload;
                                    $sisa_upload = 'style="width:' . $per_sisa_upload . '%;height:18px;"';
                                    if ($per_upload >= 60) {
                                        $upload2 = 'bg-info3';
                                    } else {
                                        if ($per_upload >= 50) {
                                            $upload2 = 'bg-infoK';
                                        } else {
                                            $upload2 = 'bg-infoM';
                                        }
                                    }
                                    $upload3 = 'class="progress-bar ' . $upload2 .  ' wow animated progress-animated"';
                                    $blm_upload = 'style="width:' . $per_blm_upload . '%;height:18px;"';
                                    $per_sisa_blm_upload = 100 - $per_blm_upload;
                                    $sisa_blm_upload = 'style="width:' . $per_sisa_blm_upload . '%;height:18px;"';
                                    if ($per_blm_upload >= 50) {
                                        $blm_upload2 = 'bg-infoM';
                                    } else {
                                        if ($per_blm_upload >= 40) {
                                            $blm_upload2 = 'bg-infoK';
                                        } else {
                                            $blm_upload2 = 'bg-info3';
                                        }
                                    }
                                    $blm_upload3 = 'class="progress-bar ' . $blm_upload2 .  ' wow animated progress-animated"';

                                    $blm_kembali = 'style="width:' . $per_blm_kembali . '%;height:18px;"';
                                    $per_sisa_blm_kembali = 100 - $per_blm_kembali;
                                    $sisa_blm_kembali = 'style="width:' . $per_sisa_blm_kembali . '%;height:18px;"';
                                    if ($per_blm_kembali >= 50) {
                                        $blm_kembali2 = 'bg-infoM';
                                    } else {
                                        $blm_kembali2 = 'bg-info3';
                                    }
                                    $blm_kembali3 = 'class="progress-bar ' . $blm_kembali2 .  ' wow animated progress-animated"';
                                    $total = 'style="width: 100%;height:18px;"';
                                    $totalxx = 'style="width: 5px;height:100px;"';
                                    $totalxx2 = 'style="width: 5px;height:35px;"';
                                    $totalxx3 = 'style="width: 10px;height:45px;"';
                                    $totalxx4 = 'style="width: 10px;height:55px;"';
                                    //"progress-bar bg-info3 wow animated progress-animated"

                            ?>
                            <td style="width: 20%;vertical-align: middle;background-color:white;">
                                <a style="font-size: 14px;font-weight: 400;color:black" class="link">DOKUMEN</a>
                            </td>
                            <td style="width: 20%;border-right: 5px;vertical-align: middle;background-color:white;">
                                <a style="font-size: 14px;font-weight: 100;color:black">TOTAL DOKUMEN</a></br>
                                <a style="font-size: 14px;font-weight: 100;color:black">TERLAMBAT PROSES</a></br>
                                <a style="font-size: 14px;font-weight: 100;color:black">SUDAH DI UPLOAD</a></br>
                                <a style="font-size: 14px;font-weight: 100;color:black">BELUM DI UPLOAD</a></br>
                                <a style="font-size: 14px;font-weight: 100;color:black">BELUM KEMBALI KE JCM</a>

                            </td>


                            <td style="width: 40%;vertical-align: middle;text-align:left;background-color:white;">
                                <div class="progress-bar bg-info wow animated progress-animated" role="progressbar"> </div>
                                <br>
                                <div <?php echo $telat3 . ' ' . $telat ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap;"><?php echo number_format($per_telat, 2, ',', '.') ?>%</span></div>
                                <div <?php echo $abu2 . ' ' . $sisa_telat ?> role="progressbar"></div>

                                <div <?php echo $upload3 . ' ' . $upload ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap;"><?php echo number_format($per_upload, 2, ',', '.') ?>%</span></div>
                                <div <?php echo $abu2 . ' ' . $sisa_upload ?> role="progressbar"></div>

                                <div <?php echo $blm_upload3 . ' ' . $blm_upload ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap;"><?php echo number_format($per_blm_upload, 2, ',', '.') ?>%</span></div>
                                <div <?php echo $abu2 . ' ' . $sisa_blm_upload ?> role="progressbar"></div>

                                <div <?php echo $blm_kembali3 . ' ' . $blm_kembali ?> role="progressbar"> <span style="font-size: 12px;font-weight: 500;color:black;white-space: nowrap;"><?php echo number_format($per_blm_kembali, 2, ',', '.') ?>%</span></div>
                                <div <?php echo $abu2 . ' ' . $sisa_blm_kembali ?> role="progressbar"></div>
                            </td>
                            <td style="vertical-align: middle;background-color:white;text-align:right;">
                                <a style="font-size: 14px;font-weight: 100;color:black;"><?php echo number_format($mon1->total, 0, '.', ',') ?> Dokumen</a>
                                </br>
                                <a style="font-size: 14px;font-weight: 100;color:black"><?php echo number_format($mon1->telat, 0, '.', ',') ?> Dokumen</a>
                                </br>
                                <a style="font-size: 14px;font-weight: 100;color:black"><?php echo number_format($mon1->upload, 0, '.', ',') ?> Dokumen</a>
                                </br>
                                <a style="font-size: 14px;font-weight: 100;color:black"><?php echo number_format($mon1->total - $mon1->upload, 0, '.', ',') ?> Dokumen</a>
                                </br>
                                <a style="font-size: 14px;font-weight: 100;color:black"><?php echo number_format($mon1->blm_kembali, 0, '.', ',') ?> Dokumen</a>
                            </td>
                            </tr>

                        <?php } ?>


                        </thead>
                    </table>
                    <a style="font-size: 12px;font-weight: 100;color:black"><i>Catatan: Data detil monitoring dapat dilihat pada aplikasi DCR</a></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->
<?php $this->load->view("komponen/bawah.php") ?>

<div class="modal fade" id="tambahData2" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/proses_upload_mon_dcr', ' id="FormulirTambah2"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Import Data DCR</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp58" value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>" class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?php echo $this->session->userdata('idadmin'); ?>" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle" type="submit" id="submitform2">Submit</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="tambahData3" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/upd_data_spk', ' id="FormulirTambah3"'); ?>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Tanggal SPK MULAI</label>
                                <div class="col-sm-9">
                                    <?php
                                    $tgl_mulai = $this->security->xss_clean($proyek->row()->tgl_mulai);
                                    if ($tgl_mulai > 0) {
                                        $tanggal_mulai = date('d-m-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_mulai)));
                                    } else {
                                        $tanggal_mulai = '';
                                    }
                                    $tgl_selesai = $this->security->xss_clean($proyek->row()->tgl_selesai);
                                    if ($tgl_selesai > 0) {
                                        $tanggal_selesai = date('d-m-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_selesai)));
                                    } else {
                                        $tanggal_selesai = '';
                                    }
                                    $warning = $this->security->xss_clean($proyek->row()->warning);
                                    $late = $this->security->xss_clean($proyek->row()->late);
                                    ?>
                                    <input type="hidden" name="id_pkp" value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>" class="form-control" placeholder="Masukkan Nomor Dokumen" required />
                                    <input type="text" name="tgl_mulai" value="<?php echo $tanggal_mulai ?>" class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                                </div>

                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Tanggal SPK SELESAI</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tgl_selesai" value="<?php echo $tanggal_selesai ?>" class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                                </div>

                            </div>
                            <div class="form-group mt-lg dtu_nama">
                                <label class="col-sm-3 control-label">Target Warning</label>
                                <div class="col-sm-9">
                                    <input type="text" name="warning" value="<?php echo $warning ?>" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group mt-lg dtu_nama">
                                <label class="col-sm-3 control-label">Target Telat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="late" value="<?php echo $late ?>" class="form-control" required />
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle" type="submit" id="submitform3">Submit</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>

<!-- JS -->
<?php $this->load->view("komponen/js.php") ?>

<script type="text/javascript">
    $(".table-scrollable").freezeTable({
        'scrollable': true,
    });

    $(document).ready(function() {
        $('ul li a').click(function() {
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

    document.getElementById("FormulirTambah2").addEventListener("submit", function(e) {
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
        }).done(function(data) {
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
                window.setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        }).fail(function(data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload 22",
                type: 'danger'
            });
            window.setTimeout(function() {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
    document.getElementById("FormulirTambah3").addEventListener("submit", function(e) {
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
        }).done(function(data) {
            if (!data.success) {
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                document.getElementById("submitform3").removeAttribute('disabled');
                $('#tambahData3').modal('hide');
                document.getElementById("FormulirTambah3").reset();
                $('#submitform3').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function() {
                    location.reload();
                }, 2000);
            }
        }).fail(function(data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload KACAU",
                type: 'danger'
            });
            window.setTimeout(function() {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
</script>
</body>

</html>