<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

	<?php $this->load->view('partials/flash_block') ?>
	<div class="card shadow mb-4">
		<!-- Card title -->
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Form Artikel</h6>
		</div>

        <div class="card-body">

			
			<!-- Artikel Form -->
			<form method="post" action="<?= base_url('artikel'); ?>"  enctype="multipart/form-data">
				<input type="hidden" name="id" id="id" value="">
				<div class="row">
					<div class="col-xl-6 mb-1">

						<div class="form-group">
							<label for="title">Title:</label>
							<input type="text" class="form-control" id="title" name="title" value="<?= set_value('title'); ?>">
							<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
						</div>

						<div class="form-group row">
							<div class="col-sm-2 mb-1">Image</div>
							<div class="custom-file mx-2">
								<input type="file" class="custom-file-input" id="Image" name="image">
								<label id="image-label" class="custom-file-label" for="Image">Image</label>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-2 mb-1">
								<img id="image-placeholder" class=" rounded mx-auto d-block" src="https://placehold.co/300x200" width="300" height="200">
							</div>
						</div>

					</div>
					<div class="col-xl-6 mb-1">
						<div class="form-group">
							<label for="content">Content:</label>
							<textarea class="form-control" id="content" name="content"><?= set_value('content'); ?></textarea>
							<?= form_error('content', '<small class="text-danger">', '</small>'); ?>
						</div>
					</div>
				</div>

				<div class="row justify-content-end">
					<div class="col-xl-6 mb-1 d-flex justify-content-between">
						
						<button type="submit" class="btn btn-primary px-5">Submit</button>
					</div>
				</div>
			</form>

		</div>
	</div>

	<!--Artikel Table -->
	<div class="card shadow mb-4">
		<!-- Card title -->
		<div class="card-header py-3 d-flex align-items-center justify-content-between">
			<h6 class="my-auto font-weight-bold text-primary">Daftar Artikel</h6>
			
			<a href="<?= base_url('artikel/print') ?>" target="_blank" class="btn btn-primary btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-fw fa-print"></i>
				</span>
				<span class="text">Print PDF</span>
			</a>
		</div>
		<!-- Card body -->
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

</div>

<!-- TinyMCE Script -->
<script src="<?=base_url("/static/js/tinymce/tinymce.min.js")?>"></script>

<script>
	// Initialize TinyMCE
	tinymce.init({
		selector: 'textarea[id="content"]',
		height: 340,
		plugins: 'autolink lists link image charmap print preview anchor',
		toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link',
	});

	// Function to handle file input change event
	$('#Image').on('change', function(e) {
		var file = e.target.files[0]; // Get the uploaded file
		var imageType = /^image\//;

		if (imageType.test(file.type)) {
			var reader = new FileReader(); // Create a FileReader object

			reader.onload = function(e) {
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


	var baseUrl = "<?= base_url() ?>";

	$(document).ready(function() {
		// Call the dataTables jQuery plugin
		$('#artikelTable').DataTable();
	});

	function detailArtikel(slug) {
		window.open("<?= base_url('home/artikel/') ?>"+slug,"_blank");
	}

	function editArtikel(idArtikel) {
		console.log(idArtikel);
		$.ajax({
			type: "post",
			url: baseUrl+"artikel/edit/",
			data: {id : idArtikel},
			dataType: 'json', // Assuming the response is in JSON format
			success: function(response) {
				console.log(response);
				// Assuming the response has a 'data' field you want to populate in the input
				$('#id').val(response[0].id); 
				$('#title').val(response[0].title); 
				$('#image-label').html(response[0].image_url); 
				tinymce.get('content').setContent(response[0].content);
				$('#image-placeholder').attr('src', baseUrl+'uploads/artikel/'+response[0].image_url); 
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}

	function deleteArtikel(id) {
<<<<<<< HEAD
		if (confirm('Apakah anda yakin?')) {
=======
		if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
>>>>>>> 123eb86721d79dda0a957999ae8b8094530062db
			window.open("<?= base_url('artikel/delete/') ?>"+id,"_self");
		}
	}
</script>