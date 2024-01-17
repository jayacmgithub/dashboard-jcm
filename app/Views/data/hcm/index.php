<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">DATA KARYAWAN</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>laporan/absensi">ABSENSI</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info6" role="tabpanel" aria-labelledby="info6-tab">
            <!-- start: page -->
            <?php
            if (level_user('data', 'hcm', $kategoriQNS, 'add') > 0) {
                ?>
                <div class="d-flex flex-row pull-right">
                    <div class="m-l-10 align-self-center">
                        <div class="userbox">
                            <a style="font-size:12px;color:white" class="btn btn-success"
                                href="<?= base_url() ?>laporan/import_pembaharuan">PEMBAHARUAN DATA</a>
                        </div>
                        <div id="userbox" class="userbox">
                            <a class="btn btn-warning" data-toggle="dropdown" style="font-size: 12px;color:black">MUTASI
                                KARYAWAN</a>
                            <div class="dropdown-menu">
                                <ul class="list-unstyled">
                                    <li class="divider"></li>
                                    <li>
                                        <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                                            data-target="#tambahData2"> By Form</a>
                                    </li>
                                    <li>
                                        <a style="font-size:12px;color:white" class="btn btn-success"
                                            href="<?= base_url() ?>laporan/import_kry_baru"> By Import</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="userbox" class="userbox">
                            <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">TAMBAH
                                KARYAWAN BARU</a>
                            <div class="dropdown-menu">
                                <ul class="list-unstyled">
                                    <li class="divider"></li>
                                    <li>
                                        <a style="font-size:12px;color:white" class="btn btn-success" data-toggle="modal"
                                            data-target="#tambahData"> By Form</a>
                                    </li>
                                    <li>
                                        <a style="font-size:12px;color:white" class="btn btn-success"
                                            href="<?= base_url() ?>laporan/import_kry_baru"> By Import</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <div class="panel-body" style="margin-top:0.5%">
            <table class="table table-borderless table-hover table-striped" id="example">
                <thead>
                    <tr>
                        <th></th>
                        <th>PKP Akhir</th>
                        <th>Nama User</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Kategori</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($hcm as $c) {
                        $status = $c->aktif == '1' ? "<span class='btn btn-xs btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";

                        $aktif = esc($c->aktif);
                        if ($aktif > 0) {
                            $tombolhapus = '';
                        } else {
                            $tombolhapus = level_user('setting', 'user', $kategoriQNS, 'delete') > 0 ? '<li><a style="font-size:12px" href="#" onclick="hapus(this)" data-id="' . $c->id . '">Hapus</a></li>' : '';
                        }

                        $tomboledit = level_user('setting', 'user', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="edituser/' . $c->id . '" onclick="edit(this)" data-id="' . $c->id . '">Edit</a></li>' : '';
                        ?>
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <?= $tomboledit ?>
                                        <?= $tombolhapus ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?= $c->nomor . '/' . $c->no_pkp . '<br>' . $c->alias ?>
                            </td>
                            <td>
                                <?= $c->nama_admin ?>
                            </td>
                            <td>
                                <?= $c->username ?>
                            </td>
                            <td>
                                <?= $c->email ?>
                            </td>
                            <td>
                                <?= $c->kategori_user ?>
                            </td>
                            <td>
                                <?= $c->jenis_kelamin ?>
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

<div class="modal fade" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('laporan/tambahkaryawan', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah Karyawan Baru</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  nama_admin">
                                <label class="col-sm-3 control-label">Nama User<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="nama_admin" class="form-control" required>
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
                                <label class="col-sm-3 control-label">Tanggal Lahir<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_lahir" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask required />
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
                            <div class="form-group alamat">
                                <label class="col-sm-3 control-label">Alamat</label>
                                <div class="col-sm-9">
                                    <input type="text" name="alamat" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group handphone">
                                <label class="col-sm-3 control-label">Handphone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="handphone" class="form-control" />
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">

                            <div class="form-group email">
                                <label class="col-sm-3 control-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group email">
                                <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="jabatan" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group email">
                                <label class="col-sm-3 control-label">Jurusan<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="jurusan" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Tanggal Masuk<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_masuk" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask required />
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Kontrak Awal</label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_awal_kontrak" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask />
                                </div>
                            </div>
                            <div class="form-group tgl_mutasi">
                                <label class="col-sm-3 control-label">Habis kontrak</label>
                                <div class="col-sm-9">
                                    <!-- INPUT MASK WITH DATEPICKER -->
                                    <input type="text" name="tgl_kontrak" id="tanggal" autocomplete="off"
                                        class="form-control tanggal" data-plugin-datepicker
                                        data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy"
                                        data-mask />
                                </div>
                            </div>
                            <div class="form-group email">
                                <label class="col-sm-3 control-label">Status Kontrak<span
                                        class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="text" name="status_kontrak" class="form-control" required />
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
                                        <option value="no_memo">Mutasi Belum Ada SK/Memo Mutasi</option>
                                        <option value="memo">Mutasi Sudah Ada SK/Memo Mutasi</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  no_nrp">
                                <label class="col-sm-3 control-label">Nomor SK/Memo Mutasi</label>
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

<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }
</script>

<script type="text/javascript">
    /*no error*/
    var tableimport = $('#importdata2').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>laporan/dataimport2",
            "type": "GET"
        },
        "columnDefs": [{
            "targets": [0, 1, 2, 3, 4],
            "orderable": false,
        },],

    });

    document.getElementById("FormulirUpload").addEventListener("submit", function (e) {
        blurForm();
        PNotify.removeAll();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformupload").setAttribute('disabled', 'disabled');
        $('#submitformupload').html('Loading ...');
        var form = $('#FormulirUpload')[0];
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
                document.getElementById("submitformupload").removeAttribute('disabled');
                $('#submitformupload').html('Submit');
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

                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 2000);
            }
        }).fail(function (data) {
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                type: 'danger'
            });
            window.setTimeout(function () {
                location.reload();
            }, 500);
        });
        e.preventDefault();
    });
</script>
</body>

</html>
<?= $this->endSection() ?>