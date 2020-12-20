<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permintaan extends CI_Controller
{
  public $page = 'permintaan';

  function __construct()
  {
    date_default_timezone_set('Asia/Singapore');
    parent::__construct();
    $this->load->model('PermintaanModel');
    $this->load->model('BarangModel');
    $this->load->model('RiwayatModel');
  }

  public function index()
  {
    $data['page'] = $this->page;
    $data['permintaan'] = $this->PermintaanModel->GetPermintaan()->result_array();
    $this->template->load('template', 'Permintaan/list_permintaan', $data);
  }

  public function InputPermintaan()
  {
    $data['page'] = $this->page;
    $this->template->load('template', 'permintaan/input_permintaan', $data);
  }

  public function AddPermintaan()
  {
    $divisi = $this->session->userdata('divisi');

    $data = array(
      'id_barang' => $this->input->post('id_barang'),
      'stock_permintaan' => $this->input->post('stock_permintaan'),
      'tgl_permintaan' => date('Y-m-d', time()),
      'divisi_peminta' => $divisi,
      'status_permintaan' => 0
    );

    $cek = $this->PermintaanModel->insert($data);

    if ($cek) {
      $this->session->set_flashdata('success', 'Permintaan berhasil dibuat');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Permintaan berhasil dibuat');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function DetailVerifikasi()
  {
    $data['page'] = $this->page;
    $data['permintaan'] = $this->PermintaanModel->GetPermintaan($this->uri->segment(2))->row();
    $this->template->load('template', 'permintaan/detail', $data);
  }

  public function Verifikasi()
  {
    $id_permintaan = $this->input->post('id_permintaan');
    $data = array(
      'status_permintaan' => 2,
    );

    $id_permintaan = array(
      'id_permintaan' => $id_permintaan,
    );

    $cek = $this->PermintaanModel->update($id_permintaan, $data);

    if ($cek) {
      $this->session->set_flashdata('success', 'Berhasil Diverifikasi');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Gagal Di verifikasi');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function Distribusi()
  {
    #Cek Barang
    $dataBarang = $this->BarangModel->GetBarang($id = ['id_barang' => $this->uri->segment(4)])->row();
    #Cek Permintaan
    $dataPermintaan = $this->PermintaanModel->GetPermintaan($this->uri->segment(3))->row();

    if ($dataPermintaan->stock_permintaan >= $dataBarang->stock_akhir) {
      $this->session->set_flashdata('error', 'Mohon maaf data persediaan tidak cukup');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      die;
    } else {
      #Mengurangi stock barang saat ini dengan stock permintaan
      $jmlStock = $dataBarang->stock_akhir - $dataPermintaan->stock_permintaan;

      #Update stock barang saat ini dengan nilai stock yg telah di kurangi
      $dataBarangNew = [
        'stock_akhir' => $jmlStock
      ];
      $cekUpdateBarang = $this->BarangModel->update($dataBarang->id_barang, $dataBarangNew);

      #Tambahkan data riwayat transaksi distribusi barang
      $dataRiwayatTransaksi = [
        'id_barang' => $dataBarang->id_barang,
        'kode_riwayat' => 202,
        'tgl_riwayat' => date('Y-m-d', time()),
        'keterangan' => 'Distribusi ' . $dataBarang->nama_barang . ' Ke ' . $dataPermintaan->divisi_peminta,
        'stock_keluar' => $dataPermintaan->stock_permintaan,
        'total' => $jmlStock
      ];

      $cekInsertRiwayat = $this->RiwayatModel->AddRiwayat($dataRiwayatTransaksi);

      if ($cekInsertRiwayat && $cekUpdateBarang) {
        $this->session->set_flashdata(
          'success',
          'Barang Berhasil Di Distribusikan'
        );
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      } else {
        $this->session->set_flashdata('error', 'Error');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
      }
    }
  }
}
