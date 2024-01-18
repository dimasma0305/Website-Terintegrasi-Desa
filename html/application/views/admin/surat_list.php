<main class='container'>
	<div class='d-flex flex-column'>
		<h1>View Surat</h1>
		<?php if (empty($suratData)) : ?>
			<p>No surat found.</p>
		<?php else : ?>
			<table class="table" id="tabelSurat">
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
								<form class="form-floating">
									<select class="form-select" id="status-<?= html_escape($surat->id) ?>" name="status">
										<?php
										$status = ['pending', 'diterima', 'ditolak'];
										foreach ($status as $stat) {
										?>
											<option value="<?= $stat ?>" <?= $surat->status == $stat ? 'selected' : '' ?>><?= $stat ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</td>
							<td>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal-<?= html_escape($surat->id) ?>">
									<i class="fas fas-fw fa-eye"></i>
								</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete-<?= html_escape($surat->id) ?>">
			<i class="fas fas-fw fa-trash"></i>
      
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

								<div class="modal fade" id="confirmDelete-<?= html_escape($surat->id) ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this surat?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a href="<?= base_url('admin/surat_delete/' . $surat->id) ?>" class="btn btn-danger">Delete</a>
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
							<td id="status-pdf-<?= html_escape($surat->id) ?>"><?= $surat->status ?></td>
						</tr>
					<?php
						$count++;
					endforeach;
					?>
				</tbody>
			</table>
		<?php endif; ?>
		<a href="<?= base_url('surat') ?>" class="btn btn-primary">Back to Surat Form</a>
		<div id="pdf" class="mt-3"></div>
	</div>
	<script src="<?= base_url('static/js/jspdf.umd.min.js') ?>"></script>
	<script src="<?= base_url('static/js/jspdf.plugin.autotable.min.js') ?>"></script>
	<script>
		$(document).ready(function() {
			$('#tabelSurat').DataTable();

			renderPDF()
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
								$('#status-pdf-' + suratId).text(selectedValue)
								renderPDF()
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

		function renderPDF() {
			const pdf = new jspdf.jsPDF();

			pdf.autoTable({
				html: '#contentToPdf',
				theme: 'striped',
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
			const frame = document.createElement("iframe")
			frame.width = "100%"
			frame.src = pdf.output('datauristring')
			$("#pdf").html("")
			$("#pdf").append(frame)
		}
	</script>
</main>
