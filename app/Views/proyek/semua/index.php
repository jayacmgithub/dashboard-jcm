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
                foreach ($semua as $smu) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (esc($smu->tgl_ubah_progress) > 0) {
                                echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($smu->id_pkp) . '" > ' . esc($smu->nomor) . '/' . esc($smu->no_pkp) . '</a></strong>';
                            } else {
                                echo '<strong><center><a>' . esc($smu->nomor) . '/' . esc($smu->no_pkp) . '</a></strong>';
                            }
                            ?>
                        </td>

                        <td>
                            <?= $smu->proyek; ?>
                        </td>
                        <td>
                            <?= $smu->alias; ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
</body>

</html>
<?= $this->endSection() ?>