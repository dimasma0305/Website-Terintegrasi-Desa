<?php

class Index  extends CI_Controller
{
	public Muser $muser;
	public function __construct()
	{
		parent::__construct();
		$this->load->model("muser");
	}

	function login()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Login';
			$this->load->view('partials_template/auth_header', $data);
			$this->load->view('partials_template/navbar_public', $data);
			$this->load->view('login_template');
			$this->load->view('partials_template/auth_footer');
		} else {
			$this->_login();
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric|is_unique[users.nik]', [
											'is_unique' => 'NIK already registered'
										]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|matches[password2]', [
											'matches' => 'Password doesnt match'
										]);
		$this->form_validation->set_rules('password2', 'Repeat Password', 'required|trim|matches[password1]'); //edit nanti

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Register';
			$this->load->view('partials_template/auth_header', $data);
			$this->load->view('partials_template/navbar_public', $data);
			$this->load->view('register_template');
			$this->load->view('partials_template/auth_footer');
		} else {
			$this->_register();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		try {
			$user = $this->muser->verifyUser($username, $password);
			$this->session->set_userdata($user);
			if ($r = $this->input->post('redirect')) {
				redirect(base_url($r));
			}else {
				redirect(base_url('dashboard'));
			}
		} catch (Throwable $err) {
			$this->session->set_flashdata('error', $err->getMessage());
			redirect(base_url('index/login'), 'refresh');
		}
	}

	private function _register()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$email = $this->input->post('email');
		$nik = $this->input->post('nik');
		try {
			$user = $this->muser->createUser($username, $email, $password, $nik);
			$this->session->set_userdata($user);
			redirect(base_url('dashboard'), 'refresh');
		} catch (Throwable $err) {
			$this->session->set_flashdata('error', $err->getMessage());
			redirect(base_url('index/register'), 'refresh');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("/"), "refresh");
	}
}
