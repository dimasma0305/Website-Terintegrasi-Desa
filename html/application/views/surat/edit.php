<main class='container-fluid'>

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>

	<div class="row">

		<!-- Col -->
		<div class='col-lg-6 col-sm-12'>

			<!-- Card start -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
				</div>
				<div class="card-body">
					<?php $this->load->view('partials/flash_block') ?>
					<form action='<?= base_url('surat/list') ?>' method='post' class='d-flex flex-column gap-2'
							enctype='multipart/form-data'>

						<div class="form-group row mx-1">
							<label class="col-form-label" for='jenisSuratId'>Jenis Surat</label>
							<select class=" form-control " id='jenisSuratId' name='jenisSuratId'>
							<?php foreach ($jenisSurat as $jenis): ?>
								<option value="<?= $jenis->id ?>"><?= $jenis->name ?></option>
							<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group row mx-1">
							<div class="mb-1">Surat</div>
							<div class="custom-file ">
								<input type="file" class="custom-file-input" id="surat" name="surat">
								<label class="custom-file-label" for="surat">Surat</label>
							</div>
						</div>

						<div class="form-group row mx-1">
							<label class="col-form-label" for="deskripsi">Deskripsi</label>
							<textarea class="form-control " id="deskripsi" name="deskripsi" rows="4"></textarea>
						</div>

						<div class="form-group row mx-1">
							<label class="col-form-label" for="keperluan">Keperluan</label>
							<textarea class="form-control " id="keperluan" name="keperluan" rows="4"></textarea>
						</div>

						<div class="form-group row mx-1">
							<div class="col d-flex justify-content-end">
								<button class="btn btn-primary px-5" type="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- Card end -->

		</div>
		<!-- Col end -->

		<!-- Col -->
		<div class='col-lg-6 col-sm-12'>

			<!-- Card start -->
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">File</h6>
				</div>

				<div class="card-body">
					<div class="embed-responsive embed-responsive-1by1">
						<iframe class="embed-responsive-item" src="<?= base_url("uploads/surat/" . $surat->filename) ?>" frameborder="0"></iframe>
					</div>
				</div>
			</div>
			<!-- Card end -->

		</div>
		<!-- Col end -->

	</div>
</main>
