<?php 
define("USERNAME", "");
define("PASSWORD", "");
define("HOST", "LOCALHOST");

/* Create connection */
$db_connection = new mysqli(HOST, USERNAME, PASSWORD);

/* Check connection */
if ($db_connection->connect_error) {
    die("Connection failed: "$db_connection->connect_error);
}

echo "Connected successfully";
?>