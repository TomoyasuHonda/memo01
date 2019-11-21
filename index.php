<!DOCTYPE html>
<html lang="ja">
<?php
$siteTitle = 'スタート';
$css = 'main.css';
require('head.php');
?>
 <body>
   <?php
   $a1 = '新規登録';
   $a2 = 'ログイン';
   $s1 = 'signup';
   $s2 = 'login';
   require('header.php');
    ?>

   <div class="content">

       <h1>100DaysOfCodeサポート<i class="fas fa-walking"></i></h1>

       <div class="desc">
         こちらのサービスとは、日々の成長過程を記録していけるサービスになります。<br>ぜひ、このサービスを活用して大いなる成長を遂げてください！！
       </div>

         <div class="btn">
           <div class="start-btn">
             <a href="login.php" id="start-a">開始する</a>
           </div>
           <div class="signup-btn">
             <a href="signup.php" id="signup-a">新規登録はこちら</a>
           </div>
         </div>

    </div>

    <?php
    require('footer.php');
     ?>

 </body>
