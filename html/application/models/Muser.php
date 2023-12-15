<?php

class Muser extends CI_Model
{
	public function createUser($username, $email, $password)
	{
		$user = $this->getUserByUsername($username);
		if ($user) {
			throw new Error("Username already exist");
		}
		$encryptedPassword = password_hash($password, PASSWORD_BCRYPT);
		$data = array(
			'username' => $username,
			'password' => $encryptedPassword,
			'email' => $email
		);
		$this->db->insert('users', $data);
		return $this->getUserByUsername($username);
	}
	public function getUserByUsername($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('users');
		if ($result = $query->result_array()) {
			return $result[0];
		} else {
			return false;
		}
	}
	public function updateUserById($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('users', $data);

		if ($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserById($userId)
	{
		$this->db->where('id', $userId);
		$query = $this->db->get('users');

		if ($result = $query->result_array()) {
			return $result[0];
		} else {
			return false;
		}
	}
	public function verifyUser($username, $password)
	{
		$user = $this->getUserByUsername($username);
		if ($user && password_verify($password, $user["password"])) {
			return $user;
		} else {
			throw new Error("Username or password doesn't match");
		}
	}
}
