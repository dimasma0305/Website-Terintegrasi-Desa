<?php

class Muser extends CI_Model
{
	public function __construct() {
	    parent::__construct();
		$this->load->library('encryption');
	}
	public function createUser($username, $password) {
		$user = $this->getUserByUsername($username);
		if ($user){
			throw new Error("username already exist");
		}
		$encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
		$data = array(
			'username' => $username,
			'password' => $encryptedPassword
		);
		$this->db->insert('users', $data);
		return $this->getUserByUsername($data["username"]);
	}
	public function getUserByUsername($username) {
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		return $query->result_array()[0];
	}
	public function verifyUser($username, $password) {
		$user = $this->getUserByUsername($username);
		if ($user && password_verify($password, $user["password"])) {
			return $user;
		} else {
			throw new Error("username or password doesn't match");
		}
	}
}