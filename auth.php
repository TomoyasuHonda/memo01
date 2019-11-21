<?php
//==========================================================
//認証
//==========================================================


if(!empty($_SESSION['login_date'])){
  //ログイン済みユーザーです
  if($_SESSION['login_date'] + $_SESSION['login_limit'] < time()){
    //ログイン有効期限切れです
    //セッション変数を削除する
    session_destroy();
    //ログイン画面へ遷移
    header("Location:login.php");

  }else{

  //ログイン有効期限ないです
  $_SESSION['login_date'] = time();
  //マイページへ遷移させる
  if(basename($_SERVER['PHP_SELF']) === 'login.php'){
    header("Location:mypage.php");
  }
}
}else{
  //未ログインユーザーです
  //ログイン画面へ遷移する


    header("Location:login.php");
  

}


 ?>
