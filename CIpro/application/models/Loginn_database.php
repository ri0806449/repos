<?php
	class Loginn_Database extends CI_Model
	{
		//插入資料庫裡的註冊資料
		public function registration_insert($data)
		{	
			//query得出使用者的帳號是否在資料庫中

			$query =$this->db->get_where('user',
				array('username'=>$data['username']),1);
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
			$query = $this->db->get_where('user',
				//兩個中括號[]可以取代array()
				[
					'username' => $data['username'],
					'password' => $data['password']
				],1);
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
			$query = $this->db->get_where('user',array('username'=>$username),1);
			if ($query->num_rows() == 1) {
				return  $query->result();
			}else{
				return false;
			}
		}

		//因為更新資料庫而需要更新session資料而需要重新取得該使用者所有資料
		public function update_info_for_session($id)
		{
			$query = $this->db->get_where('user',array('id'=>$id),1);
			if ($query->num_rows() == 1) {
				return  $query->result();
			}else{
				return false;
			}
		}

		//忘記密碼時驗證email是否存在
		public function verify_email($email)
		{
			$query = $this->db->get_where('user',array('email'=>$email),1);
			if ($query->num_rows() == 1) {
				return true;
			}else{
				return false;
			}
		}

		//將token存進去資料庫裡
		public function save_token($email,$token)
		{
			//將token update進資料庫
 			$this->db->where('email' , $email);
 			$this->db->update('user', $token);
 			$affected = $this->db->affected_rows();
 			if ($affected > 0) {
 				return true;
 			}else{
 				return false;
 			}

		}

		//用網址取得的token值取得該使用者資訊，並換密碼一波
		public function change_password($data,$new_password)
		{	
			//將新密碼 update進資料庫
 			$this->db->where('token', $data['token_varify']);
 			$query = $this->db->update('user', $new_password);
 			if ($affected > 0) {
 				return true;
 			}else{
 				return false;
 			}
		}
	}
