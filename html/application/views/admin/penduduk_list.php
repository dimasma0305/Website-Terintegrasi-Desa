<div class="container">
    <h2>List of Penduduk</h2>

    <?php if ($pendudukData): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendudukData as $penduduk): ?>
                    <tr>
                        <td><?php echo $penduduk['nik']; ?></td>
                        <td><?php echo $penduduk['nama']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No penduduk records found.</p>
    <?php endif; ?>
</div>
