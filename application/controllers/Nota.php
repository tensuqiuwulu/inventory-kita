<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nota extends CI_Controller
{
  public $page = 'pembelian';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('PembelianModel');
    $this->load->model('BarangModel');
    $this->load->model('NotaModel');
    $this->load->model('RiwayatModel');
  }

  public function index()
  {
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_akhir = $this->input->post('tgl_akhir');

    $awal = date('Y-m-d', strtotime($tgl_awal));
    $akhir = date('Y-m-d', strtotime($tgl_akhir));

    if ($tgl_awal == null && $tgl_akhir == null) {
      $current_time = date('Y-m-d', time());
      $awal = $current_time;
      $akhir = $current_time;
    }

    $data['nota'] = $this->NotaModel->get_list($awal, $akhir)->result_array();
    $data['page'] = $this->page;
    $this->template->load('template', 'nota/nota', $data);
  }

  public function AddNota()
  {
    $data = array(
      'no_nota' => $this->input->post('no_nota'),
      'tgl_pembelian' => $this->input->post('tgl_pembelian'),
      'verifikasi' => 0
    );

    $cekInsert = $this->NotaModel->insert($data);

    if ($cekInsert) {
      $this->session->set_flashdata('success', 'Data nota berhasil ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data nota gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
