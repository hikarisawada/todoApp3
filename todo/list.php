<?php


require_once('../config.php');

$dbh = db_connect();

$sql = 'select todos.id as todo_id, todos.user_id, todos.name as todo_name, folders.id as folder_id, folders.name as folder_name
from todos
inner join folders on todos.folder_id = folders.id
where todos.user_id = :user_id
and todos.published_status = 1';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();
// var_dump($stmt->execute());



// 完了押したら
if (isset($_POST['done'])) {
  $todo['todo_id'] = $_POST['todo_id'];
  try {
    $dbh = db_connect();

    // var_dump ($_POST['id']);
    // sql、「:email」の部分？で書くこともできるらしい
    $sql = 'update todos set published_status = 2 where id = :todo_id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':todo_id', $todo['todo_id'], PDO::PARAM_STR);
    $stmt->execute();
      header('Location: list.php');
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($stmt->fetch(PDO::FETCH_ASSOC));
    // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
    // $userid = $dbh->lastinsertid();

  } catch (\Exception $e) {
    echo $e->getMessage();
  }

  // header('Location: done.php');
}

// 削除押したら
if (isset($_POST['delete'])) {
  $todo['todo_id'] = $_POST['todo_id'];
  try {
    $dbh = db_connect();

    // var_dump ($_POST['id']);
    // sql、「:email」の部分？で書くこともできるらしい
    $sql = 'update todos set published_status = 3 where id = :todo_id';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':todo_id', $todo['todo_id'], PDO::PARAM_STR);
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


// 編集押したら
if (isset($_POST['edit'])) {
  $todo['todo_id'] = $_POST['todo_id'];
  // var_dump($folder);

  header('Location: edit.php');
}

// 新規作成」押したら
if (isset($_POST['create'])) {
  // $todo['todo_id'] = $_POST['todo_id'];
  // var_dump($folder);

  header('Location: create.php');
}


 ?>


 <!DOCTYPE html>
 <html lang="ja">
   <head>
     <meta charset="utf-8">
     <title>todo_list</title>
     <link rel="stylesheet" href="../styles.css">
   </head>
   <body>
     <h1>todoリスト</h1>
     <h2>（ファイル名: todo名）</h2>
     <?php


     echo("<ul>");
     while($todo = $stmt->fetch(PDO::FETCH_ASSOC)){
       echo "<li>" . h($todo['folder_name'] .': ' .$todo['todo_name']);
       echo '<form class="form" method="post">
                <input type="submit" name="done" value="完了">
                <input type="hidden" name="todo_id" value="' . $todo['todo_id'] . '">
                <input type="submit" name="delete" value="削除する">
            </form>
            <form class="form" action="edit.php" method="post">
                <input type="submit" name="edit" value="編集する">
                <input type="hidden" name="todo_id" value="' . $todo['todo_id'] . '">
            </form>'
            ;
        echo "</li>";

       // var_dump($folder);
     }
     echo "</ul>" ;
     echo '<form class="form" action="create.php" method="post">
       <input type="submit" name="create" value="新規作成する">
       <input type="hidden" name="folder_id" value="' . $todo['folder_id'] . '">
     </form>';
      ?>
      <div class="">

        <!-- <a href="create.php">新規作成する</a><br> -->
        <a href="done_list.php">完了済みリスト</a><br>
        <a href="/profile.php">profileへ</a>

      </div>

   </body>
 </html>
