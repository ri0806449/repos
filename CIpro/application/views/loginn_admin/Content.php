<body>
    <div class="container">
      <div class="row">
      
      <!--管理者登入填寫欄位-->
      <?php 
        $attributes = array('class' => 'col s6 offset-s3 login');
        echo form_open('loginn_admin',$attributes);
      ?>
          <div class="row">
            <h6>管理者登入資訊</h6>
              <div class="input-field col">
                <input id="login_admin_username" type="text" class="validate" name ="login_admin_username" value="<?= set_value('login_admin_username')  ?>" >
                <label for="admin_username">帳號</label>
                <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('login_admin_username'); ?></span>
              </div>
            </div>
          <div class="row">
            <div class="input-field col">
              <input id="login_admin_password" type="password" class="validate" name="login_admin_password" value="<?= set_value('login_admin_password')  ?>" >
              <label for="admin_password">密碼</label>
              <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('login_admin_password'); ?></span>
            </div>
          </div>
          <button class="btn waves-effect waves-light" type="submit" name="action">登入
            <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
