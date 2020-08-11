<?php 
class Loginn extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('member_model');
	}


	//主頁的相關資訊
	public function index()
	{	
		//載入all.css與表單輔助函數
		$this->load->helper(array('form','url'));
		//載入表單驗證
		$this->load->library('form_validation');

		$data['title'] = "CI實作會員系統";

		//使用者登入
		if ($this->form_validation->run('login_user') == FALSE) {
			$this->load->view('main/header', $data);
			$this->load->view('loginn/content',$data);
			$this->load->view('main/footer',$data);
		}
		else{
			$data['user'] = $this->member_model->get_member_data();
			$this->load->view('main/header',$data);
			$this->load->view('main/content',$data);
			$this->load->view('main/footer',$data);
		};

/*管理者登入晚一點在寫，一起寫太靠北了，debug不完誒靠
		//管理者登入
		if($this->form_validation->run('login_admin') == FALSE){
			$this->load->view('main/header',$data);
			$this->load->view('loginn/content',$data);
			$this->load->view('main/footer',$data);
		}
		else{
			$data['user'] = $this->member_model->get_member_data();
			$this->load->view('main/header',$data);
			$this->load->view('main/content',$data);
			$this->load->view('main/footer',$data);
		};
*/
	}

}	
