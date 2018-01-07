<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");





?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ΙΚΑ-ΠΡΟΦΙΛ</title>
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
        </div>  <!-- Circle for the photo -->

        Username
      </div> <!-- Photo space -->

      <div class="info-space">

        <div class="tab-selector">
            <button class="bar-item" onclick="openTab('account')">Στοιχεία Λογαριασμού
            <button class="bar-item" onclick="openTab('personal')">Προσωπικά Στεοιχεία
            <button class="bar-item" onclick="openTab('request')">Ιστορικό Αιτήσεων
            <button class="bar-item" onclick="openTab('notification')">Ειδοποιήσεις
        </div>  <!--  The tab selector bar -->

        <div class="tab-container" id="account">
          account
        </div> <!-- The account tab-->

        <div class="tab-container" id="personal">
          personal
        </div>  <!-- The personal tab -->

        <div class="tab-container" id="request">
          request
        </div> <!-- The Request tab -->

        <div class="tab-container" id="notification">
          notification
        </div>  <!-- The Notification tab -->
      </div> <!-- User info space -->
    </div> <!-- Container -->

  </main>  <!-- End of main -->

  <!-- Include the footer -->
  <?php require_once(TEMPLATES_PATH."/footer.php"); ?>


  <script>
  function openTab(tabName) {
    var i;
    var tabs = document.getElementsByClassName("tab-container");

    /* Hide all tabs */
    for (i = 0; i < tabs.length; i++) {
      tabs[i].style.display = "none";
    }

    /* Display the one selected */
    document.getElementById(tabName).style.display = "block";
  }
  </script>


</body>

</html>
