<?php
require_once('DbManager.php');
session_start();
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

$postId = $_POST['post_id'];
if (!empty($postId)) {
  $day = date("Y/m/d H:i:s");

  try {
    $db = getDb();
    $sql = 'select name, tweet, day, image_url, fav, user_id from posts where id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id' ,$postId);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  } 
   catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

  
  try {
    $db = getDb();
    
    $stnt = $db->prepare('INSERT INTO posts(name, tweet, day, image_url, fav, user_id, retweet, retweet_name) 
      VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $stnt->execute(array($row['name'], $row['tweet'], $day, $row['image_url'], $row['fav'], $row['user_id'], true, $_SESSION['name']));
    
    }  catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

  try {
    $db = getDb();
    $sql = 'select * from UserData where id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id' ,$_SESSION['id']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $retweet_name = $row['name'];

  } 
   catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

  $retweet_name = $retweet_name."によってリツイートにされました";
  
}



echo json_encode([
  'post_id' => $postId, 
  'retweet_name' => $retweet_name
]);

