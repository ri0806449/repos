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
		$this->load->model('admin_model');
		//載入email資源
		$this->load->library('email');
		//載入分頁資源
		$this->load->library('pagination');
	}

	//登入主頁的相關資訊
	public function index()
	{	
		//導向同一個網址，避免寫太多次一樣的程式碼
		header('Location: http://[::1]/repos/CIpro/index.php/admin/loginn/index');
	}



	//管理者更動資訊
	public function update_user_admin()
	{
	     // 得到使用者輸入的資料
	     $id = $this->input->post('id');
	     $field = $this->input->post('field');
	     $value = $this->input->post('value');

	     //更新資料
	     $this->admin_model->update_user_admin($id,$field,$value);
	     //這是什麼啦 A：好啦跟你說，這個主要是運用在js後續判斷是否傳送成功，傳1代表成功傳送，傻傻的～
	     echo 1;
	     exit;
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
				if ($this->admin_model->want_to_change_password($session_data,$new_password)) {
					//密碼已修改，回主頁
					echo '<script>alert("密碼修改成功囉超級恭喜～"); location.href="index";</script>';
				}else{
					//密碼沒有換，回主頁
					echo '<script>alert("密碼沒有變喔但還是超級恭喜～"); location.href="index";</script>;';
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
		$this->admin_model->delete_user($id);

	}

	public function search_username()
	{
		//傳入所得到的資料
		$part_username = $this->input->post('n');
		//傳到model進行搜尋的動作
		$result = $this->admin_model->search_username($part_username);
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



	public function add_user()
	{
		if(isset($this->session->userdata['logged_in_admin'])){
			if ($this->form_validation->run('register') == FALSE) {
				$member_data['admin'] = $this->session->userdata['logged_in_admin'];
				$member_data['title'] = "CI實作會員系統後台";
				//取得所有會員資料
				$member_data['user'] = $this->admin_model->get_member_data();
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
				$result = $this->admin_model->registration_insert($data);
				if($result == TRUE){
					$member_data['message_display'] = '新增成功！';
					$config['base_url'] = 'http://[::1]/repos/CIpro/index.php/admin/setting/index';
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
				}
				else{
					$member_data['error_message'] = '新增失敗，請再試一次。';
					$member_data['admin'] = $this->session->userdata['logged_in_admin'];
					$member_data['title'] = "CI實作會員系統後台";
					//取得所有會員資料
					$member_data['user'] = $this->admin_model->get_member_data();
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
}	
