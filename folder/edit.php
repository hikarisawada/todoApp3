<?php

require_once('../config.php');


  try {
    $dbh = db_connect();
    $folder['id'] = $_POST['folder_id'];

    $sql = 'select * from folders where id = :id';
    $stmt = $dbh->prepare($sql);
    // $stmt->bindValue(':name', $folder, PDO::PARAM_STR);
    $stmt->bindValue(':id', $folder['id'], PDO::PARAM_STR);
    $stmt->execute();
    $folder = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($folder);

    // header('Location: update.php');

  } catch (\Exception $e) {
    echo $e->getMessage();

  }



?>






 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>folder_edit</title>
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
     <h2>フォルダ更新ページ</h2>

     <?php
     // while($folder = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo '<form class="folder-edit" action="../top.php" method="post">
                <input type="hidden" name="id" value="' . $folder['id'] . '">
                <input type="text" name="name" value="' . $folder['name'] . '">
                <input type="submit" name="edit" value="更新！">
            </form>';
      // }
      ?>
       </form>
   </body>
 </html>
