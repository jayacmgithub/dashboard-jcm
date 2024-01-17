<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PKP DI LUAR PROYEK</h2>
            </div>
    </header>
    <div class="panel-body">
        <table class="table table-bordered table-hover table-striped" id="example">
            <thead>
                <tr>
                    <th>INS/PKP</th>
                    <th>Nama Sesuai Kontrak</th>
                    <th>Nama Alias</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($kantor as $kantor) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (esc($kantor->tgl_ubah_progress) > 0) {
                                echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($kantor->id_pkp) . '" > ' . esc($kantor->nomor) . '/' . esc($kantor->no_pkp) . '</a></strong>';
                            } else {
                                echo '<strong><center><a>' . esc($kantor->nomor) . '/' . esc($kantor->no_pkp) . '</a></strong>';
                            }
                            ?>
                        </td>

                        <td>
                            <?= $kantor->proyek; ?>
                        </td>
                        <td>
                            <?= $kantor->alias; ?>
                        </td>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
</body>

</html>
<?= $this->endSection() ?>