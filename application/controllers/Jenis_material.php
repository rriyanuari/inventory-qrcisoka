<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis_Material extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');

    $this->page = 'jenis-material';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  { 
    $data['title'] = $this->title;
    $data['jenis_materials'] = $this->jenis_material_model->semua();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/'. $this->page .'.php', $data);
    $this->load->view('templates/footer.php', $data);
  }

}
