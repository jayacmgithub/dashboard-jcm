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
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_1/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info1" aria-selected="true" style="color:black"><strong>PROGRESS</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_2/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info2" aria-selected="true" style="color:black"><strong>PERMASALAHAN</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_6/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info6" aria-selected="true" style="color:black"><strong>MONTORING KARYAWAN</strong></a>
        </li>
 <?php
    if ($nomorQN == '511') {
        ?>
        <?php
}
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_3/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info3" aria-selected="true" style="color:black"><strong>DATA UMUM & FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="info4-tab" data-toggle="tab" href="#info4" role="tab" aria-controls="info4"
                    aria-selected="true" style="color:black"><strong>DATA TEKNIS</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_5/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING DCR</strong></a>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">

        <!---TEKNIS--->
        <div class="tab-pane active" id="info4" role="tabpanel" aria-labelledby="info4-tab">
            <div>
                <div class="d-flex flex-row pull-right">
                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if ($proyek->getRow()->tgl_ubah_dtt > 0) { ?>
                            <b>
                                <?= (date('d-M-Y', strtotime(esc($proyek->getRow()->tgl_ubah_dtt)))) ?>
                                <?php } ?>
                            </b>
                        </h6>
                        <?php
                        if (level_user('proyek', 'data', $kategoriQNS, 'posting') > 0) {
                            ?>
                        <h6 class="btn btn-success" style="font-size: 12px;">
                            <a data-toggle="modal" data-target="#tambahDataTeknis"> UPDATE PDF</a>
                        </h6>
                        <?php } ?>
                    </div>

                </div>
                <h4 class="card-subtitle" style="margin-bottom: 5px;font-size:15px">DATA TEKNIS</h4>

                <div class="table-responsive">

                    <table class="table table-bordered dataTable no-footer">
                        <thead style="background-color:#1b3a59">
                            <tr>
                                <th style="text-align:center;width: 100%" colspan="2">URAIAN</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ($pdf->getNumRows() > 0) {
                                if (esc($pdf->getRow()->pdf1) != '') {
                                    ?>
                            <tr>
                                <td style="width: 5%;text-align:center">STR<br>
                                    <h6 class="btn btn-info" style="font-size: 12px;"><a style="color:white"
                                            target='_blank'
                                            href="<?= base_url() . esc($pdf->getRow()->pdf1) ?>">Zoom</a></h6>
                                </td>
                                <td>
                                    <iframe src="<?= base_url() . esc($pdf->getRow()->pdf1) ?>" width="100%"
                                        height="600"></iframe>
                                </td>

                            </tr>
                            <?php
                                }
                                if (esc($pdf->getRow()->pdf2) != '') {
                                    ?>
                            <tr>
                                <td style="width: 5%;text-align:center">ARS<br>
                                    <h6 class="btn btn-info" style="font-size: 12px;"><a style="color:white"
                                            target='_blank'
                                            href="<?= base_url() . esc($pdf->getRow()->pdf2) ?>">Zoom</a></h6>
                                </td>
                                <td>
                                    <iframe src="<?= base_url() . esc($pdf->getRow()->pdf2) ?>" width="100%"
                                        height="600"></iframe>
                                </td>
                            </tr>
                            <?php
                                }
                                if (esc($pdf->getRow()->pdf3) != '') {
                                    ?>
                            <tr>
                                <td style="width: 5%;text-align:center">MEP<br>
                                    <h6 class="btn btn-info" style="font-size: 12px;"><a style="color:white"
                                            target='_blank'
                                            href="<?= base_url() . esc($pdf->getRow()->pdf3) ?>">Zoom</a></h6>
                                </td>
                                <td>
                                    <iframe src="<?= base_url() . esc($pdf->getRow()->pdf3) ?>" width="100%"
                                        height="600"></iframe>
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
    </div>
</section>
<!-- end: page -->

<!--IMPORT PROGRESS-->

<!--TAMBAH DATA TEKNIS -->
<div class="modal fade" id="tambahDataTeknis" tabindex="1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/teknistambah'), ['enctype' => 'multipart/form-data']); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui File PDF Data Teknis</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1 STR</label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />

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

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 2,
    });

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

    /* TAMBAH TEKNIS */
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                document.getElementById("submitformteknis").removeAttribute('disabled');
                $('#tambahDataTeknis').modal('hide');
                document.getElementById("FormulirTambahTeknis").reset();
                $('#submitformteknis').html('Submit');
                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
                window.setTimeout(function () {
                    //location.reload();
                    window.location.href = "<?= base_url() ?>proyek/edit_4/" + data.id_pkp
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
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
</script>
</body>

</html>

<?= $this->endSection() ?>
