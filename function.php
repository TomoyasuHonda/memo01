<?php




//==============================================
//センション
//==============================================

//=========================
//セッションの有効期限を延ばす
//1.セッションファイルの置き場所を変更する
session_save_path("/var/tmp/");
//2.ガーベージコレクションが削除するセッションの有効期限を設定
ini_set('session.gc_maxlifetime', 60*60*24*30);
//3.クッキー自体の有効期限も延ばす
ini_set('session.cookie_lifetime', 60*60*24*30);
//セッションを使う
session_start();
//セッションidを作り直す
session_regenerate_id();


//===============================================
//エラー内容を変数に格納
//===============================================
define('MSG01','値を入力してください');
define('MSG02',' Email形式で入力してください');
define('MSG03','半角で入力してください');
define('MSG04','6文字以上で入力してください');
define('MSG05','256文字以下で入力してください');
define('MSG06','パスワード再入力と値が一致していません');
define('MSG07','そのEmailはすでに登録されています');
define('MSG08','エラーが発生しました。しばらく経ってからご使用ください。');
define('MSG09','Emailまたはパスワードが正しくありません');
define('MSG10','削除失敗しました');
//==============================================
//バリデーションチェック
//==============================================

$gc_msg = array();
//未入力チェック
$err_msg = array();
function validRequire($str,$key){
  global $err_msg;
  if(empty($str)){
    $err_msg[$key] = MSG01;
  }
}
//Email形式チェック
function validEmail($str,$key){
  global $err_msg;
  if(!preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$str)){
    $err_msg[$key] = MSG02;
  }
}
//半角チェック
function validHalf($str,$key){
  global $err_msg;
  if(!preg_match("/^[a-zA-Z0-9]+$/",$str)){
    $err_msg[$key] = MSG03;
  }
}
//最小文字数チェック
function validMinLen($str,$key){
  global $err_msg;
  if(mb_strlen($str) < 6){
    $err_msg[$key] = MSG04;
  }
}
//最大文字数チェック
function validMaxLen($str,$key){
  global $err_msg;
  if(mb_strlen($str) > 255){
    $err_msg[$key] = MSG05;
  }
}
//再入力一致チェック
function validEqule($str1,$str2,$key){
  global $err_msg;
  if($str1 !== $str2){
    $err_msg[$key] = MSG06;
  }
}
//Email重複
function validEmailDup($email){
  global $err_msg;
  try{
    $dbh = dbConnect();
    $sql = 'SELECT (*) FROM users WHERE email = :email AND delete_flg = 0';
    $data = array(':email'=>$email);
    $stmt = queryPost($dbh, $sql, $data);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($result)){
      $err_msg['common'] = MSG07;
    }
  }catch(Exception $e){

    $err_msg['common'] = MSG08;
  }
}

//===============================================
//DB接続
//===============================================
function dbConnect(){
  $dsn = 'mysql:dbname=diary;host=localhost;charset=utf8';
  $user = 'root';
  $password = 'root';
  $options = array(
    // SQL実行失敗時にはエラーコードのみ設定
    PDO::ATTR_ERRMODE => PDO::ERRMODE_SILENT,
    // デフォルトフェッチモードを連想配列形式に設定
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // バッファードクエリを使う(一度に結果セットをすべて取得し、サーバー負荷を軽減)
    // SELECTで得た結果に対してもrowCountメソッドを使えるようにする
    PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
  );
  //PDOオブジェクト生成(DBへ接続)
  $dbh = new PDO($dsn, $user, $password, $options);
  return $dbh;
}

//=================================================
//SQL実行
//=================================================
function queryPost($dbh, $sql, $data){
  //クエリー作成
  $stmt = $dbh->prepare($sql);
  //プレースホルダに値をセットし、SQL文を実行
  $stmt->execute($data);
  return $stmt;
}

function getMessageData($u_id){
  try{
    $dbh = dbConnect();
    $sql = 'SELECT id,title,content,day FROM contents WHERE user_id = :u_id AND delete_flg = 0 ORDER BY day DESC';
    $data = array(':u_id'=>$u_id);
    $stmt = queryPost($dbh, $sql, $data);
    if($stmt){
      return $stmt->fetchAll();
    }else{
      return false;
    }
  }catch(Exception $e){
    $err_msg['common'] = MSG08;

  }
}

// サニタイズ
function sanitize($str){
  return htmlspecialchars($str,ENT_QUOTES);
}

function getContentList($content,$u_id){
  //try{
    $dbh = dbConnect();
    $sql = 'SELECT id,title,content,day FROM contents WHERE user_id = :u_id AND delete_flg = 0 ';
    //if(!empty($content) && $content == 0) $sql .= '';
    if(!empty($content)) $sql .= 'AND day = '.$content;
    $data = array(':u_id'=>$u_id);
    $stmt = queryPost($dbh, $sql, $data);
    if($stmt){
      return $stmt->fetchAll();
    }else{
      return false;
    }

  //}
}



 ?>
