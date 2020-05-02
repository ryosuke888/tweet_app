<?php
require_once('DbManager.php');

error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

if (!empty($_POST["tweet"])) {
  $day = date("Y/m/d H:i:s");
 try {
  $db = getDb();
  $stmt = $db->prepare('INSERT INTO Tweet(name, tweet, day) 
    VALUES(?, ?, ?)');
  $stmt->execute(array($_POST['name'], $_POST['tweet'], $day));
  }  catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

}





//header("Location: http://localhost:8888/app/app.php?url=[完了]");
?>

 <?php
header("Location:app.php");

?>




