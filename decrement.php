

<?php
require_once('DbManager.php');

$postId = $_POST['post_id'];


try {
  $db = getDb();
  $sql = 'select id, fav from posts where id = :id';
  $strt = $db->prepare($sql);
  $strt->bindValue(':id' ,$postId);
  $strt->execute();
  $row = $strt->fetch(PDO::FETCH_ASSOC);
  $fav = $row['fav'];
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

$fav -= 1;


if (!empty($postId)) {
//favにcountを挿入する
try {
  $db = getDb();
  $stmt = $db->prepare('UPDATE posts SET fav = :fav where id = :postId');
  $stmt->bindValue(':postId', $postId);
  $stmt->bindValue(':fav', $fav);
  $stmt->execute();
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


}


echo json_encode([
  'post_id' => $postId, 
  'fav_count' => $fav
]);
