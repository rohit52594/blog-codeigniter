<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

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

		$this->load->library('form_validation');
		$this->load->library('encryption');
		$this->load->model('account_model');
	 }

	public function login()
	{
		$this->load->view('front-end/layouts/header');
		$this->load->view('front-end/layouts/menu');
		$this->load->view('front-end/login');
		$this->load->view('front-end/layouts/footer');
    }
    
    public function register()
	{
		$this->load->view('front-end/layouts/header');
		$this->load->view('front-end/layouts/menu');
		$this->load->view('front-end/register');
		$this->load->view('front-end/layouts/footer');
	}

	public function registerer() {

		$this->form_validation->set_rules('user_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run()) {

			$verificationKey = md5(rand());

			$encryptedPassword = $this->encryption->encrypt($this->input->post('password'));

			$data = [

				'name' => $this->input->post('user_name'),

				'email' => $this->input->post('email'),

				'password' => $encryptedPassword,

				'verification_key' => $verificationKey,

				'joined_date' => date('Y-m-d'),

				'joined_time' => date('H:i:s')

			];

			$id = $this->account_model->insert($data);

			if ($id > 0) {

				$subject = "Please verify your email for login";

				$message = "<p>Hi, " . $this->input->post('user_name') . ", </p>
					<p>This is an email verification message from Blog, Please verify your email for complete registraion process and login into system. Click <a href = '" . base_url() . "'account/verification/" . $verificationKey . "> here</a> to verify your email.</p>
					<p>Once you click this link, your email will be verified and you can log into system.</p>
					<p>Thank you</p>";

				$from = "rohitsahu728@gmail.com";

				$to = $this->input->post('email');

				$subject = "Email verification on Blog";

				$headers = "From: " . $from;

				mail($to, $subject, $message, $headers);

				$this->session->set_flashdata('message', 'Registration success! Please check your<br /> email for verification email');

				redirect('account/register');

			}

		} else {

			$this->register();

		}

	}

	public function verification() {

		if ($this->uri->segment(3)) {

			$verificationKey = $this->uri->segment(3);

			if ($this->account_model->verification($verificationKey)) {

				$data['message'] = 'Email verified';

			} else {

				$data['message'] = 'Invalid link';

			}

		}

	}

	public function processLogin() {

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		// $password = $this->encryption->encrypt($this->input->post('password'));

		if ($this->form_validation->run()) {

			$result = $this->account_model->checkLogin($this->input->post('email'), $this->input->post('password'));

			if ($result == '') {

				redirect('user/dashboard');

			} else {

				$this->session->set_flashdata('message', $result);

				redirect('account/login');

			}

		} else {

			$this->login();

		}
	}

}
