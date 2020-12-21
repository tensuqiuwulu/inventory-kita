<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyStock extends CI_Controller
{
  public $page = 'my_stock';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('BarangModel');
    $this->load->model('MyStockModel');
  }

  public function index()
  {
    $data['page'] = $this->page;
    $data['my_stock'] = $this->MyStockModel->GetMyStock()->result_array();
    $this->template->load('template', 'mystock/mystock', $data);
  }

  public function FormInputMyStock()
  {
    $data['page'] = $this->page;
    $this->template->load('template', 'mystock/input_mystock', $data);
  }
}
