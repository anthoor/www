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

	public function get() {
		$this->db->select( 'id, name, full_name' );
		$this->db->from( 'user' );
		$this->db->where( 'valid', 1 );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_suspended() {
		$this->db->select( 'id, name, full_name' );
		$this->db->from( 'user' );
		$this->db->where( 'valid', 2 );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_deletable() {
		$query = $this->db->query("SELECT id, name, full_name FROM user WHERE valid<>0");
		return $query->result_array();
	}

	public function get_types() {
		$this->db->select( 'id, name' );
		$this->db->from( 'user_type' );
		$this->db->order_by( 'id' );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pending_issues( $userid ) {
		$string = "SELECT * FROM issue WHERE user_id = $userid AND id NOT IN (SELECT issue_id FROM `return`)";
		$query = $this->db->query( $string );
		return $query->num_rows();
	}

	public function issue_limit( $userid ) {
		$string = "SELECT book_limit FROM user, user_type WHERE user.type_id = user_type.id";
		$query = $this->db->query( $string );
		$rows = $query->result_array();
		error_log($row[0]);
		return $rows[0];
	}
}