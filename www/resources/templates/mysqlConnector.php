<?php

defined("__ROOT__") or define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Create connection */
$db_connection = new mysqli($config["db"]["host"], $config["db"]["username"],
                            $config["db"]["password"], $config["db"]["dbName"]
                           );

/* Check connection */
if ($db_connection->connect_error) {
    die("Connection failed: $db_connection->connect_error");
}

/* Close Connection */
$db_connection->close()
?>
