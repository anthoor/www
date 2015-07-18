<?php

class User extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('book_model');
	}

	public function index() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "User Home";
			$active = array();
			$active['home'] = "active";
			$active['view'] = "active";
			$data['active'] = $active;

			$this->load->view('templates/uheader', $data);
			$this->load->view("user/home", $data);
			$this->load->view('templates/ufooter', $data);
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh');
		}
	}

	public function view( $page="viewbooks", $args=array(0=>"all") ) {
		if( !file_exists(APPPATH."/views/librarian/$page.php") ) {
			show_404();
		}
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			switch( $page ) {
//VIEW SECTION
				case "viewbooks":	
					switch( $args ) {
						case "available":
							$data['title'] = "View Available Books";
							$data['authors'] = $this->book_model->get_authors();
							$data['books'] = $this->book_model->get_books();
							$data['toggle'] = "Available";
							break;
						default:
							$data['title'] = "View All Books";
							$data['authors'] = $this->book_model->get_authors();
							$data['books'] = $this->book_model->get_all_books();
							$data['toggle'] = "All";
					}
					break;
				case "viewauthors":
					$data['title'] = "View Authors";
					$data['bauthors'] = $this->book_model->authors();
					break;
				case "viewpublishers":
					$data['title'] = "View Publishers";
					$data['publishers'] = $this->book_model->publishers();
					break;
				case "viewissues":	
					switch( $args ) {
						case "pending":
							$data['title'] = "View Pending Issues";
							$data['issues'] = $this->book_model->pending_issues();
							$data['toggle'] = "Pending";
							break;
						default:
							$data['title'] = "View All Issues";
							$data['issues'] = $this->book_model->issues();
							$data['toggle'] = "All";
					}
					break;
			}
			$active = array();
			$active['home'] = "active";
			$active['view'] = "active";
			$data['active'] = $active;
			$this->load->view('templates/uheader', $data);
			$this->load->view("user/$page", $data);
			$this->load->view('templates/ufooter', $data);
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}
}