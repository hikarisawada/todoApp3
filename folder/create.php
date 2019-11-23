<?php

require_once('../config.php');


$errors = array();

if (isset($_POST['submit'])) {
  if (empty($_POST['folder_name'])) {
    echo 'フォルダ名が記入されていません。';
  }

  if (!empty($_POST['folder_name'])) {

  $folder['name'] = $_POST['folder_name'];

  try {
    $dbh = db_connect();

    $sql = 'insert into folders (user_id, name, published_status) values (:user_id, :name, 1)';
    $stmt = $dbh->prepare($sql);
    // var_dump($folder_name);
    $stmt->bindValue(':name', $folder['name'], PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_STR);
    $stmt->execute();

    header('Location: ../top.php');

  } catch (\Exception $e) {
    echo $e->getMessage();

  }
}

}



?>






 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>folder_create</title>
     <link rel="stylesheet" href="../styles3.css">
   </head>
   <body>
     <header>
       <nav>
         <ul>
           <li class="top"><a href="../top.php">todoApp</a></li>
           <li class="menu"><a href="../logout.php">logout</a></li>
           <li class="menu"><a href="../profile.php">ユーザー情報</a></li>
         </ul>
       </nav>

     </header>
     <h2>フォルダ作成ページ</h2>
       <form class="folder-create" action="" method="post">
         <input type="text" name="folder_name" value="" placeholder="フォルダ名">
         <input type="submit" name="submit" value="作成！">

       </form>
   </body>
 </html>
