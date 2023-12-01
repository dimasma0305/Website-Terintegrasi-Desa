<?php

class Index  extends CI_Controller
{
	public Muser $muser;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("muser");
	}

	private function loadViewWithFooterAndHeader($name, $vars = [])
	{
		$this->load->view('includes/header');
		$this->load->view('partials/navbar');
		$this->load->view($name, $vars);
		$this->load->view('includes/footer');
	}

	function index() {
		$this->loadViewWithFooterAndHeader('index');
	}

	function login_template() {
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Login';
			$this->load->view('includes/header_template', $data);
			$this->load->view('partials/navbar_template', $data);
			$this->load->view('login_template');
			$this->load->view('includes/footer_template');
		} else {
			echo "nice";
		}
	}

	function register_template() {
		$data['title'] = 'Register';
		$this->load->view('includes/header_template', $data);
		$this->load->view('partials/navbar_template', $data);
		$this->load->view('register_template');
		$this->load->view('includes/footer_template');

	}

	function  login() {
		if ($this->input->method() === "get"){
			$this->loadViewWithFooterAndHeader('login');
		} elseif ($this->input->method() === 'post'){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			try {
				$user = $this->muser->verifyUser($username, $password);
				$this->session->set_userdata($user);
				if ($r = $this->input->post('redirect')){
					redirect(base_url($r));
				}else {
					redirect(base_url('/'));
				}
			} catch (Throwable $err){
				$this->session->set_flashdata('error', $err->getMessage());
				redirect(base_url('cindex/login'), 'refresh');
			}
		}
	}

	function register() {
		if ($this->input->method() === "get"){
			$this->loadViewWithFooterAndHeader('register');
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
