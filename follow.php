<?php 
session_start();
require_once('DbManager.php');

ini_set('display_errors', 'on');
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(E_ALL);


$name = $_POST['name'];
$id = $_SESSION['id'];

if (!empty($name)) {

    try {
      $db = getDb();
      $stmt = $db->prepare('INSERT INTO follow(name, id) value(:name, :id)');
      $stmt->bindValue(':name', $name);
      $stmt->bindValue(':id', $id);
      $stmt->execute();
      header("Location:app.php");
      }  catch (\Exception $e) {
      echo $e->getMessage() . PHP_EOL;
    }

}

