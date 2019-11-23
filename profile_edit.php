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
     <link rel="stylesheet" href="../styles3.css">
   </head>
   <body>
     <header>
       <nav>
         <ul>
           <li class="top"><a href="top.php">todoApp</a></li>
           <li class="menu"><a href="logout.php">logout</a></li>
           <li class="menu"><a href="profile.php">ユーザー情報</a></li>
         </ul>
       </nav>

     </header>
     <h2>プロフィール更新ページ</h2>

     <?php
       echo '<form class="profile-edit" action="profile_update.php" method="post">
                <label>newメールアドレス</label>
                <input type="text" name="new_email" value="' . $user['email'] . '"><br>
                <label>newパスワード</label>
                <input type="password" name="new_password" value=""><br>
                <input type="submit" name="edit" value="更新！">
            </form>';
      ?>

   </body>
 </html>
