<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800">
		<?= $title ?>
	</h1>
	
	<?php $this->load->view('partials/flash_block') ?>
	
	
<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				<?= $title ?>
			</h6>
		</div>
		<div class="card-body">

			<!-- Loader -->
			<div id="loader" class="spinner-border text-primary" role="status" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); display: none;">
				<span class="sr-only">Loading...</span>
			</div>

			<form action='<?= base_url('pengurus/tambah') ?>' method='post' class='d-flex flex-column gap-2'
				enctype="multipart/form-data">
				<input type="hidden" name="id" id="id">
				<div class="row">
					<div class="col-xl-2 mt-2">
						<div class="row">
							<div class="col-12 mb-1">
								<img id="image-placeholder" class="rounded img-fluid" src="https://placehold.co/200x300"
									width="200" height="300">
							</div>
						</div>
					</div>

	
					<div class="col-xl-10">
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for='nik'>Nama</label>
							<select  class="mx-2 form-control border" id='nik' name='nik' data-live-search="true" required>
							<option selected disabled>Pilih</option>
								<?php foreach ($data as $data): ?>
									<option data-tokens="<?= $data['nama'] ?>" value="<?= $data['nik'] ?>">
										<?= $data['nama'] ?>
									</option>
								<?php endforeach; ?>
							</select>
							<?= form_error('nik', '<small class="mx-2 text-danger">', '</small>'); ?>
						</div>
						<div class="form-group row">`
							<label class="col-sm-2 col-form-label" for='nip'>NIP</label>
							<input type="text" class="mx-2 form-control" id='nip' name='nip' required>
							<?= form_error('nip', '<small class="mx-2 text-danger">', '</small>'); ?>
						</div>
						<div class="form-group row">
							<label class="col-sm-2 col-form-label" for='jabatan'>Jabatan</label>
							<select class="mx-2 form-control border" id='jabatan' name='jabatan' required>
								<option selected disabled>Pilih</option>
								<option value="Kepala Desa">Kepala Desa</option>
								<option value="Sekretaris Desa">Sekretaris Desa</option>
								<option value="Bendahara Desa">Bendahara Desa</option>
							</select>
							<?= form_error('jabatan', '<small class="mx-2 text-danger">', '</small>'); ?>
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
								<button class="btn btn-primary px-5" type="submit">Kirim</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

	</div>

	<!--Table -->
	<div class="card shadow mb-4">
		<!-- Card title -->
		<div class="card-header py-3 d-flex align-items-center justify-content-between">
			<h6 class="my-auto font-weight-bold text-primary">Daftar Pengurus</h6>
		</div>
		<!-- Card body -->
        <div class="card-body">
        	<div class="table-responsive">

				<table id="pengurustable" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr align="center">
							<th>Nama</th>
							<th>Jabatan</th>
							<th>Nip</th>
							<th>Pendidikan</th>
							<th>Alamat</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($pengurus as $pengurus) : ?>
						<tr align="center">
							<td><?= html_escape($pengurus['nama']) ?></td>
							<td><?= html_escape($pengurus['jabatan']) ?></td>
							<td><?= html_escape($pengurus['nip']) ?></td>
							<td><?= html_escape($pengurus['pendidikan']) ?></td>
							<td><?= html_escape($pengurus['alamat']) ?></td>
							
							<td align="center">
								<button class="btn btn-sm btn-warning" onclick="editPengurus('<?= $pengurus['id'] ?>')"><i class="fas fa-fw fa-pen"></i></button>
								<button class="btn btn-sm btn-danger" onclick="deletePengurus('<?= $pengurus['id'] ?>', '<?= $pengurus['nip'] ?>')"><i class="fas fa-fw fa-trash"></i></button>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>

<script>
    function editPengurus(id) {
		// Show loader
		$('#loader').show();
		
		$.ajax({
			type: "post",
			url: "<?= base_url() ?>"+"pengurus/edit/",
			data: {id : id},
			dataType: 'json', // Assuming the response is in JSON format
			success: function(response) {
				console.log(response);
				// Assuming the response has a 'data' field you want to populate in the input
				$('#id').val(response.id); 
				$('#nik').selectpicker('val', response.nik); 
				// $('button[data-id="nik"]').attr('title', response.nik); 
				$('#nip').val(response.nip); 
				$('#jabatan').selectpicker('val', response.jabatan); ; 
				$('#image-label').html(response.fotoprofil); 
				$('#image-placeholder').attr('src', '<?= base_url() ?>'+'uploads/pengurus/'+response.fotoprofil); 
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			},
			complete: function () {
				// Hide loader regardless of success or error
				$('#loader').hide();
			}
		});

    }
    function deletePengurus(id, nip) {
        // Tambahkan logika konfirmasi dan penghapusan Pengurus di sini
        if (confirm('Apakah Anda yakin ingin menghapus pengurus dengan nip ' + nip + '?')) {
            // Jika konfirmasi di-setuju, kirim permintaan penghapusan ke server
            var deleteUrl = '<?= base_url('pengurus/hapus/') ?>' + id;
            // Redirect ke halaman hapus
            window.location.href = deleteUrl;
            // Tampilkan pesan berhasil menggunakan alert atau modal
        }
    }
</script>

<script>
	
	$(document).ready(function() {
		// Call the dataTables jQuery plugin
		$('#pengurustable').DataTable();
		$('select').selectpicker();
		
	});

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
			alert('Mohon pilih file gambar.');
			// Clear the file input if the selected file is not an image
			$('#image').val('');
			$('#image-label').append('Image');
			$('#image-placeholder').attr('src', '#');
		}
	});
</script>