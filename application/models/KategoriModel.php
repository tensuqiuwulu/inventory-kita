<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
{
  public $table = 'kategori';

  public function GetKategori($id = null)
  {
    $this->db->select('*')
      ->from($this->table);
    if ($id != null) {
      $this->db->where($id);
    }
    return $this->db->get();
  }

  public function InsertKategori($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function UpdateKategori($id, $data)
  {
    $this->db->where($id)
      ->update($this->table, $data);
    return $this->db->affected_rows();
  }

  public function DeleteKategori($id)
  {
    $this->db->where($id)
      ->delete($this->table);
    return $this->db->affected_rows();
  }
}
