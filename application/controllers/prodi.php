<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Prodi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('prodi_model');
        $this->load->model('jurusan_model');
        $this->load->model('dosen_model');
    }
    function index()
    {
        $data['judul'] = "Halaman Prodi";
        $data['prodi'] = $this->prodi_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view("layout/header", $data);
        $this->load->view("prodi/vw_prodi", $data);
        $this->load->view("layout/footer", $data);
    }


    function tambah()
    {
        $data['judul'] = "Halaman Tambah Prodi";
        $data['jurusan'] = $this->jurusan_model->get();
        $data['dosen'] = $this->dosen_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Prodi', 'required', [
            'required' => 'Nama Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('ruangan', 'Ruangan ', 'required', [
            'required' => 'Ruangan Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', [
            'required' => 'Jurusan Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('akreditasi', 'Akreditasi', 'required', [
            'required' => 'Akreditasi Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('nama_kaprodi', 'Nama Kaprodi', 'required', [
            'required' => 'Nama Kaprodi Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('tahun_berdiri', 'Tahun Berdiri ', 'required', [
            'required' => 'Tahun Berdiri Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('output_lulusan', 'Output Lulusan', 'required', [
            'required' => 'Output Lulusan Prodi Wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("prodi/vw_tambah_prodi", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'ruangan' => $this->input->post('ruangan'),
                'jurusan' => $this->input->post('jurusan'),
                'akreditasi' => $this->input->post('akreditasi'),
                'nama_kaprodi' => $this->input->post('nama_kaprodi'),
                'tahun_berdiri' => $this->input->post('tahun_berdiri'),
                'output_lulusan' => $this->input->post('output_lulusan'),
                'BPF-TI' => 'bpftiabcde'
            ];
            $this->prodi_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Prodi Berhasil Ditambah!</div>');
            redirect('Prodi');
        }
    }
    function delete($id)
    {
        $this->prodi_model->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert"><i class="icon fas fa-info-circle"></i>Data Prodi tidak dapat dihapus (sudah berelasi)!</div>');
        } else {
            $this->session->set_flashdata('message', 
            '<div class="alert alert-success" role="alert"><i class="icon fas fa-check-circle"></i>Data Prodi Berhasil Dihapus!</div>');
        }
        redirect('prodi');
    }


    function edit($id)
    {
        $data['judul'] = "Halaman Edit Prodi";
        $data['prodi'] = $this->prodi_model->getById($id);
        $data['jurusan'] = $this->jurusan_model->get();
        $data['dosen'] = $this->dosen_model->get();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama Prodi', 'required', [
            'required' => 'Nama Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('ruangan', 'Ruangan ', 'required', [
            'required' => 'Ruangan Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required', [
            'required' => 'Jurusan Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('akreditasi', 'Akreditasi', 'required', [
            'required' => 'Akreditasi Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('nama_kaprodi', 'Nama Kaprodi', 'required', [
            'required' => 'Nama Kaprodi Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('tahun_berdiri', 'Tahun Berdiri ', 'required', [
            'required' => 'Tahun Berdiri Prodi Wajib diisi',
        ]);
        $this->form_validation->set_rules('output_lulusan', 'Output Lulusan', 'required', [
            'required' => 'Output Lulusan Prodi Wajib diisi',
        ]);
        if ($this->form_validation->run() == false) {
            $this->load->view("layout/header", $data);
            $this->load->view("prodi/vw_ubah_prodi", $data);
            $this->load->view("layout/footer", $data);
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'ruangan' => $this->input->post('ruangan'),
                'jurusan' => $this->input->post('jurusan'),
                'akreditasi' => $this->input->post('akreditasi'),
                'nama_kaprodi' => $this->input->post('nama_kaprodi'),
                'tahun_berdiri' => $this->input->post('tahun_berdiri'),
                'output_lulusan' => $this->input->post('output_lulusan'),
                'BPF-TI' => 'bpftiabcde',
                'id' => $this->input->post('id')
            ];
            $this->prodi_model->update($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Mahasiswa Berhasil DiUbah!</div>');
            redirect('Prodi');
        }
    }
}
