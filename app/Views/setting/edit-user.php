<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">Edit User</h2>
            </div>
            <?php
            echo level_user('setting', 'user', $kategoriQNS, 'add') > 0 ? '<div class="col-md-6" align="right"><a style="font-size:12px" class="btn btn-success" href="#" data-toggle="modal" data-target="#tambahData"><i class="fa fa-back"></i> Tambah PKP</a>' : '';
            ?> &nbsp;
            <?php
            echo level_user('setting', 'user', $kategoriQNS, 'add') > 0 ? '<a style="font-size:12px" class="btn btn-success" href="javascript:window.history.go(-1);"><i class="fa fa-back"></i> Kembali</a></div>' : '';
            ?>
        </div>
    </header>
</section>
<div class="panel-body">

    <?= form_open(base_url('setting/useredit'), 'enctype="multipart/form-data"'); ?>

    <div class="col-md-6">

        <div class="form-group alamat">
            <label class="col-sm-3 control-label">Username</label>
            <div class="col-sm-3">
                <input type="text" name="username" value="<?= esc($user2->getRow()->username); ?>" class="form-control"
                    disabled readonly />
            </div>
            <?php

            $pkp_akhir = esc($user4->getNumRows());
            if ($pkp_akhir > 0) { ?>
                <div class="col-sm-6">
                    <input type="text" name="username"
                        value="<?= esc($user4->getRow()->nomor) . '/' . esc($user4->getRow()->no_pkp) . ' :' . esc($user4->getRow()->alias) ?>"
                        class="form-control" disabled readonly />
                </div>
            <?php } ?>
        </div>

        <div class="form-group kategori">
            <label class="col-sm-3 control-label">Hak Akses<span class="required">*</span></label>
            <div class="col-sm-3">
                <input type="text" value="<?= esc($kategori2->getRow()->kategori_user) ?>" class="form-control" disabled
                    readonly />
            </div>
            <div class="col-sm-6">
                <input type="text" name="username"
                    value="<?= esc($user5->getRow()->no_pkp) . ' :' . esc($user5->getRow()->alias) ?>"
                    class="form-control" disabled readonly />
            </div>
        </div>

        <div class="form-group golongan">
            <label class="col-sm-3 control-label">Pilih PKP AKHIR</label>
            <div class="col-sm-9">

                <select data-plugin-selectTwo class="form-control" name="pkp_akhir" required>

                    <option value="<?= esc($user5->getRow()->id_pkp); ?>">
                        <?= esc($user5->getRow()->no_pkp) . ' :' . esc($user5->getRow()->alias); ?>
                    </option>

                    <?php foreach ($pkp as $supp): ?>
                        <option value="<?= $supp->id_pkp; ?>">
                            <?= $supp->no_pkp . ': ' . $supp->alias; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <div class="form-group nama_admin">
            <label class="col-sm-3 control-label">Nama Admin<span class="required">*</span></label>
            <div class="col-sm-9">
                <input type="hidden" name="idd" value="<?= esc($user2->getRow()->id); ?>">
                <input type="hidden" name="passlama" value="<?= esc($user2->getRow()->password); ?>"
                    class="form-control" />
                <input type="hidden" name="kategori2" value="<?= esc($user2->getRow()->kategori); ?>"
                    class="form-control" />
                <input type="hidden" name="username" value="<?= esc($user2->getRow()->username); ?>"
                    class="form-control" />
                <input type="text" name="nama_admin" value="<?= esc($user2->getRow()->nama_admin); ?>"
                    class="form-control" />
            </div>
        </div>

        <?php
        $jenis_kelamin = esc($user2->getRow()->jenis_kelamin);
        $aktif = esc($user2->getRow()->aktif);
        ?>
        <div class="form-group jenis_kelamin">
            <label class="col-sm-3 control-label">Jenis Kelamin<span class="required">*</span></label>
            <div class="col-sm-9">
                <div class="radio-custom radio-primary">
                    <?php
                    if ($jenis_kelamin == 'laki-laki') {
                        ?>
                        <input checked name="jenis_kelamin" type="radio" value="laki-laki">
                    <?php } else {
                        ?>
                        <input name="jenis_kelamin" type="radio" value="laki-laki">
                    <?php } ?>
                    <label for="editlaki-laki">Laki-laki</label>
                </div>
                <div class="radio-custom radio-primary">
                    <?php
                    if ($jenis_kelamin == 'perempuan') {
                        ?>
                        <input checked name="jenis_kelamin" type="radio" value="perempuan">
                    <?php } else {
                        ?>
                        <input name="jenis_kelamin" type="radio" value="perempuan">
                    <?php } ?>
                    <label for="editperempuan">Perempuan</label>
                </div>
            </div>
        </div>
        <div class="form-group alamat">
            <label class="col-sm-3 control-label">Alamat</label>
            <div class="col-sm-9">
                <input type="text" name="alamat" value="<?= esc($user2->getRow()->alamat); ?>" class="form-control" />
            </div>
        </div>
    </div>
    <div class="col-md-6">


        <div class="form-group handphone">
            <label class="col-sm-3 control-label">Handphone<span class="required">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="handphone" value="<?= esc($user2->getRow()->handphone); ?>"
                    class="form-control" />
            </div>
        </div>
        <div class="form-group email">
            <label class="col-sm-3 control-label">Email<span class="required">*</span></label>
            <div class="col-sm-9">
                <input type="text" name="email" value="<?= esc($user2->getRow()->email); ?>" class="form-control" />
            </div>
        </div>
        <div class="form-group aktif">
            <label class="col-sm-3 control-label">Status aktif<span class="required">*</span></label>
            <div class="col-sm-9">
                <div class="radio-custom radio-primary">
                    <?php
                    if ($aktif == '1') {
                        ?>
                        <input checked name="aktif" type="radio" value="1">
                    <?php } else {
                        ?>
                        <input name="aktif" type="radio" value="1">
                    <?php } ?>
                    <label for="editaktif">Aktif</label>
                </div>
                <div class="radio-custom radio-primary">
                    <?php
                    if ($aktif == '0') {
                        ?>
                        <input checked name="aktif" type="radio" value="0">
                    <?php } else {
                        ?>
                        <input name="aktif" type="radio" value="0">
                    <?php } ?>
                    <label for="editblock">Blokir</label>
                </div>
            </div>
        </div>
        <div class="form-group password">
            <label class="col-sm-3 control-label">Password<span class="required">*</span></label>
            <div class="col-sm-9">
                <input type="password" name="password" class="form-control" />
            </div>
        </div>
        <div class="form-group password2">
            <label class="col-sm-3 control-label">Retype Password<span class="required">*</span></label>
            <div class="col-sm-9">
                <input type="password" name="password2" class="form-control" />
            </div>
        </div>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <br>
                <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                    id="submitformEdit">Submit</button>

            </div>
        </div>
    </footer>
    </form>
