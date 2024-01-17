<?php

function activeLink($menu)
{
	$ci = get_instance();
	if ($ci->uri->uri_string() == $menu) {
		return 'active';
	} else {
		return '';
	}
}

?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3"> Admin <sup>2</sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Dashboard
	</div>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item <?= activeLink('dashboard') ?>">
		<a class="nav-link" href="<?= base_url('dashboard') ?>">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dashboard</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Surat
	</div>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item <?= activeLink('form_surat') ?>">
		<a class="nav-link" href="<?= base_url('form_surat') ?>">
			<i class="fas fas-fw fa-envelope-open-text"></i>
			<span>Form Surat</span></a>
	</li>

	<!-- Nav Item - Dashboard -->
	<li class="nav-item <?= activeLink('daftar_surat') ?>">
		<a class="nav-link" href="<?= base_url('daftar_surat') ?>">
			<i class="fas fa-fw fa-mail-bulk"></i>
			<span>Daftar Surat</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		User
	</div>

	<!-- Nav Item - Charts -->
	<li class="nav-item <?= activeLink('user/profile') ?>">
		<a class="nav-link" href="<?= base_url('user/profile') ?>">
			<i class="fas fa-fw fa-user"></i>
			<span>Profil</span></a>
	</li>

	<!-- Nav Item - Tables -->
	<li class="nav-item <?= activeLink('user/editProfile') ?>">
		<a class="nav-link" href="<?= base_url('user/editProfile') ?>">
			<i class="fas fa-fw fa-user-edit"></i>
			<span>Edit Profil</span></a>
	</li>
	<?php
	if ($this->session->userdata('role') == 'admin') {
		?>
		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Artikel
		</div>

		<li class="nav-item <?= activeLink('artikel') ?>">
			<a class="nav-link" href="<?= base_url('artikel') ?>">
				<i class="fas fa-fw fa-user-edit"></i>
				<span>Artikel</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			List
		</div>

		<li class="nav-item <?= activeLink('admin/surat_list') ?>">
			<a class="nav-link" href="<?= base_url('admin/surat_list') ?>">
				<i class="fas fa-fw fa-user-edit"></i>
				<span>Admin list surat</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Penduduk
		</div>

		<!-- Nav Item - Dashboard -->
		<li class="nav-item <?= activeLink('penduduk/tambah') ?>">
			<a class="nav-link" href="<?= base_url('penduduk/tambah') ?>">
				<i class="fas fas-fw fa-envelope-open-text"></i>
				<span>Form Penduduk</span></a>
		</li>

		<!-- Nav Item - Dashboard -->
		<li class="nav-item <?= activeLink('penduduk/list_penduduk') ?>">
			<a class="nav-link" href="<?= base_url('penduduk/list_penduduk') ?>">
				<i class="fas fa-fw fa-mail-bulk"></i>
				<span>Daftar Penduduk</span></a>
		</li>

		<li class="nav-item <?= activeLink('admin/penduduk_list') ?>">
			<a class="nav-link" href="<?= base_url('admin/penduduk_list') ?>">
				<i class="fas fa-fw fa-user-edit"></i>
				<span>List Penduduk</span></a>
		</li>
		<!-- Heading -->
		<div class="sidebar-heading">
			Pengurus
		</div>

		<!-- Nav Item - Dashboard -->
		<li class="nav-item <?= activeLink('pengurus/tambah') ?>">
			<a class="nav-link" href="<?= base_url('pengurus/tambah') ?>">
				<i class="fas fas-fw fa-envelope-open-text"></i>
				<span>Form Pengurus</span></a>
		</li>

		<?php
	}
	?>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Nav Item - Tables -->
	<li class="nav-item <?= activeLink('logout') ?>">
		<a class="nav-link" href="<?= base_url('logout') ?>" data-toggle="modal" data-target="#logoutModal">
			<i class="fas fa-fw fa-sign-out-alt"></i>
			<span>Logout</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>



</ul>
<!-- End of Sidebar -->