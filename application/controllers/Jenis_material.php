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
    $this->load->view('functions/'. $this->page .'.php');
  }

  public function create()
  { 
     // UPLOAD FOTO
      // SET CONFIG
      $config['upload_path']    = "./public/img/materials";
      $config['allowed_types']  = 'jpg|png|jpeg';
      $config['max_size']       = '5000';
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);
      // GET DATA
      $file = $this->input->post('file');

      // SEND DATA TO DB
        if ( !$this->upload->do_upload('file')){
          $status = "error";
          $msg = $this->upload->display_errors();
          $dataupload = NULL;
        }else{
          $dataupload = $this->upload->data();
          $dataupload = $dataupload['file_name'];
        }
      // INSERT DATABASE
      // GET DATA
      $nama       = $this->input->post('nama');

      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data['nama']              = $nama;
      $data['satuan']            = $this->input->post('satuan');
      $data['satuan_konversi']   = $this->input->post('satuan_konversi');
      $data['nilai_konversi']    = $this->input->post('nilai_konversi');
      $data['foto']              = $dataupload;
      $data['created_at']       = date('Y-m-d H:i:s');
      $data['last_update']       = date('Y-m-d H:i:s');
  
      $cek_nama = $this->jenis_material_model->by('nama', $nama)->num_rows();
      if($cek_nama < 1){
        if($this->jenis_material_model->tambah($data)){
          $status = "success";
          $msg    = "Jenis material berhasil ditambahkan";
        } else{
          $status = "error";
          $msg = "Kesalahan pada server";
        }
      } else{
        $status = "error";
        $msg = "Nama jenis material sudah ada";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg))); 
  }

  public function edit()
  { 
    // UPLOAD FOTO
      // SET CONFIG
      $config['upload_path']    = "./public/img/materials";
      $config['allowed_types']  = 'jpg|png|jpeg';
      $config['max_size']       = '5000';
      $config['encrypt_name'] = TRUE;

      $this->load->library('upload', $config);
      // GET DATA
      $file = $this->input->post('file');

      // SEND DATA TO DB
        if ( !$this->upload->do_upload('file')){
          $status = "error";
          $msg = $this->upload->display_errors();
          $dataupload = NULL;
        }else{
          $dataupload = $this->upload->data();
          $dataupload = $dataupload['file_name'];
        }
    // INSERT DATABASE
      // GET DATA
      $nama       = $this->input->post('nama');

      // CHANGE TIMEZONE
      date_default_timezone_set("Asia/Jakarta");

      // SET DATA
      $data['nama']              = $nama;
      $data['satuan']            = $this->input->post('satuan');
      $data['satuan_konversi']   = $this->input->post('satuan_konversi');
      $data['nilai_konversi']    = $this->input->post('nilai_konversi');
      $data['foto']              = $dataupload;
      $data['last_update']       = date('Y-m-d H:i:s');

      $where['id'] = $this->input->post('id');
  
      if($this->jenis_material_model->update_by_id($where, $data)){
        $status = "success";
        $msg    = "Jenis material berhasil diubah";
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
  
      if($this->jenis_material_model->hapus_by_id($id)){
        $status = "success";
        $msg    = "Jenis material berhasil dihapus";
      } else{
        $status = "error";
        $msg = "Kesalahan pada server";
      }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status'=>$status,'msg'=>$msg)));
    
  }

}
