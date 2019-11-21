<?php

//関数を読み込み
require('function.php');

require('auth.php');

//=============================================
//テキスト入力画面
//=============================================

if(!empty($_POST)){

  //変数に送信内容を格納
  $title = $_POST['title'];
  $text = $_POST['text'];
  $day = $_POST['day'];

  //バリデーションチェック
  validRequire($day,'day');
  validRequire($title, 'title');
  validRequire($text, 'text');

  //バリデーションチェックOKなら
  if(empty($err_msg)){

    try{
      $dbh = dbConnect();
      $sql = 'INSERT INTO contents (day, title, content, user_id)VALUES (:day, :title, :content, :user_id)';
      $data = array(':day'=>$day, ':title'=>$title, ':content'=>$text, ':user_id'=>$_SESSION['user_id']);
      $stmt = queryPost($dbh, $sql, $data);
      if(!empty($stmt)){
        //入力後マイページへ遷移させる
        header("Location: mypage.php");
      }

    }catch(Exception $e){
      $err_msg['common'] = MSG08;
    }
  }
}

?>





<?php
$css = 'text.css';
$siteTitle = '入力画面';
require('head.php');
?>
<body>

  <h1>🌸本日の進捗を記録しよう🌸</h1>

  <div class="contents">
    <form class="" action="" method="post">

      <?php if(!empty($err_msg['common'])) echo $err_msg['common']; ?>

      <div class="day-all-form">
        <label>What's Days：
          <input type="text" name="day" value="" id="width50">Day
        </label>
        <div class="err">
          <?php if(!empty($err_msg['day'])) echo $err_msg['day']; ?>
        </div>
      </div>


      <div class="title-all-form">
        <label>Title：
          <input type="text" name="title" value="" id="text">
        </label>
        <div class="err">
          <?php if(!empty($err_msg['title'])) echo $err_msg['title']; ?>
        </div>
      </div>

      <div class="text-all-form">

        <label>Text：
          <textarea name="text" rows="8" cols="80"></textarea>
        </label>
        <div class="err">
          <?php if(!empty($err_msg['text'])) echo $err_msg['text']; ?>
        </div>
      </div>

      <div class="">
        <a href="mypage.php" id="back-btn">戻る</a>
      </div>

      <div class="">
        <input type="submit" name="submit" value="送信" id="btn">
      </div>

    </form>
  </div>




</body>
