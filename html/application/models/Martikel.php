<?php

class Martikel extends CI_Model
{
	public function getArtikelWhere($where=[])
	{
		return $this->db->get_where('artikel', $where);
	}

	public function getAllArtikel($limit=null, $offset=null)
	{
		$this->db->select('artikel.*, users.username AS username');
		$this->db->from('artikel');
		$this->db->join('users', 'artikel.author_id = users.id');

		if (($limit !== null) && ($offset !== null)) {
			$this->db->limit($limit, $offset);
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

	public function count($where = []) {
        $this->db->from('artikel');

        if (!empty($where)) {
            $this->db->where($where);
        }

        return $this->db->count_all_results();
    }
}
