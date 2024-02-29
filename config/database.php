<?php

include 'credentials.php';

try {
  $dbh = new PDO($dsn, $user, $password);
  $dbh->exec("SET NAMES utf8");
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}