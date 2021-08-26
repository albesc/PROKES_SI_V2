<?php
defined('BASEPATH') or exit('No direct script access allowed');
class buku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('buku_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Buku";
        $data['buku'] = $this->buku_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("buku/vw_buku", $data);
        $this->load->view("layout/footer", $data);
    }

    function tambah()
    {
        $data['judul'] = "Halaman Tambah Buku";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Buku', 'required', [
            'required' => 'Nama Buku Wajib diisi',
        ]);
        $this->form_validation->set_rules('pengarang', 'pengarang ', 'required', [
            'required' => 'Nama Pengarang Wajib diisi',
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required', [
            'required' => 'Stok Buku Wajib diisi',
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'required', [
            'required' => 'Harga Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("buku/vw_tambah_buku", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'pengarang' => $this->input->post('pengarang'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),
            ];
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/buku/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->buku_model->insert($data, $upload_image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Ditambah!</div>');
            redirect('buku');
        }
    }
    function delete($id)
    {
        $this->buku_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Buku tidak dapat dihapus!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Prodi Berhasil Dihapus!</div>');
        }
        redirect('buku');
    }


    function edit($id)
    {
        $data['judul'] = "Halaman Edit Buku";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['buku'] = $this->buku_model->getById($id);

        $this->form_validation->set_rules('nama', 'Nama Buku', 'required', [
            'required' => 'Nama Buku Wajib diisi',
        ]);
        $this->form_validation->set_rules('pengarang', 'pengarang ', 'required', [
            'required' => 'Nama Pengarang Wajib diisi',
        ]);
        $this->form_validation->set_rules('stok', 'Stok', 'required', [
            'required' => 'Stok Buku Wajib diisi',
        ]);
        $this->form_validation->set_rules('harga', 'Harga Buku', 'required', [
            'required' => 'Harga Buku Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("buku/vw_ubah_buku", $data);
            $this->load->view("layout/footer");
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'pengarang' => $this->input->post('pengarang'),
                'stok' => $this->input->post('stok'),
                'harga' => $this->input->post('harga'),
            ];
            $upload_image = $_FILES['gambar']['nama'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/buku/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $old_image = $data['dosen']['gambar'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/buku/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $id = $this->input->post('id');
            $this->buku_model->update(['id' => $id], $data, $upload_image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Buku Berhasil Diubah!</div>');
            redirect('buku');
        }
    }
}
