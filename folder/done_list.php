<?php


require_once('../config.php');

$dbh = db_connect();

$sql = 'select * from folders where published_status = 2 and user_id = :user_id ';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();




 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>folder_list</title>
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>完了済みリスト</h1>
     <?php


     echo "<ul>";
     while($folder = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo "<li>" . h($folder['name']);
       echo "</li>";
       // var_dump($folder);
     }
     echo "</ul>" ;
     // var_dump ($_POST);

      ?>

       <div class="">
         <a href="list.php">フォルダリストに戻る</a><br>
         <a href="/profile.php">profileへ</a>

       </div>



   </body>
 </html>
