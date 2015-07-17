<?php

class Librarian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('book_model');
		$this->load->helper( 'form' );
	}

	public function index() {
		if( $this->session->userdata('logged_in') ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			$data['title'] = "Librarian Home";
			$active = array();
			$active['home'] = "active";
			$active['books'] = "";
			$active['stats'] = "";
			$data['active'] = $active;

			$this->load->view('templates/uheader', $data);
			$this->load->view("librarian/index", $data);
			$this->load->view('templates/footer', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}

	public function view( $page ) {
		if( !file_exists(APPPATH."/views/librarian/$page.php") ) {
			show_404();
		}
		if( $this->session->userdata('logged_in') ) {
			$session_data = $this->session->userdata('logged_in');
			$data['realname'] = $this->user_model->get_username( $session_data['id'] );

			switch( $page ) {
				case "viewbooks":
					$data['title'] = "View Available Books";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "";
					$active['view'] = "active";
					$data['active'] = $active;
					$data['authors'] = $this->book_model->get_authors();
					$data['books'] = $this->book_model->get_books();
					break;
				case "viewallbooks":
					$data['title'] = "View All Books";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "";
					$active['view'] = "active";
					$data['active'] = $active;
					$data['authors'] = $this->book_model->get_authors();
					$data['abooks'] = $this->book_model->get_all_books();
					break;
				case "viewauthors":
					$data['title'] = "View Authors";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "";
					$active['view'] = "active";
					$data['active'] = $active;
					$data['bauthors'] = $this->book_model->authors();
					break;
				case "viewpublishers":
					$data['title'] = "View Publishers";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "";
					$active['view'] = "active";
					$data['active'] = $active;
					$data['publishers'] = $this->book_model->publishers();
					break;
				case "addbook":
					$data['title'] = "Add Book";
					$active['home'] = "";
					$active['books'] = "active";
					$active['stats'] = "";
					$active['view'] = "";
					$data['active'] = $active;
					break;
				case "addcopies":
					$data['title'] = "Add Book Copies";
					$active['home'] = "";
					$active['books'] = "active";
					$active['stats'] = "";
					$active['view'] = "";
					$data['active'] = $active;
					break;
				case "addauthor":
					$data['title'] = "Add Author";
					$active['home'] = "";
					$active['books'] = "active";
					$active['stats'] = "";
					$active['view'] = "";
					$data['active'] = $active;
					break;
				case "addpublisher":
					$data['title'] = "Add Publisher";
					$active['home'] = "";
					$active['books'] = "active";
					$active['stats'] = "";
					$active['view'] = "";
					$data['active'] = $active;
					break;
				case "damagecopy":
					$data['title'] = "Report Damaged Copy";
					$active['home'] = "";
					$active['books'] = "active";
					$active['stats'] = "";
					$active['view'] = "";
					$data['active'] = $active;
					break;
				case "removecopy":
					$data['title'] = "Remove Copies";
					$active['home'] = "";
					$active['books'] = "active";
					$active['stats'] = "";
					$active['view'] = "";
					$data['active'] = $active;
					break;
				case "issue":
					$data['title'] = "Issue Book";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "active";
					$active['view'] = "";
					$data['active'] = $active;
					$data['books'] = $this->book_model->get_books();
					break;
				case "renew":
					$data['title'] = "Renew Book";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "active";
					$active['view'] = "";
					$data['active'] = $active;
					$data['books'] = $this->book_model->get_books();
					break;
				case "return":
					$data['title'] = "Return Book";
					$active['home'] = "";
					$active['books'] = "";
					$active['stats'] = "active";
					$active['view'] = "";
					$data['active'] = $active;
					$data['books'] = $this->book_model->get_books();
					break;
			}

			$this->load->view('templates/uheader', $data);
			$this->load->view("librarian/$page", $data);
			$this->load->view('templates/footer', $data);
		} else {
			redirect( '/login', 'refresh' );
		}
	}
}