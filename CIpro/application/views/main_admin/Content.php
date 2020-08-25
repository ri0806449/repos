<body>
	<header>
		<h1>
			後台——會員資料總覽
		</h1>	
	</header>
	<main>
		<div class='error_msg'>
			<?php 
		          if (isset($message_display)) {
		          echo $message_display;
		          }
			 ?>
		</div>
		<div class="row">
			<div class="col s2">
				<a class="waves-effect waves-light btn-large" id="want_to_reset_password" href="http://[::1]/repos/CIpro/index.php/admin/setting/want_to_reset_password"><i class="material-icons right">edit</i>修改後台密碼</a>
			</div>	
			<div class="col s4">
				<a class="waves-effect waves-light btn-large" id="want_to_reset_password" href="http://[::1]/repos/CIpro/index.php/admin/setting/add_user"><i class="material-icons right">edit</i>新增會員資料</a>
			</div>
			<div class="row">
				<div class="col s3 search_stuff">
					搜尋帳號欄：<input type="text" name="search_stuff" placeholder="打點什麼吧～" id="search_stuff">
				</div>
			</div>						
		</div>
			
			<!--以下以表格條列搜尋之會員資料 -->
			<div class="row search_table">
				<div class="col s9 offset-s1">
					<table class="centered highlight">
						<thead>
						<tr>
							<th>帳號</th>
							<th>email</th>
							<th>性別</th>
							<th>興趣</th>
							<th>刪除</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($user_page as $res):?>
						<tr>
							<td>
								<!-- <span class="edit"><?= $res->username;  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'username' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->username ?>'> -->
							</td>
							<td>
								<!-- <span class="edit"><?= $res->email;  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'email' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->email ?>'> -->
							</td>
							<td>
								<!-- <span class="edit">
								<?php 
								if ($res->gender == 0){
									echo "女孩紙";
									}
								elseif($res->gender == 1){
									echo "男孩紙";
									}	
								?>
								</span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'gender' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->gender ?>'> -->
							</td>
							<td>
								<!-- <span class="edit"><?= $res->hobby;  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'hobby' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->hobby ?>'> -->
							</td>
							<td>
								<div class="row">
									<div class="col s12">
										<!-- <a class="waves-effect waves-light btn-large delete_user red lighten-3" data-id= '<?= $user[$key]['id']  ?>'><i class="material-icons right">delete</i>刪除</a> -->
									</div>		
								</div>								
							</td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>

			<!--以下以表格條列所有會員資料 -->
			<div class="row all_table">
				<div class="col s9 offset-s1">
					<table class="centered highlight">
						<thead>
						<tr>
							<th>帳號</th>
							<th>email</th>
							<th>性別</th>
							<th>興趣</th>
							<th>刪除</th>
						</tr>
						</thead>
						<tbody>
						<?php foreach ($user_page as $res):?>
						<tr>
							<td>
								<span class="edit"><?= $res->username;  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'username' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->username ?>'>
							</td>
							<td>
								<span class="edit"><?= $res->email;  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'email' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->email ?>'>
							</td>
							<td>
								<span class="edit">
								<?php 
								if ($res->gender == 0){
									echo "女孩紙";
									}
								elseif($res->gender == 1){
									echo "男孩紙";
									}	
								?>
								</span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'gender' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->gender ?>'>
							</td>
							<td>
								<span class="edit"><?= $res->hobby;  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $res->id  ?>' data-field= 'hobby' id= 'nametxt_<?= $res->id ?>' value= '<?= $res->hobby ?>'>
							</td>
							<td>
								<div class="row">
									<div class="col s12">
										<a class="waves-effect waves-light btn-large delete_user red lighten-3" data-id= '<?= $user[$key]['id']  ?>'><i class="material-icons right">delete</i>刪除</a>
									</div>		
								</div>								
							</td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row all_table">
				<div class="col s3 offset-s5">
					<div><?php echo $links; ?></div>
				</div>
			</div>
			<div class="row">
				<div class="col s12 center">
					<a class="waves-effect waves-light btn-large user_logout" id="logout_admin" href="../loginn/logout_admin"><i class="material-icons right">cloud</i>登出</a>
				</div>
			</div>
	</main>
	