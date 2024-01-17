<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<div class="row">
    <div class="col-md-6">

        <?= form_open('profil/ubah-password'); ?>
        <?= csrf_field() ?>
        <section class="panel">
            <header class="panel-heading">
                <h2 class="panel-title">Form Edit Password</h2>
            </header>
            <div class="panel-body">
                <div class="form-group password">
                    <label class="col-sm-4 control-label">Password: </label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>
                <div class="form-group password2">
                    <label class="col-sm-4 control-label">Konfirmasi Password: </label>
                    <div class="col-sm-8">
                        <input type="password" name="repassword" required="" class="form-control">
                    </div>
                </div>
            </div>
            <footer class="panel-footer">
                <button class="btn btn-primary" id="submitform">Submit </button>
                <button type="reset" class="btn btn-default">Reset</button>
            </footer>
        </section>
        </form>
    </div>
</div>


<!-- end: page -->
</section>
</div>
</section>
<?= $this->include('layout/js') ?>
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
            })
            e.preventDefault();
        });
    });
</script>

<?= $this->endSection() ?>