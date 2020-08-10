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
		//設定表單規則
		$config = array
		(
			array
			(
				'field' => 'username',
				'label' => '帳號',
				'rules' => 'trim|required|min_length[8]|max_length[16]|is_unique[user.username]',
				'errors' => 
				array(
					'required' => '你帳號漏填了',
					'is_unique' => '你帳號跟別人重複囉',
					'min_length' => '你太短了'
				)
			),
			array
			(
				'field' => 'password',
				'label' => '密碼',
				'rules' => 'trim|required|min_length[3]|max_length[16]',
			),
			array
			(
				'field' => 'password_retype',
				'label' => '密碼確認',
				'rules' => 'trim|required|matches[password]',
				'errors' => 
				array(
					'matches' => '確認密碼與原密碼不相符'
				)
			),
			array
			(
				'field' => 'email',
				'label' => '信箱',
				'rules' => 'trim|required|valid_email',
				'errors' => 
				array(
					'valid_email' => '無效的信箱地址'
				)
			),
			array
			(
				'field' => 'hobby',
				'label' => '興趣',
				'rules' => 'trim|required',
			),									
		);
		$this->form_validation->set_rules($config);
		//表單驗證的判斷
		if($this->form_validation->run() == FALSE){
			$this->load->view('main/header', $data);
			$this->load->view('user_register/content',$data);
			$this->load->view('main/footer',$data);
		}
		else{
			$this->load->view('user_register/send_success');
		}

	}

}	
