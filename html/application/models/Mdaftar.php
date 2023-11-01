<?php

class Mdaftar extends CI_Model
{
    function make_passwd($n)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz!@#$%^&*()-_=+[]{};:,.<>/?\\|`~';
        $charactersLength = strlen($characters);
        $password = '';
        for ($i = 0; $i < $n; $i++) {
            $password .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $password;
    }

    function simpandaftar()
    {
        try {
            $Username = $this->input->post('Username');
            $namaLengkap = $this->input->post('NamaLengkap');
            $Alamat = $this->input->post('Alamat');
            $Telp = $this->input->post('Telp');
            $Email = $this->input->post('Email');

            if (empty($Username) || empty($namaLengkap) || empty($Alamat) || empty($Telp) || empty($Email)) {
                throw new Exception("All fields are required");
            }

            $Password = $this->make_passwd(32);

            $data = array(
                'Username' => $Username,
                'Password' => $Password,
                'NamaLengkap' => $namaLengkap,
                'Alamat' => $Alamat,
                'Telp' => $Telp,
                'Email' => $Email,
            );

            $this->db->insert('tbdaftar', $data);

            echo "<script>alert('Password anda adalah $Password');</script>";
            echo "<meta http-equiv='refresh' content='0;url=/chalaman/masuk'>";
        } catch (Exception $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
            echo "<meta http-equiv='refresh' content='0;url=/chalaman/daftar'>";
        }
    }
}
