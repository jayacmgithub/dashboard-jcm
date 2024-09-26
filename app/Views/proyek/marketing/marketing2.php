<?php $this->load->view("komponen/atas.php") ?>

<?php $this->load->view("komponen/js.php") ?>

<!-- start: page -->
<section class="panel">

    <div class="panel-body">

        <?php echo form_open('proyek/data_mr_edit', ' id="FormulirEdit"  enctype="multipart/form-data"'); ?>

        <div class="col-md-6">
            <div class="form-group alamat">
                <label class="col-sm-3 control-label">PKP</label>
                <div class="col-sm-9">
                    <input type="hidden" name="id_pkp0"
                        value="<?php echo $this->security->xss_clean($pkp->row()->id_pkp); ?>" class="form-control" />
                    <input type="text" value="<?php echo $this->security->xss_clean($pkp->row()->no_pkp); ?>"
                        class="form-control" disabled readonly />
                </div>
            </div>

            <div class="form-group kategori">
                <label class="col-sm-3 control-label">Alias<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="hidden" name="alias0"
                        value="<?php echo $this->security->xss_clean($pkp->row()->alias); ?>" class="form-control"
                        required />
                    <input type="text" name="alias"
                        value="<?php echo $this->security->xss_clean($pkp->row()->alias); ?>" class="form-control"
                        required />
                </div>
            </div>
            <div class="form-group kategori">
                <label class="col-sm-3 control-label">Nama sesuai Kontrak<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="hidden" name="proyek0"
                        value="<?php echo $this->security->xss_clean($pkp->row()->alias); ?>" class="form-control"
                        required />
                    <textarea name="proyek" class="form-control" rows="6"
                        required><?php echo $this->security->xss_clean($pkp->row()->proyek); ?></textarea>
                </div>
            </div>
            <div class="form-group tgl_mutasi">
                <label class="col-sm-3 control-label">Kontrak Induk</label>
                <?php if ($pkp->row()->tgl_mulai > '2000-01-01') {
                    $tgl_mulai = $this->security->xss_clean(date('d-m-Y', strtotime($pkp->row()->tgl_mulai)));
                } else {
                    $tgl_mulai = '';
                }
                if ($pkp->row()->tgl_selesai > '2000-01-01') {
                    $tgl_selesai = $this->security->xss_clean(date('d-m-Y', strtotime($pkp->row()->tgl_selesai)));
                } else {
                    $tgl_selesai = '';
                } ?>
                <div class="col-sm-3">
                    <input type="text" name="tgl_mulai" value="<?php echo $this->security->xss_clean($tgl_mulai); ?>"
                        class="form-control" />
                </div>
                <div class="col-sm-1">
                    <a>s/d</a>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_selesai"
                        value="<?php echo $this->security->xss_clean($tgl_selesai); ?>" class="form-control" />
                </div>
            </div>

        </div>
        <div class="col-md-6">

            <div class="form-group kategori">
                <label class="col-sm-3 control-label">Jaminan Nilai</label>
                <div class="col-sm-9">
                    <input type="text" name="nilai"
                        value="<?php echo $this->security->xss_clean(number_format($pkp->row()->nilai_jaminan, 0, ",", ".")); ?>"
                        onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
                        class="form-control currency" autocomplete="off">
                </div>
            </div>
            <div class="form-group kategori">
                <label class="col-sm-3 control-label">Jaminan Selesai Tanggal</label>
                <div class="col-sm-9">
                    <?php if ($pkp->row()->tgl_jaminan > 0) {
                        $tgl_jaminan = $this->security->xss_clean(date('d-m-Y', strtotime($pkp->row()->tgl_jaminan)));
                    } else {
                        $tgl_jaminan = '';
                    } ?>
                    <input type="text" name="tgl_selesai"
                        value="<?php echo $this->security->xss_clean($tgl_jaminan); ?>" class="form-control"
                        placeholder="dd-mm-yyyy" />
                </div>
            </div>
            <div class="form-group kategori">
                <label class="col-sm-3 control-label">File BAST I</label>
                <div class="col-sm-9">
                    <input type="text" name="bast1"
                        value="<?php echo $this->security->xss_clean($pkp->row()->bast_1); ?>" class="form-control" />
                </div>
            </div>
            <div class="form-group kategori">
                <label class="col-sm-3 control-label">File BAST II</label>
                <div class="col-sm-9">
                    <input type="text" name="bast2"
                        value="<?php echo $this->security->xss_clean($pkp->row()->bast_2); ?>" class="form-control" />
                </div>
            </div>
            <div class="form-group kategori">
                <label class="col-sm-3 control-label">File SRT Referensi</label>
                <div class="col-sm-9">
                    <input type="text" name="referensi"
                        value="<?php echo $this->security->xss_clean($pkp->row()->bast_2); ?>" class="form-control" />
                </div>
            </div>
            <div class="col-md-12 text-right">
                <a class="btn btn-success" style="font-size:12px"
                    href="<?php echo base_url() ?>proyek/edit_1/<?php echo $pkp_user ?>">Kembali</a>

            </div>
        </div>

        <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
            id="submitformEdit">Simpan</button>

    </div>


    </form>
    <!--
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
                                <td><a style="font-size:12px" class="btn btn-success" href="#" onclick="edit(this)" data-id="<?php echo $pkpu->id ?>">Edit</a></td>
                            <?php } else { ?>
                                <td></td>
                            <?php } ?>
                            <td><?php echo $pkpu->nomor; ?></td>
                            <td><?php echo $pkpu->no_pkp; ?></td>
                            <td><?php echo $pkpu->tgl_mutasi; ?></td>
                            <td><?php echo $pkpu->alias; ?></td>
                            <td><?php echo $pkpu->kategori_user; ?></td>
                            <td><?php echo $status; ?></td>

                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
        <!--
        <div class="col-md-6">

            <div class="table-responsive" style="max-width:100%;">
                <table class="table table-bordered table-hover table-striped dataTable no-footer">
                    
                    <thead>
                        <tr>
                            <th style="width:5%;">Aksi</th>
                            <th style="width:10%;">Jabatan</th>
                            <th style="width:10%;">Status</th>

                        </tr>
                    </thead>
                    <?php foreach ($jabatanuser as $pkpu2) { ?>
                        <tbody>
                            <?php
                            $status = $pkpu2->status == 'AKTIF' ? "<span class='btn   btn-xs  btn-success'>Aktif</span>" : "<span class='btn btn-xs btn-danger'>Non Aktif</span>";
                            ?>
                            <td><a style="font-size:12px" class="btn btn-success" href="#" onclick="edit2(this)" data-id="<?php echo $pkpu2->id ?>">Edit</a></td>
                            <td><?php echo $pkpu2->kategori_user; ?></td>
                            <td><?php echo $status; ?></td>

                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
                    -->
    </div>
</section>
-->
<!-- end: page -->
<?php $this->load->view("komponen/bawah.php") ?>
<!--
<div class="modal fade bd-example-modal-lg" id="tambahDataJabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('setting/tambahuserjabatan', ' id="FormulirTambahJabatan" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah User Jabatan</h2>
                </header>

                <div class="panel-body">

                    <div class="form-group  nomor_pkp">
                        <label class="col-sm-3 control-label">Pilih Jabatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="idd" value="<?php echo $this->security->xss_clean($user2->row()->id); ?>">
                            <select data-plugin-selectTwo class="form-control" name="id_jabatan" autofocus>
                                <option value=""></option>
                                <?php foreach ($kategori as $supp): ?>
                                    <option value="<?php echo $supp->id; ?>"><?php echo $supp->kategori_user; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group jenis_kelamin">
                        <label class="col-sm-3 control-label">Status<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <?php
                            $jabatan1 = $this->security->xss_clean($user4->num_rows());
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
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitformjabatan">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
<div class="modal fade bd-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('setting/tambahuserpkp', ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah User PKP</h2>
                </header>

                <div class="panel-body">

                    <div class="form-group  nomor_pkp">
                        <label class="col-sm-3 control-label">Pilih pkp<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="id_pkp" id="nomor_pkp" placeholder="Silahkan pilih Proyek" autofocus required>
                                <option value=""></option>
                                <?php foreach ($pkp as $supp): ?>
                                    <option value="<?php echo $supp->id_pkp; ?>"><?php echo $supp->no_pkp . ': ' . $supp->alias; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group nama_kontrak">
                        <label class="col-sm-3 control-label">Nama Kontrak<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <textarea rows="3" class="form-control" id="proyek" disabled readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group no_pkp">
                        <label class="col-sm-3 control-label">Nomor PKP<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="hidden" name="idd" value="<?php echo $this->security->xss_clean($user2->row()->id); ?>">
                            <input type="text" class="form-control" id="no_pkp" disabled readonly>
                        </div>
                    </div>
                    <div class="form-group mt-lg kategori">
                        <label class="col-sm-3 control-label">Jabatan<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <select data-plugin-selectTwo class="form-control" name="idjabatan_pkp" placeholder="Silahkan Pilih Jabatan" required>
                                <option value=""></option>
                                <?php foreach ($jabatan as $kat): ?>
                                    <option value="<?php echo $kat->id; ?>"><?php echo $kat->kategori_user; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group tgl_mutasi">
                        <label class="col-sm-3 control-label">Tanggal Mutasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_mutasi" id="tanggal" class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitform">Submit</button>
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
                <?php echo form_open('setting/edituserpkp', ' id="FormulirEditPKP"  enctype="multipart/form-data"'); ?>
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
                            <select data-plugin-selectTwo class="form-control" name="id_jabatan" id="id_jabatan2" required>
                                <?php foreach ($jabatan as $kat): ?>
                                    <option value="<?php echo $kat->id; ?>"><?php echo $kat->kategori_user; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group tgl_demob">
                        <label class="col-sm-3 control-label">Tanggal Mutasi<span class="required">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="tgl_mutasi" id="tgl_mutasi2" class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
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
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitformEditPKP">Simpan</button>
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
                <?php echo form_open('setting/edituserjabatan', ' id="FormulirEditJabatan"  enctype="multipart/form-data"'); ?>

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
                            <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitformEditJabatan">Submit</button>
                            <button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
            </section>
        </div>
    </div>
</div>
                                -->
<?= $this->include('layout/js') ?>
<script type="text/javascript">
    $('.currency').mask("#.##0", {
        reverse: true
    });

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

    $('.tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('d-m-Y', {
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
            url: '<?php echo base_url() ?>setting/pkpdetail2',
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
    /*
    document.getElementById("FormulirTambahJabatan").addEventListener("submit", function(e) {
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
        }).done(function(data) {
            if (!data.success) {
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
        $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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


* /
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
    /*
    document.getElementById("FormulirEditPKP").addEventListener("submit", function(e) {
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
        }).done(function(data) {
            if (!data.success) {
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
        $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
                $('input[name=<?php echo $this->security->get_csrf_token_name(); ?>]').val(data.token);
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
    * /
</script>
</body>

</html>