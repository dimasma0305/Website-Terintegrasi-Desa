<!-- Begin Page Content -->
<div class="container-fluid">

	<h1 class="h3 mb-4 text-gray-800"><?= isset($edit_mode) ? 'Edit Profile' : 'User Profile'; ?></h1>

	<?php if ($user) : ?>
		<div class="row">
			<div class="col-lg-6">

				<div class="card">
					<div class="card-header <?= isset($edit_mode) ? 'bg-warning text-white' : ''; ?>">
						<?= isset($edit_mode) ? 'Edit User Information' : 'User Information'; ?>
					</div>
					<div class="card-body">

						<!-- Display flash messages for success and error -->
						<?php $this->load->view('partials/flash_block') ?>


						<?php if (isset($edit_mode)) : ?>
							<!-- Add a form for editing user details -->
							<form action="<?= base_url('user/updateProfile'); ?>" method="post">
								<div class="form-group">
									<label for="username">Username</label>
									<input type="text" class="form-control" id="username" name="username" value="<?= set_value('username', $user['username']); ?>">
									<!-- Display form validation error for username -->
									<?= form_error('username', '<small class="text-danger">', '</small>'); ?>
								</div>
								<div class="form-group">
									<label for="email">Email</label>
									<input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $user['email']); ?>">
									<!-- Display form validation error for email -->
									<?= form_error('email', '<small class="text-danger">', '</small>'); ?>
								</div>
								<div class="form-group">
									<label for="nik">NIK</label>
									<input type="text" class="form-control" id="nik" name="nik" value="<?= set_value('email', $user['nik']); ?>">
									<?= form_error('nik', '<small class="text-danger">', '</small>'); ?>
								</div>
								<button type="submit" class="btn btn-primary">Update Profile</button>
							</form>
						<?php else : ?>
							<!-- Display user information without the form for non-edit mode -->
							<p><strong>ID:</strong> <?= $user['id']; ?></p>
							<p><strong>Username:</strong> <?= $user['username']; ?></p>
							<p><strong>Email:</strong> <?= $user['email']; ?></p>
							<p><strong>Role:</strong> <?= $user['role']; ?></p>
							<?php
							if (!empty($user['nik'])) {
							?>
								<p><strong>NIK:</strong> <?= $user['nik']; ?></p>
								<p><strong>Nama:</strong> <?= $user['nama']; ?></p>


							<?php
							}
							?>
							<a href="<?= base_url('user/editProfile'); ?>" class="btn btn-warning">Edit Profile</a>
						<?php endif; ?>

					</div>
				</div>

			</div>
		</div>

	<?php else : ?>
		<div class="alert alert-danger" role="alert">
			User not found.
		</div>
	<?php endif; ?>

</div>
<!-- /.container-fluid -->
