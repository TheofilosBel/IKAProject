<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Αρχική Σελίδα</title>
    </head>

    <body>

        <!-- Include the header -->
        <?php
        define('__ROOT__', "../");
        require_once(__ROOT__."/resources/config.php");
        require_once(TEMPLATES_PATH."/header.php");
        require_once(TEMPLATES_PATH."/mysqlConnector.php");
        ?>

        <main>
            <div class="container">
                <div class="main-opts">
                    <a href='insured.php' class="box asfal"><img src="img/asf.png" height="70" width="70"><h3>Ασφαλισμένοι</h3></a>
                    <a href="pensioners.php" class="box synta"><img src="img/synt.png" height="70" width="70"><h3>Συνταξιούχοι</h3></a>
                    <a href="#" class="box ergo"><img src="img/erg.png" height="70" width="70"><h3>Εργοδότες</h3></a>
                    <a href="#" class="box foreis"><img src="img/foreis.png" height="70" width="70"><h3>Φορείς</h3></a>
                </div>  <!--div child 1-->

                <div class="secondary-opts">
                    <a href="#" class="box faqs"><img src="img/faqs.png" height="70" width="70"><h3>Συχνές Ερωτήσεις - FAQs</h3></a>
                    <a href="#" class="box forum"><img src="img/forum.png" height="70" width="70"><h3>Φόρουμ</h3></a>
                    <a href="#" class="box epik"><img src="img/contact.png" height="70" width="70"><h3>Επικοινωνία</h3></a>
                </div>  <!--div child 2-->

            </div>  <!-- div -->
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body> <!-- body -->
</html>
