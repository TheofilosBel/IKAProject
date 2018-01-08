<?php

header("Content-Type: application/json; charset=UTF-8");

define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Handle the post requests */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Check what to update */
    $update = json_decode($_POST["up"], false);

    /* Get a connection */
    require_once(DBMANAGMENT_PATH."/mysqlConnector.php")

    /* Query the db */

    /* close the connection */
    $db_connection->close();
}




?>
