<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('material_model');
    $this->load->model('proyek_model');
    $this->load->model('loading_model');

    $this->page = 'dashboard';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  {
    $data['title'] = $this->title;
    $data['jenis_materials'] = $this->jenis_material_model->semua();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/' . $this->page . '.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/' . $this->page . '.php', $data);
  }

  public function get_data()
  {
    $data['title'] = $this->title;

    $materials = $this->material_model->semua()->result_array();
    $total_material = 0;
    foreach ($materials as $material) :
      $total_material += $material['qty'];
    endforeach;

    $loadings = $this->loading_model->semua()->result_array();

    $loading_masuk  = [];
    $loading_keluar = [];


    for ($month = 1; $month <= 12; $month++) {
      $loading_masuk_bulanan = 0;
      $loading_keluar_bulanan = 0;

      foreach ($loadings as $loading) :

        if (date_format(date_create($loading['tgl_valid']), "Y-m") == "2022-0" . $month) {
          if ($loading['type'] == "Masuk") {
            $loading_masuk_bulanan  += $loading['qty_loading'];
          }

          if ($loading['type'] == "Keluar") {
            $loading_keluar_bulanan  += $loading['qty_loading'];
          }
        }

      endforeach;
      array_push($loading_masuk, $loading_masuk_bulanan);
      array_push($loading_keluar, $loading_keluar_bulanan);
    }

    $loadings_merge = array();

    foreach ($loadings as $loading) :
      $item = $loading;

      $where['a.id'] = $loading['id_material'];
      $item['material'] = $this->material_model->by($where)->row_array();
      array_push($loadings_merge, $item);
    endforeach;

    $status = "success";
    $result = [
      'jenis_material' => $this->jenis_material_model->semua()->num_rows(),
      'material' => $total_material,
      'proyek' => $this->proyek_model->semua()->num_rows(),
      'loadings' => $loadings_merge,
      'loading_masuk' => $loading_masuk,
      'loading_keluar' => $loading_keluar,
    ];

    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'return' => $result)));
  }
}
