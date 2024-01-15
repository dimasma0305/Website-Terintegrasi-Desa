<?php

class Auth
{
	protected $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	function must_admin()
	{
		$userdata = $this->CI->session->get_userdata();
		if (!isset($userdata['id']) || $userdata['role'] != "admin") {
			redirect(base_url('index/login?r=' . $this->CI->uri->uri_string()));
			exit();
		}
	}
	function must_login()
	{
		if (!isset($this->CI->session->get_userdata()['id'])) {
			redirect(base_url('index/login?r=' . $this->CI->uri->uri_string()));
			exit();
		}
	}
}
