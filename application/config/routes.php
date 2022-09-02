<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'pages/';

// Pages 
// $route['(:any)'] = 'pages/index/$1';

// Dashboard
$route['dashboard'] = 'dashboard';

// Jenis Material
  $route['jenis-material'] = 'jenis_material';
  $route['jenis-material/create'] = 'jenis_material/create';
  $route['jenis-material/edit'] = 'jenis_material/edit';
  $route['jenis-material/delete'] = 'jenis_material/delete';

// Material
  $route['material'] = 'material';

// Loading Masuk
  $route['loading-masuk'] = 'loading_masuk';
  $route['loading-masuk/create'] = 'loading_masuk/create';
  $route['loading-masuk/delete'] = 'loading_masuk/delete';
  $route['loading-masuk/scan/(:any)'] = 'loading_masuk/scan/$1';
  $route['loading-masuk/scan-proses'] = 'loading_masuk/scan_proses';

// Loading Keluar
  $route['loading-keluar'] = 'loading_keluar';
  $route['loading-keluar/create'] = 'loading_keluar/create';
  $route['loading-keluar/delete'] = 'loading_keluar/delete';
  $route['loading-keluar/scan'] = 'loading_keluar/scan';
  $route['loading-keluar/scan-proses'] = 'loading_keluar/scan_proses';

// QR
  $route['cetak-qr/(:any)'] = 'qr/index/$1';





