<?php

require('function.php');
//==================================================
//マイページ
//==================================================

//ログイン認証
require('auth.php');

//GETパラメータを取得
//------------------------------------
$content = (!empty($_GET['c_id'])) ? $_GET['c_id'] : '';
//DBから商品データを取得
$dbContentData = getContentList($content,$_SESSION['user_id']);


//削除処理開始
if(!empty($_POST)){
//POST送信されたデータを変数に格納
$submit00 = $_POST['submit00'];
$submit01 = $_POST['submit01'];
$submit02 = $_POST['submit02'];
$submit03 = $_POST['submit03'];
$submit04 = $_POST['submit04'];
$submit05 = $_POST['submit05'];
$submit06 = $_POST['submit06'];
$submit07 = $_POST['submit07'];
$submit08 = $_POST['submit08'];

try{
  $dbh = dbConnect();
  $sql = 'UPDATE contents SET delete_flg = 1 WHERE id = :id';
  if(!empty($submit00)){
    $data = array(':id'=>$_SESSION['content_id0']);
  }elseif(!empty($submit01)){
    $data = array(':id'=>$_SESSION['content_id1']);
  }elseif(!empty($submit02)){
    $data = array(':id'=>$_SESSION['content_id2']);
  }elseif(!empty($submit03)){
    $data = array(':id'=>$_SESSION['content_id3']);
  }elseif(!empty($submit04)){
    $data = array(':id'=>$_SESSION['content_id4']);
  }elseif(!empty($submit05)){
    $data = array(':id'=>$_SESSION['content_id5']);
  }elseif(!empty($submit06)){
    $data = array(':id'=>$_SESSION['content_id6']);
  }elseif(!empty($submit07)){
    $data = array(':id'=>$_SESSION['content_id7']);
  }elseif(!empty($submit08)){
    $data = array(':id'=>$_SESSION['content_id8']);
  }

  $stmt = queryPost($dbh, $sql, $data);
  if($stmt){
    header('Location: mypage.php');
  }else{
    $err_msg['common'] = MSG10;
  }
}catch(Exception $e){
  $err_msg['common'] = MSG10;
}


}
//=================================================-


//画面表示用データ取得
//==========================================
$u_id = $_SESSION['user_id'];
//print_r($u_id);
//echo print_r($_SESSION['user_id']);
//echo var_dump($u_id);
//DBからメモ内容を取得
$messageData = getMessageData($u_id);
//echo var_dump($messageData);
 ?>


 <?php
 //============ヘッド読み込み==================
 $siteTitle = 'マイページ';
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
    <a href="withdraw.php" id="draw-btn">退会する</a>
    <a href="logout.php" id="">ログアウト</a>
    <a href="text.php" id="">記録する</a>
  </header>

  <div class="contents">

    <h1>100DaysOfCode</h1>

    <?php if(!empty($err_msg['common'])) echo $err_msg['common'];?>


    <div class="black-cover">
      <div class="list-area">
        <p>??Days</p>
        <?php
        //print_r($messageData);
        if(!empty($messageData)):
          //foreach($messageData as $key => $val):
          ?>


　　　　　<form method="post" action="">
　　　　　
          <!-- DBの情報 -->
          <ul>

            <li>
              <input type="submit" name="submit00" value="削除"><i class="fas fa-trash-alt"></i>
              <div>
              <?php $_SESSION['content_id0'] = $messageData[0]['id']?>
              <?php echo $messageData[0]['day']?>Day
              <?php echo $messageData[0]['title']?>
              <span class="not_action"><?php echo $messageData[0]['content']?></span>
              </div>
            </li>

            <li>
              <?php if(!empty($messageData[1])):?>
                <input type="submit" name="submit01" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id1'] = $messageData[1]['id']?>
                <?php echo $messageData[1]['day']?>Day
                <?php echo $messageData[1]['title']?>
                <span class="not_action"><?php echo $messageData[1]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[2])):?>
                <input type="submit" name="submit02" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id2'] = $messageData[2]['id']?>
                <?php echo $messageData[2]['day']?>Day
                <?php echo $messageData[2]['title']?>
                <span class="not_action"><?php echo $messageData[2]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[3])):?>
                <input type="submit" name="submit03" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id3'] = $messageData[3]['id']?>
                <?php echo $messageData[3]['day']?>Day
                <?php echo $messageData[3]['title']?>
                <span class="not_action"><?php echo $messageData[3]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[4])):?>
                <input type="submit" name="submit04" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id4'] = $messageData[4]['id']?>
                <?php echo $messageData[4]['day']?>Day
                <?php echo $messageData[4]['title']?>
                <span class="not_action"><?php echo $messageData[4]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[5])):?>
                <input type="submit" name="submit05" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id5'] = $messageData[5]['id']?>
                <?php echo $messageData[5]['day']?>Day
                <?php echo $messageData[5]['title']?>
                <span class="not_action"><?php echo $messageData[5]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[6])):?>
                <input type="submit" name="submit06" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id6'] = $messageData[6]['id']?>
                <?php echo $messageData[6]['day']?>Day
                <?php echo $messageData[6]['title']?>
                <span class="not_action"><?php echo $messageData[6]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[7])):?>
                <input type="submit" name="submit07" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id7'] = $messageData[7]['id']?>
                <?php echo $messageData[7]['day']?>Day
                <?php echo $messageData[7]['title']?>
                <span class="not_action"><?php echo $messageData[7]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>

            <li>
              <?php if(!empty($messageData[8])):?>
                <input type="submit" name="submit08" value="削除"><i class="fas fa-trash-alt"></i>
                <div>
                <?php $_SESSION['content_id8'] = $messageData[8]['id']?>
                <?php echo $messageData[8]['day']?>Day
                <?php echo $messageData[8]['title']?>
                <span class="not_action"><?php echo $messageData[8]['content']?></span>
                </div>
                <?php
              endif;
                 ?>
            </li>




        </ul>

</form>



          <!--<div id="show"><?php //echo sanitize();?></div>-->

          <?php if(!empty($err_msg['common'])) echo $err_msg['common'];?>

          <?php
        endif;
           ?>
      </div>
    </div>



<!-- search-area-->
<form class="" action="" method="get">
  <div class="search-area">
    <p>検索</p>
    <select class="" name="c_id">
      <option value="0" <?php if(getMessageData('c_id',true) == 0){ echo 'selected'; } ?> >選択してください</option>
      <?php
        foreach($messageData as $key => $val){
      ?>

      <option value="<?php echo $val['day'] ?>" <?php if(getMessageData('c_id',true) == $val['day'] ){ echo 'selected';} ?>><?php echo $val['day']?></option>

      <?php
        }
       ?>
    </select>
  </div>
  <input type="submit" name="" value="検索" id='search_btn'>

</form>

<!--検索結果を表示-->
<div class="">
  <?php
        //sanitize(print_r($dbContentData));
        //echo sanitize($dbContentData[$content]['content']);
        //sanitize(print_r($content)); -> 日付がしっかりとGETパラメータになっている！
        //echo 'この選択した日付は'.$content.'です';
        foreach($dbContentData as $key => $val):
   ?>

   <div class="search_word">

          <div><?php if($content != 0){echo 'Title:'.$val['title'];} ?></div>
          <div><?php if($content != 0){echo '内容:'.$val['content'];} ?></div>
          <span><?php //echo $val['content'];?></span>

   </div>

   <?php
 endforeach;
    ?>
</div>



    <div class="">
      <i class="fas fa-pencil-alt"><a href="text.php" class="btn"></a></i>
    </div>

  </div>

  <?php
  //==============フッター読み込み============
  require('footer.php');
   ?>




</body>
