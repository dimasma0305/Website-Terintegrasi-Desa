<div class="container">
    <h2>List of Pengurus</h2>
    <?php if ($pengurusData): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Nip</th>
                    <th>Pendidikan</th>
                    <th>Tanggal Lahir</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pengurusData as $data): ?>
                    <tr>
                        <td>
                            <?= html_escape($data['nama']) ?>
                        </td>
                        <td>
                            <?= html_escape($data['jabatan']) ?>
                        </td>
                        <td>
                            <?= html_escape($data['nip']) ?>
                        </td>
                        <td>
                            <?= html_escape($data['pendidikan']) ?>
                        </td>
                        <td>
                            <?= html_escape($data['tanggal_lahir']) ?>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-warning " onclick="editPengurus('<?= $data['nip']; ?>')">
                                    <i class="fas fa-fw fa-pen"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-danger mx-1" onclick="deletePengurus('<?= $data['nip']; ?>')">
                                    <i class="fas fa-fw fa-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No data records found.</p>
    <?php endif; ?>
</div>

<script>
    function editPengurus(nip) {
        window.location.href = '<?= base_url('pengurus/edit/') ?>' + nip;
    }
    function deletePengurus(nip) {
        // Tambahkan logika konfirmasi dan penghapusan Pengurus di sini
        if (confirm('Apakah Anda yakin ingin menghapus pengurus dengan nip ' + nip + '?')) {
            // Jika konfirmasi di-setuju, kirim permintaan penghapusan ke server
            var deleteUrl = '<?= base_url('pengurus/hapus/') ?>' + nip;
            // Redirect ke halaman hapus
            window.location.href = deleteUrl;
            // Tampilkan pesan berhasil menggunakan alert atau modal
            alert('Pengurus dengan nip ' + nip + ' berhasil dihapus.');
        }
    }
</script>