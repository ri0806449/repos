<?php 
//創造一個session
//session_start();當已經$this->load->library('session') 這一行就幫你做好session_start的動作了
class User_Authentication extends CI_Controller
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
		$this->load->model('loginn_database');
		//載入資料庫model，取得編輯資料
		$this->load->model('member_model');
	}

	//登入主頁的相關資訊
	public function index()
	{	
		//$data['user'] = $this->member_model->get_member_data();
		$data['title'] = "CI實作會員系統";
		$this->load->view('loginn/header', $data);
		$this->load->view('loginn/content',$data);
		$this->load->view('loginn/footer',$data);
	}

	//註冊頁面的相關資訊
	public function user_register()
	{	
		//載入註冊頁面
		$data['title'] = "CI實作會員系統"; 
		$this->load->view('user_register/header', $data);
		$this->load->view('user_register/content',$data);
		$this->load->view('user_register/footer',$data);
	}

	//開始要進入驗證與儲存使用者於註冊時輸入之資料至資料庫
	public function new_user_registration()
	{
		if($this->form_validation->run('register') == FALSE){
			//載入註冊頁面
			$data['title'] = "CI實作會員系統"; 
			$this->load->view('user_register/header', $data);
			$this->load->view('user_register/content',$data);
			$this->load->view('user_register/footer',$data);
		}
		else{
			$data = array
			(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'gender' => $this->input->post('gender'),
				'hobby' => $this->input->post('hobby')
			);
			$result = $this->loginn_database->registration_insert($data);
			if($result == TRUE){
				$data['message_display'] = '註冊成功！請輸入帳號密碼進行登入。';
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('loginn/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('loginn/footer',$data);
			}
			else{
				$data['message_display'] = '此帳號已存在';
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('user_register/header', $data);
				$this->load->view('user_register/content',$data);
				$this->load->view('user_register/footer',$data);
			}
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

		//之後再來refactor，先讓程式跑得動
/*		$is_login = $this->isLogin();
		$session_data = $this->getData();

		if ($isLogin) {
			$this->load->view('main/header',$session_data);
				$this->load->view('main/content',$session_data);
				$this->load->view('main/footer',$session_data);
			} else {
				$this->load->view('login/header',$session_data);
				$this->load->view('login/content',$session_data);
				$this->load->view('main/footer',$session_data);
			}*/

		if ($this->form_validation->run('login_user') == FALSE) {
			//驗證沒過有分兩種，一種是沒有填但是本身已是登入狀態，一種是第一次進到登入頁面或帳密輸入錯誤，所以以下是這部分的判斷
			if(isset($this->session->userdata['logged_in'])){
				$session_data = $this->session->userdata['logged_in'];
				$session_data['title'] = "CI實作會員系統";
				$this->load->view('main/header',$session_data);
				$this->load->view('main/content',$session_data);
				$this->load->view('main/footer',$session_data);
			}else{
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('loginn/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('loginn/footer',$data);
			}
		} else {
			//以下則是第一次輸入帳密或重新輸入帳密時要做出的反應
			$data = array(
					'username' => $this->input->post('login_user_username'),
					'password' => md5($this->input->post('login_user_password'))
						);//先將使用者輸入的帳密存到$data陣列中
			$result = $this->loginn_database->login($data);//用login function確認這組帳密是否在資料庫能撈出一筆資料
			if ($result == TRUE) {
			//可以撈出一筆資料代表帳密正確，將username以read_user_information function去撈出該使用者的其他資料
				$username = $this->input->post('login_user_username');
				$result = $this->loginn_database->read_user_information($username);
			if ($result != false) {
				$session_data = array(
									'id' => $result[0]->id,
									'username' => $result[0]->username,
									'email' => $result[0]->email,
									'gender' => $result[0]->gender,
									'hobby' => $result[0]->hobby
									);
				//將撈出來的使用者相關資料存進session，並導入主頁
				$this->session->set_userdata('logged_in', $session_data);
					$session_data['title'] = "CI實作會員系統";
					//在這裡所使用的$session_data是上面的變數，並非session，本流程的上面主頁判斷才是採用session的方式進行取用
					$this->load->view('main/header',$session_data);
					$this->load->view('main/content',$session_data);
					$this->load->view('main/footer',$session_data);
			}
			} else {
				//無法以這組帳密在資料庫撈出一筆資料，顯示錯誤畫面並導回登入頁面
				$data = array(
							'error_message' => '錯誤的帳號或密碼'
							);
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('loginn/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('loginn/footer',$data);
			}
		}
	}

	//隨著使用者更動其資訊，更新session資料
	public function update_user()
	{
	     // 得到使用者輸入的資料
	     $id = $this->input->post('id');
	     $field = $this->input->post('field');
	     $value = $this->input->post('value');

	     //更新資料
	     $this->member_model->update_user($id,$field,$value);
	     //更新session資料(該使用者全部資料更新一波)
	     $result = $this->loginn_database->update_info_for_session($id);
			if ($result != false) {
				$new_session_data = array(
									'id' => $result[0]->id,
									'username' => $result[0]->username,
									'email' => $result[0]->email,
									'gender' => $result[0]->gender,
									'hobby' => $result[0]->hobby
									);
				//將新資料再存入session中
				$this->session->set_userdata('logged_in', $new_session_data);
			}
				

	     //這是什麼啦 A：好啦跟你說，這個主要是運用在js後續判斷是否傳送成功，傳1代表成功傳送，傻傻的～
	     echo 1;
	     exit;
	}

	//忘記密碼流程
	public function forgot_password()
	{	
		if($this->form_validation->run('verify_email') == FALSE){
			//如果忘記填的話再次導向忘記密碼頁面，提醒輸入
			$data['title'] = "CI實作會員系統";
			$this->load->view('forgot_password/header',$data);
			$this->load->view('forgot_password/content',$data);
			$this->load->view('forgot_password/footer',$data);			
		}else{
			//有填，則傳到資料庫確認是否有一筆資料相符
			$email = $this->input->post('verify_email');
			if ($this->loginn_database->verify_email($email)) {
				//生成暫時密碼，並email出去
				$data['title'] ="帥啊老皮";
				$this->load->view('forgot_password/header',$data);
				$this->load->view('forgot_password/content',$data);
				$this->load->view('forgot_password/footer',$data);
			}else{
				$data['title'] = "老皮一點都不帥😭";
				$this->load->view('forgot_password/header',$data);
				$this->load->view('forgot_password/content',$data);
				$this->load->view('forgot_password/footer',$data);
			}
		}

		
		
	}



	//從主頁登出
	public function logout()
	{
		//刪除session資料
		$sess_array = array('username' => '');
		$this->session->unset_userdata('logged_in',$sess_array);
		$data['message_display'] = '成功登出';
		$data['title'] = "CI實作會員系統"; 
		$this->load->view('loginn/header', $data);
		$this->load->view('loginn/content',$data);
		$this->load->view('main/footer',$data);
	}

}	
