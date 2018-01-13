<?php

/* Check if the user is loged in */
if (!isset($_COOKIE['user'])) {

    /* Else set a cookie for the derferance to that page after login */
    $cookie_name = "deref";
    $cookie_val  = basename($_SERVER['PHP_SELF']);
    setcookie($cookie_name, $cookie_val, time() + (86400));

    /* Redirect to login page */
    header("Location: login.php");
    die();
}
 ?>
