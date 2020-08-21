<?php
	class Member_model extends CI_Model
	{
		public function get_member_data()
		{
			//取得所有會員資料
			$query = $this->db->get('user');
			$row = $query->result_array();
			return $row;
		}

		public function update_user($id,$field,$value)
		{
		   //更新
		   $data=array($field => $value);
		   $this->db->where('id',$id);
		   $this->db->update('user',$data);
		}

		public function update_user_admin($id,$field,$value)
		{
		   //更新資料
		   $data=array($field => $value);
		   $this->db->where('id',$id);
		   $this->db->update('user',$data);

		}

		public function delete_user($id)
		{
			$this->db->where('id',$id);
			$this->db->delete('user');
			$affected = $this->db->affected_rows();
			if ($affected > 0) {
				return true;
			}else{
				return false;
			}
		}
	}
