<?php 
class Register extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('loginn_model');
	}


	//主頁的相關資訊
	public function index()
	{	
		//載入all.css與form輔助函數
		$this->load->helper(array('form','url'));
		//表單驗證專用
		$this->load->library('form_validation');
		$data['title'] = "CI實作會員系統";
		//自己設定的回調函數
		$this->form_validation->set_rules('username','帳號','callback_username_check');

		//表單驗證的判斷
		if($this->form_validation->run('register') == FALSE){
			$this->load->view('main/header', $data);
			$this->load->view('user_register/content',$data);
			$this->load->view('main/footer',$data);
		}
		else{
			$this->load->view('user_register/send_success');
		}

	}

	//自己設定的回調函數
	public function username_check($str)//$str即寫入的值
	{
		if ($str == "fuck") {
			$this->form_validation->set_message('username_check',"請有點文化素養，勿以粗口命名帳號");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

}	
