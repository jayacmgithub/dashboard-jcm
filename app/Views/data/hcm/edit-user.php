<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <header>
        <div class="row show-grid">
            <div class="col-md-6">
                <h4 class="panel-title">EDIT DATA</h4>
            </div>
        </div>
    </header>
    <hr />
    <div class="panel-body">

        <?php
        if ($nrp == "10555" or $nrp == "23295") {
            echo form_open(base_url('laporan/useredit_3'), ' id="FormulirEdit"  enctype="multipart/form-data"');
        } else {
            if (esc($user2->getRow()->jml_pkp) > 1) {
                echo form_open(base_url('laporan/useredit_2 '), ' id="FormulirEdit"  enctype="multipart/form-data"');
            } else {
                echo form_open(base_url('laporan/useredit_1'), ' id="FormulirEdit"  enctype="multipart/form-data"');
            }
        }
        ?>

        <div class="col-md-6">
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NRP</label>
                <div class="col-sm-3">
                    <input type="text" name="username" value="<?= esc($user2->getRow()->username); ?>"
                        class="form-control" disabled readonly />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs nama_admin">
                <label class="col-sm-3 control-label">Nama Karyawan<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="hidden" name="idd" value="<?= esc($user2->getRow()->id); ?>">
                    <input type="hidden" name="username" value="<?= esc($user2->getRow()->username); ?>"
                        class="form-control" />
                    <input type="text" name="nama_admin" value="<?= esc($user2->getRow()->nama_admin); ?>"
                        class="form-control" />
                </div>
            </div>
            <?php
            $id_pkpQ = '';
            $no_pkpQ = '';
            $aliasQ = 'Silahkan Pilih PKP';
            if ($pkp_A != '') {
                $id_pkpQ = esc($user5->getRow()->id_pkp);
                $no_pkpQ = esc($user5->getRow()->no_pkp);
                $aliasQ = esc($user5->getRow()->alias);
            }
            ?>
            <?php if (esc($user2->getRow()->jml_pkp) > 1 and $pkp_A != '') { ?>
                <div class="form-group mb-xs golongan">
                    <label class="col-sm-3 control-label">Pilih PKP AKHIR<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <select data-plugin-selectTwo class="form-control" name="pkp_akhir" disabled readonly>
                            <option value="<?= $id_pkpQ; ?>">
                                <?= $no_pkpQ . ' :' . $aliasQ; ?>
                            </option>
                        </select>
                    </div>
                </div>
            <?php } else { ?>
                <div class="form-group mb-xs golongan">
                    <label class="col-sm-3 control-label">Pilih PKP AKHIR<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="hidden" name="pkp_sebelumnya" value="<?= $id_pkpQ; ?>" class="form-control" />
                        <select data-plugin-selectTwo class="form-control" name="pkp_akhir" required>

                            <option value="<?= $id_pkpQ; ?>">
                                <?= $no_pkpQ . ' :' . $aliasQ; ?>

                                <?php foreach ($pkp as $supp): ?>
                                <option value="<?= $supp->id_pkp; ?>">
                                    <?= $supp->no_pkp . ': ' . $supp->alias; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            <?php } ?>

            <?php
            if ($user2->getRow()->tgl_lahir > 0) {
                $tgl_lahir = date('d-m-Y', strtotime($user2->getRow()->tgl_lahir));
            } else {
                $tgl_lahir = '';
            }
            if ($user2->getRow()->tgl_masuk > 0) {
                $tgl_masuk = date('d-m-Y', strtotime($user2->getRow()->tgl_masuk));
            } else {
                $tgl_masuk = '';
            }
            if ($user2->getRow()->habis_kontrak > 0) {
                $habis_kontrak = date('d-m-Y', strtotime($user2->getRow()->habis_kontrak));
            } else {
                $habis_kontrak = '';
            }
            if ($user2->getRow()->tgl_kontrak > 0) {
                $tgl_kontrak = date('d-m-Y', strtotime($user2->getRow()->tgl_kontrak));
            } else {
                $tgl_kontrak = '';
            }
            ?>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">Tanggal Lahir<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_lahir" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_lahir; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                </div>
            </div>

            <?php
            $jenis_kelamin = esc($user2->getRow()->jenis_kelamin);
            $aktif = esc($user2->getRow()->aktif);
            ?>
            <div class="form-group mb-xs jenis_kelamin">
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
            <div class="form-group mb-xs alamat">
                <label class="col-sm-3 control-label">Alamat</label>
                <div class="col-sm-9">
                    <input type="text" name="alamat" value="<?= esc($user2->getRow()->alamat); ?>"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group mb-xs handphone">
                <label class="col-sm-3 control-label">Handphone</label>
                <div class="col-sm-9">
                    <input type="text" name="handphone" value="<?= esc($user2->getRow()->handphone); ?>"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group mb-xs email">
                <label class="col-sm-3 control-label">Email</label>
                <div class="col-sm-9">
                    <input type="text" name="email" value="<?= esc($user2->getRow()->email); ?>" class="form-control" />
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <?php if (esc($user2->getRow()->jml_pkp) == 1) { ?>
                <div class="form-group mb-xs tgl_mutasi">
                    <label class="col-sm-3 control-label">Tanggal Masuk<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_masuk" id="tanggal" autocomplete="off" class="form-control tanggal"
                            data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_masuk; ?>"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                    </div>
                </div>

                <div class="form-group mb-xs tgl_mutasi">
                    <label class="col-sm-3 control-label">Tgl Kontrak<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_kontrak_1" id="tanggal" autocomplete="off" class="form-control tanggal"
                            data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_kontrak; ?>"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                    </div>
                </div>
                <div class="form-group mb-xs tgl_mutasi">
                    <label class="col-sm-3 control-label">Tgl Habis Kontrak<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_kontrak" id="tanggal" autocomplete="off" class="form-control tanggal"
                            data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $habis_kontrak; ?>"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                    </div>
                </div>
                <div class="form-group mb-xs email">
                    <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="jabatan" value="<?= esc($user2->getRow()->jabatan); ?>"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-xs email">
                    <label class="col-sm-3 control-label">Jurusan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="jurusan" value="<?= esc($user2->getRow()->jurusan); ?>"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-xs email">
                    <label class="col-sm-3 control-label">Status Karyawan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="status_karyawan" value="<?= esc($user2->getRow()->status); ?>"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-xs mb-xs alamat">
                    <label class="col-sm-3 control-label">Sisa Cuti</label>
                    <div class="col-sm-3">
                        <input type="text" name="sisa_cuti" value="<?= esc($user2->getRow()->sisa_cuti); ?>"
                            class="form-control" />
                    </div>
                </div>
            <?php } else { ?>
                <div class="form-group mb-xs tgl_mutasi">
                    <label class="col-sm-3 control-label">Tanggal Masuk<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_masuk" id="tanggal" autocomplete="off" class="form-control tanggal"
                            data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_masuk; ?>"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                    </div>
                </div>

                <div class="form-group mb-xs tgl_mutasi">
                    <label class="col-sm-3 control-label">Tgl Kontrak<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_kontrak_1" id="tanggal" autocomplete="off" class="form-control tanggal"
                            data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_kontrak; ?>"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask required disabled readonly />
                    </div>
                </div>
                <div class="form-group mb-xs tgl_mutasi">
                    <label class="col-sm-3 control-label">Tgl Habis Kontrak<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="tgl_kontrak" id="tanggal" autocomplete="off" class="form-control tanggal"
                            data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $habis_kontrak; ?>"
                            data-inputmask-inputformat="dd-mm-yyyy" data-mask required disabled readonly />
                    </div>
                </div>
                <div class="form-group mb-xs email">
                    <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="jabatan" value="<?= esc($user2->getRow()->jabatan); ?>"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-xs email">
                    <label class="col-sm-3 control-label">Jurusan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="jurusan" value="<?= esc($user2->getRow()->jurusan); ?>"
                            class="form-control" />
                    </div>
                </div>
                <div class="form-group mb-xs email">
                    <label class="col-sm-3 control-label">Status Karyawan<span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="text" name="status_karyawan" value="<?= esc($user2->getRow()->status); ?>"
                            class="form-control" required />
                    </div>
                </div>
                <div class="form-group mb-xs mb-xs alamat">
                    <label class="col-sm-3 control-label">Sisa Cuti</label>
                    <div class="col-sm-3">
                        <input type="text" name="sisa_cuti" value="<?= esc($user2->getRow()->sisa_cuti); ?>"
                            class="form-control" />
                    </div>
                </div>

            <?php } ?>
            <?php if ($nrp == "10555" or $nrp == "23295") { ?>
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
            <?php } ?>
        </div>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <br>
                <a style="font-size:12px" class="btn btn-success" href="javascript:window.history.go(-1);"><i
                        class="fa fa-back"></i> Kembali</a>
                <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                    id="submitformEdit">Submit</button>

            </div>
        </div>
    </footer>
    </form>
    <div class="row" style="overflow-x: auto;white-space: nowrap;">
        <div class="col-md-12">

            <div class="table-responsive" style="max-width:100%;">
                <table class="table table-bordered table-hover table-striped dataTable no-footer">
                    <thead>
                        <tr>
                            <th style="width:10%;">Instansi</th>
                            <th style="width:10%;">PKP</th>
                            <th style="width:10%;">Mutasi</th>
                            <th style="width:25%;">Alias</th>
                            <th style="width:25%;">Jabatan</th>
                            <th style="width:10%;">Status</th>

                        </tr>
                    </thead>
                    <?php foreach ($pkp_karyawan as $pkpu) { ?>
                        <tbody>

                            <td>
                                <?= $pkpu->nomor; ?>
                            </td>
                            <td>
                                <?= $pkpu->no_pkp; ?>
                            </td>
                            <td>
                                <?= $pkpu->tgl_mob; ?>
                            </td>
                            <td>
                                <?= $pkpu->alias; ?>
                            </td>
                            <td>
                                <?= $pkpu->jabatan; ?>
                            </td>
                            <td>
                                <?= $pkpu->status; ?>
                            </td>

                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>

    </div>

</section>
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

    $('#nomor_pkp').change(function () {
        var dataId = $(this).val();
        //$(".listitem").find("tr:gt(0)").remove();
        //$("#kategoritambah").select2("val", "Purchase Order");
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>setting/pkpdetail2',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response.datarows, function (i, item) {
                    $('#proyek').val(item.proyek);
                    $('#no_pkp').val(item.no_pkp);
                });

                // $('.listitem').append(datarow);
            }
        });
        return false;
    });


    document.getElementById("FormulirEdit").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group mb-xs').removeClass('has-error');
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
                        Swal.fire({
                            icon: 'error',
                            title: 'Notifikasi',
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            text: data.errors[key],
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
                Swal.fire({
                    icon: 'success',
                    title: 'Notifikasi',
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    text: data.message
                });
            }
        }).fail(function (data) {
            Swal.fire({
                icon: 'error',
                title: 'Notifikasi',
                text: "Request gagal, browser akan di reload"
            });

        });
        e.preventDefault();
    });
</script>
</body>

</html>
<?= $this->endSection() ?>