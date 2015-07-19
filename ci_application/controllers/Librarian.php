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
					$data['books'] = $this->book_model->books();
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

	public function addauthoraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('fname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mname', 'Middle Name', 'trim|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addauthor");
			} else {
				$fname = $this->input->post('fname');
				$mname = $this->input->post('mname');
				$lname = $this->input->post('lname');
				$inputs = array( 'first_name'=>$fname, 'middle_name'=>$mname, 'last_name'=>$lname );
				$this->db->insert('author', $inputs);
				$this->session->set_userdata('message', "Author: <strong>$fname $mname $lname</strong> Successfully Added!");
				redirect( '/librarian/view/addauthor', 'refresh' );
			}
		}
	}

	public function addpublisheraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('pname', 'Publisher Name', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addpublisher");
			} else {
				$pub = $this->input->post('pname');
				$this->db->insert( 'publisher', array('name'=> $pub) );
				$this->session->set_userdata('message', "Publisher: <strong>$pub</strong> Successfully Added!");
				redirect( '/librarian/view/addpublisher', 'refresh' );
			}
		}
	}

	public function addbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Book Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('authors[]', 'Authors', 'trim|required|xss_clean');
			$this->form_validation->set_rules('edition', 'Edition', 'trim|required|xss_clean');
			$this->form_validation->set_rules('year', 'Year of Publication', 'trim|required|xss_clean');
			$this->form_validation->set_rules('publisher', 'Publisher', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addbook");
			} else {
				$title = $this->input->post('title');
				$authors = $this->input->post('authors[]');
				$edition = $this->input->post('edition');
				$year = $this->input->post('year');
				$publisher = $this->input->post('publisher');
				$inputs = array( 'title'=>$title, 'publisher'=>$publisher, 'edition'=>$edition, 'year'=>$year );
				$this->db->insert('book', $inputs);
				$book_id = $this->db->insert_id();
				foreach( $authors as $author ) {
					$this->db->insert( 'written', array('book_id'=>$book_id, 'author_id'=>$author) );
				}
				$this->session->set_userdata('message', "Book: <strong>$title</strong> Successfully Added!");
				redirect( '/librarian/view/addbook', 'refresh' );
			}
		}
	}
	public function addcopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('title', 'Book Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('copies', 'Copies', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addcopy");
			} else {
				$title = $this->input->post('title');
				$copies = $this->input->post('copies');
				$inputs = array( 'book_id'=>$title, 'status'=>'A' );
				for( $i=0; $i<$copies; $i++ ) {
					$this->db->insert('copy', $inputs);
				}
				$this->session->set_userdata('message', "<strong>$copies copies</strong> Successfully Added!");
				redirect( '/librarian/view/addcopy', 'refresh' );
			}
		}
	}

	public function damagecopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('copyid', 'Copy ID', 'trim|required|xss_clean|callback_valid_copy');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("damagecopy");
			} else {
				$copies = $this->input->post('copyid');
				$this->db->where('id',$copies);
				$inputs = array( 'status'=>'D' );
				$this->db->update('copy', $inputs);
				$this->session->set_userdata('message', "Copy ID: <strong>$copies</strong> Marked as Damaged!");
				redirect( '/librarian/view/damagecopy', 'refresh' );
			}
		}
	}

	public function valid_copy( $copy ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			$this->db->where('id',$copy);
			$this->db->from('copy');
			$this->db->select('book_id');
			$query = $this->db->get();
			if( $query->num_rows() == 1 ) {
				return TRUE;
			}
		}
		$this->form_validation->set_message( 'valid_copy', 'The Copy Doesn\'t Exist' );
		return FALSE;
	}

	public function removecopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->load->library('form_validation');

			$this->form_validation->set_rules('copyid', 'Copy ID', 'trim|required|xss_clean|callback_valid_copy');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("removecopy");
			} else {
				$copies = $this->input->post('copyid');
				$this->db->where('id',$copies);
				$inputs = array( 'status'=>'R' );
				$this->db->update('copy', $inputs);
				$this->session->set_userdata('message', "Copy ID: <strong>$copies</strong> Removed!");
				redirect( '/librarian/view/removecopy', 'refresh' );
			}
		}
	}
}