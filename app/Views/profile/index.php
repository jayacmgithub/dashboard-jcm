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


                                    <li>
                                        <a href="<?= base_url() ?>profil/password" class="menu-item"><i
                                                class="fa fa-folder"></i> UBAH PASSWORD</a>
                                        <div class="item-options">
                                            <a href="<?= base_url() ?>profil/password">
                                                <i class="fa fa-arrow-circle-o-left"></i>
                                            </a>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="<?= base_url() ?>profil/user" class="menu-item"><i
                                                class="fa fa-folder"></i> USER</a>
                                        <div class="item-options">
                                            <a href="<?= base_url() ?>profil/user">
                                                <i class="fa fa-arrow-circle-o-left"></i>
                                            </a>
                                        </div>
                                    </li>

                                    <li>
                                        <a href="<?= base_url() ?>logout" class="menu-item"><i class="fa fa-folder"></i>
                                            KELUAR</a>
                                        <div class="item-options">
                                            <a href="<?= base_url() ?>logout">
                                                <i class="fa fa-arrow-circle-o-left"></i>
                                            </a>
                                        </div>
                                    </li>



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
        url: '<?= base_url() ?>dashboard/produk_kadaluarsa',
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
        url: '<?= base_url() ?>dashboard/produk_terlaris',
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