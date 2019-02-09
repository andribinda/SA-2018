<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

secure_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.

function login(){
  $success = false;
  if (isset($_POST['email'], $_POST['p'])) {
      $email = $_POST['email'];
      $password = $_POST['p'];
      error_log("POSTTEST");
      error_log($email);
      error_log($password);

      if (userlogin($email, $password, $mysqli) == true) {
        error_log("SUCCESS");
          // Login erfolgreich
          $success = true;
      } else {
          $success = false;
      }
      error_log($success);
       return $success;
  } else {
      // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt.
      echo 'Invalid Request';
  }
}