</div>
<div class="row" style="overflow-x: auto;white-space: nowrap;">
    <div class="col-md-12">

        <div class="table-responsive" style="max-width:100%;">
            <table class="table table-bordered table-hover table-striped dataTable no-footer">
                <thead>
                    <tr>
                        <th style="width:5%;">Aksi</th>
                        <th style="width:10%;">Instansi</th>
                        <th style="width:10%;">PKP</th>
                        <th style="width:10%;">Mutasi</th>
                        <th style="width:25%;">Alias</th>
                        <th style="width:25%;">Jabatan</th>
                        <th style="width:10%;">Status</th>

                    </tr>
                </thead>
                <?php foreach ($pkpuser as $pkpu) { ?>
                    <tbody>
                        <?php
                        $status = $pkpu->status == 'AKTIF' ? "<span class='btn   btn-xs  btn-success'>Aktif</span>" : "<span class='btn btn-xs btn-danger'>NonAktif</span>";
                        ?>
                        <?php if (level_user('setting', 'user', $kategoriQNS, 'all') > 0) { ?>
                            <td><a style="font-size:12px" class="btn btn-success" href="#" onclick="edit(this)"
                                    data-id="<?= $pkpu->id ?>">Edit</a></td>
                        <?php } else { ?>
                            <td></td>
                        <?php } ?>
                        <td>
                            <?= $pkpu->nomor; ?>
                        </td>
                        <td>
                            <?= $pkpu->no_pkp; ?>
                        </td>
                        <td>
                            <?= $pkpu->tgl_mutasi; ?>
                        </td>
                        <td>
                            <?= $pkpu->alias; ?>
                        </td>
                        <td>
                            <?= $pkpu->kategori_user; ?>
                        </td>
                        <td>
                            <?= $status; ?>
                        </td>

                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>

</div>

</section>
</div>


<div class="modal fade bd-example-modal-lg" id="tambahDataJabatan" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('setting/tambahuserjabatan'), ' id="FormulirTambahJabatan" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah User Jabatan</h2>
                </header>

                <div class="panel-body">

                    <div class="form-group  nomor_pkp">
                        <label class="col-sm-3 control-label">Pilih Jabatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="idd" value="<?= esc($user2->getRow()->id); ?>">
                            <select data-plugin-selectTwo class="form-control" name="id_jabatan" autofocus>
                                <option value=""></option>
                                <?php foreach ($kategoris as $supp): ?>
                                    <option value="<?= $supp->id; ?>">
                                        <?= $supp->kategori_user; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group jenis_kelamin">
                        <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <?php
                            $jabatan1 = esc($user4->getNumRows());
                            if ($jabatan1 < 1) { ?>
                                <div class="radio-custom radio-primary">
                                    <input checked name="tertinggi" type="radio" value=1>
                                    <label>Jabatan Utama</label>
                                </div>
                                <div class="radio-custom radio-primary">
                                    <input name="tertinggi" type="radio" value=0>
                                    <label>Bukan Jabatan Utama</label>
                                </div>
                            <?php } else { ?>
                                <div class="radio-custom radio-primary">
                                    <input name="tertinggi" type="radio" value=1>
                                    <label>Jabatan Utama</label>
                                </div>
                                <div class="radio-custom radio-primary">
                                    <input checked name="tertinggi" type="radio" value=0>
                                    <label>Bukan Jabatan Utama</label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                id="submitformjabatan">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('setting/tambahuserpkp'), 'enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah User PKP</h2>
                </header>

                <div class="panel-body">

                    <div class="form-group  nomor_pkp">
                        <label class="col-sm-3 control-label">Pilih pkp<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="id_pkp" id="nomorPKPDropdown"
                                placeholder="Silahkan pilih Proyek" autofocus required>
                                <option value=""></option>
                                <?php foreach ($pkp as $supp): ?>
                                    <option value="<?= $supp->id_pkp; ?>">
                                        <?= $supp->no_pkp . ': ' . $supp->alias; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group nama_kontrak">
                        <label class="col-sm-3 control-label">Nama Kontrak<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea rows="3" class="form-control" id="proyek" disabled></textarea>
                        </div>
                    </div>
                    <div class="form-group no_pkp">
                        <label class="col-sm-3 control-label">Nomor PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="idd" value="<?= ($user2->getRow()->id); ?>">
                            <input type="text" class="form-control" id="no_pkp" disabled>
                        </div>
                    </div>
                    <div class="form-group mt-lg kategori">
                        <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="idjabatan_pkp"
                                placeholder="Silahkan Pilih Jabatan" required>
                                <option value=""></option>
                                <?php foreach ($jabatan as $kat): ?>
                                    <option value="<?= $kat->id; ?>">
                                        <?= $kat->kategori_user; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group tgl_mutasi">
                        <label class="col-sm-3 control-label">Tanggal Mutasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <!-- INPUT MASK WITH DATEPICKER -->
                            <input type="text" name="tgl_mutasi" id="tanggal" class="form-control tanggal"
                                data-plugin-datepicker data-inputmask-alias="datetime"
                                data-inputmask-inputformat="dd-mm-yyyy" data-mask />
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
            <section class="panel panel-primary">
                <?= form_open(base_url('setting/edituserpkp'), 'enctype="multipart/form-data"'); ?>
                <input type="hidden" name="idd" id="idd">

                <input type="hidden" name="id_pkp" id="id_pkp2">
                <input type="hidden" name="id_user" id="id_user2">

                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data User PKP</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group instansi">
                        <label class="col-sm-3 control-label">Nomor Instansi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="nomor" class="form-control" id="nomor2" disabled readonly required>
                        </div>
                    </div>
                    <div class="form-group pkp">
                        <label class="col-sm-3 control-label">Nomor PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="no_pkp" class="form-control" id="no_pkp2" readonly required>
                        </div>
                    </div>
                    <div class="form-group alias">
                        <label class="col-sm-3 control-label">Alias<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="alias" class="form-control" id="alias2" readonly required>
                        </div>
                    </div>
                    <div class="form-group nama_kontrak">
                        <label class="col-sm-3 control-label">Nama Kontrak<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea rows="3" class="form-control" id="proyek2" disabled readonly required></textarea>
                        </div>
                    </div>
                    <div class="form-group mt-lg kategori">
                        <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="id_jabatan" id="id_jabatan2"
                                required>
                                <?php foreach ($jabatan as $kat): ?>
                                    <option value="<?= $kat->id; ?>">
                                        <?= $kat->kategori_user; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group tgl_demob">
                        <label class="col-sm-3 control-label">Tanggal Mutasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <!-- INPUT MASK WITH DATEPICKER -->
                            <input type="text" name="tgl_mutasi" id="tgl_mutasi2" class="form-control tanggal"
                                data-plugin-datepicker data-inputmask-alias="datetime"
                                data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                        </div>
                    </div>
                    <div class="form-group aktif">
                        <label class="col-sm-3 control-label">Status aktif<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="radio-custom radio-primary">
                                <input id="editaktif2" name="aktif" type="radio" checked value="AKTIF" required>
                                <label for="editaktif">Aktif</label>
                            </div>
                            <div class="radio-custom radio-primary">
                                <input id="editblokir2" name="aktif" type="radio" value="NON">
                                <label for="editblokir2">Blokir</label>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                id="submitformEditPKP">Simpan</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Kembali</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade" id="editData2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('setting/edituserjabatan'), ' id="FormulirEditJabatan"  enctype="multipart/form-data"'); ?>

                <input type="hidden" name="idd" id="idd2">
                <input type="hidden" name="id_user" id="id_user2a">
                <input type="hidden" name="utama2a" id="utama2a">
                <input type="hidden" name="id_jabatan" id="id_jabatan">

                <header class="panel-heading">
                    <h2 class="panel-title">Edit Data User Jabatan</h2>
                </header>
                <div class="panel-body">

                    <div class="form-group instansi">
                        <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="jabatan" disabled readonly required>
                        </div>
                    </div>
                    <div class="form-group aktif">
                        <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="radio-custom radio-primary">

                                <input id="utama22" name="utama" type="radio" checked value=1 required>
                                <label for="utama22">Jabatan Utama</liabel>
                            </div>
                            <div class="radio-custom radio-primary">
                                <input id="bukan22" name="utama" type="radio" value=0>
                                <label for="bukan22">Bukan Utama</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group aktif">
                        <label class="col-sm-3 control-label">Status aktif<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <div class="radio-custom radio-primary">
                                <input id="aktif22" name="aktif" type="radio" checked value="AKTIF" required>
                                <label for="aktif22">Aktif</liabel>
                            </div>
                            <div class="radio-custom radio-primary">
                                <input id="blokir22" name="aktif" type="radio" value="NON">
                                <label for="blokir22">Non Aktif</label>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                                id="submitformEditJabatan">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    var tableuser = $('#pkpuserdata').DataTable({
        "ajax": {
            url: "<?= base_url() ?>setting/pkpuserdata",
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

    $(document).ready(function () {
        const apiURL = '<?= base_url() ?>setting/pkpdetail2/';

        $('#nomorPKPDropdown').change(function () {
            var dataId = $(this).find(":selected").val();

            $.ajax({
                type: 'GET',
                url: apiURL + dataId,
                dataType: 'json',
                success: function (response) {
                    console.log('Response:', response);

                    if (Array.isArray(response)) {
                        if (response.length > 0) {
                            var data = response[0];
                            $('#proyek').val(data.proyek);
                            $('#no_pkp').val(data.no_pkp);
                        } else {
                            console.error('Empty response array. Check server-side code.');
                        }
                    } else if (typeof response === 'object') {
                        // Handle the case where the response is an object
                        $('#proyek').val(response.proyek);
                        $('#no_pkp').val(response.no_pkp);
                    } else {
                        console.error('Invalid response format. Check server-side code.');
                    }
                },
                error: function (err) {
                    // Handle errors (optional, depending on your needs)
                    console.error('Error:', err.responseText);
                }
            });
            return false;
        });
    });
    document.getElementById("FormulirTambahJabatan").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformjabatan").setAttribute('disabled', 'disabled');
        $('#submitformjabatan').html('Loading ...');
        var form = $('#FormulirTambahJabatan')[0];
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
                document.getElementById("submitformjabatan").removeAttribute('disabled');
                $('#submitformjabatan').html('Submit');
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
                document.getElementById("submitformjabatan").removeAttribute('disabled');
                $('#tambahDataJabatan').modal('hide');
                document.getElementById("FormulirTambahJabatan").reset();
                $('#submitformjabatan').html('Submit');
                document.getElementById("FormulirEdit").reset();
                $('#submitformEdit').html('Submit');
                //APRI untuk refresh
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
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
                document.getElementById("FormulirEdit").reset();
                $('#submitformEdit').html('Submit');
                //APRI untuk refresh
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
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
            url: '<?= base_url() ?>setting/userdetail2',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, item) {
                    document.getElementById("id_pkp2").value = item.id_pkp2;
                    document.getElementById("id_user2").value = item.id_user2;
                    document.getElementById("nomor2").value = item.nomor2;
                    document.getElementById("no_pkp2").value = item.no_pkp2;
                    document.getElementById("alias2").value = item.alias2;
                    document.getElementById("proyek2").value = item.proyek2;
                    document.getElementById("tgl_mutasi2").value = item.tgl_mutasi2;
                    if (item.status2 == 'AKTIF') {
                        document.getElementById("editaktif2").checked = true;
                    } else {
                        document.getElementById("editblokir2").checked = true;
                    }
                    $("#id_jabatan2").select2("val", item.id_jabatan2);
                });
            }
        });
        return false;
    }

    function edit2(elem) {
        var dataId2 = $(elem).data("id");
        document.getElementById("idd2").setAttribute('value', dataId2);
        $('#editData2').modal();
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>setting/userdetail1',
            data: 'id=' + dataId2,
            dataType: 'json',
            success: function (response) {
                $.each(response, function (i, item) {
                    document.getElementById("id_user2a").value = item.id_user2;
                    document.getElementById("utama2a").value = item.utama2a;
                    document.getElementById("jabatan").value = item.jabatan;
                    document.getElementById("id_jabatan").value = item.id_jabatan;
                    if (item.utama == 1) {
                        document.getElementById("utama22").checked = true;
                    } else {
                        document.getElementById("bukan22").checked = true;
                    }
                    if (item.aktif == 'AKTIF') {
                        document.getElementById("aktif22").checked = true;
                    } else {
                        document.getElementById("blokir22").checked = true;
                    }
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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
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
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitformEdit").removeAttribute('disabled');
                //$('#editData').modal('hide');
                document.getElementById("FormulirEdit").reset();
                $('#submitformEdit').html('Submit');
                //APRI untuk refresh
                window.setTimeout(function () {
                    location.reload();
                }, 1000);

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
    //FormulirEditPKP//
    document.getElementById("FormulirEditPKP").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformEditPKP").setAttribute('disabled', 'disabled');
        $('#submitformEditPKP').html('Loading ...');
        var form = $('#FormulirEditPKP')[0];
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
                document.getElementById("submitformEditPKP").removeAttribute('disabled');
                $('#submitformEditPKP').html('Submit');
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
                document.getElementById("submitformEditPKP").removeAttribute('disabled');
                $('#editData').modal('hide');
                //document.getElementById("FormulirEditPKP").reset();
                $('#submitformEditPKP').html('Submit');
                //APRI untuk refresh
                window.setTimeout(function () {
                    location.reload();
                }, 1000);

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
    //FormulirEditPKPPKP submitformEditPKP/
    //FormulirEditPKP//
    document.getElementById("FormulirEditJabatan").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformEditJabatan").setAttribute('disabled', 'disabled');
        $('#submitformEditJabatan').html('Loading ...');
        var form = $('#FormulirEditJabatan')[0];
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
                document.getElementById("submitformEditJabatan").removeAttribute('disabled');
                $('#submitformEditJabatan').html('Submit');
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
                document.getElementById("submitformEditJabatan").removeAttribute('disabled');
                $('#editData2').modal('hide');
                //document.getElementById("FormulirEditJabatan").reset();
                $('#submitformEditJabatan').html('Submit');
                //APRI untuk refresh
                window.setTimeout(function () {
                    location.reload();
                }, 1000);

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
