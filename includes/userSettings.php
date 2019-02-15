<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

secure_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.

if (isset($_POST['emailUser'], $_POST['user_id'])) {
  $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT );
  $email = filter_input(INPUT_POST, 'emailUser', FILTER_SANITIZE_EMAIL);

  if ($stmtEmail = $mysqli->prepare("UPDATE users SET email = ? WHERE user_id = ?")) {
    $stmtEmail->bind_param('si', $email, $userId);
    if (!$stmtEmail->execute()) {
      $error = $mysqli->errno . ' ' . $mysqli->error;
      error_log($error);
    }
  }
}

else if (isset($_POST['pPW'], $_POST['user_id'])) {
  $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT );
  $pw = filter_input(INPUT_POST, 'pPW', FILTER_SANITIZE_STRING);
  if (strlen($pw) != 128) {
      $error_msg = '1';
  }

  if (empty($error_msg)) {

      $salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
      $pw = hash('sha512', $pw . $salt);

    if ($stmtFavAdd = $mysqli->prepare("UPDATE users SET password = ?, salt = ? WHERE user_id = ?")) {
    $stmtFavAdd->bind_param('ssi', $pw, $salt, $userId);
    if (!$stmtFavAdd->execute()) {
      $error = $mysqli->errno . ' ' . $mysqli->error;
      error_log($error);
      }
    }
  }
}

else if (isset($_POST['tempRadio'], $_POST['user_id'])) {
  $tempSelection = filter_input(INPUT_POST, 'tempRadio', FILTER_SANITIZE_STRING);
  $userId = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

  if (strlen($tempSelection) != 1) {
      $error_msg = '1';
  }

  if (empty($error_msg)) {

  if ($stmtTemp = $mysqli->prepare("UPDATE users SET tempSelection = ? WHERE user_id = ?")) {
    $stmtTemp->bind_param('si', $tempSelection, $userId);
    if (!$stmtTemp->execute()) {
      $error = $mysqli->errno . ' ' . $mysqli->error;
      error_log($error);
    }
  }
  }
}
