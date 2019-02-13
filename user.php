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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi3xVRrXvACBVxLdqqjJL_NngeZ4-cVXs&libraries=places"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
  crossorigin="anonymous"></script>
  <script src="https://unpkg.com/eva-icons"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/2.0.0/trianglify.min.js"></script>
  <script src="js/user.js"></script>
  <script src="js/form.js"></script>
  <script src="js/sha512.js"></script>
  <link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
  <link rel="stylesheet" type="text/css" href="css/weather-icons-wind.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <?php if (userlogin_check($mysqli) == true) : ?>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-center topNav">
    <form class="form-inline searchTop justify-content-center">
      <input class="form-control-lg formNavSearch text-center" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search"></p>
    </form>
  </div>
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-1 sidebar h-100">
      <ul class="nav flex-sm-column sideNav justify-content-center">
        <a href="#" class="sideNavItem" id="menuUser"><i data-eva="person-outline" data-eva-fill="#d8eaf1" data-eva-height="54" data-eva-width="54"></i></a>
        <a href="/includes/logout.php" class="sideNavItem" id="menuLogout"><i data-eva="power" data-eva-fill="#d8eaf1" data-eva-height="54" data-eva-width="54"></i></a>
        <a href="#modalAbout" class="sideNavItem" id="menuAbout"><i data-eva="question-mark" data-eva-fill="#d8eaf1" data-eva-height="54" data-eva-width="54"></i></a>
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
                    <i class="wi wi-xl piktogrammWUser" id="standortIcon"></i>
                    <h2 id="standortTemperatur" class="text-right"></h2>
                    <h4 id="standortBeschreibung" class="text-right"></h4>
                </div>
              </div>
                <div class="col-6">
                  <div class="wUserContainerR text-left">
                    <ul class="ul-user-info" id="standortInfo">
                    </ul>
                  </div>
                </div>
            </div>
          </div>
            <div class="col-sm-3">
              <div class="row">
                <form action="includes/favorite.php" method="post" name="addFav" id="addFav">
    							<div hidden class="form-row">
    								<div class="form-group col-sm-8">
    									<input type="text" name='userId' class="form-control" id="userIdFav">
                      <input type="text" name='latFav' class="form-control" id="latFav">
                      <input type="text" name='lngFav' class="form-control" id="lngFav">
    								</div>
    							</div>
    						<button type='button' class="btn-fav" id="btnAddFavorite" onclick="addFavorite(this.form, this.form.userId, this.form.latFav, this.form.lngFav)"><h2>Favorit hinzufügen</h2></button>
    						</form>
              </div>
            </div>
            <div class="col-sm-4 panel-user panel-top">
              <a href="#" class="emptyLink" id="modalLaunchHomebase"></a>
              <h1 class="text-center" id="homebaseOrt"></h1>
              <p hidden id="pPlz"><?php print($_SESSION['plz']); ?></p><p hidden id="pID"><?php print($_SESSION['user_id']); ?></p>
              <div class="row">
                <div class="col-6">
                  <div class="wUserContainerL text-center">
                    <i class="wi wi-xl piktogrammWUser" id="homebaseIcon"></i>
                    <h2 id="homebaseTemperatur" class="text-right"></h2>
                    <h4 id="homebaseBeschreibung" class="text-right"></h4>
                </div>
              </div>
                <div class="col-6">
                  <div class="wUserContainerR text-left">
                    <ul class="ul-user-info" id="homebaseInfo">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-11 panel-user justify-content-center">
              <h1 class="text-center">Favoriten</h1>
              <div hidden id=favoritenListe><?php echo($_SESSION['favoriten']) ?></div>
              <div class="d-flex flex-wrap align-items-start favoriten-container" id="favoriten-container"></div>
      </div>
    </div>
  </div>
</body>

