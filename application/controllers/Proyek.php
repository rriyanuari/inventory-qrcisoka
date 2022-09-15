<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('proyek_model');

    $this->page = 'proyek';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  { 
    $data['title'] = $this->title;
    $data['proyeks'] = $this->proyek_model->semua();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/'. $this->page .'.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/'. $this->page .'.php');
  }

  public function create()
  { 
    // INSERT DATABASE
      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data['id']               = $this->input->post('id');
      $data['nama']             = $this->input->post('nama');
      $data['tgl_mulai']        = $this->input->post('tgl_mulai');
      $data['created_at']       = date('Y-m-d H:i:s');
      $data['last_update']      = date('Y-m-d H:i:s');

      $where_nama['nama'] = $data['nama'];
  
      if($this->proyek_model->by($where_nama)->num_rows() > 0){
        $status = "error";
        $msg = "Nama proyek sudah ada, silahkan isikan nama lain";

        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
        return false;
      };

      $where_id['id'] = $data['id'];

      if($this->proyek_model->by($where_id)->num_rows() > 0){
        $status = "error";
        $msg = "ID proyek sudah ada, silahkan isikan ID lain";

        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
        return false;
      };


      if($this->proyek_model->tambah($data)){
        $status = "success";
        $msg    = "Proyek berhasil ditambahkan";
      } else{
        $status = "error";
        $msg = "Kesalahan pada server";
      }
      $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
  }

  public function edit()
  { 
    // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data['id']               = $this->input->post('id_new');
      $data['nama']             = $this->input->post('nama');
      $data['tgl_mulai']        = $this->input->post('tgl_mulai');
      $data['created_at']       = date('Y-m-d H:i:s');
      $data['last_update']      = date('Y-m-d H:i:s');

      $where_nama['nama'] = $data['nama'];
      $cek_nama = $this->proyek_model->by($where_nama);
  
      if( $cek_nama->num_rows() > 0 && $cek_nama->row('nama') != $data['nama'] ){
        $status = "error";
        $msg = "Nama proyek sudah ada, silahkan isikan nama lain";

        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
        return false;
      };

      $where_id['id'] = $data['id'];
      $cek_id = $this->proyek_model->by($where_id);

      if( $cek_id->num_rows() > 0 && $cek_id->row('id') != $data['id'] ){
        $status = "error";
        $msg = "ID proyek sudah ada, silahkan isikan ID lain";

        $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
        return false;
      };

      $where_update['id'] = $this->input->post('id');
      if($this->proyek_model->update_by_id($where_update, $data)){
        $status = "success";
        $msg    = "Proyek berhasil diubah";
      } else{
        $status = "error";
        $msg = "Kesalahan pada server";
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
  
      if($this->proyek_model->hapus_by_id($id)){
        $status = "success";
        $msg    = "Proyek berhasil dihapus";
      } else{
        $status = "error";
        $msg = "Kesalahan pada server";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
  }

}
