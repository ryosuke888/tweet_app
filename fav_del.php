<?php 

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);

require_once('DbManager.php');

$name = $_POST['name'];
$tweet = $_POST['tweet'];

try {
  $db = getDb();
  $stt = $db->prepare('SELECT id from Fav where name = ? and tweet = ?');
  $stt->execute(array($name, $tweet));
  $response = $stt->fetch(PDO::FETCH_ASSOC);

} catch (\Exception $e) {
  echo $e->getMessage() . PHP_EOL;
}

try {
  $sql = 'DELETE from Fav where id = :id';
  $stmt = $db->prepare($sql);
  $stmt->execute(array(':id' => $response['id']));

  } catch(PDOException $e) {
    print "エラーメッセージ：{$e->getMessage()}";
  }
?>


<?php
//header("Location:fav.php");

?>