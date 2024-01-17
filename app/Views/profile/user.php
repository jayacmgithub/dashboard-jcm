<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<link href="<?= base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">
<!-- start: page -->
<div class="row">
    <div class="col-md-6">

        <?= form_open('password/gantiuserpkp', ' id="Formulir" enctype="multipart/form-data"'); ?>
        <section class="panel">
            <header class="panel-heading">

                <h2 class="panel-title">Data User</h2>
            </header>
            <div class="panel-body">
                <div class="form-group  nomor_pkp">
                    <label class="col-sm-3 control-label">Pilih pkp<span class="required">*</span></label>
                    <div class="col-sm-9">

                        <select data-plugin-selectTwo class="form-control" name="id_pkp" autofocus required>
                            <?php
                            $ada = esc($pkpuser2->getNumRows());
                            $ada2 = esc($pkpuser3->getNumRows());
                            if ($ada > 0) {
                                ?>
                                <option value="<?= esc($pkpuser2->getRow()->id_pkp); ?>">
                                    <?= esc($pkpuser2->getRow()->no_pkp) . ' : ' . esc($pkpuser2->getRow()->alias); ?>
                                </option>
                            <?php }
                            if ($ada2 > 0) {
                                ?>

                                <?php foreach ($pkpuser as $supp) { ?>
                                    <option value="<?= $supp->id_pkp; ?>">
                                        <?= $supp->no_pkp . ' : ' . $supp->alias; ?>
                                    </option>
                                <?php }
                            } ?>
                        </select>

                    </div>
                </div>


                <div class="form-group foto">
                    <label class="col-sm-3 control-label">Pilih Foto <span class="required">*</span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="logo"><small>Kosongkan jika tidak diganti, Ukuran
                            foto sebaiknya kotak (30x30)
                    </div>
                </div>

                <img src="<?= base_url() ?>assets/foto/<?= $tes0->foto; ?>"
                    style="width: 100px;height: 100px;border-radius:100%" alt="foto">

            </div>
            <footer class="panel-footer text-right">
                <button class="btn btn-primary" id="submitform" style="font-size:12px">Simpan</button>
            </footer>
        </section>
        </form>
    </div>
</div>


<!-- end: page -->
</section>
</div>
</section>
<!-- JS -->

<script>
    $(document).ready(function () {
        document.getElementById("Formulir").addEventListener("submit", function (e) {
            PNotify.removeAll();
            blurForm();
            $('.form-group').removeClass('has-error');
            document.getElementById("submitform").setAttribute('disabled', 'disabled');
            $('#submitform').html('Loading ...');
            var form = $('#Formulir')[0];
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
                            $('.' + key).addClass('has-error');
                            new PNotify({
                                title: 'Notifikasi Eror',
                                text: data.errors[key],
                                type: 'error'
                            });
                        }
                    }
                } else {
                    $('input[name=<?= csrf_token() ?>]').val(data.token);
                    document.getElementById("submitform").removeAttribute('disabled');
                    document.getElementById("Formulir").reset();
                    $('#submitform').html('Submit');
                    new PNotify({
                        title: 'Notifikasi',
                        text: data.message,
                        type: 'success'
                    });
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            }).fail(function (data) {
                document.getElementById("submitform").removeAttribute('disabled');
                $('#submitform').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: "Request gagal, browser akan direload",
                    type: 'danger'
                });
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
            });
            e.preventDefault();
        });
    });
</script>

</body>

</html>
<?= $this->endSection() ?>