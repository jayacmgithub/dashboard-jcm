<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">Data PKP</h2>
            </div>
            <?= level_user('setting', 'instansi', $kategoriQNS, 'add') > 0 ? '<div class="col-md-6" align="right"><a style="font-size:12px" class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData">Tambah</a></div>' : '';
            ?>
        </div>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped" id="example">
            <thead>
                <tr>
                    <th></th>
                    <th>Nomor</th>
                    <th>Nama Instansi</th>
                    <th>Nama Kadirat</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($instansi as $ins) {
                    $kunci = esc($ins->kunci);
                    $status = $ins->aktif == '1' ? "<span class='btn btn-xs btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";

                    if ($kunci > 0) {
                        $tombolhapus = '';
                    } else {
                        $tombolhapus = level_user('setting', 'instansi', $kategoriQNS, 'delete') > 0 ? '<li><a style="font-size:12px" href="#" onclick="hapus(this)" data-id="' . esc($ins->id) . '">Hapus</a></li>' : '';
                    }
                    $status = $ins->status == 'AKTIF' ? "<span class='btn   btn-xs  btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";
                    $tomboledit = level_user('setting', 'instansi', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="#" onclick="edit(this)" data-id="' . esc($ins->id) . '">Edit</a></li>' : '';
                    ?>
                    <tr>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-expanded="true"><i
                                        class="fa fa-chevron-down"></i></button>
                                <ul class="dropdown-menu" role="menu">
                                    <?= $tomboledit ?>
                                    <?= $tombolhapus ?>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <?= $ins->nomor ?>
                        </td>
                        <td>
                            <?= $ins->nama ?>
                        </td>
                        <td>
                            <?= $ins->nama_kadirat ?>
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
                <?= form_open(base_url('setting/instansitambah'), ' id="FormulirTambah"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Instansi</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg nomor">
                        <label class="col-sm-3 control-label">Nomor Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id" value="<?= session('idadmin'); ?>" class="form-control"
                                required />
                            <input type="text" name="nomor" class="form-control" onkeypress="return hanyaAngka(event)"
                                required />
                        </div>
                    </div>
                    <div class="form-group mt-lg nama">
                        <label class="col-sm-3 control-label">Nama Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nama" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group mt-lg kadirat">
                        <label class="col-sm-3 control-label">Nama Kadirat</label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="kadirat">
                                <option value="">Pilih Kadirat</option>
                                <?php foreach ($kadirat as $kat): ?>
                                    <option value="<?= $kat->id; ?>">
                                        <?= $kat->nama_admin; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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

<div class="modal fade" id="editData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel  panel-primary">
                <?= form_open(base_url('setting/instansiedit'), ' id="FormulirEdit"'); ?>
                <input type="hidden" name="idd" id="idd">
                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data Instansi</h2>
                </header>
                <div class="panel-body">
                    <div class="form-group mt-lg nomor">
                        <label class="col-sm-3 control-label">Nomor Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="nomor_lama" id="nomor2" class="form-control" required />
                            <input type="text" name="nomor" id="nomor" class="form-control"
                                onkeypress="return hanyaAngka(event)" required />
                        </div>
                    </div>
                    <div class="form-group mt-lg nama">
                        <label class="col-sm-3 control-label">Nama Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="nama_lama" id="nama2" class="form-control" required />
                            <input type="text" name="nama" id="nama" class="form-control" required />
                        </div>
                    </div>

                    <div class="form-group mt-lg kadirat">
                        <label class="col-sm-3 control-label">Nama Kadirat</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="kadirat2" id="kadirat2" class="form-control" />
                            <select data-plugin-selectTwo class="form-control" name="kadirat" id="kadirat">
                                <?php foreach ($kadirat as $kat): ?>
                                    <option value="<?= $kat->id; ?>">
                                        <?= $kat->nama_admin; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
                            <?= form_open(base_url('setting/instansihapus'), ' id="FormulirHapus"'); ?>
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


<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>

<script type="text/javascript">
    var tabeldokter = $('#instansidata').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>setting/datainstansi",
            "type": "GET"
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        },],
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
                tabeldokter.ajax.reload();
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

    function edit(elem) {
        var dataId = $(elem).data("id");
        document.getElementById("idd").setAttribute('value', dataId);
        $('#editData').modal();
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>setting/instansidetail',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, item) {
                    document.getElementById("nomor").setAttribute('value', item.nomor);
                    document.getElementById("nomor2").setAttribute('value', item.nomor);
                    document.getElementById("nama").setAttribute('value', item.nama);
                    document.getElementById("nama2").setAttribute('value', item.nama);
                    $("#kadirat").select2("val", item.kadirat);
                    document.getElementById("kadirat2").setAttribute('value', item.kadirat);
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
                tabeldokter.ajax.reload();
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
                tabeldokter.ajax.reload();
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
