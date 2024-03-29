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

   
    // Menangani proses penambahan atau pengeditan data pengurus. 
    // Melibatkan validasi form, upload gambar, dan pemanggilan model untuk menambah atau mengupdate data.
    public function tambah()
    {
        $this->auth->must_admin();

        // Validasi Form
        $this->form_validation->set_rules('nip', 'Nip', 'required');
        $this->form_validation->set_rules('nik', 'Nik', 'required|numeric');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');

        // Tambahkan validasi untuk kolom lain sesuai kebutuhan

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Form pengurus';
            $data['data'] = $this->mpengurus->getNik();
            $data['pengurus'] = $this->mpengurus->getAllPengurusWithDetails();
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

            if ($this->input->post('id')) {
                $this->_update($pengurusData);
            } else {
                $this->_add($pengurusData);
            }
            // Redirect ke halaman index
            redirect('pengurus/tambah');
        }
    }



public function edit ()
{
    $id = $this->input->post('id');

    $data = $this->mpengurus->getPengurusById($id);
    
    $this->output->set_content_type('application/json')->set_output(json_encode($data));
}


    public function hapus($id)
    {
        $pengurus = $this->mpengurus->getPengurusById($id);
		unlink(FCPATH . './uploads/pengurus/' . $pengurus['fotoprofil']);

		if ($this->mpengurus->hapusPengurus($id)) {
			$this->session->set_flashdata('message', 'Data Berhasil Dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Data Gagal Dihapus.');
		}

        // Redirect ke halaman index
        redirect('pengurus/tambah');
    }

    private function loadViewWithFooterAndHeader($view, $pengurusData = array())
    {
        $this->load->view('partials_template/header', $pengurusData);
        $this->load->view('partials_template/sidebar_template');
        $this->load->view('partials_template/navbar_template');
        $this->load->view($view, $pengurusData);
        $this->load->view('partials_template/footer');
    }

    // Gambar
    private function _uploadImage()
    {
        $config['upload_path'] = './uploads/pengurus';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = 2048;
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
                $pengurus = $this->mpengurus->getPengurusById($id);
                $oldImage = $pengurus['fotoprofil'];
                unlink(FCPATH . './uploads/pengurus/' . $oldImage);

                $pengurusData['fotoprofil'] = $this->upload->data()['file_name'];
            } else {
                $error = $this->upload->display_errors('<p class="m-0 p-0">', '</p>');
                $this->session->set_flashdata('error', $error);
                return;
            }
        }


        if ($this->mpengurus->updatePengurus($id, $pengurusData)) {
            $this->session->set_flashdata('message', 'Data Berhasil Diupdate.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan Data.');
        }
    }
}