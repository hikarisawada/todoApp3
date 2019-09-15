<?php

require_once('config.php');


if (empty($_POST['new_email'])) {
   echo 'メールアドレスが記入されていません。';
   return false;
} elseif (empty($_POST["new_password"])) {
  echo 'パスワードが記入されていません。';
  return false;
}

  try {
    $dbh = db_connect();

    $sql = 'update users set email = :email, password = :password where id = :id' ;
    $stmt = $dbh->prepare($sql);

// パスワードのハッシュ化
    $password = $_POST['new_password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bindValue(':email', $_POST['new_email'], PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
    $stmt->bindValue(':id', $_SESSION['id'], PDO::PARAM_STR);
    $stmt->execute();
    // var_dump($folder['name']);

    header('Location: profile.php');

  } catch (\Exception $e) {
    echo $e->getMessage();

  }




?>
