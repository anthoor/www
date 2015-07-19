<?php
class Return_model extends CI_Model {
	public function add( $issueid ) {
		$this->db->insert('return', array('issue_id'=>$issueid));
	}
}