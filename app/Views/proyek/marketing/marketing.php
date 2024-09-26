<?= $this->extend('layout/page_layout') ?>
<?= $this->section('content') ?>
<link href="<?php echo base_url() ?>/assets/vendor/dist/css/style.min2.css" rel="stylesheet">
<!-- start: page -->
<section class="panel">
	<div class="panel-body">
		<?php echo form_open(base_url('proyek/editmarketing'), ' id="Formulir" enctype="multipart/form-data"'); ?>
		<div class="col-md-6">
			<div class="form-group alamat">
				<label class="col-sm-3 control-label">PKP</label>
				<div class="col-sm-9">
					<input type="hidden" name="id_pkp0" value="<?= esc($pkp->getRow()->id_pkp); ?>"
						class="form-control" />
					<input type="text" value="<?= esc($pkp->getRow()->no_pkp); ?>" class="form-control" disabled
						readonly />
				</div>
			</div>

			<div class="form-group kategori">
				<label class="col-sm-3 control-label">Alias<span class="required">*</span></label>
				<div class="col-sm-9">
					<input type="hidden" name="alias0" value="<?= esc($pkp->getRow()->alias); ?>" class="form-control"
						required />
					<input type="text" name="alias" value="<?= esc($pkp->getRow()->alias); ?>" class="form-control"
						required />
				</div>
			</div>
			<div class="form-group kategori">
				<label class="col-sm-3 control-label">Nama sesuai Kontrak<span class="required">*</span></label>
				<div class="col-sm-9">
					<input type="hidden" name="proyek0" value="<?= esc($pkp->getRow()->proyek); ?>" class="form-control"
						required />
					<textarea name="proyek" class="form-control" rows="3"
						required><?= esc($pkp->getRow()->proyek); ?></textarea>
				</div>
			</div>
			<div class="form-group tgl_mutasi">
				<label class="col-sm-3 control-label">Kontrak Induk</label>
				<?php if ($pkp->getRow()->tgl_mulai > '2000-01-01') {
					$tgl_mulai = esc(date('d-m-Y', strtotime($pkp->getRow()->tgl_mulai)));
				} else {
					$tgl_mulai = '';
				}
				if ($pkp->getRow()->tgl_selesai > '2000-01-01') {
					$tgl_selesai = esc(date('d-m-Y', strtotime($pkp->getRow()->tgl_selesai)));
				} else {
					$tgl_selesai = '';
				} ?>
				<div class="col-sm-3">
					<input type="text" name="tgl_mulai" value="<?= esc($tgl_mulai); ?>" class="form-control" />
				</div>
				<div class="col-sm-1">
					<a>s/d</a>
				</div>
				<div class="col-sm-3">
					<input type="text" name="tgl_selesai" value="<?= esc($tgl_selesai); ?>" class="form-control" />
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group kategori">
				<label class="col-sm-3 control-label">Jaminan Nilai</label>
				<div class="col-sm-9">
					<input type="text" name="nilai_jaminan"
						value="<?= esc(number_format($pkp->getRow()->nilai_jaminan, 0, ",", ".")); ?>"
						onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);"
						class="form-control currency" autocomplete="off">
				</div>
			</div>
			<div class="form-group kategori">
				<label class="col-sm-3 control-label">Jaminan Selesai Tanggal</label>
				<div class="col-sm-9">
					<?php if ($pkp->getRow()->tgl_jaminan > 0) {
						$tgl_jaminan = esc(date('d-m-Y', strtotime($pkp->getRow()->tgl_jaminan)));
					} else {
						$tgl_jaminan = '';
					} ?>
					<input type="text" name="tgl_jaminan" value="<?= esc($tgl_jaminan); ?>" class="form-control"
						placeholder="dd-mm-yyyy" />
				</div>
			</div>
			<div class="form-group kategori">
				<label class="col-sm-3 control-label">File BAST I</label>
				<div class="col-sm-9">
					<input type="text" name="bast_1" value="<?= esc($pkp->getRow()->bast_1); ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group kategori">
				<label class="col-sm-3 control-label">File BAST II</label>
				<div class="col-sm-9">
					<input type="text" name="bast_2" value="<?= esc($pkp->getRow()->bast_2); ?>" class="form-control" />
				</div>
			</div>
			<div class="form-group kategori">
				<label class="col-sm-3 control-label">File SRT Referensi</label>
				<div class="col-sm-9">
					<input type="text" name="referensi" value="<?= esc($pkp->getRow()->referensi); ?>"
						class="form-control" />
				</div>
			</div>

			<div class="col-md-12 text-right">
				<a class="btn btn-success" style="font-size:12px"
					href="<?php echo base_url() ?>proyek/edit_1/<?php echo $pkp_user ?>">Kembali</a>
				<a style="font-size:12px" class="btn btn-warning" href="#" data-toggle="modal"
					data-target="#tambahData"><i class="fa fa-back"></i> Tambah Addendum</a>
				<button class="btn btn-primary" id="submitform" style="font-size:12px">Simpan</button>
			</div>
		</div>
	</div>
