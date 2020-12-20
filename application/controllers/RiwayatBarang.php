<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RiwayatBarang extends CI_Controller
{
  public $page = 'barang';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('RiwayatModel');
  }

  public function index()
  {
    $idBarang = $this->uri->segment(2);
    $data['page'] = $this->page;
    $data['riwayat'] = $this->RiwayatModel->GetRiwayatPerBarang($id = ['id_barang' => $idBarang]);
    $this->template->load('template', 'riwayat_barang/riwayat_transaksi', $data);
  }
}
