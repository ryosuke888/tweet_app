<?php 
require_once('DbManager.php');
session_start();
ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);



$postId = $_POST['post_id'];
 //var_dump($postId);
 $id = $_SESSION['id'];

    try {
      $db = getDb();
      $stmt = $db->prepare('select name from UserData where id = :id');
      $stmt->bindValue(':id', $postId);
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $name = $row['name'];
      }  catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }

    if (!empty($name)) {
      try {
        $db = getDb();
        $stnt = $db->prepare('INSERT INTO follow(name, user_id2, user_id) value(?, ?, ?)');
       // $stnt->bindValue(':name', $name);
        //$stnt->bindValue(':postId', $postId);
        //$stnt->bindValue(':id', $id);
        $stnt->execute(array($name, $postId, $id));
        }  catch (\Exception $e) {
        echo $e->getMessage() . PHP_EOL;
      }
    }


echo json_encode([
  //'post_id' => $postId
]);

