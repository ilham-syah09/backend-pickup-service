<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (empty($this->session->userdata('log_admin'))) {
			$this->session->set_flashdata('toastr-error', 'Anda Belum Login');
			redirect('auth', 'refresh');
		}

		$this->db->where('id', $this->session->userdata('id'));
		$this->dt_user = $this->db->get('user')->row();

		$this->load->model('M_admin', 'admin');
	}

	public function index()
	{
		$data = [
			'title'    => 'List User',
			'sidebar'  => 'admin/sidebar',
			'page'     => 'admin/user',
			'user' => $this->admin->getUser()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'name'         => $this->input->post('name'),
			'username'     => $this->input->post('username'),
			'password'     => password_hash('user123', PASSWORD_BCRYPT),
			'role_id'      => 2
		];

		$insert = $this->db->insert('user', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Sukses tambah data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal tambah data');
		}

		redirect('admin/user', 'refresh');
	}

	public function edit()
	{
		$data = [
			'name'     => $this->input->post('name'),
			'username' => $this->input->post('username'),
			'status'   => $this->input->post('status')
		];

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('user', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Sukses edit data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal edit data');
		}

		redirect('admin/user', 'refresh');
	}

	public function delete($id)
	{
		$this->db->delete('user', ['id' => $id]);

		$this->session->set_flashdata('toastr-success', 'Sukses hapus data');

		redirect('admin/user', 'refresh');
	}

	public function resetPwd($id)
	{
		$data = [
			'password' => password_hash('user123', PASSWORD_BCRYPT)
		];

		$this->db->where('id', $id);
		$reset = $this->db->update('user', $data);

		if ($reset) {
			$this->session->set_flashdata('toastr-success', 'Sukses reset password');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal reset password');
		}

		redirect('admin/user', 'refresh');
	}

	public function aktifasi($id)
	{
		$data = [
			'status' => 1
		];

		$this->db->where('id', $id);
		$update = $this->db->update('user', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Sukses aktifasi akun');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal aktifasi akun');
		}

		redirect('admin/user', 'refresh');
	}
}

  /* End of file User.php */
