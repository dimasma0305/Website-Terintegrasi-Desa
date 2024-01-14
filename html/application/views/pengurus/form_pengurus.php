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
			<form action='<?= base_url('pengurus/tambah') ?>' method='post' class='d-flex flex-column gap-2'
				enctype="multipart/form-data">
				<div class="row">
					<div class="col-xl-2 mt-2">
						<div class="row">
							<div class="col-sm-2 mb-1">
								<img id="image-placeholder" class="rounded" src="https://placehold.co/280x330"
									width="280" height="330">
							</div>
						</div>
					</div>
					<div class="col-xl-10">
						<div class="form-group row">
							<label class=" col-form-label" for='nik'>Nama</label>
							<select class="mx-2 form-control" id='nik' name='nik' required>
								<?php foreach ($data as $data): ?>
									<option value="<?= $data['nik'] ?>">
										<?= $data['nama'] ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for='nip'>NIP</label>
							<input type="text" class="mx-2 form-control" id='nip' name='nip' required>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for='jabatan'>Jabatan</label>
							<select class="mx-2 form-control" id='jabatan' name='jabatan' required>
								<option selected>Pilih</option>
								<option value="Kepala Desa">Kepala Desa</option>
								<option value="Sekretaris Desa">Sekretaris Desa</option>
								<option value="Bendahara Desa">Bendahara Desa</option>
							</select>
						</div>
						<div class="form-group row">
							<div class="col-sm-2 mb-1">Image</div>
							<div class="custom-file mx-2">
								<input type="file" class="custom-file-input" id="Image" name="image">
								<label id="image-label" class="custom-file-label" for="Image">Image</label>
							</div>
						</div>
						<div class="form-group row">
							<div class="col d-flex justify-content-end">
								<button class="btn btn-primary px-5" type="submit">Submit</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>

	<div class="card-body">
        	<div class="table-responsive">
				<table id="artikelTable" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Author</th>
							<th>Created at</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
                        <tr>
                            <th>#</th>
							<th>Title</th>
							<th>Author</th>
							<th>Created at</th>
							<th>Action</th>
                        </tr>
                    </tfoot>
					<tbody>
						<?php 
						$i=1;
						foreach ($artikel as $artikel) : ?>
							<tr>
								<th><?= $i ?></th>
								<td><?= $artikel->title; ?></td>
								<td><?= $artikel->username; ?></td>
								<td><?= $artikel->created_at; ?></td>
								<td>
									<button class="btn btn-sm btn-primary" onclick="detailArtikel('<?= $artikel->slug; ?>')"><i class="fas fa-fw fa-eye"></i></button>
									<button class="btn btn-sm btn-warning" onclick="editArtikel('<?= $artikel->id; ?>')"><i class="fas fa-fw fa-pen"></i></button>
									<button class="btn btn-sm btn-danger" onclick="deleteArtikel('<?= $artikel->id; ?>')"><i class="fas fa-fw fa-trash"></i></button>
								</td>
							</tr>
						<?php 
						$i++;
						endforeach; ?>
					</tbody>
				</table>
			</div>
    	</div>
</div>

<script>
	// Function to handle file input change event
	$('#Image').on('change', function (e) {
		var file = e.target.files[0]; // Get the uploaded file
		var imageType = /^image\//;

		if (imageType.test(file.type)) {
			var reader = new FileReader(); // Create a FileReader object

			reader.onload = function (e) {
				// Set the uploaded image source to the FileReader result
				$('#image-placeholder').attr('src', e.target.result);
			};

			// Read the uploaded file as a data URL and display it as an image
			reader.readAsDataURL(file);
		} else {
			alert('Please select an image file.');
			// Clear the file input if the selected file is not an image
			$('#image').val('');
			$('#image-label').append('Image');
			$('#image-placeholder').attr('src', '#');
		}
	});
</script>