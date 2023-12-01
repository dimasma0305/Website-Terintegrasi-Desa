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

	function surat(){
		switch ($this->input->method()) {
			case 'get':
				$suratData = $this->msurat->getSuratAndOwner();
				$this->loadViewWithFooterAndHeader('admin/list', ['suratData' => $suratData]);
				break;
			default:
				$this->output->set_status_header(405);
				echo 'Method not allowed';
				break;
		}
	}
}
