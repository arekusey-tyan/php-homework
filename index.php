<?php

$host = 'db:3306';
// Note that you can use `db:3306` host to connect to database from here
// $host = 'localhost:3306';
$username = 'demo';
$password = 'demo';
$database = 'demo';

try {
  $db = mysqli_connect($host, $username, $password, $database);
} catch (Exception $error) {
  echo "<b>Error:</b> Connection to database cannot be established <br/>";
  echo "<b>Code </b> #{$error->getCode()}: {$error->getMessage()} <br/>";
  die();
} finally {
  echo "Connected to MySQL Server v{$db->get_server_info()}";
}

// Your code goes here:
// var_dump($db->query("SELECT DATABASE()")->fetch_all());
