<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loading_masuk extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->page = 'loading-masuk';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index() // Revised
  {
    $this->load->model('jenis_material_model');
    $this->load->model('material_model');
    $this->load->model('loading_model');

    $data['title'] = $this->title;
    $data['jenis_materials'] = $this->jenis_material_model->semua();

    $loadings = $this->loading_model->permintaan_validasi('Masuk')->result_array();

    $data_merge = array();

    foreach ($loadings as $loading) :
      $item = $loading;

      $material = $this->material_model->permintaan_validasi([
        'material.id' => $loading['id_material']
      ])->row_array();

      $item['material'] = $material;
      array_push($data_merge, $item);
    endforeach;

    $data['loadings'] = $data_merge;

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-masuk.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-masuk.php');
  }

  public function create() // Revised
  {

    $this->load->model('material_model');
    $this->load->model('loading_model');
    $this->load->model('loading_detail_model');

    // CHANGE TIMEZONE
    date_default_timezone_set("Asia/Jakarta");

    // SET DATA
    $data_material['id_jenis_material']      = $this->input->post('id_jenis_material');
    $data_material['qty']                    = $this->input->post('qty');
    $data_material['status']                 = 0;
  
    // INSERT DATA -> DB -> MATERIAL
    if (!$this->material_model->tambah($data_material)) {
      $status = "error";
      $msg = "Permintaan loading material gagal, silahkan coba lagi";
    }

    $data_loading['type']             = "Masuk";
    $data_loading['is_valid']         = 0;
    $data_loading['tgl_permintaan']   = date('Y-m-d H:i:s');

    // INSERT DATA -> DB -> LOADING
    if (!$this->loading_model->tambah($data_loading)) {
      $status = "error";
      $msg = "Permintaan loading material gagal, silahkan coba lagi";
    }

    $loading = $this->loading_model->last_id()->row_array();
    $material = $this->material_model->last_id()->row_array();

    // GET DATA -> DB -> MATERIALS by ID JENIS MATERIAL && STATUS (1 || VALID)
    $materials = $this->material_model->by([
      'material.id_jenis_material' => $this->input->post('id_jenis_material'),
      'material.status'  => 1
    ])->result_array();

    $data_loading_detail['total_qty_awal'] = 0;
    foreach ($materials as $material) {
      $data_loading_detail['total_qty_awal']  += $material['qty'];
    }
      
    $data_loading_detail['id_loading']          = $loading['id'];
    $data_loading_detail['id_material']         = $material['id'];
    $data_loading_detail['qty_loading']         = $this->input->post('qty');
    $data_loading_detail['total_qty_akhir']     =  $data_loading_detail['total_qty_awal'] +  $data_loading_detail['qty_loading'];
    
    // INSERT DATA -> DB -> LOADING DETAIL
    if (!$this->loading_detail_model->tambah($data_loading_detail)) {
      $status = "error";
      $msg = "Permintaan loading material gagal, silahkan coba lagi";
    }
    
    $status = "success";
    $msg    = "Permintaan loading material berhasil dibuat";

    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }

  public function delete() // Revised
  {
    $this->load->model('material_model');
    $this->load->model('loading_model');
    
    // GET DATA -> DB -> LOADING BY ID
    $loading = $this->loading_model->by([
      'loading.id' => $this->input->post('id')
    ])->row_array();

    // GET DATA -> DB -> MATERIAL BY ID
    $material = $this->material_model->by([
      'material.id' => $loading['id_material']
    ])->row_array();

    if(!$this->loading_model->hapus_by_id($loading['id'])) 
    {
      $status = "error";
      $msg = "Kesalahan pada server";
    }

    if(!$this->material_model->hapus_by_id($material['id'])) 
    {
      $status = "error";
      $msg = "Kesalahan pada server";
    } 

    $status = "success";
    $msg    = "Permintaan loading masuk berhasil ditolak";

    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }

  public function scan($id_loading) // Revised
  {
    $this->load->model('loading_model');
    $this->load->model('material_model');
    
    $data['title'] = $this->title;

    // GET DATA -> DB -> LOADING BY ID
    $data['loading'] = $this->loading_model->by([
      'loading.id' => $id_loading
    ])->row_array();

    // GET DATA -> DB -> MATERIAL BY ID
    $data['material'] = $this->material_model->by([
      'material.id' => $data['loading']['id_material']
    ])->row_array();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-masuk-scan.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-masuk-scan.php');
  }

  public function scan_proses() // Revised
  {
    $this->load->model('loading_model');
    $this->load->model('material_model');
    
    
    // CHANGE TIMEZONE
    date_default_timezone_set("Asia/Jakarta");

    $id_material  = $this->input->post('id_material');
    $id_loading   = $this->input->post('id_loading');
    
    $data_loading['is_valid']   = 1;
    $data_loading['tgl_valid']  = date('Y-m-d H:i:s');
    // UPDATE DATA -> DB -> LOADING 
    if (!$this->loading_model->update_by(['id' => $id_loading], $data_loading)) {
      $status = "error";
      $msg = "Validasi loading material gagal, silahkan coba lagi";
    }

    $data_material['status']           = 1;
    $data_material['tgl_kadaluarsa']   = $this->input->post('tgl_kadaluarsa');
    $data_material['last_update']      = date('Y-m-d H:i:s');
    // UPDATE DATA -> DB -> MATERIAL 
    if (!$this->material_model->update_by(['id' => $id_material], $data_material)) {
      $status = "error";
      $msg = "Validasi loading material gagal, silahkan coba lagi";
    }

    $status = "success";
    $msg    = "Validasi loading material berhasil, material tercatat ke sistem";

    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }
}
