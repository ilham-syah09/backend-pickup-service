<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('log_admin'))) {
            $this->session->set_flashdata('toastr-eror', 'Anda Belum Login');
            redirect('auth', 'refresh');
        }

        $this->db->where('id', $this->session->userdata('id'));
        $this->dt_user = $this->db->get('user')->row();

        $this->load->model('M_admin', 'admin');
    }

    public function index()
    {
        $data = [
            'title'     => 'Dashboard',
            'sidebar'   => 'admin/sidebar',
            'page'      => 'admin/dashboard',
            'user'      => $this->admin->getCount('', 'user'),
            'ekspedisi' => $this->admin->getCount('', 'ekspedisi'),
            'paket'     => $this->admin->getCount('', 'paket'),
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Admin.php */
