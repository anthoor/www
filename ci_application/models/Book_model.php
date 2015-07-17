<?php

class Book_model extends CI_Model {

	public function get_books() {
		$query = $this->db->query("SELECT book.id as id, title, publisher.name as pub, edition, year, COUNT(*) as count FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id AND copy.status='A' GROUP BY copy.book_id");
		return $query;
	}

	public function get_all_books() {
		$query = $this->db->query("SELECT book.id as id, title, publisher.name as pub, edition, year, COUNT(*) as count FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id GROUP BY copy.book_id");
		return $query;
	}

	public function get_authors( ) {
		$query = $this->db->query("SELECT * FROM written, author WHERE written.author_id = author.id");
		$authors = array();
		while( $row = $query->unbuffered_row() ) {
			if( !isset($authors["$row->book_id"]) ) $authors["$row->book_id"] = array();
			array_push( $authors["$row->book_id"], "$row->first_name $row->middle_name $row->last_name" );
		}
		$result = array();
		foreach( $authors as $book=>$author ) {
			$count = count($author);
			$name = "";
			for( $i = 0; $i<$count-1; $i++ ) {
				$name .= $author[$i].", ";
			}
			$name .= $author[$i];
			$result[$book] = $name;
		}
		return $result;
	}

	public function authors() {
		$query = $this->db->query( "SELECT first_name, middle_name, last_name, COUNT(book_id) AS count FROM author LEFT OUTER JOIN written ON author.id = written.author_id GROUP BY first_name" );
		return $query->result_array();
	}

	public function publishers() {
		$query = $this->db->query( "SELECT name, COUNT(book.id) AS count FROM publisher LEFT OUTER JOIN book ON publisher.id = book.publisher GROUP BY name" );
		return $query->result_array();
	}

	public function issues() {
		$string = "SELECT issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id";
		$query = $this->db->query( $string );
		return $query->result_array();
	}

	public function pending_issues() {
		$string = "SELECT issue.id, issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id AND issue.id NOT IN (SELECT issue_id FROM `return`)";
		$query = $this->db->query( $string );
		return $query->result_array();
	}
}