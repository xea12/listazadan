<?php
$hostname = "localhost";
$database = "taskList";
$username = "root";
$password = "";

$db = mysqli_connect($hostname, $username, $password, $database);
mysqli_set_charset($db, 'utf8');
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>