<?php $this->load->view("komponen/atas.php") ?>
<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">
<?php
$idQNS = $this->session->userdata('idadmin');
$isi = $this->db->from("master_admin")->where('id', $idQNS, 1)->get()->row();
$kategoriQNS = $isi->kategori_user;
?>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PROYEK TRANSPORTASI 2</h2>
            </div>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped" id="gd1data">
            <thead>
                <tr>
                    <th>INS/PKP</th>
                    <th>Nama Sesuai Kontrak</th>
                    <th>Nama Alias</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
<script type="text/javascript">
    var tableitems = $('#gd1data').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>proyek/datatrans2",
            "type": "GET"
        },


    });
</script>
</body>

</html>