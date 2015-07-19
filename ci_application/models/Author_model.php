<?php
class Author_model extends CI_Model {
	public function get_written( ) {
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

	public function get() {
		$query = $this->db->query( "SELECT author.id, first_name, middle_name, last_name, COUNT(book_id) AS count FROM author LEFT OUTER JOIN written ON author.id = written.author_id GROUP BY first_name" );
		return $query->result_array();
	}

	public function add( $fname, $mname, $lname ) {
		$inputs = array( 'first_name'=>$fname, 'middle_name'=>$mname, 'last_name'=>$lname );
		$this->db->insert('author', $inputs);
	}

	public function add_written( $book, $author ) {
		$this->db->insert( 'written', array('book_id'=>$book, 'author_id'=>$author) );
	}
}