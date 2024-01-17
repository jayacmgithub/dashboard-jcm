<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PROYEK KTL</h2>
            </div>
    </header>
    <div class="panel-body">
        <div class="panel-body">
            <table class="table table-bordered table-striped" id="example">
                <thead>
                    <tr>
                        <th>INS/PKP</th>
                        <th>Nama Sesuai Kontrak</th>
                        <th>Nama Alias</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($ktl1 as $ktl1) {
                        ?>
                        <tr>
                            <td>
                                <?php
                                if (esc($ktl1->tgl_ubah_progress) > 0) {
                                    echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($ktl1->id_pkp) . '" > ' . esc($ktl1->nomor) . '/' . esc($ktl1->no_pkp) . '</a></strong>';
                                } else {
                                    echo '<strong><center><a>' . esc($ktl1->nomor) . '/' . esc($ktl1->no_pkp) . '</a></strong>';
                                }
                                ?>
                            </td>

                            <td>
                                <?= $ktl1->proyek; ?>
                            </td>
                            <td>
                                <?= $ktl1->alias; ?>
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