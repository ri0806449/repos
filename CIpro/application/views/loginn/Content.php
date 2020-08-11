<body>
    <div class="container">
      <div class="row">

      <!--使用者登入填寫欄位-->
      <?php 
        $attributes = array('class' => 'col s6 offset-s3 login');
        echo form_open('loginn',$attributes);
      ?>
      <form class="col s6 offset-s3 login">
          <div class="row">
            <h4>登入資訊</h4>
              <div class="input-field col s12">
                <input id="login_user_username" type="text" class="validate" name="login_user_username" value="<?= set_value('login_user_username') ?>" autofocus>
                <label for="username">帳號</label>
                <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('login_user_username'); ?></span>
              </div>
            </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="login_user_password" type="password" class="validate" name ="login_user_password" value="<?= set_value('login_user_password')  ?>" >
              <label for="password">密碼</label>
              <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('login_user_password'); ?></span>
            </div>
          </div>
          <button class="btn waves-effect waves-light btn-large" type="submit" name="action">登入
            <i class="material-icons right">send</i>
          </button>
          <br>
          <p style="text-align:left;">新使用者？ <a href="register">請註冊</a></p>
        </form>

        <!--管理者登入填寫欄位-->
        <form class="col s3 offset-s11 login">
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
