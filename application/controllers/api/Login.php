<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Login extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$dt = [];

		if ($this->form_validation->run() == FALSE) {
			$message = validation_errors();

			$response = [
				'status'  => false,
				'message' => $message,
				'data'    => $dt
			];
		} else {
			$username = $this->post('username');
			$password = $this->post('password');

			$this->db->where('username', $username);
			$this->db->where('role_id', 2);

			$query = $this->db->get('user');
			$data = $query->row();

			if ($data) {
				if (password_verify($password, $data->password)) {
					if ($data->role_id == 2 && $data->status == 0) {
						$message = 'Akun belum aktif, silahkan cek email Anda';

						$response = [
							'status'  => false,
							'message' => $message,
							'data'    => $dt
						];
					} else {
						$message = 'Login berhasil';
						$dt = $data;
						$dt->image = base_url('uploads/profile/' . $data->image);

						$response = [
							'status'  => true,
							'message' => $message,
							'data'    => $dt
						];
					}
				} else {
					$message = 'Username atau Password Salah!!';

					$response = [
						'status'  => false,
						'message' => $message,
						'data'    => $dt
					];
				}
			} else {
				$message = 'Username atau Password Salah!!';

				$response = [
					'status'  => false,
					'message' => $message,
					'data'    => $dt
				];
			}
		}

		$this->response($response, 200);
	}
}
