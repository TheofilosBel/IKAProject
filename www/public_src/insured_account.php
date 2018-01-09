<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");
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

                <div class="tool-info-container">
                    <span>Έτος από:</span>
                    <div class="select-style">
                        <select name="year-from">
                            <?php
                                $curent_year = date("Y") - 1;
                                for ($y = $curent_year; $y >= 2002; $y--){
                                    echo '<option>'.($y).'</option>';
                                }
                            ?>
                        </select> <!-- End of Secelct -->
                    </div>

                    <span>Μήνας από:</span>
                    <div class="select-style">
                        <select name="month-from">
                            <option value="Jan">ΙΑΝΟΥΑΡΙΟΣ</option>
                            <option value="Feb">ΦΕΒΡΟΥΑΡΙΟΣ</option>
                            <option value="Mar">ΜΑΡΤΙΟΣ</option>
                            <option value="Apr">ΑΠΡΙΛΙΟΣ</option>
                            <option value="May">ΜΑΙΟΣ</option>
                            <option value="Jun">ΙΟΥΝΙΟΣ</option>
                            <option value="Jul">ΙΟΥΛΙΟΣ</option>
                            <option value="Aug">ΑΥΓΟΥΣΤΟΣ</option>
                            <option value="Sep">ΣΕΠΤΕΜΒΡΙΟΣ</option>
                            <option value="Oct">ΟΚΤΩΒΡΙΟΣ</option>
                            <option value="Nov">ΝΟΕΜΒΡΙΟΣ</option>
                            <option value="Dec">ΔΕΚΕΜΒΡΙΟΣ</option>
                        </select> <!-- End of Secelct -->
                    </div>

                    <span>Έτος εώς:</span>
                    <div class="select-style">
                        <select name="year-from">
                            <?php
                                $curent_year = date("Y") - 1;
                                for ($y = $curent_year; $y >= 2002; $y--){
                                    echo '<option>'.($y).'</option>';
                                }
                            ?>
                        </select> <!-- End of Secelct -->
                    </div>  

                    <span>Μήνας εώς:</span>
                    <div class="select-style">
                        <select name="month-from">
                            <option value="Jan">ΙΑΝΟΥΑΡΙΟΣ</option>
                            <option value="Feb">ΦΕΒΡΟΥΑΡΙΟΣ</option>
                            <option value="Mar">ΜΑΡΤΙΟΣ</option>
                            <option value="Apr">ΑΠΡΙΛΙΟΣ</option>
                            <option value="May">ΜΑΙΟΣ</option>
                            <option value="Jun">ΙΟΥΝΙΟΣ</option>
                            <option value="Jul">ΙΟΥΛΙΟΣ</option>
                            <option value="Aug">ΑΥΓΟΥΣΤΟΣ</option>
                            <option value="Sep">ΣΕΠΤΕΜΒΡΙΟΣ</option>
                            <option value="Oct">ΟΚΤΩΒΡΙΟΣ</option>
                            <option value="Nov">ΝΟΕΜΒΡΙΟΣ</option>
                            <option value="Dec">ΔΕΚΕΜΒΡΙΟΣ</option>
                        </select> <!-- End of Secelct -->
                    </div>

                    <div class="align-container">
                        <button type="button" class="print">Έκδοση</button>
                    </div>  <!-- End of the Align Div -->
                </div>
            </div>
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body> <!-- body -->
</html>
