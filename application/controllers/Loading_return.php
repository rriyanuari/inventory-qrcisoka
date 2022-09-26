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

  public function validasi()
  { 
    // INSERT DATABASE
      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data['id_proyek']      = $this->input->post('id_proyek');
      $data['keterangan']     = $this->input->post('keterangan');
      $data['is_valid']       = 1;
      $data['tgl_valid']    = date('Y-m-d H:i:s');

      $where_loading['id']  = $this->input->post('id');
  
      if($this->loading_model->update_by($where_loading, $data)){
        $status = "success";
        $msg    = "Loading material keluar berhasil divalidasi";
      } else{
        $status = "error";
        $msg = "Loading material keluar gagal divalidasi, silahkan coba lagi";
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
  
      if($this->loading_model->hapus_by_id($id)){
        $status = "success";
        $msg    = "Permintaan loading keluar berhasil ditolak";
      } else{
        $status = "error";
        $msg = "Kesalahan pada server";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
  }
  
  public function scan()
  { 
    $data['title'] = $this->title;

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-keluar-scan.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-keluar-scan.php');
  }

  public function scan_proses()
  { 
    // INSERT DATABASE
      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      $materials = json_decode($this->input->post('materials'));

      // return die(var_dump($materials[0]));

      // // SET DATA
      $data_loading['type']  = "Keluar";
      $data_loading['is_valid']  = 0;
      $data_loading['tgl_scan']  = date('Y-m-d H:i:s');
      $data_loading['tgl_valid']  = date('Y-m-d H:i:s');
  
      if($this->loading_model->tambah($data_loading)){
        $loading = $this->loading_model->last_id()->row_array();
        // $materials = $this->input->post('materials');

        foreach($materials as $material):
          $data_scan['id_loading']   = $loading['id'];
          $data_scan['id_material']  = $material -> id_material;
          $data_scan['no_qr']        = $material -> no_qr;
          $this->scan_model->tambah($data_scan);
        endforeach;

        $status = "success";
        $msg    = "hasil scan dikirim ke sistem, permintaan loading keluar material berhasil!";
      } else{
        $status = "error";
        $msg = "hasil scan gagal dikirim ke sistem, silahkan coba lagi.";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
  }

}
