<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <meta charset="utf8">
        <title>ΙΚΑ - Είσοδος Χρήστη</title>
    </head>

    <body>

    <!-- Include the header -->
    <?php include '../resources/templates/header.php' ?>

    <main>
        <div class="container">
            <h1>Σύνδεση στο ΙΚΑ</h1>
            <div class="login_box">
                <form action="#">
                    <label for="name">Ψευδώνυμο Χρήστη</label>
                    <input type="text" id="name" name="username" autofocus>

                    <label for="pass">Συνθηματικό</label>
                    <input type="text" id="pass" name="password">
                    <a href="#">Ξεχάσατε το συνθηματικό σας;</a>

                    <input type="submit" value="Είσοδος">
                </form> 
            </div>
            <div class="signup_box">
                <p>Είστε νέος χρήστης; <a href="#">Εγγραφείτε</a>.</p>
            </div>
        </div>
    </main>  <!-- main -->

    <!-- Include the footer -->
    <?php include '../resources/templates/footer.php' ?>
    </body>
</html>