<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermintaanModel extends CI_Model
{
  public $table = 'permintaan_barang';

  public function GetPermintaan($id = null)
  {
    $this->db->select('*')
      ->from($this->table)
      ->join('barang', 'barang.id_barang = permintaan_barang.id_barang');
    if ($id != null) {
      $this->db->where('id_permintaan', $id);
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
    $this->db->where($id)
      ->update($this->table, $data);
    return $this->db->affected_rows() > 0;
  }
}
