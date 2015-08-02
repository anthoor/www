<?php

class Fine_model extends CI_Model {
	function add( $issue, $amount ) {
		$this->db->insert('fine', array('issue_id'=>$issue,'amount'=>$amount));
	}

	function get( $id = FALSE ) {
		$this->db->select('issue_id, amount');
		$this->db->from('fine');
		if( $id ) {
			$this->db->where('id', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

	function calculate_fine( $days ) {
		$fine = 0;
		$scale = 1;
		$mult_factor = 2;
		while( $days - 7 > 0 ) {
			$fine += 7 * $scale;
			$scale += $mult_factor;
			$days -= 7;
		}
		if( $days > 0 ) {
			$fine += $days * $scale;
		}

		return $fine;
	}

	function date_diff( $user, $date ) {
		$issueDate = new DateTime( $date );
		$today = new DateTime( date('Y-m-d h:i:s') );
		$difference = $issueDate->diff( $today, TRUE );

		$this->load->model('user_model');
		$max = $this->user_model->max_allowed( $user );

		$v = $difference->format("%a");
		
		return $difference->format("%a")-$max;
	}

	function get_fine( $user, $issue ) {
		$this->load->model('issue_model');
		$date = $this->issue_model->get_date( $issue );
		$days = $this->date_diff( $user, $date );
		$fine = $this->calculate_fine( $days );

		return $fine;
	}
}