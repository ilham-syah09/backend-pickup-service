<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Paket extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$id = $this->get('id');
		$idUser = $this->get('idUser');

		$this->db->select('paket.*, ekspedisi.ekspedisi, transaksi.payment_type, transaksi.transaction_time, transaksi.bank, transaksi.va_numbers, transaksi.pdf_url, transaksi.status_code');
		$this->db->join('ekspedisi', 'ekspedisi.id = paket.idEkspedisi', 'inner');
		$this->db->join('transaksi', 'transaksi.idPaket = paket.id', 'left');

		if ($id) {
			$this->db->where('paket.id', $id);
		} else {
			$this->db->where('paket.idUser', $idUser);
		}

		$this->db->order_by('paket.id', 'desc');
		$data = $this->db->get('paket')->result();

		$response = [
			'status'  => true,
			'message' => 'Get data sukses',
			'data'    => $data
		];

		$this->response($response, 200);
	}

	public function index_post()
	{
		$this->form_validation->set_rules('idUser', 'User', 'required');
		$this->form_validation->set_rules('namaPaket', 'Nama Paket', 'required');
		$this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
		$this->form_validation->set_rules('jarak', 'Jarak', 'required');
		$this->form_validation->set_rules('idEkspedisi', 'Ekspedisi', 'required|numeric');
		$this->form_validation->set_rules('lati', 'Latitude', 'required');
		$this->form_validation->set_rules('longi', 'Longitude', 'required');
		$this->form_validation->set_rules('totalBiaya', 'Total Biaya', 'required');

		if ($this->form_validation->run() == FALSE) {
			$message = validation_errors();

			$response = [
				'status'  => false,
				'message' => $message,
			];
		} else {
			$idUser      = $this->post('idUser');
			$namaPaket   = $this->post('namaPaket');
			$berat       = $this->post('berat');
			$jarak       = $this->post('jarak');
			$idEkspedisi = $this->post('idEkspedisi');
			$lati        = $this->post('lati');
			$longi       = $this->post('longi');
			$catatan     = $this->post('catatan');
			$totalBiaya  = $this->post('totalBiaya');

			$insert = $this->db->insert('paket', [
				'idUser'      => $idUser,
				'namaPaket'   => $namaPaket,
				'berat'       => $berat,
				'jarak'       => $jarak,
				'idEkspedisi' => $idEkspedisi,
				'lati'        => $lati,
				'longi'       => $longi,
				'catatan'     => $catatan,
				'totalBiaya'  => $totalBiaya,
				'status'	  => 'Menunggu'
			]);

			if ($insert) {
				$message = 'Data berhasil ditambahkan';

				$response = [
					'status'  => true,
					'message' => $message
				];
			} else {
				$message = 'Data gagal ditambahkan';

				$response = [
					'status'  => false,
					'message' => $message,
				];
			}
		}

		$this->response($response, 200);
	}

	public function update_post()
	{
		$this->form_validation->set_rules('id', 'ID', 'required');
		$this->form_validation->set_rules('namaPaket', 'Nama Paket', 'required');
		$this->form_validation->set_rules('berat', 'Berat', 'required|numeric');
		$this->form_validation->set_rules('jarak', 'Jarak', 'required');
		$this->form_validation->set_rules('idEkspedisi', 'Ekspedisi', 'required|numeric');
		$this->form_validation->set_rules('lati', 'Latitude', 'required');
		$this->form_validation->set_rules('longi', 'Longitude', 'required');
		$this->form_validation->set_rules('totalBiaya', 'Total Biaya', 'required');

		if ($this->form_validation->run() == FALSE) {
			$message = validation_errors();

			$response = [
				'status'  => false,
				'message' => $message,
			];
		} else {
			$id          = $this->post('id');
			$namaPaket   = $this->post('namaPaket');
			$berat       = $this->post('berat');
			$jarak       = $this->post('jarak');
			$idEkspedisi = $this->post('idEkspedisi');
			$lati        = $this->post('lati');
			$longi       = $this->post('longi');
			$catatan     = $this->post('catatan');
			$totalBiaya  = $this->post('totalBiaya');

			$this->db->where('id', $id);
			$update = $this->db->update('paket', [
				'namaPaket'   => $namaPaket,
				'berat'       => $berat,
				'jarak'       => $jarak,
				'idEkspedisi' => $idEkspedisi,
				'lati'        => $lati,
				'longi'       => $longi,
				'catatan'     => $catatan,
				'totalBiaya'  => $totalBiaya
			]);

			if ($update) {
				$message = 'Data berhasil diubah';

				$response = [
					'status'  => true,
					'message' => $message
				];
			} else {
				$message = 'Data gagal diubah';

				$response = [
					'status'  => false,
					'message' => $message,
				];
			}
		}

		$this->response($response, 200);
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		$this->db->where('id', $id);
		$delete = $this->db->delete('paket');

		if ($delete) {
			$message = 'Data berhasil dihapus';

			$response = [
				'status'  => true,
				'message' => $message
			];
		} else {
			$message = 'Data gagal dihapus';

			$response = [
				'status'  => false,
				'message' => $message,
			];
		}
		$this->response($response, 200);
	}
}
