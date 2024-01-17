<?php

class Mpengurus extends CI_Model
{

    // Mengambil data pengurus berdasarkan ID dengan melakukan JOIN antara tabel pengurus dan penduduk. 
    // Hasilnya berupa array yang mencakup informasi pengurus dan nama penduduk.
    public function getPengurusById($id)
{
    $this->db->select('pengurus.*, penduduk.nama');
    $this->db->from('pengurus');
    $this->db->join('penduduk', 'pengurus.nik = penduduk.nik');
    $this->db->where('pengurus.id', $id);
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
        return $query->row_array();
    } else {
        return null;
    }
}

    //  Mengambil data NIK dan nama penduduk dari tabel penduduk untuk digunakan pada dropdown di form.
    public function getNik()
    {
        $query = $this->db->get('penduduk');
        return $query->result_array();
    }

    // Mengambil semua data pengurus dengan informasi terkait, seperti nama, tanggal lahir, pendidikan, dll. 
    // Ini melibatkan JOIN antara tabel pengurus, penduduk, dan pendidikan.
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

    // Menambahkan data pengurus ke tabel 
    public function tambahPengurus($pengurusData)
    {
        return $this->db->insert('pengurus', $pengurusData);
    }

    // Mengupdate data pengurus berdasarkan ID
        public function updatePengurus($id, $formData)
    {
        $this->db->where('id', $id);

        if ($this->db->update('pengurus', $formData)) {
            // Update berhasil
            return true;
        } else {
            echo $this->db->error();
            return false;
        }
    }

    
    // Menghapus data pengurus berdasarkan ID.
    public function hapusPengurus($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('pengurus');
    }
}