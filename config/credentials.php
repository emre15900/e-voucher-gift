<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'constants.php';

if(IS_LOCAL) {
  $dbname = 'evouchergift';
  $user = 'root';
  $password = 'markomeje';
}else {
  $dbname = 'evoucher_db';
  $user = 'evoucher_user';
  $password = 'Mcdb99*38';
}

$host = IS_LOCAL ? '127.0.0.1' : 'localhost';
$dsn = 'mysql:host='.$host.';dbname='.$dbname;