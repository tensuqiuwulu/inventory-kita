<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DistribusiBarangModel extends CI_Model
{
  public $table = 'distribusi_barang';

  public function get_list_perkantor($id_kantor)
  {
    $this->db->select('*')
      ->from($this->table)
      ->join('barang', 'distribusi_barang.id_barang = barang.id_barang')
      ->where('id_kantor', $id_kantor);
    return $this->db->get()->result_array();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }
}
