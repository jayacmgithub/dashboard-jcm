<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">Data PKP</h2>
            </div>
            <?php
            echo level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 ? '<div class="col-md-6" align="right"><button style="font-size:12px;" class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"> Tambah</button>' : '';
            ?>
            <?php
            echo level_user('setting', 'pkp', $kategoriQNS, 'all') > 0 ? '<a style="font-size:12px;" class="btn btn-success" href="' . base_url() . 'setting/migrasipkp' . '"> Migrasi</a></div>' : '';
            ?>
        </div>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped" id="example">
            <thead>
                <tr>
                    <th></th>
                    <th>Nomor Instansi</th>
                    <th>Nama Instansi</th>
                    <th>Nomor PKP</th>
                    <th>Nama Sesuai Kontrak</th>
                    <th>Nama Alias</th>
                    <th>INS/PKP</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pkp as $pkp) {
                    $kunci = esc($pkp->kunci);
                    $status = $pkp->status == 'AKTIF' ? "<span class='btn btn-xs btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";

                    if ($kunci > 0) {
                        $tombolhapus = '';
                    } else {
                        $tombolhapus = level_user('setting', 'pkp', $kategoriQNS, 'delete') > 0 ? '<li><a style="font-size: 14px" href="#" onclick="hapus(this)" data-id="' . esc($pkp->id_pkp) . '">Hapus</a></li>' : '';
                    }
                    $tomboledit = level_user('setting', 'pkp', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size: 14px" href="#" onclick="edit(this)" data-id="' . esc($pkp->id_pkp) . '">Edit</a></li>' : '';
                    ?>
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-expanded="true"><i
                                        class="fa fa-chevron-down"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a style="font-size: 14px" href="#" onclick="detail(this)"
                                            data-id="' . esc($pkp->id_pkp) . '">Detail</a></li>
                                    <?= $tomboledit ?>
                                    <?= $tombolhapus ?>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <?= $pkp->nomor ?>
                        </td>
                        <td>
                            <?= $pkp->nama ?>
                        </td>
                        <td>
                            <?= $pkp->no_pkp ?>
                        </td>
                        <td>
                            <?= $pkp->proyek ?>
                        </td>
                        <td>
                            <?= $pkp->alias ?>
                        </td>
                        <td>
                            <?= $pkp->nomor ?> /
                            <?= $pkp->no_pkp ?>
                        </td>
                        <td>
                            <?= $status ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<!-- end: page -->


<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel  panel-primary">
                <?= form_open('setting/pkptambah'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Instansi</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg instansi">
                        <label class="col-sm-3 control-label">Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id" value="<?= session('idadmin'); ?>" class="form-control"
                                required />
                            <select data-plugin-selectTwo class="form-control" name="id_instansi" required>
                                <option value=""></option>
                                <?php foreach ($instansi as $ins): ?>
                                    <option value="<?= $ins->id; ?>">
                                        <?= $ins->nama; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        </div>
                    </div>
                    <div class="form-group mt-lg nomor">
                        <label class="col-sm-3 control-label">Nomor PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nomor" class="form-control" onkeypress="return hanyaAngka(event)"
                                required />
                        </div>
                    </div>
                    <div class="form-group mt-lg proyek">
                        <label class="col-sm-3 control-label">Nama PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea type="text" name="proyek" class="form-control" placeholder="Nama Sesuai Kontrak"
                                required></textarea>
                        </div>
                    </div>
                    <div class="form-group mt-lg alias">
                        <label class="col-sm-3 control-label">Nama Singkatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="alias" class="form-control" required />
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" type="submit" id="submitform">Submit</button>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Detail PKP</h2>
                </header>
                <div class="panel-body" id="showdetail">
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </div>
</div>

<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('setting/pkpedit', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data PKP</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-lg kategori">
                                <label class="col-sm-3 control-label">Pilih Instansi<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_instansi2" id="instansi2" class="form-control"
                                        required />
                                    <select data-plugin-selectTwo class="form-control" name="id_instansi" id="instansi"
                                        required>
                                        <?php foreach ($instansi as $kat): ?>
                                            <option value="<?= $kat->id; ?>">
                                                <?= $kat->nomor; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-lg nomor">
                                <label class="col-sm-3 control-label">Nomor PKP<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="nomor2" id="no_pkp2" class="form-control"
                                        onkeypress="return hanyaAngka(event)" required />
                                    <input type="hidden" name="kode" id="kode" class="form-control" required />
                                    <input type="text" name="nomor" id="no_pkp" class="form-control"
                                        onkeypress="return hanyaAngka(event)" disabled />
                                </div>
                            </div>
                            <div class="form-group mt-lg proyek">
                                <label class="col-sm-3 control-label">Nama PKP<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <textarea rows="4" class="form-control" id="proyek" name="proyek"
                                        required></textarea>
                                </div>
                            </div>
                            <div class="form-group mt-lg alias">
                                <label class="col-sm-3 control-label">Nama Singkatan<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="alias" id="alias" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group tgl_demob">
                                <label class="col-sm-3 control-label">Tanggal Progress<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_ubah_progress" id="tgl_ubah_progress"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask />
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <img id="foto22" style="width:100px">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-lg dtu_nama">
                                <label class="col-sm-3 control-label">Target Warning</label>
                                <div class="col-sm-9">
                                    <input type="text" name="warning" id="warning" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group mt-lg dtu_nama">
                                <label class="col-sm-3 control-label">Target Telat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="late" id="late" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group tgl_demob">
                                <label class="col-sm-3 control-label">Tanggal SPK Mulai<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="spk_mulai" id="spk_mulai" class="form-control tanggal"
                                        data-plugin-datepicker data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                                </div>
                            </div>

                            <div class="form-group tgl_demob">
                                <label class="col-sm-3 control-label">Tanggal SPK Selesai<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="spk_akhir" id="spk_akhir" class="form-control tanggal"
                                        data-plugin-datepicker data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                                </div>
                            </div>
                            <div class="form-group tgl_demob">
                                <label class="col-sm-3 control-label">Tanggal Awal DCR<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_dcr" id="tgl_dcr" class="form-control tanggal"
                                        data-plugin-datepicker data-inputmask-alias="datetime"
                                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                                </div>
                            </div>
                            <div class="form-group mt-lg dtu_nama">
                                <label class="col-sm-3 control-label">Status Proyek</label>
                                <div class="col-sm-9">
                                    <input type="text" name="status_akhir" id="status_akhir" class="form-control" />
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                id="submitformEdit">Submit</button>
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
                            <?= form_open('setting/pkphapus', ' id="FormulirHapus"'); ?>
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
            url: '<?= base_url() ?>setting/pkpdetail',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, item) {
                    document.getElementById("kode").setAttribute('value', item.kode);
                    document.getElementById("no_pkp").setAttribute('value', item.no_pkp);
                    document.getElementById("no_pkp2").setAttribute('value', item.no_pkp2);
                    document.getElementById("instansi2").setAttribute('value', item.id_instansi2);
                    document.getElementById("proyek").value = item.proyek;
                    document.getElementById("alias").setAttribute('value', item.alias);
                    document.getElementById("warning").setAttribute('value', item.warning);
                    document.getElementById("late").setAttribute('value', item.late);
                    document.getElementById("tgl_dcr").value = item.tgl_dcr;
                    document.getElementById("tgl_ubah_progress").value = item.tgl_progress;
                    document.getElementById("spk_mulai").value = item.spk_mulai;
                    document.getElementById("spk_akhir").value = item.spk_akhir;
                    document.getElementById("status_akhir").value = item.status_akhir;
                    //document.getElementById("dtu_periode").value = item.dtu_periode;
                    //document.getElementById("foto22").src = item.dtu_foto22;
                    //document.getElementById("foto22").src = "/asysg3/assets/images/dtu/PKP2103-00112.jpg";
                    //document.getElementById("foto").src.indexOf(baseurl + "assets/images/dtu/PKP2103-00112.jpg") >= 0;
                    $("#instansi").select2("val", item.id_instansi);
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
</body>

</html>
<?= $this->endSection() ?>