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
		
		
		//表單驗證的判斷
		if($this->form_validation->run('register') == FALSE){//正式將驗證的規則建立在application/config/form_validation.php
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
		if (strpos($str,'fuck') !== false) {//用strpos判斷字串中是否包含特定文字
			$this->form_validation->set_message('username_check',"帳號中請勿包含不雅文字");
			return FALSE;
		}
		else{
			return TRUE;
		}
	}

}	
