<?php

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		if( $this->session->userdata('logged_in') ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "User Home";
			$active = array();
			$active['home'] = "active";
			$active['books'] = "";
			$active['stats'] = "";
			$active['view'] = "";
			$data['active'] = $active;

			$this->load->view('templates/uheader', $data);
			$this->load->view("user/home", $data);
			$this->load->view('templates/footer', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}
}