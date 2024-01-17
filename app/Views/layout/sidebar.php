<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">

<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">
    <?php
    $id = $this->session->userdata('idadmin');
    $sambung = $this->db->from("master_admin")->where('id', $id, 1)->get()->row();
    $kategori = $sambung->kategori_user;
    ?>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">
                <ul class="nav nav-main">
                    <?php if ($kode == '01') { ?>
                        <li style="background-color:white;border-radius: 35px 0 0 35px">
                            <a href="<?php echo base_url() ?>">
                                <p class="fa fa-home fa-2x" style="text-align:center;color:black"></p>
                                <p style="text-align:center; text-indent:-35%; line-height:1px;color:black"><b>HOME</b></p>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url() ?>">
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
                                <a href="<?php echo base_url() ?>proyek">
                                    <p class="fa fa-calendar fa-2x" style="text-align:center;color:black"></p>
                                    <p style="text-align:center; text-indent:-55%; line-height:1px;color:black"><b>PROYEK</b></p>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url() ?>proyek">
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
                                <a href="<?php echo base_url() ?>laporan">
                                    <p class="fa fa-book fa-2x" style="text-indent:-5%;color:black"></p>
                                    <p style="text-align:center; text-indent:-40%; line-height:1px;color:black">DATA</p>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url() ?>laporan">
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
                                <a href="<?php echo base_url() ?>setting">
                                    <p class="fa fa-cog fa-2x" style="text-indent:-5%;color:black"></p>
                                    <p style="text-align:center; text-indent:-60%; line-height:1px;color:black"><b>SETTING</b></p>

                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url() ?>setting">
                                    <p class="fa fa-cog fa-2x" style="text-indent:-5%;"></p>
                                    <p style="text-align:center; text-indent:-60%; line-height:1px;">SETTING</p>

                                </a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <?php if ($kode == '05') { ?>
                        <li style="background-color:white;border-radius:35px 0 0 35px">
                            <a href="<?php echo base_url() ?>profil">
                                <p class="fa fa-user fa-2x" style="text-indent:-5%;color:black"></p>
                                <p style="text-align:center; text-indent:-60%; line-height:1px;color:black"><b>PROFIL</b></p>
                            </a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a href="<?php echo base_url() ?>profil">
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
                                <a href="<?php echo base_url() ?>log">
                                    <i class="fa fa-exclamation-circle" aria-hidden="true" style="color:white"></i>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo base_url() ?>log">
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
<!-- end: sidebar -->