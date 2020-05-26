<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once('DbManager.php');

session_start();


if(isset($_POST["send"])) {
    $tempfile = $_FILES['file']['tmp_name'];
    $filemove = '/Applications/MAMP/htdocs/app/image/profile/' . $_FILES['file']['name'];
    $filename = $_FILES['file']['name'];
    move_uploaded_file($tempfile , $filemove );

    if (!empty($_SESSION["name"])) {

        try {
          $db = getDb();
         
          $sql = 'select * from ImageUrl where user_id = :id';
          $stmt = $db->prepare($sql);
          $stmt->bindValue(':id', $_SESSION['id']);
          $stmt->execute();
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          $user_id = $row['user_id'];
        } 
        catch (\Exception $e) {
          echo $e->getMessage() . PHP_EOL;
        }

        try {
          $db = getDb();
         
          $sql = 'select * from posts where user_id = :id';
          $stpt = $db->prepare($sql);
          $stpt->bindValue(':id', $_SESSION['id']);
          $stpt->execute();
          $row1 = $stpt->fetch(PDO::FETCH_ASSOC);
          $user_id2 = $row1['user_id'];
        } 
        catch (\Exception $e) {
          echo $e->getMessage() . PHP_EOL;
        }
            if (!empty($user_id)) {
                try {
                  $db = getDb();
                  $stnt = $db->prepare('UPDATE ImageUrl SET url = :filename, name = :name where user_id = :id');
                  $stnt->bindValue(':filename', $filename);
                  $stnt->bindValue(':name', $_SESSION['name']);
                  $stnt->bindValue(':id', $_SESSION['id']);
                  $stnt->execute();
                  //var_dump(1);
                } catch(PDOException $e) {
                  print "エラーメッセージ：{$e->getMessage()}";
                }

                if(!empty($user_id2)) {
                    try {
                      $db = getDb();
                      $stnt = $db->prepare('UPDATE posts SET image_url = :filename where user_id = :id');
                      $stnt->bindValue(':filename', $filename);
                      $stnt->bindValue(':id', $_SESSION['id']);
                      $stnt->execute();
                      //var_dump(1);
                      header("Location:app.php");
                    } catch(PDOException $e) {
                      print "エラーメッセージ：{$e->getMessage()}";
                    }
                } else {
                      header("Location:app.php");
                }
            } else {
                try {
                  $db = getDb();
                  $stlt = $db->prepare('INSERT INTO ImageUrl(url, name, user_id) 
                    VALUES(:filename, :name, :id)');
                  $stlt->bindValue(':filename', $filename);
                  $stlt->bindValue(':name', $_SESSION['name']);
                  $stlt->bindValue(':id', $_SESSION['id']);
                  $stlt->execute();
                header("Location:app.php");
                //var_dump('2');
                } catch(PDOException $e) {
                  print "エラーメッセージ：{$e->getMessage()}";
                }
            }
    }

  }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
	<title>tweet-profile</title>
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