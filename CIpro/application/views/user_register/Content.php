  <body>
    <div class="row">
      <!--把<form class="col s12 reg">換成form_open方式打開，產生 action 的時候， 是基於設定文件來產生 URL 的，這使得您的應用在更改 URL 時更具移植性-->
       <?php 
          $attributes = array('class'=>'col s12 reg');
          echo form_open('user_authentication/new_user_registration', $attributes); 
        ?>
       <?php
        //echo驗證錯誤（但不確定為什麼要放在這裡，等畫面出來後再來看看）
        echo "<div class='error_msg'>";
        if (isset($error_message)) {
        echo $error_message;
        }
        echo "</div>";
      ?>
        <fieldset>
          <legend><h4>註冊資訊</h4></legend>
          <!--帳號輸入-->
          <div class="row">
            <div class="col s10 offset-s1">
              <div class="input-field col s12">
                <input id="username" type="text" class="validate" name="username" value="<?= set_value('username'); ?>"><!-- set_value= 的是該欄位的name-->
                <label for="username">帳號</label>
                <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('username'); ?></span>
              </div>
              <!--密碼輸入-->
              <div class="input-field col s6">
                <input id="password" type="text" class="validate" name="password" value="<?= set_value('password'); ?>">
                <label for="password">密碼</label>
                <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('password'); ?></span>
              </div>
              <!--確認密碼輸入-->
              <div class="input-field col s6">
                <input id="password_retype" type="text" class="validate" name="password_retype" value="<?= set_value('password_retype'); ?>">
                <label for="password_retype">再輸入一次密碼</label>
                <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('password_retype'); ?></span>
              </div>
              <div class="row">
              <!--信箱輸入-->                
                <div class="input-field col s6">
                  <input id="email" type="text" class="validate" name="email" value="<?= set_value('email'); ?>">
                  <label for="email">信箱</label>
                  <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('email'); ?></span>
                </div>
                <!--性別輸入-->
                <div class="input-field col s3 offset-s1">
                  <h6>性別</h6>
                  <p>
                    <label>
                      <input name="gender" type="radio" value="1" checked />
                      <span>男</span>
                    </label>
                  </p>
                  <p>
                    <label>
                      <input name="gender" type="radio" value='0' />
                      <span>女</span>
                    </label>
                  </p>
                </div>                    
              </div>                
              <!--興趣輸入-->
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="hobby" class="materialize-textarea" name="hobby" value="<?= set_value('hobby'); ?>"></textarea>
                  <label for="hobby">興趣</label>
                  <span class="helper-text reg_error" data-error="wrong" data-success=""><?= form_error('hobby'); ?></span>
                </div>
              </div>
              <div class="row">
                <div class="col s12 offset-s4">
                  <button class="btn-large waves-effect waves-light" type="submit" value="submit">
                    送出
                    <i class="material-icons right">check</i>
                  </button>
                </div>
              </div>              
            </div>
          </div>
        </fieldset>
      </form>
    </div>