<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

$month = array(
    "ΙΑΝΟΥΑΡΙΟΣ",
    "ΦΕΒΡΟΥΑΡΙΟΣ",
    "ΜΑΡΤΙΟΣ",
    "ΑΠΡΙΛΙΟΣ",
    "ΜΑΙΟΣ",
    "ΙΟΥΝΙΟΣ",
    "ΙΟΥΛΙΟΣ",
    "ΑΥΓΟΥΣΤΟΣ",
    "ΣΕΠΤΕΜΒΡΙΟΣ",
    "ΟΚΤΩΒΡΙΟΣ",
    "ΝΟΕΜΒΡΙΟΣ",
    "ΔΕΚΕΜΒΡΙΟΣ"
);

function IsEmptyString($str) {
    return (!isset($str) || trim($str)==='');
}

/* Check if a user is loged in and redirect him to log in page if not */
require_once(SCRIPTS_PATH."/login_check_deref.php");

$message_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Get starting year */
    if (isset($_POST['year_from'])) {
        $year_from = $_POST['year_from'];
    }

    /* Get starting month */
    if (isset($_POST['month_from'])) {
        $month_from = $_POST['month_from'];
    }

    /* Get ending year */
    if (isset($_POST['year_to'])) {
        $year_to = $_POST['year_to'];
    }

    /* Get ending month */
    if (isset($_POST['month_to'])) {
        $month_to = $_POST['month_to'];
    }

    /* Check if time interval is valid */
    if ($year_from > $year_to) {
        $message_err = "Η αρχική ημερομηνία είναι αργότερα από την τελική.";
    }
    elseif ($year_from == $year_to) {
        if ($month_from > $month_to) {
            $message_err = "Η αρχική ημερομηνία είναι αργότερα από την τελική.";
        }
        elseif ($month_from == $month_to) {
            $message_err = "Η αρχική ημερομηνία είναι ίδια με την τελική.";
        }
    }

    /* Connect to the database and retrieve the personal info */
    if (empty($message_err)) {
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

            if (IsEmptyString($name) ||
                    IsEmptyString($surname) ||
                    IsEmptyString($telephone) ||
                    IsEmptyString($AMKA)) {
                $message_err = "Συμπληρώστε όλα τα στοιχεία με αστερίσκο στο προφίλ σας για να συνεχίσετε.";
            }

            if (empty($message_err)) {
                /* Create a new pdf with the user's info */
                require('tfpdf/tfpdf.php');
                $pdf = new tFPDF();
                $pdf->AddPage();

                $pdf->AddFont('DejaVu-B','','DejaVuSansCondensed-Bold.ttf',true);
                $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
                $pdf->SetFont('DejaVu-B','',16);
            
                /* Title */
                $pdf->Cell(40);
                $pdf->Cell(40,10,'ΙΚΑ - Ατομικός Λογαριασμός Ασφάλισης');
                $pdf->Ln(20);

                /* Info */
                $pdf->SetFont('DejaVu-B','',12);
                $pdf->Cell(35,10,'Όνομα: ');
                $pdf->SetFont('DejaVu','',12);
                $pdf->Cell(60,10,$name);
                $pdf->Ln(10);

                $pdf->SetFont('DejaVu-B','',12);
                $pdf->Cell(35,10,'Επώνυμο:');
                $pdf->SetFont('DejaVu','',12);
                $pdf->Cell(60,10,$surname);
                $pdf->Ln(10);

                $pdf->SetFont('DejaVu-B','',12);
                $pdf->Cell(35,10,'ΑΜΚΑ:');
                $pdf->SetFont('DejaVu','',12);
                $pdf->Cell(60,10,$telephone);
                $pdf->Ln(10);

                $pdf->SetFont('DejaVu-B','',12);
                $pdf->Cell(35,10,'Τηλέφωνο:');
                $pdf->SetFont('DejaVu','',12);
                $pdf->Cell(60,10,$AMKA);
                $pdf->Ln(20);

                /* Text */
                $pdf->Cell(20);
                $pdf->SetFont('DejaVu','',12);
                $pdf->MultiCell(0,5, 'Χορηγείται για κάθε νόμιμη χρήση ο ατομικός λογαριασμός ασφάλισης για την περίοδο:');
                $pdf->Ln(5);
                $pdf->Cell(20);
                $pdf->MultiCell(0,5,$month[$month_from-1].' '.$year_from.' - '.$month[$month_to-1].' '.$year_to);
            
                /* Create */
                $pdf->Output();
            }
        }

        catch(Exception $e) {
            echo "We cant handle your request because of the following error: ".$e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/insured_account.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Ατομικός Λογαριασμός Ασφάλισης</title>
    </head>

    <body>

        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>
        
        <main>
            <h1 style="margin-bottom: 25px;">Ατομικός Λογαριασμός Ασφάλισης</h1>

            <div class="info-space">
                <p>Επιλέξτε το χρονικό διάστημα του λογαριασμού που επιθυμείτε να εκδώσετε.</p>

                <form method="post" action="" name="form" target='_blank'>
                    <div class="tool-info-container">
                        <span>Έτος από:</span>
                        <div class="select-style">
                            <select name="year_from">
                                <?php
                                    $curent_year = date("Y") - 1;
                                    for ($y = $curent_year; $y >= 2002; $y--) {
                                        echo '<option>'.($y).'</option>';
                                    }
                                ?>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Μήνας από:</span>
                        <div class="select-style">
                            <select name="month_from">
                                <option value="1">ΙΑΝΟΥΑΡΙΟΣ</option>
                                <option value="2">ΦΕΒΡΟΥΑΡΙΟΣ</option>
                                <option value="3">ΜΑΡΤΙΟΣ</option>
                                <option value="4">ΑΠΡΙΛΙΟΣ</option>
                                <option value="5">ΜΑΙΟΣ</option>
                                <option value="6">ΙΟΥΝΙΟΣ</option>
                                <option value="7">ΙΟΥΛΙΟΣ</option>
                                <option value="8">ΑΥΓΟΥΣΤΟΣ</option>
                                <option value="9">ΣΕΠΤΕΜΒΡΙΟΣ</option>
                                <option value="10">ΟΚΤΩΒΡΙΟΣ</option>
                                <option value="11">ΝΟΕΜΒΡΙΟΣ</option>
                                <option value="12">ΔΕΚΕΜΒΡΙΟΣ</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Έτος εώς:</span>
                        <div class="select-style">
                            <select name="year_to">
                                <?php
                                    $curent_year = date("Y") - 1;
                                    for ($y = $curent_year; $y >= 2002; $y--) {
                                        echo '<option>'.($y).'</option>';
                                    }
                                ?>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Μήνας εώς:</span>
                        <div class="select-style">
                            <select name="month_to">
                                <option value="1">ΙΑΝΟΥΑΡΙΟΣ</option>
                                <option value="2">ΦΕΒΡΟΥΑΡΙΟΣ</option>
                                <option value="3">ΜΑΡΤΙΟΣ</option>
                                <option value="4">ΑΠΡΙΛΙΟΣ</option>
                                <option value="5">ΜΑΙΟΣ</option>
                                <option value="6">ΙΟΥΝΙΟΣ</option>
                                <option value="7">ΙΟΥΛΙΟΣ</option>
                                <option value="8">ΑΥΓΟΥΣΤΟΣ</option>
                                <option value="9">ΣΕΠΤΕΜΒΡΙΟΣ</option>
                                <option value="10">ΟΚΤΩΒΡΙΟΣ</option>
                                <option value="11">ΝΟΕΜΒΡΙΟΣ</option>
                                <option value="12">ΔΕΚΕΜΒΡΙΟΣ</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <br><span class="help-block"><?php echo $message_err; ?></span><br>

                        <div class="align-container">
                            <input type="submit" value="Έκδοση" class="print" href="#"></input>
                        </div>  <!-- End of the Align Div -->
                    </div>
                </form>
            </div>
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body> <!-- body -->
</html>
