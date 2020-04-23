<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Profile extends CI_Controller {

        /**
         * Index Page for this controller.
         *
         * Maps to the following URL
         * 		http://example.com/index.php/welcome
         *	- or -
        * 		http://example.com/index.php/welcome/index
        *	- or -
        * Since this controller is set as the default controller in
        * config/routes.php, it's displayed at http://example.com/
        *
        * So any other public methods not prefixed with an underscore will
        * map to /index.php/welcome/<method_name>
        * @see https://codeigniter.com/user_guide/general/urls.html
        */

        public function __construct() {

            parent::__construct();

            $this->load->model('Posts');

            $this->load->library('form_validation');

            // $this->load->library('upload');

            if (!$this->session->userdata('id')) {

                redirect('account/login');

            }

        }

        public function view() {

            $this->load->view('user/layouts/header');
            $this->load->view('user/layouts/navigation');
            $this->load->view('user/layouts/sidemenu');
            $this->load->view('user/profile/view');
            $this->load->view('user/layouts/footer');

        }

        public function update() {

            $this->load->view('user/layouts/header');
            $this->load->view('user/layouts/navigation');
            $this->load->view('user/layouts/sidemenu');
            $this->load->view('user/profile/edit');
            $this->load->view('user/layouts/footer');

        }

    }

?>