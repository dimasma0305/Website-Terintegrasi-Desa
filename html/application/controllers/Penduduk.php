<?php

class Penduduk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->must_admin();
        $this->load->model('mpenduduk');
    }

    public function index()
    {
        $data['title'] = 'Form Penduduk';
        $data['pendudukData'] = $this->mpenduduk->getAllPendudukWithDetails();

        $this->load->view('partials_template/header', $data);
        $this->load->view('partials_template/sidebar_template');
        $this->load->view('partials_template/navbar_template');
        $this->load->view('penduduk/form_penduduk', $data);
        $this->load->view('partials_template/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Form Penduduk';
        $data['pendidikan'] = $this->mpenduduk->getPendidikan();
        $data['pekerjaan'] = $this->mpenduduk->getPekerjaan();

        // Validasi Form
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('pendidikan_id', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan_id', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        // Tambahkan validasi untuk kolom lain sesuai kebutuhan

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->loadViewWithFooterAndHeader('penduduk/form_penduduk', $data);
        } else {
            // Jika validasi sukses, simpan data ke database
            $data_penduduk = array(
                'nik' => $this->input->post('nik'),
                'nama' => $this->input->post('nama'),
                'pendidikan_id' => $this->input->post('pendidikan_id'),
                'pekerjaan_id' => $this->input->post('pekerjaan_id'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat')
                // Tambahkan kolom lain sesuai kebutuhan
            );

            $this->mpenduduk->tambahPenduduk($data_penduduk);

            // Redirect ke halaman index
            redirect('penduduk');
        }
    }


    public function edit($nik)
    {
        $data['title'] = 'Edit Penduduk';
        $data['penduduk'] = $this->mpenduduk->getPendudukByNik($nik);
        $data['pendidikan'] = $this->mpenduduk->getPendidikan();
        $data['pekerjaan'] = $this->mpenduduk->getPekerjaan();

        $formData = array(
            'nama' => $this->input->post('nama'),
            'pendidikan_id' => $this->input->post('pendidikan_id'),
            'pekerjaan_id' => $this->input->post('pekerjaan_id'),
            'tanggal_lahir' => $this->input->post('tanggal_lahir'),
            'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            'alamat' => $this->input->post('alamat')
            // Tambahkan kolom lain sesuai kebutuhan
        );

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('pendidikan_id', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan_id', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        // Tambahkan validasi untuk kolom lain sesuai kebutuhan

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
			$this->session->set_flashdata('error', validation_errors());
            $this->loadViewWithFooterAndHeader('penduduk/edit_penduduk', $data);
        } else {
            // Jika validasi sukses, update data ke database
            $this->mpenduduk->updatePenduduk($nik, $formData);

            // Redirect ke halaman index
            redirect('penduduk/list_penduduk');
        }
    }

    public function hapus($nik)
    {
        // Hapus data dari database
        $this->mpenduduk->hapusPenduduk($nik);

        // Redirect ke halaman index
        redirect('penduduk/list_penduduk');
    }

    private function loadViewWithFooterAndHeader($view, $pendudukData = array())
    {
        $this->load->view('partials_template/header', $pendudukData);
        $this->load->view('partials_template/sidebar_template');
        $this->load->view('partials_template/navbar_template');
        $this->load->view($view, $pendudukData);
        $this->load->view('partials_template/footer');
    }

    function list_penduduk()
    {
        $pendudukData = $this->mpenduduk->getAllPendudukWithDetails();
        $data = ['title' => 'List Penduduk', 'pendudukData' => $pendudukData];
        $this->loadViewWithFooterAndHeader('penduduk/list_penduduk', $data);
    }
}
