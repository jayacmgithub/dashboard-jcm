<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->

<div class="panel-body">


    <?php
    if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total_migrasi < 1) {
        //echo form_open('setting/view_upload3', ' id="FormulirUpload" enctype="multipart/form-data"');
        echo form_open('setting/view_user3', 'enctype="multipart/form-data"');
    } else {

        if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total_migrasi > 0 and $total2 == 0 /*and $total3 == 0*/) {
            //echo form_open('setting/proses_upload', ' id="FormulirUpload"');
            echo form_open('setting/proses_upload_user', ' id="FormulirUpload"');
        } else {
            if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total3 < 0) {
                echo form_open('setting/proses_hapus', ' id="FormulirUpload"');
            }
        }
    } ?>

    <div class="panel-body">
        <?php
        if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total_migrasi < 1) {
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


    <div class="row">
        <div class="col-md-12 text-right">
            <?php
            if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total_migrasi < 1) {
                ?>
                <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitformupload"><i
                        class="fa fa-upload"></i>Upload</button>


                <a style="font-size:12px" class="btn btn-warning" href="<?= base_url() ?>excel/formatuploadPKP.xlsx"
                    target="_blank"><i class="fa fa-download"></i> Download Format</a>
                </form>
            <?php } ?>

        </div>
        <div class="col-md-12 text-right">
            <?php
            if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total2 == 0 /*and $total3 == 0*/and $total_migrasi > 0) {
                ?>
                <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit" id="submitformupload"><i
                        class="fa fa-save"></i> Proses</button>
                </form>
            <?php } ?>

        </div>
        <div class="col-md-12 text-right">
            <?php
            if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total2 == 0 and $total3 < 1 and $total_migrasi > 0) {
                ?>
                <button style="font-size:12px" class="btn btn-primary" type="submit" id="submitformupload"><i
                        class="fa fa-trash"></i> Hapus</button>
                </form>
            <?php } ?>
        </div>
    </div>
    <?php
    if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total2 > 0) {
        ?>

        <h3> Data Error :
            <?= $total2 ?> record
        </h3>
        <table class="table table-bordered table-hover table-striped" id="migrasidata">
            <thead>
                <tr>
                    <th>Nomor Instansi</th>
                    <th>Nomor PKP</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    <?php } ?>
    <?php
    if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total2 == 0 and $total3 > 0) {
        ?>
        <h3> Data Double :
            <?= $total3 ?> record
        </h3>
        <table class="table table-bordered table-hover table-striped" id="migrasidata3">
            <thead>
                <tr>
                    <th>Nomor Instansi</th>
                    <th>Nomor PKP</th>
                    <th>Nama Sesuai Kontrak</th>
                    <th>Nama Alias</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    <?php } ?>
    <?php
    if (level_user('setting', 'pkp', $kategoriQNS, 'add') > 0 and $total2 == 0 and $total3 == 0 and $total_migrasi > 0) {
        ?>
        <h3> Total Data :
            <?= $total_migrasi ?> record
        </h3>
        <table class="table table-bordered table-hover table-striped" id="migrasidata2">
            <thead>
                <tr>
                    <th>Nomor Instansi</th>
                    <th>Nomor PKP</th>
                    <th>Nama Sesuai Kontrak</th>
                    <th>Nama Alias</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    <?php } ?>
</div>




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

    var tablemigrasi = $('#importdata1').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>setting/datamigrasi",
            "type": "GET"
        },

    });
    /*error*/

    /*no error*/
    var tablemigrasi2 = $('#importdata1').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>setting/datamigrasi2",
            "type": "GET"
        },

    });

    /*error double*/
    var tablemigrasi3 = $('#importdata1').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?= base_url() ?>setting/datamigrasi3",
            "type": "GET"
        },

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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                document.getElementById("submitformupload").removeAttribute('disabled');

                document.getElementById("FormulirUpload").reset();
                $('#submitformupload').html('Submit');
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
            }, 2000);
        });
        e.preventDefault();
    });
</script>
</body>

</html>
<?= $this->endSection() ?>