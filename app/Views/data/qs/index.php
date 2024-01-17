<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">LAPORAN BULANAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/masalah-qs">PERMASALAHAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/monitoring-karyawan-qs">MONITORING KARYAWAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/monitoring-dcr-qs">MONITORING DCR</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <!-- start: page -->
            <?php
            if (level_user('qs', 'index', $kategoriQNS, 'read') > 0) {
                ?>
                <div class="d-flex flex-row pull-right">
                    <div id="userbox3" class="userbox">
                        <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">TAMBAH DATA</a>
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                <li>
                                    <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                                        data-target="#tambahData"> PROYEK</a>
                                </li>
                                <li>
                                    <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                                        data-target="#tambahData2"> Lap. Bulanan</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
        <br>
        <div class="panel-body" style="margin-top:0.5%">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;text-align:center;width:4%">No.</th>
                        <th style="vertical-align:middle;text-align:center;width:31%">Nama Proyek</th>
                        <th style="vertical-align:middle;text-align:center;width:50%" colspan="3">Periode Laporan</th>
                        <th style="vertical-align:middle;text-align:center;width:15%">Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($proyek_qs as $qs) {
                        $no2 = 1;
                        if ($qs->periode_akhir > 0) {
                            $periode_akhir = date('d-M-Y', strtotime($qs->periode_akhir));
                        } else {
                            $periode_akhir = '';
                        }
                        $id_pkp = $qs->id_pkp;
                        $demo = '#demo' . $no;

                        $demo2 = 'demo' . $no;
                        ?>
                        <tr>
                            <td style="text-align:right;vertical-align:middle">
                                <?= $no ?>
                            </td>
                            <td style="border-bottom:0px;"><button type="button" class="btn btn-success"
                                    data-toggle="collapse" data-target="<?= $demo ?>"
                                    style="font-size:12px;background-color:transparent;border-color:transparent;color:grey;text-align:left">
                                    <?= $qs->proyek ?>
                                </button></td>
                            <td colspan="3" style="vertical-align:middle">
                                <?= $periode_akhir ?>
                            </td>
                            <td style="vertical-align:middle">
                                <?= date('d-M-Y', strtotime($qs->update_qs)) ?>
                            </td>
                        </tr>

                    <tbody class="collapse" id="<?= $demo2 ?>" style="border:none">
                        <?php
                        foreach ($QN as $row) { ?>

                            <tr>
                                <td style="text-align:right"></td>
                                <td></td>
                                <td style="width:3%;text-align:right;">
                                    <?= $no2 ?>
                                </td>
                                <td><a href="<?= base_url() . 'assets' . esc($row->file) ?>" target="_blank"
                                        style="color:darkorange;">
                                        <?= substr($row->file, -14); ?>
                                    </a></td>
                                <td>
                                    <?= date('d-M-Y', strtotime($row->tgl_periode)) ?>
                                </td>
                                <td>
                                    <?= date('d-M-Y', strtotime($row->tgl_upload)) ?>
                                </td>
                            </tr>

                            <?php $no2++;
                        } ?>
                    </tbody>
                    </tbody>
                    <?php
                    $no++;
                    $no2 = 1;
                    } ?>
                </tbody>
            </table>
        </div>
</section>

<!-- end: page -->


<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <form action="<?= base_url('laporan/tambahproyekqs') ?>" method="POST">
                    <header class="panel-heading">
                        <h2 class="panel-title">Tambah Data Proyek QS</h2>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group  pkp">
                                    <label class="col-sm-3 control-label">Proyek<span class="required">*</span></label>
                                    <div class="col-sm-9">
                                        <select data-plugin-selectTwo class="form-control" name="id_pkp" required>
                                            <option value="">Silahkan Pilih Proyek</option>
                                            <?php foreach ($proyek as $pry): ?>
                                                <option value="<?= $pry->id_pkp; ?>">
                                                    <?= $pry->no_pkp . '-' . $pry->proyek; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
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
                                <button style="font-size:12px" class="btn btn-default"
                                    data-dismiss="modal">Close</button>
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
                <?= form_open('laporan/tambah_lapbul', ' id="FormulirTambah2" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah PDF Lap. Bulanan</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group  pkp">
                                <label class="col-sm-3 control-label">Proyek<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="id_pkp" required>
                                        <option value="">Silahkan Pilih Proyek</option>
                                        <?php foreach ($proyek_qs as $pry): ?>
                                            <option value="<?= $pry->id_pkp; ?>">
                                                <?= $pry->no_pkp . ': ' . $pry->proyek; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Periode</label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_periode" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask required>
                                </div>
                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">FILE</label>
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
                            <?= form_open('setting/userhapus', ' id="FormulirHapus"'); ?>
                            <input type="hidden" name="idd" id="idddelete">
                            <button style="font-size:12px" type="submit" class="btn btn-danger"
                                id="submitformHapus">Delete</button>
                            <button style="font-size:12px" type="button" class="btn btn-default"
                                data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </div>
</div>

<!-- Vendor -->
<script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.js"></script>
<script src="<?= base_url() ?>assets/vendor/nanoscroller/nanoscroller.js"></script>
<script src="<?= base_url() ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url() ?>assets/vendor/magnific-popup/magnific-popup.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
<script src="<?= base_url() ?>assets/vendor/select2/select2.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
<script src="<?= base_url() ?>assets/javascripts/theme.js"></script>
<script src="<?= base_url() ?>assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="<?= base_url() ?>assets/javascripts/theme.init.js"></script>
<script src="<?= base_url() ?>assets/vendor/input-mask/jquery.inputmask.bundle.min.js"></script>



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
                window.setTimeout(function () {
                    location.reload();
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
                    location.reload();
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
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
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