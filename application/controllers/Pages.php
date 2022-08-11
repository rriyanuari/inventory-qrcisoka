<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pages extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    // $this->load->model('model_auth');
  }

  public function index($page = 'dashboard')
  {
    if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
      // Whoops, we don't have a page for that!
      show_404();
    }
    
    $data = [
      'title' => ucfirst($page)
    ];

    $this->load->view('templates/header.php', $data);
    $this->load->view('pages/' . $page . '.php', $data);
    $this->load->view('templates/footer.php', $data);
  }

}
