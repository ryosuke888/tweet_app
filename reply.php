<?php 
ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

//session_start();

require_once('DbManager.php');


$id = $_POST['id'];
$message = $_POST['message'];
// var_dump($id);

 if (!empty($_POST["message"])) {
try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO reply(message, id) 
    VALUES(?, ?)');
  $stmt->execute(array($message, $id));
  
  } catch(PDOException $e) {
    print "エラーメッセージ：{$e->getMessage()}";
  }

 }


 echo json_encode([
  //'post_id' => $postId
]);