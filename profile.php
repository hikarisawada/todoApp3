<?php

require_once('config.php');



$dbh = db_connect();

$sql = 'select *
from users
where id = :user_id';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC)

 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>Profile</title>
     <link rel="stylesheet" href="styles3.css">
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
       <h2>ユーザー情報</h2>
<?php
        echo
         '<table class="profile-table">
           <tr>
             <th>メールアドレス</th>
             <td>'. $user['email'].'</td>
           </tr>
           <tr>
             <th>パスワード</th>
             <td>********</td>
           </tr>

         </table>';
       ?>
       <form class="profile-form" action="profile_edit.php" method="post">
       <input class="edit-button" type="submit" name="edit" value="編集する">
       </form>


   </body>
 </html>
