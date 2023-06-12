<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Transaksi extends RestController
{
	function __construct()
	{
		// Construct the parent class
		parent::__construct();
	}

	public function index_post()
	{
		$this->form_validation->set_rules('idUser', 'User', 'required');
		$this->form_validation->set_rules('idPaket', 'Nama Paket', 'required');
		$this->form_validation->set_rules('order_id', 'Order ID', 'required');
		$this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
		$this->form_validation->set_rules('transaction_time', 'Transaction Time', 'required');
		$this->form_validation->set_rules('bank', 'Bank', 'required');
		$this->form_validation->set_rules('va_numbers', 'VA Numbers', 'required');
		$this->form_validation->set_rules('pdf_url', 'PDF URL', 'required');
		$this->form_validation->set_rules('status_code', 'Status Code', 'required');

		if ($this->form_validation->run() == FALSE) {
			$message = validation_errors();

			$response = [
				'status'  => false,
				'message' => $message,
			];
		} else {
			$idUser      = $this->post('idUser');
			$idPaket   = $this->post('idPaket');
			$order_id       = $this->post('order_id');
			$payment_type       = $this->post('payment_type');
			$transaction_time = $this->post('transaction_time');
			$bank        = $this->post('bank');
			$va_numbers       = $this->post('va_numbers');
			$pdf_url     = $this->post('pdf_url');
			$status_code  = $this->post('status_code');

			$insert = $this->db->insert('transaksi', [
				'idUser'           => $idUser,
				'idPaket'          => $idPaket,
				'order_id'         => $order_id,
				'payment_type'     => $payment_type,
				'transaction_time' => $transaction_time,
				'bank'             => $bank,
				'va_numbers'       => $va_numbers,
				'pdf_url'          => $pdf_url,
				'status_code'      => $status_code
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

	public function index_put()
	{
		$order_id = $this->put('order_id');
		$status_code = $this->put('status_code');

		if (!$order_id) {
			$response = [
				'status'  => false,
				'message' => 'Order id cannot be empty'
			];

			$this->response($response, 200);

			die;
		}

		$this->db->where('order_id', $order_id);
		$update = $this->db->update('transaksi', [
			'status_code' => $status_code
		]);

		if ($update) {
			$message = 'Data berhasil diupdate';

			$response = [
				'status'  => true,
				'message' => $message
			];
		} else {
			$message = 'Data gagal diupdate';

			$response = [
				'status'  => false,
				'message' => $message
			];
		}

		$this->response($response, 200);
	}
}
