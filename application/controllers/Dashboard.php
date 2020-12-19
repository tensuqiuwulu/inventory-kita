<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data['page'] = 'dashboard';
    $this->template->load('template', 'dashboard', $data);
  }
}
