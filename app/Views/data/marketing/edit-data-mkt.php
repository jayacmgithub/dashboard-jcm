<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<section class="panel">
    <header>
        <div class="row show-grid">
            <div class="col-md-6">
                <h4 class="panel-title">EDIT DATA MARKETING</h4>
            </div>
    </header>
    <hr />
    <div class="panel-body">

        <?php

        echo form_open(base_url('laporan/update_data_mkt'), ' id="FormulirEdit"  enctype="multipart/form-data"');

        ?>

        <div class="col-md-6">
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NOMOR LIST<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="hidden" name="idd" value="<?= esc($data_mkt->getRow()->id_marketing); ?>">
                    <input type="hidden" name="no_list" value="<?= esc($data_mkt->getRow()->no_list); ?>"
                        class="form-control" />
                    <input type="text" name="no_list" value="<?= esc($data_mkt->getRow()->no_list); ?>"
                        class="form-control" disabled readonly />
                </div>
            </div>
            <div class="form-group mb-xs golongan">
                <label class="col-sm-3 control-label">DIVISI<span class="required">*</span></label>
                <div class="col-sm-9">

                    <select data-plugin-selectTwo class="form-control" name="divisi" disabled>
                        <option value="<?= esc($data_mkt->getRow()->divisi); ?>">
                            <?= esc($data_mkt->getRow()->divisi) ?>
                        </option>
                        <option value="GEDUNG">GEDUNG</option>
                        <option value="KTL">KTL</option>
                        <option value="TRANSPORTASI">TRANSPORTASI</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">LINGKUP<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="lingkup" value="<?= esc($data_mkt->getRow()->lingkup); ?>"
                        class="form-control" disabled />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NAMA PROYEK<span class="required">*</span></label>
                <div class="col-sm-9">
                    <input type="text" name="nama_proyek" value="<?= esc($data_mkt->getRow()->nama_proyek); ?>"
                        class="form-control" disabled />
                </div>
            </div>

            <?php
            if ($data_mkt->getRow()->tgl_start > 0) {
                $tgl_start = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_start));
            } else {
                $tgl_start = '';
            }
            if ($data_mkt->getRow()->tgl_finish > 0) {
                $tgl_finish = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_finish));
            } else {
                $tgl_finish = '';
            }
            if ($data_mkt->getRow()->jaminan_tgl > 0) {
                $jaminan_tgl = date('d-m-Y', strtotime($data_mkt->getRow()->jaminan_tgl));
            } else {
                $jaminan_tgl = '';
            }
            if ($data_mkt->getRow()->tgl_draft > 0) {
                $tgl_draft = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_draft));
            } else {
                $tgl_draft = '';
            }
            if ($data_mkt->getRow()->tgl_ttd > 0) {
                $tgl_ttd = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_ttd));
            } else {
                $tgl_ttd = '';
            }
            if ($data_mkt->getRow()->tgl_undangan > 0) {
                $tgl_undangan = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_undangan));
            } else {
                $tgl_undangan = '';
            }
            if ($data_mkt->getRow()->tgl_pq > 0) {
                $tgl_pq = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_pq));
            } else {
                $tgl_pq = '';
            }
            if ($data_mkt->getRow()->tgl_awz > 0) {
                $tgl_awz = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_awz));
            } else {
                $tgl_awz = '';
            }
            if ($data_mkt->getRow()->tgl_admin > 0) {
                $tgl_admin = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_admin));
            } else {
                $tgl_admin = '';
            }
            if ($data_mkt->getRow()->tgl_teknis > 0) {
                $tgl_teknis = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_teknis));
            } else {
                $tgl_teknis = '';
            }
            if ($data_mkt->getRow()->tgl_pemasukan > 0) {
                $tgl_pemasukan = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_pemasukan));
            } else {
                $tgl_pemasukan = '';
            }
            if ($data_mkt->getRow()->tgl_presentasi > 0) {
                $tgl_presentasi = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_presentasi));
            } else {
                $tgl_presentasi = '';
            }
            if ($data_mkt->getRow()->tgl_selesai_kont > 0) {
                $tgl_selesai_kont = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_selesai_kont));
            } else {
                $tgl_selesai_kont = '';
            }



            ?>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL Undangan<span class="required">*</span></label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_undangan" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_undangan; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
                <label class="col-sm-3 control-label">TGL PQ<span class="required">*</span></label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_pq" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_pq; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
            </div>




            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL AANWIJZING</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_awz" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_awz; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
                <label class="col-sm-3 control-label">TGL PROPOSAL ADM </label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_admin" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_admin; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
            </div>


            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">PROGRESS PERSONIL</label>
                <div class="col-sm-3">
                    <input type="number" name="jml_personil" max="4"
                        value="<?= esc($data_mkt->getRow()->jml_personil); ?>" class="form-control" disabled />
                </div>
                <label class="col-sm-3 control-label">TGL PROPOSAL TEKNIS</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_teknis" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_teknis; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">Tgl PEMASUKAN</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_pemasukan" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_pemasukan; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
                <label class="col-sm-3 control-label">Tgl PRESENTASI</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_presentasi" id="tanggal" autocomplete="off"
                        class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime"
                        value="<?= $tgl_presentasi; ?>" data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NILAI ADM TEKNIS</label>
                <div class="col-sm-3">
                    <input type="number" name="nilai_admin" value="<?= esc($data_mkt->getRow()->admin_teknis); ?>"
                        class="form-control" disabled />
                </div>
                <label class="col-sm-3 control-label">EVALUASI HARGA</label>
                <div class="col-sm-3">
                    <input type="number" name="evaluasi_harga" value="<?= esc($data_mkt->getRow()->harga_evaluasi); ?>"
                        class="form-control" disabled />
                </div>
            </div>
            <div class="form-group mb-xs golongan">

                <label class="col-sm-3 control-label">MENANG/KALAH</label>
                <div class="col-sm-3">
                    <select data-plugin-selectTwo class="form-control" name="menang" disabled>
                        <option value="<?= esc($data_mkt->getRow()->menang); ?>">
                            <?= esc($data_mkt->getRow()->menang) ?>
                        </option>
                        <option value=""></option>
                        <option value="MENANG">MENANG</option>
                        <option value="KALAH">KALAH</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NAMA SESUAI KONTRAK<span class="required">*</span></label>
                <div class="col-sm-9">
                    <textarea name="nama_kontrak" class="form-control"
                        placeholder="Silahkan isi nama proyek sesuai kontrak"
                        disabled><?= esc($data_mkt->getRow()->nama_kontrak); ?></textarea>
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NOMOR SPK</label>
                <div class="col-sm-9">
                    <input type="text" name="no_spk" value="<?= esc($data_mkt->getRow()->no_spk); ?>"
                        class="form-control" disabled />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL DRAFT KONTRAK</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_draft" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_draft; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
                <label class="col-sm-3 control-label">TGL TANDA TANGAN</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_ttd" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_ttd; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">TGL MEMO PKP</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_memo" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_ttd; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask disabled />
                </div>
                <label class="col-sm-3 control-label">NOMOR PKP</label>
                <div class="col-sm-3">
                    <input type="text" name="no_pkp" value="<?= esc($data_mkt->getRow()->no_pkp); ?>"
                        class="form-control" disabled />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">KONT. INDUK START</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_start" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_start; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <label class="col-sm-3 control-label">FINISH</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_finish" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_finish; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">HARGA PENAWARAN</label>
                <div class="col-sm-9">
                    <input type="text" name="harga_penawaran" id="desimal1"
                        value="<?= number_format(esc($data_mkt->getRow()->harga_penawaran), 2, '.', ','); ?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">PPN</label>
                <div class="col-sm-9">
                    <input type="text" name="ppn"
                        value="<?= esc($data_mkt->getRow()->ppn)?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">NETT PORSI</label>
                <div class="col-sm-9">
                    <input type="text" name="nett_porsi" id="desimal3"
                        value="<?= number_format(esc($data_mkt->getRow()->nett_porsi), 2, '.', ','); ?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">NETT PORSI KSO</label>
                <div class="col-sm-9">
                <textarea name="nett_porsi_kso" id="summernote" width="100px" height="100px"><?= esc($data_mkt->getRow()->nett_porsi_kso); ?></textarea>
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">JAMINAN NILAI</label>
                <div class="col-sm-9">
                    <input type="text" name="jaminan_nilai" id="desimal2"
                        value="<?= number_format(esc($data_mkt->getRow()->jaminan_nilai), 2, '.', ','); ?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">JAMINAN TANGGAL</label>
                <div class="col-sm-9">
                    <input type="text" name="jaminan_tgl" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $jaminan_tgl; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs golongan">
                <label class="col-sm-3 control-label">FILE BAST I</label>
                <div class="col-sm-3">
                    <select data-plugin-selectTwo class="form-control" name="bast_1">
                        <option value="<?= esc($data_mkt->getRow()->bast_1); ?>">
                            <?= esc($data_mkt->getRow()->bast_1) ?>
                        </option>
                        <option value=""></option>
                        <option value="ADA">ADA</option>
                        <option value="TIDAK">TIDAK</option>
                    </select>
                </div>
                <label class="col-sm-3 control-label">FILE BAST II</label>
                <div class="col-sm-3">
                    <select data-plugin-selectTwo class="form-control" name="bast_2">
                        <option value="<?= esc($data_mkt->getRow()->bast_2); ?>">
                            <?= esc($data_mkt->getRow()->bast_2) ?>
                        </option>
                        <option value=""></option>
                        <option value="ADA">ADA</option>
                        <option value="TIDAK">TIDAK</option>
                    </select>
                </div>
            </div>
            <div class="form-group mb-xs golongan">
                <label class="col-sm-3 control-label">FILE SURAT REF.</label>
                <div class="col-sm-3">
                    <select data-plugin-selectTwo class="form-control" name="surat_ref">
                        <option value="<?= esc($data_mkt->getRow()->surat_ref); ?>">
                            <?= esc($data_mkt->getRow()->surat_ref) ?>
                        </option>
                        <option value=""></option>
                        <option value="ADA">ADA</option>
                        <option value="TIDAK">TIDAK</option>
                    </select>
                </div>
                <label class="col-sm-3 control-label">TANGGAL SELESAI</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_selesai_kont" id="tanggal" autocomplete="off"
                        class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime"
                        value="<?= $tgl_selesai_kont; ?>" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
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

<?= $this->include('layout/js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 100 // Set editor height
            });
        });
    </script>
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

    $(function () {
        $("#uang").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#uang2").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#desimal1").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#desimal2").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#desimal3").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    var format = function (num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };

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


