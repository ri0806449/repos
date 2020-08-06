<?php
	class Member_model extends CI_Model
	{
		public function get_member_data()
		{
			$query = $this->db->get('user');
			$row = $query->result_array();
			return $row;
		}
	}
