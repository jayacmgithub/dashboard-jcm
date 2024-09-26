<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PROYEK GEDUNG 3</h2>
            </div>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped" id="gd3data">
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
    var tableitems = $('#gd3data').DataTable({
        "serverSide": true,
        "order": [],
        "ajax": {
            "url": "<?php echo base_url() ?>proyek/datagd3",
            "type": "POST"
        },


    });
</script>
<?= $this->endSection() ?>