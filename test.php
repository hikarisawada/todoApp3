<?php

require_once('config.php');

// folder

$dbh = db_connect();

$sql = 'select *
from folders
where user_id = :user_id and published_status = 1';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();



// todo、フォルダを選択したら表示させる
if (isset($_POST['select'])) {
  $folder['id'] = $_POST['folder_id'];

  $query = $dbh->prepare('select * from todos where user_id = :user_id and folder_id = :folder_id');
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
    <link rel="stylesheet" href="styles2.css">
  </head>

  <body>
    <header>
      <nav>
        <ul>
          <li class="top"><a href="top.php">todoApp</a></li>
          <li class="menu"><a href="profile.php">Menu</a></li>
          <li class="menu"><a href="#">ユーザー名</a></li>
        </ul>
      </nav>

    </header>
    <section class="folder">
      <table>
        <tr>
          <td colspan="3"  class="folder-title">フォルダ</td>
        </tr>
        <tr>
          <td colspan="3" class="folder-create"><a href="folder/create.php">フォルダ新規作成</a></td>
        </tr>
        <tr>
          <th class="folder-name">フォルダ名</th>
          <th class="folder-edit">-</th>
          <th class="folder-select">-</th>
        </tr>
        <?php
        while($folder = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo
        '<tr>
          <td>'. $folder['name'] .'</td>
          <td><form class="form" action="folder/edit.php" method="post">
              <input type="submit" name="edit" value="編集する">
              <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
          </form></td>
          <td><form class="form" action="test.php" method="post">
              <input type="submit" name="select" value="選択する">
              <input type="hidden" name="folder_id" value="' . $folder['id'] . '">
          </form></td>
        </tr>';
      }
         ?>


    </table>
    </section>

    <section class="todo">
      <table>
        <tr>
          <td colspan="4" class="todo-title">todo</td>
        </tr>
        <tr>
          <td colspan="4" class="todo-create"><a href="todo/create.php">todo新規作成</a></td>
        </tr>
  <tr>
    <th class="todo-name">todo名</th>
    <th class="todo-status">状態</th>
    <th class="todo-time">作成日時</th>
    <th class="todo-edit">-</th>
  </tr>

  <?php
        while($todo = $query->fetch(PDO::FETCH_ASSOC)){
  echo
  '<tr>
  <td>'. $todo['name'] .'</td>
  <td>データ</td>
  <td>データ</td>
  <td>データ</td>
  </tr>';


}


   ?>




</table>

    </section>

  </body>
</html>
