<?php
defined('BASEPATH') or exit('No direct script access allowed');
class dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('buku_model');
        $this->load->model('penjualan_model');
        $this->load->model('user_model');
        $this->load->model('detail_model');
    }
    function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->buku_model->tbuku();
        $data['penjualan'] = $this->penjualan_model->tpenjualan();
        $data['totalb'] = $this->detail_model->charts();
        $data['us'] = $this->user_model->tuser();
        $this->load->view('layout/header', $data);
        $this->load->view('auth/dashboard', $data);
        $this->load->view('layout/footer', $data);
    }
}
