<?php

class Msurat extends CI_Model
{
	public function getJenisSurat()
	{
		$query = $this->db->get('jenisSurat');
		return $query->result();
	}

	public function getSuratAndOwner()
	{
		$this->db->select('surat.*, jenisSurat.name as jenisSuratName, users.username as ownerUsername');
		$this->db->from('surat');
		$this->db->join('jenisSurat', 'surat.jenisSuratId = jenisSurat.id', 'left');
		$this->db->join('users', 'surat.owner = users.id', 'left');
		$query = $this->db->get();
		return $query->result();
	}

	public function getSuratByOwner($ownerId)
	{
		$this->db->select('surat.*, jenisSurat.name as jenisSuratName');
		$this->db->from('surat');
		$this->db->join('jenisSurat', 'surat.jenisSuratId = jenisSurat.id', 'left');
		$this->db->where('surat.owner', $ownerId);
		$query = $this->db->get();

		return $query->result();
	}

	public function getSuratById($suratId)
	{
		$this->db->select('surat.*, jenisSurat.name as jenisSuratName');
		$this->db->from('surat');
		$this->db->join('jenisSurat', 'surat.jenisSuratId = jenisSurat.id', 'left');
		$this->db->where('surat.id', $suratId);
		$query = $this->db->get();

		return $query->result();
	}

	public function updateSurat($id, $data)
	{
		try {
			$this->db->where('id', $id);
			$this->db->update('surat', $data);
			return true;
		} catch (Exception $_e) {
			return false;
		}
	}

	public function addSurat($data)
	{
		$this->db->insert('surat', $data);
	}
	public function getSuratByIdAndOwnerId($id, $ownerId)
	{
		$this->db->where('id', $id);
		$this->db->where('owner', $ownerId);
		$query = $this->db->get('surat');
		return $query->row();
	}

	// Nyoba buat dasbod
	public function getSuratByStatus($status)
	{
		return $this->db->get_where('surat', ['status' => $status]);
	}

	public function getSuratByStatusAndOwnerId($status, $ownerId)
	{
		return $this->db->get_where('surat', ['status' => $status, 'owner' => $ownerId]);
	}
	public function deleteSurat($id)
	{
			// Assume your surat table has a column named 'id'
			$this->db->where('id', $id);
			$result = $this->db->delete('surat');

			return $result;
	}
}
