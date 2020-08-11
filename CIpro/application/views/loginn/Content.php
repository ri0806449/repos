<body>

<?php
  //這兩部分應該就是登出與註冊成功（？）時會跳出的訊息了.....吧
  if (isset($logout_message)) {
  echo "<div class='message'>";
  echo $logout_message;
  echo "</div>";
  }
  ?>

<?php
  if (isset($message_display)) {
  echo "<div class='message'>";
  echo $message_display;
  echo "</div>";
  }
?>
    <div class="container">
      <div class="row">

      <!--使用者登入填寫欄位-->
      <?php 
        $attributes = array('class' => 'col s5 offset-s3 login');
        echo form_open('user_authentication/user_login_process',$attributes);
      ?>
      <?php
        //上面echo的不確定是哪來的錯誤訊息，下面echo的也不知道是哪來的提示訊息（不確定為什麼要放在這裡，等畫面出來後再來看看）      
        if (isset($logout_message)) {
        echo "<div class='message'>";
        echo $logout_message;
        echo "</div>";
        }
        ?>
        <?php
        if (isset($message_display)) {
        echo "<div class='message'>";
        echo $message_display;
        echo "</div>";
        }
      ?>
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
      </div>
    </div>
