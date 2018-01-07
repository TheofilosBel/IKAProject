<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

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
                Username
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
                    personal
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
