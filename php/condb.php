<?php
$servername = "localhost";
$username = "cjlinfoc";
$password = "333cjChowjung";

try {
  $conn = new PDO("mysql:host=$servername;dbname=cjlinfoc_chj_doc;charset=utf8", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>