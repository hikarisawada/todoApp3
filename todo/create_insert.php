<?php

require_once('../config.php');



if (empty($_POST['todo_name'])) {
  echo 'todo名が記入されていません。';
  return false;
}
if (empty($_POST['folder_id'])) {
  echo 'フォルダが選択されていません。1';
  return false;
}
// if (empty($_POST['folder_name'])) {
//   echo 'フォルダが選択されていません。2';
//   return false;
// }


try {
$dbh = db_connect();

$todo['todo_name'] = $_POST['todo_name'];
$todo['folder_id'] = $_POST['folder_id'];

$sql = 'insert into todos (user_id, folder_id, name, published_status) values (:user_id, :folder_id, :todo_name, 1)';
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':folder_id', $todo['folder_id'], PDO::PARAM_STR);
$stmt->bindValue(':todo_name', $todo['todo_name'], PDO::PARAM_STR);
$stmt->bindParam(':user_id', $_SESSION['id'], PDO::PARAM_STR);
$stmt->execute();

header('Location: ../top.php');

} catch (\Exception $e) {
echo $e->getMessage();

}


 ?>
