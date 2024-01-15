<nav class='navbar navbar-expand-lg bg-body-tertiary mb-2'>
	<div class='container-fluid'>
		<button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target='#navbarTogglerDemo01'
				aria-controls='navbarTogglerDemo01' aria-expanded='false' aria-label='Toggle navigation'>
			<span class='navbar-toggler-icon'></span>
		</button>
		<div class='collapse navbar-collapse' id='navbarTogglerDemo01'>
			<a class='navbar-brand' href='<?=base_url('/')?>'>Hidden brand</a>
			<ul class='navbar-nav me-auto mb-2 mb-lg-0'>
				<li class='nav-item'>
					<a class='nav-link active' aria-current='page' href='<?=base_url('/')?>'>Home</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='<?=base_url("surat/")?>'>Surat</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='<?=base_url("surat/list")?>'>View Surat</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href='<?=base_url("admin/surat_list")?>'>Admin View Surat</a>
				</li>
			</ul>
			<div class='d-flex gap-2'>
				<?php
				if ($this->session->id){
					?>
					<a class='btn btn-outline-danger' href='<?= base_url('index/logout') ?>'>Logout</a>
					<?php
				} else {
					?>
					<a class='btn btn-outline-primary' href="<?=base_url("index/login")?>">Login</a>
					<a class='btn btn-outline-secondary' href="<?=base_url("index/register")?>">Register</a>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</nav>
