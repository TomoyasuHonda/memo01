<?php

require('function.php');


//=================================================================
//ログアウト
//=================================================================



//セッションを削除する
session_destroy();

//login画面へ遷移させる
header('Location: login.php');


 ?>