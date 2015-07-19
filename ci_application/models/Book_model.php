<?php

class Book_model extends CI_Model {

	public function get_books() {
		$query = $this->db->query("SELECT book.id as id, title, publisher.name as pub, edition, year, COUNT(*) as count FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id AND copy.status='A' GROUP BY copy.book_id");
		return $query;
	}

	public function books() {
		$query = $this->db->query("SELECT book.id as id, title, publisher.name as pub, edition, year FROM book, publisher WHERE book.publisher = publisher.id");
		return $query;
	}

	public function get_all_books() {
		$query = $this->db->query("SELECT book.id as id, title, publisher.name as pub, edition, year, COUNT(*) as count FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id AND copy.status<>'R' GROUP BY copy.book_id");
		return $query;
	}

	public function add( $title, $publisher, $edition, $year ) {
		$inputs = array( 'title'=>$title, 'publisher'=>$publisher, 'edition'=>$edition, 'year'=>$year );
		$this->db->insert('book', $inputs);
		return $this->db->insert_id();
	}
}