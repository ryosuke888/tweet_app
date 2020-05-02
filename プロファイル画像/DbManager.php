<?php
function getDb() {
  $dsn = 'mysql:dbname=test; host=127.0.0.1; charset=utf8; port=8889';
  $usr = 'root';
  $passwd = 'root';

    $db = new PDO($dsn, $usr, $passwd);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$db = new PDO($dsn, $usr, $passwd, [PDO::ATTR_PERSISTENT => true);
  return $db;
}