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
            <a class="nav-link"
                href="<?= base_url() ?>laporan/marketing/<?= $marketing->getRow()->id_marketing ?>">PROGRESS
                TENDER & KONTRAK</a>
        </li>
        <?php if ($marketing->getRow()->no_pkp != '' and $marketing->getRow()->tgl_finish > 0) { ?>
            <li class="nav-item">
                <a class="nav-link"
                    href="<?= base_url() ?>laporan/addendum/<?= $marketing->getRow()->id_marketing ?>">PROGRESS
                    ADDENDUM</a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">DATA KONTRAK</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <br>
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr style="background-color:#1b3a59;color:white;">
                            <th style="vertical-align:middle;text-align:center;" rowspan="2"></th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">NO.LIST</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">JENIS KONTRAK</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">DIVISI</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">TGL MEMO PKP</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">PKP</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">LINGKUP</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">PROYEK</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">NAMA SESUAI KONTRAK</th>
                            <th style="vertical-align:middle;text-align:center;" colspan="2">JANGKA WAKTU PELAKSANAAN
                            </th>
                            <th style="vertical-align:middle;text-align:center;" colspan="1">HRG.PENAWARAN/ KONTRAK</th>
                            <th style="vertical-align:middle;text-align:center;" colspan="2">JAMINAN PELAKSANAAN</th>
                            <th style="vertical-align:middle;text-align:center;" colspan="2">FILE BAST</th>
                            <th style="vertical-align:middle;text-align:center;" rowspan="2">FILE SRT REF</th>
                        </tr>
                        <tr style="background-color:#1b3a59;color:white;">
                            <th style="vertical-align:middle;text-align:center;">START</th>
                            <th style="vertical-align:middle;text-align:center;">FINISH</th>
                            <th style="vertical-align:middle;text-align:center;">NETT PORSI</th>
                            <th style="vertical-align:middle;text-align:center;">NILAI</th>
                            <th style="vertical-align:middle;text-align:center;">TGL</th>
                            <th style="vertical-align:middle;text-align:center;">I</th>
                            <th style="vertical-align:middle;text-align:center;">II</th>
                        </tr>

                    </thead>
                    <tbody>
                        <?php if ($marketing2->getNumRows() > 0) { ?>
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <?php if (level_user('data', 'marketing', $kategoriQNS, 'edit') > 0) { ?>
                                            <button style="font-size:12px" type="button" class="btn btn-primary"
                                                data-toggle="dropdown" aria-expanded="true"> <span
                                                    class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <?= $tombol_edit ?>
                                            </ul>
                                        <?php } ?>
                                    </div>
                                </td>
                                <?php
                                if ($marketing->getRow()->tgl_finish > 0) {
                                    $tgl_finish = date('d/m/Y', strtotime($marketing->getRow()->tgl_finish));
                                } else {
                                    $tgl_finish = '';
                                }
                                if ($marketing->getRow()->tgl_start > 0) {
                                    $tgl_start = date('d/m/Y', strtotime($marketing->getRow()->tgl_start));
                                } else {
                                    $tgl_start = '';
                                }
                                if ($marketing->getRow()->jaminan_tgl > 0) {
                                    $jaminan_tgl = date('d/m/Y', strtotime($marketing->getRow()->jaminan_tgl));
                                } else {
                                    $jaminan_tgl = '';
                                }
                                ?>
                                <td>
                                    <?= $marketing->getRow()->no_list ?>
                                </td>
                                <td>INDUK</td>
                                <td>
                                    <?= $marketing->getRow()->divisi ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->tgl_memo ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->no_pkp ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->lingkup ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->nama_proyek ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->nama_kontrak ?>
                                </td>
                                <td>
                                    <?= $tgl_start ?>
                                </td>
                                <td>
                                    <?= $tgl_finish ?>
                                </td>
                                <td style="text-align:right">
                                    <?= number_format($marketing->getRow()->harga_penawaran, 2, ',', '.') ?><br>
                                    <?= $marketing->getRow()->ppn ?>
                                    <p class="font-weight-bold">NETT <?= number_format($marketing->getRow()->nett_porsi, 2, ',', '.') ?> </p>
                                    <?= $marketing->getRow()->nett_porsi_kso ?>
                                </td>
                                <td style="text-align:right">
                                    <?= number_format($marketing->getRow()->jaminan_nilai, 2, ',', '.') ?>
                                </td>
                                <td>
                                    <?= $jaminan_tgl ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->bast_1 ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->bast_2 ?>
                                </td>
                                <td>
                                    <?= $marketing->getRow()->surat_ref ?>
                                </td>
                            </tr>
                        <?php } else { ?>
                            <tr>
                                <td style="text-align:center" colspan="17">DATA MASIH PROSES TENDER/KONTRAK</td>
                            </tr>
                        <?php } ?>
                        <?php
                        if ($data_addendum->getNumRows() > 0) {
                            foreach ($dt_addendum as $dt_add) {
                                if ($dt_add->tgl_mulai > 0) {
                                    $tgl_mulai = date('d/m/Y', strtotime($dt_add->tgl_mulai));
                                } else {
                                    $tgl_mulai = '';
                                }
                                if ($dt_add->tgl_selesai > 0) {
                                    $tgl_selesai = date('d/m/Y', strtotime($dt_add->tgl_selesai));
                                } else {
                                    $tgl_selesai = '';
                                }
                                if ($dt_add->tgl_jaminan > 0) {
                                    $tgl_jaminan = date('d/m/Y', strtotime($dt_add->tgl_jaminan));
                                } else {
                                    $tgl_jaminan = '';
                                }
                                ?>
                                <tr>
                                    <td>

                                        <div class="btn-group">
                                            <button style="font-size:12px" type="button" class="btn btn-primary"
                                                data-toggle="dropdown" aria-expanded="true"> <span
                                                    class="caret"></span></button>
                                            <?php $tombol_edit2 = level_user('data', 'marketing', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="' . base_url() . 'laporan/editaddendum2/' . $dt_add->id_addendum . '" onclick="edit(this)" data-id="' . $dt_add->id_addendum . '">Edit</a></li>' : ''; ?>
                                            <ul class="dropdown-menu" role="menu">
                                                <?= $tombol_edit2 ?>
                                            </ul>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td colspan="7">ADDENDUM
                                        <?= $dt_add->addendum_ke ?>
                                    </td>
                                    <td>
                                        <?= $tgl_mulai ?>
                                    </td>
                                    <td>
                                        <?= $tgl_selesai ?>
                                    </td>
                                    <td style="text-align:right">
                                        <?= number_format($dt_add->harga, 2, ',', '.') ?> <br>
 					<?= $dt_add->ppn ?>
					<p class="font-weight-bold">NETT <?= number_format($dt_add->nett_porsi, 2, ',', '.') ?></p>
                                    </td>
                                    <td style="text-align:right">
                                        <?= number_format($dt_add->nilai_jaminan, 2, ',', '.') ?>
                                    </td>
                                    <td>
                                        <?= $tgl_jaminan ?>
                                    </td>
                                    <td>
                                        <?= $dt_add->bast_1 ?>
                                    </td>
                                    <td>
                                        <?= $dt_add->bast_2 ?>
                                    </td>
                                    <td>
                                        <?= $dt_add->referensi ?>
                                    </td>
                                </tr>
                            <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
</section>

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

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    var tableuser = $('#data_mktdata').DataTable({
        "ajax": {
            url: "<?= base_url() ?>laporan/datadata_mkt",
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
                            text: data.message,
                            position: "top-end",
                            showConfirmButton: false,
                            icon: 'success'
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
            Swal.fire({
                title: 'Notifikasi',
                text: data.errors[key],
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
                            text: data.message,
                            position: "top-end",
                            showConfirmButton: false,
                            icon: 'success'
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
            }
        }).fail(function (data) {
            Swal.fire({
                title: 'Notifikasi',
                text: data.errors[key],
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
                            text: data.message,
                            position: "top-end",
                            showConfirmButton: false,
                            icon: 'success'
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


