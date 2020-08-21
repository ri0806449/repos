<body>
	<header></header>
	<main>
		<div class="row">
			<?php 
				$attributes = array('class'=>'col s8 offset-s2 reg');
            	echo form_open('user_authentication_admin/forgot_password', $attributes);
			?>
				<fieldset>
					<legend><h5>忘記密碼——填寫註冊email</h5></legend>
				    <div class="input-field col s6">
				      <input id="verify_email" type="text" class="validate" name="verify_email" value="<?= set_value('verify_email'); ?>" autofocus>
				      <label for="verify_email">填寫註冊時所輸入之信箱</label>
				      <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('verify_email'); ?></span>
				      <span class="helper-text reg_error error_msg" data-error="wrong" data-success="">
			          	<?php
				            if (isset($error_message)) {
				            echo $error_message;
				            }
			          	?>
				      </span>
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
		</div>
	</main>


 
