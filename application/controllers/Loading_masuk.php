<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loading_masuk extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('material_model');
    $this->load->model('loading_model');

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
      $data['tgl_permintaan']         = date('Y-m-d H:i:s');
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

  public function delete()
  { 
    // INSERT DATABASE
      // GET DATA
      $id       = $this->input->post('id');

      // SET DATA
      $data['id'] = $id;
  
      if($this->material_model->hapus_by_id($id)){
        $status = "success";
        $msg    = "Permintaan loading masuk berhasil ditolak";
      } else{
        $status = "error";
        $msg = "Kesalahan pada server";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
    
  }

  public function scan($id_material)
  { 
    $data['title'] = $this->title;

    $where['id'] = $id_material; 
    
    $data['material'] = $this->material_model->by($where)->row_array();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-masuk-scan.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-masuk-scan.php');
  }

  public function scan_proses()
  { 
    // INSERT DATABASE
      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $where_material['id']     = $this->input->post('id');

      $data_material['status']           = 1;
      $data_material['valid']            = $this->input->post('qty');
      $data_material['tgl_kadaluarsa']   = $this->input->post('tgl_kadaluarsa');
      $data_material['tgl_valid']        = date('Y-m-d H:i:s');
      $data_material['last_update']      = date('Y-m-d H:i:s');

      if($this->material_model->update_by($where_material, $data_material)){
        $data_loading['type']  = "Masuk";
        $data_loading['is_valid']  = 1;
        $data_loading['tgl_scan']  = date('Y-m-d H:i:s');
        $data_loading['tgl_valid']  = date('Y-m-d H:i:s');

        if($this->loading_model->tambah($data_loading)){
          $status = "success";
          $msg    = "Validasi loading material berhasil, material tercatat ke sistem";
        }
      } else{
        $status = "error";
        $msg = "Validasi loading material gagal, silahkan coba lagi";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
  }

}
