<?php
class Issue_model extends CI_Model {
	public function add( $userid, $copyid ) {
		$this->db->insert('issue', array('user_id'=>$userid, 'copy_id'=>$copyid));
	}

	public function get() {
		$string = "SELECT issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id";
		$query = $this->db->query( $string );
		return $query->result_array();
	}

	public function get_pending() {
		$string = "SELECT issue.id, issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id AND issue.id NOT IN (SELECT issue_id FROM `return`)";
		$query = $this->db->query( $string );
		return $query->result_array();
	}

	public function renew( $id ) {
		$this->db->where( 'id', $id );
		date_default_timezone_set("Asia/Kolkata");
		$this->db->update( 'issue', array( 'date'=>date('Y-m-d h:i:s') ) );
	}

	public function get_copy( $issue ) {
		$query = $this->db->query( "SELECT copy_id FROM issue WHERE id = $issue" );
		return $query->result_array()[0]['copy_id'];
	}
}