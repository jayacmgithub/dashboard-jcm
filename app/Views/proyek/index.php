<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>
<!-- start: page -->
<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
    <div class=" content-with-menu-container">
        <div class=" inner-menu-toggle">
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
                                    if (level_user('proyek', 'data', $kategoriQNS, 'read') > 0) {
                                        if (level_user('proyek', 'data', $kategoriQNS, 'all') > 0) {
                                            ?>

                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/gedung1" class="menu-item"><i
                                                        class="fa fa-folder"></i> GEDUNG 1</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/gedung1">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/gedung2" class="menu-item"><i
                                                        class="fa fa-folder"></i> GEDUNG 2</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/gedung2">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/gedung3" class="menu-item"><i
                                                        class="fa fa-folder"></i> GEDUNG 3</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/gedung3">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/ktl" class="menu-item"><i
                                                        class="fa fa-folder"></i> KTL 1</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/ktl">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/ktl2" class="menu-item"><i
                                                        class="fa fa-folder"></i> KTL 2</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/ktl2">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/transportasi" class="menu-item"><i
                                                        class="fa fa-folder"></i> TRANSPORTASI 1</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/transportasi">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/transportasi2" class="menu-item"><i
                                                        class="fa fa-folder"></i> TRANSPORTASI 2</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/transportasi2">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/kantor" class="menu-item"><i
                                                        class="fa fa-folder"></i> KANTOR</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/kantor">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="<?php echo base_url() ?>proyek/all" class="menu-item"><i
                                                        class="fa fa-folder"></i> SEMUA PROYEK</a>
                                                <div class="item-options">
                                                    <a href="<?php echo base_url() ?>proyek/all">
                                                        <i class="fa fa-arrow-circle-o-left"></i>
                                                    </a>
                                                </div>
                                            </li>
                                        <?php } else {
                                            if ((level_user('proyek', 'data', $kategoriQNS, 'divisi') > 0) or (level_user('proyek', 'data', $kategoriQNS, 'proyek') > 0)) {
                                                if ($no_divisi == '511') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/gedung1" class="menu-item"><i
                                                                class="fa fa-folder"></i> GEDUNG 1</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/gedung1">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>

                                                <?php }
                                                if ($no_divisi == '512') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/gedung2" class="menu-item"><i
                                                                class="fa fa-folder"></i> GEDUNG 2</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/gedung2">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>

                                                <?php }
                                                if ($no_divisi == '611') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/ktl" class="menu-item"><i
                                                                class="fa fa-folder"></i> KTL 1</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/ktl">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php }
                                                if ($no_divisi == '612') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/ktl2" class="menu-item"><i
                                                                class="fa fa-folder"></i> KTL 2</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/ktl2">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php }
                                                if ($no_divisi == '711') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/transportasi" class="menu-item"><i
                                                                class="fa fa-folder"></i> TRANSPORTASI 1</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/transportasi">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php }

                                                if ($no_divisi == '712') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/transportasi2" class="menu-item"><i
                                                                class="fa fa-folder"></i> TRANSPORTASI 2</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/transportasi2">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php }
                                                if ($no_pkp == '000') { ?>
                                                    <li>
                                                        <a href="<?php echo base_url() ?>proyek/kantor" class="menu-item"><i
                                                                class="fa fa-folder"></i> KANTOR</a>
                                                        <div class="item-options">
                                                            <a href="<?php echo base_url() ?>proyek/kantor">
                                                                <i class="fa fa-arrow-circle-o-left"></i>
                                                            </a>
                                                        </div>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>


                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </menu>
</section>
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

<?= $this->endSection(); ?>