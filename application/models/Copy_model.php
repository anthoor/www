<?php

class Copy_model extends CI_Model {
	public function add( $bookid, $shelf, $row ) {
		$this->db->insert('copy', array('book_id'=>$bookid, 'status'=>'A', 'shelf'=>$shelf, 'row'=>$row));
	}

	public function lease( $id ) {
		$this->db->where( 'id',$id );
		$this->db->update( 'copy', array('status'=>'L') );
	}

	public function damage( $id ) {
		$this->db->where( 'id',$id );
		$this->db->update( 'copy', array('status'=>'D') );
	}

	public function remove( $id ) {
		$this->db->where( 'id',$id );
		$this->db->update( 'copy', array('status'=>'R') );
	}

	public function return_copy( $id ) {
		$this->db->where( 'id', $id );
		$this->db->update( 'copy', array('status'=>'A') );
	}

	public function valid( $id ) {
		$this->db->where('id',$id);
		$this->db->where('status','A');
		$this->db->from('copy');
		$this->db->select('book_id');
		$query = $this->db->get();
		if( $query->num_rows() == 1 ) {
			return TRUE;
		}
		return FALSE;
	}
}