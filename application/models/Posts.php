<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts extends CI_Model {

    public function getCategories() {

        $this->db->where('status', 1);

        $data = $this->db->get('categories');

        return $data->result();

    }

    public function insertPost($data) {

        $this->db->insert('posts', $data);

        return $this->db->insert_id();

    }

    public function insertCover($data) {

        $this->db->insert('covers', $data);

        return $this->db->insert_id();

    }

    public function publishedPosts() {

        $this->db->where('status', 1);

        $this->db->where('user_id', $this->session->userdata('id'));

        $data = $this->db->get('posts');

        return $data->result();

    }

    public function unpublishedPosts() {

        $this->db->where('status', 0);

        $this->db->where('user_id', $this->session->userdata('id'));

        $data = $this->db->get('posts');

        return $data->result();

    }

    public function getCoverDetails($id) {

        $this->db->where('post_id', $id);

        $data = $this->db->get('covers');

        return $data->result();

    }

    public function idValidator($id) {

        $this->db->where('user_id', $this->session->userdata('id'));

        $this->db->where('id', $id);

        $data = $this->db->get('posts');

        if ($data -> num_rows() > 0) {

            return true;

        } else {

            return false;

        }


    }

    public function unpublish($id, $data) {

        $this->db->where('id', $id);

        $isSucceed = $this->db->update('posts', $data);

        if ($isSucceed === true) {

            return true;

        } else {

            return false;

        }

    }

    public function publish($id, $data) {

        $this->db->where('id', $id);

        $isSucceed = $this->db->update('posts', $data);

        if ($isSucceed === true) {

            return true;

        } else {

            return false;

        }

    }

    public function editPost($id) {

        $this->db->where('id', $id);

        $query = $this->db->get('posts');

        return $query->result();

    }

    public function updatePost($id, $data) {

        $this->db->where('id', $id);

        $query = $this->db->update('posts', $data);

        return $query;

    }

    public function updateCover($id, $data) {

        $this->db->where('post_id', $id);

        $query = $this->db->update('covers', $data);

        return $query;

    }

}

?>