<div class="modal fade" id="modalUser" role="dialog" aria-labelledby="modalUser" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <form action="" method="post" name="formUpdateEmail" id="formUpdateEmail">
            <div class="form-group col-sm-8">
              <label for="updateEmailInput" class="modalFormLabel">Email-Adresse ändern</label>
              <input type="email" name='emailUser' class="form-control" id="updateEmailInput" placeholder="Email-Adresse">
              <button type="button" id="btnUpdateEmail" class="btn btn-modalUser" onclick="updateEmail(form, emailUser)">Bestätigen</button>
            </div>
        </form>
        <form action="" method="post" name="formUpdatePassword" id="formUpdatePassword">
            <div class="form-group col-sm-8">
              <label for="passwordInputUser" class="modalFormLabel">Passwort ändern</label>
              <input type="password" name='password' class="form-control" id="passwordInputUser" placeholder="Passwort">
              <input type="password" name='passwordConfirm' class="form-control" id="passwordInputUserConfirm" placeholder="Passwort bestätigen">
              <button type="button" id="btnUpdatePassword" class="btn btn-modalUser" onclick="updatePassword(form, password, passwordConfirm)">Bestätigen</button>
            </div>
          </form>
          <form>
            <div class="form-group col-sm-8">
            <label for="btnCelcius" class="modalFormLabel">Temperaturanzeige ändern</label>
            <div data-toggle="buttons-radio">
            <button type="button" class="btn btn-modalTemp" id="btnCelcius" data-info='{"post":"1"}'> °C </button><button type="button" class="btn btn-modalTemp" id="btnFarenheit" data-info='{"post":"0"}'> °F </button>
            </div>
            </div>
          </form>
          </div>
          <button type="button" class="btn btn-modal2" data-dismiss="modal" aria-label="Close">Schliessen</button>
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
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <h2>About</h2>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalDetail" role="dialog" aria-labelledby="modalDetail" aria-hidden="true">
	<div class="modal-dialog mw-100 modalSize modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 id="userPageDetailHeader"></h2>
        <div class="row">
    			<div class="col-sm panel text-center">
    				<h2 id="day_name1"></h2>
    						<div class= "row justify-content-center">
    							<div class="col-6 col-sm-12 iconDiv text-center" id="day1Container">
    								<i class="wi wi-medium piktogrammWUserDetail" id="wIconD1"></i>
    								<ul class ="ul-user" id="d1Temp"></ul>
    							</div>
    							<div class="col-6 col-sm-12">
    									<ul class="ul-user-info-detail" id="d1Info"></ul>
    							</div>
    				</div>
    				</ul>
    			</div>
    			<div class="col-sm panel text-center">
    				<h2 id="day_name2"></h2>
    						<div class= "row justify-content-center">
    							<div class="col-6 col-sm-12 iconDiv text-center">
    								<i class="wi wi-medium piktogrammWUserDetail" id="wIconD2"></i>
    								<ul class ="ul-user" id="d2Temp"></ul>
    							</div>
    							<div class="col-6 col-sm-12">
    									<ul class="ul-user-info-detail" id="d2Info"></ul>
    						</div>
    				</div>
    			</div>
    			<div class="col-sm panel text-center">
    				<h2 id="day_name3"></h2>
    						<div class= "row justify-content-center">
    							<div class="col-6 col-sm-12 iconDiv text-center">
    								<i class="wi wi-medium piktogrammWUserDetail" id="wIconD3"></i>
    								<ul class ="ul-user" id="d3Temp"></ul>
    							</div>
    							<div class="col-6 col-sm-12">
    									<ul class="ul-user-info-detail" id="d3Info"></ul>
    						</div>
    				</div>
    			</div>
    			<div class="col-sm panel text-center">
    				<h2 id="day_name4"></h2>
    						<div class= "row justify-content-center">
    							<div class="col-6 col-sm-12 iconDiv text-center">
    								<i class="wi wi-medium piktogrammWUserDetail" id="wIconD4"></i>
    								<ul class ="ul-user" id="d4Temp"></ul>
    							</div>
    							<div class="col-6 col-sm-12">
    									<ul class="ul-user-info-detail" id="d4Info"></ul>
    						</div>
    				</div>
    			</div>
    			<div class="col-sm panel text-center">
    				<h2 id="day_name5"></h2>
    						<div class= "row justify-content-center">
    							<div class="col-6 col-sm-12 iconDiv text-center">
    								<i class="wi wi-medium piktogrammWUserDetail" id="wIconD5"></i>
    								<ul class ="ul-user" id="d5Temp"></ul>
    							</div>
    							<div class="col-6 col-sm-12">
    									<ul class="ul-user-info-detail" id="d5Info"></ul>
    						</div>
    				</div>
    			</div>
    		</div>
    		<div class="row justify-content-center">
    			<div class="panel tempChart-container">
    					<canvas id="tempChart">
    					</canvas>
    				</div>
    	</div>
			</div>
		</div>
	</div>
</div>
<?php else : ?>
            <p>
            <h1 id = errorNotLoggedIn>
                <p>Sie sind nicht eingeloggt. </p> Bitte <a href="index.php">einloggen</a>.
            </h1>
            <p>
<?php endif; ?>
</html>
