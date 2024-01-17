<!doctype html>
<html class="fixed sidebar-left-collapsed">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico" type="image/ico">
    <title>Project Summary Dashboard</title>
    <meta name="author" content="Paber">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/select2/select2.css" />
    <!-- DataTables CSS CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.css">


    <!-- DataTables JS CDN -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" href="<?= base_url() ?>/assets/stylesheets/theme.css" />

    <link rel="stylesheet" href="<?= base_url() ?>/assets/stylesheets/skins/default.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/stylesheets/theme-custom.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/pnotify/pnotify.custom.css" />
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/magiczoom/magiczoom.css" />
    <link href="<?= base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">
    <!-- Head Libs -->
    <script src="<?= base_url() ?>/assets/vendor/modernizr/modernizr.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">



    <!--<link href="<?= base_url() ?>/assets/vendor/node_modules/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/dist/css/pages/progressbar-page.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/node_modules/footable/css/footable.core.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/assets/vendor/dist/css/pages/footable-page.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/dist/css/pages/contact-app-page.css" rel="stylesheet">

    <link href="<?= base_url() ?>/assets/vendor/node_modules/morrisjs/morris.css" rel="stylesheet">

    <link href="<?= base_url() ?>/assets/vendor/node_modules/toast-master/css/jquery.toast.css" rel="stylesheet">
    
    <link href="<?= base_url() ?>/assets/vendor/dist/css/pages/stylish-tooltip.css" rel="stylesheet">
    <link href="<?= base_url() ?>/assets/vendor/dist/css/pages/login-register-lock.css" rel="stylesheet">
-->

</head>


