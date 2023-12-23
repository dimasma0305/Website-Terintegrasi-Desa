<div class="container">
	<h1>List of Articles</h1>

	<?php if (!empty($artikel)) : ?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Title</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($artikel as $article) : ?>
					<tr>
						<td><a href="<?= base_url('artikel/detail/' . $article->id); ?>"><?= $article->title; ?></a></td>
						<td>
							<button class="btn btn-danger" onclick="deleteArticle('<?= $article->id; ?>')">Delete</button>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	<?php else : ?>
		<p>No articles available.</p>
	<?php endif; ?>
</div>
<script>
	function deleteArticle(articleId) {
		if (confirm('Are you sure you want to delete this article?')) {
			$.ajax({
				type: 'DELETE',
				url: '<?=base_url('artikel/delete')?>?id=' + articleId,
				success: function(response) {
					console.log(response); // Log the response to the console (you can handle it differently)
					// Reload the page or update the article list as needed
					location.reload();
				},
				error: function(error) {
					console.error('Error deleting article:', error);
					// Handle the error appropriately (show a message, etc.)
				}
			});
		}
	}
</script>
