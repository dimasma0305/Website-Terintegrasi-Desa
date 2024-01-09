<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php $this->load->view('partials/flash_block') ?>
            <form action="<?= base_url('penduduk/edit/' . $penduduk ['nik']) ?>" method="post" class="d-flex flex-column gap-2">

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="nama">Nama</label>
                    <input type="text" class="mx-2 form-control" id="nama" name="nama" value="<?= html_escape($penduduk ['nama']) ?>" required>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="pendidikan_id">Pendidikan</label>
                    <select class="mx-2 form-control" id="pendidikan_id" name="pendidikan_id" required>
                        <?php foreach ($pendidikan as $pendidikan_item) : ?>
                            <option value="<?= $pendidikan_item['id'] ?>" <?= ($pendidikan_item['id'] == $penduduk ['pendidikan_id']) ? 'selected' : '' ?>>
                                <?= $pendidikan_item['pendidikan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="pekerjaan_id">Pekerjaan</label>
                    <select class="mx-2 form-control" id="pekerjaan_id" name="pekerjaan_id" required>
                        <?php foreach ($pekerjaan as $pekerjaan_item) : ?>
                            <option value="<?= $pekerjaan_item['id'] ?>" <?= ($pekerjaan_item['id'] == $penduduk ['pekerjaan_id']) ? 'selected' : '' ?>>
                                <?= $pekerjaan_item['pekerjaan'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" class="mx-2 form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= html_escape($penduduk ['tanggal_lahir']) ?>" required>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="mx-2 form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="Laki-laki" <?= ($penduduk ['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                        <option value="Perempuan" <?= ($penduduk ['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alamat">Alamat</label>
                    <textarea class="mx-2 form-control" id="alamat" name="alamat" rows="4" required><?= html_escape($penduduk ['alamat']) ?></textarea>
                </div>

                <div class="form-group row">
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary px-5" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
