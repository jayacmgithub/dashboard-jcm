<?= $this->extend('layout/page_layout') ?>


<?= $this->section('content') ?>


<!-- start: page -->
<section class="panel">
    <header class="panel-heading">
        <div class="row show-grid">
            <div class="col-md-6">
                <h2 class="panel-title">DAFTAR PROYEK GEDUNG 1</h2>
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
                foreach ($gedung1 as $gdg1) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            if (esc($gdg1->tgl_ubah_progress) > 0) {
                                echo '<strong><center><a href="' . base_url() . 'proyek/edit_1/' . esc($gdg1->id_pkp) . '" > ' . esc($gdg1->nomor) . '/' . esc($gdg1->no_pkp) . '</a></strong>';
                            } else {
                                echo '<strong><center><a>' . esc($gdg1->nomor) . '/' . esc($gdg1->no_pkp) . '</a></strong>';
                            }
                            ?>
                        </td>

                        <td>
                            <?= $gdg1->proyek; ?>
                        </td>
                        <td>
                            <?= $gdg1->alias; ?>
                        </td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </div>
</section>
<?= $this->include('layout/js') ?>
<?= $this->endSection() ?>