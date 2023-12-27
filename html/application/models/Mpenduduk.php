<?php

class Mpenduduk extends CI_Model
{
	public function getPendudukByNik($nik)
	{
		$this->db->where('nik', $nik);
		$query = $this->db->get('penduduk');

		if ($result = $query->row_array()) {
			return $result;
		} else {
			return false;
		}
	}
	public function getAllPenduduk()
	{
		$query = $this->db->get('penduduk');

		if ($result = $query->result_array()) {
			return $result;
		} else {
			return false;
		}
	}
}
