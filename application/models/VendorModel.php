<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VendorModel extends CI_Model
{
  public $table = 'vendor';

  public function GetVendor($id = null)
  {
    $this->db->select('*')
      ->from($this->table);
    if ($id != null)
      $this->db->where($id);
    return $this->db->get();
  }

  //Untuk menampilkan data vendor dengan select 2 ajax
  public function GetVendorAjax($nama)
  {
    $this->db->select('*')
      ->limit(10)
      ->from($this->table)
      ->like('nama_vendor', $nama);
    return $this->db->get()->result_array();
  }

  public function InsertVendor($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function UpdateVendor($id, $data)
  {
    $this->db->where($id)
      ->update($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function DeleteVendor($id)
  {
    $this->db->where($id)
      ->delete($this->table);
    return $this->db->affected_rows() > 0;
  }
}
