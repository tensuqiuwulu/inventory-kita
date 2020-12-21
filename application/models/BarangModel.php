<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
  public $table = 'barang';

  public function GetBarang($id = null)
  {
    $this->db->select('*')
      ->from('barang');
    if ($id != NULL) {
      $this->db->where('id_barang', $id);
    }
    return $this->db->get();
  }

  #Untuk mengambil data barang dengan select 2 ajax
  public function GetBarangAjax($nama)
  {
    $this->db->select('*')
      ->limit(5)
      ->from($this->table)
      ->like('nama_barang', $nama);
    return $this->db->get()->result_array();
  }

  //Fungsi untuk mengecek kode barang
  public function CekKodeBarang($kodeKategori)
  {
    $this->db->select('(SELECT MAX(kode_barang)) as kode_barang', false)
      ->from('barang')
      ->join('kategori', 'barang.id_kategori = kategori.id_kategori')
      ->where('kode_kategori', $kodeKategori);
    return $this->db->get()->row();
  }

  public function insert($data)
  {
    $this->db->insert($this->table, $data);
    return $this->db->insert_id();
  }

  public function update($id, $data)
  {
    $this->db->where('id_barang', $id)
      ->update($this->table, $data);
    return $this->db->affected_rows() > 0;
  }
}
