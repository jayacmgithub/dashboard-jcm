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

                        <nav id="sidebar">

                            <ul class="mg-folders">
                                <?php
                                if (level_user('data', 'hcm', $kategori, 'read') > 0) {
                                    ?>
                                    <li>
                                        <a href="<?= base_url() ?>laporan/hcm" class="menu-item"><i
                                                class="fa fa-folder"></i> HCM</a>
                                        <div class="item-options">
                                            <a href="<?= base_url() ?>laporan/hcm">
                                                <i class="fa fa-arrow-circle-o-left"></i>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php
                                if (level_user('data', 'marketing', $kategori, 'read') > 0) {
                                    ?>
                                    <li>
                                        <a href="<?= base_url() ?>laporan/mkt" class="menu-item"><i
                                                class="fa fa-folder"></i> MARKETING</a>
                                        <div class="item-options">
                                            <a href="<?= base_url() ?>laporan/marketing">
                                                <i class="fa fa-arrow-circle-o-left"></i>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                                <?php
                                if (level_user('qs', 'index', $kategori, 'read') > 0) {
                                    ?>
                                    <li>
                                        <a href="<?= base_url() ?>laporan/qs" class="menu-item"><i class="fa fa-folder"></i>
                                            QS</a>
                                        <div class="item-options">
                                            <a href="<?= base_url() ?>laporan/marketing">
                                                <i class="fa fa-arrow-circle-o-left"></i>
                                            </a>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>

                        </nav>

                    </div>
                </div>
            </div>
        </menu>

</section>
<?= $this->include('layout/js') ?>
</body>

</html>
<?= $this->endSection() ?>