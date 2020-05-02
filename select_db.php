<?php
require_once('DbManager.php');

ini_set('display_errors', on);
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

try {
  $db = getDb();
  $sql = 'select name, tweet from Tweet';
  $stt = $db->prepare($sql);
  $stt->execute();
  $row = $stt->fetch(PDO::FETCH_ASSOC);
  
} 
 catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}


 var_dump($row);
//header("Location: http://localhost:8888/app/app.php");
?>

