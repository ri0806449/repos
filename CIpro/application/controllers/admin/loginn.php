<?php 
//創造一個session
//session_start();當已經$this->load->library('session') 這一行就幫你做好session_start的動作了
class Loginn extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//載入表單輔助函式
		$this->load->helper(array('form','url', 'file'));
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

	//CSV檔案轉陣列
	public function csv_turn()
	{
		$filename = __dir__ . '/../../libraries/lottery.csv';

		/*$fp = fopen($filename, 'r');
		$data = fgetcsv($fp, 1000, ",");
		$data = mb_convert_encoding($data, "UTF-8", "GBK");
		fclose($fp);*/

		//$handle = fopen($filename, 'r');
		//$contents = fread($handle, filesize($filename));
		$csv = array_map('str_getcsv', file($filename));
		//$csv = mb_convert_encoding($csv, "UTF-8", "GBK");
		//fclose($handle);
		//$csv = array_map('str_getcsv', file('libraries/lion.csv'));
/*		$fp = fopen('lion.csv', 'r');
		while (($data = fgetcsv($fp, 1000, ",")) !==FALSE) {
			$mmid = $data[0];
			$response = $data[1];
			$contentt = $data[2];
		};
		var_dump($data);*/		
		if ( isset($csv) and ! empty($csv) ) {
			echo '成功'. '<br>';
			foreach ($csv as $key => $value) {
				$num = $key+1;
				if($num >= 2){
					$num = '<br>' . $num;
				}
				echo $num . " . " . '<br>' . "mmid：" . $value[0] . '<br>';
				echo "暱稱：" . $value[1] . '<br>';
				echo "訊息：" . $value[2] . '<br>';
			}
		}else{
			echo '係敗啊';
		}
	}

	//寄送簡訊
    public function send_sms() {

        //$post = $this->input->post();

        $failure_mmid = [];
        $success_mmid = [];
    
        foreach ($post as $k => $v) {
            if (!isset($v['mmid']) || empty($v['mmid'])) {
                $this->out_put('no mmid');
                return;
            }

            $var = $this->mb_member->find_member_phone($v['mmid']);
            $v['mobile'] = $var['mobile'];
            if (!isset($v['mobile']) || empty($v['mobile'])) {
                $this->out_put('no mobile');
                return;
            }
            if (strlen($v['mobile']) != 10) {
                $this->out_put('mobile format error(length not equal 10)');
                return;
            }
            if (!preg_match("/(09)+[\\d]{8}/", $v['mobile'])) {
                $this->out_put('mobile format error');
                return;
            }
            if (!isset($v['content']) || empty($v['content'])) {
                $this->out_put('no content');
                return;
            }

            $mmid = $v['mmid'];
            $mobile = $v['mobile'];
            $content = $v['content'];
            $oid = 0;
            $type = 0;

            if (isset($v['oid']) && !empty($v['oid'])) {
                $oid = $v['oid'];
            }
            if (isset($v['type']) && !empty($v['type'])) {
                $type = $v['type'];
            }

            $insert_data = array(
                'mmid' => $mmid,
                'oid' => $oid,
                'type' => $type,
                'mobile' => $mobile,
                'content' => $this->convert_to_big5($content),
                'status' => 0,
                'create_date' => date("Y-m-d H:i:s"),
                'sms_id' => 0,
                'error_code' => '',
                'info_data' => '',
                'response_status' => '',
                'response_data' => '',
                'send_date' => '0000-00-00 00:00:00'
            );

            if ($this->tbl_smsqueue_log->insert_data($insert_data)) {
                array_push($success_mmid, $v['mmid']);
                //$this->out_put(null, 'send success');
            } else {
                array_push($failure_mmid, $v['mmid']);
                //$this->out_put('send error,insert fail');
            }
        }
        echo "成功傳送帳號包含：";
        print_r($success_mmid);
        echo "失敗傳送帳號包含：";
        print_r($failure_mmid);


    }

	public function taggg()
	{
		$content = "<a href='https://www.google.com.tw'><拿的到嗎～～></a><a href='https://www.google.com.tw'>拿的到嗎～～</a>";
		$pattern = "/<[^<>]*>/";
		preg_match_all($pattern, $content, $matches);
		$content_get_tags =  implode(" ", $matches[0]);
		$content_without_tags = strip_tags($content);
		$new_content    = $content_get_tags . $content_without_tags;
		var_dump($new_content);		
	}



	//確定function裡面放運算子的用意，即預設值
	public function au()
	{	
		$cache_name = "afu";
		$function_name = "fun";

		$b = $this->admin_model->try($cache_name,$function_name);
		var_dump($b);

	} 

	//確定function裡面放運算子的用意，即預設值
	public function aa($time = 33120)
	{	
		//$time = 20;
		$time = $time + 80;
		echo $time;

	}

   
	//strtotime感覺是好東西
	public function ff()
	{
/*		$target_time = strtotime('-5 minutes -180 seconds');
		$minus = (strtotime('now') - $target_time)/60;
		//即顯示設定的時間差（分鐘）
		echo $minus;*/
        //明天午夜12點
        $tomorrow = strtotime('tomorrow', time());
        //後天午夜12點
        $after_tomorrow = strtotime('+1 day', $tomorrow);
        //昨天午夜12點
        $yesterday = strtotime('yesterday', time());
        //前天午夜12點
        $befor_yesterday = strtotime('-1 day', $yesterday); 
        $c_time = '今天 22:00';
		echo (strpos($c_time, '2')) ? 'stream-time-today':'';
        //echo $today_midnight = date('Y/m/d H:i:s', strtotime('midnight', time()));

		$time_day = '2020-12-31 20:20';
		$c = strtotime('tomorrow', strtotime($time_day));
		$a = date('d', strtotime($time_day));
		$b = date('Y/m/d H:i', $c);
		//echo $b;
		//echo $a;
		$minus_day =  date('d') - $a;
		//echo $minus_day;
		/*echo cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
		echo date('Y-m-d');*/
	}

	//str_replace試一下
	public function pp()
	{
		$foo = 'fucking good!';
		$foo_clean = str_replace('u', 'x', $foo);
		echo $foo_clean;
	}



	//試試htmlspecialchars_decode
	public function ee()
	{
		$str = "<p>this -&gt; &quot;</p>\n";

		echo htmlspecialchars_decode($str);

		// note that here the quotes aren't converted
		echo htmlspecialchars_decode($str, ENT_NOQUOTES);
	}

	//試試array_slice
	public function ss()
	{
		$foo = ['pie','pie1','pie2','pie3','pie4'];
		print_r(array_slice($foo, 1, 5));
	}

	//對於驚嘆號的運用，還是感到滿滿的驚嘆號（還有問號）
	public function tt()
	{

		$a = 8;
		$b = 4;
		if (!$a = $b+5) {
			echo "Yes";
		}else{
			echo "No";
		}
		
	}

	//只是試試看
	public function ww()
	{
		$b = $this->admin_model->try("ccwsdu");
		var_dump($b);		
	}

	function bar($arg = '')
	{
	    echo "In bar(); argument was $arg.<br />\n";
	}	

	//登入主頁的相關資訊
	public function index()
	{	
		if(isset($this->session->userdata['logged_in_admin'])){
			$config['base_url'] = 'http://localhost/repos/CIpro/index.php/admin/loginn/index';
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
