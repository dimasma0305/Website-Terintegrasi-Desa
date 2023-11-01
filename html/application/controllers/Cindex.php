<?php


class Cindex  extends CI_Controller
{
	function index() {
		$this->load->view('includes/header');
		$this->load->view('partials/navbar');
	    $this->load->view("index");
		$this->load->view('includes/footer');
	}
}
