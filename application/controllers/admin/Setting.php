<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
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
			'title'   => 'Setting',
			'sidebar' => 'admin/sidebar',
			'page'    => 'admin/setting',
			'setting' => $this->db->get('setting')->row()
		];

		$this->load->view('index', $data);
	}

	public function edit()
	{
		$data = [
			'lati'         => $this->input->post('lati'),
			'longi'        => $this->input->post('longi'),
			'lintangBujur' => $this->input->post('lintangBujur'),
			'maxJarak'     => $this->input->post('maxJarak'),
			'hargaKm'      => $this->input->post('hargaKm'),
			'hargaKg'      => $this->input->post('hargaKg')
		];

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('setting', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Data berhasil diedit');
		} else {
			$this->session->set_flashdata('toastr-error', 'Data gagal diedit');
		}

		redirect('admin/setting', 'refresh');
	}
}

/* End of file Setting.php */
