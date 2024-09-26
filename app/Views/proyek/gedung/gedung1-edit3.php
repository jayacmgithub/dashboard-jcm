<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_1/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info1" aria-selected="true" style="color:black"><strong>PROGRESS</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_2/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info2" aria-selected="true" style="color:black"><strong>PERMASALAHAN</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_6/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info6" aria-selected="true" style="color:black"><strong>MONITORING KARYAWAN</strong></a>
        </li>
 <?php
    if ($nomorQN == '511') {
        ?>
        <?php
}
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link active" id="info3-tab" data-toggle="tab" href="#info3" role="tab" aria-controls="info3"
                    aria-selected="true" style="color:black"><strong>DATA UMUM & FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_4/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                    aria-controls="info4" aria-selected="true" style="color:black"><strong>DATA TEKNIS</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_5/<?= $proyek->getRow()->id_pkp ?>" role="tab"
                aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING DCR</strong></a>
        </li>

    </ul>

    <!-- DATA UMUM -->
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane active" id="info3" role="tabpanel" aria-labelledby="info3-tab">
            <div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-sm-12">
                            <div class="d-flex flex-row pull-right">
                                <?php
                                if (level_user('proyek', 'data', $kategoriQNS, 'posting') > 0) {
                                    ?>
                                    <h6 class="btn btn-success" style="font-size: 12px;">
                                        <a data-toggle="modal" data-target="#tambahDataDTU"> UPDATE PDF</a>
                                    </h6>
                                <?php } ?>

                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered dataTable">
                                    <!--<table class="table table-bordered">-->
                                    <thead style="background-color:#1b3a59">
                                        <tr>
                                            <?php
                                            if ($proyek->getRow()->tgl_ubah_dtu > 0) {
                                                $tgl_dtu = date('d M Y', strtotime($proyek->getRow()->tgl_ubah_dtu));
                                            } else {
                                                $tgl_dtu = '';
                                            }
                                            ?>
                                            <th style="text-align:center;font-size: 18px">DATA UMUM Upd:
                                                <?= $tgl_dtu ?>
                                            </th>
                                            <th style="text-align:right;">
                                                <h6 class="btn btn-info" style="font-size: 10px;"><a style="color:white"
                                                        target='_blank'
                                                        href="<?= base_url() . esc($proyek->getRow()->file_dtu) ?>">Zoom</a>
                                                </h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                                <?php if (($proyek->getRow()->file_dtu != '')) { ?>

                                                    <iframe src="<?= base_url() . esc($proyek->getRow()->file_dtu) ?>"
                                                        width="100%" height="600"></iframe>

                                                <?php } ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <a style="font-size: 12px;font-weight: 100;color:black"><i>Catatan: Apabila ada Update
                                        agar disampaikan ke Biro Engineering</a></i></a>
                            </div>
                        </div>
                    </div>
                    <!--FOTO-->
                    <div class="col-md-6">
                        <div class="col-sm-12">

                            <?= level_user('proyek', 'data', $kategoriQNS, 'add') > 0 ? '<h6 class="btn btn-success float-right" style="font-size: 12px;"><a data-toggle="modal" data-target="#tambahDataFoto"> UPDATE FOTO</a></h6>' : '';
                            ?>
                            <form action="" method="GET" class="ml-auto">
                                <div class="row align-items-center">
                                    <div class="col-md-4">
                                        <select name="tahun" id="tahun" class="form-control">
                                            <option value="00">Tahun</option>
                                            <?php foreach ($option_tahun as $data): ?>
                                                <option value="<?php echo $data->tahun; ?>"><?php echo $data->tahun; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>
                                    <div class="col-md-4">
                                        <select name="bulan" id="bulan" class="form-control">
                                            <option value="00">Bulan</option>
                                            <!-- Opsi Bulan akan diisi setelah pengguna memilih Tahun -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-lg btn-success" style="font-size:12px;"
                                            type="submit">Filter</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table class="table table-bordered dataTable">
                                    <!--<table class="table table-bordered">-->
                                    <thead style="background-color:#1b3a59">
                                        <tr>
                                            <?php
                                            if ($proyek->getRow()->tgl_ubah_gbr > 0) {
                                                $tgl_gbr = date('d M Y', strtotime($proyek->getRow()->tgl_ubah_gbr));
                                            } else {
                                                $tgl_gbr = '';
                                            }
                                            ?>
    <th style="text-align:center;width: 60%;font-size: 18px">FOTO Upd: <?php echo $tgl_gbr ?></th>                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
                                                if ($gambar->getNumRows() > 0) {
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        $gambarField = "gambar" . $i;
                                                        $gambarUrl = esc($gambar->getRow()->$gambarField);
                                                        if ($gambarUrl != '') {
                                                            ?>
                                                            <a href="#" data-toggle="modal" data-target="#gambarModal<?= $i ?>">
                                                                <img src="<?= base_url() . $gambarUrl ?>"
                                                                    class="rounded img-responsive" alt="foto proyek">
                                                            </a>
                                                            <h5 style="text-align: center;">Gambar
                                                                <?= $i ?>
                                                            </h5>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="gambarModal<?= $i ?>" tabindex="-1"
                                                                role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-lg" role="document">
                                                                    <!-- Adjust the modal-lg class for the desired size (e.g., modal-sm for small, modal-lg for large) -->
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <img src="<?= base_url() . $gambarUrl ?>"
                                                                                class="rounded img-responsive" alt="foto proyek">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>

                                            </td>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- end: page -->

<!-- TAMBAH DATA DTU Modal -->
<div class="modal fade" id="tambahDataDTU" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/dtutambah'), ['enctype' => 'multipart/form-data']); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui Data UMUM</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="<?= esc($proyek->getRow()->id_pkp); ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />
                                    <input type="file" name="berkas" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitformdtu">Submit</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                <?= form_close(); ?>
            </section>
        </div>
    </div>
</div>

<!--TAMBAH DATA FOTO -->
<div class="modal fade" id="tambahDataFoto" tabindex="1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(base_url('proyek/fototambah'), ['id' => 'FormulirTambahFoto', 'enctype' => 'multipart/form-data']); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Perbaharui Data Foto</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">

                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="<?= esc($proyek->getRow()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?= session('idadmin'); ?>"
                                        class="form-control" required />

                                    <input type="file" name="berkas[]" class="form-control" required />

                                </div>
                            </div>
                            <div class="form-group mt-lg file2">
                                <label class="col-sm-3 control-label">FILE 2<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group mt-lg file3">
                                <label class="col-sm-3 control-label">FILE 3<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group mt-lg file4">
                                <label class="col-sm-3 control-label">FILE 4</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group mt-lg file5">
                                <label class="col-sm-3 control-label">FILE 5</label>
                                <div class="col-sm-9">
                                    <input type="file" name="berkas[]" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mt-lg Catatan">
                                <h6> - FOTO Proyek harus menggambarkan progres secara keseluruhan </h6>
                                <h6> - Minimal 3 Foto yang di upload dan maksimal 5 Foto </h6>
                                <h6> </h6>
                                <h6> Format Foto : </h6>
                                <h6> - Jenis File : jpg / jpeg / jpe / png </h6>
                                <h6> - Ukuran File Maximum : 2 mb (perfoto) </h6>
                                <!-- <h6> Ukuran Pixel File Maximum : </h6>
                                <h6> - Width : 2048 </h6>
                                <h6> - Height : 1000 </h6> -->
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="panel-footer">
                    <div class="row">


                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitformfoto">Submit</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                <?= form_close(); ?>
            </section>
        </div>
    </div>
</div>
<?= $this->include('layout/js') ?>
<script>
    // Tambahkan event listener untuk perubahan tahun
    document.getElementById('tahun').addEventListener('change', function () {
        const tahun = this.value;
        const bulanSelect = document.getElementById('bulan');
        bulanSelect.innerHTML = ''; // Mengosongkan opsi bulan

        // Kirim permintaan AJAX untuk mengambil data bulan berdasarkan tahun yang dipilih
        fetch(`<?= base_url('proyek/get_bulan_gbr'); ?>?id_pkp=<?= $id_pkp; ?>&tahun=${tahun}`)
            .then(response => response.json())
            .then(data => {
                // Tambahkan opsi bulan ke dalam elemen select
                data.forEach(bulan => {
                    const option = document.createElement('option');
                    option.value = bulan.bulan;
                    option.textContent = bulan.nama_bulan;
                    bulanSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
<script type="text/javascript">
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 2,
    });

    $(document).ready(function () {
        $('ul li a').click(function () {
            $('li a').removeClass("active");
            $(this).addClass("active");
        });
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


    /* TAMBAH DTU */
    document.getElementById("FormulirTambahDTU").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformdtu").setAttribute('disabled', 'disabled');
        $('#submitformdtu').html('Loading ...');
        var form = $('#FormulirTambahDTU')[0];
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
                document.getElementById("submitformdtu").removeAttribute('disabled');
                $('#submitformdtu').html('Submit');
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitformdtu").removeAttribute('disabled');
                $('#tambahDataDTU').modal('hide');
                document.getElementById("FormulirTambahDTU").reset();
                $('#submitformdtu').html('Submit');
                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
                window.setTimeout(function () {
                    //location.reload();
                    window.location.href = "<?= base_url() ?>proyek/edit_3/" + data.id_pkp
                }, 2000);
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
    /* TAMBAH FOTO */
    document.getElementById("FormulirTambahFoto").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformfoto").setAttribute('disabled', 'disabled');
        $('#submitformfoto').html('Loading ...');
        var form = $('#FormulirTambahFoto')[0];
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
                document.getElementById("submitformfoto").removeAttribute('disabled');
                $('#submitformfoto').html('Submit');
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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitformfoto").removeAttribute('disabled');
                $('#tambahDataFoto').modal('hide');
                document.getElementById("FormulirTambahFoto").reset();
                $('#submitformfoto').html('Submit');
                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
                window.setTimeout(function () {
                    //location.reload();
                    window.location.href = "<?= base_url() ?>proyek/edit_3/" + data.id_pkp
                }, 2000);
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