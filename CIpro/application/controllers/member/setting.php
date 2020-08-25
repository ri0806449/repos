<?php 
//創造一個session
//session_start();當已經$this->load->library('session') 這一行就幫你做好session_start的動作了
class Setting extends CI_Controller
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
		$this->load->model('member_model');
		//載入email資源
		$this->load->library('email');
	}

	//登入主頁的相關資訊
	public function index()
	{	
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
			$result = $this->member_model->registration_insert($data);
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
	     $result = $this->member_model->update_info_for_session($id);
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



	//在主頁中重設密碼
	public function want_to_reset_password()
	{	
		if (isset($this->session->userdata['logged_in'])) {
			$session_data = $this->session->userdata['logged_in'];
			//進行更改密碼的環節，先密碼格式驗證
			if ($this->form_validation->run('reset_password') == FALSE) {
				//密碼驗證失敗，重新導入重設密碼頁面
				$session_data['title'] = "CI實作會員系統";
				$this->load->view('want_to_reset_password/header',$session_data);
				$this->load->view('want_to_reset_password/content',$session_data);
				$this->load->view('want_to_reset_password/footer',$session_data);
			}else{
				//密碼通過驗證，將密碼寫入資料庫，同時導向登入頁面
				
				//透過session取得該位使用者的資訊，以進行密碼修改
				$new_password = array(
									'password' => md5($this->input->post('reset_password'))
									);
				if ($this->member_model->want_to_change_password($session_data,$new_password)) {
					//密碼已修改，回主頁
					echo '<script>alert("密碼修改成功囉超級恭喜～"); location.href="../loginn/user_login_process";</script>';
				}else{
					//密碼沒有換，回主頁
					echo '<script>alert("密碼沒有變喔但還是超級恭喜～"); location.href="../loginn/user_login_process";</script>;';
				}
			}			
		}else{
			$data['title'] = "CI實作會員系統"; 
			$this->load->view('loginn/header', $data);
			$this->load->view('loginn/content',$data);
			$this->load->view('loginn/footer',$data);				
		}
	
	}	




}	
