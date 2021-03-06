<?php

  /* This file keeps some important arrays and paths that are widely used on our code*/

  $config = array(
                  'db' => array(
                                'dbName'   =>  "ikadb",
                                'username' =>  "IkaUsr",
                                'password' =>  "ikausr",
                                'host'     =>  "localhost"
                              ),
                  'urlPahts' => array(
                                      'base_dir'   => '\Ika' ,
                                      'db_scripts' => '\Ika\resources\scripts\dbmanagment'
                                  ),
                  'info_table_names' => array(
                                     'telephone' => 'Τηλέφωνο',
                                     'surname'   => 'Επίθετο',
                                     'email'     => 'Email',
                                     'name'      => 'Όνομα',
                                     'AMKA'      => 'ΑΜΚΑ',
                                     'AFM'       => 'ΑΦΜ',
                                     )
                );

  /* Define pahts */
  defined("TEMPLATES_PATH")
        or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

  defined("DBMANAGMENT_PATH")
        or define("DBMANAGMENT_PATH", realpath(dirname(__FILE__) . '/scripts/dbmanagment'));

defined("SCRIPTS_PATH")
      or define("SCRIPTS_PATH", realpath(dirname(__FILE__) . '/scripts'));

 ?>
