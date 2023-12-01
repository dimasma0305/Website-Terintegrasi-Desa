<main class='container'>
	<div class='d-flex flex-column'>
		<h1>Data Pengajuan Surat</h1>
		<form action='<?= base_url('/surat/edit/'.$surat->id) ?>' method='post' class='d-flex flex-column gap-2'
			  enctype='multipart/form-data'>
			<label for='jenisSuratId'>Jenis Surat</label>
			<select id='jenisSuratId' name='jenisSuratId'>
				<?php foreach ($jenisSurat as $jenis): ?>
					<option value="<?= $jenis->id ?>" <?=$surat->jenisSuratId==$jenis->id?"selected":""?>><?= $jenis->name ?></option>
				<?php endforeach; ?>
			</select>

			<label for="surat">Surat</label>
			<input id="surat" name="surat" type="file">

			<label for="deskripsi">Deskripsi</label>
			<textarea id="deskripsi" name="deskripsi" rows="4"><?=html_escape($surat->deskripsi)?></textarea>

			<label for="keperluan">Keperluan</label>
			<textarea id="keperluan" name="keperluan" rows="4"><?=html_escape($surat->keperluan)?></textarea>

			<?php $this->load->view('partials/flash_block') ?>
			<button type="submit">Submit</button>
		</form>
	</div>
</main>
