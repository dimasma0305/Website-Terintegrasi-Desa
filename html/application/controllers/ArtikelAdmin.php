<?php

class ArtikelAdmin extends CI_Controller
{
	public Auth $auth;
    function __construct()
    {
        parent::__construct();
		$this->load->library('auth');
		$this->auth->must_admin();
    }
	function add(){

	}
}
