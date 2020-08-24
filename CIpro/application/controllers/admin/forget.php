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
		$this->load->model('loginn_database_admin');
		//載入資料庫model，取得編輯資料
		$this->load->model('member_model');
		//載入email資源
		$this->load->library('email');
		//載入分頁資源
		$this->load->library('pagination');
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
                $this->email->message("請點選下方連結：{unwrap}http://localhost/repos/CIpro/index.php/admin/forget/reset_password/".$token['token']."{/unwrap}");
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
		$data['token_varify'] = $this->uri->segment(4);
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
}	
