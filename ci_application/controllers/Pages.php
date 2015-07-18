<?php
class Pages extends CI_Controller {

	public function view( $page = 'home', $args=array() ) {

		if( !file_exists(APPPATH."/views/pages/$page.php") ) {
			show_404();
		}

		if( $this->session->userdata('logged_in')['type'] != '10001' ) {
			redirect( '/user', 'refresh' );
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			$data['title'] = ucfirst($page);
			$data['args'] = $args;
			$active = array();
			$active['home'] = "active";
			$active['login'] = "";
			$active['view'] = "";
			$data['active'] = $active;

			$this->load->view('templates/header', $data);
			$this->load->view("pages/home", $data);
			$this->load->view('templates/footer', $data);
		}
	}
}