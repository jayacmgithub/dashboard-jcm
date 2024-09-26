<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<!-- start: page -->
<section class="panel">

    <div class="panel-body">

        <?= form_open(base_url('laporan/update_mkt'), ' id="FormulirEdit"  enctype="multipart/form-data"');

        ?>
        <div class="col-md-12">
            <div class="form-group mb-xs mb-xs alamat">
                <div class="col-sm-6">
                    <h4 class="panel-title">EDIT DATA TENDER</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-6">

            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NOMOR LIST</label>
                <div class="col-sm-9">
                    <input type="hidden" name="idd" value="<?= esc($data_mkt->getRow()->id_marketing); ?>">
                    <input type="text" name="no_list" value="<?= esc($data_mkt->getRow()->no_list); ?>"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group mb-xs golongan">
                <label class="col-sm-3 control-label">DIVISI</label>
                <div class="col-sm-9">

                    <select data-plugin-selectTwo class="form-control" name="divisi">
                        <option value="<?= esc($data_mkt->getRow()->divisi); ?>">
                            <?= esc($data_mkt->getRow()->divisi) ?>
                        </option>
                        <option value="GEDUNG">GEDUNG</option>
                        <option value="KTL">KTL</option>
                        <option value="TRANSPORTASI">TRANSPORTASI</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">LINGKUP</label>
                <div class="col-sm-9">
                    <input type="text" name="lingkup" value="<?= esc($data_mkt->getRow()->lingkup); ?>"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NAMA PROYEK</label>
                <div class="col-sm-9">
                    <input type="text" name="nama_proyek" value="<?= esc($data_mkt->getRow()->nama_proyek); ?>"
                        class="form-control" />
                </div>
            </div>

            <?php
            if ($data_mkt->getRow()->tgl_undangan > 0) {
                $tgl_undangan = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_undangan));
            } else {
                $tgl_undangan = '';
            }
            if ($data_mkt->getRow()->tgl_pq > 0) {
                $tgl_pq = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_pq));
            } else {
                $tgl_pq = '';
            }
            if ($data_mkt->getRow()->tgl_pq_r > 0) {
                $tgl_pq_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_pq_r));
            } else {
                $tgl_pq_r = '';
            }
            if ($data_mkt->getRow()->tgl_awz_r > 0) {
                $tgl_awz_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_awz_r));
            } else {
                $tgl_awz_r = '';
            }
            if ($data_mkt->getRow()->tgl_awz > 0) {
                $tgl_awz = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_awz));
            } else {
                $tgl_awz = '';
            }
            if ($data_mkt->getRow()->tgl_admin > 0) {
                $tgl_admin = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_admin));
            } else {
                $tgl_admin = '';
            }
            if ($data_mkt->getRow()->tgl_admin_r > 0) {
                $tgl_admin_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_admin_r));
            } else {
                $tgl_admin_r = '';
            }
            if ($data_mkt->getRow()->tgl_harga > 0) {
                $tgl_harga = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_harga));
            } else {
                $tgl_harga = '';
            }
            if ($data_mkt->getRow()->tgl_harga_r > 0) {
                $tgl_harga_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_harga_r));
            } else {
                $tgl_harga_r = '';
            }
            if ($data_mkt->getRow()->tgl_per_mkt > 0) {
                $tgl_per_mkt = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_mkt));
            } else {
                $tgl_per_mkt = '';
            }
            if ($data_mkt->getRow()->tgl_per_mkt_r > 0) {
                $tgl_per_mkt_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_mkt_r));
            } else {
                $tgl_per_mkt_r = '';
            }
            if ($data_mkt->getRow()->tgl_per_ops > 0) {
                $tgl_per_ops = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_ops));
            } else {
                $tgl_per_ops = '';
            }
            if ($data_mkt->getRow()->tgl_per_ops_r > 0) {
                $tgl_per_ops_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_ops_r));
            } else {
                $tgl_per_ops_r = '';
            }
            if ($data_mkt->getRow()->tgl_per_sdm > 0) {
                $tgl_per_sdm = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_sdm));
            } else {
                $tgl_per_sdm = '';
            }
            if ($data_mkt->getRow()->tgl_per_sdm_r > 0) {
                $tgl_per_sdm_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_sdm_r));
            } else {
                $tgl_per_sdm_r = '';
            }
            if ($data_mkt->getRow()->tgl_per_form > 0) {
                $tgl_per_form = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_form));
            } else {
                $tgl_per_form = '';
            }
            if ($data_mkt->getRow()->tgl_per_form_r > 0) {
                $tgl_per_form_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_per_form_r));
            } else {
                $tgl_per_form_r = '';
            }
            if ($data_mkt->getRow()->tgl_teknis > 0) {
                $tgl_teknis = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_teknis));
            } else {
                $tgl_teknis = '';
            }
            if ($data_mkt->getRow()->tgl_teknis_r > 0) {
                $tgl_teknis_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_teknis_r));
            } else {
                $tgl_teknis_r = '';
            }
            if ($data_mkt->getRow()->tgl_pemasukan > 0) {
                $tgl_pemasukan = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_pemasukan));
            } else {
                $tgl_pemasukan = '';
            }
            if ($data_mkt->getRow()->tgl_pemasukan_r > 0) {
                $tgl_pemasukan_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_pemasukan_r));
            } else {
                $tgl_pemasukan_r = '';
            }
            if ($data_mkt->getRow()->tgl_presentasi > 0) {
                $tgl_presentasi = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_presentasi));
            } else {
                $tgl_presentasi = '';
            }
            if ($data_mkt->getRow()->tgl_presentasi_r > 0) {
                $tgl_presentasi_r = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_presentasi_r));
            } else {
                $tgl_presentasi_r = '';
            }
            if ($data_mkt->getRow()->tgl_draft > 0) {
                $tgl_draft = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_draft));
            } else {
                $tgl_draft = '';
            }
            if ($data_mkt->getRow()->tgl_ttd > 0) {
                $tgl_ttd = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_ttd));
            } else {
                $tgl_ttd = '';
            }
            if ($data_mkt->getRow()->tgl_memo > 0) {
                $tgl_memo = date('d-m-Y', strtotime($data_mkt->getRow()->tgl_memo));
            } else {
                $tgl_memo = '';
            }


            ?>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL PENGUMUMAN</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_undangan" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_undangan; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL PQ</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_pq" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_pq; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_pq_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_pq_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL AANWIJZING</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_awz" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_awz; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_awz_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_awz_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL PROPOSAL ADM </label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_admin" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_admin; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_admin_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_admin_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>


            <div class="form-group mb-xs mb-xs alamat">
                <div class="col-sm-3">
                    <label> TGL PERSONIL MKT</label>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_mkt" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_mkt; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_mkt_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_mkt_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <div class="col-sm-3">
                    <label> TGL PERSONIL OPS</label>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_ops" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_ops; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_ops_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_ops_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
        </div>
        <div class="col-md-6">

            <div class="form-group mb-xs mb-xs alamat">
                <div class="col-sm-3">
                    <label> TGL PERSONIL SDM</label>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_sdm" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_sdm; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_sdm_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_sdm_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <div class="col-sm-3">
                    <label> TGL PERSONIL FORM</label>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_form" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_per_form; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_per_form_r" id="tanggal" autocomplete="off"
                        class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime"
                        value="<?= $tgl_per_form_r; ?>" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL PROPOSAL TEKNIS</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_teknis" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_teknis; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_teknis_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_teknis_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">TGL PENAWARAN HARGA</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_harga" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_harga; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_harga_r" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_harga_r; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL PEMASUKAN</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_pemasukan" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_pemasukan; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_pemasukan_r" id="tanggal" autocomplete="off"
                        class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime"
                        value="<?= $tgl_pemasukan_r; ?>" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <?php
            if (esc($data_mkt->getRow()->pagu) > 0) {
                $pagu = esc($data_mkt->getRow()->pagu);
            } else {
                $pagu = 0;
            }
            ?>

            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">PAGU</label>
                <div class="col-sm-9">
                    <input type="text" name="pagu" id="desimal1" value="<?= number_format(esc($pagu), 2, '.', ','); ?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL PRESENTASI</label>
                <div class="col-sm-3">
                    <input type="text" name="tgl_presentasi" id="tanggal" autocomplete="off"
                        class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime"
                        value="<?= $tgl_presentasi; ?>" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
                <div class="col-sm-3">
                    <input type="text" name="tgl_presentasi_r" id="tanggal" autocomplete="off"
                        class="form-control tanggal" data-plugin-datepicker data-inputmask-alias="datetime"
                        value="<?= $tgl_presentasi_r; ?>" data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NILAI ADM TEKNIS</label>
                <div class="col-sm-9">
                    <input type="text" name="nilai_admin" id="desimal2"
                        value="<?= number_format(esc($data_mkt->getRow()->admin_teknis), 2, '.', ','); ?>"
                        class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">EVALUASI HARGA</label>
                <?php
                if (esc($data_mkt->getRow()->harga_evaluasi) > 0) {
                    $harga_evaluasi = esc($data_mkt->getRow()->harga_evaluasi);
                } else {
                    $harga_evaluasi = 0;
                }
                ?>
                <div class="col-sm-9">
                    <input type="text" name="evaluasi_harga" id="desimal3"
                        value="<?= number_format(esc($harga_evaluasi), 2, '.', ','); ?>" class="form-control">
                </div>
            </div>
            <div class="form-group mb-xs golongan">
                <label class="col-sm-3 control-label">MENANG/KALAH/MUNDUR/BATAL</label>
                <div class="col-sm-2">
                    <input type="number" name="peringkat" value="<?= esc($data_mkt->getRow()->peringkat); ?>"
                        class="form-control" />
                </div>
                <div class="col-sm-3">

                    <select data-plugin-selectTwo class="form-control" name="menang">
                        <option value="<?= esc($data_mkt->getRow()->menang); ?>">
                            <?= esc($data_mkt->getRow()->menang) ?>
                        </option>
                        <option value=""></option>
                        <option value="MENANG">MENANG</option>
                        <option value="KALAH">KALAH</option>
                        <option value="MUNDUR">MUNDUR</option>
                        <option value="BATAL">BATAL</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" name="keterangan" value="<?= esc($data_mkt->getRow()->keterangan); ?>"
                        class="form-control" />
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-xs mb-xs alamat">
                <div class="col-sm-6">
                    <h4 class="panel-title">EDIT DATA KONTRAK</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NAMA SESUAI KONTRAK</label>
                <div class="col-sm-9">
                    <textarea name="nama_kontrak" class="form-control"
                        placeholder="Silahkan isi nama proyek sesuai kontrak"><?= esc($data_mkt->getRow()->nama_kontrak); ?></textarea>
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NOMOR SPK</label>
                <div class="col-sm-9">
                    <input type="text" name="no_spk" value="<?= esc($data_mkt->getRow()->no_spk); ?>"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL DRAFT KONTRAK</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_draft" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_draft; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL TTD SURAT PERJANJIAN</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_ttd" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_ttd; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs tgl_mutasi">
                <label class="col-sm-3 control-label">TGL MEMO PKP</label>
                <div class="col-sm-9">
                    <input type="text" name="tgl_memo" id="tanggal" autocomplete="off" class="form-control tanggal"
                        data-plugin-datepicker data-inputmask-alias="datetime" value="<?= $tgl_memo; ?>"
                        data-inputmask-inputformat="dd-mm-yyyy" data-mask />
                </div>
            </div>
            <div class="form-group mb-xs mb-xs alamat">
                <label class="col-sm-3 control-label">NOMOR PKP</label>
                <div class="col-sm-9">
                    <input type="text" name="no_pkp" value="<?= esc($data_mkt->getRow()->no_pkp); ?>"
                        class="form-control" />
                </div>
            </div>
            <div class="form-group mb-xs golongan">
                <label class="col-sm-3 control-label">CLEAR DATA</label>
                <div class="col-sm-9">
                    <select data-plugin-selectTwo class="form-control" name="clear">
                        <option value="">PILIH OK UNTUK HAPUS DATA</option>
                        <option value="OK">OK</option>
                    </select>
                </div>

            </div>
        </div>
    </div>
    <footer class="panel-footer">
        <div class="row">
            <div class="col-md-12 text-right">
                <br>
                <a style="font-size:12px" class="btn btn-success" href="javascript:window.history.go(-1);"><i
                        class="fa fa-back"></i> Kembali</a>
                <button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
                    id="submitformEdit">Submit</button>

            </div>
        </div>

    </footer>
    </form>



