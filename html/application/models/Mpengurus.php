<?php

class Mpengurus extends CI_Model
{
    public function getPengurusById($idpengurus)
{
    $this->db->select('pengurus.*, penduduk.nama');
    $this->db->from('pengurus');
    $this->db->join('penduduk', 'pengurus.nik = penduduk.nik');
    $this->db->where('pengurus.idpengurus', $idpengurus);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array();
    } else {
        return null;
    }
}


    public function getNik()
    {
        $query = $this->db->get('penduduk');
        return $query->result_array();
    }


    public function getAllPengurusWithDetails()
    {
        $this->db->select('pengurus.*,penduduk.nama, penduduk.tanggal_lahir, penduduk.pendidikan_id,pendidikan.pendidikan');
        $this->db->from('pengurus');
        // cari data nama dan tanggal lahir
        $this->db->join('penduduk', 'pengurus.nik = penduduk.nik');
        //cari data pendidikan
        $this->db->join('pendidikan', 'penduduk.pendidikan_id = pendidikan.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function tambahPengurus($pengurusData)
    {
        return $this->db->insert('pengurus', $pengurusData);
    }

        public function updatePengurus($idpengurus, $formData)
    {
        $this->db->where('idpengurus', $idpengurus);

        if ($this->db->update('pengurus', $formData)) {
            // Update berhasil
            return true;
        } else {
            echo $this->db->error();
            return false;
        }
    }

    

    public function hapusPengurus($idpengurus)
    {
        $this->db->where('idpengurus', $idpengurus);
        return $this->db->delete('pengurus');
    }
}