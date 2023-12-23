<?php

class Martikel extends CI_Model
{
	public function getArtikel()
	{
		// Fetch all articles from the 'articles' table
		$query = $this->db->get('artikel');
		return $query->result();
	}

	public function getArtikelById($articleId)
	{
		// Fetch a specific article by ID from the 'articles' table
		$this->db->where('id', $articleId);
		$query = $this->db->get('artikel');

		return $query->row();
	}

	public function getAllArtikel()
	{
		return $this->db->get('artikel')->result();
	}

	public function createArtikel($title, $content, $authorId)
	{
		$articleId = uniqid($authorId);

		$data = array(
			'id' => $articleId,
			'title' => $title,
			'content' => $content,
			'author_id' => $authorId
		);

		$this->db->insert('artikel', $data);

		return $articleId;
	}

	public function updateArtikel($articleId, $title, $content)
	{
		// Update an existing article in the 'articles' table
		$data = array(
			'title' => $title,
			'content' => $content
		);

		$this->db->where('id', $articleId);
		$this->db->update('artikel', $data);
	}

	public function deleteArtikel($articleId)
	{
		// Delete an article from the 'articles' table
		$this->db->where('id', $articleId);
		$this->db->delete('artikel');
	}
}
