<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function insert($data) {

        $this->db->insert('users', $data);

        $insertId = $this->db->insert_id();

        $dataDetails = [

            'user_id' => $insertId,

            'last_updated_date' => date('Y-m-d'),

            'last_updated_time' => date('H:i:s'),

            'last_updated_remote' => $_SERVER['REMOTE_ADDR']

        ];

        $this->db->insert('user_details', $dataDetails);

        return $insertId;

    }

    public function verification($key) {

        $this->db->where('verification_key', $key);

        $this->db->where('is_verified', '0');

        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {

            $data = [

                'is_verified' => 1

            ];

            $this->db->where('verification_key', $key);

            $this->db->update('users', $data);

        } else {

            return false;

        }

    }

    public function checkLogin($email, $password, $operatingSystem, $browser) {

        $this->db->where('email', $email);

        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {

            foreach ($query->result() as $key) {

                $decPassword = $this->encryption->decrypt($key->password);

                if ($decPassword == $password) {

                    if ($key->is_verified == 1) {

                        $loginData = [

                            'user_id' => $key->id,

                            'os' => $operatingSystem,

                            'browser' => $browser,

                            'ip' => $_SERVER['REMOTE_ADDR'],

                            'login_date' => date('Y-m-d'),

                            'login_time' => date('H:i:s')


                        ];

                        $this->db->insert('login_history', $loginData);

                        $this->load->model('Profile_model');

                        $userDetails = $this->Profile_model->getUserDetails();

                        foreach ($userDetails as $userDetailsKey) {

                            $this->session->set_userdata('image', $userDetailsKey->profile_image);

                        }

                        $this->session->set_userdata('id', $key->id);

                        $this->session->set_userdata('email', $key->email);

                        $this->session->set_userdata('name', $key->name);

                    } else {

                        return "Email not verified";

                    }

                } else {

                    return 'Incorrect password';

                }

            }

        } else {

            return "Wrong email address";

        }

    }

}

?>