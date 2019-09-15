<?php


require_once('../config.php');

$dbh = db_connect();

$sql = 'select *
from folders
where user_id = :user_id and published_status = 1';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();

// 完了押したら
if (isset($_POST['done'])) {
  $folder['id'] = $_POST['folder_id'];

  $dbh = db_connect();

  $query = $dbh->prepare('SELECT * FROM todos WHERE folder_id = :folder_id and published_status = 1');
  $query->bindValue(':folder_id', $folder['id'], PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetch();

// 該当するフォルダにtodoが残っているか
  if ($result > 0) {
    echo 'todoが残っています';

  } else {

  try {

    // var_dump ($_POST['id']);
    // sql、「:email」の部分？で書くこともできるらしい
    $sql = 'update folders set published_status = 2 where id = :folder_id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':folder_id', $folder['id'], PDO::PARAM_STR);
    // $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
      header('Location: list.php');


  } catch (\Exception $e) {
    echo $e->getMessage();
  }

  // header('Location: done.php');
}
}

// 削除押したら
if (isset($_POST['delete'])) {
  $folder['id'] = $_POST['folder_id'];

  $dbh = db_connect();

  $query = $dbh->prepare('SELECT * FROM todos WHERE folder_id = :folder_id and published_status = 1');
  $query->bindValue(':folder_id', $folder['id'], PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetch();

// 該当するフォルダにtodoが残っているか
  if ($result > 0) {
    echo 'todoが残っています';

  } else {

  try {

    // var_dump ($_POST['id']);
    // sql、「:email」の部分？で書くこともできるらしい
    $sql = 'update folders set published_status = 3 where id = :folder_id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':folder_id', $folder['id'], PDO::PARAM_STR);
    // $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
      header('Location: list.php');
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
    // $userid = $dbh->lastinsertid();

  } catch (\Exception $e) {
    echo $e->getMessage();
  }

}
}


// 編集押したら
if (isset($_POST['edit'])) {
  $folder['id'] = $_POST['folder_id'];
  // var_dump($folder);

  header('Location: edit.php');
}
 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>folder_list</title>
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>フォルダリスト</h1>

     <?php


     echo "<ul>";
     while($folder = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo "<li>" . h($folder['name']);
       echo '<form class="form" action="../todo/folder_todo_list.php" method="post">
                <input type="submit" name="folder_todo_list" value="todo一覧をみる">
                <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
            </form>
                <form class="form" method="post">
                <input type="submit" name="done" value="完了">
                <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
            </form>
            <form class="form" method="post">
                <input type="submit" name="delete" value="削除する">
                <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
            </form>
            <form class="form" action="edit.php" method="post">
                <input type="submit" name="edit" value="編集する">
                <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
            </form>'
            ;
        echo "</li>";

       // var_dump($folder);
     }
     echo "</ul>" ;
      ?>

       <div class="">
         <a href="create.php">新規作成する</a><br>
         <a href="done_list.php">完了済みリスト</a><br>
         <a href="/profile.php">profileへ</a>

       </div>
   </body>
 </html>


 
