<?php 
	$config = array
	(	
		'register' => array
		(
			array
			(
				'field' => 'username',//帳號的value：（需要去）view的對應輸入input去set_values()
				'label' => '帳號',//出現錯誤訊息時的該欄位稱呼
				'rules' => 'trim|required|min_length[4]|max_length[16]|is_unique[user.username]|callback_username_check',//驗證規則（trim會去掉前後之空白），最後一個是自訂的回調函數
				'errors' => //錯誤時應該跳出來的訊息
				array(
					'required' => '你有漏喔（帳號）',
					'is_unique' => '你帳號跟別人重複囉',
					'min_length' => '你太短了（帳號）',
					'max_length' => '你太長了！（帳號）'
				),
			),
			array
			(
				'field' => 'password',
				'label' => '密碼',
				'rules' => 'trim|required|min_length[4]|max_length[16]',
				'errors' => //錯誤時應該跳出來的訊息
				array(
					'required' => '你有漏喔（密碼）',
					'min_length' => '你太短了（密碼）',
					'max_length' => '你太長了！（密碼）'
				)
			),
			array
			(
				'field' => 'password_retype',
				'label' => '密碼確認',
				'rules' => 'trim|required|matches[password]',
				'errors' => 
				array(
					'matches' => '確認密碼與原密碼不相符',
					'required' => '你有漏喔（密碼確認）',
					'min_length' => '你太短了（密碼確認）',
					'max_length' => '你太長了！（密碼確認）'
				)
			),
			array
			(
				'field' => 'email',
				'label' => '信箱',
				'rules' => 'trim|required|valid_email',
				'errors' => 
				array(
					'valid_email' => '無效的信箱地址',
					'required' => '你有漏喔（信箱）'
				)
			),
			array
			(
				'field' => 'hobby',
				'label' => '興趣',
				'rules' => 'trim|required',
				'errors' => 
				array(
					'required' => '你有漏喔（興趣）'
				)
			),
		),
		'login_user' => array
		(
			array
			(
				'field' => 'login_user_username',
				'label' => '使用者帳號',
				'rules' => 'trim|required',
				'errors' => 
				array
				(
					'required' => '您貴人多忘事，忘記填帳號囉～',
				
				)
			),
			array
			(
				'field' => 'login_user_password',
				'label' => '使用者密碼',
				'rules' => 'trim|required',
				'errors' => 
				array
				(
					'required' => '您貴人多忘事，忘記填密碼囉～',
				)
			),
		),
		'login_admin' => array
		(
			array
			(
				'field' => 'login_admin_username',
				'label' => '管理者帳號',
				'rules' => 'trim|required',
				'errors' => 
				array
				(
					'required' => '您貴人多忘事，忘記填帳號囉～',
				)
			),
			array
			(
				'field' => 'login_admin_password',
				'label' => '管理者密碼',
				'rules' => 'trim|required',
				'errors' => 
				array
				(
					'required' => '您貴人多忘事，忘記填密碼囉～',
				)
			),
		)						
	);