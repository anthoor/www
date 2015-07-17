<?php

class Book_model extends CI_Model {

	public function get_books() {
		$query = $this->db->query("SELECT book.id as id, title, publisher.name as pub, edition, year, COUNT(*) as count FROM book, copy, publisher WHERE book.id = copy.book_id AND book.publisher = publisher.id GROUP BY copy.book_id");
		return $query;
	}

	public function get_authors( ) {
		$query = $this->db->query("SELECT * FROM written, author WHERE written.author_id = author.id");
		$authors = array();
		$i = 0;
		while( $row = $query->unbuffered_row() ) {
			if( !isset($authors["$row->book_id"]) ) $authors["$row->book_id"] = array();
			array_push( $authors["$row->book_id"], "$row->first_name $row->middle_name $row->last_name" );
		}
		$result = array();
		foreach( $authors as $book=>$author ) {
			$count = count($author);
			$name = "";
			$i = 0;
			for( ; $i<$count-1; $i++ ) {
				$name .= $author[$i].", ";
			}
			$name .= $author[$i];
			$result[$book] = $name;
		}
		return $result;
	}
}