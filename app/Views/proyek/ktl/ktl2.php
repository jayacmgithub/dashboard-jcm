<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>

<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PROYEK KTL 2</h2>
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
                foreach ($ktl2 as $ktl2) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (esc($ktl2->tgl_ubah_progress) > 0) {
                                echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($ktl2->id_pkp) . '" > ' . esc($ktl2->nomor) . '/' . esc($ktl2->no_pkp) . '</a></strong>';
                            } else {
                                echo '<strong><center><a>' . esc($ktl2->nomor) . '/' . esc($ktl2->no_pkp) . '</a></strong>';
                            }
                            ?>
                        </td>

                        <td>
                            <?= $ktl2->proyek; ?>
                        </td>
                        <td>
                            <?= $ktl2->alias; ?>
                        </td>
                    <?php } ?>

                </tr>
            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
<?= $this->endSection() ?>