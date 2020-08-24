<?php 
//創造一個session
//session_start();當已經$this->load->library('session') 這一行就幫你做好session_start的動作了
class Loginn extends CI_Controller
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
