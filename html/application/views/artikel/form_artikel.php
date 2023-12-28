<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>

	<div class="card shadow mb-4">
        <div class="card-body">

			<?php $this->load->view('partials/flash_block') ?>
			<!-- Article Form -->
			<form method="post" action="<?= base_url('artikel/add'); ?>"  enctype="multipart/form-data">
				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" class="form-control" id="title" name="title" value="<?= set_value('title'); ?>">
					<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
				</div>

				<!-- TODO : Add img thumbnail -->
				<div class="form-group row">
					<div class="col-sm-2 mb-1">Image</div>
					<div class="custom-file mx-2">
						<input type="file" class="custom-file-input" id="Image" name="image">
						<label class="custom-file-label" for="Image">Image</label>
					</div>
				</div>

				<div class="form-group">
					<label for="content">Content:</label>
					<textarea class="form-control" id="content" name="content"><?= set_value('content'); ?></textarea>
					<?= form_error('content', '<small class="text-danger">', '</small>'); ?>
				</div>
				<button type="submit" class="btn btn-primary">Add Article</button>
			</form>

		</div>
	</div>

	<!-- TinyMCE Script -->
	<script src="<?=base_url("/static/js/tinymce/tinymce.min.js")?>"></script>
	<!-- Initialize TinyMCE -->
	<script>
		tinymce.init({
			selector: 'textarea[name="content"]',
			height: 300, // Set the height of the editor
			plugins: 'autolink lists link image charmap print preview anchor',
			toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link',
		});
	</script>
</div>
