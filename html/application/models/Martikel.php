<?php

class Martikel extends CI_Model
{
	public function getArtikel()
	{
		// Fetch all articles from the 'articles' table
		$query = $this->db->get('artikel');
		return $query->result();
	}

	public function getArtikelWhere($where=[])
	{
		return $this->db->get_where('artikel', $where);
	}

	public function getAllArtikel()
	{
		return $this->db->get('artikel')->result();
	}

	public function createArtikel($data)
	{
		return $this->db->insert('artikel', $data);
	}

	public function updateArtikel( $payload=[] ,$id)
	{
		// Update an existing article in the 'articles' table
		// $data = array(
		// 	'title' => $title,
		// 	'content' => $content
		// );

		// $this->db->where('id', $artikelId);
		// $this->db->update('artikel', $data);

		return $this->db->update('artikel', $payload, ['id']);
	}

	public function deleteArtikel($artikelId)
	{
		// Delete an article from the 'articles' table
		$this->db->where('id', $artikelId);
		return $this->db->delete('artikel');
	}
}
