<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    public function getUserDetails() {

        $this->db->where('user_id', $this->session->userdata('id'));

        $data = $this->db->get('user_details');

        return $data->result();

    }

    public function updateDp($data) {

        $this->db->where('user_id', $this->session->userdata('id'));

        if ($this->db->update('user_details', $data))

            return true;

        else

            return false;

    }

}