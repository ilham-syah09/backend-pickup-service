<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Profile extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		$this->form_validation->set_rules('id', 'ID', 'required|numeric');
		$this->form_validation->set_rules('name', 'Name', 'required');

		$dt = [];

		if ($this->form_validation->run() == FALSE) {
			$message = validation_errors();
		} else {
			$id = $this->post('id');
			$name = $this->post('name');
			$password = $this->post('password');

			$image = (isset($_FILES['image']) ? $_FILES['image']['name'] : '');

			if ($image) {
				$this->load->library('upload');
				$config['upload_path']   = './uploads/profile';
				$config['allowed_types'] = 'jpg|jpeg|png';
				// $config['max_size']             = 3072; // 3 mb
				$config['remove_spaces'] = TRUE;
				$config['detect_mime']   = TRUE;
				$config['encrypt_name']  = TRUE;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('image')) {
					$message = $this->upload->display_errors();

					$response = [
						'status'  => false,
						'message' => $message
					];

					$this->response($response, 400);
					die;
				} else {
					$upload_data = $this->upload->data();

					if ($password) {
						$data = [
							'name' => $name,
							'password' => password_hash($password, PASSWORD_BCRYPT),
							'image'    => $upload_data['file_name'],
						];
					} else {
						$data = [
							'name' => $name,
							'image'    => $upload_data['file_name'],
						];
					}
				}
			} else {
				if ($password) {
					$data = [
						'name' => $name,
						'password' => password_hash($password, PASSWORD_BCRYPT)
					];
				} else {
					$data = [
						'name' => $name
					];
				}
			}

			$this->db->where('id', $id);
			$user = $this->db->get('user')->row();

			$this->db->where('id', $id);
			$update = $this->db->update('user', $data);

			if ($update) {
				if ($image) {
					if ($user->image != null || $user->image != 'default.png') {
						unlink(FCPATH . 'uploads/profile/' . $user->image);
					}
				}

				$this->db->where('id', $id);
				$user = $this->db->get('user')->row();

				$dt = $user;
				$message = 'Update profile berhasil';
			} else {
				$message = 'Server error!!';
			}
		}

		$response = [
			'status'  => true,
			'message' => $message,
			'data'    => $dt
		];

		$this->response($response, 200);
	}
}
