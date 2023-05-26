<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Setting extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_get()
	{
		$data = $this->db->get('setting')->row();

		$response = [
			'status'  => true,
			'message' => 'Get data sukses',
			'data'    => $data
		];

		$this->response($response, 200);
	}
}
