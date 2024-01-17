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
                <table class="table table-bordered table-hover table-striped" id="example">
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
                        <?php
                        foreach ($user as $user) {
                            $status = $user->aktif == '1' ? "<span class='btn   btn-xs  btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";
                            $tombolhapus = level_user('setting', 'user', $kategoriQNS, 'delete') > 0 ? '<li><a style="font-size:12px" href="#" onclick="hapus(this)" data-id="' . $user->id . '">Hapus</a></li>' : '';
                            $status = $user->aktif == '1' ? "<span class='btn btn-xs btn-success'>Aktif</span>" : "<span class='btn  btn-xs btn-danger'>Blokir</span>";
                            //$kunci = esc($user->jml_pkp);
                            $aktif = esc($user->aktif);
                            $tomboledit = level_user('setting', 'user', $kategoriQNS, 'edit') > 0 ? '<li><a style="font-size:12px" href="edituser/' . $user->id . '" onclick="edit(this)" data-id="' . $user->id . '">Edit</a></li>' : '';
                            ?>
                            <tr>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Aksi
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <?= $tomboledit ?>
                                            <?= $tombolhapus ?>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <?= $user->nomor ?> /
                                    <?= $user->no_pkp ?>
                                </td>
                                <td>
                                    <?= $user->nama_admin ?>
                                </td>
                                <td>
                                    <?= $user->username ?>
                                </td>
                                <td>
                                    <?= $user->email ?>
                                </td>
                                <td>
                                    <?= $user->kategori_user ?>
                                </td>
                                <td>
                                    <?= $user->jenis_kelamin ?>
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



<div class="modal fade bd-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open('setting/tambahuser', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
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
</body>

</html>
<?= $this->endSection() ?>