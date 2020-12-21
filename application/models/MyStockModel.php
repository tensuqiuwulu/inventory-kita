<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MyStockModel extends CI_Model
{
  public $table = 'my_stock';

  public function GetMyStock($id = null)
  {
    $this->db->select('*')
      ->from($this->table)
      ->join('barang', 'my_stock.id_barang = barang.id_barang');
    if ($id) {
      $this->db->where('id_my_stock', $id);
    }
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }
}
