<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">Data User</h2>
            </div>
            <?= level_user('setting', 'user', $kategoriQNS, 'add') > 0 ? '<div class="col-md-6" align="right"><a style="font-size:12px" class="btn btn-success" href="#"  data-toggle="modal" data-target="#tambahData"> Tambah</a></div>' : '';
            ?>
        </div>
    </header>
    <div class="card">
        <div class="card-body">
            <div class="panel-body">
                <table class="table table-bordered table-hover table-striped" id="datausers">
                    <thead>
                        <tr>
                            <th></th>
                            <th>PKP</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Kategori</th>
                            <th>Gender</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
</section>



<div class="modal fade bd-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('setting/tambahuser'), ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah User</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  kategori">
                                <label class="col-sm-3 control-label">Pilih Jabatan<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="kategori" required>
                                        <option value=""></option>
                                        <?php foreach ($kategoris as $kat): ?>
                                            <option value="<?= $kat->id; ?>">
                                                <?= $kat->kategori_user; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  kategori">
                                <label class="col-sm-3 control-label">Pilih Golongan</label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="golongan">
                                        <option value=""></option>
                                        <?php foreach ($golongan as $gol): ?>
                                            <option value="<?= $gol->id; ?>">
                                                <?= $gol->kode2 . ':' . rupiah($gol->nilai); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  pkp">
                                <label class="col-sm-3 control-label">Pilih PKP</label>
                                <div class="col-sm-9">
                                    <select data-plugin-selectTwo class="form-control" name="pkp">
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
                                <label class="col-sm-3 control-label">Nomor NRP<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="no_nrp" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Tanggal Mutasi<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_mutasi" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask />
                                </div>
                            </div>
                            <div class="form-group  nama_admin">
                                <label class="col-sm-3 control-label">Nama User<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_admin" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group jenis_kelamin">
                                <label class="col-sm-3 control-label">Jenis Kelamin<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <div class="radio-custom radio-primary">
                                        <input id="laki-laki" name="jenis_kelamin" checked type="radio"
                                            value="laki-laki" required>
                                        <label for="laki-laki">Laki-laki</label>
                                    </div>
                                    <div class="radio-custom radio-primary">
                                        <input id="perempuan" name="jenis_kelamin" type="radio" value="perempuan">
                                        <label for="perempuan">Perempuan</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group alamat">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group telepon">
                                <label class="col-sm-3 control-label">Telepon</label>
                                <div class="col-sm-9">
                                    <input type="text" name="telepon" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group handphone">
                                <label class="col-sm-3 control-label">Handphone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="handphone" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group email">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group aktif">
                                <label class="col-sm-3 control-label">Status aktif<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <div class="radio-custom radio-primary">
                                        <input id="aktif" name="aktif" type="radio" checked value="1" required>
                                        <label for="aktif">Aktif</label>
                                    </div>
                                    <div class="radio-custom radio-primary">
                                        <input id="block" name="aktif" type="radio" value="0">
                                        <label for="block">Blokir</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group  password">
                                <label class="col-sm-3 control-label">Password<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" name="password" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group  password2">
                                <label class="col-sm-3 control-label">Retype Password<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="password" name="password2" class="form-control" />
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

<div class="modal fade" id="detailData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Detail User</h2>
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
    var tableitems = $('#datausers').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>laporan/datausers",
            "type": "POST"
        },


    });

    function detail(elem) {
        var dataId = $(elem).data("id");
        $('#detailData').modal();
        $('#showdetail').html('Loading...');
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url() ?>setting/userdetail',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                var datarow = '';
                $.each(response, function (i, item) {
                    datarow += '<table class="table table-bordered table-hover table-striped dataTable no-footer">';
                    datarow += "<tr><td>Kategori</td><td>: " + item.kategori + "</td></tr>";
                    datarow += "<tr><td>Username</td><td>: " + item.username + "</td></tr>";
                    datarow += "<tr><td>Nama admin</td><td>: " + item.nama_admin + "</td></tr>";
                    datarow += "<tr><td>Jabatan</td><td>: " + item.jabatan + "</td></tr>";
                    datarow += "<tr><td>Jurusan</td><td>: " + item.jurusan + "</td></tr>";
                    datarow += "<tr><td>Jenis Kelamin</td><td>: " + item.jenis_kelamin + "</td></tr>";
                    datarow += "<tr><td>Alamat</td><td>: " + item.alamat + "</td></tr>";
                    datarow += "<tr><td>Telepon</td><td>: " + item.telepon + "</td></tr>";
                    datarow += "<tr><td>Handphone</td><td>: " + item.handphone + "</td></tr>";
                    datarow += "<tr><td>email</td><td>: " + item.email + "</td></tr>";
                    datarow += "<tr><td>Status</td><td>: " + item.aktif + "</td></tr>";
                    datarow += "<tr><td>STS Karyawan</td><td>: " + item.status + "</td></tr>";
                    datarow += "</table>";
                });
                $('#showdetail').html(datarow);
            }
        });
        return false;
    }
</script>
<script>
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
</body>

</html>
<?= $this->endSection() ?>