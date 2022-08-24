<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loading_masuk extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('material_model');

    $this->page = 'loading-masuk';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  { 
    $data['title'] = $this->title;
    $data['jenis_materials'] = $this->jenis_material_model->semua();

    $where['status'] = 0; 
    $materials = $this->material_model->by($where)->result_array();

    $data_merge = array();

    foreach ($materials as $material) :
      $item = $material;

      $where2['id'] = $material['id_jenis_material'];
      $jenis_material = $this->jenis_material_model->by($where2)->row_array();
      $item['nama_jenis_material'] = $jenis_material['nama'];
      array_push($data_merge, $item);
    endforeach;

    $data['materials'] = $data_merge;

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-masuk.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-masuk.php');
  }

  public function create()
  { 
    // INSERT DATABASE
      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data['id_jenis_material']      = $this->input->post('id_jenis_material');
      $data['qty']                    = $this->input->post('qty');
      $data['created_at']             = date('Y-m-d H:i:s');
      $data['last_update']            = date('Y-m-d H:i:s');
  
      if($this->material_model->tambah($data)){
        $status = "success";
        $msg    = "Permintaan loading material berhasil dibuat";
      } else{
        $status = "error";
        $msg = "Permintaan loading material gagal, silahkan coba lagi";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
  }

}
