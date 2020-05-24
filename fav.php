<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once('DbManager.php');
require_once('login_confirm.php');

if(isset($_SESSION['name'])){
          echo "ようこそ、".$_SESSION['name']."さん！";
        }else{
          header('Location:app_login.php');
          exit;

        }


$name = $_POST['name'];
$tweet = $_POST['tweet'];


try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO Fav(name, tweet) 
    VALUES(?, ?)');
  $stmt->execute(array($name, $tweet));
  } catch(PDOException $e) {
    print "エラーメッセージ：{$e->getMessage()}";
  }
  
try {
  $stt = $db->prepare('select * from Fav');
  $stt->execute(array($name, $tweet));
 
} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" http-equiv="X-UA-Compatible" content="width=device-width, initial-scale=1.0">
	<title>tweet-fav</title>
	<link rel="stylesheet" href="app-login.css">
	
</head>
<body>
<div class="back">
	<h2><?php echo $_SESSION['name'].'のお気に入り一覧'; ?></h2>
  <?php foreach ($stt as $row) : ?>
    <form action="fav_del.php" method="post" accept-charset="utf-8">

      <table>
      <thead>
        <tr>
          <th colspan="1">name</th>
          <th><input type="text" name="name" value="<?php echo $row['name']; ?>" readonly></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>tweet</td>
          <td><input type="text" name="tweet" value="<?php echo $row['tweet']; ?>" readonly></td>
        </tr>
        <tr><button type="submit">削除</button></tr>
      </tbody>
    </table>
    </form>
  <?php endforeach; ?>
	<a href="app.php#" class="back-btn">appへ</a>
</div> 

</body>
</html>