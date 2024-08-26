<?php
const HOST = 'localhost';
// make sure to update these fields according to your local variables setup
const USERNAME = 'mysql_username';
const PASSWORD = 'your_local_env_password';
const DBNAME = 'todo';
$dbcon = new mysqli(HOST, USERNAME, PASSWORD, DBNAME);

if ($dbcon->connect_error) {
  die("connect error: " . $dbcon->connect_error);
}

?>