</section>

<?= $this->include('layout/js') ?>

<script type="text/javascript">
    var tableuser = $('#pkpuserdata').DataTable({
        "ajax": {
            url: "<?= base_url() ?>setting/pkpuserdata",
            type: 'GET'
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": false,
        },],
    });

    $('.tanggal').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true,
    });

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd-mm-yyyy', {
        'placeholder': 'dd-mm-yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm-dd-yyyy', {
        'placeholder': 'mm-dd-yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()

    $(function () {
        $("#uang").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#uang2").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#desimal1").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#desimal2").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    $(function () {
        $("#desimal3").keyup(function (e) {
            $(this).val(format($(this).val()));
        });
    });
    var format = function (num) {
        var str = num.toString().replace("", ""),
            parts = false,
            output = [],
            i = 1,
            formatted = null;
        if (str.indexOf(".") > 0) {
            parts = str.split(".");
            str = parts[0];
        }
        str = str.split("").reverse();
        for (var j = 0, len = str.length; j < len; j++) {
            if (str[j] != ",") {
                output.push(str[j]);
                if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
                }
                i++;
            }
        }
        formatted = output.reverse().join("");
        return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };

    $('#nomor_pkp').change(function () {
        var dataId = $(this).val();
        //$(".listitem").find("tr:gt(0)").remove();
        //$("#kategoritambah").select2("val", "Purchase Order");
        $.ajax({
            type: 'GET',
            url: '<?= base_url() ?>setting/pkpdetail2',
            data: 'id=' + dataId,
            dataType: 'json',
            success: function (response) {
                $.each(response.datarows, function (i, item) {
                    $('#proyek').val(item.proyek);
                    $('#no_pkp').val(item.no_pkp);
                });

                // $('.listitem').append(datarow);
            }
        });
        return false;
    });


    document.getElementById("FormulirEdit").addEventListener("submit", function (e) {
        blurForm();
        $('.help-block').hide();
        $('.form-group mb-xs').removeClass('has-error');
        document.getElementById("submitformEdit").setAttribute('disabled', 'disabled');
        $('#submitformEdit').html('Loading ...');
        var form = $('#FormulirEdit')[0];
        var formData = new FormData(form);
        var xhrAjax = $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json'
        }).done(function (data) {
            if (!data.success) {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                document.getElementById("submitformEdit").removeAttribute('disabled');
                $('#submitformEdit').html('Submit');
                var objek = Object.keys(data.errors);
                for (var key in data.errors) {
                    if (data.errors.hasOwnProperty(key)) {
                        var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
                        $('.' + key).addClass('has-error');
                        $('input[name="' + key + '"]').after(msg);
                    }
                    if (key == 'fail') {
                        Swal.fire({
                            title: 'Notifikasi',
                            text: data.errors[key],
                            position: "top-end",
                            showConfirmButton: false,
                            icon: 'error'
                        });
                    }
                }
            } else {
                $('input[name=<?= csrf_token(); ?>]').val(data.token);
                PNotify.removeAll();
                tableuser.ajax.reload();
                document.getElementById("submitformEdit").removeAttribute('disabled');
                //$('#editData').modal('hide');
                document.getElementById("FormulirEdit").reset();
                $('#submitformEdit').html('Submit');
                //APRI untuk refresh
                window.setTimeout(function () {
                    location.reload();
                }, 1000);

                Swal.fire({
                    title: 'Notifikasi',
                    text: data.message,
                    position: "top-end",
                    showConfirmButton: false,
                    icon: 'success'
                });
                if (data.hapus == 'OK') {
                    window.setTimeout(function () {
                        window.location.href = "<?= base_url() ?>laporan/mkt";
                    }, 1000);
                }
            }
        }).fail(function (data) {
            Swal.fire({
                title: 'Notifikasi',
                text: "Request gagal, browser akan direload",
                position: "top-end",
                showConfirmButton: false,
                icon: 'error'

            });
            window.setTimeout(function () {
                location.reload();
            }, 2000);
        });
        e.preventDefault();
    });
</script>
</body>

</html>
<?= $this->endSection() ?>