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
                foreach ($gedung3 as $gdg3) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (esc($gdg3->tgl_ubah_progress) > 0) {
                                echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($gdg3->id_pkp) . '" > ' . esc($gdg3->nomor) . '/' . esc($gdg3->no_pkp) . '</a></strong>';
                            } else {
                                echo '<strong><center><a>' . esc($gdg3->nomor) . '/' . esc($gdg3->no_pkp) . '</a></strong>';
                            }
                            ?>
                        </td>

                        <td>
                            <?= $gdg3->proyek; ?>
                        </td>
                        <td>
                            <?= $gdg3->alias; ?>
                        </td>
                    <?php } ?>

                </tr>
            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
</body>

</html>
<?= $this->endSection() ?>