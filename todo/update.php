<?php

require_once('../config.php');

if (empty($_POST['todo_name'])) {
  echo 'todo名が記入されていません。';
}


  try {
    $dbh = db_connect();

    $todo['todo_id'] = $_POST['todo_id'];
    $todo['todo_name'] = $_POST['todo_name'];

    $sql = 'update todos set name = :name where id = :id' ;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $todo['todo_name'], PDO::PARAM_STR);
    $stmt->bindValue(':id', $todo['todo_id'], PDO::PARAM_STR);
    $stmt->execute();
    // var_dump($folder['name']);

    header('Location: list.php');

  } catch (\Exception $e) {
    echo $e->getMessage();

  }




?>
