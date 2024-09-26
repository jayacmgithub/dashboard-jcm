<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="<?php echo base_url() ?>" class="logo">
            <img src="<?php echo base_url() ?>assets/images/<?php echo $this->db->get_where('profil_apotek', array('id' => '1'), 1)->row()->logo; ?>" style="display: block;" height="32" alt="Logo">
            <?php
            $id = $this->session->userdata('idadmin');
            $tes0 = $this->db->from("master_admin")->where('id', $id, 1)->get()->row();
            $tes1 = $this->db->select("b.alias, b.no_pkp, c.nomor")->from("master_admin a")->join('master_pkp b', 'a.pkp_user = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->join('kategori_user d', 'a.kategori_user = d.id')->where('a.id', $id, 1)->get();
            $tes2 = $this->db->select("b.alias, b.no_pkp, c.nomor, a.nama_admin, d.kategori_user")->from("master_admin a")->join('master_pkp b', 'a.pkp_user = b.id_pkp')->join('master_instansi c', 'b.id_instansi = c.id')->join('kategori_user d', 'a.kategori_user = d.id')->where('a.id', $id, 1)->get()->row();
            ?>
        </a>

        <div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="header-right">
        <h4 style="margin-top:15px;margin-right:30px;text-shadow: 1px 1px 1px grey;color:white"><?php echo $judul ?></h4>
    </div>
    <br>
    <!-- end: search & user box -->
</header>
<!-- end: header -->