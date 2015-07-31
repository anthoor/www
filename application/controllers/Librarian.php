<?php

class Librarian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper( 'form' );

		$this->load->library('form_validation');

		$this->load->model('author_model');
		$this->load->model('book_model');
		$this->load->model('copy_model');
		$this->load->model('fine_model');
		$this->load->model('issue_model');
		$this->load->model('publisher_model');
		$this->load->model('return_model');
		$this->load->model('suggestion_model');
		$this->load->model('user_model');
	}

	public function index() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );
			$data['title'] = "Librarian Home";

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

			switch( $page ) {
				case "viewbooks":
					$data['authors'] = $this->author_model->get_written();
					switch( $args ) {
						case "available":
							$data['title'] = "View Available Books";
							$data['books'] = $this->book_model->get_books();
							$data['toggle'] = "Available";
							break;
						default:
							$data['title'] = "View All Books";
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
					$data['issues'] = $this->issue_model->get_pending_renew();
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
				case "changepassword":
					$data['title'] = "Change Password";
					$data['profile'] = $this->user_model->profile($session_data['id']);
					break;
				case "viewsuggestions":
					$data['title'] = "View Suggestions";
					$data['suggestions'] = $this->suggestion_model->get();
					break;
				default:
					$this->index();
			}
			
			$this->load->view('templates/lheader', $data);
			$this->load->view("librarian/$page", $data);
			$this->load->view('templates/lfooter', $data);
		}  else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function addauthoraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('addauthor') == FALSE) {
				$this->view("addauthor");
			} else {
				$fname = $this->input->post('fname');
				$mname = $this->input->post('mname');
				$lname = $this->input->post('lname');
				$this->author_model->add( $fname, $mname, $lname );
				$this->session->set_userdata('message', "Author <strong>$fname $mname $lname</strong> Successfully Added!");
				redirect( '/librarian/view/addauthor', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function addpublisheraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('addpublisher') == FALSE) {
				$this->view("addpublisher");
			} else {
				$pub = $this->input->post('pname');
				$this->publisher_model->add( $pub );
				$this->session->set_userdata('message', "Publisher <strong>$pub</strong> Successfully Added!");
				redirect( '/librarian/view/addpublisher', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function addbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('addbook') == FALSE) {
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
				$this->session->set_userdata('message', "Book <strong>$title</strong> Successfully Added!");
				redirect( '/librarian/view/addbook', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function addcopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('addcopy') == FALSE) {
				$this->view("addcopy");
			} else {
				$title = $this->input->post('title');
				$copies = $this->input->post('copies');
				$shelf = $this->input->post('shelf');
				$row = $this->input->post('row');
				for( $i=0; $i<$copies; $i++ ) {
					$this->copy_model->add( $title, $shelf, $row );
				}
				$this->session->set_userdata('message', "<strong>$copies copies</strong> Successfully Added!");
				redirect( '/librarian/view/addcopy', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function damagecopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('damagecopy') == FALSE) {
				$this->view("damagecopy");
			} else {
				$copies = $this->input->post('copyid');
				$this->copy_model->damage( $copies );
				$this->session->set_userdata('message', "Copy ID <strong>$copies</strong> Marked as Damaged!");
				redirect( '/librarian/view/damagecopy', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function removecopyaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('removecopy') == FALSE) {
				$this->view("removecopy");
			} else {
				$copies = $this->input->post('copyid');
				$this->copy_model->remove( $copies );
				$this->session->set_userdata('message', "Copy ID <strong>$copies</strong> Removed!");
				redirect( '/librarian/view/removecopy', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function issuebookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			
			if($this->form_validation->run('issuebook') == FALSE) {
				$this->view("issue");
			} else {
				$user = $this->input->post('user');
				$copies = $this->input->post('copyid');
				$this->issue_model->add( $user, $copies );
				$this->copy_model->lease( $copies );
				$this->session->set_userdata('message', "Copy ID <strong>$copies</strong> Successfully Issued!");
				redirect( '/librarian/view/issue', 'refresh' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function renewbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('renewbook') == FALSE) {
				$this->view("renew");
			} else {
				$issues = $this->input->post('issue[]');
				foreach( $issues as $issue ) {
					$this->issue_model->renew( $issue );
				}
				$this->session->set_userdata('message', "All Selected Issues Successfully Renewed!");
				redirect( '/librarian/view/renew', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function returnbookaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('returnbook') == FALSE) {
				$this->view("return");
			} else {
				$issues = $this->input->post('issue[]');
				$message = "All Selected Issues Successfully Returned!<br>";
				foreach( $issues as $issue ) {
					$this->return_model->add( $issue );
					$copy = $this->issue_model->get_copy($issue);
					$this->copy_model->return_copy( $copy );
					$fine = $this->fine_model->get_fine($this->issue_model->get_user($issue), $issue);
					$this->fine_model->add( $issue, $fine );
					$message .= "Collect Rs. $fine for Book Copy $copy <br>";
				}

				$this->session->set_userdata('message', $message);
				redirect( '/librarian/view/return', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function adduseraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('adduser') == FALSE) {
				$this->view("adduser");
			} else {
				$name = $this->input->post('name');
				$uname = $this->input->post('uname');
				$password = $this->input->post('password');
				$type = $this->input->post('type');
				$email = $this->input->post('email');
				$mobile = $this->input->post('mobile');
				$this->user_model->add( $name, $uname, $password, $type, $email, $mobile, "ci.png" );
				$this->session->set_userdata('message', "User <strong>$name</strong> Successfully Added!");
				redirect( '/librarian/view/adduser', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function suspenduseraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('suspenduser') == FALSE) {
				$this->view("suspenduser");
			} else {
				$user = $this->input->post('user');
				$this->user_model->suspend( $user );
				$this->session->set_userdata('message', "User Successfully Suspended!");
				redirect( '/librarian/view/suspenduser', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function revokesuspensionaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('revokesuspension') == FALSE) {
				$this->view("revokesuspension");
			} else {
				$user = $this->input->post('user');
				$this->user_model->unsuspend( $user );
				$this->session->set_userdata('message', "Suspension of User Successfully Revoked!");
				redirect( '/librarian/view/revokesuspension', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function removeuseraction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('removeuser') == FALSE) {
				$this->view("removeuser");
			} else {
				$user = $this->input->post('user');
				$this->user_model->delete( $user );
				$this->session->set_userdata('message', "User Successfully Deleted!");
				redirect( '/librarian/view/removeuser', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function editprofileaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			$session_data = $this->session->userdata('logged_in');

			$imgname = hash( "sha512", $session_data['id'], FALSE );

			$config['upload_path'] = './uploads/';
			$config['file_name'] = $imgname;
            $config['allowed_types'] = 'png|gif|jpg';
            $config['max_size'] = 300;
            $config['max_width'] = 1024;
            $config['max_height'] = 768;
            $config['overwrite'] = TRUE;
            $config['file_ext_tolower'] = TRUE;

            $this->load->library('upload', $config);

			if($this->form_validation->run('editprofile') == FALSE) {
				$this->view("editprofile");
			} else {
				$name = $this->input->post('name');
				$mail = $this->input->post('email');
				$phone = $this->input->post('mobile');
				
				$this->user_model->update( $session_data['id'], $name, $mail, $phone );

				if ( !$this->upload->do_upload("dp") && $_FILES['dp']['name'] != null ) {
					$this->session->set_userdata('message', $this->upload->display_errors());
				} else {
					if($_FILES['dp']['name'] != null) {
						$ext = $this->upload->data('file_ext');
						$this->user_model->set_dp( $session_data['id'], $imgname.$ext );
					}
					$this->session->set_userdata('message', "User Successfully Updated!");
				}
				redirect( '/librarian/view/editprofile', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function changepasswordaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {

			if($this->form_validation->run('changepassword') == FALSE) {
				$this->view("changepassword");
			} else {
				$password = $this->input->post('npassword');
				$session_data = $this->session->userdata('logged_in');
				$this->user_model->update_password( $session_data['id'], $password );
				$this->session->set_userdata('message', "Password Successfully Updated!");
				redirect( '/librarian/view/changepassword', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/user', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function user_issueable( $userid ) {
		if( $this->user_model->pending_issues($userid)<$this->user_model->issue_limit($userid) ) {
			return TRUE;
		}
		$this->form_validation->set_message( 'user_issueable', 'The user already has maximum allowed books in hand' );
		return FALSE;
	}

	function valid_copy( $copy ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			if( $this->copy_model->valid( $copy ) ) {
				return TRUE;
			}
		}
		$this->form_validation->set_message( 'valid_copy', 'Invalid Copy ID' );
		return FALSE;
	}

	function is_renewable( $issue ) {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] == '10001' ) {
			if( $this->issue_model->is_renewable( $issue ) ) {
				return TRUE;
			}
		}
		$this->form_validation->set_message( 'is_renewable', 'The issue cannot be renewed' );
		return FALSE;
	}

	function password_confirm( $password ) {
		$session_data = $this->session->userdata('logged_in');
		if( $this->user_model->password_confirm($session_data['id'], $password) ){
			return TRUE;
		}
		$this->form_validation->set_message( 'password_confirm', 'The Current Password is wrong' );
		return FALSE;
	}

	function is_not_self( $userid ) {
		$session_data = $this->session->userdata('logged_in');
		if( $session_data['id'] != $userid ) {
			return TRUE;
		}
		$this->form_validation->set_message( 'is_not_self', 'Cannot modify current user' );
		return FALSE;
	}

	function email_check( $email ) {
		$session_data = $this->session->userdata('logged_in');
		if( $this->user_model->email_confirm($session_data['id'], $email) ){
			return TRUE;
		}
		$this->form_validation->set_message( 'email_check', 'E Mail already in use' );
		return FALSE;
	}
}