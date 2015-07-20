<?php

class Login extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$data['head'] = '<div class="form-group has-error resize">';
		$data['tail'] = '</div>';
	}

	public function index( ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			redirect( '/librarian', 'refresh' );
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			$data['title'] = "Login";
			$active = array();
			$active['home'] = "";
			$active['login'] = "active";
			$active['view'] = "";
			$data['active'] = $active;
			$data['head'] = '<div class="form-group has-error resize">';
			$data['tail'] = '</div>';

			$this->load->helper( array('form') );
			$this->load->view('templates/header', $data);
			$this->load->view("pages/login", $data);
			$this->load->view('templates/footer', $data);
		}
	}

	public function view( ) {
		$data['title'] = "Login";
		$active = array();
		$active['home'] = "";
		$active['login'] = "active";
		$active['view'] = "";
		$data['active'] = $active;
		$data['head'] = '<div class="form-group has-error resize">';
		$data['tail'] = '</div>';

		$this->load->helper( array('form') );
		$this->load->view('templates/header', $data);
		$this->load->view("pages/login", $data);
		$this->load->view('templates/footer', $data);
	}

	public function verifylogin() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|max_length[50]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
		
		if($this->form_validation->run() == FALSE) {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			$data['title'] = "Login";
			$active = array();
			$active['home'] = "";
			$active['login'] = "active";
			$active['view'] = "";
			$data['active'] = $active;
			$data['head'] = '<div class="has-error help-block">';
			$data['tail'] = '</div>';

			$this->load->helper( array('form') );
			$this->load->view('templates/header', $data);
			$this->load->view("pages/login", $data);
			$this->load->view('templates/footer', $data);
		} else {
			if( $this->session->userdata('logged_in')['type'] != '10001' )
				redirect( '/user', 'refresh' );
			else
				redirect( '/librarian', 'refresh' );
		}
	}

	public function check_database($password) {
		$username = $this->input->post('username');

		$result = $this->user_model->login( $username, $password );
		if($result) {
			$sess_array = array();
			foreach($result as $row) {
				$sess_array = array( 'id'=>$row->id, 'type'=>$row->type_id );
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		} else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
			return FALSE;
		}
	}

	public function logout() {
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('/login', 'refresh');
	}
}