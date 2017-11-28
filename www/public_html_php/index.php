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
        <?php include '../resources/templates/header.php'; ?>  

        <main>
            <div class="container">
                <div class="main-opts">
                    <a href='a.php' class="box asfal"><img src="img/asf.png" height="70" width="70"><h2>Ασφαλισμένοι</h2></a>
                    <a href="#" class="box synta"><img src="img/synt.png" height="70" width="70"><h2>Συνταξιούχοι</h2></a>
                    <a href="#" class="box ergo"><img src="img/erg.png" height="70" width="70"><h2>Εργοδότες</h2></a>
                    <a href="#" class="box foreis"><img src="img/foreis.png" height="70" width="70"><h2>Φορείς</h2></a>
                </div>  <!--div child 1-->

                <div class="secondary-opts">
                    <a href="#" class="box faqs"><img src="img/faqs.png" height="70" width="70"><h2>Συχνές Ερωτήσεις - FAQs</h2></a>
                    <a href="#" class="box forum"><img src="img/forum.png" height="70" width="70"><h2>Φόρουμ</h2></a>
                    <a href="#" class="box epik"><img src="img/contact.png" height="70" width="70"><h2>Επικοινωνία</h2></a>
                </div>  <!--div child 2-->

            </div>  <!-- div -->
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php include '../resources/templates/footer.php'; ?> 
    </body> <!-- body -->
</html>  
