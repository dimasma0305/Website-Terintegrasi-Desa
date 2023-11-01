<?php

class Mprodi extends CI_Model
{
	function simpan_data()
	{
		try {
			$this->db->insert('tbprodi', $_POST);
			echo "<script>alert('Data Berhasil Disimpan');</script>";
			echo "<meta http-equiv='refresh' content='0;url=/cprodi/tampil'>";
		} catch (Exception $e) {
			echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
			echo "<meta http-equiv='refresh' content='0;url=/cprodi/tampil'>";
		}
	}

	function get_prodis(){
		$query = $this->db->get("tbprodi");
		return $query->result();
	}
}
