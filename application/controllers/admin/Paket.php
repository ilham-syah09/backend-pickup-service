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

	public function index($tanggal_awal = null, $tanggal_akhir = null)
	{
		if (!$tanggal_awal) {
			$tanggal_awal = date('Y-m-d');
		}

		if (!$tanggal_akhir) {
			$tanggal_akhir = date('Y-m-d');
		}

		if ($tanggal_awal > $tanggal_akhir) {
			$this->session->set_flashdata('toastr-error', 'Tanggal awal tidak boleh melebihi tanggal akhir !');
			redirect($_SERVER['HTTP_REFERER'], 'refresh');
		}

		$data = [
			'title'   => 'List Paket',
			'sidebar' => 'admin/sidebar',
			'page'    => 'admin/paket',
			'paket'   => $this->admin->getPaket([
				'DATE(paket.createdAt) >=' => $tanggal_awal,
				'DATE(paket.createdAt) <=' => $tanggal_akhir,
			]),
			'tanggal_awal'  => $tanggal_awal,
			'tanggal_akhir' => $tanggal_akhir
		];

		$this->load->view('index', $data);
	}

	public function alamat($id)
	{
		$paket = $this->admin->getPaket([
			'paket.id' => $id
		]);

		$data = [
			'title'   => 'Lokasi Penjemputan',
			'sidebar' => 'admin/sidebar',
			'page'    => 'admin/alamat',
			'setting' => $this->db->get('setting')->row(),
			'paket'   => $paket
		];

		$this->load->view('index', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->delete('paket');

		if ($delete) {
			$this->db->where('idPaket', $id);
			$this->db->delete('progres');

			$this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal dihapus!!');
		}

		redirect('admin/paket', 'refresh');
	}
}

  /* End of file Paket.php */
