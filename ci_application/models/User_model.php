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
		$this->db->order_by( 'full_name' );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_suspended() {
		$this->db->select( 'id, name, full_name' );
		$this->db->from( 'user' );
		$this->db->where( 'valid', 2 );
		$this->db->order_by( 'full_name' );
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_deletable() {
		$query = $this->db->query("SELECT id, name, full_name FROM user WHERE valid<>0 ORDER BY full_name");
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
		return $rows[0];
	}

	public function add( $name, $uname, $password, $type, $mail, $mobile, $dp ) {
		$inputs = array('name'=>$uname, 'password'=>md5($password), 'type_id'=>$type, 'full_name'=>$name, 'email'=>$mail, 'phone'=>$mobile, 'dpfile'=>$dp, 'valid'=>1);
		$this->db->insert( 'user', $inputs );
	}

	public function suspend( $userid ) {
		$this->db->where( 'id', $userid );
		$this->db->update( 'user', array('valid'=>2) );
	}

	public function unsuspend( $userid ) {
		$this->db->where( 'id', $userid );
		$this->db->update( 'user', array('valid'=>1) );
	}

	public function delete( $userid ) {
		$this->db->where( 'id', $userid );
		$this->db->update( 'user', array('valid'=>0) );
	}

	public function update( $id, $name, $mail, $phone ) {
		$this->db->where('id', $id);
		$this->db->update( 'user', array('full_name'=>$name, 'email'=>$mail, 'phone'=>$phone) );
	}

	public function set_dp( $id, $dp ) {
		$this->db->where( 'id', $id );
		$this->db->update( 'user', array('dpfile'=>$dp) );
	}

	public function update_password( $id, $password ) {
		$this->db->where( 'id', $id );
		$this->db->update( 'user', array('password'=>md5($password)) );
	}

	public function available( $uname ) {
		$this->db->select( 'id' );
		$this->db->from( 'user' );
		$this->db->where( 'name', $uname );
		$query = $this->db->get();
		if( $query->num_rows() == 0 ) {
			return TRUE;
		}
		return FALSE;
	}

	public function mail_available( $mail ) {
		$this->db->select( 'id' );
		$this->db->from( 'user' );
		$this->db->where( 'email', $mail );
		$query = $this->db->get();
		if( $query->num_rows() == 0 ) {
			return TRUE;
		}
		return FALSE;
	}

	public function password_confirm( $id, $password ) {
		$this->db->select( 'password' );
		$this->db->from( 'user' );
		$this->db->where( 'id', $id );
		$query = $this->db->get();
		if( $query->num_rows() == 1 ) {
			$result = $query->result_array()[0];
			if( md5($password) == $result['password'] ) {
				return TRUE;
			}
		}
		return FALSE;
	}

	public function profile( $userid ) {
		$string = "SELECT user.name, user.full_name, user.email, user.phone, user.dpfile, user_type.name as type FROM user, user_type WHERE user.type_id = user_type.id AND user.id = $userid";
		$query = $this->db->query($string);
		return $query->result_array()[0];
	}
}