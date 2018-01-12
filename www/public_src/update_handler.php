<?php

//header("Content-Type: application/json; charset=UTF-8");
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Handle the post requests */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    /* Get the attribute to update  */
    $keys = array_keys($_POST);

    try {
        /* Get a connection */
        require_once(DBMANAGMENT_PATH."/mysqlConnector.php");

        /* Get the user id from the cookie */
        $cookies = explode('*', $_COOKIE['user']);
        $user_id = $cookies[1];


        /* Query the db */
        $query = 'UPDATE user_info SET '.$keys[0].'=\''.$_POST[$keys[0]].'\' WHERE id='.$user_id.';';
        if ($db_connection->query($query) !== TRUE) {
            echo "Error when updateing :".$db_connection->error;
        }

        /* close the connection */
        $db_connection->close();
    }
    catch(Exception $e) {
        echo "We cant handle your request because of the following error: ".$e->getMessage();
    }

    /* All right response */
    echo "OK";
}
?>
