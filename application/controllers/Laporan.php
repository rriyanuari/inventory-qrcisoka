<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('material_model');
    $this->load->model('loading_model');

    $this->page = 'laporan-bulanan';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  { 
    $data['title'] = $this->title;

    $data['periode'] = null;
    $data['jenis_materials'] = null;


    if($this->input->get('periode') != "" ){
      $periode = $this->input->get('periode');

      $jenis_materials = $this->jenis_material_model->semua()->result_array();

      $data_merge = array();

      foreach ($jenis_materials as $jenis_material) :
        $item = $jenis_material;

        $where['id_jenis_material'] = $jenis_material['id'];
        $where['status'] = 1;
        $item['materials'] = $this->material_model->by($where)->result_array();
          
        $data_merge2 = array();
        foreach($item['materials'] as $material):
          $item2 = $material;

          $item2['loadings'] = $this->loading_model->laporan_bulanan($material['id'], $periode)->result_array();

          // echo "periode = " . $periode . "<br />"; 
          // var_dump($item2['loadings']);
          // die();

          array_push($data_merge2, $item2);
        endforeach;
        $item['materials'] = $data_merge2;

        array_push($data_merge, $item);
      endforeach;

      $data['jenis_materials'] = $data_merge;
      $data['periode'] = date('F - Y', strtotime($periode));
    }

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/'. $this->page .'.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/'. $this->page .'.php');
  }

  public function cetak()
  { 
    $data['title'] = $this->title;
    $jenis_materials = $this->jenis_material_model->semua()->result_array();

    $data_merge = array();

    foreach ($jenis_materials as $jenis_material) :
      $item = $jenis_material;

      $where['id_jenis_material'] = $jenis_material['id'];
      $where['status'] = 1;
      $item['materials'] = $this->material_model->by($where)->result_array();
      array_push($data_merge, $item);
    endforeach;

    $data['jenis_materials'] = $data_merge;

    $this->load->view('templates/header-cetak.php', $data);
    $this->load->view('pages/laporan-bulanan-cetak.php', $data);
    $this->load->view('templates/footer-cetak.php', $data);
    // $this->load->view('functions/'. $this->page .'.php');
  }

}
