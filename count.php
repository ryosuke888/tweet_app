<?php
session_start();
require_once('DbManager.php');

$postId = $_POST['post_id'];
//$postId = "3";
echo $postId;
var_dump($_SESSION['count']);
if (empty($_SESSION['count'][$postId])) {
  $_SESSION['count'] = array_merge($_SESSION['count'], [$postId => 0]);
}
$counts = $_SESSION['count'][$postId]++;


if (!empty($postId)) {
//favにcountを挿入する
try {
  $db = getDb();
  $stmt = $db->prepare('UPDATE posts SET fav = :counts where id = :postId');
  $stmt->bindValue(':postId', $postId);
  $stmt->bindValue(':counts', $counts);
  $stmt->execute();
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


//favからcountを取得する
try {
  $db = getDb();
  $sql = 'select fav from posts where id = :postId';
  $stt = $db->prepare($sql);
  $stt->bindValue(':postId', $postId);
  $stt->execute();
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
 }

}

 foreach($stt as $row) {
     $counts = $row['fav'];
     var_dump($counts);
 }
echo json_encode([
  'post_id' => $postId, 
  'fav_count' => $counts
]);
