<?php

require_once('config.php');



if (!isset($_SESSION['email'])) {
  // header('Location: login.php');
}


 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Profile</title>
     <link rel="stylesheet" href="styles.css">
   </head>
   <body>
     <h1>プロフィール</h1>
     <h2><a href="/folder/list.php">フォルダ一覧</a></h2>
     <h2><a href="/todo/list.php">todoリスト一覧</a></h2>
     <section>
       <h2>ユーザー情報
       <?php
       echo '<form class="form" action="profile_edit.php" method="post">
       <input class="edit-button" type="submit" name="edit" value="編集する">
       </form>';
       ?>
       </h2>
       <ul>
         <li>メールアドレス：<?php echo h($_SESSION['email']); ?></li>
         <li>パスワード：********</li>
       </ul>
     </section>

     <a href="/logout.php">ログアウト</a>

   </body>
 </html>
