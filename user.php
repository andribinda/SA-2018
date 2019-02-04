<?php
include_once 'includes/connect_db.php';
include_once 'includes/php_functions.php';

secure_session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Deine Wetter-App</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
  crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi3xVRrXvACBVxLdqqjJL_NngeZ4-cVXs&libraries=places"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
  crossorigin="anonymous"></script>
  <script src="https://unpkg.com/eva-icons"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/2.0.0/trianglify.min.js"></script>
  <script src="js/user.js"></script>
  <link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
  <link rel="stylesheet" type="text/css" href="css/weather-icons-wind.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <?php if (userlogin_check($mysqli) == true) : ?>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-center topNav">
    <form class="form-inline searchTop justify-content-center">
      <input class="form-control-lg formNavSearch" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search"> <p><h1><?= $user_id ?>"</h1></p>
    </form>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1 sidebar h-100">
      <ul class="nav flex-sm-column sideNav justify-content-center">
        <a href="#" class="sideNavItem" id="menuUser"><i data-eva="person-outline" data-eva-height="54" data-eva-width="54"></i></a>
        <a href="#modalLogout" class="sideNavItem" id="menuLogout"><i data-eva="power" data-eva-height="54" data-eva-width="54"></i></a>
        <a href="#modalAbout" class="sideNavItem" id="menuAbout"><i data-eva="question-mark" data-eva-height="54" data-eva-width="54"></i></a>
      </ul>
      </div>
      <div class="col-sm content">
          <div class="row">
            <div class="col-sm-4 panel-user panel-top">
              <a href="#" class="emptyLink" id="modalLaunchStandort"></a>
              <h1 class="text-center" id="standortOrt"></h1>
              <div class="row">
                <div class="col-6">
                  <div class="wUserContainerL text-center">
                    <i class="wi wi-night-sleet wi-xl piktogrammWUser" id="standortIcon"></i>
                    <h3 id="standortBeschreibung"></h3>
                </div>
              </div>
                <div class="col-6">
                  <div class="wUserContainerR text-left">
                    <ul class="ul-user-info">
                      <li id="standortTemperatur"><h2></h2></li>
                    </ul>
                  </div>
                </div>
            </div>
          </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-4 panel-user panel-top">
              <a href="#" class="emptyLink" id="modalLaunchHomebase"></a>
              <h1 class="text-center">Homebase</h1>
              <div class="row">
                <div class="col-6">
                  <div class="wUserContainerL text-center">
                    <i class="wi wi-night-sleet wi-xl piktogrammWUser"></i>
                    <h3>Leichter Regen</h3>
                </div>
              </div>
                <div class="col-6">
                  <div class="wUserContainerR text-left">
                    <ul class="ul-user-info">
                      <li id="HomebaseOrt"><h2>Baden</h2></li>
                      <li id="HomebaseTemperatur"><h2>7.2°C</h2></li>
                      <li id="HomebaseUhrzeit"><h2>12:16</h2></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-11 panel-user justify-content-center">
              <h1 class="text-center">Favoriten</h1>
              <div class="d-flex flex-wrap align-items-start favoriten-container">
                <div class="p-2 favorit">
                    <div class="row">
                      <div class="col-6">
                        <div class="wUserContainerL text-center">
                          <i class="wi wi-night-sleet wi-big piktogrammWUser"></i>
                          <h3>Leichter Regen</h3>
                      </div>
                    </div>
                      <div class="col-6">
                        <div class="wUserContainerR text-left">
                          <ul class="ul-user-info">
                            <li id="StandortOrt"><h2>Baden</h2></li>
                            <li id="StandortTemperatur"><h2>7.2°C</h2></li>
                            <li id="StandortUhrzeit"><h2>12:16</h2></li>
                          </ul>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
  </div>
</body>

<div class="modal fade" id="modalUser" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
				<a href="#" class="btn btn-primary btn-modal1">Speichern</a>
				<button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Abbrechen</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalAbout" role="dialog" aria-labelledby="modalAbout" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1>Hilfe</h1>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        <h2>About</h2>
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalStandort" role="dialog" aria-labelledby="modalStandort" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
		</div>
	</div>
</div>
<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
<?php endif; ?>
</html>
