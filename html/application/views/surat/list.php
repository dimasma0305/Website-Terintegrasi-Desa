<!-- Begin Page Content -->
<div class="container-fluid">
	
	<!-- Page Heading -->
	<h1 class="h3 mb-4 text-gray-800"><?= $title?></h1>
	
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Jenis Surat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Jenis Surat</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
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
                                <a class="btn btn-primary btn-sm" href="<?=html_escape(base_url("uploads/surat/".$surat->filename))?>">
                                    <i class="fas fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" href="<?=html_escape(base_url("surat/edit/".$surat->id))?>">
                                    <i class="fas fa-fw fa-pen"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                        $count++;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col d-flex justify-content-end">
            <button href="<?= base_url('form_surat') ?>" class="btn btn-primary">Back to Surat Form</button>
        </div>
    </div>

</div>
