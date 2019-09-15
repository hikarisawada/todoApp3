<?php

require_once('config.php');

// $errors = array();


  try {
    $dbh = db_connect();

    $sql = 'select id, email, password from users where id = :id' ;
    $stmt = $dbh->prepare($sql);
    // $stmt->bindValue(':name', $folder, PDO::PARAM_STR);
    $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($_SESSION['id']);

    // header('Location: list.php');

  } catch (\Exception $e) {
    echo $e->getMessage();

  }



?>



 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>profile_edit</title>
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>プロフィール更新ページ</h1>

     <?php
       echo '<form class="form" action="profile_update.php" method="post">
                <label>newメールアドレス</label>
                <input type="text" name="new_email" value="' . $user['email'] . '"><br>
                <label>newパスワード</label>
                <input type="password" name="new_password" value="">
                <input type="submit" name="edit" value="更新！">
            </form>';
      ?>

         <a href="profile.php">キャンセル</a>
   </body>
 </html>
