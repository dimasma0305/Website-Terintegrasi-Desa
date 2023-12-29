<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>

	<div class="card shadow mb-4">
        <div class="card-body">
		<?php $this->load->view('partials/flash_block') ?>
        	<div class="table-responsive">
				<table id="artikelTable" class="table table-bordered" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>Title</th>
							<th>Author</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
                        <tr>
                            <th>#</th>
							<th>Title</th>
							<th>Author</th>
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
								<td><?= $artikel->author_id; ?></td>
								<td>
									<!-- <button class="btn btn-sm btn-danger" data-id="<?= $artikel->id; ?>"><i class="fas fa-fw fa-trash"></i></button> -->
									<button class="btn btn-sm btn-danger" onclick="deleteArtikel('<?= $artikel->id; ?>')"><i class="fas fa-fw fa-trash"></i></button>
									<button class="btn btn-sm btn-primary" onclick="detailArtikel('<?= $artikel->slug; ?>')"><i class="fas fa-fw fa-eye"></i></button>
									<button class="btn btn-sm btn-warning" onclick="editArtikel('<?= $artikel->id; ?>')"><i class="fas fa-fw fa-pen"></i></button>
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

<script>
	var baseUrl = '<?= base_url() ?>';

	$(document).ready(function() {
		// Call the dataTables jQuery plugin
		$('#artikelTable').DataTable();
	});


	function detailArtikel(slug) {
		window.open("<?= base_url('artikel/detail/') ?>"+slug,"_blank");
	}

	function detailArtikel(slug) {
		$.ajax({
			type: "method",
			url: "url",
			data: "data",
			dataType: "dataType",
			success: function (response) {
				
			}
		});
	}

	function deleteArtikel(id) {
		window.open("<?= base_url('artikel/delete/') ?>"+id,"_self");
	}

	// function deleteArtikel(artikelId) {
	// 	if (confirm('Are you sure you want to delete this artikel?')) {
	// 		$.ajax({
	// 			type: 'DELETE',
	// 			url: '<?=base_url('artikel/delete')?>?id=' + artikelId,
	// 			success: function(response) {
	// 				console.log(response); // Log the response to the console (you can handle it differently)
	// 				// Reload the page or update the artikel list as needed
	// 				location.reload();
	// 			},
	// 			error: function(error) {
	// 				console.error('Error deleting artikel:', error);
	// 				// Handle the error appropriately (show a message, etc.)
	// 			}
	// 		});
	// 	}
	// }

</script>
