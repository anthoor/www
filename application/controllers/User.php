<?php

class User extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('suggestion_model');
		$this->load->model('publisher_model');
		$this->load->model('issue_model');
		$this->load->model('book_model');
		$this->load->model('author_model');

		$this->load->helper('form');

		$this->load->library('form_validation');
		$this->load->library('parser');
	}

	function index() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "User Home";

			$this->parser->parse('templates/uheader', $data);
			$this->parser->parse("user/home", $data);
			$this->parser->parse('templates/ufooter', $data);
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh');
		}
	}

	function view( $page="viewbooks", $args=array(0=>"all") ) {
		if( !file_exists(APPPATH."/views/user/$page.php") ) {
			show_404();
		}
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

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
							$data['issues'] = $this->issue_model->get_pending( $session_data['id'] );
							$data['toggle'] = "Pending";
							break;
						default:
							$data['title'] = "View All Issues";
							error_log($session_data['id']);
							$data['issues'] = $this->issue_model->get( $session_data['id'] );
							$data['toggle'] = "All";
					}
					break;
				case "viewprofile":
					$data['title'] = "Profile";
					$profile = $this->user_model->profile($session_data['id']);
					foreach ($profile as $key => $value) {
						$data[$key]=$value;
					}
					break;
				case "editprofile":
					$data['title'] = "Update Profile";
					$data['profile'] = $this->user_model->profile($session_data['id']);
					break;
				case "changepassword":
					$data['title'] = "Change Password";
					$data['profile'] = $this->user_model->profile($session_data['id']);
					break;
				case "suggestion":
					$data['title'] = "Suggest Book";
					break;
			}

			$this->parser->parse('templates/uheader', $data);
			$this->parser->parse("user/$page", $data);
			$this->parser->parse('templates/ufooter', $data);
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function editprofileaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {

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
				redirect( '/user/view/editprofile', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function changepasswordaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {

			if($this->form_validation->run('changepassword') == FALSE) {
				$this->view("changepassword");
			} else {
				$password = $this->input->post('npassword');
				$session_data = $this->session->userdata('logged_in');
				$this->user_model->update_password( $session_data['id'], $password );
				$this->session->set_userdata('message', "Password Successfully Updated!");
				redirect( '/user/view/changepassword', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function suggestaction() {
		if( $this->session->userdata('logged_in') && $this->session->userdata('logged_in')['type'] != '10001' ) {
			if($this->form_validation->run('suggestion') == FALSE) {
				$this->view("suggestion");
			} else {
				$title = $this->input->post('title');
				$authors = $this->input->post('author');
				$publisher = $this->input->post('publisher');
				$edition = $this->input->post('edition');
				$session_data = $this->session->userdata('logged_in');
				$this->suggestion_model->add( $session_data['id'], $title, $authors, $publisher, $edition );
				$this->session->set_userdata('message', "Book suggestion posted successfully! Thank you for the suggestion!");
				redirect( '/user/view/suggestion', 'redirect' );
			}
		} else if( $this->session->userdata('logged_in') ) {
			redirect( '/librarian', 'refresh' );
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	function password_confirm( $password ) {
		$session_data = $this->session->userdata('logged_in');
		if( $this->user_model->password_confirm($session_data['id'], $password) ){
			return TRUE;
		}
		$this->form_validation->set_message( 'password_confirm', 'The Current Password is wrong' );
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