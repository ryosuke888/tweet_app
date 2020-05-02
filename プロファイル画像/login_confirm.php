<?php

ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once('DbManager.php');

session_start();

//ログインボタンが押されたときの処理
if($_SERVER["REQUEST_METHOD"]==="POST" &&  $_SERVER['HTTP_REFERER']==="http://localhost:8888/app/app_login.php"){

    $_SESSION = $_POST;
    if(isset($_SESSION['email']) && isset($_SESSION['password'])){
      $email=$_SESSION['email'];
      $password=$_SESSION['password'];
    }
  }


try {
  $db = getDb();
  $stmt = $db->prepare('select * from UserData where email = ?');
  $stmt->execute(array($email));
  
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

foreach ($stmt as $row) {
    if ($row['email'] == $email && $row['password'] == $password) {
       $_SESSION['name']=$row['name'];
    header("Location:app.php");
} else {
  echo 'メールアドレス又はパスワードが間違っています。';
  return false;
}
}




?>

