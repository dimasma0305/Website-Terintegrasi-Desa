<div class="container mt-5">
	<h2>Add New Article</h2>

	<!-- Display error flash message if set -->
	<?php $this->load->view('partials/flash_block') ?>

	<!-- Article Form -->
	<form method="post" action="<?= base_url('artikel/add'); ?>">
		<div class="form-group">
			<label for="title">Title:</label>
			<input type="text" class="form-control" id="title" name="title" value="<?= set_value('title'); ?>">
			<?= form_error('title', '<small class="text-danger">', '</small>'); ?>
		</div>
		<div class="form-group">
			<label for="content">Content:</label>
			<textarea class="form-control" id="content" name="content"><?= set_value('content'); ?></textarea>
			<?= form_error('content', '<small class="text-danger">', '</small>'); ?>
		</div>
		<button type="submit" class="btn btn-primary">Add Article</button>
	</form>

	<!-- TinyMCE Script -->
	<script src="<?=base_url("/static/js/tinymce/tinymce.min.js")?>"></script>
	<!-- Initialize TinyMCE -->
	<script>
		tinymce.init({
			selector: 'textarea[name="content"]',
			height: 300, // Set the height of the editor
			plugins: 'autolink lists link image charmap print preview anchor',
			toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image'
		});
	</script>
</div>
