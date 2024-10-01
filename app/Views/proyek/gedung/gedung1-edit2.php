<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>

<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_1/<?= $proyek->getRow()
    ->id_pkp ?>" role="tab"
                aria-controls="info1" aria-selected="true" style="color:black"><strong>PROGRESS</strong></a>
        </li>
        <?php if ($nomorQN != '412') { ?>
            <li class="nav-item">
                <a class="nav-link active" id="info2-tab" data-toggle="tab" href="#info2" role="tab" aria-controls="info2"
                    aria-selected="true" style="color:black"><strong>PERMASALAHAN</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_6/<?= $proyek->getRow()
    ->id_pkp ?>" role="tab"
                aria-controls="info6" aria-selected="true" style="color:black"><strong>MONITORING KARYAWAN</strong></a>
        </li>
 <?php
 if ($nomorQN == '511') { ?>
        <?php }
 if ($nomorQN != '412') { ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_3/<?= $proyek->getRow()
    ->id_pkp ?>" role="tab"
                    aria-controls="info3" aria-selected="true" style="color:black"><strong>DATA UMUM & FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url() ?>proyek/edit_4/<?= $proyek->getRow()
    ->id_pkp ?>" role="tab"
                    aria-controls="info4" aria-selected="true" style="color:black"><strong>DATA TEKNIS</strong></a>
            </li>
        <?php }
 ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url() ?>proyek/edit_5/<?= $proyek->getRow()
    ->id_pkp ?>" role="tab"
                aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING DCR</strong></a>
        </li>

    </ul>

    <div class="tab-content" id="myTabContent">

        <!---MASALAH--->
        <div class="tab-pane active" id="info2" role="tabpanel" aria-labelledby="info2-tab">
            <div>
                <div class="d-flex flex-row pull-right">

                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if (
                                $proyek->getRow()->tgl_ubah_masalah > 0
                            ) { ?>
                            <b>
                                <?= date(
                                    'd-M-Y',
                                    strtotime(
                                        esc($proyek->getRow()->tgl_ubah_masalah)
                                    )
                                ) ?>
                                <?php } ?>
                            </b>
                        </h6>
                        <form action="" method="GET" class="ml-auto">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value="00">Tahun</option>
                                        <?php // Array sementara untuk menyimpan tahun yang sudah ditemukan
                                        $found_years = [];
                                        foreach ($option_tahun as $data):
                                            // Ambil tahun dari $data->tgl_ubah
                                            $tahun = date(
                                                'Y',
                                                strtotime($data->tgl_ubah)
                                            );
                                            $tahun2 = date(
                                                'Y',
                                                strtotime($data->tgl_ubah)
                                            ); // Periksa apakah tahun sudah ada di dalam array sementara
                                            if (
                                                !in_array($tahun, $found_years)
                                            ) {
                                                // Jika belum, tambahkan tahun ke dalam array dan tambahkan opsi ke select box
                                                $found_years[] = $tahun; ?>
                                        <option value="<?php echo $tahun2; ?>">
                                            <?php echo $tahun; ?>
                                        </option>
                                        <?php
                                            }
                                        endforeach;
                                        ?>
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
                        <?php if (
                            level_user('proyek', 'data', $kategoriQNS, 'add') >
                            0
                        ) { ?>
                            <div id="userbox" class="userbox">

                                <?php if (!$solusi || !$solusi2) { ?>
                                <a class="btn btn-success" data-toggle="modal" data-target="#tambahData"
                                    style="font-size: 12px;color:white"> UPD. MASALAH</a>
                                <?php } ?>
                                <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">EXPORT

                                </a>
                                <div class="dropdown-menu">
                                    <ul class="list-unstyled">
                                        <li class="divider"></li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/xls2/<?= $proyek->getRow()
    ->id_pkp ?>"
                                                target="_blank" style="font-size: 12px;color:black"> XLS</a>
                                        </li>
                                        <li>
                                            <a class="btn btn-info"
                                                href="<?= base_url() ?>proyek/pdf1/<?= $proyek->getRow()
    ->id_pkp ?>"
                                                style="font-size: 12px;color:black" target="_blank"> PDF</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                </div>

                <h4 class="card-subtitle" style="margin-bottom: 5px;font-size:15px">DATA PERMASALAHAN POKOK</h4>
                <div class="table-scrollable" style="height: 580px;width:100%">
                    <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped"
                        style="min-width: 1200px;">
                        <thead style="background-color:#1b3a59;color:white;">
                            <tr>
                                <th style="text-align:center;width: 3%">NO.</th>
                                <th style="text-align:center;width: 20%">NAMA KONTRAKTOR & PAKET</th>
                                <th style="text-align:center;width: 20%">URAIAN</th>
                                <th style="text-align:center;width: 20%">PENYEBAB</th>
                                <th style="text-align:center;width: 20%">DAMPAK</th>
                                <th style="text-align:center;width: 20%">TINDAK LANJUT/SOLUSI</th>
                                <th style="text-align:center;width: 10%">PIC</th>
                                <th style="text-align:center;width: 7%">TARGET</th>
                                <th style="text-align:center;width: 7%">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background-color: #FFEFD5;">
                                <td colspan="9"><b><strong>EKSTERNAL</strong></b></td>
                            </tr>
                            <?php
                            $noA = 1;
                            $noB = 1;
                            foreach ($solusi as $sol) {?>
                                <tr>
                                    <td style="text-align:left;width: 3%">
                                        <a class="btn btn-warning btn-lg" data-toggle="modal" data-target="#tambahLampiran" 
                                        data-lampiran="<?= $sol->lampiran; ?>" data-kode="<?= $sol->kode; ?>">
                                            <i class="fas fa-paperclip"></i>
                                        </a>
                                        <a class="btn btn-success btn-lg" data-toggle="modal" data-target="#editSolusi"><i class="fas fa-edit"></i></a>
                                    </td>
                                    <td style="text-align:left;width: 20%">
                                        
                                        <?= $sol->kode;?>
                                        <?= $sol->nama_kontraktor ?>
                                     <br>
                                     <b style="font-weight: 600;font-size:12px;"><?= $sol->nama_paket ?></b>
                                        
                                    </td>
                                    <td style="text-align:left;width: 20%">
                                        <?= $sol->masalah ?>
                                    </td>
                                    <td style="text-align:left;width: 20%">
                                        <?= $sol->penyebab ?>
                                    </td>
                                    <td style="text-align:left;width: 20%">
                                        <?= $sol->dampak ?>
                                    </td>
                                    <td style="text-align:left;width: 20%">
                                        <?= $sol->solusi ?>
                                    </td>
                                    <td style="text-align:left;width: 10%">
                                        <?= $sol->pic ?>
                                    </td>

                                    <td style="text-align:left;width: 5%">
                                        <?= $sol->target ?>
                                    </td>
                                    <td style="text-align:left;width: 5%">
                                    <?= $sol->status ?>
                                    </td>
                                </tr>
                                <?php }
                            ?>
                            <tr style="background-color: #FFEFD5;">
                                <td colspan="9"><b><strong>INTERNAL</strong></b></td>
                            </tr>
                            <?php
                            $nomor = 0;
                            foreach ($solusi2 as $sol2) { ?>
                                <tr>
                                    <td style="text-align:left;width: 5%">
                                        <?= $noB++ ?>
                                    </td>
                                    <td style="text-align:left;width: 25%">
                                     <?= $sol2->nama_kontraktor ?>
                                     <br>
                                     <b style="font-weight: 600;font-size:12px;"><?= $sol2->nama_paket ?></b>

                                    </td>
                                    <td style="text-align:left;width: 25%">
                                        <?= $sol2->masalah ?>
                                    </td>
                                    <td style="text-align:left;width: 25%">
                                        <?= $sol2->penyebab ?>
                                    </td>
                                    <td style="text-align:left;width: 25%">
                                        <?= $sol2->dampak ?>
                                    </td>
                                    <td style="text-align:left;width: 25%">
                                        <?= $sol2->solusi ?>
                                    </td>
                                    <td style="text-align:left;width: 25%">
                                        <?= $sol2->pic ?>
                                    </td>

                                    <td style="text-align:left;width: 25%">
                                        <?= $sol2->target ?>
                                    </td>
                                    <td style="text-align:left;width: 5%">
                                    <?= $sol2->status ?>
                                    <br>
                                    <div class="btn btn-warning btn-lg" data-toggle="modal" data-target="#tambahLampiran"><i class="fas fa-paperclip"></i></div>
                                    </td>
                                </tr>
                                <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- end: page -->
<!--TAMBAH LAMPIRAN-->
<div class="modal fade" id="tambahLampiran" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
        <section class="panel panel-primary">
                <?= form_open(base_url('proyek/lampiransolusitambah'), ['enctype' => 'multipart/form-data']); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Tambah/Perbaharui Lampiran</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mt-lg file1">
                                <label class="col-sm-3 control-label">FILE 1<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input type="hidden" name="id_pkp" value="<?= esc($proyek->getRow()->id_pkp); ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_kode" value="" class="form-control" required />

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
                <div class="table-responsive">
                                <table class="table table-bordered dataTable">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">
                                            <iframe src="" width="100%" height="600"></iframe>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
            </section>
        </div>
    </div>
</div>


<!--IMPORT SOLUSI-->
<div class="modal fade" id="tambahData" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?= form_open(
                    base_url('proyek/proses_upload_solusi'),
                    ' id="FormulirTambah" enctype="multipart/form-data"'
                ) ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Migrasi Permasalahan & Solusi</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp58" value="<?= esc(
                                        $proyek->getRow()->id_pkp
                                    ) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah" value="<?= session(
                                        'idadmin'
                                    ) ?>"
                                        class="form-control" required />
                                </div>
                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Format EXCEL ---></label>
                                <a style="font-size:12px;" class="btn btn-warning"
                                    href="<?= base_url() ?>excel/formatMIGmasalah.xlsx" target="_blank"><i
                                        class="fa fa-download"></i> Download Format</a>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button class="btn btn-primary modal-confirm" style="font-size: 12px;vertical-align: middle"
                                type="submit" id="submitform">Submit</button>
                            <button class="btn btn-default" style="font-size: 12px;vertical-align: middle"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </footer>
                </form>
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
        fetch(`<?= base_url(
            'proyek/get_bulan_msl'
        ) ?>?id_pkp=<?= $id_pkp ?>&tahun=${tahun}`)
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
    /* TAMBAH Progress */


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
                $('input[name=<?= csrf_token() ?>]').val(data.token);
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
                        Swal.fire({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            icon: 'error'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token() ?>]').val(data.token);
                PNotify.removeAll();
                document.getElementById("submitform").removeAttribute('disabled');
                $('#tambahData').modal('hide');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');

                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    icon: 'success'
                }).then(function () {
                    window.location.href = "<?= base_url() ?>proyek/edit_2/" + data.id_pkp;
                });
            }
        }).fail(function (data) {
            Swal.fire({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                icon: 'error'
            }).then(function () {
                location.reload();
            });
        });

        e.preventDefault();
    });

    $('#tambahLampiran').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Tombol yang diklik
        var lampiranUrl = button.data('lampiran'); // Dapatkan data lampiran dari tombol
        var kode = button.data('kode'); // Dapatkan data kode dari tombol

        // Set nilai ke input hidden
        var modal = $(this);
        modal.find('input[name="id_kode"]').val(kode); // Set input id_kode
        modal.find('iframe').attr('src', lampiranUrl ? '<?= base_url(); ?>' + lampiranUrl : ''); // Set src iframe jika ada lampiran
    });

    /* TAMBAH LAMPIRAN */
    document.getElementById("FormulirTambahLampiran").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group').removeClass('has-error');
        document.getElementById("submitformlampiran").setAttribute('disabled', 'disabled');
        $('#submitformlampiran').html('Loading ...');
        var form = $('#FormulirTambahLampiran')[0];
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
                document.getElementById("submitformlampiran").removeAttribute('disabled');
                $('#submitformlampiran').html('Submit');
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
                document.getElementById("submitformlampiran").removeAttribute('disabled');
                $('#tambahDataDTU').modal('hide');
                document.getElementById("FormulirTambahLampiran").reset();
                $('#submitformlampiran').html('Submit');
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



<?= $this->endSection() ?>
