<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">DATA UMUM & FOTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                href="<?= base_url() ?>laporan/marketing/<?= $marketing3->getRow()->id_marketing ?>">PROGRESS
                TENDER & KONTRAK</a>
        </li>
        <?php if ($marketing3->getRow()->no_pkp != '' and $marketing3->getRow()->tgl_finish > 0) { ?>
            <li class="nav-item">
                <a class="nav-link"
                    href="<?= base_url() ?>laporan/addendum/<?= $marketing3->getRow()->id_marketing ?>">PROGRESS
                    ADDENDUM</a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/data_mkt/<?= $marketing3->getRow()->id_marketing ?>">DATA
                KONTRAK</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <div class="row">
                <div class="col-md-6">
                    <div class="col-sm-12">
                        <div class="d-flex flex-row pull-right">
                            <?php
                            if (level_user('data', 'marketing', $kategoriQNS, 'edit') > 0) {
                                ?>
                                <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                                    data-target="#tambahData"> UPDATE DATA UMUM</a>
                            <?php } ?>

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable">
                                <!--<table class="table table-bordered">-->
                                <thead style="background-color:#1b3a59">
                                    <tr>
                                        <?php
                                        if ($marketing3->getRow()->tgl_update_dtu > 0) {
                                            $tgl_dtu = date('d M Y', strtotime($marketing3->getRow()->tgl_update_dtu));
                                        } else {
                                            $tgl_dtu = '';
                                        }
                                        ?>
                                        <th style="text-align:center;font-size: 18px">DATA UMUM Upd:
                                            <?= $tgl_dtu ?>
                                        </th>
                                        <th style="text-align:right;">
                                            <h6 class="btn btn-info" style="font-size: 10px;"><a style="color:white"
                                                    target='_blank'
                                                    href="<?= base_url() . esc($marketing3->getRow()->file) ?>">Zoom</a>
                                            </h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <?php if (($marketing3->getRow()->file != '')) { ?>

                                                <iframe src="<?= base_url() . esc($marketing3->getRow()->file) ?>"
                                                    width="100%" height="600"></iframe>

                                            <?php } ?>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                            <a style="font-size: 12px;font-weight: 100;color:black"><i>Catatan: Apabila ada Update agar
                                    disampaikan ke Biro Engineering</a></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="col-sm-12">
                        <div class="d-flex flex-row pull-right">
                            <?php
                            if (level_user('data', 'marketing', $kategoriQNS, 'edit') > 0) {
                                ?>
                                <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                                    data-target="#tambahData2"> UPDATE FOTO</a>
                            <?php } ?>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable">
                                <!--<table class="table table-bordered">-->
                                <thead style="background-color:#1b3a59">
                                    <tr>
                                        <?php
                                        if ($marketing3->getRow()->tgl_update_foto > 0) {
                                            $tgl_gbr = date('d M Y', strtotime($marketing3->getRow()->tgl_update_foto));
                                        } else {
                                            $tgl_gbr = '';
                                        }
                                        ?>
                                        <th style="text-align:center;width: 60%;font-size: 18px">FOTO Upd:
                                            <?= $tgl_gbr ?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <?php
                                            if ($gambar->getNumRows() > 0) {
                                                if (esc($gambar->getRow()->gambar1) != '') {
                                                    ?>
                                                    <a target='_blank'
                                                        href="<?= base_url() . esc($gambar->getRow()->gambar1) ?>"><img
                                                            src="<?= base_url() . esc($gambar->getRow()->gambar1) ?>"
                                                            class="rounded img-responsive" alt="foto proyek"> </a>
                                                    <h5 style="text-align: center;">Gambar 1</h5>
                                                    <?php
                                                }
                                                if (esc($gambar->getRow()->gambar2) != '') {
                                                    ?>
                                                    <a target='_blank'
                                                        href="<?= base_url() . esc($gambar->getRow()->gambar2) ?>"><img
                                                            src="<?= base_url() . esc($gambar->getRow()->gambar2) ?>"
                                                            class="rounded img-responsive" alt="foto proyek"> </a>
                                                    <h5 style="text-align: center;">Gambar 2</h5>
                                                    <?php
                                                }
                                                if (esc($gambar->getRow()->gambar3) != '') {
                                                    ?>
                                                    <a target='_blank'
                                                        href="<?= base_url() . esc($gambar->getRow()->gambar3) ?>"><img
                                                            src="<?= base_url() . esc($gambar->getRow()->gambar3) ?>"
                                                            class="rounded img-responsive" alt="foto proyek"> </a>
                                                    <h5 style="text-align: center;">Gambar 3</h5>
                                                    <?php
                                                }
                                                if (esc($gambar->getRow()->gambar4) != '') {
                                                    ?>
                                                    <a target='_blank'
                                                        href="<?= base_url() . esc($gambar->getRow()->gambar4) ?>"><img
                                                            src="<?= base_url() . esc($gambar->getRow()->gambar4) ?>"
                                                            class="rounded img-responsive" alt="foto proyek"> </a>

                                                    <h5 style="text-align: center;">Gambar 4</h5>
                                                    <?php
                                                }
                                                if (esc($gambar->getRow()->gambar5) != '') {
                                                    ?>
                                                    <a target='_blank'
                                                        href="<?= base_url() . esc($gambar->getRow()->gambar5) ?>"><img
                                                            src="<?= base_url() . esc($gambar->getRow()->gambar5) ?>"
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
    </div>
</section>

<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('laporan/tambah_dtu_mkt'), 'enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Data UMUM Marketing</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id"
                                        value="<?= esc($marketing3->getRow()->id_marketing) ?>" class="form-control"
                                        required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />

                                    <input type="file" name="berkas" class="form-control" required />

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
                <?= form_open(base_url('laporan/fototambah'), ['enctype' => 'multipart/form-data']); ?>
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
                                        value="<?= esc($marketing3->getRow()->id_marketing) ?>" class="form-control"
                                        required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />

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
                            <?= form_open(base_url('setting/userhapus'), ' id="FormulirHapus"'); ?>
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

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    var tableuser = $('#kontrakdata').DataTable({
        "ajax": {
            url: "<?= base_url() ?>laporan/datakontrak",
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
                    Swal.fire({
                        title: 'Notifikasi',
                        text: data.errors[key],
                        position: "top-end",
                        showConfirmButton: false,
                        icon: 'error'
                    });
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitform").removeAttribute('disabled');
                $('#tambahData').modal('hide');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');
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
                    Swal.fire({
                        title: 'Notifikasi',
                        text: data.errors[key],
                        position: "top-end",
                        showConfirmButton: false,
                        icon: 'error'
                    });
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitformHapus").removeAttribute('disabled');
                $('#modalHapus').modal('hide');
                document.getElementById("FormulirHapus").reset();
                $('#submitformHapus').html('Delete');
                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
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
                    Swal.fire({
                        title: 'Notifikasi',
                        text: data.errors[key],
                        position: "top-end",
                        showConfirmButton: false,
                        icon: 'error'
                    });
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitform2").removeAttribute('disabled');
                $('#tambahData2').modal('hide');
                document.getElementById("FormulirTambah2").reset();
                $('#submitform2').html('Submit');
                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
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

<?= $this->endSection() ?>