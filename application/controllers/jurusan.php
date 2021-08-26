<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jurusan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('jurusan_model');
        $this->load->model('dosen_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Jurusan";
        $data['jurusan'] = $this->jurusan_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("jurusan/vw_jurusan", $data);
        $this->load->view("layout/footer", $data);
    }


    function tambah()
    {
        $data['judul'] = "Halaman Tambah Jurusan";
        $data['dosen'] = $this->dosen_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Jurusan', 'required', [
            'required' => 'Nama Jurusan Wajib diisi',
        ]);
        $this->form_validation->set_rules('singkatan', 'singkatan ', 'required', [
            'required' => 'Singkatan Jurusan Wajib diisi',
        ]);
        $this->form_validation->set_rules('nama_kajur', 'Nama Kajur', 'required', [
            'required' => 'Nama Kajur Jurusan Wajib diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("jurusan/vw_tambah_jurusan", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'singkatan' => $this->input->post('singkatan'),
                'nama_kajur' => $this->input->post('nama_kajur'),
                'BPF-TI' => 'bpftiabcde'
            ];
            $this->jurusan_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jurusan Berhasil Ditambah!</div>');
            redirect('Jurusan');
        }
    }

    function delete($id)
    {
        $this->jurusan_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Prodi tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Prodi Berhasil Dihapus!</div>');
        }
        redirect('Jurusan');
    }


    function edit($id)
    {
        $data['judul'] = "Halaman Edit Jurusan";
        $data['jurusan'] = $this->jurusan_model->getById($id);
        $data['dosen'] = $this->dosen_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Jurusan', 'required', [
            'required' => 'Nama Jurusan Wajib diisi',
        ]);
        $this->form_validation->set_rules('singkatan', 'singkatan ', 'required', [
            'required' => 'Singkatan Jurusan Wajib diisi',
        ]);
        $this->form_validation->set_rules('nama_kajur', 'Nama Kajur', 'required', [
            'required' => 'Nama Kajur Jurusan Wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("jurusan/vw_ubah_jurusan", $data);
            $this->load->view("layout/footer");
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'singkatan' => $this->input->post('singkatan'),
                'nama_kajur' => $this->input->post('nama_kajur'),
                'BPF-TI' => 'bpftiabcde',
                'id' => $this->input->post('id')
            ];
            $this->jurusan_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jurusan Berhasil DiUbah!</div>');
            redirect('jurusan');
        }
    }
}
