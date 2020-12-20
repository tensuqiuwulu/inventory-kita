<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianBarang extends CI_Controller
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
    $data['page'] = $this->page;
    $data['nota'] = $this->NotaModel->get_list_detail($this->uri->segment(2))->row();
    $this->template->load('template', 'pembelian/input_pembelian', $data);
  }

  public function GetListBarangAjax($nota)
  {
    $data = $this->PembelianModel->GetListCart($nota)->result();
    echo json_encode($data);
  }

  public function AddCart()
  {
    $idBarang = $this->input->post('id_barang');
    $qty = $this->input->post('qty');
    $data = array(
      'id_vendor' => $this->input->post('id_vendor'),
      'id_barang' => $idBarang,
      'no_nota' => $this->input->post('no_nota'),
      'qty' => $qty,
      'harga_satuan' => $this->input->post('harga_satuan'),
    );

    $this->PembelianModel->insert($data);
  }

  public function VerifikasiCart()
  {
    $kodePembelian = $this->input->post('kode_pembelian');
    $current_time = date('Y-m-d', time());
    foreach ($kodePembelian as $kode) {
      //get data pembelian dari kode pembelian
      $dataPembelian = $this->PembelianModel->GetCart($kode)->row();

      //cek data barang
      $dataBarang = $this->BarangModel->GetBarang($dataPembelian->id_barang)->row();

      //update jumlah barang pada barang
      if ($dataBarang->stock_akhir == 0) {
        $jmlStock = $dataBarang->stock_awal + $dataPembelian->qty;
      } else {
        $jmlStock = $dataBarang->stock_akhir + $dataPembelian->qty;
      }

      $dataBarangUpdate = [
        'tgl_trans_terakhir' => $current_time,
        'stock_akhir' => $jmlStock,
        'harga_satuan_terakhir' => $dataPembelian->harga_satuan
      ];

      $cekUpdateBarang = $this->BarangModel->update($dataPembelian->id_barang, $dataBarangUpdate);
      if (!$cekUpdateBarang) {
        echo json_encode("Error Saat Update Barang");
        die;
      }

      //Cek riwayat
      //input ke riwayat pembelian
      if ($dataBarang->stock_akhir == 0) {
        $stockSaatIni = $dataBarang->stock_awal + $dataPembelian->qty;
      } else {
        $stockSaatIni = $dataBarang->stock_akhir + $dataPembelian->qty;
      }

      $dataRiwayat = array(
        'keterangan' => 'Pembelian ' . $dataBarang->nama_barang,
        'stock_masuk' => $dataPembelian->qty,
        'total' => $stockSaatIni,
        'id_barang' => $dataPembelian->id_barang,
        'tgl_riwayat' => $current_time
      );

      $cekInserRiwayat = $this->RiwayatModel->insert($dataRiwayat);
      if (!$cekInserRiwayat) {
        echo "Error Saat Insert Riwayat";
        die;
      }

      //update status verifikasi cart
      $dataCart = [
        'status_verifikasi' => 1
      ];

      $cekUpdatePembelian = $this->PembelianModel->update($kode, $dataCart);
      if (!$cekUpdatePembelian) {
        echo "Error Saat Update Pembelian";
        die;
      }
    }
    echo json_encode($this->session->set_flashdata('success', 'Data barang berhasil diverifikasi'));
  }

  public function DeleteCart()
  {
    $cek_delete = $this->PembelianModel->delete($this->uri->segment(3));
  }
}
