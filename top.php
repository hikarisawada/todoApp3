<?php

require_once('config.php');

// ログインできていない場合にはsigninに遷移
if (empty($_SESSION["id"])) {
header('Location: login.php');
exit;
}

// folder

$dbh = db_connect();

$sql = 'select *
from folders
where user_id = :user_id and published_status = 1';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();



// todo、表示させる
  $todosql = 'select id, user_id, folder_id, name,
case when published_status = 1 then "進行中" else "完了" end as status
from todos where user_id = :user_id order by status desc';

  $query = $dbh->prepare($todosql);
  $query->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
  // $query->bindParam(':folder_id', $folder['id'], PDO::PARAM_STR);
  $query->execute();


// }
// todo、フォルダ選んだらそのフォルダのを表示させる
if (isset($_POST['select'])) {
  $folder['id'] = $_POST['folder_id'];

  $query = $dbh->prepare('select id, user_id, folder_id, name,
case when published_status = 1 then "進行中" else "完了" end as status
from todos where user_id = :user_id and folder_id = :folder_id
order by status desc');
  $query->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
  $query->bindParam(':folder_id', $folder['id'], PDO::PARAM_STR);
  $query->execute();


}


 ?>




<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>top</title>
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
    <div class="contents">

    <section class="top-folder">
      <table class="folder-table">
        <tr>
          <th colspan="3"  class="folder-title">フォルダ</hd>
        </tr>
        <tr>
          <th colspan="3" class="folder-new-create"><a href="folder/create.php">フォルダ新規作成</a></th>
        </tr>
        <tr>
          <th class="folder-name">フォルダ名</th>
          <th class="folder-edit"></th>
          <th class="folder-select"></th>
        </tr>
        <?php
        while($folder = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo
        '<tr>
          <td>'. $folder['name'] .'</td>
          <td><form action="folder/edit.php" method="post">
              <input type="submit" name="edit" value="編集する">
              <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
          </form></td>
          <td><form action="top.php" method="post">
              <input type="submit" name="select" value="選択する">
              <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
          </form></td>
        </tr>';
      }
         ?>


    </table>
    </section>

    <section class="top-todo">
      <table class="todo-table">
        <tr>
          <th colspan="4" class="todo-title">todo</th>
        </tr>
        <tr>
          <th colspan="4" class="todo-new-create"><a href="todo/create.php">todo新規作成</a></td>
        </tr>
  <tr>
    <th class="todo-name">todo名</th>
    <th class="todo-status">状態</th>
    <th class="todo-time"></th>
    <th class="todo-edit"></th>
  </tr>

  <?php
        while($todo = $query->fetch(PDO::FETCH_ASSOC)){
  echo
  '<tr>
  <td>'. $todo['name'] .'</td>
  <td>'. $todo['status'].'</td>
  <td><form action="todo/edit.php" method="post">
      <input type="submit" name="edit" value="編集する">
      <input type="hidden" name="todo_id" value="' . $todo['id'] . '">
  </form></td>
  <td><form action="todo/done.php" method="post">
           <input type="submit" name="done" value="完了">
           <input type="hidden" name="todo_id" value="' . $todo['id'] . '">
       </form></td>
  </tr>';
}

   ?>

</table>

    </section>
  </div>

  </body>
</html>
