<?php

class Mmasuk extends CI_Model
{
    function prosesLogin()
    {
        $Username = $this->input->post('Username');
        $Password = $this->input->post('Password');
        $data = array(
            'Username' => $Username,
            'Password' => $Password,
        );
        $query = $this->db->get_where('tbdaftar', $data);
        if ($query->num_rows()){
			$this->session->NamaLengkap = $query->result()[0]->NamaLengkap;
			$this->session->id = $query->result()[0]->id;
			redirect("/cadmin/admin");
        } else {
			$this->session->set_flashdata('msg', 'Anda gagal login');
			redirect("/chalaman/masuk", "refresh");
        }
    }
}
