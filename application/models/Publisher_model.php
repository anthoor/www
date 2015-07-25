<?php
class Publisher_model extends CI_Model {
	public function add( $name ) {
		$this->db->insert( 'publisher', array('name'=> $name) );
	}

	public function get() {
		$query = $this->db->query( "SELECT publisher.id, name, COUNT(book.id) AS count FROM publisher LEFT OUTER JOIN book ON publisher.id = book.publisher GROUP BY name" );
		return $query->result_array();
	}
}