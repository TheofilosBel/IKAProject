<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/accordion.css">
        <link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Υπηρεσίες προς Συνταξιούχους</title>
    </head>

    <body>
        <!-- Include the header -->
        <!-- Include the header -->
        <?php
        define('__ROOT__', "../");
        require_once(__ROOT__."/resources/config.php");
        require_once(TEMPLATES_PATH . "/header.php");
        ?>

        <main>
            <ul class="breadcrumb">
                <li><a href="index.php">Αρχική Σελίδα</a></li>
                <li>Υπηρεσίες προς Συνταξιούχους</li>
            </ul>
            
            <h1>Υπηρεσίες προς Συνταξιούχους</h1>
            <div class="container">
                <button class="accordion">Ηλεκτρονική Υποβολή Αίτησης Συνταξιοδότησης</button>
                <div class="panel">
                    <p>Μέσω της Ηλεκτρονικής Υπηρεσίας <b>"Ηλεκτρονική υποβολή αίτησης συνταξιοδότησης"</b>, παρέχεται
                    η δυνατότητα στον ασφαλισμένο να υποβάλλει ηλεκτρονικά την αίτηση για χορήγηση σύνταξης γήρατος
                    ή αναπηρίας, προς τους φορείς ΙΚΑ-ΕΤΑΜ και ΕΤΕΑ(τ. ΕΤΕΑΜ), οποιαδήποτε ώρα και ημέρα της
                    εβδομάδας το επιθυμεί. Η δυνατότητα της ηλεκτρονικής υποβολής της συνταξιοδοτικής αίτησης, δεν
                    παρέχεται στους ασφαλισμένους των ενταχθέντων Ταμείων στο ΙΚΑ-ΕΤΑΜ, στους υπαλλήλους των
                    Ν.Π.Δ.Δ. που επιλέγουν να συνταξιοδοτηθούν με τις Δημοσιοϋπαλληλικές διατάξεις, στους κατοίκους
                    κρατών μελών Ε.Ε., ΕΟΧ και Ελβετίας καθώς και σε όσους κατοικούν μόνιμα σε χώρες με τις οποίες
                    έχουμε συνάψει Διμερείς Συμβάσεις Κ.Α.<br><br>

                    Μέσω της Ηλεκτρονικής Υπηρεσίας <b>"Ηλεκτρονική Υπηρεσία παρακολούθησης της πορείας της αίτησης
                    συνταξιοδότησης ή του Προσδιορισμού Χρόνου Ασφάλισης"</b> παρέχεται η δυνατότητα στον
                    ασφαλισμένο, με την αξιοποίηση των δεδομένων του Ολοκληρωμένου Πληροφοριακού Συστήματος του ΙΚΑ
                    (ΟΠΣ -ΙΚΑ) να αντλεί πληροφορίες και να παρακολουθεί την πορεία εξέλιξης της αίτησης
                    συνταξιοδότησης ως και τη πορεία εξέλιξης της αίτησης για "Προσδιορισμό Χρόνου Ασφάλισης".<br><br>

                    <b>Για την πρόσβαση στις ανωτέρω Υπηρεσίες απαραίτητη προϋπόθεση είναι να έχει προηγηθεί η
                    πιστοποίηση του ασφαλισμένου στις Ηλεκτρονικές Υπηρεσίες του ΙΚΑ-ΕΤΑΜ.</b><br><br>

                    Μεταβείτε στην υπηρεσία <a href="pension_apply.php"><b>Ηλεκτρονική Υποβολή Αίτησης Συνταξιοδότησης</b></a>.<br><br>

                    Μεταβείτε στην υπηρεσία <a href="under_construction.php"><b>Ηλεκτρονική Παρακολούθηση της Πορείας της Αίτησης
                    Συνταξιοδότησης</b></a>.
                    </p>
                </div>

                <button class="accordion">Υπολογισμός Βασικού Ποσού Σύνταξης</button>
                <div class="panel">
                    <p> Μεταβείτε στο <a href="pension_calc.php"><b>Εργαλείο Υπολογισμού Βασικού Ποσού Σύνταξης</b></a>.
                    </p>
                </div>

                <button class="accordion">Πρόγραμμα Κατ' Οίκον Φροντίδας</button>
                <div class="panel">
                    <p>Σκοπός του προγράμματος είναι η κατοχύρωση συνθηκών αυτόνομης διαβίωσης των ηλικιωμένων και
                    των αναπήρων συνταξιούχων στην κατοικία τους, ώστε: να εξασφαλισθεί η παραμονή τους στο οικείο
                    φυσικό και κοινωνικό περιβάλλον, να αποφευχθεί η παραπομπή σε δομές κλειστής φροντίδας και να
                    προληφθούν καταστάσεις κοινωνικού αποκλεισμού.<br><br>

                    Το πρόγραμμα έχει ως περιεχόμενο:
                    <ul>
                    <li>Την κάλυψη βασικών αναγκών των ωφελούμενων με την οργάνωση και συστηματική παροχή υπηρεσιών
                    κοινωνικής εργασίας, ψυχοκοινωνικής στήριξης, νοσηλευτικής φροντίδας, φυσικοθεραπείας,
                    εργοθεραπείας και οικογενειακής βοήθειας.</li><br>

                    <li>Την ενημέρωση των εξυπηρετούμενων για τα δικαιώματα τους και την επαφή τους με τις αρμόδιες
                    υπηρεσίες υγείας και κοινωνικής προστασίας.</li><br>

                    <li>Τη διευκόλυνση των ωφελουμένων για τη συμμετοχή τους σε θρησκευτικές, πολιτιστικές,
                    ψυχαγωγικές και κοινωνικές δραστηριότητες.</li>
                    </ul>

                    Μεταβείτε στο <a href="under_construction.php"><b>Πρόγραμμα Κατ' Οίκον Φροντίδας</b></a>.
                    </p>
                </div>

                <button class="accordion">Βεβαίωση Συντάξεων Για Φορολογική Χρήση</button>
                <div class="panel">
                    <p>Μέσω της υπηρεσίας αυτής, έχετε τη δυνατότητα πληκτρολογώντας τα απαιτούμενα ασφαλιστικά σας στοιχεία να εκδώσετε τη «Βεβαίωση Συντάξεων Για Φορολογική Χρήση».<br><br>

                    Μεταβείτε στην υπηρεσία <a href="pension_certificate.php">
                    <b>Βεβαίωση Συντάξεων Για Φορολογική Χρήση</b></a>.
                    </p>
                </div>

                <button class="accordion">Πληροφόρηση Συνταξιούχων για ΑΜΚΑ-ΑΦΜ</button>
                <div class="panel">
                    <p>Μέσω της υπηρεσίας αυτής, έχετε τη δυνατότητα να πληροφορηθείτε για την ύπαρξη ή μη του ΑΦΜ και ΑΜΚΑ και να καταχωρήσετε αυτά σε περίπτωση που δεν υπάρχουν.<br><br>

                    Μεταβείτε στην υπηρεσία <a href="under_construction.php"><b>Πληροφόρηση Συνταξιούχων για ΑΜΚΑ-ΑΦΜ</b></a>.
                    </p>
                </div>

                <script>
                    var acc = document.getElementsByClassName("accordion");
                    var i;

                    for (i = 0; i < acc.length; i++) {
                        acc[i].addEventListener("click", function() {
                            this.classList.toggle("active");
                            var panel = this.nextElementSibling;
                            if (panel.style.maxHeight) {
                                panel.style.maxHeight = null;
                            }
                            else {
                                panel.style.maxHeight = panel.scrollHeight + "px";
                            }
                        });
                    }
                </script>
            </div>

        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH . "/footer.php"); ?>
    </body> <!-- body -->
</html>
