<?php

class User extends CI_Controller{
	public Auth $auth;
    function __construct()
    {
        parent::__construct();
		$this->load->library('auth');
		$this->auth->must_login();
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
