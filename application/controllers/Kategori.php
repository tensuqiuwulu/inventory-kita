<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
  public $page = 'kategori';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('KategoriModel');
  }

  public function index()
  {
    $data['page'] = $this->page;
    $data['kategori'] = $this->KategoriModel->GetKategori()->result_array();
    $this->template->load('template', 'kategori/kategori', $data);
  }

  public function FormInputKategori()
  {
    $data['page'] = $this->page;
    $this->template->load('template', 'kategori/input_kategori', $data);
  }

  public function FormEditKategori()
  {
    $data['page'] = $this->page;
    $data['kategori'] = $this->KategoriModel->GetKategori($id = ['id_kategori' => $this->uri->segment(2)])->row();
    $this->template->load('template', 'kategori/edit_kategori', $data);
  }

  public function GetKodeKategori()
  {
    $data = $this->KategoriModel->GetKategori($id = ['id_kategori' => $this->uri->segment(3)])->row();
    echo json_encode($data);
  }

  public function CreateKategori()
  {
    $data = array(
      'jenis_kategori' => trim($this->input->post('jenis_kategori')),
      'kode_kategori' => trim($this->input->post('kode_kategori'))
    );

    $cek = $this->KategoriModel->InsertKategori($data);

    if ($cek) {
      $this->session->set_flashdata('success', 'Data kategori berhasil ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data kategori gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function UpdateKategori()
  {
    $data = array(
      'jenis_kategori' => trim($this->input->post('jenis_kategori')),
      'kode_kategori' => trim($this->input->post('kode_kategori'))
    );

    $cek = $this->KategoriModel->UpdateKategori($id = ['id_kategori' => $this->input->post('id_kategori')], $data);

    if ($cek) {
      $this->session->set_flashdata('success', 'Data kategori berhasil dirubah');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data kategori gagal dirubah');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function DeleteKategori()
  {
    $cek = $this->KategoriModel->DeleteKategori($id = ['id_kategori' => $this->uri->segement(2)]);

    if ($cek) {
      $this->session->set_flashdata('success', 'Data kategori berhasil dihapus');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data kategori gagal dihapus');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
