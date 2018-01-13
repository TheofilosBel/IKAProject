<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Query the db to have the information ready when needed */
try {
    /* Get the connection */
    require_once(DBMANAGMENT_PATH.'/mysqlConnector.php');

    /* Get the id from the cookie */
    $cookies = explode('*', $_COOKIE['user']);
    $user_id = $cookies[1];
    $user_name = $cookies[0];

    /* Query the db for the user_cred */
    $query = 'SELECT * FROM user_info WHERE id=\''.$user_id.'\';';
    $result = $db_connection->query($query);
    if (!$result) die($db_connection->error);

    /* Get the user info */
    $result->data_seek(0);
    $user_info = $result->fetch_assoc();

    /* remove the id from the result */
    unset($user_info['id']);

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
    <link rel="stylesheet" type="text/css" href="css/tab_decoration.css">
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="./js/profile_jquery.js"></script>
    <script src="./js/tab_handler.js"></script>
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
                    <a class="tab-item" onclick="openTab(event, 'account')">Στοιχεία Λογαριασμού</a>
                    <a class="tab-item active" onclick="openTab(event, 'personal')">Προσωπικά Στοιχεία</a>
                    <a class="tab-item" onclick="openTab(event, 'history')">Ιστορικό Αιτήσεων</a>
                    <a class="tab-item" onclick="openTab(event, 'notifications')">Ειδοποιήσεις</a>
                </div> <!--  The tab selector bar -->

                <div class="tab-content" id="account">
                    account
                </div> <!-- The account tab-->
                <div class="tab-content active-tab" id="personal">

                    <?php foreach ($user_info as $key => $value): ?>
                        <div class="info-container">
                            <span style="margin-top:10px;"><b><?= $config['info_table_names'][$key] ?>
                                <?php if ($key != 'email'): ?>
                                    <span style="color:red;">*</span>
                                <?php endif; ?>
                            </b></span>
                            <span class="info-disp"><?php  echo $value?></span>
                            <input class="<?= $key?>"/>
                            <p class="save">Αποθήκευση</p>
                            <p class="edit">Επεξεργασία</p>
                        </div>  <!-- End the info container -->
                        <hr>
                    <?php endforeach; ?>

<!-- OLD WAY
<div class="info-container">
    <span style="margin-top:10px;"><b>Όνομα <span style="color:red;">*</span></b></span>
    <span class="info-disp"><?php  echo $user_info['name']?></span>
    <input class="name"/>
    <p class="save">Αποθήκευση</p>
    <p class="edit">Επεξεργασία</p>
</div>
<hr>
<div class="info-container">
    <span style="margin-top:10px;"><b>Επίθετο <span style="color:red;">*</span></b></span>
    <span class="info-disp"><?php  echo $user_info['surname']?></span>
    <input class="surname"/>
    <p class="save">Αποθήκευση</p>
    <p class="edit">Επεξεργασία</p>
</div>
<hr>
<div class="info-container">
    <span style="margin-top:10px;"><b>ΑΜΚΑ <span style="color:red;">*</span></b></span>
    <span class="info-disp"><?php  echo $user_info['AMKA']?></span>
    <input class="AMKA"/>
    <p class="save">Αποθήκευση</p>
    <p class="edit">Επεξεργασία</p>
</div>
<hr>
<div class="info-container">
    <span style="margin-top:10px;"><b>ΑΦΜ <span style="color:red;">*</span></b></span>
    <span class="info-disp"><?php  echo $user_info['AFM']?></span>
    <input class="AFM"/>
    <p class="save">Αποθήκευση</p>
    <p class="edit">Επεξεργασία</p>
</div>
<hr>
<div class="info-container">
    <span style="margin-top:10px;"><b>Email</b></span>
    <span class="info-disp"><?php  echo $user_info['email']?></span>
    <input class="email"/>
    <p class="save">Αποθήκευση</p>
    <p class="edit">Επεξεργασία</p>
</div>
<hr>
-->
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

</body>
</html>
