<?php

class Cadmin extends CI_Controller
{
    public Msurat $msurat;
    function __construct()
    {
        parent::__construct();
        $userdata = $this->session->get_userdata();
        if (!isset($userdata['id']) || $userdata['role'] != "admin") {
            redirect(base_url('cindex/login'), 'refresh');
            exit();
        }
        $this->load->model('msurat');
    }

    function index()
    {
    }
}
