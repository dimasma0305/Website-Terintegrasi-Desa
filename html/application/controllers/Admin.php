<?php

class Admin extends CI_Controller
{
    public Msurat $msurat;
	public Auth $auth;
    function __construct()
    {
        parent::__construct();
		$this->load->library('auth');
		$this->auth->must_admin();
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
