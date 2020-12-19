<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AuthModel extends CI_Model
{
  public $table = 'users';

  function GetUserByUsername($username)
  {
    $this->db->select('*')
      ->from($this->table)
      ->where($username);
    return $this->db->get()->row();
  }
}
