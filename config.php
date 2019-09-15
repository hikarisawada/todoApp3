<?php

ini_set('display_errors', 1);


define('DB_DATABASE', 'todoApp');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'sh1232580');
define('PDO_DSN', 'mysql:dbhost=localhost;dbname=' . DB_DATABASE);


function h($s){
  return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}


session_start();

 // function __construct(){

function db_connect() {
  $dsn = 'mysql:dbname=todoApp;host=localhost;charset=utf8';
  $db_user = 'root';
  $db_password = 'sh1232580';
try {
  $dbh = new PDO(PDO_DSN, DB_USERNAME, DB_PASSWORD);
  $dbh->query('SET NAMES utf8');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // echo "成功";
  return $dbh;

} catch (PDOException $e) {
  echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}

}
