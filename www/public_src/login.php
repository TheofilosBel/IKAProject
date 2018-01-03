<!DOCTYPE html>

<?php
define('__ROOT__', "../");
require_once(__ROOT__."/resources/config.php");

/* Define variables and initialize with empty values */
$message = '';
$username = $password = "";
$username_err = $password_err = "";

/* Processing form data when form is submitted */
if($_SERVER["REQUEST_METHOD"] == "POST"){

  /* Check if password and username are filed */
  if(empty(trim($_POST["username"]))){
      $username_err = 'Please enter username.';
  } else{
      $username = trim($_POST["username"]);
  }

  /* Check if password is empty */
  if(empty(trim($_POST['password']))){
      $password_err = 'Please enter your password.';
  } else{
      $password = trim($_POST['password']);
  }

  if(empty($username_err) && empty($password_err)){

    /* Get the username and password */
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
      /* Get the connection */
      require_once(DBMANAGMENT_PATH.'/mysqlConnector.php');

      /* Query the db for the user_cred*/
      $query = 'SELECT password FROM user_cred WHERE username=\''.$username.'\';';
      $result = $db_connection->query($query);
      if (!$result) die($db_connection->error);

      /* Get the user credentials */
      $result->data_seek(0);
      $db_pass = $result->fetch_assoc()['password'];

      /* Does the user exists, if yes do the passwords match */
      if ($result->num_rows != 1) {
        $username_err = 'Non existing user.';
      } else {
        if ($db_pass == $password) {

          header("Location: index.php");
          die();
        } else {
          /* Display error message */
          $password_err = 'The password you entered was not valid.';
        }
      }

      /* Close the connection */
      $db_connection->close();

    }
    catch(Exception $e){
      echo "We cant hanndle your request because of the following error :".$e->getMessage();;
    }
  }
  echo $message;
}
?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/general_layout.css">
        <link rel="stylesheet" type="text/css" href="css/login.css?<?php echo time(); ?>">
        <meta charset="utf8">
        <title>ΙΚΑ - Είσοδος Χρήστη</title>
    </head>

    <body>

    <!-- Include the header -->
    <?php require_once(TEMPLATES_PATH. "/header.php"); ?>

    <main>
        <div class="container">
            <h1>Σύνδεση στο ΙΚΑ</h1>
            <div class="login-box">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="name">Ψευδώνυμο χρήστη</label>
                    <div class="text-margin">
                    <input type="text" id="name" name="username" class="<?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" autofocus>
                    <span class="help-block"><?php echo $username_err; ?></span><br>
                    </div>

                    <label for="pass">Συνθηματικό</label>
                    <div class="text-margin">
                    <input type="text" id="pass" name="password" class="<?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <span class="help-block"><?php echo $password_err; ?></span><br>
                    </div>
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
    <?php require_once(TEMPLATES_PATH . "/footer.php"); ?>
    </body>
</html>
