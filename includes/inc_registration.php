<?php
include_once 'connect_db.php';
include_once 'db_config.php';

$error_msg = "";
$id = "DEFAULT";
error_log($_POST['email']);
error_log($_POST['pReg']);

if (isset ($_POST['email'], $_POST['pReg'])) {
  error_log("gesetzt");
    // Bereinige und überprüfe die Daten
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // keine gültige E-Mail
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
        error_log("fehler 1");
    }

    $password = filter_input(INPUT_POST, 'pReg', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // Das gehashte Passwort sollte 128 Zeichen lang sein.
        // Wenn nicht, dann ist etwas sehr seltsames passiert
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
        error_log("fehler 2");
    }

    // Benutzername und Passwort wurde auf der Benutzer-Seite schon überprüft.
    // Das sollte genügen, denn niemand hat einen Vorteil, wenn diese Regeln
    // verletzt werden.
    //

    $prep_stmt = "SELECT id FROM users WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Ein Benutzer mit dieser E-Mail-Adresse existiert schon
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
            error_log("fehler 3");
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }

    if (empty($error_msg)) {
        // Erstelle ein zufälliges Salt
        error_log("salt erstellen");
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
        error_log($random_salt);

        // Erstelle saltet Passwort
        $password = hash('sha512', $password . $random_salt);


        // Trage den neuen Benutzer in die Datenbank ein
        if ($insert_stmt = $mysqli->prepare("INSERT INTO 'users' (email, homebasePlz ,password ,salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('ssss', $email, $homebasePlz, $password, $salt);
            error_log($email);
            error_log($homebasePlz);
            error_log($password);
            error_log($salt);
            // Führe die vorbereitete Anfrage aus.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
        } if ($mysqli->connect_errno) {
                    die('Connect Error: ' . $db->connect_errno);
                    }
         // header('Location: ../index.php');
    }
}
