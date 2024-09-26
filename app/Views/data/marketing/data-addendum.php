<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link"
                href="<?= base_url() ?>laporan/data_umum_mkt/<?= $marketing3->getRow()->id_marketing ?>">DATA
                UMUM & FOTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
                href="<?= base_url() ?>laporan/marketing/<?= $marketing3->getRow()->id_marketing ?>">PROGRESS
                TENDER & KONTRAK</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">PROGRESS ADDENDUM</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/data_mkt/<?= $marketing3->getRow()->id_marketing ?>">DATA
                KONTRAK</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <?php if (level_user('data', 'marketing', $kategoriQNS, 'edit') > 0) { ?>
                <div class="d-flex flex-row pull-right">
                    <div id="userbox3" class="userbox">
                        <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                            data-target="#tambahData"> TAMBAH ADDENDUM</a>

                    </div>
                </div>
            <?php } ?>
            <br><br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr style="background-color:#1b3a59;color:white;">
                            <th style="vertical-align:middle;text-align:center;width:3%"></th>
                            <th style="vertical-align:middle;text-align:center;width:5%">PKP</th>
                            <th style="vertical-align:middle;text-align:center;width:35%">PROYEK</th>
                            <th style="vertical-align:middle;text-align:center;width:7%">ADDENDUM</th>
                            <th style="vertical-align:middle;text-align:center;width:10%">BA/SURAT</th>
                            <th style="vertical-align:middle;text-align:center;width:10%">SPH</th>
                            <th style="vertical-align:middle;text-align:center;width:10%">NEGO</th>
                            <th style="vertical-align:middle;text-align:center;width:10%">DRAFT</th>
                            <th style="vertical-align:middle;text-align:center;width:10%">S. PER. ADD</th>
                        </tr>

                    </thead>

                    <tbody>


                        <?php if ($marketing2->getNumRows() > 0) {
                            foreach ($dt_marketing2 as $dt_mkt) { ?>
                                <tr>
                                    <td>
                                        <?php if ($dt_mkt->addendum_ke != '') { ?>
                                            <div class="btn-group">
                                                <button style="font-size:12px" type="button" class="btn btn-primary"
                                                    data-toggle="dropdown" aria-expanded="true"> <span
                                                        class="caret"></span></button>
                                                <?php $tombol_edit = level_user('data', 'marketing', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="' . base_url() . 'laporan/editaddendum/' . $dt_mkt->id_addendum . '" onclick="edit(this)" data-id="' . $dt_mkt->id_addendum . '">Edit</a></li>' : ''; ?>

                                                <?php $tombol_hapus = level_user('data', 'marketing', $kategoriQNS, 'edit') > 0 && $dt_mkt->tgl_mulai == 0 && $dt_mkt->tgl_selesai == 0 ? '<li><a style="font-size:12px" href="#" onclick="hapus(this)" data-id="' . $dt_mkt->id_addendum . '">Hapus</a></li>' : ''; ?>

                                                <ul class="dropdown-menu" role="menu">
                                                    <?= $tombol_edit ?>
                                                    <?= $tombol_hapus ?>
                                                </ul>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <?php
                                    if ($dt_mkt->tgl_ba_surat > 0) {
                                        $tgl_ba_surat = date('d-m-Y', strtotime($dt_mkt->tgl_ba_surat));
                                    } else {
                                        $tgl_ba_surat = '';
                                    }
                                    if ($dt_mkt->tgl_sph > 0) {
                                        $tgl_sph = date('d-m-Y', strtotime($dt_mkt->tgl_sph));
                                    } else {
                                        $tgl_sph = '';
                                    }
                                    if ($dt_mkt->tgl_nego > 0) {
                                        $tgl_nego = date('d-m-Y', strtotime($dt_mkt->tgl_nego));
                                    } else {
                                        $tgl_nego = '';
                                    }
                                    if ($dt_mkt->tgl_draft > 0) {
                                        $tgl_draft = date('d-m-Y', strtotime($dt_mkt->tgl_draft));
                                    } else {
                                        $tgl_draft = '';
                                    }
                                    if ($dt_mkt->tgl_sper > 0) {
                                        $tgl_sper = date('d-m-Y', strtotime($dt_mkt->tgl_sper));
                                    } else {
                                        $tgl_sper = '';
                                    }
                                    ?>
                                    <td>
                                        <?= $dt_mkt->no_pkp ?>
                                    </td>
                                    <td>
                                        <?= $dt_mkt->nama_proyek ?>
                                    </td>
                                    <td>
                                        <?= $dt_mkt->addendum_ke ?>
                                    </td>
                                    <td>
                                        <?= $tgl_ba_surat ?>
                                    </td>
                                    <td>
                                        <?= $tgl_sph ?>
                                    </td>
                                    <td>
                                        <?= $tgl_nego ?>
                                    </td>
                                    <td>
                                        <?= $tgl_draft ?>
                                    </td>
                                    <td>
                                        <?= $tgl_sper ?>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td style="text-align:center" colspan="9">DATA MASIH PROSES KONTRUKSI</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
</section>


<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:60%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('laporan/tambahaddendum'), ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Data Addendum</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">ADDENDUM KE<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="addendum_ke" class="form-control" required>
                                    <input type="hidden" name="id_marketing" class="form-control"
                                        value="<?= $marketing3->getRow()->id_marketing ?>" required>
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Tanggal BA/Surat<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_ba_surat" id="tanggal" autocomplete="off"
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
                            <?= form_open('laporan/hapusaddendum', ' id="FormulirHapus"'); ?>
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
</script>

<?= $this->endSection() ?>