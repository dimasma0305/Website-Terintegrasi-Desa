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
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
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
            <li class="nav-item <?= activeLink('profil') ?>">
                <a class="nav-link" href="<?= base_url('profil') ?>">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Profil</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item <?= activeLink('edit_profil') ?>">
                <a class="nav-link" href="<?= base_url('edit_profil') ?>">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>Edit Profil</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

