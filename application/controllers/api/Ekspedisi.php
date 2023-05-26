<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Ekspedisi extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$this->db->order_by('ekspedisi', 'asc');
		$data = $this->db->get('ekspedisi')->result();

		$response = [
			'status'  => true,
			'message' => 'Get data sukses',
			'data'    => $data
		];

		$this->response($response, 200);
	}
}
