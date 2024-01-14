<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">
		<?= $title ?>
	</h1>

	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				<?= $title ?>
			</h6>
		</div>
		<div class="card-body">
			<?php $this->load->view('partials/flash_block') ?>
			<form action='<?= base_url('penduduk/tambah') ?>' method='post' class='d-flex flex-column gap-2'>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='nik'>NIK</label>
					<input type="text" class="mx-2 form-control" id='nik' name='nik' required>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='nama'>Nama</label>
					<input type="text" class="mx-2 form-control" id='nama' name='nama' required>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='pendidikan_id'>Pendidikan</label>
					<select class="mx-2 form-control" id='pendidikan_id' name='pendidikan_id' required>
						<?php foreach ($pendidikan as $pendidikan): ?>
							<option value="<?= $pendidikan['id'] ?>">
								<?= $pendidikan['pendidikan'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='pekerjaan_id'>Pekerjaan</label>
					<select class="mx-2 form-control" id='pekerjaan_id' name='pekerjaan_id' required>
						<?php foreach ($pekerjaan as $pekerjaan): ?>
							<option value="<?= $pekerjaan['id'] ?>">
								<?= $pekerjaan['pekerjaan'] ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='tanggal_lahir'>Tanggal Lahir</label>
					<input type="date" class="mx-2 form-control" id='tanggal_lahir' name='tanggal_lahir' required>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='jenis_kelamin'>Jenis Kelamin</label>
					<select class="mx-2 form-control" id='jenis_kelamin' name='jenis_kelamin' required>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>

				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for='alamat'>Alamat</label>
					<textarea class="mx-2 form-control" id='alamat' name='alamat' rows="4" required></textarea>
				</div>

				<div class="form-group row">
					<div class="col d-flex justify-content-end">
						<button class="btn btn-primary px-5" type="submit">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>