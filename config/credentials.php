<?php

error_reporting(E_ALL);
ini_set('display_errors', 'On');

include 'constants.php';

if(IS_LOCAL) {
  $dbname = 'evouchergift';
  $user = 'root';
  $password = 'markomeje';
}else {
  $dbname = 'kellynel_rubio';
  $user = 'kellynel_rubio_trfg7483gyfbhej';
  $password = '5yfehifjb47f6qfaiacvk01923q';
}

$host = IS_LOCAL ? '127.0.0.1' : 'localhost';
$dsn = 'mysql:host='.$host.';dbname='.$dbname;