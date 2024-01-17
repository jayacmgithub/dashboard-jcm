<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
    <div class="content-with-menu-container">
        <div class="inner-menu-toggle">
            <a href="#" class="inner-menu-expand" data-open="inner-menu">
                Show Bar <i class="fa fa-chevron-right"></i>
            </a>
        </div>
        <menu id="content-menu" class="inner-menu" role="menu">
            <div class="nano">
                <div class="nano-content">

                    <div class="inner-menu-toggle-inside">
                        <a href="#" class="inner-menu-collapse">
                            <i class="fa fa-chevron-up visible-xs-inline"></i><i
                                class="fa fa-chevron-left hidden-xs-inline"></i> Hide Bar
                        </a>
                        <a href="#" class="inner-menu-expand" data-open="inner-menu">
                            Show Bar <i class="fa fa-chevron-down"></i>
                        </a>
                    </div>

                    <div class="inner-menu-content">

                        <div class="sidebar-widget m-none">
                            <div class="widget-content">
                                <ul class="mg-folders">
                                    <?php
                                    $setV = level_user('setting', 'instansi', $kategori, 'read');
                                    if ($setV > 0) { ?>
                                        <li>
                                            <a href="<?php echo base_url() ?>setting/instansi" class="menu-item"><i
                                                    class="fa fa-folder"></i> Manajemen Instansi</a>
                                            <div class="item-options">
                                                <a href="<?php echo base_url() ?>setting/instansi">
                                                    <i class="fa fa-arrow-circle-o-left"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    $setV = level_user('setting', 'pkp', $kategori, 'read');
                                    if ($setV > 0) { ?>
                                        <li>
                                            <a href="<?php echo base_url() ?>setting/pkp" class="menu-item"><i
                                                    class="fa fa-folder"></i> Manajemen PKP</a>
                                            <div class="item-options">
                                                <a href="<?php echo base_url() ?>setting/pkp">
                                                    <i class="fa fa-arrow-circle-o-left"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>
                                    <?php
                                    $setVa = level_user('setting', 'kategori', $kategori, 'read');
                                    if ($setVa > 0) { ?>
                                        <li>
                                            <a href="<?php echo base_url() ?>setting/jabatan" class="menu-item"><i
                                                    class="fa fa-folder"></i> Manajemen Jabatan</a>
                                            <div class="item-options">
                                                <a href="<?php echo base_url() ?>setting/jabatan">
                                                    <i class="fa fa-arrow-circle-o-left"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>

                                    <?php
                                    $setV = level_user('setting', 'user', $kategori, 'read');
                                    if ($setV > 0) { ?>
                                        <li>
                                            <a href="<?php echo base_url() ?>setting/user" class="menu-item"><i
                                                    class="fa fa-folder"></i> Manajemen User</a>
                                            <div class="item-options">
                                                <a href="<?php echo base_url() ?>setting/user">
                                                    <i class="fa fa-arrow-circle-o-left"></i>
                                                </a>
                                            </div>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </menu>
        <!--
        <div class="inner-body mg-main">
            <div class="row" style="margin-top:-30px;">
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="row">

                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-university"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Jumlah Instansi</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $total_instansi; ?> Bagian</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <section class="panel panel-featured-left panel-featured-primary">
                                <div class="panel-body">
                                    <div class="widget-summary">
                                        <div class="widget-summary-col widget-summary-col-icon">
                                            <div class="summary-icon bg-primary">
                                                <i class="fa fa-university"></i>
                                            </div>
                                        </div>
                                        <div class="widget-summary-col">
                                            <div class="summary">
                                                <h4 class="title">Jumlah PKP</h4>
                                                <div class="info">
                                                    <strong class="amount"><?php echo $total_pkp; ?> Bagian</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>

                    </div>
                </div>
            </div>


        </div>
                                    -->
    </div>
</section>
<!-- end: page -->
<?= $this->include('layout/js') ?>

<script>
    $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>dashboard/produk_kadaluarsa',
        dataType: 'json',
        success: function (response) {
            var i = 0;
            var datarow = '';
            $.each(response.datasub, function (i, itemsub) {
                i = i + 1;
                datarow += "<tr><td>" + i + "</td>";
                datarow += "<td>" + itemsub.kode_item + "</td>";
                datarow += "<td>" + itemsub.nama_item + "</td>";
                datarow += "<td>" + itemsub.tgl_expired + "</td>";
                datarow += "</tr>";
            });
            if (datarow == '') {
                $('#kadaluarsa').append('<tr><td colspan="4" align="center"> Tidak ada produk akan kadaluarsa</td></tr>');
            } else {
                $('#kadaluarsa').append(datarow);
            }
        }
    });

    $.ajax({
        type: 'GET',
        url: '<?php echo base_url() ?>dashboard/produk_terlaris',
        dataType: 'json',
        success: function (response) {
            var i = 0;
            var datarow = '';
            $.each(response.datasub, function (i, itemsub) {
                i = i + 1;
                datarow += "<tr><td>" + i + "</td>";
                datarow += "<td>" + itemsub.kode_item + "</td>";
                datarow += "<td>" + itemsub.nama_item + "</td>";
                datarow += "<td>" + itemsub.total + "</td>";
                datarow += "</tr>";
            });
            if (datarow == '') {
                $('#produk_terlaris').append('<tr><td colspan="4" align="center"> Tidak ada produk data</td></tr>');
            } else {
                $('#produk_terlaris').append(datarow);
            }
        }
    });
</script>

</body>

</html>
<?= $this->endSection() ?>