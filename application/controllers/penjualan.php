<?php 
defined ('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class penjualan extends CI_Controller
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
    public function index()
    {
        $data['judul'] = "Halaman Penjualan";
        $data['penjualan'] = $this->penjualan_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('layout/header', $data);
        $this->load->view('penjualan/vw_penjualan', $data);
        $this->load->view('layout/footer');
    }
    function detail($id)
    {
        $data['judul'] = "Halaman Detail Penjualan";
        $data['detail'] = $this->detail_model->getById($id);
        $data['penjualan'] = $this->penjualan_model->getByIdP($id);
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Status wajib diisi'
        ]);
        if($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("penjualan/vw_detail_penjualan", $data);
            $this->load->view("layout/footer");
        }else {
            $status = $this->input->post('status');
            $idp = $this->input->post('no_penjualan');
            $this->penjualan_model->updatestatus($status, $idp);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Penjualan Berhasil Diubah!</div>');
            redirect('penjualan');
        }
    }
    public function export()
    {
        $dompdf = new dompdf();
        $this->data['all_jual'] = $this->penjualan_model->get();
        $this->data['title'] = "Laporan Data Penjualan";
        $this->data['no'] = 1;
        $dompdf->setPaper('A4', 'Landscape');
        $html = $this->load->view('penjualan/report', $this->data, true);
        $dompdf->load_html($html);
        $dompdf->render();
        $dompdf->stream('Laporan Data Penjualan Tanggal ' . date('d F Y'), array("Attachment" => false));
    }
}