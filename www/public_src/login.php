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
            <div class="login-box">
                <form action="#" method="post">
                    <label for="name">Ψευδώνυμο χρήστη</label>
                    <input type="text" id="name" name="username" autofocus>

                    <label for="pass">Συνθηματικό</label>
                    <input type="text" id="pass" name="password">
                    <a href="#">Ξεχάσατε το συνθηματικό σας;</a>

                    <div class="keep-login">
                        <input type="checkbox" id="keep-login" name="keep-login"/>
                        <label for="keep-login">Αυτόματη σύνδεση</label> 
                    </div>

                    <input type="submit" value="Είσοδος">
                </form> 
            </div>

            <div class="signup-box">
                <p>Είστε νέος χρήστης; <a href="#">Εγγραφείτε</a>.</p>
            </div>
        </div>
    </main>  <!-- main -->

    <!-- Include the footer -->
    <?php include '../resources/templates/footer.php' ?>
    </body>
</html>