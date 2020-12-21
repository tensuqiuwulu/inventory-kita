<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Divisi extends CI_Controller
{
  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('DivisiModel');
  }

  public function index()
  {
    $data['page'] = 'divisi';
    $data['divisi'] = $this->DivisiModel->GetDivisi()->result_array();
    $this->template->load('template', 'divisi/divisi', $data);
  }

  public function GetDivisiAjax()
  {
    $data = $this->DivisiModel->GetDivisiAjax($this->input->get('nama_divisi'));
    echo json_encode($data);
  }

  public function FormInputDivisi()
  {
    $data['page'] = 'divisi';
    $this->template->load('template', 'divisi/input_divisi', $data);
  }

  public function FormEditDivisi()
  {
    $data['page'] = 'divisi';
    $data['divisi'] = $this->DivisiModel->GetDivisi($this->uri->segment(2))->row();
    $this->template->load('template', 'divisi/edit_divisi', $data);
  }

  public function AddDivisi()
  {
    $dataDivisi = [
      'nama_divisi' => $this->input->post('nama_divisi')
    ];

    $cekInsertDivisi = $this->DivisiModel->insert($dataDivisi);

    if ($cekInsertDivisi) {
      $this->session->set_flashdata('success', 'Data divisi berhasil ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data divisi gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function EditDivisi()
  {
    # code...
  }
}
