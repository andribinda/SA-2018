<?php
include_once 'connect_db.php';
include_once 'php_functions.php';

secure_session_start(); // Unsere selbstgemachte sichere Funktion um eine PHP-Sitzung zu starten.

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
  }
    if ($stmtFav = $mysqli->prepare("SELECT fav_id, lat, lng FROM favorite WHERE user_id = ?;")) {
      error_log("Statement OK");
      error_log($userId);
      $stmtFav->bind_param('s',$userId);
      $stmtFav->execute();
      $result = $stmtFav->get_result();
      $favoriten = array();
      // while ($row = mysqli_fetch_assoc($result)) {
        $favoriten =$result->fetch_all(MYSQLI_ASSOC);
      // printf("%d ; %f ; %f \r\n", $row['fav_id'], $row['lat'], $row['lng']);
      print_r($favoriten);
  // }
}
}
