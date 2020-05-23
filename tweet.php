<?php
require_once('DbManager.php');

error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

if (!empty($_POST["tweet"])) {
  $day = date("Y/m/d H:i:s");
 try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO posts(name, tweet, day, image_url) 
    VALUES(?, ?, ?, ?)');
  $stmt->execute(array($_POST['name'], $_POST['tweet'], $day, $_POST['url']));
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

}

?>

 <?php
header("Location:app.php");

?>