</section>
</form>
<section>
	<div class="row" style="overflow-x: auto;white-space: nowrap;">
		<div class="col-md-12">

			<div class="table-responsive" style="max-width:100%;">
				<table class="table table-bordered table-hover table-striped dataTable no-footer">
					<thead>
						<tr>
							<th style="width:5%;">Aksi</th>
							<th style="width:10%;">Addendum</th>
							<th style="width:10%;">Tgl Mulai</th>
							<th style="width:10%;">Tgl Selesai</th>
							<th style="width:25%;">Jaminan Nilai</th>
							<th style="width:25%;">Jaminan Tanggal</th>
							<th style="width:10%;">File BAST1</th>
							<th style="width:10%;">File BAST2</th>
							<th style="width:10%;">Refrensi</th>
						</tr>
					</thead>

					<?php foreach ($addendum as $pkpu) { ?>
						<tbody>
							<?php if (level_user('marketing', 'index', $kategoriQNS, 'read') > 0) { ?>
								<td><a style="font-size:12px" class="btn btn-success" href="#" onclick="edit(this)"
										data-id="<?php echo $pkpu->id_addendum ?>">Edit</a></td>
							<?php } else { ?>
								<td></td>
							<?php } ?>
							<td>
								<?php echo $pkpu->keterangan; ?>
							</td>
							<td>
								<?php echo $pkpu->tgl_mulai; ?>
							</td>
							<td>
								<?php echo $pkpu->tgl_selesai; ?>
							</td>
							<td>
								<?php echo $pkpu->nilai_jaminan; ?>
							</td>
							<td>
								<?php echo $pkpu->tgl_jaminan; ?>
							</td>
							<td>
								<?php echo $pkpu->bast_1; ?>
							</td>
							<td>
								<?php echo $pkpu->bast_2; ?>
							</td>
							<td>
								<?php echo $pkpu->referensi; ?>
							</td>

						</tbody>
					<?php } ?>
				</table>
			</div>
		</div>
	</div>

	<!-- end: page -->
</section>
<!-- JS -->

<div class="modal fade bd-example-modal-lg" id="tambahData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" style="width:90% ;">
		<div class="modal-content">
			<section class="panel-body">
				<?php echo form_open(base_url('proyek/tambahaddendum'), ' id="FormulirTambah" enctype="multipart/form-data"'); ?>
				<header class="panel-heading">
					<h2 class="panel-title">Addendum</h2>
					<input type="hidden" name="id_pkp0" value="<?= esc($pkp->getRow()->id_pkp); ?>"
						class="form-control" />
				</header>
				<br>
				<div class="col-md-6">
					<div class="form-group kategori">
						<label class="col-sm-3 control-label">Keterangan<span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="keterangan" class="form-control" required />
						</div>
					</div>
					<div class="form-group tgl_mutasi">
						<label class="col-sm-3 control-label">Kontrak Addendum<span class="required">*</span></label>
						<div class="col-sm-3">
							<input type="text" name="tgl_mulai" class="form-control" placeholder="dd-mm-yyyy"
								required />
						</div>
						<div class="col-sm-1">
							<a>s/d</a>
						</div>
						<div class="col-sm-3">
							<input type="text" name="tgl_selesai" class="form-control" placeholder="dd-mm-yyyy"
								required />
						</div>
					</div>
					<div class="form-group kategori">
						<label class="col-sm-3 control-label">Jaminan Nilai<span class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="nilai_jaminan" onkeydown="return numbersonly(this, event);"
								onkeyup="javascript:tandaPemisahTitik(this);" class="form-control currency"
								autocomplete="off">
						</div>
					</div>
					<div class="form-group kategori">
						<label class="col-sm-3 control-label">Jaminan Selesai Tanggal<span
								class="required">*</span></label>
						<div class="col-sm-9">
							<input type="text" name="tgl_jaminan" class="form-control" placeholder="dd-mm-yyyy" />
						</div>
					</div>
				</div>
				<div class="col-md-6">

					<div class="form-group kategori">
						<label class="col-sm-3 control-label">File BAST I</label>
						<div class="col-sm-9">
							<input type="text" name="bast_1" class="form-control" />
						</div>
					</div>
					<div class="form-group kategori">
						<label class="col-sm-3 control-label">File BAST II</label>
						<div class="col-sm-9">
							<input type="text" name="bast_2" class="form-control" />
						</div>
					</div>
					<div class="form-group kategori">
						<label class="col-sm-3 control-label">File SRT Referensi</label>
						<div class="col-sm-9">
							<input type="text" name="referensi" class="form-control" />
						</div>
					</div>
					<div class="col-md-12 text-right">
						<button style="font-size:12px" class="btn btn-primary modal-confirm" type="submit"
							id="submitform">Submit</button>
						<button style="font-size:12px" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
				</form>
			</section>
		</div>
	</div>
