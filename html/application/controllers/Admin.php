<?php

class Admin extends CI_Controller
{
    public Msurat $msurat;
    function __construct()
    {
        parent::__construct();
        $userdata = $this->session->get_userdata();
        if (!isset($userdata['id']) || $userdata['role'] != "admin") {
            redirect(base_url('index/login?r='.$this->uri->uri_string()));
            exit();
        }
        $this->load->model('msurat');
    }

	private function loadViewWithFooterAndHeader($name, $vars = [])
	{
		$this->load->view('includes/header');
		$this->load->view('partials/navbar');
		$this->load->view($name, $vars);
		$this->load->view('includes/footer');
	}

    function index()
    {

    }

	function surat_list(){
		$suratData = $this->msurat->getSuratAndOwner();
		$this->loadViewWithFooterAndHeader('admin/surat_list', ['suratData' => $suratData]);
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
}
