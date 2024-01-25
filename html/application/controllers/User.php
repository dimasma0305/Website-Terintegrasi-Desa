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
		$this->load->model('mpenduduk');
		$this->load->model('mpengurus');
		$this->load->model('martikel');
	}

	public function dashboard()
	{
		$data['title'] = 'Dashboard';
		$data['title'] = 'Dashboard';

		$role = $this->session->userdata('role');
		
		if ($role == 'admin') 
		{
			$dashboard = "user/dashboard_admin";
			$data['data'] = [
				'surat'=> $this->msurat->count(),
				'penduduk' => $this->mpenduduk->count(),
				'pengurus' => $this->mpengurus->count(),
				'artikel' => $this->martikel->count()
			];
		} 
		else
		{
			$dashboard = "user/dashboard_user";
			$ownerId = $this->session->userdata('id');
			$data['surat'] = [
				'diterima'=> $this->msurat->getSuratByStatusAndOwnerId('diterima', $ownerId)->num_rows(),
				'pending' => $this->msurat->getSuratByStatusAndOwnerId('pending', $ownerId)->num_rows(),
				'ditolak' => $this->msurat->getSuratByStatusAndOwnerId('ditolak', $ownerId)->num_rows()
			];
		}

		$this->load->view('partials_template/header', $data);
		$this->load->view('partials_template/sidebar_template');
		$this->load->view('partials_template/navbar_template');
		$this->load->view($dashboard, $data);
		$this->load->view('partials_template/footer', $data);
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

	public function chart()
	{
		$role = $this->session->userdata('role');
		
		if ($role == 'admin') 
		{
			$data['surat'] = [
				'Diterima'=> $this->msurat->count(['status' => 'diterima']),
				'Pending'=> $this->msurat->count(['status' => 'pending']),
				'Ditolak'=> $this->msurat->count(['status' => 'ditolak'])
			];

			$data['pendidikan'] = [
				'SD'=> $this->mpenduduk->count(['pendidikan_id' => 1]),
				'SMP'=> $this->mpenduduk->count(['pendidikan_id' => 2]),
				'SMA'=> $this->mpenduduk->count(['pendidikan_id' => 3]),
				'S1'=> $this->mpenduduk->count(['pendidikan_id' => 4])
			];
	
			$data['jenisKelamin'] = [
				'Laki-laki'=> $this->mpenduduk->count(['jenis_kelamin' => 'Laki-laki']),
				'Perempuan'=> $this->mpenduduk->count(['jenis_kelamin' => 'Perempuan'])
			];

			$data['pekerjaan'] = [
				'PNS' => $this->mpenduduk->count(['pekerjaan_id' => 1]),
				'Swasta' => $this->mpenduduk->count(['pekerjaan_id' => 2]),
				'-'=> $this->mpenduduk->count(['pekerjaan_id' => 3])
			];	
		} 
		else
		{
			$ownerId = $this->session->userdata('id');
			$data['surat'] = [
				'Diterima'=> $this->msurat->count(['status' => 'diterima', 'owner' => $ownerId]),
				'Pending'=> $this->msurat->count(['status' => 'pending', 'owner' => $ownerId]),
				'Ditolak'=> $this->msurat->count(['status' => 'ditolak', 'owner' => $ownerId])
			];
		}

		header('Content-Type: application/json');
		echo json_encode($data);
	}

}
