<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ekspedisi extends CI_Controller
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
			'title'     => 'List Ekspedisi',
			'sidebar'   => 'admin/sidebar',
			'page'      => 'admin/ekspedisi',
			'ekspedisi' => $this->admin->getEkspedisi()
		];

		$this->load->view('index', $data);
	}

	public function add()
	{
		$data = [
			'ekspedisi' => $this->input->post('ekspedisi')
		];

		$insert = $this->db->insert('ekspedisi', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Sukses tambah data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal tambah data');
		}

		redirect('admin/ekspedisi', 'refresh');
	}

	public function edit()
	{
		$data = [
			'ekspedisi'         => $this->input->post('ekspedisi')
		];

		$this->db->where('id', $this->input->post('id'));
		$update = $this->db->update('ekspedisi', $data);

		if ($update) {
			$this->session->set_flashdata('toastr-success', 'Sukses edit data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal edit data');
		}

		redirect('admin/ekspedisi', 'refresh');
	}

	public function delete($id)
	{
		$this->db->delete('ekspedisi', ['id' => $id]);

		$this->session->set_flashdata('toastr-success', 'Sukses hapus data');

		redirect('admin/ekspedisi', 'refresh');
	}
}

  /* End of file Ekspedisi.php */
