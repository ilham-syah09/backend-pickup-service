<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Progres extends CI_Controller
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
			'title'   => 'Progres Pengiriman Paket',
			'sidebar' => 'admin/sidebar',
			'page'    => 'admin/progres',
			'paket'   => $this->admin->getPaket([
				'paket.status' => 'Lunas'
			])
		];

		$this->load->view('index', $data);
	}

	public function getList()
	{
		$progres = $this->admin->getProgres([
			'idPaket' => $this->input->get('id')
		]);

		echo json_encode($progres);
	}

	public function add()
	{
		$data = [
			'idPaket' => $this->input->post('idPaket'),
			'status'  => $this->input->post('status'),
			'catatan' => $this->input->post('catatan')
		];

		$insert = $this->db->insert('progres', $data);

		if ($insert) {
			$this->session->set_flashdata('toastr-success', 'Sukses tambah data');
		} else {
			$this->session->set_flashdata('toastr-error', 'Gagal tambah data');
		}

		redirect('admin/progres', 'refresh');
	}

	public function delete($id)
	{
		$this->db->delete('progres', ['id' => $id]);

		$this->session->set_flashdata('toastr-success', 'Sukses hapus data');

		redirect('admin/progres', 'refresh');
	}
}

  /* End of file Progres.php */
