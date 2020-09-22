<?php
	class Admin_model extends CI_Model
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

		//試試看
		public function try($cache_name, $time=21600, $function_name=null, $var_arr = array())
		{
			
			return $time;
			//echo $function_name;
		}
		//用帳號密碼讀取資料
		public function login($data)
		{	
			$query = $this->db->get_where('admin',
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
			$query = $this->db->get_where('admin',array('username'=>$username),1);
			if ($query->num_rows() == 1) {
				return  $query->result();
			}else{
				return false;
			}
		}


		//忘記密碼時驗證email是否存在
		public function verify_email($email)
		{
			$query = $this->db->get_where('admin',array('email'=>$email),1);
			if ($query->num_rows() == 1) {
				return true;
			}else{
				return false;
			}
		}

		//將token存進去資料庫裡
		public function save_token($email,$token)
		{	
			//新增token的建立時間，以計算何時可以刪除
			//必須使用date()這個函數將timestamp轉換成可讀的日期時間格式，才有辦法寫進資料庫，否則格式不符	
			$date = date('Y-m-d H:i:s', time()); 
			$token_ctime = [
					'token_create_time' => $date
						];
			$expire_date = date('Y-m-d H:i:s', time()+(60*15));
			$token_etime = [
					'token_expire_time' => $expire_date
						];
			//將token update進資料庫
 			$this->db->where('email' , $email);
 			$this->db->update('admin', $token);
 			//將創立token時間 update進資料庫
 			$this->db->where('email' , $email);
 			$this->db->update('admin', $token_ctime); 
 			//將過期的token時間 update進資料庫
 			$this->db->where('email' , $email);
 			$this->db->update('admin', $token_etime);
 			$affected = $this->db->affected_rows();
 			if ($affected > 0) {
 				return true;
 			}else{
 				return false;
 			}

		}

		//	將token值拿進資料庫比對，如有資料傳true，無則傳false
		public function token_match($data)
		{
 			$query = $this->db->get_where('admin',array('token'=>$data['token_varify']),1);
			if ($query->num_rows() == 1) {
				return true;
			}else{
				return false;
			}
		}

		//判斷token是否超過15分鐘，超過15分鐘即過期，刪除token
		public function expire_token($data)
		{
			$this->db->select('token_expire_time');
			$query = $this->db->get_where('admin',array('token' => $data['token_varify']),1);

			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array();
			   //將過期時間轉成timestamp形式
			   $etime = strtotime($row['token_expire_time']);
			   if (time() > $etime) {
			   	//已過期，刪除token
					//定義token空字串後代入，以符合update格式
					$empty_token = [
								'token' => ""
									];
					$this->db->where('token', $data['token_varify']);
		 			$this->db->update('admin', $empty_token);
			   }
			}		
		}



		//用網址取得的token值取得該使用者資訊，並換密碼一波
		public function change_password($data,$new_password)
		{	
			//先搜尋有沒有這個密碼
 			$query = $this->db->get_where('admin',array('token'=>$data['token_varify'],'password'=>$new_password['password']),1);
			if ($query->num_rows() == 1) {
				return true;
				//因為在user_authentication裡已經做過token的驗證，所以在這邊不用再次判別token是否match
			}else{
				//將新密碼 update進資料庫
	 			$this->db->where('token', $data['token_varify']);
	 			$this->db->update('admin', $new_password);
	 			$affected = $this->db->affected_rows();
	 			if ($affected > 0) {
	 				//更改成功
	 				return true;
	 			}else{
	 				//token過期
	 				return false;
	 			}
			}
		}

		//用session取得該使用者資訊，並換密碼一波
		public function want_to_change_password($session_data,$new_password)
		{	

			//將新密碼 update進資料庫
 			$this->db->where('id', $session_data['id']);
 			$this->db->update('admin', $new_password);
 			$affected = $this->db->affected_rows();
 			if ($affected > 0) {
 				//更改成功
 				return true;
 			}else{
 				//密碼沒有換
 				return false;
 			}
			
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

		public function search_result($limit,$start, $search_username, $search_email)
		{
			$query = $this->db
			->like('email', $search_email)
			->like('username',$search_username)
			->get('user', $limit, $start);
			if ($query->num_rows() > 0) {
				return $query->result();
			}else{
				return false;
			}


		}

		public function search_username_email($part_email,$part_username)
		{
			$query = $this->db
			->like('email', $part_email)
			->like('username', $part_username)
			->get('user');
			return $query->result_array();
		}

		public function get_member_data()
		{
			//取得所有會員資料
			$query = $this->db->get('user');
			$row = $query->result_array();
			return $row;
		}


		//刪除token值
		public function delete_token($data)
		{	
			//定義token空字串後代入，以符合update格式
			$empty_token = [
						'token' => ""
							];
			$this->db->where('token', $data['token_varify']);
 			$this->db->update('admin', $empty_token);
		}

		//取得資料表總筆數，用於分頁
		public function get_count()
		{
			return $this->db->count_all("user");
		}

		//取得搜尋資料表總筆數，用於分頁
		public function get_search_count($search_username, $search_email)
		{
			$this->db->like('email', $search_email);
			$this->db->like('username', $search_username);
			$this->db->from('user');
			return $this->db->count_all_results();
		}

		//取得資料表特定筆數的資料，用於分頁
		public function page_get_user($limit,$start)
		{
			$query = $this->db->get("user", $limit, $start);
			return $query->result();
		}
	}
