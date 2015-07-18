<?php

class Librarian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('book_model');
		$this->load->helper( 'form' );
	}

	public function index() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "Librarian Home";
			$active = array();
			$active['home'] = "active";
			$active['books'] = "";
			$active['stats'] = "";
			$active['view'] = "";
			$active['user'] = "";
			$data['active'] = $active;

			$this->load->view('templates/lheader', $data);
			$this->load->view("librarian/index", $data);
			$this->load->view('templates/lfooter', $data);
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	public function view( $page="viewbooks", $args=array(0=>"all") ) {
		if( !file_exists(APPPATH."/views/librarian/$page.php") ) {
			show_404();
		}
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$active['home'] = "";
			$active['books'] = "";
			$active['stats'] = "";
			$active['view'] = "";
			$active['user'] = "";
			switch( $page ) {
//VIEW SECTION
				case "viewbooks":	
					$active['view'] = "active";
					
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
					$active['view'] = "active";
					$data['active'] = $active;
					$data['bauthors'] = $this->book_model->authors();
					break;
				case "viewpublishers":
					$data['title'] = "View Publishers";
					$active['view'] = "active";
					$data['active'] = $active;
					$data['publishers'] = $this->book_model->publishers();
					break;
				case "viewissues":	
					$active['view'] = "active";
					$data['active'] = $active;
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

//OPERATION SECTION
				case "addbook":
					$data['title'] = "Add Book Copies";
					$active['books'] = "active";
					$data['active'] = $active;
					$data['publishers'] = $this->book_model->publishers();
					$data['bauthors'] = $this->book_model->authors();
					break;
				case "addcopy":
					$data['title'] = "Add Book Copies";
					$active['books'] = "active";
					$data['active'] = $active;
					$data['books'] = $this->book_model->get_all_books();
					$data['authors'] = $this->book_model->get_authors();
					break;
				case "addauthor":
					$data['title'] = "Add Author";
					$active['books'] = "active";
					$data['active'] = $active;
					break;
				case "addpublisher":
					$data['title'] = "Add Publisher";
					$active['books'] = "active";
					$data['active'] = $active;
					break;
				case "damagecopy":
					$data['title'] = "Report Damaged Copy";
					$active['books'] = "active";
					$data['active'] = $active;
					break;
				case "removecopy":
					$data['title'] = "Remove Copies";
					$active['books'] = "active";
					$data['active'] = $active;
					break;
				case "issue":
					$data['title'] = "Issue Book";
					$active['stats'] = "active";
					$data['active'] = $active;
					$data['users'] = $this->user_model->users();
					break;
				case "renew":
					$data['title'] = "Renew Book";
					$active['stats'] = "active";
					$data['active'] = $active;
					$data['books'] = $this->book_model->get_books();
					break;
				case "return":
					$data['title'] = "Return Book";
					$active['stats'] = "active";
					$data['books'] = $this->book_model->get_books();
					break;
			}
			$data['active'] = $active;
			$this->load->view('templates/lheader', $data);
			$this->load->view("librarian/$page", $data);
			$this->load->view('templates/lfooter', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}
}