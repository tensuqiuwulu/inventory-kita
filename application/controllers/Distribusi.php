<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Distribusi extends CI_Controller
{
  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('BarangModel');
    $this->load->model('DistribusiBarangModel');
    $this->load->model('KantorModel');
  }

  public function index()
  {
    $data['page'] = 'distribusi';
    $data['kantor'] = $this->KantorModel->get_list();
    $this->template->load('template', 'distribusi/list_distribusi_kantor', $data);
  }

  public function index_create()
  {
    $data['page'] = 'distribusi';
    $id_barang = $this->uri->segment(3);
    $data['barang'] = $this->BarangModel->get_list_detail($id_barang);
    $data['kantor'] = $this->KantorModel->get_list();
    $this->template->load('template', 'distribusi/input_distribusi', $data);
  }

  public function index_detail()
  {
    $id_kantor = $this->uri->segment(2);
    $data['distribusi'] = $this->DistribusiBarangModel->get_list_perkantor($id_kantor);
    $data['page'] = 'distribusi';
    $this->template->load('template', 'distribusi/list_distribusi_perkantor', $data);
  }

  public function create_action()
  {
    $id_kantor = trim($this->input->post('id_kantor'));
    $id_barang = trim($this->input->post('id_barang'));
    $id_user = $this->session->userdata('id_user');
    $distribusi_qty = trim($this->input->post('distribusi_qty'));
    $current_time = date('Y-m-d', time());

    $data = array(
      'id_barang' => $id_barang,
      'id_kantor' => $id_kantor,
      'id_user' => $id_user,
      'total_distribusi_qty' => $distribusi_qty,
      'sisa_distribusi_qty' => $distribusi_qty,
      'tgl_distribusi' => $current_time
    );

    $cek_insert = $this->DistribusiBarangModel->insert($data);

    if ($cek_insert) {
      $id = array(
        'id_barang' => $id_barang
      );

      $sisa_qty = $this->BarangModel->get_list_detail($id_barang);
      $jml_qty_saat_ini = $sisa_qty->qty_saat_ini - $distribusi_qty;

      $data_qty = array(
        'qty_saat_ini' => $jml_qty_saat_ini
      );

      $cek_update = $this->BarangModel->update($id, $data_qty);
      if ($cek_update) {
        $this->session->set_flashdata('success', 'Barang berhasil didistribusikan');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      } else {
        $this->session->set_flashdata('success', 'Barang gagal didistribusikan');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    } else {
      $this->session->set_flashdata('error', 'Data barang gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
