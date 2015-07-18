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
			$active = array('home'=>'active', 'books'=>'active', 'stats'=>'active', 'view'=>'active', 'user'=>'active' );
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

			$active['home'] = "active";
			$active['books'] = "active";
			$active['stats'] = "active";
			$active['view'] = "active";
			$active['user'] = "active";
			$data['active'] = $active;
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

//OPERATION SECTION
				case "addbook":
					$data['title'] = "Add Book";
					$data['publishers'] = $this->book_model->publishers();
					$data['bauthors'] = $this->book_model->authors();
					break;
				case "addcopy":
					$data['title'] = "Add Book Copies";
					$data['books'] = $this->book_model->get_all_books();
					$data['authors'] = $this->book_model->get_authors();
					break;
				case "addauthor":
					$data['title'] = "Add Author";
					break;
				case "addpublisher":
					$data['title'] = "Add Publisher";
					break;
				case "damagecopy":
					$data['title'] = "Report Damaged Copy";
					break;
				case "removecopy":
					$data['title'] = "Remove Copies";
					break;
				case "issue":
					$data['title'] = "Issue Book";
					$data['users'] = $this->user_model->users();
					break;
				case "renew":
					$data['title'] = "Renew Book";
					$data['issues'] = $this->book_model->pending_issues();
					break;
				case "return":
					$data['title'] = "Return Book";
					$data['issues'] = $this->book_model->pending_issues();
					break;
				case "adduser":
					$data['title'] = "Add User";
					$data['types'] = $this->user_model->types();
					break;
				case "suspenduser":
					$data['title'] = "Suspend User";
					$data['users'] = $this->user_model->users();
					break;
				case "revokesuspension":
					$data['title'] = "Revoke Suspension";
					$data['users'] = $this->user_model->suspended_users();
					break;
				case "removeuser":
					$data['title'] = "Remove User";
					$data['users'] = $this->user_model->deletable_users();
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