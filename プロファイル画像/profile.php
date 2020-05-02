<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once('DbManager.php');
require_once('app.php');


    if(isset($_POST["send"])) {
    $tempfile = $_FILES['file']['tmp_name'];
    $filemove = '/Applications/MAMP/htdocs/app/image/' . $_FILES['file']['name'];
    move_uploaded_file($tempfile , $filemove );

    try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO ImageUrl(url, name) 
    VALUES(?, ?)');
  $stmt->execute(array($filemove, $_SESSION['name']));
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
  <p>profile</p>
    <form action="" method="post" enctype="multipart/form-data">
    	<p>プロフィール画像をアップしてください</p>
    	<input type="file" name="file">
    	<br>
    	<input type="submit" value="画像アップロード" name="send">
    </form>
    <br>
	<a href="app.php" class="back-btn">appへ</a>
	
</div> 

</body>
</html>