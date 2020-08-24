<body>
	<header>
	</header>
	<main>
		<div class="row">
			<form class="col s10 offset-s1" method="post" action="add_user">
		         <div class='error_msg'>
			         <?php
			          //echo新增錯誤
			          if (isset($error_message)) {
			          echo $error_message;
			          }
			        ?>		         	
		         </div>		        
				<fieldset>
					<legend>
						<h4>後台——新增會員資料</h4>
					</legend>
					<div class="row">
						<div class="col s10 offset-s1">
							<table class="centered highlight">
								<thead>
								<tr>
									<th>帳號</th>
									<th>密碼</th>
									<th>確認密碼</th>
									<th width="250">email</th>
									<th>性別</th>
									<th width="200">興趣</th>
								</tr>
								</thead>
								<tbody>
								<tr>
									<td>
										<input type="text" name="username" value="<?= set_value('username'); ?>">
										<label>帳號</label>
                 					 	<span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('username'); ?></span>
									</td>
									<td>
										<input type="password" name="password" value="<?= set_value('password'); ?>">
										<label>密碼</label>
                 					 	<span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('password'); ?></span>
									</td>
									<td>
										<input type="password" name="password_retype" value="<?= set_value('password_retype'); ?>">
										<label>確認密碼</label>
                 					 	<span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('password_retype'); ?></span>
									</td>

									<td>
										<input type="text" name="email" value="<?= set_value('email'); ?>">
										<label>email</label>
                 					 	<span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('email'); ?></span>
									<td>
					                    <p>
					                      <label>
					                        <input name="gender" type="radio" value="1" checked>
					                        <span>男</span>
					                      </label>
					                    </p>
					                    <p>
					                      <label>
					                        <input name="gender" type="radio" value='0'>
					                        <span>女</span>
					                      </label>
					                    </p>
									</td>
									<td>
										<input type="text" name="hobby" value="<?= set_value('hobby'); ?>">
										<label>興趣</label>
                 					 	<span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('hobby'); ?></span>										
									</td>
								</tr>
								</tbody>
							</table>
						</div>
					</div>
	                <div class="row">
	                  <div class="col s3 offset-s9">
	                    <button class="btn-large waves-effect waves-light" type="submit" value="submit">
	                      送出
	                      <i class="material-icons right">check</i>
	                    </button>
	                  </div>
	                </div>  					
				</fieldset>				
			</form>
			<div class="row">
	            <div class="col s8 offset-s2">
	                <button class="btn-large waves-effect waves-light red lighten-3 return" id="user_login_process" onclick="location.href='index'">
	                  回上一頁
	                  <i class="material-icons right">keyboard_return</i>
	                </button>	
	          	</div>				
			</div>			
		</div>
	</main>
	