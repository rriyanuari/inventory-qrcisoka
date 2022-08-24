<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qr extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('material_model');

    $this->page = 'qr';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index($id_material)
  {
    $data['title'] = $this->title . " | " . $id_material;


    $where['id'] = $id_material;
    $data['material'] = $this->material_model->by($where)->row_array();

    // $this->load->view('templates/header.php', $data);
    $this->load->view('pages/cetak-qr.php', $data);
    // $this->load->view('templates/footer.php', $data);
    // $this->load->view('functions/'. $this->page .'.php');
  }
}
