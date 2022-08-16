<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loading extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('material_model');

    $this->page = 'loading-masuk';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function masuk()
  { 
    $data['title'] = $this->title;
    $data['jenis_materials'] = $this->jenis_material_model->semua();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-masuk.php', $data);
    $this->load->view('templates/footer.php', $data);
    // $this->load->view('functions/'. $this->page .'.php');
  }

}
