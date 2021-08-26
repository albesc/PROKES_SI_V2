<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dosen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('dosen_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Dosen";
        $data['dosen'] = $this->dosen_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("dosen/vw_dosen", $data);
        $this->load->view("layout/footer", $data);
    }

    function tambah()
    {
        $data['judul'] = "Halaman Tambah Dosen";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('nama', 'Nama Dosen', 'required', [
            'required' => 'Nama Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('nip', 'nip ', 'required|numeric', [
            'required' => 'NIP Dosen Wajib diisi',
            'numeric' => 'NIP harus Angka'
        ]);
        $this->form_validation->set_rules('inisial', 'Nama Dosen', 'required', [
            'required' => 'Inisial Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('prodi', 'prodi Dosen', 'required', [
            'required' => 'Prodi Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('email', 'Email Dosen', 'required', [
            'required' => 'Email Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('kompetensi', 'Kompetensi Dosen', 'required', [
            'required' => 'Kompetensi Dosen Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("dosen/vw_tambah_dosen", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nip' => $this->input->post('nip'),
                'inisial' => $this->input->post('inisial'),
                'prodi' => $this->input->post('prodi'),
                'email' => $this->input->post('email'),
                'kompetensi' => $this->input->post('kompetensi'),

            ];
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/Dosen/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->dosen_model->insert($data, $upload_image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil Ditambah!</div>');
            redirect('dosen');
        }
    }
    function delete($id)
    {
        $this->dosen_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Prodi tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Prodi Berhasil Dihapus!</div>');
        }
        redirect('dosen');
    }


    function edit($id)
    {
        $data['judul'] = "Halaman Edit Dosen";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['dosen'] = $this->dosen_model->getById($id);

        $this->form_validation->set_rules('nama', 'Nama Dosen', 'required', [
            'required' => 'Nama Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('nip', 'nip ', 'required|numeric', [
            'required' => 'NIP Dosen Wajib diisi',
            'numeric' => 'NIP harus Angka'
        ]);
        $this->form_validation->set_rules('inisial', 'Nama Dosen', 'required', [
            'required' => 'Inisial Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('prodi', 'prodi Dosen', 'required', [
            'required' => 'Prodi Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('email', 'Email Dosen', 'required', [
            'required' => 'Email Dosen Wajib diisi',
        ]);
        $this->form_validation->set_rules('kompetensi', 'Kompetensi Dosen', 'required', [
            'required' => 'Kompetensi Dosen Wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("dosen/vw_ubah_dosen", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nip' => $this->input->post('nip'),
                'inisial' => $this->input->post('inisial'),
                'prodi' => $this->input->post('prodi'),
                'email' => $this->input->post('email'),
                'kompetensi' => $this->input->post('kompetensi'),
            ];
            $upload_image = $_FILES['gambar']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/dosen/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('gambar')) {
                    $old_image = $data['dosen']['gambar'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/dosen/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('gambar', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $id = $this->input->post('id');
            $this->dosen_model->update(['id' => $id], $data, $upload_image);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Dosen Berhasil DiUbah!</div>');
            redirect('Dosen');
        }
    }
}
