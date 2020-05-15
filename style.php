<?php
header('Content-Type: text/css; charset=utf-8');

require_once('DbManager.php');
require_once('login_confirm.php');

/* 画像をアップロードするためにデータベースへ接続 */
try {
    $db = getDb();
    $sql = 'select url from ImageUrl where name = :name ';
    $stlt = $db->prepare($sql);
    $stlt->bindValue(':name'  ,$_SESSION['name']);
    $stlt->execute();
    $row = $stlt->fetch(PDO::FETCH_ASSOC);
    $url= $row['url'];
  } 
   catch (\Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }
  echo $url;


include_once('app.css');
?>