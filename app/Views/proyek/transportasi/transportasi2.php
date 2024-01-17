<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PROYEK TRANSPORTASI 2</h2>
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
                foreach ($trans2 as $trs2) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (esc($trs2->tgl_ubah_progress) > 0) {
                                echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($trs2->id_pkp) . '" > ' . esc($trs2->nomor) . '/' . esc($trs2->no_pkp) . '</a></strong>';
                            } else {
                                echo '<strong><center><a>' . esc($trs2->nomor) . '/' . esc($trs2->no_pkp) . '</a></strong>';
                            }
                            ?>
                        </td>

                        <td>
                            <?= $trs2->proyek; ?>
                        </td>
                        <td>
                            <?= $trs2->alias; ?>
                        </td>
                    <?php } ?>

                </tr>
            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
</script>
</body>

</html>
<?= $this->endSection() ?>