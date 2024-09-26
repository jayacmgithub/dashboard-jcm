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
                aria-controls="info6" aria-selected="true" style="color:black"><strong>MONITORING KARYAWAN</strong></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="<?= base_url() ?>proyek/progress-invoice/<?= $proyek->getRow()->id_pkp ?>"
                role="tab" aria-controls="info5" aria-selected="true" style="color:black"><strong>PROGRESS
                    INVOICE</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_3/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info3" aria-selected="true" style="color:black"><strong>DATA UMUM & FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="info4-tab" data-toggle="tab" href="#info4" role="tab" aria-controls="info4"
                    aria-selected="true" style="color:black"><strong>DATA TEKNIS</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_5/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING DCR</strong></a>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">
        <!---MASALAH--->
        <div class="tab-pane active" id="info2" role="tabpanel" aria-labelledby="info2-tab">
            <div>
                <div class="d-flex flex-row pull-right">

                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if ($proyek->getRow()->tgl_ubah_masalah > 0) { ?>
                            <b>
                                <?= (date('d-M-Y', strtotime(esc($proyek->getRow()->tgl_ubah_masalah)))) ?>
                                <?php } ?>
                            </b>
                        </h6>
                        <?php
                        if (level_user('proyek', 'data', $kategoriQNS, 'add') > 0) {
                            ?>
                        <div id="userbox" class="userbox">
                            <a class="btn btn-success" data-toggle="modal" data-target="#tambahProgress"
                                style="font-size: 12px;color:white"> TAMBAH</a>
                            <!-- <a class="btn btn-success" data-toggle="modal" data-target="#tambahData"
                                style="font-size: 12px;color:white"> UPD. PROGRESS INVOICE</a> -->

                                <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">EXPORT

                                </a>
                                <div class="dropdown-menu">
                                    <ul class="list-unstyled">
                                        <li class="divider"></li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/xls2/<?= $proyek->getRow()->id_pkp ?>"
                                                target="_blank" style="font-size: 12px;color:black"> XLS</a>
                                        </li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/pdf1/<?= $proyek->getRow()->id_pkp ?>"
                                                style="font-size: 12px;color:black" target="_blank"> PDF</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <h4 class="card-subtitle" style="margin-bottom: 5px;font-size:15px">DATA PROGRESS INVOICE</h4>
                <div class="table-scrollable" style="height: 580px;width:100%">
                    <table cellspacing="0" id="example" class="table table-sm table-bordered table-striped"
                        style="min-width: 1200px;">
                        <thead style="background-color:#1b3a59;color:white;">
                            <tr>
                                <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">Aksi</th>
                                <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">Uraian</th>
                                <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">
                                    Progress Kwitansi</th>
                                <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">
                                    Nominal Rencana</th>

                                <th style="text-align:center;" colspan="3">BAP</th>
                                <th style="text-align:center;" colspan="1">MEMO</th>
                                <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">Tanggal
                                    Kwitansi
                                </th>
                                <th style="text-align:center;" colspan="2">Realisasi Cair</th>
                                <th style="text-align:center;" colspan="2">Piutang</th>
                                </th>
                                <th style="text-align:center;vertical-align:middle;width:5%;" rowspan="2">
                                    Keterangan
                                </th>
                            </tr>
                            <tr>
                                <th style="text-align:center;width:6%;">Nomor</th>
                                <th style="text-align:center;width:6%;">Tanggal</th>
                                <th style="text-align:center;width:6%;">Nominal</th>
                                <th style="text-align:center;width:6%;">Tanggal</th>
                                <th style="text-align:center;width:6%;">Tanggal</th>
                                <th style="text-align:center;width:6%;">Nominal</th>
                                <th style="text-align:center;width:6%;">Kwitansi</th>
                                <th style="text-align:center;width:6%;">Non Kwitansi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($inv as $i) { ?>
                                <tr>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary" data-toggle="dropdown"
                                                aria-expanded="true"><i class="fa fa-chevron-down"></i></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a style="font-size: 14px" href="#" onclick="detail(this)"
                                                        data-id="<?= $i->id; ?>">Detail</a></li>
                                                <li><a style="font-size: 14px" href="#" onclick="edit(this)"
                                                        data-id="<?= $i->id; ?>">Edit Memo/Kwitansi</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <?= $i->periode; ?>
                                    </td>
                                    <td>
                                        <?= $i->laporan_progress; ?>
                                    </td>
                                    <td>
                                        <?= $i->nomor_bap; ?>
                                    </td>
                                    <td>
                                        <?= $i->nomor_bap; ?>
                                    </td>
                                    <td
                                        style="<?php echo (strtotime($i->tanggal_bap) > strtotime('+7 days', strtotime($i->laporan_progress))) ? 'color:white; background-color: red;' : ''; ?>">
                                        <?= $i->tanggal_bap; ?>
                                    </td>
                                    <td>
                                        <?= $i->nominal_bap; ?>
                                    </td>
                                    <td>
                                        <?= $i->tanggal_memo; ?>
                                    </td>
                                    <td>
                                        <?= $i->tgl_kwitansi; ?>
                                    </td>
                                    <td>
                                        <?= $i->realisasi_cair_tgl; ?>
                                    </td>
                                    <td>
                                        <?= $i->realisasi_cair_nominal; ?>
                                    </td>
                                    <td>
                                        <?= $i->piutang_kwitansi; ?>
                                    </td>
                                    <td>
                                        <?= $i->piutang_nonkwitansi; ?>
                                    </td>
                                    <td>
                                        <?= $i->keterangan; ?>
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- end: page -->



<div class="modal fade" id="tambahProgress" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/tambahDataInvoice'), ['enctype' => 'multipart/form-data']); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui Data Progress Invoice</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <input type="hidden" class="form-control" name="id_pkp"
                            value="<?= $proyek->getRow()->id_pkp ?>">
                        <div class="col-md-6">
                            <label>Periode</label>
                            <input type="date" class="form-control" name="periode">
                        </div>
                        <div class="col-md-6">
                            <label>Progress Kwitansi</label>
                            <input type="date" class="form-control" name="laporan_progress">
                        </div>
                        <div class="col-md-6">
                            <label>Nomor BAP</label>
                            <input type="text" class="form-control" name="nomor_bap">
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal BAP</label>
                            <input type="date" class="form-control" name="tanggal_bap">
                        </div>
                        <div class="col-md-6">
                            <label>Nominal BAP</label>
                            <input type="text" class="form-control" name="nominal_bap">
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary modal-confirm"
                                    style="font-size: 12px;vertical-align: middle" type="submit"
                                    id="submitformInv">Submit</button>
                                <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </footer>
                    <?= form_close(); ?>
            </section>
        </div>
    </div>
</div>



<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/tambah-invoice'), ['enctype' => 'multipart/form-data']); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui Data Progress Invoice</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE <span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="<?= esc($proyek->getRow()->id_pkp); ?>"
                                        class="form-control" required />
                                    <input type="file" name="excelfile" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button class="btn btn-primary modal-confirm"
                                    style="font-size: 12px;vertical-align: middle" type="submit"
                                    id="submitformdtu">Submit</button>
                                <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </footer>
                    <?= form_close(); ?>
            </section>
        </div>
    </div>
</div>


<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/invoice-edit'), ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Memo / Kwitansi</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-group col-md-3 nomor_bap">
                            <label class="control-label">Nomor BAP<span class="required">*</span></label>
                            <input type="text" class="form-control" id="nomor_bap" name="nomor_bap">
                        </div>

                        <div class="form-group col-md-3 tanggal_bap">
                            <label class="control-label">Tanggal BAP<span class="required">*</span></label>
                            <input type="date" class="form-control" id="tanggal_bap" name="tanggal_bap">
                        </div>
                        <div class="form-group col-md-3 nominal_bap">
                            <label class="control-label">Nominal BAP<span class="required">*</span></label>
                            <input type="text" class="form-control" id="nominal_bap" name="nominal_bap">
                        </div>

                        <div class="form-group col-md-3 keterangan">
                            <label class="control-label">Keterangan<span class="required">*</span></label>
                            <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>

                    </div>
                    <footer class="panel-footer">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                    id="submitformEdit">Submit</button>
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
</section>
</div>
</div>
</div>

<?= $this->include('layout/js') ?>

<script type="text/javascript">

    var tableitems = $('#pkpdata').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>setting/datapkp",
            "type": "GET"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        }, {
            "targets": [6],
            "orderable": false,
        }, {
            "targets": [7],
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                PNotify.removeAll();
                tableitems.ajax.reload();
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

    function detail(elem) {
        var dataId = $(elem).data("id");
        $('#detailData').modal();
        $('#showdetail').html('Loading...');
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>setting/pkpdetail',
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
            url: '<?= base_url() ?>proyek/invoice-detail',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, item) {
                    document.getElementById("periode").value = item.periode;
                    document.getElementById("laporan_progress").value = item.laporan_progress;
                    document.getElementById("nomor_bap").value = item.nomor_bap;
                    document.getElementById("nominal_bap").value = item.nominal_bap;
                    document.getElementById("tanggal_bap").value = item.tanggal_bap;
                    document.getElementById("tanggal_memo").value = item.tanggal_memo;
                    document.getElementById("nominal_memo").value = item.nominal_memo;
                    document.getElementById("tgl_kwitansi").value = item.tgl_kwitansi;
                    document.getElementById("realisasi_cair_tgl").value = item.realisasi_cair_tgl;
                    document.getElementById("realisasi_cair_nominal").value = item.realisasi_cair_nominal;
                    document.getElementById("piutang_kwitansi").value = item.piutang_kwitansi;
                    document.getElementById("piutang_nonkwitansi").value = item.piutang_nonkwitansi;
                    document.getElementById("keterangan").value = item.keterangan;

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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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


<?= $this->endSection() ?>