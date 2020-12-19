<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vendor extends CI_Controller
{
  public $page = 'vendor';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('VendorModel');
  }

  public function index()
  {
    $data['page'] = $this->page;
    $data['vendor'] = $this->VendorModel->GetVendor()->result_array();
    $this->template->load('template', 'vendor/vendor', $data);
  }

  public function FormInputVendor()
  {
    $data['page'] = $this->page;
    $this->template->load('template', 'vendor/input_vendor', $data);
  }

  public function FormEditVendor()
  {
    $data['page'] = $this->page;
    $data['vendor'] = $this->VendorModel->GetVendor($id = ['id_vendor' => $this->uri->segment(2)])->row();
    $this->template->load('template', 'vendor/edit_vendor', $data);
  }

  //Untuk select 2 ajax
  public function GetVendorAjax()
  {
    $data = $this->VendorModel->GetVendorAjax($this->input->get('nama_vendor'));
    echo json_encode($data);
  }

  public function CreateVendor()
  {
    $data = array(
      'nama_vendor' => trim($this->input->post('nama_vendor')),
      'no_tlp' => trim($this->input->post('no_tlp')),
      'alamat' => trim($this->input->post('alamat')),
      'no_npwp' => trim($this->input->post('no_npwp')),
      'no_pic' => trim($this->input->post('no_pic')),
      'bidang_usaha' => trim($this->input->post('bidang_usaha')),
    );

    $cek = $this->VendorModel->InsertVendor($data);

    if ($cek) {
      $this->session->set_flashdata('success', 'Data vendor berhasil ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data vendor gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function UpdateVendor()
  {
    $data = array(
      'nama_vendor' => trim($this->input->post('nama_vendor')),
      'no_tlp' => trim($this->input->post('no_tlp')),
      'alamat' => trim($this->input->post('alamat')),
      'no_npwp' => trim($this->input->post('no_npwp')),
      'no_pic' => trim($this->input->post('no_pic')),
      'bidang_usaha' => trim($this->input->post('bidang_usaha')),
    );

    $cek = $this->VendorModel->update($id = ['id_vendor' => $this->input->post('id_vendor')], $data);

    if ($cek) {
      $this->session->set_flashdata('success', 'Data vendor berhasil dirubah');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data vendor gagal dirubah');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function DeleteVendor()
  {
    $cek = $this->VendorModel->DeleteVendor($id = ['id_vendor' => $this->uri->segment(2)]);

    if ($cek) {
      $this->session->set_flashdata('success', 'Data vendor berhasil dihapus');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data vendor gagal dihapus');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
