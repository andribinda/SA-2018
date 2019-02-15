<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

// Funktion um die PHP-Session zu starten
secure_session_start();

if (isset($_POST['userId'], $_POST['latFav'], $_POST['lngFav'])) {
  $userId = $_POST['userId'];
  $latFav = $_POST['latFav'];
  $lngFav = $_POST['lngFav'];

  if ($stmtFavAdd = $mysqli->prepare("INSERT INTO favorite (user_id, lat, lng) VALUES (?, ?, ?)")) {
    $stmtFavAdd->bind_param('idd', $userId, $latFav, $lngFav);
    if (!$stmtFavAdd->execute()) {
      $error = $mysqli->errno . ' ' . $mysqli->error;
      error_log($error);
    }
  } header('Location: ../user.php');
}
