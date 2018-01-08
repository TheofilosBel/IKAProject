<?php
/* See if there is a cookie */
if (isset($_COOKIE["user"])) {
    /* Delete it */
    setcookie("user", "", time() - 3600);
}

/* Redirect to home page */
header("location: index.php")
?>
