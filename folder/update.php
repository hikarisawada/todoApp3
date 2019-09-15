<?php

require_once('../config.php');

if (empty($_POST['name'])) {
  echo 'フォルダ名が記入されていません。';
}

  try {
    $dbh = db_connect();

    $folder['id'] = $_POST['id'];
    $folder['name'] = $_POST['name'];

    $sql = 'update folders set name = :name where id = :id' ;
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $folder['name'], PDO::PARAM_STR);
    $stmt->bindValue(':id', $folder['id'], PDO::PARAM_STR);
    $stmt->execute();
    // var_dump($folder['name']);

    header('Location: list.php');

  } catch (\Exception $e) {
    echo $e->getMessage();

  }




?>
