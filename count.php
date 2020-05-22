<?php
session_start();
require_once('DbManager.php');

$postId = $_POST['post_id'];


if (empty($_SESSION['count'][$postId])) {
  $_SESSION['count'] = array_merge($_SESSION['count'], [$postId => 0]);
}
$_SESSION['count'][$postId]++;



try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO posts(fav) 
    VALUES(?) where id = $postId');
  $stmt->execute($_SESSION['count'][$postId]++);
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


try {
  $db = getDb();
  $sql = 'select fav, id from posts where id = $postId';
  $stt = $db->query($sql);
  $stt->execute();
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

 foreach( $stt as $row) {
   $id = $row['id'];
   $fav = $row['fav'];
 }

 

/*
echo json_encode([
  'post_id' => $_POST['post_id'], 
  'fav_count' => $_SESSION['count'][$postId]
]);
*/
echo json_encode([
  'post_id' => $id, 
  'fav_count' => $fav
]);