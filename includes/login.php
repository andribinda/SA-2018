<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

secure_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.
$success = false;
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];
    error_log("POSTTEST");
    error_log($email);
    error_log($password);

    if (userlogin($email, $password, $mysqli) == true) {
        // Login erfolgreich
        $success = true;
    } else {
        $success = false;
    }
     return $success;
} else {
    // Die korrekten POST-Variablen wurden nicht zu dieser Seite geschickt.
    echo 'Invalid Request';
}
