<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ΙΚΑ - Υπολογισμός Βασικού Ποσού Σύνταξης</title>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/tab_decoration.css">
        <link rel="stylesheet" type="text/css" href="css/pension_calc.css">
        <link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
        <script src="./js/tab_handler.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>


    <body>
        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>

        <main>
            <ul class="breadcrumb">
                <li><a href="index.php">Αρχική Σελίδα</a></li>
                <li><a href="insured.php">Υπηρεσίες προς Συνταξιούχους</a></li>
                <li>Υπολογισμός Βασικού Ποσού Σύνταξης</li>
            </ul>
            
            <h1 style="margin-bottom: 25px; text-align:center;">Υπολογισμός Βασικού Ποσού Σύνταξης</h1>

            <div class="info-space">
                <div class="tab-selector">
                    <a class="tab-item active" onclick="openTab(event, 'tool')">Εργαλείο Υπολογισμού</a>
                    <a class="tab-item" onclick="openTab(event, 'help')">Οδηγίες Χρήσης Εργαλείου</a>
                    <a class="tab-item" onclick="openTab(event, 'info')">Γενικές Πληροφορίες Σύνταξης</a>
                </div> <!--  The tab selector bar -->

                <div class="tab-content active-tab" id="tool">
                    <div class="tool-info-container">
                        <span>Συνταξιοδοτικός Φορέας:</span>
                        <div class="select-style">
                            <select name="pension-carrier">
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
                    </div>  <!--End of The General Info Div -->
                    <hr>

                    <div class="tool-info-container">
                        <span class="align-start">Στοιχεία Τελευταίας <br> Δεκαετίας</span>

                        <form id="myform">
                            <div class="tool-table-container">
                                <span>Έτος</span>
                                <span>Αποδοχές</span>
                                <span>Ημέρες Εργασίας</span>
                                <?php
                                    $curent_year = date("Y") - 1;
                                    for ($y = 0; $y < 10; $y++) {
                                        echo '<p>'.($curent_year-$y).'</p>'.'<input class="apodoxes"/><input class="hmeres"/>';
                                    }
                                ?>
                            </div>  <!-- End of the table Div -->
                            <br><span class="help-block"></span><br>

                            <div class="align-container">
                                <button type="button" id="calculate" class="calculate" onclick="compute()">Υπολογισμός</button>
                                <button type="button" id="clean" class="clean" onclick="clean_form()">Καθαρισμός</button>
                            </div>  <!-- End of the Align Div -->
                        </form>
                    </div>  <!--End of The General Info Div -->
                </div> <!-- The Main Tool tab-->

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Το ποσό της σύνταξης σας είναι <span id="amount" style="font-weight: bold;"></span> ευρώ.</p>
                    </div>
                </div>

                <script type="text/javascript">
                    function compute() {
                        var flag_row; /* To ensure that both values in a row are given */
                        var flag_none = 1; /* To ensure that at least on value is given in the form */

                        /* Get the data from the form */
                        var total_apodoxes = 0;
                        var total_hmeres = 0;

                        for (i = 0; i < 10; i++) {
                            flag_row = 0;

                            if (document.getElementsByClassName("apodoxes")[i].value) {
                                if (isNaN(document.getElementsByClassName("apodoxes")[i].value)) {
                                    document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                                    τα πεδία με αριθμούς.";
                                    return;
                                }

                                total_apodoxes += parseInt(document.getElementsByClassName("apodoxes")[i].value);
                                flag_row = 1;
                                flag_none = 0;
                            }

                            if (document.getElementsByClassName("hmeres")[i].value) {
                                if (isNaN(document.getElementsByClassName("hmeres")[i].value)) {
                                    document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                                    τα πεδία με αριθμούς.";
                                    return;
                                }

                                total_hmeres += parseInt(document.getElementsByClassName("hmeres")[i].value);
                                if (flag_row == 0) {
                                    document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                                    και τα δύο πεδία σε κάθε γραμμή.";
                                    return;
                                }
                                flag_none = 0;
                            }
                            else {
                                if (flag_row == 1) {
                                    document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                                    και τα δύο πεδία σε κάθε γραμμή.";
                                    return;
                                }
                            }
                        }

                        /* Check if at least onw value was given */
                        if (flag_none == 1) {
                            document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                            τουλάχιστον μια γραμμή.";
                            return;
                        }

                        /* Remove any previous errors */
                        document.getElementsByClassName("help-block")[0].innerHTML = "";

                        /* Compute the pension amount */
                        var total_amount = total_apodoxes * total_hmeres;
                        var pension_amount = 0;

                        if (total_amount < 1000) {
                            pension_amount = 100;
                        }
                        else if (total_amount < 5000) {
                            pension_amount = 300;
                        }
                        else if (total_amount < 10000) {
                            pension_amount = 500;
                        }
                        else if (total_amount < 20000) {
                            pension_amount = 800;
                        }
                        else {
                            pension_amount = 1000;
                        }

                        /* Get the modal */
                        var modal = document.getElementById("myModal");

                        /* Get the button that opens the modal */
                        var btn = document.getElementById("calculate");

                        /* Get the <span> element that closes the modal */
                        var span = document.getElementsByClassName("close")[0];

                        /* Open the modal */
                        document.getElementById('amount').innerHTML = pension_amount;
                        modal.style.display = "block";

                        /* When the user clicks on <span> (x), close the modal */
                        span.onclick = function() {
                            modal.style.display = "none";
                        }

                        /* When the user clicks anywhere outside of the modal, close it */
                        window.onclick = function(event) {
                            if (event.target == modal) {
                                modal.style.display = "none";
                            }
                        }
                    }

                    function clean_form() {
                        document.getElementById("myform").reset();
                    }
                </script>

                <div class="tab-content" id="help">
                </div> <!-- The Help tab-->

                <div class="tab-content" id="info">
                </div> <!-- The Info tab-->
        </main>  <!-- End of main -->


        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php");?>
    </body>
</html>
