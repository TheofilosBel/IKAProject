<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

function IsEmptyString($str) {
    return (!isset($str) || trim($str)==='');
}

/* Check if a user is loged in and redirect him to log in page if not */
require_once(SCRIPTS_PATH."/login_check_deref.php");

$citizen = $am = $year = "";
$message_err = $am_err = $citizen_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Get starting year */
    if (isset($_POST['citizen'])) {
        $citizen = $_POST['citizen'];
    }

    /* Check if AM is given */
    if (empty($_POST["am"])) {
        $am_err = "Εισάγετε το Α.Μ. σας.";
    }
    else {
        $am = $_POST["am"];
    }

    /* Connect to the database and retrieve the personal info */
    if (empty($message_err) && empty($am_err)) {
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

            if (empty($message_err)) {
                /* Create a new pdf with the user's info */
                require('tfpdf/tfpdf.php');
                $pdf = new tFPDF();
                $pdf->AddPage();

                $pdf->AddFont('DejaVu-B','','DejaVuSansCondensed-Bold.ttf',true);
                $pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
                $pdf->SetFont('DejaVu-B','',16);

                /* Title */
                $pdf->Cell(30);
                $pdf->Cell(40,10,'ΙΚΑ - Βεβαίωση Σύνταξης Για Φορολογική Χρήση');
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
                $pdf->Cell(60,10,$AMKA);
                $pdf->Ln(10);

                $pdf->SetFont('DejaVu-B','',12);
                $pdf->Cell(35,10,'ΑFΜ:');
                $pdf->SetFont('DejaVu','',12);
                $pdf->Cell(60,10,$AFM);
                $pdf->Ln(10);

                $pdf->SetFont('DejaVu-B','',12);
                $pdf->Cell(35,10,'Τηλέφωνο:');
                $pdf->SetFont('DejaVu','',12);
                $pdf->Cell(60,10,$telephone);
                $pdf->Ln(20);

                /* Text */
                $pdf->Cell(20);
                $pdf->SetFont('DejaVu','',12);
                $pdf->MultiCell(0,5, 'Χορηγείται για κάθε νόμιμη χρήση η παρούσα βεβαίωση σύνταξης.');

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
        <link rel="stylesheet" type="text/css" href="css/pension_certificate.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Βεβαίωση Σύνταξης</title>
    </head>

    <body>

        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>

        <main>
            <h1 style="margin-bottom: 25px;">Βεβαίωση Σύνταξης</h1>

            <div class="info-space">
                <p>Εισάγετε τα στοιχεία σας στα παρακάτω πεδία.</p>

                <form method="post" action="" name="form" target='_blank'>
                    <div class="tool-info-container">
                        <span>Κάτοικος:</span>
                        <div class="select-style">
                            <select name="citizen">
                                <option value="1">Ελλάδος</option>
                                <option value="2">Εξωτερικού</option>
                            </select> <!-- End of Secelct -->
                        </div>
                        <br><span class="help-block"><?php echo $citizen_err; ?></span>

                        <span>Α.Μ.:</span>
                        <input type="text" id="am" name="am" placeholder="γράμματα και ψηφία" class="<?php echo (!empty($am_err)) ? 'has-error' : ''; ?>">
                        <br><span class="help-block"><?php echo $am_err; ?></span>

                        <span>Έτος:</span>
                        <div class="select-style">
                            <select name="year">
                                <?php
                                    $curent_year = date("Y") - 1;
                                    for ($y = $curent_year; $y >= 2010; $y--) {
                                        echo '<option>'.($y).'</option>';
                                    }
                                ?>
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
