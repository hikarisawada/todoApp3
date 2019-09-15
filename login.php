<?php

require_once('config.php');
// セッションを持たせとく

// $_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
// $token = $_SESSION['token'];


// 既にログインしている場合にはプロフィールに遷移
if (isset($_SESSION["USERID"])) {
header('Location: profile.php');
exit;
}





// エラーメッセージの初期化
$error_message = "";

// ログインぽたんが押された時
if (isset($_POST['login'])) {
  // 空だったらエラー出す
  if (empty($_POST['email'])) {
    $error_message = 'メールアドレスが記入されていません。';
  } elseif (empty($_POST["password"])) {
    $error_message = 'パスワードが記入されていません。';
  }
   // 空じゃなかったら
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = h($_POST['email']);

  // DBに繋いで、
  try {
    $dbh = db_connect();

    // sql、「:email」の部分？で書くこともできるらしい
    $sql = 'select * from users where email = :email';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    // $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
    // $userid = $dbh->lastinsertid();

  } catch (\Exception $e) {
    echo $e->getMessage();
  }

  // 新規登録からログインページにリダイレクト
    $password = $_POST["password"];
    // var_dump($row['password']);

    if (!isset($row['email'])) {
      echo 'メールアドレスまたはパスワードが間違っています1';
      return false;
    }

    if (password_verify($_POST['password'], $row['password']))   {
      session_regenerate_id(true);
      $_SESSION['email'] = $row['email'];
      $_SESSION['id'] = $row['id'];
      // $_SESSION['password'] = $row['password'];


      header('Location: profile.php');
    } else {
      // var_dump($_POST['password']);
      echo 'メールアドレスまたはパスワードが間違っています2';

      return false;
    }





  }
  // ユーザIDとパスワードが入力されていたら認証する
   // $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname'] );

   // try {
   //   $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
   //   // アドレス検索
   //   $stmt = $pdo->prepare('select * from users where email = ?' );
   //   $stmt->execute($_POST['email']);
   //   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   //
   // } catch (PDOException $e) {
   //   echo $e->getMessage();
   //   //$errorMessage = $sql;
   //   // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
   //   // echo $e->getMessage();
   // }



}




//
// if (!isset($_SERVER['email']) || !isset($_SERVER['password'])) {
//   echo "エラーだよ";
// }


// $email = $_POST['email'];
// $password = $_POST['password'];
//
// $sql = "insert into users (email, password) values ('$email', '$password')";
// $res = $pdo->query($sql);

 ?>




 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Log In!</title>
     <link rel="stylesheet" href="styles.css">
   </head>
   <body>
     <p><?php echo $error_message; ?></p>
     <form action="" method="post">
       <div>
         <label>メールアドレス</label>
         <input type="email" name="email" placeholder="info@sample.com" value="">
       </div>
       <div>
         <label>パスワード</label>
         <input type="password" name="password" value="">
       </div>
       <div>
         <input type="submit" name="login" value="ログイン！">
       </div>
       <div>
         <a href="/signup.php">新規登録はこちらから</a>
       </div>
       <!-- <a href="/login.php">ログイン</a> -->
     </form>
   </body>
 </html>
