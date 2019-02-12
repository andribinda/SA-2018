<?php
include_once 'connect_db.php';
include_once 'db_config.php';


if (isset ($_POST['email'], $_POST['pReg'], $_POST['homebasePlz'])) {
    // Bereinige und überprüfe die Daten
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // keine gültige E-Mail
        $error_msg = '1';
        header('Location: ../index.php?error-reg');
    } else {
        $password = filter_input(INPUT_POST, 'pReg', FILTER_SANITIZE_STRING);
        if (strlen($password) != 128) {
            // Das gehashte Passwort sollte 128 Zeichen lang sein.
            // Wenn nicht, dann ist etwas sehr seltsames passiert
            $error_msg = '2';
            header('Location: ../index.php?error-reg2');
        } else {
            $homebasePlz = filter_input(INPUT_POST, 'homebasePlz',FILTER_SANITIZE_STRING);
            if (strlen($homebasePlz) > 50) {
            $error_msg = '3';
            header('Location: ../index.php?error-reg3');
            } else {
              $prep_stmt = "SELECT id FROM users WHERE email = ? LIMIT 1";
              $stmt = $mysqli->prepare($prep_stmt);
                if ($stmt) {
                  $stmt->bind_param('s', $email);
                  $stmt->execute();
                  $stmt->store_result();
                  if ($stmt->num_rows == 1) {
                      // Ein Benutzer mit dieser E-Mail-Adresse existiert schon
                      $error_msg = '4';
                      header('Location: ../index.php?error-reg4');
                  }
                } else {
                  $error_msg = '5';
                  header('Location: ../index.php?error-reg5');
              }
}}};

    if (empty($error_msg)) {

        $salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Erstelle saltet Passwort
        $password = hash('sha512', $password . $salt);


        // Trage den neuen Benutzer in die Datenbank ein
        if ($insert_stmt = $mysqli->prepare("INSERT INTO users (email, homebasePlz ,password ,salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $email, $homebasePlz, $password, $salt);
            if (!$insert_stmt->execute()) {
              $error = $mysqli->errno . ' ' . $mysqli->error;
                  error_log($error);
            }
        } else {
              $error = $mysqli->errno . ' ' . $mysqli->error;
                  error_log($error);
                }
    header('Location: ../index.php?login');
    }
}
