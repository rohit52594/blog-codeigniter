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

            $this->load->model('Profile_model');

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

        // public function update() {

        //     $this->load->view('user/layouts/header');
        //     $this->load->view('user/layouts/navigation');
        //     $this->load->view('user/layouts/sidemenu');
        //     $this->load->view('user/profile/edit');
        //     $this->load->view('user/layouts/footer');

        // }

        public function updateDp() {

            $config['upload_path'] = './assets/user-image/';

			$config['allowed_types'] = 'gif|jpg|png';

			$config['max_size'] = 2000;

			$config['max_width'] = 1500;

			$config['max_height'] = 1500;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('profileImage')) {
                
                $this->session->set_flashdata('danger', $this->upload->display_errors());

				redirect('profile/view');
			
			} else {

                $image_metadata = $this->upload->data();

                $imageData = [

                    'profile_image' => $image_metadata['file_name']

                ];

                if ($this->Profile_model->updateDp($imageData))

                    $this->session->set_flashdata('success', "Profile picture updated");

                else

                    $this->session->set_flashdata('danger', "Profile picture updation failed");

                redirect('profile/view');

            }

        }

        public function updateProfile() {

            
        }

    }

?>