<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket extends CI_Controller
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
			'title'     => 'List Paket',
			'sidebar'   => 'admin/sidebar',
			'page'      => 'admin/paket',
			'paket' => $this->admin->getPaket()
		];

		$this->load->view('index', $data);
	}

	public function alamat($id)
	{
		$paket = $this->admin->getPaket([
			'paket.id' => $id
		]);

		echo json_encode($paket);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$data = $this->db->get('paket')->row();

		$this->db->where('id', $id);
		$delete = $this->db->delete('paket');

		if ($delete) {
			if ($data->foto != null) {
				unlink(FCPATH . 'uploads/paket/' . $data->foto);
			}

			$this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal dihapus!!');
		}

		redirect('admin/paket', 'refresh');
	}
}

  /* End of file Paket.php */
