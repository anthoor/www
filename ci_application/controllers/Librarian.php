<?php

class Librarian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( 'form' );

		$this->load->library('form_validation');

		$this->load->model('author_model');
		$this->load->model('book_model');
		$this->load->model('copy_model');
		$this->load->model('issue_model');
		$this->load->model('publisher_model');
		$this->load->model('return_model');
		$this->load->model('user_model');
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

			$active = array('home'=>'active', 'books'=>'active', 'stats'=>'active', 'view'=>'active', 'user'=>'active' );
			$data['active'] = $active;
			switch( $page ) {
				case "viewbooks":
					
					switch( $args ) {
						case "available":
							$data['title'] = "View Available Books";
							$data['authors'] = $this->author_model->get_written();
							$data['books'] = $this->book_model->get_books();
							$data['toggle'] = "Available";
							break;
						default:
							$data['title'] = "View All Books";
							$data['authors'] = $this->author_model->get_written();
							$data['books'] = $this->book_model->get_all_books();
							$data['toggle'] = "All";
					}
					break;
				case "viewauthors":
					$data['title'] = "View Authors";
					$data['bauthors'] = $this->author_model->get();
					break;
				case "viewpublishers":
					$data['title'] = "View Publishers";
					$data['publishers'] = $this->publisher_model->get();
					break;
				case "viewissues":	
					switch( $args ) {
						case "pending":
							$data['title'] = "View Pending Issues";
							$data['issues'] = $this->issue_model->get_pending();
							$data['toggle'] = "Pending";
							break;
						default:
							$data['title'] = "View All Issues";
							$data['issues'] = $this->issue_model->get();
							$data['toggle'] = "All";
					}
					break;
				case "addbook":
					$data['title'] = "Add Book";
					$data['publishers'] = $this->publisher_model->get();
					$data['bauthors'] = $this->author_model->get();
					break;
				case "addcopy":
					$data['title'] = "Add Book Copies";
					$data['books'] = $this->book_model->books();
					$data['authors'] = $this->author_model->get_written();
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
					$data['users'] = $this->user_model->get();
					break;
				case "renew":
					$data['title'] = "Renew Book";
					$data['issues'] = $this->issue_model->get_pending();
					break;
				case "return":
					$data['title'] = "Return Book";
					$data['issues'] = $this->issue_model->get_pending();
					break;
				case "adduser":
					$data['title'] = "Add User";
					$data['types'] = $this->user_model->get_types();
					break;
				case "suspenduser":
					$data['title'] = "Suspend User";
					$data['users'] = $this->user_model->get();
					break;
				case "revokesuspension":
					$data['title'] = "Revoke Suspension";
					$data['users'] = $this->user_model->get_suspended();
					break;
				case "removeuser":
					$data['title'] = "Remove User";
					$data['users'] = $this->user_model->get_deletable();
					break;
				case "viewprofile":
					$data['title'] = "Profile";
					$data['profile'] = $this->user_model->profile($session_data['id']);
					break;
				case "editprofile":
					$data['title'] = "Update Profile";
					$data['profile'] = $this->user_model->profile($session_data['id']);
					break;
			}
			
			$this->load->view('templates/lheader', $data);
			$this->load->view("librarian/$page", $data);
			$this->load->view('templates/lfooter', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	public function addauthoraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('fname', 'First Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mname', 'Middle Name', 'trim|xss_clean');
			$this->form_validation->set_rules('lname', 'Last Name', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addauthor");
			} else {
				$fname = $this->input->post('fname');
				$mname = $this->input->post('mname');
				$lname = $this->input->post('lname');
				$this->author_model->add( $fname, $mname, $lname );
				$this->session->set_userdata('message', "Author: <strong>$fname $mname $lname</strong> Successfully Added!");
				redirect( '/librarian/view/addauthor', 'refresh' );
			}
		}
	}

	public function addpublisheraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			$this->form_validation->set_rules('pname', 'Publisher Name', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addpublisher");
			} else {
				$pub = $this->input->post('pname');
				$this->publisher_model->add( $pub );
				$this->session->set_userdata('message', "Publisher: <strong>$pub</strong> Successfully Added!");
				redirect( '/librarian/view/addpublisher', 'refresh' );
			}
		}
	}

	public function addbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

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
				$book = $this->book_model->add( $title, $publisher, $edition, $year );
				foreach( $authors as $author ) {
					$this->author_model->add_written( $book, $author );
				}
				$this->session->set_userdata('message', "Book: <strong>$title</strong> Successfully Added!");
				redirect( '/librarian/view/addbook', 'refresh' );
			}
		}
	}

	public function addcopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('title', 'Book Title', 'trim|required|xss_clean');
			$this->form_validation->set_rules('copies', 'Copies', 'trim|required|xss_clean');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("addcopy");
			} else {
				$title = $this->input->post('title');
				$copies = $this->input->post('copies');
				for( $i=0; $i<$copies; $i++ ) {
					$this->copy_model->add( $title );
				}
				$this->session->set_userdata('message', "<strong>$copies copies</strong> Successfully Added!");
				redirect( '/librarian/view/addcopy', 'refresh' );
			}
		}
	}

	public function damagecopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('copyid', 'Copy ID', 'trim|required|xss_clean|callback_valid_copy');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("damagecopy");
			} else {
				$copies = $this->input->post('copyid');
				$this->copy_model->damage( $copies );
				$this->session->set_userdata('message', "Copy ID: <strong>$copies</strong> Marked as Damaged!");
				redirect( '/librarian/view/damagecopy', 'refresh' );
			}
		}
	}

	public function removecopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('copyid', 'Copy ID', 'trim|required|xss_clean|callback_valid_copy');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("removecopy");
			} else {
				$copies = $this->input->post('copyid');
				$this->copy_model->remove( $copies );
				$this->session->set_userdata('message', "Copy ID: <strong>$copies</strong> Removed!");
				redirect( '/librarian/view/removecopy', 'refresh' );
			}
		}
	}

	public function issuebookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('user', 'User', 'trim|required|xss_clean|callback_user_issueable');
			$this->form_validation->set_rules('copyid', 'Copy ID', 'trim|required|xss_clean|callback_valid_copy');
			
			if($this->form_validation->run() == FALSE) {
				$this->view("issue");
			} else {
				$user = $this->input->post('user');
				$copies = $this->input->post('copyid');
				$this->issue_model->add( $user, $copies );
				$this->copy_model->lease( $copies );
				$this->session->set_userdata('message', "Copy ID: <strong>$copies</strong> Successfully Issued!");
				redirect( '/librarian/view/issue', 'refresh' );
			}
		}
	}

	public function renewbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('issue[]', 'Issues', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("renew");
			} else {
				$issues = $this->input->post('issue[]');
				foreach( $issues as $issue ) {
					$this->issue_model->renew( $issue );
				}
				$this->session->set_userdata('message', "All Selected Issues Successfully Renewed!");
				redirect( '/librarian/view/renew', 'redirect' );
			}
		}
	}

	public function returnbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('issue[]', 'Issues', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("return");
			} else {
				$issues = $this->input->post('issue[]');
				foreach( $issues as $issue ) {
					$this->return_model->add( $issue );
					$this->copy_model->return_copy( $this->issue_model->get_copy($issue) );
				}
				$this->session->set_userdata('message', "All Selected Issues Successfully Returned!");
				redirect( '/librarian/view/return', 'redirect' );
			}
		}
	}

	public function adduseraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('uname', 'User Name', 'trim|required|xss_clean|callback_user_available');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('type', 'User Type', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'E Mail', 'trim|required|xss_clean|callback_mail_available');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("adduser");
			} else {
				$name = $this->input->post('name');
				$uname = $this->input->post('uname');
				$password = $this->input->post('password');
				$type = $this->input->post('type');
				$email = $this->input->post('email');
				$mobile = $this->input->post('mobile');
				$this->user_model->add( $name, $uname, $password, $type, $email, $mobile );
				$this->session->set_userdata('message', "User: <strong>$name</strong> Successfully Added!");
				redirect( '/librarian/view/adduser', 'redirect' );
			}
		}
	}

	public function suspenduseraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('user', 'User', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("suspenduser");
			} else {
				$user = $this->input->post('user');
				$this->user_model->suspend( $user );
				$this->session->set_userdata('message', "User Successfully Suspended!");
				redirect( '/librarian/view/suspenduser', 'redirect' );
			}
		}
	}

	public function revokesuspensionaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('user', 'User', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("revokesuspension");
			} else {
				$user = $this->input->post('user');
				$this->user_model->unsuspend( $user );
				$this->session->set_userdata('message', "Suspension of User Successfully Revoked!");
				redirect( '/librarian/view/revokesuspension', 'redirect' );
			}
		}
	}

	public function removeuseraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('user', 'User', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("removeuser");
			} else {
				$user = $this->input->post('user');
				$this->user_model->delete( $user );
				$this->session->set_userdata('message', "User Successfully Deleted!");
				redirect( '/librarian/view/removeuser', 'redirect' );
			}
		}
	}

	public function editprofileaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$this->form_validation->set_rules('name', 'Full Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'E Mail', 'trim|required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile Number', 'trim|required|xss_clean');
			if($this->form_validation->run() == FALSE) {
				$this->view("editprofile");
			} else {
				$name = $this->input->post('name');
				$mail = $this->input->post('email');
				$phone = $this->input->post('mobile');
				$session_data = $this->session->userdata('logged_in');
				$this->user_model->update( $session_data['id'], $name, $mail, $phone );
				$this->session->set_userdata('message', "User Successfully Updated!");
				redirect( '/librarian/view/editprofile', 'redirect' );
			}
		}
	}

	public function user_issueable( $userid ) {
		if( $this->user_model->pending_issues($userid)<$this->user_model->issue_limit($userid) ) {
			return TRUE;
		}
		$this->form_validation->set_message( 'user_issueable', 'The user already has maximum allowed books in hand' );
		return FALSE;
	}

	public function valid_copy( $copy ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			if( $this->copy_model->valid( $copy ) ) {
				return TRUE;
			}
		}
		$this->form_validation->set_message( 'valid_copy', 'The Copy Doesn\'t Exist' );
		return FALSE;
	}

	public function user_available( $username ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			if( $this->user_model->available( $username ) ) {
				return TRUE;
			}
		}
		$this->form_validation->set_message( 'user_available', 'The Username is already taken' );
		return FALSE;
	}

	public function mail_available( $mail ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			if( $this->user_model->mail_available( $mail ) ) {
				return TRUE;
			}
		}
		$this->form_validation->set_message( 'mail_available', 'The E Mail is already taken' );
		return FALSE;
	}
}