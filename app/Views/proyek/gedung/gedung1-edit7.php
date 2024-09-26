<?php $this->load->view("komponen/atas.php") ?>

<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">

<?php
$idQNS = $this->session->userdata('idadmin');
$isi = $this->db->from("master_admin")->where('id', $idQNS, 1)->get()->row();
$kategoriQNS = $isi->kategori_user;
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<!-- start: page -->
<section class="panel">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_1/<?php echo $proyek->row()->id_pkp ?>"
                role="tab" aria-controls="info1" aria-selected="true" style="color:black"><strong>PROGRESS</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_2/<?php echo $proyek->row()->id_pkp ?>"
                    role="tab" aria-controls="info2" aria-selected="true"
                    style="color:black"><strong>PERMASALAHAN</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_6/<?php echo $proyek->row()->id_pkp ?>"
                role="tab" aria-controls="info6" aria-selected="true" style="color:black"><strong>MONTORING
                    KARYAWAN</strong></a>
        </li>

        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_3/<?php echo $proyek->row()->id_pkp ?>"
                    role="tab" aria-controls="info3" aria-selected="true" style="color:black"><strong>DATA UMUM &
                        FOTO</strong></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_4/<?php echo $proyek->row()->id_pkp ?>"
                    role="tab" aria-controls="info4" aria-selected="true" style="color:black"><strong>DATA
                        TEKNIS</strong></a>
            </li>
        <?php } ?>
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url() ?>proyek/edit_5/<?php echo $proyek->row()->id_pkp ?>"
                role="tab" aria-controls="info5" aria-selected="true" style="color:black"><strong>MONITORING
                    DCR</strong></a>
        </li>
        <?php
        if ($nomorQN != '412') {
            ?>
            <li class="nav-item">
                <a class="nav-link active" href="<?php echo base_url() ?>proyek/edit_7/<?php echo $proyek->row()->id_pkp ?>"
                    role="tab" aria-controls="info7" aria-selected="true"
                    style="color:black"><strong>INVENTARIS</strong></a>
            </li>
        <?php } ?>

    </ul>

    <div class="tab-content" id="myTabContent">
        <!---MASALAH--->
        <div class="tab-pane active" id="info2" role="tabpanel" aria-labelledby="info2-tab">
            <div>
                <div class="d-flex flex-row pull-right">

                    <div class="m-l-10 align-self-center">
                        <h6 class="text-muted m-b-0">Diperbaharui :
                            <?php if ($proyek->row()->tgl_ubah_inventaris > 0) { ?>
                            <b>
                                <?php echo (date('d-M-Y', strtotime($this->security->xss_clean($proyek->row()->tgl_ubah_inventaris)))) ?>
                                <?php } ?>
                            </b>
                        </h6>
                        <?php
                        if (level_user('proyek', 'data', $kategoriQNS, 'add') > 0) {
                            ?>
                        <div id="userbox" class="userbox">
                            <a class="btn btn-success" data-toggle="modal" data-target="#tambahData"
                                style="font-size: 12px;color:white"> UPD. INVENTARIS</a>

                            <a class="btn btn-info" data-toggle="dropdown" style="font-size: 12px;color:black">EXPORT

                            </a>
                            <div class="dropdown-menu">
                                <ul class="list-unstyled">
                                    <li class="divider"></li>
                                    <li>
                                        <a class="btn btn-info"
                                            href="<?php echo base_url() ?>proyek/xls2/<?php echo $proyek->row()->id_pkp ?>"
                                            target="_blank" style="font-size: 12px;color:black"> XLS</a>
                                    </li>
                                    <li>
                                        <a class="btn btn-info"
                                            href="<?php echo base_url() ?>proyek/pdf1/<?php echo $proyek->row()->id_pkp ?>"
                                            style="font-size: 12px;color:black" target="_blank"> PDF</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>

                    </div>

                </div>
            </div>
            <span class=" card-subtitle" style="margin-bottom: 5px">LAPORAN BULANAN BARANG INVENTARIS PERUSAHAAN</span>
            <br>
            <b><span style="font-size: 13px;">Periode:
                    <?php echo ' 20' . $tahun . '-' . $bulan ?>
                </span></b>

            <div class="table-scrollable" style="height: 450px;width:100%">
                <table cellspacing="0" id="table-basic" class="table table-sm table-bordered table-striped"
                    style="min-width: 1200px;">
                    <thead style="background-color:#1b3a59;color:white;">
                        <tr>
                            <th style="text-align:center;vertical-align:middle;width:3%;font-size:12px" rowspan="2">NO.
                            </th>
                            <th style="text-align:center;vertical-align:middle;width:7%;font-size:12px" rowspan="2">KODE
                                BARANG / <br> SERIAL NUMBER</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px" rowspan="2">
                                STATUS</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px" rowspan="2">
                                JENIS BARANG / <br> INVENTARIS</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px" rowspan="2">
                                MERK</th>
                            <th style="text-align:center;vertical-align:middle;width:20%;font-size:12px" rowspan="2">
                                TYPE / <br> SPESIFIKASI</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px" rowspan="2">
                                KONDISI</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px" rowspan="2">
                                PEMAKAI</th>
                            <th style="text-align:center;vertical-align:middle;width:10%;font-size:12px" rowspan="2">
                                photo</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr style="background-color: #FFEFD5;">
                            <td colspan="9"><b><strong>KOMPUTER / AKSESORIS</strong></b></td>
                        </tr>
                        <?php
                        $noA = 1;
                        $noB = 1;
                        $noC = 1;
                        foreach ($invent1 as $inv1) { ?>
                        <tr>
                            <td style="text-align:left;">
                                <?php echo $noA++ ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->sn ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->status ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->jns_brng ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->merek ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->spek ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->kondisi ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->pemakai ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv1->foto ?>
                            </td>
                        </tr>
                        <?php
                        } ?>
                        <tr style="background-color: #FFEFD5;">
                            <td colspan="9"><b><strong>FURNITURE</strong></b></td>
                        </tr>
                        <?php
                        foreach ($invent2 as $inv2) {
                            ?>
                        <tr>
                            <td style="text-align:left;">
                                <?php echo $noB++ ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->sn ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->status ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->jns_brng ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->merek ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->spek ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->kondisi ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->pemakai ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv2->foto ?>
                            </td>
                        </tr>
                        <tr style="background-color: #FFEFD5;">
                            <td colspan="9"><b><strong>FURNITURE</strong></b></td>
                        </tr>
                        <?php
                        } ?>
                        <?php
                        foreach ($invent3 as $inv3) {
                            ?>
                        <tr>
                            <td style="text-align:left;">
                                <?php echo $noC++ ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->sn ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->status ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->jns_brng ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->merek ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->spek ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->kondisi ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->pemakai ?>
                            </td>
                            <td style="text-align:left;">
                                <?php echo $inv3->foto ?>
                            </td>
                        </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- end: page -->
<?php $this->load->view("komponen/bawah.php") ?>

<!--IMPORT INVENTARIS-->
<div class="modal fade" id="tambahData" tabindex="1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <section class="panel panel-primary">
                <?php echo form_open('proyek/proses_upload_inventaris', ' id="FormulirTambah"'); ?>
                <header class="panel-heading">
                    <h2 class="panel-title">Import Laporan Inventaris</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Upload File Excel</label>
                                <div class="col-sm-9">
                                    <input type="file" name="excelfile" class="form-control" required />
                                    <input type="hidden" name="id_pkp58"
                                        value="<?php echo $this->security->xss_clean($proyek->row()->id_pkp) ?>"
                                        class="form-control" required />
                                    <input type="hidden" name="id_ubah"
                                        value="<?php echo $this->session->userdata('idadmin'); ?>" class="form-control"
                                        required />
                                </div>
                            </div>
                            <div class="form-group excelfile">
                                <label class="col-sm-3 control-label">Format EXCEL ---></label>
                                <a style="font-size:12px;" class="btn btn-warning"
                                    href="<?php echo base_url() ?>excel/formatLPInventaris.xlsx" target="_blank"><i
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
<!-- JS -->
<?= $this->include('layout/js') ?>

<script type="text/javascript">
    $(".table-scrollable").freezeTable({
        'scrollable': true,
        'columnNum': 3,
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

    document.getElementById("FormulirTambah").addEventListener("submit", function (e) {
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
                document.getElementById("submitform").removeAttribute('disabled');
                $('#tambahData').modal('hide');
                document.getElementById("FormulirTambah").reset();
                $('#submitform').html('Submit');
                new PNotify({
                    title: 'Notifikasi',
                    text: data.message,
                    type: 'success'
                });
                window.setTimeout(function () {
                    window.location.href = "<?php echo base_url() ?>proyek/edit_7/" + data.id_pkp
                }, 2000);
            }
        }).fail(function (data) {
            console.log("Data yang diterima dari server dalam kasus kegagalan:", data);
            new PNotify({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload ",
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
