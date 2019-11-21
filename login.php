<?php
require('function.php');
//==========================================
//ログイン画面
//==========================================

//post送信後
if(!empty($_POST)){

  //変数に値を代入
  $email = $_POST['email'];
  $pass = $_POST['pass'];

  //バリデーションチェック
  //未入力チェック
  validRequire($email, 'email');
  validRequire($pass, 'pass');

  if(empty($err_msg)){
    //形式チェック
    validEmail($email, 'email');
    validHalf($pass, 'pass');

    if(empty($err_msg)){
      //バリデーションok
      //フォームの入力内容とDBの値を照合
      try{
        $dbh = dbConnect();
        $sql = 'SELECT password, id FROM users WHERE email = :email AND delete_flg = 0';
        $data = array(':email'=>$email);
        //SQL実行
        $stmt = queryPost($dbh, $sql, $data);
        //実行結果を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!empty($result) && password_verify($pass, array_shift($result))){
          //パスワード照合OK

          //セッションに中身を詰める
          $_SESSION['user_id'] = $result['id'];
          $_SESSION['login_date'] = time();
          $_SESSION['login_limit'] = 60*60*24*30;

          //マイページへ遷移
          header("Location: mypage.php");
        }else{
          $err_msg['common'] = MSG09;
        }
      }catch(Exception $e){
        $err_msg['common'] = MSG08;
      }
    }
  }

}

 ?>

 <?php
 $siteTitle = 'ログイン';
 $css = 'main.css';
 require('head.php');
 ?>
<body>
  <?php
  $a1 = '新規登録';
  $a2 = 'ホーム';
  $s1 = 'signup';
  $s2 = 'index';
  require('header.php');
   ?>

  <h1>ログイン</h1>
  <div class="form-all">
    <form class="" action="" method="post">

      <div class="err">
        <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>
      </div>

  <div class="form form1">
    <label>Email：
      <input type="text" name="email" value="">
    </label>
    <div class="err">
      <?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?>
    </div>
  </div>

  <div class="form form4">
    <label id="center-form5">パスワード：
      <input type="password" name="pass" value="">
    </label>
    <div class="err">
      <?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?>
    </div>
  </div>

  <div class="btn_signup">
    <input type="submit" name="submit" value="ログインする">
  </div>
</form>
</div>

<div class="footer-login">
  <?php
  require('footer.php');
   ?>
</div>

</body>
