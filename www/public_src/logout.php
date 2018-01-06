<?php
/* See if there is a cookie */
if (isset($_COOKIE["username"])) {
    /* Delete it */
    setcookie("username", "", time() - 3600);
}

/* Redirect to home page */
header("location: index.php")
?>
