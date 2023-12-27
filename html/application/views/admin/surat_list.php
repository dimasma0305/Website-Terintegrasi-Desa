<main class='container'>
	<div class='d-flex flex-column'>
		<h1>View Surat</h1>
		<?php if (empty($suratData)) : ?>
			<p>No surat found.</p>
		<?php else : ?>
			<table class="table">
				<thead>
					<tr>
						<th>ID</th>
						<th>Owner</th>
						<th>Title</th>
						<th>Jenis Surat</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($suratData as $surat) : ?>
						<tr>
							<td><?= html_escape($count) ?></td>
							<td><?= html_escape($surat->ownerUsername) ?></td>
							<td><?= html_escape($surat->title) ?></td>
							<td><?= html_escape($surat->jenisSuratName) ?></td>
							<td>
								<select id="status-<?= html_escape($surat->id) ?>" name="status">
									<?php
									$status = ['pending', 'diterima', 'ditolak'];
									foreach ($status as $stat) {
									?>
										<option value="<?= $stat ?>" <?= $surat->status == $stat ? 'selected' : '' ?>><?= $stat ?></option>
									<?php
									}
									?>
								</select>
							</td>
							<td>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal-<?= html_escape($surat->id) ?>">
									View
								</button>

								<!-- Modal -->
								<div class="modal fade" id="confirmModal-<?= html_escape($surat->id) ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<dl class="row">
													<dt class="col-sm-4">Title:</dt>
													<dd class="col-sm-8"><?= html_escape($surat->title) ?></dd>

													<dt class="col-sm-4">Deskripsi:</dt>
													<dd class="col-sm-8"><?= html_escape($surat->deskripsi) ?></dd>

													<dt class="col-sm-4">Keperluan:</dt>
													<dd class="col-sm-8"><?= html_escape($surat->keperluan) ?></dd>

													<dt class="col-sm-4">Link:</dt>
													<dd class="col-sm-8"><a href="<?= html_escape(base_url("uploads/surat/" . $surat->filename)) ?>" target="_blank"><?= html_escape(base_url("uploads/surat/" . $surat->filename)) ?></a></dd>
												</dl>
											</div>
										</div>
									</div>
								</div>
							</td>
						</tr>
					<?php
						$count++;
					endforeach;
					?>
				</tbody>
			</table>

			<table class="table" id="contentToPdf" hidden>
				<thead>
					<tr>
						<th>ID</th>
						<th>Owner</th>
						<th>Title</th>
						<th>Jenis Surat</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$count = 1;
					foreach ($suratData as $surat) : ?>
						<tr>
							<td><?= html_escape($count) ?></td>
							<td><?= html_escape($surat->ownerUsername) ?></td>
							<td><?= html_escape($surat->title) ?></td>
							<td><?= html_escape($surat->jenisSuratName) ?></td>
							<td><?=$surat->status?></td>
						</tr>
					<?php
						$count++;
					endforeach;
					?>
				</tbody>
			</table>
		<?php endif; ?>
		<a href="<?= base_url('surat') ?>" class="btn btn-primary">Back to Surat Form</a>
		<button id="saveAsPdf">Save as PDF</button>
	</div>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.1/jspdf.plugin.autotable.min.js" integrity="sha512-8+n4PSpp8TLHbSf28qpjRfu51IuWuJZdemtTC1EKCHsZmWi2O821UEdt6S3l4+cHyUQhU8uiAAUeVI1MUiFATA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script>
		$(document).ready(function() {
			$('select[id^="status-"]').change(function() {
				var selectedValue = $(this).val();
				var suratId = this.id.split("-")[1];

				var message = "Do you want to change the status to '" + selectedValue + "'?";
				var result = window.confirm(message);

				if (result) {
					$.ajax({
						url: "<?= base_url('admin/surat_update_status/') ?>" + suratId,
						type: 'POST',
						data: {
							'status': selectedValue
						},
						dataType: 'json',
						success: function(data) {
							if (data.status === 'ok') {
								alert('Status updated successfully.');
							} else {
								alert('Error updating status.');
							}
						},
						error: function(error) {
							console.error('Error:', error);
							alert('Error updating status. Please try again.');
						}
					});
				}
			});
		});
		$('#saveAsPdf').click(function() {
			const pdf = new jspdf.jsPDF();

			// Add table to PDF
			pdf.autoTable({
				html: '#contentToPdf',
				theme: 'striped', // Optional: add a theme to the table
				styles: {
					cellPadding: 0.2,
					fontSize: 8
				},
				columnStyles: {
					0: {
						fontStyle: 'bold'
					}
				},
				margin: {
					top: 1,
					left: 0.5,
					right: 0.5,
					bottom: 1
				}
			});

			// Save the PDF
			pdf.save('surat_table.pdf');
		});
	</script>
</main>
