<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UsersModel extends CI_Model
{
  public $table = 'users';

  function GetUserByUsername($username)
  {
    $this->db->select('*')
      ->from($this->table)
      ->where($username);
    return $this->db->get()->row();
  }

  public function GetUsers($id = null)
  {
    $this->db->select('*')
      ->from($this->table)
      ->join('divisi', 'users.id_divisi = divisi.id_divisi');
    if ($id) {
      $this->db->where('users.id_user', $id);
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
    $this->db->where('id_user', $id)
      ->update($data);
    return $this->db->affected_rows() > 0;
  }
}
