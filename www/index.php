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
        <?php include 'includes/header.php'; ?>  

        <main>
            <div class="container">
                <div class="main-opts">
                    <a href='a.php' class="box asfal"><img src="images/asf.png" height="70" width="70"><h2>Ασφαλισμένοι</h2></a>
                    <a href="#" class="box synta"><img src="images/synt.png" height="70" width="70"><h2>Συνταξιούχοι</h2></a>
                    <a href="#" class="box ergo"><img src="images/erg.png" height="70" width="70"><h2>Εργοδότες</h2></a>
                    <a href="#" class="box foreis"><img src="images/foreis.png" height="70" width="70"><h2>Φορείς</h2></a>
                </div>  <!--div child 1-->

                <div class="secondary-opts">
                    <a href="#" class="box faqs"><img src="images/faqs.png" height="70" width="70"><h2>Συχνές Ερωτήσεις - FAQs</h2></a>
                    <a href="#" class="box forum"><img src="images/forum.png" height="70" width="70"><h2>Φόρουμ</h2></a>
                    <a href="#" class="box epik"><img src="images/contact.png" height="70" width="70"><h2>Επικοινωνία</h2></a>
                </div>  <!--div child 2-->

            </div>  <!-- div -->
        </main>  <!-- main -->

        <!-- Include the footer -->
        <?php include 'includes/footer.php'; ?> 
    </body> <!-- body -->
</html>  
