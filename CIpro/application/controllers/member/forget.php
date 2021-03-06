<?php 
//創造一個session
//session_start();當已經$this->load->library('session') 這一行就幫你做好session_start的動作了
class Forget extends CI_Controller
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
			if ($this->member_model->verify_email($email)) {
				$token = [];
				//然後之後導入頁面提示「驗證連結已寄至您的信箱，請前往收信」，並設定自動跳轉登入頁面
				//產出亂數，存於要寄出的網址中，並存入資料庫token欄位以供辨認
				$token = array(
								'token'=>rand().rand(),
							); 				
				$this->email->from('dexster.wang@babyhome.com.tw','王志凌');
				$this->email->to($email);
				$this->email->subject('此為CI實作會員系統遺失密碼認證信件，請於15分鐘內使用連結');
                $this->email->message("請點選下方連結：{unwrap}http://localhost/repos/CIpro/index.php/member/forget/reset_password/".$token['token']."{/unwrap}");
				$this->email->send();
				echo $this->email->print_debugger();

				//將$token存於資料庫中
				if ($this->member_model->save_token($email,$token)) {
						$data = array(
								'inform_message' => '請至信箱收信，信件有效時間為15分鐘'
								);
						$data['title'] = "CI實作會員系統"; 
						$this->load->view('loginn/header', $data);
						$this->load->view('loginn/content',$data);
						$this->load->view('loginn/footer',$data);
				}else{
						$data = array(
									'error_message' => 'token值無法存入，請稍後再試。'
									);
						$data['title'] = "CI實作會員系統";
						$this->load->view('forgot_password/header',$data);
						$this->load->view('forgot_password/content',$data);
						$this->load->view('forgot_password/footer',$data);
				}
			}else{
				$data = array(
							'error_message' => '不存在的信箱！！'
							);
				$data['title'] = "CI實作會員系統";
				$this->load->view('forgot_password/header',$data);
				$this->load->view('forgot_password/content',$data);
				$this->load->view('forgot_password/footer',$data);
			}
		}	
	}


	//重設密碼流程
	public function reset_password()
	{	
		$data['token_varify'] = $this->uri->segment(4);
		//判斷token是否超過15分鐘，超過15分鐘即過期，刪除token
		$this->member_model->expire_token($data);
		//將網址的token值拿進資料庫做比對，如有相符資料則取出資料庫的token值，避免網址被洗掉，如無相符則導回登入頁面（代表token值已被刪除）
		if ($this->member_model->token_match($data)) {
			//有token資料，進行更改密碼的環節，先密碼格式驗證
			if ($this->form_validation->run('reset_password') == FALSE) {
				//密碼驗證失敗，重新導入重設密碼頁面
				$data['title'] = "CI實作會員系統";
				$this->load->view('reset_password/header',$data);
				$this->load->view('reset_password/content',$data);
				$this->load->view('reset_password/footer',$data);
			}else{
				//密碼通過驗證，將密碼寫入資料庫，同時導向登入頁面
				
				//透過token取得該位使用者的資訊，以進行密碼修改
				$new_password = array(
									'password' => md5($this->input->post('reset_password'))
									);
				if ($this->member_model->change_password($data,$new_password)) {
					//刪除token值
					$this->member_model->delete_token($data);
					$data = array(
								'inform_message' => '更改密碼成功囉～請重新登入！！'
								);
					$data['title'] = "CI實作會員系統"; 
					$this->load->view('loginn/header', $data);
					$this->load->view('loginn/content',$data);
					$this->load->view('loginn/footer',$data);
				}else{
					//過期了，沒有找到token資料，導入主頁
					$data = array(
							'error_message' => '操作時間逾時，請重新操作。'
							);
					$data['title'] = "CI實作會員系統"; 
					$this->load->view('loginn/header', $data);
					$this->load->view('loginn/content',$data);
					$this->load->view('loginn/footer',$data);
				}
			}
		}else{
			//過期了，沒有找到token資料，導入主頁
			$data = array(
					'error_message' => '操作時間逾時，請重新操作。'
					);
			$data['title'] = "CI實作會員系統"; 
			$this->load->view('loginn/header', $data);
			$this->load->view('loginn/content',$data);
			$this->load->view('loginn/footer',$data);			
		}	
	}

}	
