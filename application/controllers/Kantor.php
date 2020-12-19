<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kantor extends CI_Controller
{
  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('BarangModel');
    $this->load->model('KantorModel');
  }

  public function index()
  {
    $data['page'] = 'barang';
    $this->template->load('template', 'barang/list_barang', $data);
  }
}
