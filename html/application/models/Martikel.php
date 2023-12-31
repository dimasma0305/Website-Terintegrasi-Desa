<?php

class Martikel extends CI_Model
{
	public function getArtikelWhere($where=[])
	{
		return $this->db->get_where('artikel', $where);
	}

	public function getAllArtikel($limit=null)
	{
		$this->db->select('artikel.*, users.username AS username');
		$this->db->from('artikel');
		$this->db->join('users', 'artikel.author_id = users.id');

		if ($limit !== null) {
			$this->db->limit($limit);
		}

		return $this->db->get()->result();
	}

	public function createArtikel($data)
	{
		return $this->db->insert('artikel', $data);
	}

	public function updateArtikel($id, $payload=[])
	{
		return $this->db->update('artikel', $payload, ['id' => $id]);
	}

	public function deleteArtikel($artikelId)
	{
		$this->db->where('id', $artikelId);
		return $this->db->delete('artikel');
	}
}
