<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loading_return extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('proyek_model');
    $this->load->model('material_model');
    $this->load->model('loading_model');
    $this->load->model('scan_model');

    $this->page = 'loading-return';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  {
    $data['title'] = $this->title;
    $data['jenis_materials'] = $this->jenis_material_model->semua();
    $data['proyeks'] = $this->proyek_model->semua();

    $loadings = $this->loading_model->permintaan_validasi('Return')->result_array();

    $data_merge = array();

    foreach ($loadings as $loading) :
      $item = $loading;

      $material = $this->material_model->by([
        'material.id' => $loading['id_material']
      ])->row_array();

      $item['material'] = $material;
      array_push($data_merge, $item);
    endforeach;

    $data['loadings'] = $data_merge;

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-return.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-return.php');
  }

  public function get_data()
  { 
    // INSERT DATABASE

      // SET DATA
      $where_jenis_material['id']  = $this->input->post('id_jenis_material');
  
      if($this->jenis_material_model->by($where_jenis_material)){
        $status = "success";
        $return = $this->jenis_material_model->by($where_jenis_material)->row_array();
      } else{
        $status = "error";
        $return = "Gagal mendapatkan data";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'return'=>$return))); 
  }

  public function create()
  { 
    // INSERT DATABASE
      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data_material['id_jenis_material']  = $this->input->post('id_jenis_material');
      $data_material['qty']                = $this->input->post('qty');
      $data_material['status']             = 0;

      if(!$this->material_model->tambah($data_material)){
        $status = "error";
        $msg = "Material return gagal ditambahkan, silahkan coba lagi";
      }

      $data_loading['id_proyek']         = $this->input->post('id_proyek');
      $data_loading['type']              = 'Return';
      $data_loading['is_valid']          = 0;
      $data_loading['tgl_permintaan']   = date('Y-m-d H:i:s');

      if(!$this->loading_model->tambah($data_loading)){
        $status = "error";
        $msg = "Material return gagal ditambahkan, silahkan coba lagi";
      }

    $status = "success";
    $msg    = "Material return berhasil ditambahkan, menunggu validasi";
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
  }

  public function delete()
  {
    // INSERT DATABASE
    // GET DATA
    $id       = $this->input->post('id');

    // SET DATA
    $data['id'] = $id;

    if ($this->material_model->hapus_by_id($id)) {
      $status = "success";
      $msg    = "Permintaan loading keluar berhasil ditolak";
    } else {
      $status = "error";
      $msg = "Kesalahan pada server";
    }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }

  public function scan($id_material)
  {
    $data['title'] = $this->title;

    $where['a.id'] = $id_material;

    $data['material'] = $this->material_model->by($where)->row_array();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-return-scan.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-return-scan.php');
  }

  public function scan_proses()
  {
    // INSERT DATABASE
    // CHANGE TIMEZONE
    date_default_timezone_set("Asia/Jakarta");

    $id_material          = $this->input->post('id_material');
    $id_jenis_material    = $this->input->post('id_jenis_material');

    // SET DATA -> LOADING
    $data_loading['is_valid']  = 1;
    $data_loading['tgl_scan']  = date('Y-m-d H:i:s');
    $data_loading['tgl_valid']  = date('Y-m-d H:i:s');

    // INSERT DATA -> DB -> LOADING 
    if ($this->loading_model->tambah($data_loading)) {

      // GET DATA -> DB -> LOADING (LAST ID)
      $loading = $this->loading_model->last_id()->row_array();
      
      // SET DATA -> LOADING DETAIL
      $data_loading_detail['id_loading']  = $loading['id'];
      $data_loading_detail['id_material']  = $id_material;
      $data_loading_detail['total_qty_awal']  = 0;

      $where_material1['a.id_jenis_material']     = $id_jenis_material;
      $where_material1['a.status']                = 1;
      $materials = $this->material_model->by($where_material1)->result_array();

      foreach ($materials as $material) {
        $data_loading_detail['total_qty_awal']  += $material['qty'];
      }

      $where_material2['a.id']     = $id_material;
      $material = $this->material_model->by($where_material2)->row_array();

      $data_loading_detail['qty_loading']  = $material['qty'];
      $data_loading_detail['total_qty_akhir']  = $data_loading_detail['total_qty_awal'] + $data_loading_detail['qty_loading'];

      
      // INSERT DATA -> DB -> LOADING DETAIL 
      if ($this->loading_detail_model->tambah($data_loading_detail)) {
        
        $data_material['status']           = 1;
        $data_material['valid']            = $this->input->post('qty');
        $data_material['tgl_kadaluarsa']   = $this->input->post('tgl_kadaluarsa');
        $data_material['tgl_valid']        = date('Y-m-d H:i:s');
        $data_material['last_update']      = date('Y-m-d H:i:s');

        // UPDATE DATA -> DB -> MATERIAL 
        if ($this->material_model->update_by($where_material2, $data_material)) {
          $status = "success";
          $msg    = "Validasi loading material berhasil, material tercatat ke sistem";
        }
      }
    } else {
      $status = "error";
      $msg = "Validasi loading material gagal, silahkan coba lagi";
    }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }

}
