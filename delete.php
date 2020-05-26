<?php 
require_once('DbManager.php');


$postId = $_POST['post_id'];
    try {
      $db = getDb();
      $stmt = $db->prepare('delete from posts where id = :id');
      $stmt->bindValue(':id', $postId);
      $stmt->execute();
      }  catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }


echo json_encode([
  //'post_id' => $postId
]);

