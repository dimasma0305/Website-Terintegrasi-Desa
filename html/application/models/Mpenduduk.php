<?php

class Mpenduduk extends CI_Model
{
    public function getPendudukByNik($nik)
    {
        // Query untuk mengambil data penduduk berdasarkan NIK
        $this->db->where('nik', $nik);
        $query = $this->db->get('penduduk');

        // Periksa apakah ada data yang sesuai
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Mengembalikan data sebagai array
        } else {
            return null; // Mengembalikan null jika tidak ditemukan data
        }
    }

    public function getPendidikan()
    {
        $query = $this->db->get('pendidikan');
        return $query->result_array();
    }

    public function getPekerjaan()
    {
        $query = $this->db->get('pekerjaan');
        return $query->result_array();
    }

    public function getAllPendudukWithDetails()
    {
        $this->db->select('penduduk.*, pendidikan.pendidikan, pekerjaan.pekerjaan');
        $this->db->from('penduduk');
        $this->db->join('pendidikan', 'penduduk.pendidikan_id = pendidikan.id');
        $this->db->join('pekerjaan', 'penduduk.pekerjaan_id = pekerjaan.id');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function tambahPenduduk($data)
    {
        return $this->db->insert('penduduk', $data);
    }

    public function updatePenduduk($nik, $formData)
    {
        $this->db->where('nik', $nik);
    
        if ($this->db->update('penduduk', $formData)) {
            // Update berhasil
            return true;
        } else {
            // Update gagal, tampilkan pesan kesalahan
            echo $this->db->error(); // Hanya untuk keperluan debug, hindari ini di produksi
            return false;
        }
    }

    public function hapusPenduduk($nik)
    {
        $this->db->where('nik', $nik);
        return $this->db->delete('penduduk');
    }

    public function getPendudukWhere($where=[])
    {
		return $this->db->get_where('penduduk', $where);
    }

    public function count($where = []) {
        $this->db->from('penduduk');

        if (!empty($where)) {
            $this->db->where($where);
        }

        return $this->db->count_all_results();
    }
}