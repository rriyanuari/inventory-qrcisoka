<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'pages/';

// Pages 
// $route['(:any)'] = 'pages/index/$1';

// Dashboard
$route['dashboard'] = 'dashboard';

// List Proyek
  $route['proyek'] = 'proyek';
  $route['proyek/create'] = 'proyek/create';
  $route['proyek/edit'] = 'proyek/edit';
  $route['proyek/delete'] = 'proyek/delete';

// Jenis Material
  $route['jenis-material'] = 'jenis_material';
  $route['jenis-material/create'] = 'jenis_material/create';
  $route['jenis-material/edit'] = 'jenis_material/edit';
  $route['jenis-material/delete'] = 'jenis_material/delete';

// Material
  $route['material'] = 'material';

// QR
  $route['cetak-qr/(:any)'] = 'qr/index/$1';

// Loading Masuk
  $route['loading-masuk'] = 'loading_masuk';
  $route['loading-masuk/create'] = 'loading_masuk/create';
  $route['loading-masuk/delete'] = 'loading_masuk/delete';
  $route['loading-masuk/scan/(:any)'] = 'loading_masuk/scan/$1';
  $route['loading-masuk/scan-proses'] = 'loading_masuk/scan_proses';

// Loading Keluar
  $route['loading-keluar'] = 'loading_keluar';
  $route['loading-keluar/validasi'] = 'loading_keluar/validasi';
  $route['loading-keluar/delete'] = 'loading_keluar/delete';
  $route['loading-keluar/scan'] = 'loading_keluar/scan';
  $route['loading-keluar/scan-proses'] = 'loading_keluar/scan_proses';

// Loading Return
  $route['loading-return'] = 'loading_return';
  $route['loading-return/validasi'] = 'loading_return/validasi';
  $route['loading-return/delete'] = 'loading_return/delete';
  $route['loading-return/scan'] = 'loading_return/scan';
  $route['loading-return/scan-proses'] = 'loading_return/scan_proses';

// Laporan
  $route['laporan-bulanan'] = 'laporan';
  $route['laporan-bulanan/cetak'] = 'laporan/cetak';







