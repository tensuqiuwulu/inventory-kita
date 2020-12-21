<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DivisiModel extends CI_Model
{
  public $table = 'divisi';

  public function GetDivisi($id = null)
  {
    $this->db->select('*')
      ->from($this->table);
    if ($id) {
      $this->db->where('id_divisi', $id);
    }
    return $this->db->get();
  }

  public function GetDivisiAjax($nama)
  {
    $this->db->select('*')
      ->limit(5)
      ->from($this->table)
      ->like('nama_divisi', $nama);
    return $this->db->get()->result_array();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }

  public function update($id, $data)
  {
    $this->db->where('id_divisi', $id)
      ->update($this->table, $data);
    return $this->db->affected_rows();
  }
}
