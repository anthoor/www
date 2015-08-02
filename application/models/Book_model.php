<?php

class Book_model extends CI_Model {

	public function get_books() {
		$query = $this->db->query("SELECT book.id as id, title as btitle, publisher.name as pub, edition, year, copy.id as copyid, copy.shelf, copy.row FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id AND copy.status='A'");
		$this->load->model('author_model');
		$authors = $this->author_model->get_written();
		$result = $query->result_array();
		$newresult = array();
		foreach ($result as $key => $value) {
			$newresult[$key] = $value;
			foreach ($authors as $key1 => $value1) {
				if($value['id'] == $key1) {
					$newresult[$key]['authors'] = $value1;
				}
			}
		}
		return $newresult;
	}

	public function books() {
		$query = $this->db->query("SELECT book.id as id, title as btitle, publisher.name as pub, edition, year FROM book, publisher WHERE book.publisher = publisher.id");
		$this->load->model('author_model');
		$authors = $this->author_model->get_written();
		$result = $query->result_array();
		$newresult = array();
		foreach ($result as $key => $value) {
			$newresult[$key] = $value;
			foreach ($authors as $key1 => $value1) {
				if($value['id'] == $key1) {
					$newresult[$key]['authors'] = $value1;
				}
			}
		}
		return $newresult;
	}

	public function get_all_books() {
		$query = $this->db->query("SELECT book.id as id, title as btitle, publisher.name as pub, edition, year, copy.id as copyid, copy.shelf, copy.row FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id AND copy.status<>'R' AND copy.status<>'D'");
		$this->load->model('author_model');
		$authors = $this->author_model->get_written();
		$result = $query->result_array();
		$newresult = array();
		foreach ($result as $key => $value) {
			$newresult[$key] = $value;
			foreach ($authors as $key1 => $value1) {
				if($value['id'] == $key1) {
					$newresult[$key]['authors'] = $value1;
				}
			}
		}
		return $newresult;
	}

	public function add( $title, $publisher, $edition, $year ) {
		$inputs = array( 'title'=>$title, 'publisher'=>$publisher, 'edition'=>$edition, 'year'=>$year );
		$this->db->insert('book', $inputs);
		return $this->db->insert_id();
	}
}