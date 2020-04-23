<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_model extends CI_Model {

    public function getLoginHistory() {

        $this->db->where('user_id', $this->session->userdata('id'));

        $data = $this->db->get('login_history');

        return $data->result();

    }

    public function changePassword($current, $new) {

        $this->db->where('id', $this->session->userdata('id'));

        $result = $this->db->get('users');

        foreach ($result->result() as $key) {

            $oldEncryptedPassword = $key->password;

        }

        $currentDecrypted = $this->encryption->decrypt($oldEncryptedPassword);

        if ($current == $currentDecrypted) {

            $newEncrypted = $this->encryption->encrypt($new);

            $updateData = [

                'password' => $newEncrypted

            ];

            $this->db->where('id', $this->session->userdata('id'));

            if ($this->db->update('users', $updateData)) {

                return "Password changed";

            } else {

                return "Something went wrong, please try again";

            }

        } else {

            return 'Access denied! Invalid password.';

        }

    }

}

?>