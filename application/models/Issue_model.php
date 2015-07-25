<?php
class Issue_model extends CI_Model {
	function add( $userid, $copyid ) {
		$this->db->insert('issue', array('user_id'=>$userid, 'copy_id'=>$copyid));
	}

	function get( $id = FALSE ) {
		$string = "SELECT issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id";
		if( $id ) {
			$string .= " AND issue.user_id = $id";
		}
		$query = $this->db->query( $string );
		return $query->result_array();
	}

	function get_pending( $id = FALSE ) {
		$string = "SELECT issue.id, issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id AND issue.id NOT IN (SELECT issue_id FROM `return`)";
		if( $id ) {
			$string .= " AND issue.user_id = $id";
		}
		$query = $this->db->query( $string );
		return $query->result_array();
	}

	function get_pending_renew( $id = FALSE ) {
		$string = "SELECT issue.id, issue.copy_id, issue.date, book.title, user.full_name FROM issue, book, copy, user WHERE issue.user_id = user.id AND copy.book_id = book.id AND issue.copy_id = copy.id AND issue.id NOT IN (SELECT issue_id FROM `return`) AND issue.renewed = 0";
		if( $id ) {
			$string .= " AND issue.user_id = $id";
		}
		$query = $this->db->query( $string );
		return $query->result_array();
	}

	function renew( $id ) {
		$this->db->where( 'id', $id );
		$this->db->update( 'issue', array( 'date'=>date('Y-m-d h:i:s'), 'renewed'=>1 ) );
	}

	function get_copy( $issue ) {
		$query = $this->db->query( "SELECT copy_id FROM issue WHERE id = $issue" );
		return $query->result_array()[0]['copy_id'];
	}

	function is_renewable( $issue ) {
		$this->db->where( 'id', $issue );
		$this->db->where( 'renewed', 0 );
		$this->db->from( 'issue' );
		$this->db->select( 'copy_id' );
		$query = $this->db->get();
		if( $query->num_rows() == 1 && $this->not_expired( $issue ) ) {
			return TRUE;
		}
		return FALSE;
	}

	function not_expired( $issue ) {
		$this->db->where( 'id', $issue );
		$this->db->from( 'issue' );
		$this->db->select( 'date' );
		$query = $this->db->get();
		if( $query->num_rows() == 1 ) {
			$array = $query->result_array();
			$dOld = new DateTime($array[0]['date']);
			$dNew = new DateTime(date('Y-m-d h:i:s'));
			$diffInterval = $dOld->diff($dNew, TRUE);
			if( $diffInterval->format("%a") < 5 ) {
				return TRUE;
			}
		}
		return FALSE;
	}
}