<?php
include_once 'php_functions.php';
secure_session_start();

// Alle Session-Werte zurücksetzen
$_SESSION = array();

// hole Session-Parameter
$params = session_get_cookie_params();

// Aktuelles Cookie löschen
setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

// Vernichte die Session
header('Location: ../index.php');
session_destroy();
exit();
