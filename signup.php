<?php

//関数を読み込み
require('function.php');

//=============================================
//ユーザー登録画面
//=============================================

//post送信後　
if(!empty($_POST)){

  //変数に送信内容を格納する
  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  $pass_re = $_POST['pass_re'];

  //バリデーションチェック
  //未入力チェック
  validRequire($name,'name');
  validRequire($email,'email');
  validRequire($pass,'pass');
  validRequire($pass_re,'pass_re');

  if(empty($err_msg)){
    //形式チェック
    validEmail($email,'email');
    validHalf($pass,'pass');
    validHalf($pass_re,'pass_re');
  }

  if(empty($err_msg)){
    //文字数チェック
    validMinLen($pass,'pass');
    validMaxLen($pass,'pass');
    validMinLen($pass_re,'pass_re');
    validMaxLen($pass_re,'pass_re');

    if(empty($err_msg)){
      //email重複チェック
      validEmailDup($email);

    //再入力一致チェック
    validEqule($pass,$pass_re,'pass');

    //バリデーション完了
    if(empty($err_msg)){
      try{
        $dbh = dbConnect();
        $sql = 'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)';
        $data = array(':username'=>$name,':email'=>$email,':password'=>password_hash($pass,PASSWORD_DEFAULT));
        $stmt = queryPost($dbh,$sql,$data);
        if($stmt){
          $_SESSION['login_date'] = time();
          $_SESSION['login_limit'] = 60*60;
          $_SESSION['user_id'] = $dbh->lastInsertID();
          header("Location: mypage.php");
        }
      }catch(Exception $e){
        $err_msg['common'] = MSG08;
      }
    }

  }
}
}
 ?>













 <?php
 $siteTitle = '新規登録';
 $css = 'main.css';
 require('head.php');
 ?>
<body>

  <?php
  $a1 = 'ホーム';
  $a2 = 'ログイン';
  $s1 = 'index';
  $s2 = 'login';
  require('header.php');
   ?>

  <h1>新規登録</h1>

  <div class="form-all">
    <form class="" action="" method="post">

  <div class="">
    <?php if(!empty($err_msg['common'])) echo $err_msg['common'];?>
  </div>

  <div class="form form1">
    <label id="center-form1">名前：
      <input type="text" name="name" value="<?php if(!empty($_POST['name'])) echo $_POST['name']?>">
    </label>
    <div class="err">
      <?php if(!empty($err_msg['name'])) echo $err_msg['name']; ?>
    </div>
  </div>

  <div class="form form2">
    <label id="center-form2">Email：
      <input type="text" name="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email']?>">
    </label>
    <div class="err">
      <?php if(!empty($err_msg['email'])) echo $err_msg['email']; ?>
    </div>
  </div>

  <div class="form form3">
    <label id="center-form3">パスワード：
      <input type="password" name="pass" value="<?php if(!empty($_POST['pass'])) echo $_POST['pass']?>">
    </label>
    <div class="err">
      <?php if(!empty($err_msg['pass'])) echo $err_msg['pass']; ?>
    </div>
  </div>

  <div class="form form4">
    <label id="center-form4">パスワード再入力：
      <input type="password" name="pass_re" value="<?php if(!empty($_POST['pass_re'])) echo $_POST['pass_re']?>">
    </label>
    <div class="err">
      <?php if(!empty($err_msg['pass_re'])) echo $err_msg['pass_re']; ?>
    </div>

    <div class="btn_signup">
      <input type="submit" value="登録する">
    </div>

  </div>
  </form>
  </div>

<div class="footer-signup">
  <?php
  require('footer.php');
   ?>
</div>

</body>
