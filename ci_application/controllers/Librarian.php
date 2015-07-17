<?php

class Librarian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function index() {
		if( $this->session->userdata('logged_in') ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "Librarian Home";
			$active = array();
			$active['home'] = "active";
			$active['books'] = "";
			$active['stats'] = "";
			$data['active'] = $active;

			$this->load->view('templates/uheader', $data);
			$this->load->view("librarian/index", $data);
			$this->load->view('templates/footer', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	public function view( $page ) {
		if( !file_exists(APPPATH."/views/librarian/$page.php") ) {
			show_404();
		}
		if( $this->session->userdata('logged_in') ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "Librarian::Add Book";
			$active = array();
			$active['home'] = "";
			$active['books'] = "active";
			$active['stats'] = "";
			$data['active'] = $active;

			$this->load->view('templates/uheader', $data);
			$this->load->view("librarian/$page", $data);
			$this->load->view('templates/footer', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}
}