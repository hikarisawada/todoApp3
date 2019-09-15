<?php

require_once('../config.php');

try {
  $dbh = db_connect();

  $todo['todo_id'] = $_POST['todo_id'];

  $sql = 'select id as todo_id, name as todo_name, published_status from todos where id = :id';
  $stmt = $dbh->prepare($sql);
  $stmt->bindValue(':id', $todo['todo_id'], PDO::PARAM_STR);
  $stmt->execute();

  $todo = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (\Exception $e) {
  echo $e->getMessage();

}

 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Profile</title>
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>todo更新ページ</h1>

     <?php


       echo '<form class="form" action="update.php" method="post">
                <input type="hidden" name="todo_id" value="' . $todo['todo_id'] . '">
                <input type="text" name="todo_name" value="' . $todo['todo_name'] . '">
                <input type="submit" name="edit" value="更新！">
            </form>';

      ?>

         <a href="list.php">キャンセル</a>
       </form>
   </body>
 </html>
