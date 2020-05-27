<?php
session_start();

require_once('DbManager.php');

// 名前アップデート
if (!empty($_POST["name"])) {
  try {
    $db = getDb();
    $stot = $db->prepare('UPDATE UserData SET name = :name where id = :id');
    $stot->bindValue(':name', $_POST['name']);
    $stot->bindValue(':id', $_SESSION['id']);
    $stot->execute();
} catch(PDOException $e) {
    print "エラーメッセージ：{$e->getMessage()}";
}

try {
  $db = getDb();
  $stot = $db->prepare('UPDATE posts SET name = :name where user_id = :id');
  $stot->bindValue(':name', $_POST['name']);
  $stot->bindValue(':id', $_SESSION['id']);
  $stot->execute();
} catch(PDOException $e) {
  print "エラーメッセージ：{$e->getMessage()}";
}

try {
  $db = getDb();
  $stot = $db->prepare('UPDATE follow SET name = :name where user_id2 = :id');
  $stot->bindValue(':name', $_POST['name']);
  $stot->bindValue(':id', $_SESSION['id']);
  $stot->execute();
} catch(PDOException $e) {
  print "エラーメッセージ：{$e->getMessage()}";
}
}

// 自己紹介
if (!empty($_POST["profile"])) {
  try {
    $db = getDb();
    $stot = $db->prepare('UPDATE UserData SET profile = :profile where id = :id');
    $stot->bindValue(':profile', $_POST['profile']);
    $stot->bindValue(':id', $_SESSION['id']);
    $stot->execute();
    
} catch(PDOException $e) {
    print "エラーメッセージ：{$e->getMessage()}";
}

}

header("Location:uplode.php");