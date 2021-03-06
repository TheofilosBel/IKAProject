<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/signup_success.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Εγγραφή Επιτυχής</title>
    </head>

    <body>

        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>
        
        <main>
            <h1>Η εγγραφή σας ολοκληρώθηκε με επιτυχία!</h1>
            <p style="text-align:center;">
            Για να προσθέσετε περισσότερες προσωπικές πληροφορίες στο λογαριασμό σας επισκεφθείτε το Προφίλ σας.<br>
            <a href="profile.php" class="button">Το Προφίλ μου</a>
            </p>
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body> <!-- body -->
</html>
