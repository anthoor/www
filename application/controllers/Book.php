<?php

class Book extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('book_model');
		$this->load->model('author_model');
	}

	public function index() {
		$data['title'] = "Availabe Books";
		$data['books'] = $this->book_model->get_books();
		$data['authors'] = $this->author_model->get_written();
		$active = array('home'=>'', 'login'=>'', 'view'=>'active', 'suggestion'=>'');
		$data['active'] = $active;

		$this->load->helper('url');
		$this->load->view('templates/header', $data);
		$this->load->view('book/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function view() {
		$data['title'] = "Availabe Books";
		$data['books'] = $this->book_model->get_books();
		$data['authors'] = $this->author_model->get_written();
		$active = array('home'=>'', 'login'=>'', 'view'=>'active', 'suggestion'=>'');
		$data['active'] = $active;

		$this->load->view('templates/header', $data);
		$this->load->view('book/index', $data);
		$this->load->view('templates/footer', $data);
	}
}