<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

function IsEmptyString($str) {
    return (!isset($str) || trim($str)==='');
}

/* Check if a user is loged in and redirect him to log in page if not */
require_once(SCRIPTS_PATH."/login_check_deref.php");

$name = $surname = $telephone = $AMKA = $AFM = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['citizen'])) {
        $citizen = $_POST['citizen'];
    }

    if (isset($_POST['pension-type'])) {
        $pension_type = $_POST['pension-type'];
    }

    /* Connect to the database and retrieve the personal info */
    try {
        /* Get the connection */
        require_once(DBMANAGMENT_PATH.'/mysqlConnector.php');

        /* Check if the user is logged in */
        $cookie_name = "user";

        if (!isset($_COOKIE[$cookie_name])) {
            die();
        }
        else {
            $cookie_value = $_COOKIE[$cookie_name];
        }

        /* Get the username the cookie value (username*userid) */
        $username = strtok($cookie_value, "*");

        /* Query the db for the user_cred */
        $query = 'SELECT id FROM user_cred WHERE username=\''.$username.'\';';
        $result = $db_connection->query($query);
        if (!$result) die($db_connection->error);

        $result->data_seek(0);
        $result_row = $result->fetch_assoc();
        $db_id = $result_row['id'];

        /* Query the db for the user_info */
        $query = 'SELECT * FROM user_info WHERE id=\''.$db_id.'\';';
        $result = $db_connection->query($query);
        if (!$result) die($db_connection->error);

        $result->data_seek(0);
        $result_row = $result->fetch_assoc();

        /* Get the user's info and check if they are empty */
        $name = $result_row['name'];
        $surname = $result_row['surname'];
        $telephone = $result_row['telephone'];
        $AMKA = $result_row['AMKA'];
        $AFM = $result_row['AFM'];

        if (IsEmptyString($name) ||
                IsEmptyString($surname) ||
                IsEmptyString($telephone) ||
                IsEmptyString($AMKA) ||
                IsEmptyString($AFM)) {
            $message_err = "Συμπληρώστε όλα τα στοιχεία με αστερίσκο στο προφίλ σας για να συνεχίσετε.";
        }
    }

    catch(Exception $e) {
        echo "We cant handle your request because of the following error: ".$e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/pension_certificate.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Υποβολή Αίτησης Συνταξιοδότησης</title>
    </head>

    <body>

        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>

        <main>
            <h1 style="margin-bottom: 25px; text-align:center;">Υποβολή Αίτησης Συνταξιοδότησης</h1>

            <div class="info-space">
                <p>Εισάγετε τα στοιχεία σας στα παρακάτω πεδία.</p>

                <form method="post" action="" name="form">
                    <div class="tool-info-container">
                        <span>Συνταξιοδοτικός Φορέας:</span>
                        <div class="select-style">
                            <select name="citizen">
                                <option value="IKA">ΙΚΑ</option>
                                <option value="IKA-ETAM">ΙΚΑ-ΕΤΑΜ</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Τύπος Σύνταξης:</span>
                        <div class="select-style">
                            <select name="pension-type">
                                <option value="Simple">Απλή</option>
                                <option value="Extra">Αναπηρική</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Όνομα:</span>
                        <input type="text" id="name" name="name" class="name" value="<?php isset($name)?$name:""; ?>" disabled>

                        <span>Επίθετο:</span>
                        <input type="text" id="surname" name="surname" class="surname" disabled>

                        <span>Τηλέφωνο:</span>
                        <input type="text" id="tele" name="tele" class="tele" disabled>

                        <span>ΑΜΚΑ:</span>
                        <input type="text" id="amka" name="amka" class="amka" disabled>

                        <span>ΑΦΜ:</span>
                        <input type="text" id="afm" name="afm" class="afm" disabled>

                        <br><span class="help-block"><?php echo $message_err; ?></span><br>

                        <div class="align-container">
                            <input type="submit" value="Υποβολή" class="apply" href="#"></input>
                        </div>  <!-- End of the Align Div -->
                    </div>
                </form>
            </div>
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body> <!-- body -->
</html>
