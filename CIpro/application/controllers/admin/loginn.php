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
		$this->load->model('admin_model');
		//載入email資源
		$this->load->library('email');
		//載入分頁資源
		$this->load->library('pagination');
	}


	//登入主頁的相關資訊
	public function index()
	{	
		if(isset($this->session->userdata['logged_in_admin'])){
			$config['base_url'] = 'http://[::1]/repos/CIpro/index.php/admin/loginn/index';
			$config['total_rows'] = $this->admin_model->get_count();
			$config['per_page'] = 10;

			$this->pagination->initialize($config);
			$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

			$member_data['links'] = $this->pagination->create_links();
			$member_data['user_page'] = $this->admin_model->page_get_user($config["per_page"], $page);
			$member_data['admin'] = $this->session->userdata['logged_in_admin'];
			$member_data['title'] = "CI實作會員系統後台";
			//取得所有會員資料
			$member_data['user'] = $this->admin_model->get_member_data();

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

	//登入主頁的相關資訊
	public function index2()
	{	
		if(isset($this->session->userdata['logged_in_admin'])){
			$search_username = $this->input->get('search_username_try');
			$search_email = $this->input->get('search_email_try');
			if (isset($search_username) or isset($search_email)) {
				//當兩個欄位其中一個有填寫資料時
				$config['base_url'] = 'index2?search_username_try='.$search_username.'&search_email_try='.$search_email.'&action=';
				$config['total_rows'] = $this->admin_model-> get_search_count($search_username, $search_email);
				$config['per_page'] = 10;
				$config['page_query_string'] = TRUE;

				//取得最後區段
				$a = $_SERVER['QUERY_STRING'];
				//var_dump($a);
				//擷取數字
				$number_page = filter_var($a, FILTER_SANITIZE_NUMBER_INT);

				$this->pagination->initialize($config);
				$page = ($number_page)? $number_page : 0;
				$member_data['links'] = $this->pagination->create_links();
				$member_data['user_page'] = $this->admin_model->search_result($config["per_page"], $page, $search_username, $search_email);
				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->admin_model->get_member_data();

				$this->load->view('main_admin/header',$member_data);
				$this->load->view('main_admin/content2',$member_data);
				$this->load->view('main_admin/footer',$member_data);
			}else{
				$config['base_url'] = 'http://[::1]/repos/CIpro/index.php/admin/loginn/index2';
				$config['total_rows'] = $this->admin_model->get_count();
				$config['per_page'] = 10;

				$this->pagination->initialize($config);
				$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

				$member_data['links'] = $this->pagination->create_links();
				$member_data['user_page'] = $this->admin_model->page_get_user($config["per_page"], $page);
				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->admin_model->get_member_data();

				$this->load->view('main_admin/header',$member_data);
				$this->load->view('main_admin/content2',$member_data);
				$this->load->view('main_admin/footer',$member_data);
			}
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
			//導向同一個網址，避免寫太多次一樣的程式碼
			header('Location: http://[::1]/repos/CIpro/index.php/admin/loginn/index');
			// redirect('')
			exit;
		} else {
			//以下則是第一次輸入帳密或重新輸入帳密時要做出的反應
			$data = array(
					'username' => $this->input->post('login_admin_username'),
					'password' => md5($this->input->post('login_admin_password'))
						);//先將使用者輸入的帳密存到$data陣列中
			$result = $this->admin_model->login($data);//用login function確認這組帳密是否在資料庫能撈出一筆資料
			if ($result == TRUE) {
			//可以撈出一筆資料代表帳密正確，將username以read_user_in_adminformation function去撈出該使用者的其他資料
				$username = $this->input->post('login_admin_username');
				$result = $this->admin_model->read_user_information($username);
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
				$config['base_url'] = 'http://[::1]/repos/CIpro/index.php/admin/loginn/index';
				$config['total_rows'] = $this->admin_model->get_count();
				$config['per_page'] = 10;

				$this->pagination->initialize($config);
				$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;

				$member_data['links'] = $this->pagination->create_links();
				$member_data['user_page'] = $this->admin_model->page_get_user($config["per_page"], $page);

				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->admin_model->get_member_data();
				$this->load->view('main_admin/header',$member_data);
				$this->load->view('main_admin/content',$member_data);
				$this->load->view('main_admin/footer',$member_data);}
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