</div>
<?= $this->include('layout/js') ?>
<script>
	$(document).ready(function () {
		document.getElementById("Formulir").addEventListener("submit", function (e) {
			PNotify.removeAll();
			blurForm();
			$('.form-group').removeClass('has-error');
			document.getElementById("submitform").setAttribute('disabled', 'disabled');
			$('#submitform').html('Loading ...');
			var form = $('#Formulir')[0];
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
					document.getElementById("submitform").removeAttribute('disabled');
					$('#submitform').html('Submit');
					var objek = Object.keys(data.errors);
					for (var key in data.errors) {
						if (data.errors.hasOwnProperty(key)) {
							$('.' + key).addClass('has-error');
							new PNotify({
								title: 'Notifikasi Eror',
								text: data.errors[key],
								type: 'error'
							});
						}
					}
				} else {
					$('input[name=<?= csrf_token(); ?>]').val(data.token);
					document.getElementById("submitform").removeAttribute('disabled');
					document.getElementById("Formulir").reset();
					$('#submitform').html('Submit');
					new PNotify({
						title: 'Notifikasi',
						text: data.message,
						type: 'success'
					});
					window.setTimeout(function () {
						location.reload();
					}, 1000);
				}
			}).fail(function (data) {
				document.getElementById("submitform").removeAttribute('disabled');
				$('#submitform').html('Submit');
				new PNotify({
					title: 'Notifikasi',
					text: "Request gagal, browser akan direload",
					type: 'danger'
				});
					});
			e.preventDefault();
		});
	});
	document.getElementById("FormulirTambah").addEventListener("submit", function (e) {
		blurForm();
		$('.help-block').hide();
		$('.form-group').removeClass('has-error');
		document.getElementById("submitform").setAttribute('disabled', 'disabled');
		$('#submitform').html('Loading ...');
		var form = $('#FormulirTambah')[0];
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
				document.getElementById("submitform").removeAttribute('disabled');
				$('#submitform').html('Submit');
				var objek = Object.keys(data.errors);
				for (var key in data.errors) {
					if (data.errors.hasOwnProperty(key)) {
						var msg = '<div class="help-block" for="' + key + '">' + data.errors[key] + '</span>';
						$('.' + key).addClass('has-error');
						$('input[name="' + key + '"]').after(msg);
					}
					if (key == 'fail') {
						new PNotify({
							title: 'Notifikasi',
							text: data.errors[key],
							type: 'danger'
						});
					}
				}
			} else {
				$('input[name=<?= csrf_token(); ?>]').val(data.token);
				PNotify.removeAll();
				document.getElementById("submitform").removeAttribute('disabled');
				$('#tambahData').modal('hide');
				document.getElementById("FormulirTambah").reset();
				$('#submitform').html('Submit');
				//APRI untuk refresh
				window.setTimeout(function () {
					location.reload();
				}, 1000);
				new PNotify({
					title: 'Notifikasi',
					text: data.message,
					type: 'success'
				});

			}
		}).fail(function (data) {
			new PNotify({
				title: 'Notifikasi',
				text: "Request gagal, browser akan direload",
				type: 'danger'
			});
				});
		e.preventDefault();
	});
</script>

</body>

</html>
<?= $this->endSection(); ?>