<?php

require_once('../config.php');



try {
  $dbh = db_connect();

  $sql = 'select id as folder_id, user_id, name as folder_name
from folders
where user_id = :user_id
and published_status = 1;';
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
  $stmt->execute();


// header('Location: list.php');

} catch (\Exception $e) {
echo $e->getMessage();

}

// 新規作成」押したら
if (isset($_POST['submit'])) {
// var_dump($_POST['folder_id']);
  // header('Location: create_insert.php');
}


 ?>


  <!DOCTYPE html>
  <html lang="ja">
    <head>
      <meta charset="utf-8">
      <title>todo_create</title>
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
      <h2>todo作成ページ</h2>

<?php
echo '<div class="todo-create"><label>フォルダを選んでください</label>';
while ($todo = $stmt->fetch(PDO::FETCH_ASSOC)) {
  // var_dump($todo);
  echo '<form class="" action="create_insert.php" method="post">
  <input type="radio" name="folder_id" value="'. $todo['folder_id'] . '" >  '. $todo['folder_name'] . '
  <br>
  ';

}
  echo '<label>todo名を記入してください</label><br>
  <input type="text" name="todo_name" value=""><br>
  <input type="submit" name="submit" value="作成！">
  </form></div>'

?>

    </body>
  </html>
