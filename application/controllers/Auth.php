<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
	}

	public function index()
	{
		$this->load->view('auth/login');
	}

	public function authentication()
	{
		$dataUser = $this->AuthModel->GetUserByUsername($username = ['username' => $this->input->post('username')]);
		$password = $this->input->post('password');
		$encrypt = md5($password);

		if ($dataUser != null) {
			if ($dataUser->password == $encrypt) {
				if ($dataUser->status_aktif == 1) {
					$data = array(
						'id_user' => $dataUser->id_user,
						'nama_user' => $dataUser->nama_user,
						'level_user' => $dataUser->level_user,
						'kode_kantor' => $dataUser->kode_kantor,
						'is_login' => $dataUser->is_login,
						'divisi' => $dataUser->divisi
					);

					$this->session->set_userdata($data);
					$this->session->set_flashdata(
						'success',
						'Berhasil login'
					);
					redirect('dashboard');
				} else {
					$this->session->set_flashdata(
						'error',
						'Mohon maaf user anda tidak aktif'
					);
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata(
					'error',
					'Kombinasi username dan password salah'
				);
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata(
				'error',
				'User tidak ditemukan'
			);
			redirect('auth');
		}
	}
}
