<body>
	<header></header>
	<main>
		<div class="row">
			<?php 
				$attributes = array('class'=>'col s8 offset-s2 reg');
            	echo form_open("user_authentication_admin/want_to_reset_password", $attributes);
			?>
				<fieldset>
					<legend><h5>忘記密碼——重新設定密碼</h5></legend>
	                <!--密碼輸入-->
	                <div class="input-field col s6">
	                  <input id="reset_password" type="password" class="validate" name="reset_password" value="<?= set_value('reset_password'); ?>" autofocus>
	                  <label for="reset_password">設定新密碼</label>
	                  <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('reset_password'); ?></span>
	                </div>
	                <!--確認密碼輸入-->
	                <div class="input-field col s6">
	                  <input id="reset_password_retype" type="password" class="validate" name="reset_password_retype" value="<?= set_value('reset_password_retype'); ?>">
	                  <label for="reset_password_retype">再輸入一次密碼</label>
	                  <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('reset_password_retype'); ?></span>
	                </div>
	                <div class="row">
	                  <div class="col s12 offset-s8">
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
	                <button class="btn-large waves-effect waves-light red lighten-3 return" id="user_login_process" href="user_login_process">
	                  回上一頁
	                  <i class="material-icons right">keyboard_return</i>
	                </button>	
	          	</div>				
			</div>
		</div>
	</main>


 
