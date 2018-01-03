<?php

  /* This file keeps some important arrays and paths that are widely used on our code*/

  $config = array(
                  'db' => array(
                                'dbName'   =>  "ikadb",
                                'username' =>  "IkaUsr",
                                'password' =>  "ikausr",
                                'host'     =>  "localhost"
                               )
                );

  /* Define pahts */
  defined("TEMPLATES_PATH")
        or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

 ?>
