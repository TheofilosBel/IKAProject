<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Query the db to have the information ready when needed */
try {
    /* Get the connection */
    require_once(DBMANAGMENT_PATH.'/mysqlConnector.php');

    /* Get the id from the cookie */
    $user_id = explode('*', $_COOKIE['user'])[1];
    $user_name = explode('*', $_COOKIE['user'])[0];

    /* Query the db for the user_cred */
    $query = 'SELECT * FROM user_info WHERE id=\''.$user_id.'\';';
    $result = $db_connection->query($query);
    if (!$result) die($db_connection->error);

    /* Get the user info */
    $result->data_seek(0);
    $user_info = $result->fetch_assoc();

    /* Close the connection */
    $db_connection->close();
}
catch(Exception $e) {
    echo "We cant handle your request because of the following error: ".$e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ΙΚΑ - Το Προφίλ μου</title>
    <link rel="stylesheet" type="text/css" href="css/general_layout.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
</head>

<body>
    <!-- Include the header -->
    <?php require_once(TEMPLATES_PATH."/header.php");?>

    <main>
        <div class="container">
            <div class="photo-space">
                <div class="circle">
                    <img src="" alt="">
                </div> <!-- Circle for the photo -->
                <span style="font-size:25px; padding:20px;"><?php echo $user_name?></span>
            </div> <!-- Photo space -->

            <div class="info-space">
                <div class="tab-selector">
                    <a class="tab-item" onclick="openTab(event, 'account')">Στοιχεία Λογριασμού</a>
                    <a class="tab-item" onclick="openTab(event, 'personal')">Προσωπικά Στοιχεία</a>
                    <a class="tab-item" onclick="openTab(event, 'history')">Ιστορικό Αιτήσεων</a>
                    <a class="tab-item" onclick="openTab(event, 'notifications')">Ειδοποιήσεις</a>
                </div> <!--  The tab selector bar -->

                <div class="tab-content" id="account">
                    account
                </div> <!-- The account tab-->

                <div class="tab-content" id="personal">
                    <div class="info-container">
                        <span class="info-disp">Όνομα</span>
                        <span class="info-disp"><?php  echo $user_info['name']?></span>
                        <img src="./img/edit.png" alt="" height="20" width="20">
                    </div>
                    <hr>
                    <div class="info-container">
                        <span class="info-disp">Επίθετο</span>
                        <span class="info-disp"><?php  echo $user_info['surname']?></span>
                        <img src="./img/edit.png" alt="" height="20" width="20">
                    </div>
                    <hr>
                    <div class="info-container">
                        <span class="info-disp">ΑΜΚΑ</span>
                        <span class="info-disp"><?php  echo $user_info['AMKA']?></span>
                        <img src="./img/edit.png" alt="" height="20" width="20">
                    </div>
                    <hr>
                </div> <!-- The personal tab -->

                <div class="tab-content" id="history">
                    history
                </div> <!-- The history tab -->

                <div class="tab-content" id="notifications">
                    notification
                </div>  <!-- The Notification tab -->
            </div> <!-- User info space -->
        </div> <!-- Container -->
    </main>  <!-- End of main -->

    <!-- Include the footer -->
    <?php require_once(TEMPLATES_PATH."/footer.php"); ?>

    <script>
        function openTab(evt, tabName) {
            var i, tab_items;

            /* Hide all tabs */
            var tabs = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabs.length; i++) {
                tabs[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tab_items = document.getElementsByClassName("tab-item");
            for (i = 0; i < tab_items.length; i++) {
                tab_items[i].className = tab_items[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

</body>
</html>
