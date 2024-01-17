<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">PEMBAHARUAN DATA</a>
        </li>
    </ul>
    <!--PROGRESS-->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info1" role="tabpanel" aria-labelledby="info1-tab">

            <?php

            if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 < 1) {
                echo form_open('laporan/upload_pembaharuan_1', 'enctype="multipart/form-data"');
            } else {
                if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 < 1) {
                    echo form_open('laporan/proses_pembaharuan_1', ' enctype="multipart/form-data"');
                } else {

                    if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 > 0) {
                        echo form_open('laporan/hapus_pembaharuan_1');
                    }
                }
            } ?>
            <div>
                <?php
                if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 < 1) {
                    ?>
                    <div class="form-group excelfile">
                        <label class="col-sm-3 control-label">Upload File Excel</label>
                        <div class="col-sm-9">
                            <input type="file" name="excelfile" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            Catatan : Ikuti sesuai Format, silahkan download---->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-right">
                <?php
                if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 < 1) {
                    ?>
                    <button class="btn btn-primary modal-confirm" style="font-size: 12px;" type="submit"
                        id="submitformupload"><i class="fa fa-upload"></i>Upload</button>
                    <a class="btn btn-warning" style="font-size: 12px;" href="<?= base_url() ?>excel/formPembKaryawan.xlsx"
                        target="_blank"><i class="fa fa-download"></i> Download Format</a>
                    </form>
                <?php } ?>

            </div>
            <div class="col-md-12 text-right">
                <?php
                if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 > 0) {
                    ?>
                    <button class="btn btn-danger modal-confirm" style="font-size: 12px;" type="submit"
                        id="submitformupload"><i class="fa fa-save"></i> Hapus</button>
                    </form>
                <?php } ?>
            </div>
            <div class="col-md-12 text-right">
                <?php
                if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 < 1) {
                    ?>
                    <button class="btn btn-info modal-confirm" style="font-size: 12px;color:black" type="submit"
                        id="submitformupload"><i class="fa fa-save"></i> PROSES</button>
                    </form>
                <?php } ?>
            </div>
        </div>
        <?php
        if (level_user('data', 'hcm', $kategoriQNS, 'edit') > 0 and $total1 > 0) {
            ?>
            <h4> Total Data :
                <?= $total1 ?> record
            </h4>
            <h4> Total Error :
                <?= $total2 ?> field
            </h4>
            <table class="table table-bordered table-hover table-striped" id="importdata2">
                <thead>
                    <tr>
                        <th style="vertical-align:middle">NRP</th>
                        <th style="vertical-align:middle">NAMA</th>
                        <th style="vertical-align:middle">L/P</th>
                        <th style="vertical-align:middle">TGL LAHIR</th>
                        <th style="vertical-align:middle">ALAMAT</th>
                        <th style="vertical-align:middle">NO HP</th>
                        <th style="vertical-align:middle">EMAIL</th>
                        <th style="vertical-align:middle">PENDIDIKAN</th>
                        <th style="vertical-align:middle">JABATAN</th>
                        <th style="vertical-align:middle">TGL MASUK</th>
                        <th style="vertical-align:middle">TGL KONTRAK</th>
                        <th style="vertical-align:middle">HABIS KONTRAK</th>
                        <th style="vertical-align:middle">STS KONTRAK</th>
                        <th style="vertical-align:middle">STS PERNIKAHAN</th>
                        <th style="vertical-align:middle">STS DOMISILI</th>
                        <th style="vertical-align:middle">DOMISI KELUARGA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</section>
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
    $(document).ready(function () {
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

<?= $this->endSection() ?>