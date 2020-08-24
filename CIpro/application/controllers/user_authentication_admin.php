<?php 
//創造一個session
//session_start();當已經$this->load->library('session') 這一行就幫你做好session_start的動作了
class User_Authentication_admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//載入表單輔助函式
		$this->load->helper('form','url');
		//載入表單驗證輔助函式
		$this->load->library('form_validation');
		//載入session輔助函式
		$this->load->library('session');
		//載入資料庫model
		$this->load->model('loginn_database_admin');
		//載入資料庫model，取得編輯資料
		$this->load->model('member_model');
		//載入email資源
		$this->load->library('email');
	}

	//登入主頁的相關資訊
	public function index()
	{	
		if(isset($this->session->userdata['logged_in_admin'])){
			$member_data['admin'] = $this->session->userdata['logged_in_admin'];
			$member_data['title'] = "CI實作會員系統後台";
			//取得所有會員資料
			$member_data['user'] = $this->member_model->get_member_data();
			$this->load->view('main_admin/header',$member_data);
			$this->load->view('main_admin/content',$member_data);
			$this->load->view('main_admin/footer',$member_data);
		}else{
			$data['title'] = "CI實作會員系統後台"; 
			$this->load->view('loginn_admin/header', $data);
			$this->load->view('loginn_admin/content',$data);
			$this->load->view('loginn_admin/footer',$data);
		}
	}


	//自己設定的回調函數
	public function username_check($str)//$str即寫入的值
	{
		if (strpos($str,'fuck') !== false) {//用strpos判斷字串中是否包含特定文字
			$this->form_validation->set_message('username_check',"帳號中請勿包含不雅文字");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

	// 確認使用者登入之流程
	public function user_login_process() {

		if ($this->form_validation->run('login_admin') == FALSE) {
			//驗證沒過有分兩種，一種是沒有填但是本身已是登入狀態，一種是第一次進到登入頁面或帳密輸入錯誤，所以以下是這部分的判斷
			if(isset($this->session->userdata['logged_in_admin'])){
				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->member_model->get_member_data();
				$this->load->view('main_admin/header',$member_data);
				$this->load->view('main_admin/content',$member_data);
				$this->load->view('main_admin/footer',$member_data);
			}else{
				$data['title'] = "CI實作會員系統後台"; 
				$this->load->view('loginn_admin/header', $data);
				$this->load->view('loginn_admin/content',$data);
				$this->load->view('loginn_admin/footer',$data);
			}
		} else {
			//以下則是第一次輸入帳密或重新輸入帳密時要做出的反應
			$data = array(
					'username' => $this->input->post('login_admin_username'),
					'password' => md5($this->input->post('login_admin_password'))
						);//先將使用者輸入的帳密存到$data陣列中
			$result = $this->loginn_database_admin->login($data);//用login function確認這組帳密是否在資料庫能撈出一筆資料
			if ($result == TRUE) {
			//可以撈出一筆資料代表帳密正確，將username以read_user_in_adminformation function去撈出該使用者的其他資料
				$username = $this->input->post('login_admin_username');
				$result = $this->loginn_database_admin->read_user_information($username);
			if ($result != false) {
				$session_data = array(
									'id' => $result[0]->id,
									'username' => $result[0]->username,
									'email' => $result[0]->email,
									'gender' => $result[0]->gender,
									'hobby' => $result[0]->hobby
									);
				//將撈出來的使用者相關資料存進session，並導入主頁
				$this->session->set_userdata('logged_in_admin', $session_data);
				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->member_model->get_member_data();
				$this->load->view('main_admin/header',$member_data);
				$this->load->view('main_admin/content',$member_data);
				$this->load->view('main_admin/footer',$member_data);			}
			} else {
				//無法以這組帳密在資料庫撈出一筆資料，顯示錯誤畫面並導回登入頁面
				$data = array(
							'error_message' => '錯誤的帳號或密碼'
							);
				$data['title'] = "CI實作會員系統後台"; 
				$this->load->view('loginn_admin/header', $data);
				$this->load->view('loginn_admin/content',$data);
				$this->load->view('loginn_admin/footer',$data);
			}

		}
	}


	//管理者更動資訊
	public function update_user_admin()
	{
	     // 得到使用者輸入的資料
	     $id = $this->input->post('id');
	     $field = $this->input->post('field');
	     $value = $this->input->post('value');

	     //更新資料
	     $this->member_model->update_user_admin($id,$field,$value);
	     //這是什麼啦 A：好啦跟你說，這個主要是運用在js後續判斷是否傳送成功，傳1代表成功傳送，傻傻的～
	     echo 1;
	     exit;
	}

	//忘記密碼流程
	public function forgot_password()
	{	
		if($this->form_validation->run('verify_email') == FALSE){
			//如果忘記填的話再次導向忘記密碼頁面，提醒輸入
			$data['title'] = "CI實作會員系統後台";
			$this->load->view('forgot_password_admin/header',$data);
			$this->load->view('forgot_password_admin/content',$data);
			$this->load->view('forgot_password_admin/footer',$data);			
		}else{
			//有填，則傳到資料庫確認是否有一筆資料相符
			$email = $this->input->post('verify_email');
			if ($this->loginn_database_admin->verify_email($email)) {
				$token = [];
				//然後之後導入頁面提示「驗證連結已寄至您的信箱，請前往收信」，並設定自動跳轉登入頁面
				//產出亂數，存於要寄出的網址中，並存入資料庫token欄位以供辨認
				$token = array(
								'token'=>rand().rand(),
							); 				
				$this->email->from('dexster.wang@babyhome.com.tw','王志凌');
				$this->email->to($email);
				$this->email->subject('此為CI實作會員系統後台遺失密碼認證信件，請於15分鐘內使用連結');
                $this->email->message("請點選下方連結：{unwrap}http://localhost/repos/CIpro/index.php/user_authentication_admin/reset_password/".$token['token']."{/unwrap}");
				$this->email->send();
				echo $this->email->print_debugger();

				//將$token存於資料庫中
				if ($this->loginn_database_admin->save_token($email,$token)) {
						$data = array(
								'inform_message' => '請至信箱收信，信件有效時間為15分鐘'
								);
						$data['title'] = "CI實作會員系統後台"; 
						$this->load->view('loginn_admin/header', $data);
						$this->load->view('loginn_admin/content',$data);
						$this->load->view('loginn_admin/footer',$data);
				}else{
						$data = array(
									'error_message' => 'token值無法存入，請稍後再試。'
									);
						$data['title'] = "CI實作會員系統後台";
						$this->load->view('forgot_password_admin/header',$data);
						$this->load->view('forgot_password_admin/content',$data);
						$this->load->view('forgot_password_admin/footer',$data);
				}
			}else{
				$data = array(
							'error_message' => '不存在的信箱！！'
							);
				$data['title'] = "CI實作會員系統後台";
				$this->load->view('forgot_password_admin/header',$data);
				$this->load->view('forgot_password_admin/content',$data);
				$this->load->view('forgot_password_admin/footer',$data);
			}
		}	
	}

	//重設密碼流程
	public function reset_password()
	{	
		$data['token_varify'] = $this->uri->segment(3);
		//判斷token是否超過15分鐘，超過15分鐘即過期，刪除token
		$this->loginn_database_admin->expire_token($data);
		//將網址的token值拿進資料庫做比對，如有相符資料則取出資料庫的token值，避免網址被洗掉，如無相符則導回登入頁面（代表token值已被刪除）
		if ($this->loginn_database_admin->token_match($data)) {
			//有token資料，進行更改密碼的環節，先密碼格式驗證
			if ($this->form_validation->run('reset_password') == FALSE) {
				//密碼驗證失敗，重新導入重設密碼頁面
				$data['title'] = "CI實作會員系統後台";
				$this->load->view('reset_password_admin/header',$data);
				$this->load->view('reset_password_admin/content',$data);
				$this->load->view('reset_password_admin/footer',$data);
			}else{
				//密碼通過驗證，將密碼寫入資料庫，同時導向登入頁面
				
				//透過token取得該位使用者的資訊，以進行密碼修改
				$new_password = array(
									'password' => md5($this->input->post('reset_password'))
									);
				if ($this->loginn_database_admin->change_password($data,$new_password)) {
					//刪除token值
					$this->loginn_database_admin->delete_token($data);
					$data = array(
								'inform_message' => '更改密碼成功囉～請重新登入！！'
								);
					$data['title'] = "CI實作會員系統後台"; 
					$this->load->view('loginn_admin/header', $data);
					$this->load->view('loginn_admin/content',$data);
					$this->load->view('loginn_admin/footer',$data);
				}else{
					//過期了，沒有找到token資料，導入主頁
					$data = array(
							'error_message' => '操作時間逾時，請重新操作。'
							);
					$data['title'] = "CI實作會員系統後台"; 
					$this->load->view('loginn_admin/header', $data);
					$this->load->view('loginn_admin/content',$data);
					$this->load->view('loginn_admin/footer',$data);
				}
			}
		}else{
			//過期了，沒有找到token資料，導入主頁
			$data = array(
					'error_message' => '操作時間逾時，請重新操作。'
					);
			$data['title'] = "CI實作會員系統後台"; 
			$this->load->view('loginn_admin/header', $data);
			$this->load->view('loginn_admin/content',$data);
			$this->load->view('loginn_admin/footer',$data);			
		}	
	}

	//在主頁中重設密碼
	public function want_to_reset_password()
	{	
		if (isset($this->session->userdata['logged_in_admin'])) {
			$session_data = $this->session->userdata['logged_in_admin'];
			//進行更改密碼的環節，先密碼格式驗證
			if ($this->form_validation->run('reset_password') == FALSE) {
				//密碼驗證失敗，重新導入重設密碼頁面
				$session_data['title'] = "CI實作會員系統後台";
				$this->load->view('want_to_reset_password_admin/header',$session_data);
				$this->load->view('want_to_reset_password_admin/content',$session_data);
				$this->load->view('want_to_reset_password_admin/footer',$session_data);
			}else{
				//密碼通過驗證，將密碼寫入資料庫，同時導向登入頁面
				
				//透過session取得該位使用者的資訊，以進行密碼修改
				$new_password = array(
									'password' => md5($this->input->post('reset_password'))
									);
				if ($this->loginn_database_admin->want_to_change_password($session_data,$new_password)) {
					//密碼已修改，回主頁
					echo '<script>alert("密碼修改成功囉超級恭喜～"); location.href="user_login_process";</script>';
				}else{
					//密碼沒有換，回主頁
					echo '<script>alert("密碼沒有變喔但還是超級恭喜～"); location.href="user_login_process";</script>;';
				}
			}			
		}else{
			$data['title'] = "CI實作會員系統後台"; 
			$this->load->view('loginn_admin/header', $data);
			$this->load->view('loginn_admin/content',$data);
			$this->load->view('loginn_admin/footer',$data);				
		}
	
	}

	//刪除使用者
	public function delete_user()
	{
		//得到所傳入的id
		$id = $this->input->post('id');		
		//傳到model進行刪除的動作
		$this->member_model->delete_user($id);

	}

	public function add_user()
	{
		if(isset($this->session->userdata['logged_in_admin'])){
			if ($this->form_validation->run('register') == FALSE) {
				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->member_model->get_member_data();
				$this->load->view('add_user_admin/header',$member_data);
				$this->load->view('add_user_admin/content',$member_data);
				$this->load->view('add_user_admin/footer',$member_data);
			}else{
				$data = array
				(
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'email' => $this->input->post('email'),
					'gender' => $this->input->post('gender'),
					'hobby' => $this->input->post('hobby')
				);
				$result = $this->loginn_database_admin->registration_insert($data);
				if($result == TRUE){
					$member_data['message_display'] = '新增成功！';
					$member_data['admin'] = $this->session->userdata['logged_in_admin'];
					$member_data['title'] = "CI實作會員系統後台";
					//取得所有會員資料
					$member_data['user'] = $this->member_model->get_member_data();
					$this->load->view('main_admin/header',$member_data);
					$this->load->view('main_admin/content',$member_data);
					$this->load->view('main_admin/footer',$member_data);
				}
				else{
					$member_data['error_message'] = '新增失敗，請再試一次。';
					$member_data['admin'] = $this->session->userdata['logged_in_admin'];
					$member_data['title'] = "CI實作會員系統後台";
					//取得所有會員資料
					$member_data['user'] = $this->member_model->get_member_data();
					$this->load->view('add_user_admin/header',$member_data);
					$this->load->view('add_user_admin/content',$member_data);
					$this->load->view('add_user_admin/footer',$member_data);
				}
			}
		}else{
			$data['title'] = "CI實作會員系統後台"; 
			$this->load->view('loginn_admin/header', $data);
			$this->load->view('loginn_admin/content',$data);
			$this->load->view('loginn_admin/footer',$data);
		}	
	}	



	//從主頁登出
	public function logout_admin()
	{
		//刪除session資料
		$sess_array = array('username' => '');
		$this->session->unset_userdata('logged_in_admin',$sess_array);
		$data['message_display'] = '成功登出';
		$data['title'] = "CI實作會員系統後台"; 
		$this->load->view('loginn_admin/header', $data);
		$this->load->view('loginn_admin/content',$data);
		$this->load->view('loginn_admin/footer',$data);
	}

}	
