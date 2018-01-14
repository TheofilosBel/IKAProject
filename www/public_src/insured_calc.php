<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ΙΚΑ - Υπολογισμός Ετών για Συνταξιοδότηση</title>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/tab_decoration.css">
        <link rel="stylesheet" type="text/css" href="css/insured_calc.css">
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
                <li><a href="insured.php">Υπηρεσίες προς Ασφαλισμένους</a></li>
                <li>Υπολογισμός Ετών για Συνταξιοδότηση</li>
            </ul>
            <h1 style="margin-bottom: 25px; text-align:center;">Υπολογισμός Ετών για Συνταξιοδότηση</h1>

            <div class="info-space">
                <div class="tab-selector">
                    <a class="tab-item active" onclick="openTab(event, 'tool')">Εργαλείο Υπολογισμού</a>
                    <a class="tab-item" onclick="openTab(event, 'help')">Οδηγίες Χρήσης Εργαλείου</a>
                    <a class="tab-item" onclick="openTab(event, 'info')">Γενικές Πληροφορίες Σύνταξης</a>
                </div> <!--  The tab selector bar -->

                <form id="myform">
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

                            <span>Συνολικές Ημέρες Εργασίας:</span>
                            <input type="text" id="days" name="days" class="days">

                            <span>Συνολικά Έτη Εργασίας:</span>
                            <input type="text" id="years" name="years" class="years">

                            <br><span class="help-block"></span><br>

                            <div class="align-container">
                                <button type="button" id="calculate" class="calculate" onclick="compute()">Υπολογισμός</button>
                                <button type="button" id="clean" class="clean" onclick="clean_form()">Καθαρισμός</button>
                            </div>  <!-- End of the Align Div -->
                        </div>  <!--End of The General Info Div -->
                    </div> <!-- The Main Tool tab-->
                </form>

                <!-- The Modal -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <p>Τα εκτιμώμενα έτη που απομένουν για συνταξιοδότηση είναι <span id="amount" style="font-weight: bold;"></span>.</p>
                    </div>
                </div>

                <script type="text/javascript">
                    function compute() {
                        /* Get the data from the form */
                        var days = 0;
                        var years = 0;

                        if (document.getElementsByClassName("days")[0].value) {
                            if (isNaN(document.getElementsByClassName("days")[0].value)) {
                                document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                                τα πεδία με αριθμούς.";
                                return;
                            }

                            days += parseInt(document.getElementsByClassName("days")[0].value);
                        }
                        else {
                            document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                            όλα τα πεδία.";
                            return;
                        }

                        if (document.getElementsByClassName("years")[0].value) {
                            if (isNaN(document.getElementsByClassName("years")[0].value)) {
                                document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                                τα πεδία με αριθμούς.";
                                return;
                            }

                            years += parseInt(document.getElementsByClassName("years")[0].value);
                        }
                        else {
                            document.getElementsByClassName("help-block")[0].innerHTML = "Πρέπει να συμπληρώσετε\
                            όλα τα πεδία.";
                            return;
                        }

                        /* Remove any previous errors */
                        document.getElementsByClassName("help-block")[0].innerHTML = "";

                        /* Compute the years needed to reach 10000 days */
                        var days_per_year = days / years;
                        var years_remaining = (10000 - days) / days_per_year;

                        if (years_remaining < 0) {
                            years_remaining = 0;
                        }

                        /* Get the modal */
                        var modal = document.getElementById("myModal");

                        /* Get the button that opens the modal */
                        var btn = document.getElementById("calculate");

                        /* Get the <span> element that closes the modal */
                        var span = document.getElementsByClassName("close")[0];

                        /* Open the modal */
                        document.getElementById('amount').innerHTML = years_remaining;
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
