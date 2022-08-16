<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('material_model');

    $this->page = 'material';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  { 
    $data['title'] = $this->title;
    $jenis_materials = $this->jenis_material_model->semua()->result_array();

    $data_merge = array();

    foreach ($jenis_materials as $jenis_material) :
      $item = $jenis_material;

      $item['materials'] = $this->material_model->by('id_jenis_material', $jenis_material['id'])->result_array();
      array_push($data_merge, $item);
    endforeach;

    $data['jenis_materials'] = $data_merge;

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/'. $this->page .'.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/'. $this->page .'.php');
  }

}
