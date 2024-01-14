<?php

class Pengurus extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->must_admin();
        $this->load->model('mpengurus');
    }

    // public function index()
    // {
    //     $this->auth->must_admin();

    //     $this->form_validation->set_rules('nip', 'Nip', 'required');
    //     $this->form_validation->set_rules('nik', 'Nik', 'required');

    //     $data['title'] = 'Form Pengurus';
    //     $data['pengurusData'] = $this->mpengurus->getAllPengurusWithDetails();

    //     $this->load->view('partials_template/header', $data);
    //     $this->load->view('partials_template/sidebar_template');
    //     $this->load->view('partials_template/navbar_template');
    //     $this->load->view('pengurus/form_pengurus', $data);
    //     $this->load->view('partials_template/footer');
    // }

    public function tambah()
    {
        $this->auth->must_admin();

        // Validasi Form
        $this->form_validation->set_rules('nip', 'Nip', 'required');
        $this->form_validation->set_rules('nik', 'Nik', 'required');

        // Tambahkan validasi untuk kolom lain sesuai kebutuhan

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form pengurus';
            $data['data'] = $this->mpengurus->getNik();
            // Jika validasi gagal, tampilkan kembali form dengan pesan error
            $this->loadViewWithFooterAndHeader('pengurus/form_pengurus', $data);
        } else {
            // Jika validasi sukses, simpan data ke database
            $pengurusData = array(
                'nik' => $this->input->post('nik'),
                'nip' => $this->input->post('nip'),
                'jabatan' => $this->input->post('jabatan'),
                // Tambahkan kolom lain sesuai kebutuhan
            );
            $this->_add($pengurusData);
            // Redirect ke halaman index
            redirect('pengurus/tambah');
        }
    }


    public function edit($idpengurus)
{
    $data = array(
        'title' => 'Edit Pengurus',
        'pengurus' => $this->mpengurus->getPengurusById($idpengurus)
        // ... tambahkan item lain ke $data sesuai kebutuhan
    );
    // Validasi data formulir
    $this->form_validation->set_rules('nip', 'NIP', 'required');

    if ($this->form_validation->run() == FALSE) {
        // Jika validasi gagal, muat ulang formulir pengeditan dengan pesan kesalahan
        $this->load->view('edit_pengurus', $data);
    } else {
        // Jika validasi berhasil, perbarui data pengurus
        $updateData = array(
            'nip' => $this->input->post('nip'),
            'jabatan' => $this->input->post('jabatan'),
            // Tambahkan kolom lain sesuai kebutuhan
        );

        if ($this->mpengurus->updatePengurus($idpengurus, $updateData)) {
            // Update berhasil
            redirect('pengurus/list_pengurus');
        } else {
            // Update gagal
            echo "Update gagal.";
        }
    }
}


    public function hapus($idpengurus)
    {
        // Hapus data dari database
        $this->mpengurus->hapusPengurus($idpengurus);

        // Redirect ke halaman index
        redirect('pengurus/list_pengurus');
    }

    private function loadViewWithFooterAndHeader($view, $pengurusData = array())
    {
        $this->load->view('partials_template/header');
        $this->load->view('partials_template/sidebar_template');
        $this->load->view('partials_template/navbar_template');
        $this->load->view($view, $pengurusData);
        $this->load->view('partials_template/footer');
    }

    function list_pengurus()
    {
        $pengurusData = $this->mpengurus->getAllPengurusWithDetails();
        $data = ['title' => 'List pengurus', 'pengurusData' => $pengurusData];
        $this->loadViewWithFooterAndHeader('pengurus/list_pengurus', $data);
    }

    // Gambar
    private function _uploadImage()
    {
        $config['upload_path'] = './uploads/artikel';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 1000;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768;

        $this->load->library('upload', $config);
        return $this->upload->do_upload('image');
    }
    private function _add($pengurusData)
    {
        // $pengurusData['id'] = uniqid($this->session->userdata('id'));

        if (!$this->_uploadImage()) {
            $error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
            $this->session->set_flashdata('error', $error);
            return;
        }
        $pengurusData['fotoprofil'] = $this->upload->data()['file_name'];
        if ($this->mpengurus->tambahPengurus($pengurusData)) {
            $this->session->set_flashdata('message', 'Data Berhasil Ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan Data.');
        }
    }

    private function _update($pengurusData)
    {
        $id = $this->input->post('id');

        if ($_FILES['image']['name']) {
            if ($this->_uploadImage()) {
                $artikel = $this->martikel->getArtikelWhere(['id' => $id])->row_array();
                $oldImage = $artikel['image_url'];
                unlink(FCPATH . './uploads/artikel/' . $oldImage);

                $pengurusData['image_url'] = $this->upload->data()['file_name'];
            } else {
                $error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
                $this->session->set_flashdata('error', $error);
                return;
            }
        }


        if ($this->martikel->updateArtikel($id, $pengurusData)) {
            $this->session->set_flashdata('message', 'Article updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update the article.');
        }
    }
}