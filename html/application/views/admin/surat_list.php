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
                                <select id="status-<?=html_escape($surat->id)?>" name="status">
                                    <?php
                                    $status = ['pending', 'diterima', 'ditolak'];
                                    foreach ($status as $stat) {
                                        ?>
                                        <option value="<?=$stat?>" <?=$surat->status==$stat?'selected':''?>><?=$stat?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <a class="btn btn-primary" href="<?= html_escape(base_url("uploads/surat/" . $surat->filename)) ?>">view</a>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
        <a href="<?= base_url('surat') ?>" class="btn btn-primary">Back to Surat Form</a>
    </div>
    <script>
        document.querySelectorAll('select[id^="status-"]').forEach((node) => {
            node.addEventListener("change", function () {
                var selectedValue = this.value;
                var suratId = this.id.split("-")[1];

                var message = "Do you want to change the status to '" + selectedValue + "'?";
                var result = window.confirm(message);

                if (result) {
                    // If the user confirms, make a fetch request to the surat_update_status endpoint
                    fetch("<?= base_url('admin/surat_update_status/') ?>" + suratId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'status=' + encodeURIComponent(selectedValue),
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response data as needed
                        console.log(data);
                        // Show an alert based on the success or failure of the request
                        if (data.status === 'ok') {
                            alert('Status updated successfully.');
                        } else {
                            alert('Error updating status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error updating status. Please try again.');
                    });
                } else {
                    console.log("User clicked 'Cancel'. Surat ID:", suratId, "Selected Value:", selectedValue);
                }
            });
        });
    </script>
</main>
