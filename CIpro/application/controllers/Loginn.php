<?php 
class Loginn extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('loginn_model');
	}


	//主頁的相關資訊
	public function index()
	{	
		//載入all.csss
		$this->load->helper('url');
		//$data['user'] = $this->member_model->get_member_data();
		$data['title'] = "CI實作會員系統";
		$this->load->view('main/header', $data);
		$this->load->view('loginn/content',$data);
		$this->load->view('main/footer',$data);
	}

}	
