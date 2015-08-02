<?php
class Pages extends CI_Controller {

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

			$this->parser->parse('templates/header', $data);
			$this->parser->parse("pages/$page", $data);
			$this->parser->parse('templates/footer', $data);
		}
	}
}