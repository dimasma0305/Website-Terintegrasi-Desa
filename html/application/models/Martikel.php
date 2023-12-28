<?php

class Martikel extends CI_Model
{
	public function getArtikel()
	{
		// Fetch all articles from the 'articles' table
		$query = $this->db->get('artikel');
		return $query->result();
	}

	public function getArtikelById($artikelId)
	{
		// Fetch a specific article by ID from the 'articles' table
		$this->db->where('id', $artikelId);
		$query = $this->db->get('artikel');

		return $query->row();
	}

	public function getAllArtikel()
	{
		return $this->db->get('artikel')->result();
	}

	public function createArtikel($data)
	{
		return $this->db->insert('artikel', $data);
	}

	public function updateArtikel($artikelId, $title, $content)
	{
		// Update an existing article in the 'articles' table
		$data = array(
			'title' => $title,
			'content' => $content
		);

		$this->db->where('id', $artikelId);
		$this->db->update('artikel', $data);
	}

	public function deleteArtikel($artikelId)
	{
		// Delete an article from the 'articles' table
		$this->db->where('id', $artikelId);
		$this->db->delete('artikel');
	}
}
