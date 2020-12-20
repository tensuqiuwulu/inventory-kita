<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RiwayatModel extends CI_Model
{
  public $table = 'riwayat_barang';

  public function GetRiwayatPerBarang($id = null)
  {
    $this->db->select('*')
      ->from($this->table)
      ->where($id);
    return $this->db->get()->result_array();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }
}
