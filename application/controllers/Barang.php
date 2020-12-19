<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
  public $page = 'barang';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('BarangModel');
    $this->load->model('VendorModel');
    $this->load->model('KategoriModel');
    $this->load->model('PembelianModel');
    $this->load->model('RiwayatModel');
  }

  public function index()
  {
    $data['page'] = $this->page;
    $data['barang'] = $this->BarangModel->GetBarang()->result_array();
    $this->template->load('template', 'barang/barang', $data);
  }

  public function RiwayatTransaksiBarang()
  {
    $idBarang = $this->uri->segment(2);
    $data['page'] = $this->page;
    $data['riwayat'] = $this->RiwayatModel->GetRiwayatPerBarang($id = ['id_barang' => $idBarang]);
    //$data['detailBarang'] = $this->BarangModel->GetBarang($id = ['kode_barang' => $kodeBarang]);
    //$data['pembelian'] = $this->PembelianModel->get_list_by_barang($this->uri->segment(3));
    $this->template->load('template', 'barang/riwayat_transaksi', $data);
  }

  //untuk select2 ajax
  public function GetBarangAjax()
  {
    $data = $this->BarangModel->GetBarangAjax($this->input->get('nama_barang'));
    echo json_encode($data);
  }

  public function FormInputBarang()
  {
    $data['page'] = $this->page;
    $data['kategori'] = $this->KategoriModel->GetKategori()->result_array();
    $this->template->load('template', 'barang/input_barang', $data);
  }

  public function AddBarang()
  {
    $kodeKategori = $this->input->post('kode_kategori');
    $cekKodeBarang = $this->BarangModel->CekKodeBarang($kodeKategori);

    if ($cekKodeBarang == null) {
      $kodeBarang = $kodeKategori . '001';
    } else {
      $noUrut = substr($cekKodeBarang->kode_barang, 3, 3);
      $kodeBaru = $noUrut + 1;
      if ($kodeBaru < 10) {
        $kodeBarang = $kodeKategori . '00' . $kodeBaru;
      } else if ($kodeBaru >= 10) {
        $kodeBarang = $kodeKategori . '0' . $kodeBaru;
      }
    }

    $dataBarang = array(
      'kode_barang' => $kodeBarang,
      'id_kategori' => trim($this->input->post('id_kategori')),
      'nama_barang' => trim($this->input->post('nama_barang')),
      'stock_awal' => trim($this->input->post('stock_awal')),
    );

    $getId = $this->BarangModel->insert($dataBarang);

    if ($getId != NULL) {
      $current_time = date('Y-m-d', time());

      $dataRiwayat = array(
        'keterangan' => 'Input data pertama',
        'stock_sekarang' => trim($this->input->post('stock_awal')),
        'total' => trim($this->input->post('stock_awal')),
        'id_barang' => $getId,
        'tgl_riwayat' => $current_time
      );

      $cekInsert = $this->RiwayatModel->AddRiwayat($dataRiwayat);

      if ($cekInsert) {
        $this->session->set_flashdata('success', 'Data barang berhasil ditambahkan');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      } else {
        $this->session->set_flashdata('error', 'Data barang gagal ditambahkan');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    } else {
      $this->session->set_flashdata('error', 'Data barang gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }
}
