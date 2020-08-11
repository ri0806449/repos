<?php 
//創造一個session
session_start();
class User_Authentication extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//載入表單輔助函式
		$this->load->helper('form');
		//載入表單驗證輔助函式
		$this->load->library('form_validation');
		//載入session輔助函式
		//$this->load->library('session');
		//載入資料庫model（還不確定有什麼用，要記得去看一下該model檔案）
		$this->load->model('loginn_database');
	}

	//登入主頁的相關資訊
	public function index()
	{	
		//載入all.css
		$this->load->helper('url');
		//$data['user'] = $this->member_model->get_member_data();
		$data['title'] = "CI實作會員系統";
		$this->load->view('main/header', $data);
		$this->load->view('loginn/content',$data);
		$this->load->view('main/footer',$data);
	}

	//註冊頁面的相關資訊
	public function user_register()
	{	
		//載入註冊頁面
		$this->load->view('main/header', $data);
		$this->load->view('user_register/content',$data);
		$this->load->view('main/footer',$data);
	}

	//開始要進入驗證與儲存使用者於註冊時輸入之資料至資料庫
	public function new_user_registration()
	{
		if($this->form_validation->run('register') == FALSE){
			//載入註冊頁面
			$this->load->view('main/header', $data);
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
			$result = $this->login_database->registration_insert($data);
			if($result == TRUE){
				$data['message_display'] = '成功註冊了喔～';
				$this->load->view('main/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('main/footer',$data);
			}
			else{
				$data['message_display'] = '此帳號已存在';
				$this->load->view('main/header', $data);
				$this->load->view('user_register/content',$data);
				$this->load->view('main/footer',$data);
			}
		}
	}

	//確認使用者登入之流程
	public function user_login_process()
	{
		//使用者登入
		if ($this->form_validation->run('login_user') == FALSE){
			//這邊真的有點難懂，為什麼驗證沒過反而是繼續檢查是否有session紀錄（有的話就載入主頁，沒有的話就重新載入登入頁面）？
			if(isset($this->session->userdata['logged_in'])){
				$data['user'] = $this->member_model->get_member_data();
				$this->load->view('main/header',$data);
				$this->load->view('main/content',$data);
				$this->load->view('main/footer',$data);	
			}
			else{
				$this->load->view('main/header', $data);
				$this->load->view('loginn/content',$data);
				$this->load->view('main/footer',$data);

			}
			
		}
		//驗證過了的話則將使用者輸入的帳號密碼傳到model（login_database）進行處理
		else{
			$data = array
			(
				'username' => $this->input->post('login_user_username'),
				'password' => $this->input->post('login_user_userpassword')
			);
			$result = $this->login_database->login($data); 
			if ($result == TRUE) {
				//應該是要作為資料庫echo其他資料之依據（不確定）
				$username = $this->input->post('username');
				$result = $this->login_database->read_user_information($username);
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
				$this->load->view('main/header',$data);
				$this->load->view('main/content',$data);
				$this->load->view('main/footer',$data);
				}
			}
			else{
				$data = array('error_message' => '不存在的帳號或密碼');
				$this->load->view('main/header', $data);
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
		$this->load->view('main/header', $data);
		$this->load->view('loginn/content',$data);
		$this->load->view('main/footer',$data);
	}

}	
