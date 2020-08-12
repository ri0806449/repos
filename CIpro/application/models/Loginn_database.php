<?php
	class Loginn_Database extends CI_Model
	{
		//插入資料庫裡的註冊資料
		public function registration_insert($data)
		{	
			//query得出使用者的帳號是否在資料庫中
			$condition = "username =" . "'" . $data['username'] . "'";
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 0){
				//query得出資料庫裡的其他資料
				$this->db->insert('user',$data);
				if ($this->db->affected_rows() > 0) {
					return true;
				} else {
					return false;
				}
			}
		}

		//用帳號密碼讀取資料
		public function login($data)
		{	

			$condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if($query->num_rows() == 1){
				return true;
			}
			else{
				return false;
			}
		}

		//讀取資料庫的資料並秀出主頁訊息
		public function read_user_information($username)
		{
			$condition = "username =" . "'" . $username . "'";
			$this->db->select('*');
			$this->db->from('user');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			if ($query->num_rows() == 1) {
				return  $query->result();
			}else{
				return false;
			}
		}
	}
