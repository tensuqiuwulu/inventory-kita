<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianModel extends CI_Model
{
  public $table = 'pembelian';

  public function get_list($tgl_awal = null, $tgl_akhir = null)
  {
    $this->db->select('*')
      ->from($this->table)
      ->join('barang', 'barang.id_barang = pembelian.id_barang')
      ->join('vendor', 'vendor.id_vendor = pembelian.id_vendor')
      ->where('pembelian.tgl_pembelian >=', $tgl_awal)
      ->where('pembelian.tgl_pembelian <=', $tgl_akhir);
    return $this->db->get();
  }

  public function get_list_by_nota($no_nota)
  {
    $this->db->select('*')
      ->from('pembelian')
      ->join('vendor', 'vendor.id_vendor = pembelian.id_vendor')
      ->join('barang', 'barang.id_barang = pembelian.id_barang')
      ->join('nota', 'nota.no_nota = pembelian.no_nota')
      ->where('nota.no_nota', $no_nota)
      ->order_by('kode_pembelian', 'desc');
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function delete($id)
  {
    $this->db->where('kode_pembelian', $id)
      ->delete($this->table);
    return $this->db->affected_rows();
  }
}
