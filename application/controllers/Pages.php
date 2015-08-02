<?php
class Pages extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->library('parser');
	}

	function view( $page = 'home' ) {

		if( !file_exists(APPPATH."/views/pages/$page.php") ) {
			show_404();
		}

		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {
			redirect( '/user', 'refresh' );
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			$data['title'] = ucfirst($page);
			$active = array('home'=>'', 'login'=>'', 'view'=>'', 'suggestion'=>'');
			switch($page) {
				default:
					$active['home'] = 'active';
					break;
			}
			$data['active'] = $active;

			$this->load->view('templates/header', $data);
			$this->load->view("pages/$page", $data);
			$this->load->view('templates/footer', $data);
		}
	}
}