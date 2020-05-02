<?php 
require_once 'DbManager.php';

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);


if(!empty($_POST)) {
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

var_dump($_POST);



  try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO UserData(name, email, password) 
    VALUES(?, ?, ?)');
  $stmt->execute(array($name, $email, $password));
  $msg = '会員登録が完了しました';
  /*header('Location: http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/register.php'); */
  } catch(PDOException $e) {
    print "エラーメッセージ：{$e->getMessage()}";
  }
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
	<title>tweet-register</title>
	<link rel="stylesheet" href="app-login.css">
	
</head>
<body>
<div class="back">
  <p>会員登録が完了しました</p>
	<a href="app.php" class="back-btn">appへ</a>
</div> 

</body>
</html>