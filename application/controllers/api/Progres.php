<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Progres extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$idPaket = $this->get('idPaket');

		if (!$idPaket) {
			$response = [
				'status'  => false,
				'message' => 'ID Paket cannot be empty'
			];

			$this->response($response, 200);

			die;
		}

		$this->db->where('idPaket', $idPaket);
		$this->db->order_by('createdAt', 'desc');

		$data = $this->db->get('progres')->result();

		if ($data) {
			$newData = [];

			foreach ($data as $dt) {
				array_push($newData, [
					'status'  => $dt->status,
					'catatan' => $dt->catatan,
					'foto'    => ($dt->foto != null) ? base_url('uploads/paket/' . $dt->foto) : null,
					'tanggal' => date('d M Y - H:i:s')
				]);
			}

			$response = [
				'status'  => true,
				'message' => 'Get data sukses',
				'data'    => $newData
			];
		} else {
			$response = [
				'status'  => false,
				'message' => 'Get data gagal'
			];
		}

		$this->response($response, 200);
	}
}
