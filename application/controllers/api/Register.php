<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Register extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|valid_email|required');
		$this->form_validation->set_rules('name', 'Name', 'required');

		$dt = [];

		if ($this->form_validation->run() == FALSE) {
			$message = validation_errors();
		} else {
			$username = $this->post('username');
			$name     = $this->post('name');

			$this->db->insert('user', [
				'name'     => $name,
				'username' => $username,
				'password' => password_hash('user123', PASSWORD_BCRYPT),
				'role_id'  => 2
			]);

			$insert_id = $this->db->insert_id();

			if ($insert_id) {
				$this->_sendEmail([
					'id'       => $insert_id,
					'name'     => $name,
					'username' => $username,
					'password' => 'user123'
				]);

				$dt = [
					'name'     => $name,
					'username' => $username,
					'password' => 'user123'
				];

				$message = 'Registrasi berhasil';
			} else {
				$message = 'Registrasi gagal';
			}
		}

		$response = [
			'status'  => true,
			'message' => $message,
			'data'    => $dt
		];

		$this->response($response, 200);
	}

	public function index_put()
	{
		$id = $this->put('id');

		$this->db->where('id', $id);
		$user = $this->db->get('user')->row();

		if ($user) {
			if ($user->status == 0) {
				$this->db->where('id', $id);
				$update = $this->db->update('user', [
					'status' => 1
				]);

				if ($update) {
					$message = 'Akun berhasil diaktifasi, silakan login';

					$response = [
						'status'  => true,
						'message' => $message,
					];

					$this->response($response, 200);
				} else {
					$message = 'Server Error';

					$response = [
						'status'  => false,
						'message' => $message,
					];

					$this->response($response, 500);
				}
			} else {
				$message = 'Akun Anda sudah aktif, silakan login';

				$response = [
					'status'  => true,
					'message' => $message,
				];

				$this->response($response, 200);
			}
		} else {
			$message = 'Akun tidak ditemukan';

			$response = [
				'status'  => false,
				'message' => $message,
			];

			$this->response($response, 404);
		}
	}

	private function _sendEmail($data)
	{
		$this->load->library('email');
		$config = array();
		$config['charset'] = 'utf-8';
		$config['useragent'] = 'Codeigniter';
		$config['protocol'] = "smtp";
		$config['mailtype'] = "html";
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$config['smtp_port'] = "465";
		$config['smtp_timeout'] = "5";
		$config['priority'] = 3;
		$config['smtp_user'] = "maykomputer2019@gmail.com";
		$config['smtp_pass'] = 'qnslsfcdcgwwlitg';
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
		$this->email->from($config['smtp_user'], 'Pick Up Service');
		$this->email->to($data['username']);
		$this->email->subject('Registrasi Akun');
		$message = $this->load->view('v_email', $data, TRUE);
		$this->email->message($message);
		$this->email->set_mailtype("html");

		$this->email->send();
	}
}
