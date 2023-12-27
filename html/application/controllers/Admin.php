<?php

class Admin extends CI_Controller
{
    public Mpenduduk $mpenduduk; // Add Mpenduduk model
    public Msurat $msurat;
    public Auth $auth;

    function __construct()
    {
        parent::__construct();
        $this->load->library('auth');
        $this->auth->must_admin();
        $this->load->model('msurat');
        $this->load->model('mpenduduk'); // Load Mpenduduk model
    }

    private function loadViewWithFooterAndHeader($name, $vars = [])
    {
		$this->load->view('partials_template/header', $vars);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
        $this->load->view($name, $vars);
		$this->load->view('partials_template/footer');
    }

    function index()
    {
        // Your index method logic here
    }

    function surat_list()
    {
        $suratData = $this->msurat->getSuratAndOwner();
        $this->loadViewWithFooterAndHeader('admin/surat_list', ['title'=>'list surat','suratData' => $suratData]);
    }

    function surat_update_status($id)
    {
        $status = $this->input->post('status');
        $result = $this->msurat->updateSurat($id, ['status' => $status]);
        if ($result) {
            $response = ['status' => 'ok', 'message' => 'Status updated successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Error updating status.'];
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function penduduk_list()
    {
        $pendudukData = $this->mpenduduk->getAllPenduduk();
        $this->loadViewWithFooterAndHeader('admin/penduduk_list', ['title'=>'list penduduk','pendudukData' => $pendudukData]);
    }
}
