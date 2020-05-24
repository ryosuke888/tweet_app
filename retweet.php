<?php
require_once('DbManager.php');
session_start();

error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

if (!empty($_POST["tweet"])) {
  $day = date("Y/m/d H:i:s");
 try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO posts(name, tweet, day, image_url) 
    VALUES(?, ?, ?, ?)');
  $stmt->execute(array($_POST['name'], $_POST['tweet'], $day, $_POST['image']));
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


//誰がリツイートしたかとツイートidをretweetに挿入
try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO retweet(name, id) 
    VALUES(?, ?)');
  $stmt->execute(array($_SESSION['name'], $_POST['id']));
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

}

?>

 <?php
header("Location:app.php");

?>

