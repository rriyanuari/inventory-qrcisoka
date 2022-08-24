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

// Loading Material
  $route['loading-masuk'] = 'loading_masuk';
  $route['loading-masuk/create'] = 'loading_masuk/create';

// QR
  $route['cetak-qr/(:any)'] = 'qr/index/$1';





