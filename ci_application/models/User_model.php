<?php

class User_model extends CI_Model {
	public function login( $username, $password ) {
		$this->db->select( 'id, type_id, name, password' );
		$this->db->from( 'user' );
		$this->db->where( 'name', $username );
		$this->db->where( 'password', md5($password) );

		$query = $this->db->get();
		if( $query->num_rows() == 1 ) {
			return $query->result();
		} else {
			return FALSE;
		}
	}

	public function get_username( $id ) {
		$this->db->select( 'full_name' );
		$this->db->from( 'user' );
		$this->db->where( 'id', $id );
		$query = $this->db->get();
		$result = $query->result();
		foreach( $result as $row ) {
			return $row->full_name;
		}
	}

	public function users() {
		$this->db->select( 'id, name, full_name' );
		$this->db->from( 'user' );
		$this->db->where( 'valid', 1 );
		$query = $this->db->get();
		return $query->result_array();
	}
}