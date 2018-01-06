<!DOCTYPE html>

<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Define variables and initialize with empty values */
$username = $password = $password_confirm = "";
$username_err = $password_err = $password_confirm_err = "";

/* Processing form data when form is submitted */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Check if password and username are filled */
    if (empty($_POST["username"])) {
        $username_err = "Εισάγετε το ψευδώνυμο χρήστη σας.";
    }
    else {
        $username = $_POST["username"];
    }

    /* Check if password is empty */
    if (empty($_POST['password'])) {
        $password_err = "Εισάγετε το συνθηματικό σας.";
    }
    else {
        $password = $_POST['password'];
    }

    /* Check if password confirmation is empty */
    if (empty($_POST['password_confirm'])) {
        $password_confirm_err = "Εισάγετε ξανά το συνθηματικό σας.";
    }
    else {
        $password_confirm = $_POST['password_confirm'];
    }

    if (empty($username_err) && empty($password_err) && empty($password_confirm_err)) {
        /* Get the username and password */
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        /* Passwords must have at leas 4 characters */
        if (strlen($password) < 4) {
            $password_err = "Το συνθηματικό πρέπει να περιέχει τουλάχιστον 4 χαρακτήρες.";
        }

        /* Check if passwords match */
        if (strcmp($password, $password_confirm) != 0) {
            $password_confirm_err = "Οι κωδικοί δεν ταιριάζουν.";
        }

        try {
            /* Get the connection */
            require_once(DBMANAGMENT_PATH.'/mysqlConnector.php');

            /* Query the db to check if the username already exists */
            $query = 'SELECT * FROM user_cred WHERE username=\''.$username.'\';';
            $result = $db_connection->query($query);
            if (!$result) die($db_connection->error);
            $result->data_seek(0);

            /* Display an error if the user already exists - usernames are unique */
            if ($result->num_rows > 0) {
                $username_err = "Το ψευδώνυμο χρήστη υπάρχει ήδη.";
            }
            else {
                /* Insert the user creadentials into the database */
                $query = 'INSERT INTO user_cred(username, password) VALUES (\''.$username.'\', \''.$password.'\');';
                $result = $db_connection->query($query);
                if (!$result) die($db_connection->error);

                /* User inserted to database, create a cookie */
                $cookie_name = "username";
                $cookie_val  = $username;
                setcookie($cookie_name, $cookie_val, time() + (86400 * 3));
                
                /* Redirect to home page */
                header("Location: signup_success.php");
                die();
            }

            /* Close the connection */
            $db_connection->close();
        }

        catch(Exception $e) {
            echo "We cant handle your request because of the following error: ".$e->getMessage();
        }
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/signup.css?<?php echo time(); ?>">
        <meta charset="utf8">
        <title>ΙΚΑ - Εγγραφή Χρήστη</title>
    </head>

    <body>

    <!-- Include the header -->
    <?php require_once(TEMPLATES_PATH."/header.php"); ?>

    <main>
        <div class="container">
            <h1>Εγγραφή στο ΙΚΑ</h1>
            <div class="login-box">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="name">Ψευδώνυμο χρήστη</label>
                    <div class="text-margin">
                    <input type="text" id="name" name="username" class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" autofocus>
                    <br><span class="help-block"><?php echo $username_err; ?></span><br>
                    </div>

                    <label for="pass">Συνθηματικό 
                        <span class="password-info">Τουλάχιστον 4 χαρακτήρες</span>
                    </label>
                    <div class="text-margin">
                    <input type="password" id="password" name="password" onkeyup='check_password();' class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <br><span class="help-block"><?php echo $password_err; ?></span><br>
                    </div>

                    <label for="pass_confirm">Επαλήθευση Συνθηματικού</label>
                    <div class="text-margin">
                    <input type="password" id="password_confirm" name="password_confirm" onkeyup='check_password();' class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <br><span class="help-block"><?php echo $password_confirm_err; ?></span><br>
                    </div>

                    <input type="submit" value="Εγγραφή">
                </form>
            </div>
        </div>
    </main>  <!-- main -->

    <!-- Include the footer -->
    <?php require_once(TEMPLATES_PATH."/footer.php"); ?>
    </body>
</html>
