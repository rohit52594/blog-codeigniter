<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

     public function logout() {

        $data = $this->session->all_userdata();

        foreach ($data as $key => $value) {

            $this->session->unset_userdata($key);

        }

        redirect('account/login');

	 }
	 
	 public function dashboard() {

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/navigation');
		$this->load->view('user/layouts/sidemenu');
		$this->load->view('user/index');
		$this->load->view('user/layouts/footer');

	 }

	 public function posts($page) {

		$categories = $this->Posts->getCategories();

		$data['CATEGORIES'] = null;

		if($categories) {

			$data['CATEGORIES'] =  $categories;

		}

		$publishedPosts = $this->Posts->publishedPosts();

		$data['PUBLISHED_POSTS'] = [];

		if ($publishedPosts) {

			$data['PUBLISHED_POSTS'] =  $publishedPosts;

		}

		$unpublishedPosts = $this->Posts->unpublishedPosts();

		$data['UNPUBLISHED_POSTS'] = [];

		if ($unpublishedPosts) {

			$data['UNPUBLISHED_POSTS'] =  $unpublishedPosts;

		}

		if ($page == 'edit-post') {

			$id = $this->uri->segment(4);

			$validator = $this->Posts->idValidator($id);

			if ($validator == true) {
				
				$categories = $this->Posts->getCategories();

				$data['CATEGORIES'] = null;
		
				if($categories) {
		
					$data['CATEGORIES'] =  $categories;
		
				}
		
				$publishedPosts = $this->Posts->publishedPosts();
				
				$data['POST_DETAILS'] = $this->Posts->editPost($id);

				$data['COVER_DETAILS'] = $this->Posts->getCoverDetails($id);

			} else {

				$this->session->set_flashdata('error', 'Access denied');

				redirect('user/posts/published-posts');

			}

		}

		$this->load->view('user/layouts/header');
		$this->load->view('user/layouts/navigation');
		$this->load->view('user/layouts/sidemenu');
		$this->load->view('user/posts/'.$page, $data);
		$this->load->view('user/layouts/footer');

	 }

	 public function newPost() {

		$this->form_validation->set_rules('title', 'Title', 'required|trim');

		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run()) {

			$config['upload_path'] = './upload/';

			$config['allowed_types'] = 'gif|jpg|png';

			$config['max_size'] = 2000;

			$config['max_width'] = 1500;

			$config['max_height'] = 1500;

			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('coverImage')) {
			
				$error = array('error' => $this->upload->display_errors());

				redirect('user/posts/new-post');
			
			} 
			
			else {
			
				$image_metadata = $this->upload->data();

				$postData = [

					'title' => $this->input->post('title'),

					'user_id' => $this->session->userdata('id'),

					'description' => $this->input->post('description'),

					'category' => $this->input->post('category'),

					'added_date' => date('Y-m-d'),

					'added_time' => date('H:i:s'),

					'remote_address' => $_SERVER['REMOTE_ADDR']

				];

				$isPostInserted = $this->Posts->insertPost($postData);

				if ($isPostInserted != '') {

					$imageData = [

						'post_id' => $isPostInserted,

						'user_id' => $this->session->userdata('id'),

						'file_name' => $image_metadata['file_name'],

						'file_type' => $image_metadata['file_type'],

						'file_path' => $image_metadata['file_path'],

						'full_path' => $image_metadata['full_path'],

						'raw_name' => $image_metadata['raw_name'],

						'orig_name' => $image_metadata['orig_name'],

						'client_name' => $image_metadata['client_name'],

						'file_ext' => $image_metadata['file_ext'],

						'file_size' => $image_metadata['file_size'],

						'is_image' => $image_metadata['is_image'],

						'image_width' => $image_metadata['image_width'],

						'image_height' => $image_metadata['image_height'],

						'image_type' => $image_metadata['image_type'],

						'added_date' => date('Y-m-d'),

						'added_time' => date('H:i:s')

					];

					$isSucceed = $this->Posts->insertCover($imageData);

					if ($isSucceed != '') {

						$this->session->set_flashdata('success', 'Success! Your post has been published.');

						redirect('user/posts/new-post');

					} else {

						$this->session->set_flashdata('error', 'Something went wrong, please try again later');

						redirect('user/posts/new-post');

					}

				} else {

					$this->session->set_flashdata('error', 'Something went wrong, please try again later');

					redirect('user/posts/new-post');

				}

			}

		} else {

			$this->posts('new-post');

		}

	 }

	 public function unpublish($id) {

		$validator = $this->Posts->idValidator($id);

		if ($validator == true) {

			$status = [

				'status' => 0

			];

			$isUnpublished = $this->Posts->unpublish($id, $status);

			if ($isUnpublished == true) {

				$this->session->set_flashdata('success', 'Post unpublished!');

				redirect('user/posts/published-posts');

			} else {

				$this->session->set_flashdata('error', 'Something went wrong, please try again');

				redirect('user/posts/published-posts');

			}

		} else {

			$this->session->set_flashdata('error', 'Access denied');

			redirect('user/posts/published-posts');

		}

	 }

	 public function publish($id) {

		$validator = $this->Posts->idValidator($id);

		if ($validator == true) {

			$status = [

				'status' => 1

			];

			$isPublished = $this->Posts->publish($id, $status);

			if ($isPublished == true) {

				$this->session->set_flashdata('success', 'Post published!');

				redirect('user/posts/unpublished-posts');

			} else {

				$this->session->set_flashdata('error', 'Something went wrong, please try again');

				redirect('user/posts/unpublished-posts');

			}

		} else {

			$this->session->set_flashdata('error', 'Access denied');

			redirect('user/posts/unpublished-posts');

		}

	 }

	 public function updatePost() {

		$id = $this->input->post('thisId');

		$this->form_validation->set_rules('title', 'Title', 'required|trim');

		$this->form_validation->set_rules('description', 'Description', 'required|trim');

		$this->form_validation->set_rules('category', 'Category', 'required');

		if ($this->form_validation->run()) {

			$postData = [

				'title' => $this->input->post('title'),

				'user_id' => $this->session->userdata('id'),

				'description' => $this->input->post('description'),

				'category' => $this->input->post('category'),

				'updated_date' => date('Y-m-d'),

				'updated_time' => date('H:i:s'),

				'last_update_remote' => $_SERVER['REMOTE_ADDR']

			];

			$isPostUpdated = $this->Posts->updatePost($id, $postData);

			if (isset($_FILES['coverImage']) && is_uploaded_file($_FILES['coverImage']['tmp_name'])) {

				$config['upload_path'] = './upload/';

				$config['allowed_types'] = 'gif|jpg|png';

				$config['max_size'] = 2000;

				$config['max_width'] = 1500;

				$config['max_height'] = 1500;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('coverImage')) {
				
					$error = array('error' => $this->upload->display_errors());

					redirect('user/posts/edit-post/' . $id);
				
				} else {
			
					$image_metadata = $this->upload->data();

					$imageData = [

						'file_name' => $image_metadata['file_name'],

						'file_type' => $image_metadata['file_type'],

						'file_path' => $image_metadata['file_path'],

						'full_path' => $image_metadata['full_path'],

						'raw_name' => $image_metadata['raw_name'],

						'orig_name' => $image_metadata['orig_name'],

						'client_name' => $image_metadata['client_name'],

						'file_ext' => $image_metadata['file_ext'],

						'file_size' => $image_metadata['file_size'],

						'is_image' => $image_metadata['is_image'],

						'image_width' => $image_metadata['image_width'],

						'image_height' => $image_metadata['image_height'],

						'image_type' => $image_metadata['image_type'],

						'added_date' => date('Y-m-d'),

						'added_time' => date('H:i:s')

					];

					$this->Posts->updateCover($id, $imageData);

				}

			}

			if ($isPostUpdated != '') {

				$this->session->set_flashdata('success', 'Changes made.');

				redirect('user/posts/published-posts');

			} else {

				$this->session->set_flashdata('error', 'Something went wrong, please try again later');

				redirect('user/posts/edit-post/' . $id);

			}

		} else {

			redirect('user/post/edit-post/' . $id);

		}

	}

}
?>