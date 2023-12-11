<!-- Begin Page Content -->
<div class="container-fluid">
	
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>
	
	<div class="row">
		<div class="col-lg-8">
				<?php $this->load->view('partials/flash_block') ?>
				<form action='<?= base_url('surat/list') ?>' method='post' class='d-flex flex-column gap-2'
					  enctype='multipart/form-data'>
		
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for='jenisSuratId'>Jenis Surat</label>
						<div class="col-sm">
							<select class="form-control " id='jenisSuratId' name='jenisSuratId'>
							<?php foreach ($jenisSurat as $jenis): ?>
								<option value="<?= $jenis->id ?>"><?= $jenis->name ?></option>
							<?php endforeach; ?>
							</select>
						</div>
					</div>
		
					<div class="form-group row">
						<div class="col-sm-2">Surat</div>
						<div class="col-sm">
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="surat" name="surat">
								<label class="custom-file-label" for="surat">Surat</label>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="deskripsi">Deskripsi</label>
						<div class="col-sm">
							<textarea class="form-control" id="deskripsi" name="deskripsi" rows="4"></textarea>
						</div>
					</div>
				
					<div class="form-group row">
						<label class="col-sm-2 col-form-label" for="keperluan">Keperluan</label>
						<div class="col-sm">
							<textarea class="form-control" id="keperluan" name="keperluan" rows="4"></textarea>
						</div>
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