<body class="bgbody">
    <section class="body mt-5">
        <!-- start: header -->
        <header class="header">
            <div class="logo-container">
                <a href="<?= base_url() ?>" class="logo">
                    <img src="<?= base_url() ?>assets/component-images/logo.png" style="display: block; margin: auto;"
                        height="32" alt="Logo">
                </a>

                <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html"
                    data-fire-event="sidebar-left-opened">
                    <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
                </div>
            </div>

            <div class="header-right">
                <h4 style="margin-top:15px;margin-right:30px;text-shadow: 1px 1px 1px grey;color:white">
                    <?= $judul ?>
                </h4>
            </div>
            <br>
            <!-- end: search & user box -->
        </header>


        <!-- start: sidebar -->
        <aside id="sidebar-left" class="sidebar-left">
            <div class="nano">
                <div class="nano-content">
                    <nav id="menu" class="nav-main" role="navigation">
                        <ul class="nav nav-main">
                            <?php if ($kode == '01') { ?>
                                <li style="background-color:white;border-radius: 35px 0 0 35px">
                                    <a href="<?= base_url() ?>dashboard/index">
                                        <p class="fa fa-home fa-2x" style="text-align:center;color:black"></p>
                                        <p style="text-align:center; text-indent:-35%; line-height:1px;color:black">
                                            <b>HOME</b>
                                        </p>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?= base_url() ?>dashboard/index">
                                        <p class="fa fa-home fa-2x" style="text-align:center;"></p>
                                        <p style="text-align:center; text-indent:-35%; line-height:1px;">HOME</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php
                            $setV = level_user('proyek', 'data', $kategori, 'read');
                            if ($setV > 0) { ?>
                                <?php if ($kode == '02') { ?>
                                    <li style="background-color:white;border-radius: 35px 0 0 35px">
                                        <a href="<?= base_url() ?>proyek">
                                            <p class="fa fa-calendar fa-2x" style="text-align:center;color:black"></p>
                                            <p style="text-align:center; text-indent:-55%; line-height:1px;color:black">
                                                <b>PROYEK</b>
                                            </p>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?= base_url() ?>proyek">
                                            <p class="fa fa-calendar fa-2x" style="text-align:center;"></p>
                                            <p style="text-align:center; text-indent:-55%; line-height:1px;">PROYEK</p>
                                        </a>
                                    </li>

                                <?php } ?>
                                <?php
                            } ?>

                            <?php
                            if (level_user('data', 'hcm', $kategori, 'read') > 0 or level_user('data', 'marketing', $kategori, 'read') > 0 or level_user('qs', 'index', $kategori, 'read') > 0) { ?>
                                <?php if ($kode == '03') { ?>
                                    <li style="background-color:white;border-radius: 35px 0 0 35px">
                                        <a href="<?= base_url() ?>laporan">
                                            <p class="fa fa-book fa-2x" style="text-indent:-5%;color:black"></p>
                                            <p style="text-align:center; text-indent:-40%; line-height:1px;color:black">DATA</p>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?= base_url() ?>laporan">
                                            <p class="fa fa-book fa-2x" style="text-indent:-5%;"></p>
                                            <p style="text-align:center; text-indent:-40%; line-height:1px;">DATA</p>

                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>

                            <?php
                            $setV = level_user('setting', 'index', $kategori, 'read');
                            if ($setV > 0) { ?>
                                <?php if ($kode == '04') { ?>
                                    <li style="background-color:white;border-radius: 35px 0 0 35px">
                                        <a href="<?= base_url() ?>setting">
                                            <p class="fa fa-cog fa-2x" style="text-indent:-5%;color:black"></p>
                                            <p style="text-align:center; text-indent:-60%; line-height:1px;color:black">
                                                <b>SETTING</b>
                                            </p>

                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?= base_url() ?>setting">
                                            <p class="fa fa-cog fa-2x" style="text-indent:-5%;"></p>
                                            <p style="text-align:center; text-indent:-60%; line-height:1px;">SETTING</p>

                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($kode == '05') { ?>
                                <li style="background-color:white;border-radius:35px 0 0 35px">
                                    <a href="<?= base_url() ?>profil">
                                        <p class="fa fa-user fa-2x" style="text-indent:-5%;color:black"></p>
                                        <p style="text-align:center; text-indent:-60%; line-height:1px;color:black">
                                            <b>PROFIL</b>
                                        </p>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="<?= base_url() ?>profil">
                                        <p class="fa fa-user fa-2x" style="text-indent:-5%;"></p>
                                        <p style="text-align:center; text-indent:-60%; line-height:1px;">PROFIL</p>
                                    </a>
                                </li>
                            <?php } ?>
                            <?php
                            $setV = level_user('log', 'index', $kategori, 'read');
                            if ($setV > 0) { ?>
                                <?php if ($kode == '06') { ?>
                                    <li style="background-color:grey;">
                                        <a href="<?= base_url() ?>log">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:white"></i>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="<?= base_url() ?>log">
                                            <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                        </a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </nav>

                    <hr class="separator" />

                </div>

            </div>

        </aside>
        <div class="container"></div>
        <section role="main" class="content-body mt-5">
            <?= $this->renderSection('content') ?>
        </section>


        <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable();
                responsive: true
            });
        </script>

        <script type="text/javascript">
            $(".table-scrollable").freezeTable({
                'scrollable': true,
                'columnNum': 3,
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

                <?php if (session()->has("success")) { ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?= session("success") ?>'
                    })
                <?php } ?>

                <?php if (session()->has("error")) { ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '<?= session("error") ?>'
                    })
                <?php } ?>
            });


            $(document).ready(function () { // Ketika halaman selesai di load
                setDatePicker() // Panggil fungsi setDatePicker

                $('#form-filter, #form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
                $('#filter1').change(function () { // Ketika user memilih filter
                    if ($(this).val() != '') {
                        $('#form-filter').show();
                    } else {
                        $('#form-filter, #form-tanggal, #form-bulan, #form-tahun').hide();
                    }

                })
                $('#filter2').change(function () { // Ketika user memilih filter
                    if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                        $('#form-tahun').hide(); // Sembunyikan form bulan dan tahun
                        $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
                    } else { // Jika filternya 3 (per tahun)
                        $('#form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                        $('#form-tahun').show(); // Tampilkan form tahun
                    }

                    $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
                })

            })

            function setDatePicker() {
                $(".datepicker").datepicker({
                    format: "dd-mm-yyyy",
                    todayHighlight: true,
                    autoclose: true
                }).attr("readonly", "readonly").css({
                    "cursor": "pointer",
                    "background": "white"
                });
            }
            $('.tanggal').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true,
            });
        </script>
</body>

</html>