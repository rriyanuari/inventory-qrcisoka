<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Loading_keluar extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('jenis_material_model');
    $this->load->model('proyek_model');
    $this->load->model('material_model');
    $this->load->model('loading_model');
    $this->load->model('loading_detail_model');
    $this->load->model('scan_model');

    $this->page = 'loading-keluar';
    $this->title = ucwords(str_replace('-', ' ', $this->page));
  }

  public function index()
  {
    $data['title'] = $this->title;

    $loadings = $this->loading_model->by_satuan([
      'type' => "Keluar",
      'is_valid' => 0
    ])->result_array();

    $data_merge = array();

    foreach ($loadings as $loading) :
      $item = $loading;

      $where_scan['id_loading'] = $loading['id'];
      $scans = $this->scan_model->by_and_join($where_scan)->result_array();

      $item['scans'] = $scans;

      array_push($data_merge, $item);
    endforeach;


    $data['loadings'] = $data_merge;
    $data['proyeks'] = $this->proyek_model->semua()->result_array();

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/loading-keluar.php', $data);
    $this->load->view('templates/footer.php', $data);
    $this->load->view('functions/loading-keluar.php');
  }

  public function validasi()
  {
    // CHANGE TIMEZONE
    date_default_timezone_set("Asia/Jakarta");

    // SET DATA -> LOADING
    $data['id_proyek']      = $this->input->post('id_proyek');
    $data['keterangan']     = $this->input->post('keterangan');
    $data['is_valid']       = 1;
    $data['tgl_valid']      = date('Y-m-d H:i:s');

    // INSERT DATA -> DB -> LOADING 
    if (!$this->loading_model->update_by(['id' => $this->input->post('id_loading')], $data)) {
      $status = "error";
      $msg = "Loading material keluar gagal divalidasi, silahkan coba lagi";
    }

    $id_loading = $this->input->post('id_loading');
    $scans = $this->scan_model->where_group_by(['id_loading' => $id_loading], "id_material");

    foreach($scans->result_array() as $scan)
    {
      // UPDATE DATA -DB -> CALL PROSEDUR (prosedur_loading_keluar)
      if(!$this->material_model->loading_keluar($scan['id_material'], $scan['qty'])){
        $status = "error";
        $msg = "Loading material keluar gagal divalidasi, silahkan coba lagi";
      }
    }

    $status = "success";
    $msg    = "Loading material keluar berhasil divalidasi, data sudah tercatat di sistem";
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }

  public function delete()
  {
    // INSERT DATABASE
    // GET DATA
    $id       = $this->input->post('id');

    // SET DATA
    $data['id'] = $id;

    if ($this->loading_model->hapus_by_id($id)) {
      $status = "success";
      $msg    = "Permintaan loading keluar berhasil ditolak";
    } else {
      $status = "error";
      $msg = "Kesalahan pada server";
    }
    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
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
    // CHANGE TIMEZONE
    date_default_timezone_set("Asia/Jakarta");

    $materials = json_decode($this->input->post('materials'));

    // INSERT DATA -> DB -> LOADING
    $data_loading['type']  = "Keluar";
    $data_loading['is_valid']  = 0;
    $data_loading['tgl_permintaan']  = date('Y-m-d H:i:s');

    if (!$this->loading_model->tambah($data_loading)) {
      $status = "error";
      $msg = "Permintaan loading material gagal, silahkan coba lagi";
    }

    // INSERT DATA -> DB -> SCAN
    $loading = $this->loading_model->last_id()->row_array();
    foreach ($materials as $material) :
      $data_scan['id_loading']   = $loading['id'];
      $data_scan['id_material']  = $material->id_material;
      $data_scan['no_qr']        = $material->no_qr;

      if ($this->scan_model->tambah($data_scan)) {
        $status = "error";
        $msg = "Permintaan loading material gagal, silahkan coba lagi";
      }
    endforeach;

    $grouped_materials = array();
    foreach ($materials as $item) {
      $key = $item->id_material;
      if (!isset($grouped_materials[$key])) {
        $grouped_materials[$key] = array(
          'id_material' => $key,
          'count' => 1,
        );
      } else {
        $grouped_materials[$key]['id_material'] = $key;
        $grouped_materials[$key]['count'] += 1;
      }
    }

    foreach ($grouped_materials as $grouped_material) {

      $material = $this->material_model->by([
        'material.id' => $grouped_material['id_material']
      ])->row_array();

      // GET DATA -> DB -> MATERIALS by ID JENIS MATERIAL && STATUS (1 || VALID)
      $materials = $this->material_model->by([
        'material.id_jenis_material' => $material['id_jenis_material'],
        'material.status'  => 1
      ])->result_array();

      $data_loading_detail['total_qty_awal'] = 0;
      foreach ($materials as $material) {
        $data_loading_detail['total_qty_awal']  += $material['qty'];
      }

      $data_loading_detail['id_loading']          = $loading['id'];
      $data_loading_detail['id_material']         = $material['id'];
      $data_loading_detail['qty_loading']         = $grouped_material['count'];
      $data_loading_detail['total_qty_akhir']     = $data_loading_detail['total_qty_awal'] - $data_loading_detail['qty_loading'];

      // INSERT DATA -> DB -> LOADING DETAIL
      if (!$this->loading_detail_model->tambah($data_loading_detail)) {
        $status = "error";
        $msg = "Permintaan loading material gagal, silahkan coba lagi";
      }
    }

    $status = "success";
    $msg    = "hasil scan dikirim ke sistem, permintaan loading keluar material berhasil!";

    $this->output->set_content_type('application/json')->set_output(json_encode(array('status' => $status, 'msg' => $msg)));
  }
}
