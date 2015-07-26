<?php
class Suggestion_model extends CI_Model {
	function add( $user, $title, $authors, $publisher, $edition ) {
		$inputs = array('user'=>$user, 'title'=>$title, 'authors'=>$authors, 'publisher'=>$publisher, 'edition'=>$edition);
		$this->db->insert('suggestion', $inputs);
	}

	function get() {
		$this->db->select('user.full_name as name, title, authors, publisher, edition');
		$this->db->from('suggestion, user');
		$this->db->where('user.id = suggestion.user');
		$query = $this->db->get();
		return $query->result_array();
	}
}