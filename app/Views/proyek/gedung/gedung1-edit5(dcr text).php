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

<header class="page-header">
    <h2><a href="<?php echo base_url() ?>proyek" style="color:white">PROYEK</a> | <small style="color:cyan"><?php echo $this->security->xss_clean($proyek->row()->alias) ?></small> | <small><a href="<?php echo base_url() . $this->security->xss_clean($instansi3->row()->ling) ?>" style="color:white"><?php echo $this->security->xss_clean($instansi3->row()->alias) ?></a></small></h2>
</header>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_1/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info1" aria-selected="true">PROGRESS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_2/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info2" aria-selected="true">PERMASALAHAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_3/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info3" aria-selected="true">DATA UMUM & FOTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_4/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info4" aria-selected="true">DATA TEKNIS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="info5-tab" data-toggle="tab" href="#info5" role="tab" aria-controls="info5" aria-selected="true">MONITORING DCR</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_6/<?php echo $proyek->row()->id_pkp ?>" role="tab" aria-controls="info6" aria-selected="true">MONTORING KARYAWAN</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!---DCR--->
        <div class="tab-pane active" id="info5" role="tabpanel" aria-labelledby="info5-tab">
            <div class="card-body">
                <div class="d-flex flex-row pull-right">

                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if ($proyek->row()->tgl_ubah_dcr > 0) { ?>
                                <b><?php echo (date('d-M-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_ubah_dcr)))) ?>
                                <?php } ?> </b>
                        </h6>
                        <?php
                        if (level_user('proyek', 'data', $kategoriQNS, 'posting') > 0) {
                        ?>
                            <h6 class="btn btn-success" style="font-size: 12px;">
                                <a data-toggle="modal" data-target="#tambahData2"> UPDATE DCR</a>
                            </h6>
                        <?php } ?>
                    </div>

                </div>

                <h4 class="card-subtitle" style="margin-bottom: 5px">TABEL DATA DCR</h4>
                <div class="table-scrollable" style="height: 400px;width:100%">
                    <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped" style="min-width: 1200px;">
                        <thead style="background-color:dimgrey;color:white;">

                            <tr>
                                <th style="text-align:center;width: 5%">NO.</th>
                                <th style="text-align:center;width: 95%" colspan="3">URAIAN</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($dcr as $sol) { ?>
                                <tr>
                                    <td style="background-color:#F0FFFF;width:5%;text-align:center;" rowspan="5">1.</td>
                                    <td style="background-color:#F0FFFF;" rowspan="5">SPK </td>
                                    <td style="background-color:#F0FFFF;">Tanggal</td>
                                    <td style="background-color:#F0FFFF;"><?php echo $sol->ket1 ?> s/d <?php echo $sol->ket2 ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F0FFFF;">Durasi </td>
                                    <td style="background-color:#F0FFFF;"><?php echo $sol->ket3 ?> hari</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F0FFFF;">Real waktu dari Tanggal SPK </td>
                                    <td style="background-color:#F0FFFF;"><?php echo $sol->ket4 ?> hari</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F0FFFF;">Prosentase waktu Real </td>
                                    <td style="background-color:#F0FFFF;"><?php echo $sol->ket5 ?> %</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F0FFFF;">Rata-rata Dokumen per hari dari tanggal SPK </td>
                                    <td style="background-color:#F0FFFF;"><?php echo $sol->ket10 ?> Dokumen</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FFFACD;text-align:center" rowspan="3">2.</td>
                                    <td style="background-color:#FFFACD;" rowspan="3">DCR </td>
                                    <td style="background-color:#FFFACD;">Pemakaian Mulai </td>
                                    <td style="background-color:#FFFACD;"><?php echo $sol->ket6 ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FFFACD;">Durasi Pemakaian </td>
                                    <td style="background-color:#FFFACD;"><?php echo $sol->ket7 ?> hari</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#FFFACD;">Rata-rata Dokumen per hari terhadap pemakaian DCR </td>
                                    <td style="background-color:#FFFACD;"><?php echo $sol->ket8 ?> Dokumen</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;text-align:center" rowspan="11">3.</td>
                                    <td style="background-color:#F5F5F5;" rowspan="11">DOKUMEN </td>
                                    <td style="background-color:#F5F5F5;">Total</td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket9 ?> Dokumen</td>
                                </tr>

                                <tr>
                                    <td style="background-color:#F5F5F5;">Total yang Telat </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket11 ?> Dokumen</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Prosentase yang Telat </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket12 ?> %</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Total yang belum kembali ke ADM </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket13 ?> Dokumen</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Prosentase yang belum kembali ke ADM </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket14 ?> %</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Tanggal Terakhir Input</td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket15 ?></td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Selisih Waktu </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket16 ?> Hari</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Kategori yang digunakan </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket17 ?> kategori</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Rata-rata per Kategori </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket18 ?> Dokumen</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Total yang sudah diupload PDF </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket19 ?> Dokumen</td>
                                </tr>
                                <tr>
                                    <td style="background-color:#F5F5F5;">Prosentase yang sudah diupload PDF </td>
                                    <td style="background-color:#F5F5F5;"><?php echo $sol->ket20 ?> %</td>
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
</script>
</body>

</html>