<?php


require_once('../config.php');

$dbh = db_connect();

$sql = 'select todos.id as todo_id, todos.user_id, todos.name as todo_name, folders.id as folder_id, folders.name as folder_name
from todos
inner join folders on todos.folder_id = folders.id
where todos.user_id = :user_id
and todos.published_status = 2';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();




 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>todo_done_list</title>
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>完了済みリスト</h1>
     <?php


     echo "<ul>";
     while($todo = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo "<li>" . h($todo['folder_name'] .': ' .$todo['todo_name']);
       echo "</li>";

       // var_dump($folder);
     }
     echo "</ul>" ;

     // var_dump ($_POST);


      ?>

       <div class="">
         <a href="list.php">todoリストに戻る</a><br>
         <a href="/profile.php">profileへ</a>
       </div>
   </body>
 </html>
