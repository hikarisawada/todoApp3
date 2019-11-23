<?php

require_once('../config.php');


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
        header('Location: ../top.php');
      // $row = $stmt->fetch(PDO::FETCH_ASSOC);
      // var_dump($stmt->fetch(PDO::FETCH_ASSOC));
      // $stmt->execute(array($email, password_hash($password, PASSWORD_DEFAULT)));
      // $userid = $dbh->lastinsertid();

    } catch (\Exception $e) {
      echo $e->getMessage();
    }
}
