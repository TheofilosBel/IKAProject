<?php
/* D*/
define('__ROOT__', "../../../");
require_once(__ROOT__."/resources/config.php");

/* Check if password and username are filed */
$message = '';
if (!isset($_POST['username'], $_POST['password']) || empty($_POST['username']) || empty($_POST['password'])) {
  $message = 'Please enter a valid username and password';
} else {

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
      echo "Non existing user";
    } else {
      if ($db_pass == $password)
        echo "Pass match";
        header("Location: http://example.com/myOtherPage.php");
        die();
      else
        echo "No match";
    }
  }
  catch(Exception $e){
    echo "We cant hanndle your request because of the following error :".$e->getMessage();;
  }
}
echo $message;
?>
