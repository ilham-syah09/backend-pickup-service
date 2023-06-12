<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Dashboard extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$idUser = $this->get('idUser');

		$this->db->where('idUser', $idUser);

		$totalPaket = $this->db->get('paket')->num_rows();

		$this->db->join('transaksi', 'transaksi.idPaket = paket.id', 'left');

		$this->db->where('transaksi.status_code !=', 200);

		$this->db->where('paket.idUser', $idUser);

		$totalBelumLunas = $this->db->get('paket')->num_rows();

		$this->db->join('transaksi', 'transaksi.idPaket = paket.id', 'left');

		$this->db->where('transaksi.status_code', 200);
		$this->db->where('paket.idUser', $idUser);

		$totalLunas = $this->db->get('paket')->num_rows();

		$response = [
			'status'  => true,
			'message' => 'Get data sukses',
			'data'    => [
				'total'           => $totalPaket,
				'belumLunas' => $totalBelumLunas,
				'lunas'      => $totalLunas
			]
		];

		$this->response($response, 200);
	}
}
