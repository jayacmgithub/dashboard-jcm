<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item">
            <a class="nav-link active" id="info1-tab" data-toggle="tab" href="#info1" role="tab" aria-controls="info1"
                aria-selected="true">IMPORT MON ABSENSI</a>
        </li>
    </ul>
    <!--PROGRESS-->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info1" role="tabpanel" aria-labelledby="info1-tab">

            <?php

            if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 < 1) {
                echo form_open('proyek/upload_mon_1', ' id="FormulirUpload" enctype="multipart/form-data"');
            } else {
                if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 < 1) {
                    echo form_open('proyek/proses_mon_1', ' id="FormulirUpload" enctype="multipart/form-data"');
                } else {

                    if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 > 0) {
                        echo form_open('proyek/hapus_mon_1', ' id="FormulirUpload"');
                    }
                }
            } ?>
            <input type="hidden" name="id_pkp58" class="form-control" value="<?php echo $id_pkp ?>" required />
            <div>
                <?php
                if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 < 1) {
                    ?>
                    <div class="form-group excelfile">
                        <label class="col-sm-3 control-label">Upload File Excel</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="id_pkp58" class="form-control" value="<?php echo $id_pkp ?>"
                                required />
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
                if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 < 1) {
                    ?>
                    <button class="btn btn-primary modal-confirm" style="font-size: 12px;" type="submit"
                        id="submitformupload"><i class="fa fa-upload"></i>Upload</button>


                    <a class="btn btn-warning" style="font-size: 12px;"
                        href="<?php echo base_url() ?>proyek/xls3/<?php echo $id_pkp ?>" target="_blank"><i
                            class="fa fa-download"></i> Download Format</a>
                    </form>
                <?php } ?>

            </div>
            <div class="col-md-12 text-right">
                <?php
                if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 > 0) {
                    ?>
                    <button class="btn btn-danger modal-confirm" style="font-size: 12px;" type="submit"
                        id="submitformupload"><i class="fa fa-save"></i> Hapus</button>
                    </form>
                <?php } ?>

            </div>
            <div class="col-md-12 text-right">
                <?php
                if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 > 0 and $total2 < 1) {
                    ?>
                    <button class="btn btn-info modal-confirm" style="font-size: 12px;color:black" type="submit"
                        id="submitformupload"><i class="fa fa-upload"></i> UPLOAD</button>
                    </form>
                <?php } ?>
            </div>
        </div>
        <?php
        if (level_user('proyek', 'data', $kategoriQNS, 'edit') > 0 and $total1 > 0) {
            ?>
            <h4> Total Data :
                <?php echo $total1 ?> record
            </h4>
            <h4> Total Error :
                <?php echo $total2 ?> field
            </h4>
            <h4> Data Dobel :
                <?php echo $total3 ?> field
            </h4>
            <table class="table table-bordered table-hover table-striped" id="importdata1">
                <thead>
                    <tr>
                        <th style="vertical-align:middle;text-align:center;" rowspan="2">NO</th>
                        <th style="vertical-align:middle;text-align:center;" rowspan="2">NRP</th>
                        <th style="vertical-align:middle;text-align:center;" rowspan="2">NAMA</th>
                        <th style="vertical-align:middle;text-align:center;" colspan="4">ABSENSI</th>
                        <th style="vertical-align:middle;" rowspan="2">SISA CUTI</th>
                        <th style="vertical-align:middle;" rowspan="2">KET ABSENSI</th>
                        <th style="vertical-align:middle;text-align:center;" rowspan="2">POSISI</th>
                        <th style="vertical-align:middle;text-align:center;" colspan="2">MOB</th>
                        <th style="vertical-align:middle;text-align:center;" colspan="2">DEMOB</th>
                        <th style="vertical-align:middle;text-align:center;" rowspan="2">Ket.<br>MOB/DEMOB</th>
                        <th style="vertical-align:middle;text-align:center;" rowspan="2">MUTASI,RESIGN,<br> TASK FORCE</th>
                    </tr>
                    <tr>
                        <th style="vertical-align:middle;text-align:center;">S</th>
                        <th style="vertical-align:middle;text-align:center;">I</th>
                        <th style="vertical-align:middle;text-align:center;">A</th>
                        <th style="vertical-align:middle;text-align:center;">C</th>
                        <th style="vertical-align:middle;text-align:center;">Renc.</th>
                        <th style="vertical-align:middle;text-align:center;">Real</th>
                        <th style="vertical-align:middle;text-align:center;">Renc.</th>
                        <th style="vertical-align:middle;text-align:center;">Real</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        <?php } ?>
    </div>
</section>
<!-- end: page -->

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
    var tableimport = $('#importdata1').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>proyek/dataimportmon1",
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

<?= $this->endSection() ?>