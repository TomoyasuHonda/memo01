<?php

require('function.php');

require('auth.php');

//====================================
//画面処理
//====================================
//post送信されていた場合
if(!empty($_POST)){
  //例外処理
  try{
    //DBへ接続
    $dbh = dbConnect();

    $sql1 = 'UPDATE users SET delete_flg = 1 WHERE id = :us_id';
    $sql2 = 'UPDATE contents SET delete_flg = 1 WHERE user_id = :us_id';

    $data = array(':us_id' => $_SESSION['user_id']);
    //クエリ実行
    $stmt1 = queryPost($dbh,$sql1,$data);
    $stmt2 = queryPost($dbh,$sql2,$data);

    //クエリ実行の場合
    if($stmt1 && $stmt2){
      //セッション削除
      session_destroy();
      header("Location: index.php");
    }else{
      $err_msg['common'] = MSG08;
    }
  }catch(Exception $e){
    $err_msg['common'] = MSG08;
  }
}

 ?>
<?php
$siteTitle = '退会';
$css = 'mypage.css';
require('head.php');
 ?>

 <body>

   <header>
     <i class="fas fa-fish"></i>
     <i class="fas fa-frog"></i>
     <i class="fas fa-otter"></i>
     <i class="fas fa-dove"></i>
     <i class="fas fa-cat"></i>
     <i class="fas fa-dragon"></i>
     <i class="fas fa-spider"></i>
     <a href="logout.php" id="">ログアウト</a>
     <a href="mypage.php" id="">マイページ</a>
   </header>

   <div class="form-cover">
     <form class="" action="" method="post">
       <h1 id="withdrawname">退会</h1>

       <div class="">
         <?php
         if(!empty($err_msg['common'])) echo $err_msg['common'];
          ?>
       </div>
       <div class="">
         <input type="submit" name="submit" value="退会する" class="withdraw-btn">
         <a href="mypage.php" id="back-btn">戻る</a>
       </div>
     </form>
   </div>






 </body>
