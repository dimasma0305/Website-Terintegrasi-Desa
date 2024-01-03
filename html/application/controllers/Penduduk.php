<?php

Class Penduduk extends CI_Controller {
    function __construct() 
    {
        parent::__construct();
		$this->load->library('auth');
        $this->auth->must_admin();
		$this->load->model('mpenduduk');
    }

    public function index()
    {
        $data['title'] = 'Penduduk';
        $data['pendudukData'] = $this->mpenduduk->getAllPenduduk();

        $this->load->view('partials_template/header', $data);
        $this->load->view('partials_template/sidebar_template');
        $this->load->view('partials_template/navbar_template');
        $this->load->view('admin/penduduk_list', $data);
        $this->load->view('partials_template/footer');
    }
}