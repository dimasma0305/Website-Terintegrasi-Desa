<?php

class Msurat extends CI_Model
{
    public function getJenisSurat()
    {
        $query = $this->db->get('jenisSurat');
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
        $this->db->where('id', $suratId);
        $query = $this->db->get('surat');
        return $query->row();
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

}
