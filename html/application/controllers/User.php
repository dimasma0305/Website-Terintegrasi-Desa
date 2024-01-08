<?php

class User extends CI_Controller
{
	public Auth $auth;
	public Muser $muser;

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth');
		$this->auth->must_login();
		$this->load->model('muser');
		$this->load->model('msurat');
	}

	public function dashboard()
	{
		$data['title'] = 'Dashboard';
		$data['diterima'] = $this->msurat->getSuratByStatus('diterima')->num_rows();
		$data['pending'] = $this->msurat->getSuratByStatus('pending')->num_rows();
		$data['ditolak'] = $this->msurat->getSuratByStatus('ditolak')->num_rows();

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view('dashboard_template', $data);
		$this->load->view('partials_template/footer');
	}

	public function profile()
	{
		$userId = $this->session->userdata('id');
		$user = $this->muser->getUserById($userId);

		$data['title'] = 'Profile';
		$data['user'] = $user;

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view('user/profile', $data);
		$this->load->view('partials_template/footer');
	}

	public function editProfile()
	{
		$userId = $this->session->userdata('id');
		$user = $this->muser->getUserById($userId);

		$data['title'] = 'Edit Profile';
		$data['user'] = $user;
		$data['edit_mode'] = true; // Add an edit_mode variable

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view('user/profile', $data); // Create a new view file for the edit profile form
		$this->load->view('partials_template/footer');
	}

	public function updateProfile()
	{
		$userId = $this->session->userdata('id');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$nik = $this->input->post('nik');
		$data = [];

		if (!empty($username)) {
			$data += ['username' => $username];
		}
		if (!empty($email)) {
			$data += ['email' => $email];
		}
		if (!empty($nik)) {
			$data += ['nik' => $nik];
			if (!$this->muser->checkNikExist($nik)) {
				$this->session->set_flashdata('error', "Nik doesn't exist");
				redirect(base_url('user/profile'));
				exit(1);
			}
		}
		$result = $this->muser->updateUserById($userId, $data);

		if ($result) {
			$this->session->set_flashdata('success', 'Profile updated successfully.');
		} else {
			$this->session->set_flashdata('error', 'Failed to update profile.');
		}

		redirect('user/profile');
	}
}
