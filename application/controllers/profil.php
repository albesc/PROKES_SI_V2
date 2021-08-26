<?php 
defined ('BASEPATH') or exit('No direct script access allowed');

class profil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in2();
        $this->load->model('user_model');
        $this->load->model('buku_model');
        $this->load->model('keranjang_model');
        $this->load->model('penjualan_model');
        $this->load->model('detail_model');
    }
    public function index()
    {
        $data['keranjang'] = $this->keranjang_model->get();
        $data['title'] = "Profil";
        $data['user'] = $this->user_model->getBy();
        $data['jlh'] = $this->keranjang_model->jumlah();
        $this->load->view('layout/header', $data);
        $this->load->view('user/vw_profil', $data);
        $this->load->view('layout/footer', $data);
    }
    public function buku()
    {
        $data['judul'] = "List Buku";
        $data['user'] = $this->user_model->getBy();
        $data['buku'] = $this->buku_model->get();
        $data['jlh'] = $this->keranjang_model->jumlah();
        $this->load->view('layout/header', $data);
        $this->load->view('profil/vw_p_user', $data);
        $this->load->view('layout/footer', $data);
    }
    public function keranjang($id)
    {
        $data['keranjang'] = $this->keranjang_model->get();
        $data['judul'] = "Detail Buku";
        $data['user'] = $this->user_model->getBy();
        $data['buku'] = $this->buku_model->getById($id);
        $data['jlh'] = $this->keranjang_model->jumlah();
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required', [
            'required' => 'Jumlah wajib diisi'
        ]);
        if($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('profil/vw_keranjang', $data);
            $this->load->view('layout/footer', $data);
        }else{
            $data = [
                'id_user' => $this->session->userdata('id'),
                'id_buku' => $this->input->post('id'),
                'jumlah' => $this->input->post('jumlah'),
                'total' => $this->input->post('total'),
                'tanggal' => $this->input->post('tanggal'),
            ];        
            $this->keranjang_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Buku berhasil ditambah ke keranjang</div>');
            redirect('profil/detail');
        }
    }
    public function detail()
    {
        $data['judul'] = "Detail Keranjang";
        $data['user'] = $this->user_model->getBy();
        $data['buku'] = $this->buku_model->get();
        $data['keranjang'] = $this->keranjang_model->get();
        $data['jlh'] = $this->keranjang_model->jumlah();
        $this->load->view('layout/header', $data);
        $this->load->view('profil/vw_detail_keranjang', $data);
        $this->load->view('layout/footer', $data);
    }
    public function delKeranjang($id)
    {
        $this->keranjang_model->delete($id);
        $this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data berhasil dihapus dari keranjang</div>');
        redirect('profil/detail');
    }
    public function pesanan()
    {
        $data['buku'] = $this->buku_model->get();
        $jumlah_beli = count($this->input->post('buku'));
        $data_p = [
            'no_penjualan' => $this->input->post('no_penjualan'),
            'id_user' => $this->session->userdata('id'),
            'tanggal' => $this->input->post('tanggal'),
            'total_bayar' => $this->input->post('bayar'),
            'alamat' => $this->input->post('alamat'),
            'pembayaran' => $this->input->post('pembayaran'),
            'keterangan' => $this->input->post('keterangan'),
        ];
        $upload_image = $_FILES['gambar']['name'];
        if($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/pembayaran/';
            $this->load->library('upload', $config);
            if($this->upload->do_upload('gambar')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('gambar', $new_image);
            }else{
                echo $this->upload->display_errors();
            }
        }
        $data_detail = [];
        for($i = 0; $i < $jumlah_beli; $i++){
            array_push($data_detail, ['id_buku' => $this->input->post('buku')[$i]]);
            $data_detail[$i]['no_penjualan'] = $this->input->post('no_penjualan');
            $data_detail[$i]['id_user'] = $this->session->userdata('id');
            $data_detail[$i]['jumlah'] = $this->input->post('jumlah_p')[$i];
            $data_detail[$i]['total'] = $this->input->post('total_p')[$i];
        }
        if($this->penjualan_model->insert($data_p, $upload_image) && $this->detail_model->insert($data_detail)) {
            for($i = 0; $i < $jumlah_beli; $i++)
            {
                $this->buku_model->min_stok($data_detail[$i]['jumlah'], $data_detail[$i]['id_buku']) or die('Gagal Min Stok');
            }
            $id_us = $this->session->userdata('id');
            $this->keranjang_model->delete_all($id_us);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan berhasil dibuat!</div>');
            redirect('profil/buku');
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pesanan gagal dibuat!</div>');
            redirect('profil/buku');
        }
    }
    public function pembelian()
    {
        $data['judul'] = "Data Pembelian";
        $data['user'] = $this->user_model->getBy();
        $data['pembelian'] = $this->penjualan_model->getByUser();
        $data['jlh'] = $this->keranjang_model->jumlah();
        $this->load->view('layout/header', $data);
        $this->load->view('profil/pembelian_user', $data);
        $this->load->view('layout/footer', $data);
    }
    public function statusbeli($id)
    {
        $data['judul'] = "Ubah Data Pembelian";
        $data['user'] = $this->user_model->getBy();
        $data['pembelian'] = $this->penjualan_model->getByUser2($id);
        $data['detailbeli'] = $this->detail_model->getByUser($id);
        $data['jlh'] = $this->keranjang_model->jumlah();
        $this->form_validation->set_rules('status', 'Status', 'required', [
            'required' => 'Status Wajib Diisi'
        ]);
        if($this->form_validation->run() == false){
            $this->load->view("layout/header", $data);
            $this->load->view("profil/detail_beli", $data);
            $this->load->view("layout/footer");
        } else {
            $status = $this->input->post('status');
            $nojual = $this->input->post('no_penjualan');
            $this->penjualan_model->updatestatus($status, $nojual);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status Berhasil Diubah</div>');
            redirect('profil/pembelian');
        }
    }
}
