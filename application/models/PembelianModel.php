<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianModel extends CI_Model
{
  public $table = 'pembelian';

  public function GetListCart($nota)
  {
    $this->db->select('*')
      ->from('pembelian')
      ->join('vendor', 'vendor.id_vendor = pembelian.id_vendor')
      ->join('barang', 'barang.id_barang = pembelian.id_barang')
      ->join('nota', 'nota.no_nota = pembelian.no_nota')
      ->where('nota.no_nota', $nota)
      ->order_by('kode_pembelian', 'desc');
    return $this->db->get();
  }

  public function GetCart($id = null)
  {
    $this->db->select('*')
      ->from($this->table);
    if ($id != null) {
      $this->db->where('kode_pembelian', $id);
    }
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function update($id, $data)
  {
    $this->db->where('kode_pembelian', $id)
      ->update($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function delete($id)
  {
    $this->db->where('kode_pembelian', $id)
      ->delete($this->table);
    return $this->db->affected_rows();
  }
}
