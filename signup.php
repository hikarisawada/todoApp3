<?php


require_once('config.php');


// 新規登録ボタン押したら
if (isset($_POST['signup'])) {
  if (empty($_POST['email'])) {
    echo 'emailが未入力です。';
  }else if (empty($_POST['password'])) {
    echo 'パスワードが未入力です。';
  }
// メアドもパスワードも入ってたら

// TODO 出来るだけ簡単に書く
// 
  if (empty($_POST['email']) || empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // DBに繋いで、
    $dbh = db_connect();

    $query = $dbh->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch();

    if ($result > 0) {
      echo 'このメールアドレスは既に登録されています';

    } else {
      // sql、「:email」の部分？で書くこともできるらしい
      $sql = 'insert into users (email, password) values(:email, :password)';
      $stmt = $dbh->prepare($sql);
      $password = password_hash($password, PASSWORD_DEFAULT);
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->bindValue(':password', $password, PDO::PARAM_STR);
      $stmt->execute();
      // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
      $userid = $dbh->lastinsertid();
      // 新規登録からログインページにリダイレクト
      header('Location:  login.php');
      echo '登録しました！';
    }




  }
}


 ?>

 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Sign Up!</title>
     <link rel="stylesheet" href="styles.css">
   </head>
   <body>
     <form action="" method="post">
       <div>
         <label>メールアドレス</label>
         <input type="email" name="email" value="" placeholder="info@sample.com">
       </div>
       <div>
         <label>パスワード</label>
         <input type="password" name="password" value="">
       </div>
       <div>
         <input type="submit" name="signup" value="新規登録する">
       </div>
       <div>
         <a href="/login.php">ログインはこちらから</a>
       </div>
       <!-- <a href="/login.php">ログイン</a> -->
     </form>
   </body>
 </html>
