<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <header>
        <div class="row show-grid">
            <div class="col-md-6">
                <h4 class="panel-title">EDIT ADDENDUM</h4>
            </div>
    </header>
    <hr />
    <div class="panel-body">
        <?= form_open(base_url('laporan/update_addendum'), ' id="FormulirEdit"  enctype="multipart/form-data"');

        ?>
        <?php
        if ($data_mkt->getRow()->tgl_ba_surat > 0) {
            $tgl_ba_surat = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_ba_surat));
        } else {
            $tgl_ba_surat = '';
        }
        if ($data_mkt->getRow()->tgl_sph > 0) {
            $tgl_sph = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_sph));
        } else {
            $tgl_sph = '';
        }
        if ($data_mkt->getRow()->tgl_nego > 0) {
            $tgl_nego = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_nego));
        } else {
            $tgl_nego = '';
        }
        if ($data_mkt->getRow()->tgl_draft > 0) {
            $tgl_draft = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_draft));
        } else {
            $tgl_draft = '';
        }
        if ($data_mkt->getRow()->tgl_sper > 0) {
            $tgl_sper = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_sper));
        } else {
            $tgl_sper = '';
        }
        ?>

        <div class="col-md-12">
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NAMA PROYEK<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="hidden" name="idd" value="<?= esc($data_mkt->getRow()->id_addendum); ?>">
                    <input type="hidden" name="id_marketing" value="<?= esc($data_mkt->getRow()->id_marketing); ?>">
                    <input type="text" value="<?= esc($data_mkt->getRow()->nama_proyek); ?>" class="form-control"
                        required disabled />
                </div>
            </div>

            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">ADDENDUM KE<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="addendum_ke" value="<?= esc($data_mkt->getRow()->addendum_ke); ?>"
                        class="form-control" required disabled />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL BA/SURAT<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_ba_surat" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_ba_surat; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask required />
                </div>
            </div>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL SPH</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_sph" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_sph; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL NEGO</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_nego" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_nego; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL DRAFT</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_draft" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_draft; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL SPER ADDENDUM</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_sper" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_sper; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>



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


</section>
<!-- end: page -->
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
                            title: 'Notifikasi',
                            text: data.errors[key],
                            position: "top-end",
                            showConfirmButton: false,
                            icon: 'error'
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
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
            }
        }).fail(function (data) {
            Swal.fire({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                position: "top-end",
                showConfirmButton: false,
                icon: 'error'

            });

        });
        e.preventDefault();
    });
</script>
</body>

</html>
<?= $this->endSection() ?>