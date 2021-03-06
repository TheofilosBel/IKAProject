<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

function IsEmptyString($str) {
    return (!isset($str) || trim($str)==='');
}

/* Check if a user is loged in and redirect him to log in page if not */
require_once(SCRIPTS_PATH."/login_check_deref.php");

$citizen = $pension_type = $message_err = $message_success = "";
$name = $surname = $telephone = $AMKA = $AFM = "";

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

/* After hitting submit */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Check if the child's info were given */
    if (empty($_POST['name_child']) || empty($_POST['surname_child']) || empty($_POST['amka_child'])) {
        $message_err = "Συμπληρώστε όλα τα πεδία που αφορούν τα στοιχεία του τέκνου.";
    }

    /* Check if AMKA consists of 11 digits */
    if (!empty($_POST['amka_child'])) {
        if ((strlen($_POST['amka_child']) != 11) || (!ctype_digit($_POST['amka_child']))) {
            $message_err = "Το ΑΜΚΑ πρέπει να αποτελείται από 11 ψηφία.";
        }
    }

    if (empty($message_err)) {
        $message_success = "Η υποβολή έγινε επιτυχώς. Η αίτηση σας έχει τεθεί σε κατάσταση αναμονής.";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/pension_certificate.css">
        <link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Υποβολή Αίτησης Ασφάλισης Τέκνου</title>
    </head>

    <body>

        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>

        <main>
            <ul class="breadcrumb">
                <li><a href="index.php">Αρχική Σελίδα</a></li>
                <li><a href="insured.php">Υπηρεσίες προς Ασφαλισμένους</a></li>
                <li>Υποβολή Αίτησης Ασφάλισης Τέκνου</li>
            </ul>
            
            <h1 style="margin-bottom: 25px; text-align:center;">Υποβολή Αίτησης Ασφάλισης Τέκνου</h1>

            <div class="info-space">
                <span class="success-block" id="success-block"><?php echo $message_success; ?></span>
                <p>Επιβεβαιώστε την εγκυρότητα των στοιχείων σας και εισάγετε τα στοιχεία του τέκνου.</p>

                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="form">
                    <div class="tool-info-container">
                        <span>Ασφαλιστικός Φορέας:</span>
                        <div class="select-style">
                            <select name="citizen">
                                <option value="IKA">ΙΚΑ</option>
                                <option value="IKA-ETAM">ΙΚΑ-ΕΤΑΜ</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Όνομα:</span>
                        <input type="text" id="name" name="name" class="name" value="<?= $name; ?>" disabled>

                        <span>Επίθετο:</span>
                        <input type="text" id="surname" name="surname" class="surname" value="<?= $surname; ?>" disabled>

                        <span>Τηλέφωνο:</span>
                        <input type="text" id="tele" name="tele" class="tele" value="<?= $telephone; ?>" disabled>

                        <span>ΑΜΚΑ:</span>
                        <input type="text" id="amka" name="amka" class="amka" value="<?= $AMKA; ?>" disabled>

                        <span>ΑΦΜ:</span>
                        <input type="text" id="afm" name="afm" class="afm" value="<?= $AFM; ?>" disabled>

                        <span>Όνομα τέκνου:</span>
                        <input type="text" id="name_child" name="name_child" class="name_child">

                        <span>Επίθετο τέκνου:</span>
                        <input type="text" id="surname_child" name="surname_child" class="surname_child">

                        <span>ΑΜΚΑ τέκνου:</span>
                        <input type="text" id="amka_child" name="amka_child" class="amka_child">

                        <br><span class="help-block"><?php echo $message_err; ?></span><br>

                        <div class="align-container">
                            <input type="submit" value="Υποβολή" class="apply"></input>
                        </div>  <!-- End of the Align Div -->
                    </div>
                </form>
            </div>
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body> <!-- body -->
</html>
