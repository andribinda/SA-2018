<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

secure_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.

// error_log($_POST['emailUser']);
// error_log($_POST['user_id']);
// error_log($_POST['pPW']);

if (isset($_POST['emailUser'], $_POST['user_id'])) {
  $userId = $_POST['user_id'];
  $email = $_POST['emailUser'];
  error_log($userId);
  error_log($email);

  if ($stmtEmail = $mysqli->prepare("UPDATE users SET email = ? WHERE user_id = ?")) {
    $stmtEmail->bind_param('si', $email, $userId);
    if (!$stmtEmail->execute()) {
      $error = $mysqli->errno . ' ' . $mysqli->error;
      error_log($error);
    }
  }
}

else if (isset($_POST['pPW'], $_POST['user_id'])) {
  $userId = $_POST['user_id'];

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
