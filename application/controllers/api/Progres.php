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

		$this->db->where('idPaket', $idPaket);
		$this->db->order_by('createdAt', 'desc');

		$data = $this->db->get('progres')->result();

		$response = [
			'status'  => true,
			'message' => 'Get data sukses',
			'data'    => $data
		];

		$this->response($response, 200);
	}
}
