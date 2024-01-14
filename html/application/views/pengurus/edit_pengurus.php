<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title ?>
    </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <?php $this->load->view('partials/flash_block') ?>
            <form action='<?= base_url('pengurus/edit/' . $pengurus['idpengurus']) ?>' method='post' class='d-flex flex-column gap-2'>
                <div class="row">
                    <div class="col-xl-2 mt-2">
                        <div class="row">
                            <div class="col-sm-2 mb-1">
                                <img id="image-placeholder" class="rounded" src="https://placehold.co/280x330"
                                    width="280" height="330">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-10">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for='nik'>Nama</label>
                            <select class="mx-2 form-control" id='nik' name='nik' readonly>
                                <option selected>
                                    <?= $pengurus['nama'] ?>
                                </option>
                            </select>
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for='nip'>NIP</label>
                            <input type="text" class="mx-2 form-control" id='nip' name='nip' value="<?= $pengurus['nip'] ?>" required>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for='jabatan'>Jabatan</label>
                            <select class="mx-2 form-control" id='jabatan' name='jabatan' required>
                                <option selected>
                                    <?= $pengurus['jabatan'] ?>
                                </option>
                                <option value="Kepala Desa">Kepala Desa</option>
                                <option value="Sekretaris Desa">Sekretaris Desa</option>
                                <option value="Bendahara Desa">Bendahara Desa</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2 mb-1">Image</div>
                            <div class="custom-file mx-2">
                                <input type="file" class="custom-file-input" id="Image" name="image" value="<?= $pengurus['fotoprofil'] ?>">
                                <label id="image-label" class="custom-file-label" for="Image">Image</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary px-5" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Function to handle file input change event
    $('#Image').on('change', function (e) {
        var file = e.target.files[0]; // Get the uploaded file
        var imageType = /^image\//;

        if (imageType.test(file.type)) {
            var reader = new FileReader(); // Create a FileReader object

            reader.onload = function (e) {
                // Set the uploaded image source to the FileReader result
                $('#image-placeholder').attr('src', e.target.result);
            };

            // Read the uploaded file as a data URL and display it as an image
            reader.readAsDataURL(file);
        } else {
            alert('Please select an image file.');
            // Clear the file input if the selected file is not an image
            $('#Image').val('');
            $('#image-label').text('Image');
            $('#image-placeholder').attr('src', 'https://placehold.co/280x330');
        }
    });
</script>
