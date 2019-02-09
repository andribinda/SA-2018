<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

secure_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.

if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];

    if (userlogin($email, $password, $mysqli) == true) {
        // Login erfolgreich
        header('Location: ../user.php');
    } else {
      header('Location: ../index.php?error-login');
    }
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt.
    echo 'Invalid Request';
}
