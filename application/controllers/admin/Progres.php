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
				'transaksi.status_code !=' => null
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
		$foto = $_FILES['foto']['name'];

		if ($foto) {
			$this->load->library('upload');
			$config['upload_path']   = './uploads/paket';
			$config['allowed_types'] = 'jpg|jpeg|png';
			// $config['max_size']             = 3072; // 3 mb
			$config['remove_spaces'] = TRUE;
			$config['detect_mime']   = TRUE;
			$config['encrypt_name']  = TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('foto')) {
				$this->session->set_flashdata('toastr-error', $this->upload->display_errors());

				redirect('admin/barang', 'refresh');
			} else {
				$upload_data = $this->upload->data();

				$data = [
					'idPaket' => $this->input->post('idPaket'),
					'status'  => $this->input->post('status'),
					'catatan' => $this->input->post('catatan'),
					'foto'    => $upload_data['file_name'],
				];
			}
		} else {
			$data = [
				'idPaket' => $this->input->post('idPaket'),
				'status'  => $this->input->post('status'),
				'catatan' => $this->input->post('catatan')
			];
		}

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
		$this->db->where('id', $id);
		$data = $this->db->get('progres')->row();

		$this->db->where('id', $id);
		$delete = $this->db->delete('progres');

		if ($delete) {
			if ($data->foto != null) {
				unlink(FCPATH . 'uploads/paket/' . $data->foto);
			}

			$this->session->set_flashdata('toastr-sukses', 'Data berhasil dihapus');
		} else {
			$this->session->set_flashdata('toastr-eror', 'Data gagal dihapus!!');
		}

		redirect('admin/progres', 'refresh');
	}
}

  /* End of file Progres.php */
