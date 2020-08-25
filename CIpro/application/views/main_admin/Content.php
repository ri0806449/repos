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
				<a class="waves-effect waves-light btn-large" id="want_to_reset_password" href="../setting/want_to_reset_password"><i class="material-icons right">edit</i>修改後台密碼</a>
			</div>	
			<div class="col s4">
				<a class="waves-effect waves-light btn-large" id="want_to_reset_password" href="../setting/add_user"><i class="material-icons right">edit</i>新增會員資料</a>
			</div>						
		</div>
	
			<!--以下以表格條列所有會員資料 -->
			<div class="row">
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
						<?php foreach ($user as $key => $value):?>
						<tr>
							<td>
								<span class="edit"><?= $user[$key]['username'];  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $user[$key]['id']  ?>' data-field= 'username' id= 'nametxt_<?= $user[$key]['id'] ?>' value= '<?= $user[$key]['username'] ?>'>
							</td>
							<td>
								<span class="edit"><?= $user[$key]['email'];  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $user[$key]['id']  ?>' data-field= 'email' id= 'nametxt_<?= $user[$key]['id'] ?>' value= '<?= $user[$key]['email'] ?>'>
							</td>
							<td>
								<span class="edit">
								<?php 
								if ($user[$key]['gender'] == 0){
									echo "女孩紙";
									}
								elseif($user[$key]['gender'] == 1){
									echo "男孩紙";
									}	
								?>
								</span>
								<input type="text" class="txtedit" data-id= '<?= $user[$key]['id']  ?>' data-field= 'gender' id= 'nametxt_<?= $user[$key]['id'] ?>' value= '<?= $user[$key]['gender'] ?>'>
							</td>
							<td>
								<span class="edit"><?= $user[$key]['hobby'];  ?></span>
								<input type="text" class="txtedit" data-id= '<?= $user[$key]['id']  ?>' data-field= 'hobby' id= 'nametxt_<?= $user[$key]['id'] ?>' value= '<?= $user[$key]['hobby'] ?>'>
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
			<div class="row">
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
	