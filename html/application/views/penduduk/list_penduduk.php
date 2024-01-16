<div class="container">
    <h2>Data Penduduk</h2>

    <?php if ($pendudukData): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Pendidikan</th>
                    <th>Pekerjaan</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendudukData as $penduduk): ?>
                    <tr>
                            <td><?= html_escape($penduduk['nik']) ?></td>
                            <td><?= html_escape($penduduk['nama']) ?></td>
                            <td><?= html_escape($penduduk['pendidikan']) ?></td>
                            <td><?= html_escape($penduduk['pekerjaan']) ?></td>
                            <td><?= html_escape($penduduk['tanggal_lahir']) ?></td>
                            <td><?= html_escape($penduduk['jenis_kelamin']) ?></td>
                            <td><?= html_escape($penduduk['alamat']) ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning" onclick="editPenduduk('<?= $penduduk['nik']; ?>')">
                                    <i class="fas fa-fw fa-pen"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deletePenduduk('<?= $penduduk['nik']; ?>')">
                                    <i class="fas fa-fw fa-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No penduduk records found.</p>
    <?php endif; ?>
</div>

<script>
    function editPenduduk(nik) {
        // Tambahkan logika pengeditan penduduk di sini
        // Contoh: Redirect ke halaman edit dengan parameter nik
        window.location.href = '<?= base_url('penduduk/edit/') ?>' + nik;
    }

    function deletePenduduk(nik) {
        // Tambahkan logika konfirmasi dan penghapusan penduduk di sini
        if (confirm('Apakah Anda yakin ingin menghapus penduduk dengan NIK ' + nik + '?')) {
        // Jika konfirmasi di-setuju, kirim permintaan penghapusan ke server
        var deleteUrl = '<?= base_url('penduduk/hapus/') ?>' + nik;
        // Redirect ke halaman hapus
        window.location.href = deleteUrl;
        // Tampilkan pesan berhasil menggunakan alert atau modal
        alert('Penduduk dengan NIK ' + nik + ' berhasil dihapus.');
    }
}
</script>
