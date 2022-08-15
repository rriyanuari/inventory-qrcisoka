<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?= $title; ?> - Inventory Qr Cisoka</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/select2/dist/css/select2.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/components.css">

</head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg bg-purple"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url('assets/img/avatar/avatar-1.png'); ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">Halo, Admin</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Logged in 5 min ago</div>
              <a href="<?= base_url(); ?>dist/features_profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" data-confirm="Logout?|Apakah anda yakin ingin logout?" data-confirm-yes="window.location.href =`<?= base_url('logout') ?>`">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="main-sidebar sidebar-style-2 py-3">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <img src="<?= base_url('public/img/fyfe-transparant.png') ?>" class="image" width="80">
            <!-- <a href="<?= base_url(); ?>dist/index">Stisla</a> -->
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <img src="<?= base_url('public/img/fyfe-transparant.png') ?>" class="image" width="50">
          </div>
          <ul class="sidebar-menu">
            <li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('dashboard'); ?>">
              <i class="fas fa-chart-pie"></i> <span>Dashboard</span></a>
            </li>

            <li class="menu-header">Master Data</li>
            <li class="<?= $this->uri->segment(1) == 'jenis-material' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('jenis-material'); ?>">
              <i class="fas fa-box"></i> <span>Jenis Material</span></a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'material' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('material'); ?>">
              <i class="fas fa-boxes"></i> <span>Material</span>
            </a></li>

            <li class="menu-header">Loading Material</li>
            <li class="<?= $this->uri->segment(1) == 'material-masuk' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('material-masuk'); ?>">
              <i class="fas fa-truck-loading"></i> <span>Masuk</span></a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'material-keluar' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('material-keluar'); ?>">
              <i class="fas fa-truck-moving"></i> <span>Keluar</span></a>
            </li>
            <li class="<?= $this->uri->segment(1) == 'material-return' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('material-return'); ?>">
              <i class="fas fa-undo"></i> <span>Return</span></a>
            </li>

            <li class="menu-header">Laporan</li>
            <li class="<?= $this->uri->segment(1) == 'kartu-stock' ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url(); ?>admin/kartu-stock">
              <i class="fas fa-clipboard-list"></i> <span>Kartu Stock</span></a>
            </li>

          </ul>

        </aside>
      </div>