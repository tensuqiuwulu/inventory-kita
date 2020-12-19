<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotaModel extends CI_Model
{
  public $table = 'nota';

  public function get_list($tgl_awal = null, $tgl_akhir = null)
  {
    $this->db->select('*')
      ->from($this->table)
      ->where('nota.tgl_pembelian >=', $tgl_awal)
      ->where('nota.tgl_pembelian <=', $tgl_akhir);
    return $this->db->get();
  }

  public function get_list_detail($no_nota)
  {
    $this->db->select('*')
      ->from($this->table)
      ->where('no_nota', $no_nota);
    return $this->db->get();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->affected_rows() > 0;
  }
}
