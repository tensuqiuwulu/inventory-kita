<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
  public $page = 'users';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('UsersModel');
  }

  public function index()
  {
    $data['page'] = $this->page;
    $data['users'] = $this->UsersModel->GetUsers()->result_array();
    $this->template->load('template', 'users/users', $data);
  }

  public function FormInputUser()
  {
    $data['page'] = $this->page;
    $this->template->load('template', 'users/input_user', $data);
  }

  public function FormEditUser()
  {
    $data['page'] = $this->page;
    $data['users'] = $this->UsersModel->GetUsers($this->uri->segment(2))->row();
    $this->template->load('template', 'users/edit_user', $data);
  }

  public function AddUser()
  {
    $password = $this->input->post('password');
    $encryptPassword = md5($password);

    $dataUser = [
      'nama_user' => $this->input->post('nama_user'),
      'no_hp' => $this->input->post('no_hp'),
      'username' => $this->input->post('username'),
      'kode_kantor' => $this->input->post('kode_kantor'),
      'level_user' => $this->input->post('level_user'),
      'status_aktif' => $this->input->post('status_aktif'),
      'password' => $encryptPassword
    ];

    $cekInsertUser = $this->UsersModel->insert($dataUser);
    if ($cekInsertUser) {
      $this->session->set_flashdata('success', 'Data user berhasil ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data user gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function UpdateUser()
  {
    $password = $this->input->post('password');
    if ($password == null) {
      $dataUsers = $this->UsersModel->GetUserByUsername($username = ['username' => $this->input->post('username')]);
      $encryptPassword = $dataUsers->password;
    } else {
      $encryptPassword = md5($password);
    }

    $dataUser = [
      'nama_user' => $this->input->post('nama_user'),
      'no_hp' => $this->input->post('no_hp'),
      'username' => $this->input->post('username'),
      'kode_kantor' => $this->input->post('kode_kantor'),
      'level_user' => $this->input->post('level_user'),
      'status_aktif' => $this->input->post('status_aktif'),
      'password' => $encryptPassword
    ];

    $cekUpdateUser = $this->UsersModel->update($this->input->post('id_kategori'), $dataUser);
    if ($cekUpdateUser) {
      $this->session->set_flashdata('success', 'Data user berhasil dirubah');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data user gagal dirubah');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
