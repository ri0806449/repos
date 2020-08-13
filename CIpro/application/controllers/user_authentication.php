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
		$this->load->model('loginn_database','member_model');
	}

	//登入主頁的相關資訊
	public function index()
	{	
		//$data['user'] = $this->member_model->get_member_data();
		$data['title'] = "CI實作會員系統";
		$this->load->view('loginn/header', $data);
		$this->load->view('loginn/content',$data);
		$this->load->view('main/footer',$data);
	}

	//註冊頁面的相關資訊
	public function user_register()
	{	
		//載入註冊頁面
		$data['title'] = "CI實作會員系統"; 
		$this->load->view('user_register/header', $data);
		$this->load->view('user_register/content',$data);
		$this->load->view('main/footer',$data);
	}

	//開始要進入驗證與儲存使用者於註冊時輸入之資料至資料庫
	public function new_user_registration()
	{
		if($this->form_validation->run('register') == FALSE){
			//載入註冊頁面
			$data['title'] = "CI實作會員系統"; 
			$this->load->view('user_register/header', $data);
			$this->load->view('user_register/content',$data);
			$this->load->view('main/footer',$data);
		}
		else{
			$data = array
			(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
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
				$this->load->view('main/footer',$data);
			}
			else{
				$data['message_display'] = '此帳號已存在';
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('user_register/header', $data);
				$this->load->view('user_register/content',$data);
				$this->load->view('main/footer',$data);
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

	//確認使用者登入之流程
	public function user_login_process()
	{	
		//檢查是否有session紀錄，有的話載入主頁，沒有的話驗證帳號密碼是否有填寫（依照驗證規則config/form_validation）
		if(isset($this->session->userdata['logged_in'])){
				$data['user'] = $this->member_model->get_member_data();
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('main/header',$data);
				$this->load->view('main/content',$data);
				$this->load->view('main/footer',$data);	
			}
		//使用者登入
		if ($this->form_validation->run('login_user') == FALSE){
				//驗證沒過（沒有填寫），重新載入登入頁面			
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('loginn/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('main/footer',$data);
		}else{
			//驗證過了的話則將使用者輸入的帳號密碼傳到model（login_database）進行處理
			$data = array
			(
				'username' => $this->input->post('login_user_username'),
				'password' => $this->input->post('login_user_password')
			);
			$result = $this->loginn_database->login($data); 
			if ($result == TRUE) {
				//應該是要作為資料庫echo其他資料之依據（不確定）
				$username = $this->input->post('login_user_username');
				$result = $this->loginn_database->read_user_information($username);
				//為什麼還有這一層判斷啊！！！（崩潰
				if ($result != false) {
					$session_data = array
					(
						'username' => $result[0]->username,
						'email' => $result[0]->email,
						'gender' => $result[0]->gender,
						'hobby' => $result[0]->hobby
					);
				//將使用者資料納入session
				$this->session->set_userdata('logged_in',$session_data);
				$data['user'] = $this->member_model->get_member_data();
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('main/header',$data);
				$this->load->view('main/content',$data	);
				$this->load->view('main/footer',$data);
				}
			}else{
				$data = array('error_message' => '不存在的帳號或密碼哭一波');
				$data['title'] = "CI實作會員系統"; 
				$this->load->view('loginn/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('main/footer',$data);

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
