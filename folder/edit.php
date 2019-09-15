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
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>フォルダ更新ページ</h1>

     <?php
     // while($folder = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo '<form class="form" action="update.php" method="post">
                <input type="hidden" name="id" value="' . $folder['id'] . '">
                <input type="text" name="name" value="' . $folder['name'] . '">
                <input type="submit" name="edit" value="更新！">
            </form>';
      // }
      ?>

         <a href="list.php">キャンセル</a>
       </form>
   </body>
 </html>
