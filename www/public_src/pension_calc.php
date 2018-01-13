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
        <script src="./js/tab_handler.js"></script>
    </head>


    <body>
        <!-- Include the header -->
        <?php require_once(TEMPLATES_PATH."/header.php");?>

        <main>
            <h1 style="margin-bottom: 25px;">Υπολογισμός Βασικού Ποσού Σύνταξης</h1>

            <div class="info-space">
                <div class="tab-selector">
                    <a class="tab-item active" onclick="openTab(event, 'tool')">Εργαλείο Υπολογισμού</a>
                    <a class="tab-item" onclick="openTab(event, 'help')">Οδηγίες Χρήσης Εργαλείου</a>
                    <a class="tab-item" onclick="openTab(event, 'info')">Γενικές Πληροφορίες Σύνταξης</a>
                </div> <!--  The tab selector bar -->

                <div class="tab-content active-tab" id="tool">
                    <div class="tool-info-container">
                        <span>Συνταξιοδοτικός Φορέας</span>
                        <div class="select-style">
                            <select name="pension-carrier">
                                <option value="IKA">IKA</option>
                                <option value="PIKA">PIKA</option>
                                <option value="MIKA">MIKA</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Τύπος Σύνταξης</span>
                        <div class="select-style">
                            <select name="pension-type">
                                <option value="Simple">Απλή</option>
                                <option value="Extra">Με απόλα</option>
                            </select> <!-- End of Secelct -->
                        </div>

                        <span>Σύνολο Ημερών Εργασίας</span>
                        <input type="text" name="num-of-days" class="num-of-days" value="0"/>
                    </div>  <!--End of The General Info Div -->
                    <hr>

                    <div class="tool-info-container">
                        <span class="align-start">Στοιχεία Τελευταίας <br> Δεκαετίας</span>

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

                        <div class="align-container">
                            <button type="button" class="calculate" onclick="compute()">Υπολογισμός</button>
                            <button type="button" class="clean">Καθαρισμός</button>
                        </div>  <!-- End of the Align Div -->
                    </div>  <!--End of The General Info Div -->
                </div> <!-- The Main Tool tab-->

                <script type="text/javascript">
                    function compute() {
                        /* Get num_of_days value */
                        var total_num_of_days = document.getElementsByClassName("num-of-days").value;

                        /* Get the data from the form */
                        var total_apodoxes = 0;
                        var total_hmeres = 0;
                        for (i = 0; i < 10; i++) {
                            total_apodoxes += document.getElementsByClassName("apodoxes")[i].value;
                            total_hmeres += document.getElementsByClassName("hmeres")[i].value;
                        }

                        document.write(total_num_of_days);
                        document.write(total_apodoxes);
                        document.write(total_hmeres);
                    }
                </script>

                <div class="tab-content" id="help">
                    HELP
                </div> <!-- The Help tab-->

                <div class="tab-content" id="info">
                    Info
                </div> <!-- The Info tab-->
        </main>  <!-- End of main -->


        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php");?>
    </body>
</html>
