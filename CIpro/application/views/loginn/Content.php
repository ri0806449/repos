<body>
    <div class="container">
      <div class="row">

      <!--使用者登入填寫欄位-->
        <form class="col s6 offset-s3 login">
          <div class="row">
            <h4>登入資訊</h4>
              <div class="input-field col s12">
                <input id="username" type="text" class="validate" autofocus required>
                <label for="username">帳號</label>
              </div>
            </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="password" type="password" class="validate" required>
              <label for="password">密碼</label>
            </div>
          </div>
          <button class="btn waves-effect waves-light btn-large" type="submit" name="action">登入
            <i class="material-icons right">send</i>
          </button>
          <br>
          <p style="text-align:left;">新使用者？ <a href="register.php">請註冊</a></p>
        </form>

        <!--管理者登入填寫欄位-->
        <form class="col s3 offset-s11 login">
          <div class="row">
            <h6>管理者登入資訊</h6>
              <div class="input-field col">
                <input id="admin_username" type="text" class="validate" required>
                <label for="admin_username">帳號</label>
              </div>
            </div>
          <div class="row">
            <div class="input-field col">
              <input id="admin_password" type="password" class="validate" required>
              <label for="admin_password">密碼</label>
            </div>
          </div>
          <button class="btn waves-effect waves-light" type="submit" name="action">登入
            <i class="material-icons right">send</i>
          </button>
        </form>
      </div>
    </div>
