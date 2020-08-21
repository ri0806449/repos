<body>
  <header>
    <div class="row">
      <div class="col s9">
        <h4 class="center">後台登入資訊</h4>
      </div>
    </div>
  </header>
  <main>
    <?php
      //這部分是登出成功時會跳出的訊息
      if (isset($logout_message)) {
      echo "<div class='message'>";
      echo $logout_message;
      echo "</div>";
      }
      ?>

        <div class="container">
          <div class="row">

          <!--使用者登入填寫欄位-->
          <?php 
            $attributes = array('class' => 'col s5 offset-s3 login');
            echo form_open('user_authentication_admin/user_login_process',$attributes);
          ?>
          <?php
            echo "<div class='error_msg'>";
            if (isset($error_message)) {
            echo $error_message;
            }
            echo "</div>";
          ?>
             <div class="message">
                <?php 
                  if (isset($inform_message)) {
                    echo $inform_message;            
                  }
                ?>
              </div>
              <div class="row">
                    <span class="helper-text reg_error" data-error="wrong" data-success="">            
                      <?php
                        if (isset($message_display)) {
                        echo $message_display;
                        }
                      ?>
                    </span>
                  <div class="input-field col s12">
                    <input id="login_admin_username" type="text" class="validate" name="login_admin_username" value="<?= set_value('login_admin_username') ?>" autofocus>
                    <label for="login_admin_username">帳號</label>
                    <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('login_admin_username'); ?></span>
                  </div>
                </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="login_admin_password" type="password" class="validate" name ="login_admin_password" value="<?= set_value('login_admin_password')  ?>" >
                  <label for="login_admin_password">密碼</label>
                  <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('login_admin_password'); ?></span>
                  <a href="<?= base_url() ?>index.php/user_authentication_admin/forgot_password">忘記密碼？</a>
                </div>
              </div>
              <button class="btn waves-effect waves-light btn-large" type="submit" name="action">登入
                <i class="material-icons right">send</i>
              </button>
            </form>
          </div>
        </div>

  </main>


