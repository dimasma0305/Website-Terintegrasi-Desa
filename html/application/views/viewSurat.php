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
                            <td><?= html_escape($surat->title) ?></td>
                            <td><?= html_escape($surat->jenisSuratName) ?></td>
                            <td><?= html_escape($surat->status) ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?=html_escape(base_url("uploads/surat/".$surat->filename))?>">view</a>
                                <a class="btn btn-secondary" href="<?=html_escape(base_url("csurat/edit/".$surat->id))?>">edit</a>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
        <a href="<?= base_url('csurat') ?>" class="btn btn-primary">Back to Surat Form</a>
    </div>
</main>
