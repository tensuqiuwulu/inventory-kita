<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KantorModel extends CI_Model
{
  public $table = 'kantor';

  public function get_list()
  {
    $this->db->select('*')
      ->from($this->table);
    return $this->db->get()->result_array();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
  }
}
