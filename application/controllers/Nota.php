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
    $this->template->load('template', 'pembelian/list_nota_pembelian', $data);
  }

  public function form_input_barang()
  {
    $data['page'] = $this->page;
    $data['nota'] = $this->NotaModel->get_list_detail($this->uri->segment(2))->row();
    $this->template->load('template', 'pembelian/input_pembelian', $data);
  }

  public function get_list_barang($no_nota)
  {
    $data = $this->PembelianModel->get_list_by_nota($no_nota)->result();
    echo json_encode($data);
  }

  public function create_nota()
  {
    $data = array(
      'no_nota' => $this->input->post('no_nota'),
      'tgl_pembelian' => $this->input->post('tgl_pembelian'),
      'verifikasi' => 0
    );

    $cek_insert = $this->NotaModel->insert($data);

    if ($cek_insert) {
      $this->session->set_flashdata('success', 'Data nota berhasil ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      $this->session->set_flashdata('error', 'Data nota gagal ditambahkan');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
  }

  public function add_barang()
  {
    // $idBarang = $this->uri->segment(4);
    // var_dump($idBarang);
    // die;
    $idBarang = $this->input->post('id_barang');
    $qty = $this->input->post('qty');
    $data = array(
      'id_vendor' => $this->input->post('id_vendor'),
      'id_barang' => $idBarang,
      'no_nota' => $this->input->post('no_nota'),
      'qty' => $qty,
      'harga_satuan' => $this->input->post('harga_satuan'),
    );

    $cek = $this->PembelianModel->insert($data);


    //cek data barang
    $dataBarang = $this->BarangModel->GetBarang($idBarang)->row();

    //update jumlah barang pada barang
    $jmlStock = $dataBarang->stock_awal + $qty;
    $dataBarangUpdate = [
      'stock_akhir' => $jmlStock,
    ];

    $this->BarangModel->update($idBarang, $dataBarangUpdate);

    //Cek riwayat


    //input ke riwayat pembelian
    $current_time = date('Y-m-d', time());
    if ($dataBarang->stock_akhir == null) {
      $stockSaatIni = $dataBarang->stock_awal + $qty;
    } else {
      $stockSaatIni = $dataBarang->stock_akhir + $qty;
    }

    $dataRiwayat = array(
      'keterangan' => 'Pembelian ' . $dataBarang->nama_barang,
      'stock_masuk' => $qty,
      'total' => $stockSaatIni,
      'id_barang' => $idBarang,
      'tgl_riwayat' => $current_time
    );

    $this->RiwayatModel->AddRiwayat($dataRiwayat);
  }

  public function delete()
  {
    $cek_delete = $this->PembelianModel->delete($this->uri->segment(3));
  }
}
