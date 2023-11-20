<?php


class Cindex  extends CI_Controller
{
	public Muser $muser;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("muser");
	}

	function index() {
		$this->load->view('includes/header');
		$this->load->view('partials/navbar');
	    $this->load->view("index");
		$this->load->view('includes/footer');
	}

	// Test template
	function login_template() {
		$this->load->view('includes/header_template');
		$this->load->view('login_template');
		$this->load->view('includes/footer_template');
	}

	function  login() {
		if ($this->input->method() === "get"){
			$this->load->view('includes/header');
			$this->load->view('partials/navbar');
			$this->load->view('login');
			$this->load->view('includes/footer');
		} elseif ($this->input->method() === 'post'){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			try {
				$user = $this->muser->verifyUser($username, $password);
				$this->session->set_userdata($user);
				redirect(base_url('/'), 'refresh');
			} catch (Throwable $err){
				$this->session->set_flashdata('error', $err->getMessage());
				redirect(base_url('cindex/login'), 'refresh');
			}
		}
	}
	function register() {
		if ($this->input->method() === "get"){
			$this->load->view('includes/header');
			$this->load->view('partials/navbar');
			$this->load->view('register');
			$this->load->view('includes/footer');
		} elseif ($this->input->method() === 'post'){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			try {
				$user = $this->muser->createUser($username, $password);
				$this->session->set_userdata($user);
				redirect(base_url('/'), 'refresh');
			} catch (Throwable $err){
				$this->session->set_flashdata('error', $err->getMessage());
				redirect(base_url('cindex/register'), 'refresh');
			}
		}
	}
	function logout(){
		$this->session->sess_destroy();
		redirect(base_url("/"), "refresh");
	}
}
