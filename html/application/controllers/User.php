<?php

class User extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        if (!isset($this->session->get_userdata()['id'])) {
            redirect(base_url('index/login?r='.$this->uri->uri_string()));
			exit();
		}
    }

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view('dashboard_template', $data);
		$this->load->view('partials_template/footer');
    }
}