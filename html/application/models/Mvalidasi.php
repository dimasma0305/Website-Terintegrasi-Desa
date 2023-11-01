<?php

class Mvalidasi extends CI_Model
{
	 function  validasi() {
		 if (!isset($this->session->NamaLengkap)) {
			 redirect('/', 'refresh');
		 }
	 }
}
