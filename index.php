<?php
include_once 'includes/inc_registration.php';
include_once 'includes/php_functions.php';
include_once 'includes/connect_db.php';


secure_session_start();

if (userlogin_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Deine Wetter-App</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi3xVRrXvACBVxLdqqjJL_NngeZ4-cVXs&libraries=places"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/eva-icons"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/2.0.0/trianglify.min.js"></script>
	<script src="js/sha512.js"></script>
	<script src="js/form.js"></script>
	<script src="js/index.js"></script>
	<link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
	<link rel="stylesheet" type="text/css" href="css/weather-icons-wind.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-dark topNav">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="nav abs-center-x">
			<form class="form-inline">
				<input class="form-control-lg formNavSearch text-center" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
			</form>
		</ul>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="nav justify-content-center">
				<li class="nav-item">
					<button type="button" class="btn btn-Navbar" data-tab="modalTabLogin">
						Login
					</button>
					<button type="button" class="btn btn-Navbar" data-tab="modalTabReg">
						Registrieren
					</button>
          <button type="button" class="btn btn-NavbarInfo" data-tab="modalInfo">
            Infos
          </button>
				</li>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">
		<div class="row justify-content-center">
			<div class="col-sm-4 col-xl-3 mx-auto panel">
					<h1 id="actualPlace" class="text-center"></h1>
							<div class= "row justify-content-center no-margin">
								<div class="col-xs iconDiv text-center">
									<i class="wi-big wi-fw piktogrammWIndex" id="heuteIcon"></i>
									<ul class ="ul-index" id="heuteTemp"></ul>
								</div>
								<div class="col-xs">
										<ul class="ul-index-info" id="heuteInfo"></ul>
								</div>
							</div>
			</div>
	</div>
		<div class="row">
			<div class="col-sm panel text-center">
				<h2 id="day_name1"></h2>
						<div class= "row justify-content-center">
							<div class="col-xs-6 iconDiv text-center" id="day1Container">
								<i class="wi wi-medium piktogrammWIndex" id="wIconD1"></i>
								<ul class ="ul-index" id="d1Temp"></ul>
							</div>
							<div class="col-xs-6">
									<ul class="ul-info" id="d1Info"></ul>
							</div>
				</div>
				</ul>
			</div>
			<div class="col-sm panel text-center">
				<h2 id="day_name2"></h2>
						<div class= "row justify-content-center">
							<div class="col-xs-6 iconDiv text-center">
								<i class="wi wi-medium piktogrammWIndex" id="wIconD2"></i>
								<ul class ="ul-index" id="d2Temp"></ul>
							</div>
							<div class="col-xs-6">
									<ul class="ul-info" id="d2Info"></ul>
						</div>
				</div>
			</div>
			<div class="col-sm panel text-center">
				<h2 id="day_name3"></h2>
						<div class= "row justify-content-center">
							<div class="col-xs-6 iconDiv text-center">
								<i class="wi wi-medium piktogrammWIndex" id="wIconD3"></i>
								<ul class ="ul-index" id="d3Temp"></ul>
							</div>
							<div class="col-xs-6">
									<ul class="ul-info" id="d3Info"></ul>
						</div>
				</div>
			</div>
			<div class="col-sm panel text-center">
				<h2 id="day_name4"></h2>
						<div class= "row justify-content-center">
							<div class="col-xs-6 iconDiv text-center">
								<i class="wi wi-medium piktogrammWIndex" id="wIconD4"></i>
								<ul class ="ul-index" id="d4Temp"></ul>
							</div>
							<div class="col-xs-6">
									<ul class="ul-info" id="d4Info"></ul>
						</div>
				</div>
			</div>
			<div class="col-sm panel text-center">
				<h2 id="day_name5"></h2>
						<div class= "row justify-content-center">
							<div class="col-xs-6 iconDiv text-center">
								<i class="wi wi-medium piktogrammWIndex" id="wIconD5"></i>
								<ul class ="ul-index" id="d5Temp"></ul>
							</div>
							<div class="col-xs-6">
									<ul class="ul-info" id="d5Info"></ul>
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
</body>

<div class="modal fade modalRegLog" id="modalRegistration" tabindex="-1" role="dialog" aria-labelledby="modalRegistration" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div role="tabpanel">
					<ul class="nav nav-tabs nav-justified modalRegTabBar">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#modalTabLogin">Login</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#modalTabReg">Registrieren</a>
						</li>
				</div>
				<div class="tab-content">
					<div id="modalTabLogin" class="container tab-pane active"><br>
						<form action="includes/login.php" method="post" name="login_form" id="loginForm">
							<div class="form-row">
								<div class="form-group col-sm-8">
									<label for="emailInput" class="modalFormLabel">Email</label>
									<input type="email" name='email' class="form-control" id="emailInputLogin" placeholder="Email-Adresse" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-8">
									<label for="passwordInput" class="modalFormLabel">Passwort</label>
									<input type="password" name='password' class="form-control" id="passwordInputLogin" placeholder="Passwort" required>
								</div>
							</div>
                    <?php
										 if (isset($_GET['error-login'])) {echo '<p class="error">Benutzername / Passwort falsch</p>';}
                 ?>
							<button type="button" class="btn btn-primary btn-modal1" onclick="formhash(this.form, this.form.password)">Login</button>
						</form>
					</div>
					<div id="modalTabReg" class="container tab-pane fade"><br>
						<form action="<?php echo clean_php_url($_SERVER['PHP_SELF']); ?>"
							method="post"
							name="registration_form"
              id="regForm">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="emailInput" class="modalFormLabel">Email</label>
									<input type="email" name='email' class="form-control" id="emailInput" placeholder="Email-Adresse">
                  <?php
                   if (isset($_GET['error-reg'])) {echo '<p class="error">Keine gültige Emailadresse</p>';}
                   else if (isset($_GET['error-reg4'])) {echo '<p class="error">Emailadresse bereits verwendet</p>';}
                   ?>
								</div>
								<div class="form-group col-sm-6">
									<label for="homebaseInput" class="modalFormLabel">PLZ Homebase</label>
									<input type="text" name='homebasePlz' class="form-control" id="homebaseInput" placeholder="Homebase">
                  <?php
                   if (isset($_GET['error-reg3'])) {echo '<p class="error">Keine gültige Postleitzahl</p>';}
                   ?>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="passwordInput" class="modalFormLabel">Passwort</label>
									<input type="password" name='password' class="form-control" id="passwordInput" placeholder="Passwort">
								</div>
								<div class="form-group col-sm-6">
									<label for="passwordInput2" class="modalFormLabel">Passwort erneut eingeben</label>
									<input type="password" name='password2' class="form-control" id="passwordInput2" placeholder="Passwort">
								</div>
                <?php
                 if (isset($_GET['error-reg2'])) {echo '<p class="error">Fehler bei Passwortkonfiguration</p>';}
                 ?>
							</div>
              <?php
              if (isset($_GET['error-reg5'])) {echo '<p class="error">Datenbankfehler</p>';}
              ?>
							<button type="button" class="btn btn-primary btn-modal1"
															onclick="return regformhash(this.form,
                                   this.form.email,
																	 this.form.homebasePlz,
                                   this.form.password,
																	 this.form.password2);"
              >Registrieren</button>
							</form>
					</div>
				</div>
			</div>
      <button type="button" class="btn btn-modal2" data-dismiss="modal" aria-label="Close">Schliessen</button>
		</div>
	</div>
</div>
<div class="modal fade" id="modalInfo" role="dialog" aria-labelledby="modalInfo" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
        <h1>Über diese Website</h1>
        <p>Diese Website ist im Rahmen einer Semesterarbeit an der ABB Technikerschule in Baden entstanden.</p>
        <h2>Das Projektteam</h2>
          <p>
          <ul>
            <li> •	Marek Giesen, Projektleiter </li>
            <li> •	Andri Binda, Verantwortlicher Web-Entwicklung </li>
            <li> •	Dominik Wüst, Verantwortlicher Datenbank-Entwicklung </li>
            <li> •	Pascal Bosisio, Projektmitarbeiter </li>
          </ul>
          </p>
          <h2>Verwendete Techniken</h2>
          <p>
          <ul>
            <li> •	PHP </li>
            <li> •	HTML </li>
            <li> •	Javascript </li>
            <li> •	JQuery </li>
            <li> •	AJAX </li>
            <li> •	SQL </li>
            <li> •	CSS</li>
          </ul>
          </p>

          <h2>APIs</h2>
          <p>
          <ul>
            <li> •	OpenWeatherMap </li>
            <li> •	Google API Places </li>
          </ul>
          </p>

          <h2>Verwendete Produkte</h2>
          <p>
          <ul>
            <li> •	Frontend Framework:	Bootstrap </li>
            <li> •	Datenbank:		MySQL </li>
            <li> •	Entwicklungstools:	Atom, MySQL Workbench, GitHub</li>
            <li> •	Hintergrundbild:	Trianglify.io </li>
            <li> •	Icons:			erikflowers Weather Icons, EVA Icons </li>
            <li> •	Graphs:			chart.js </li>

          </ul>
          </p>

          <h2>Haftungsauschluss</h2>
          <p>Die Autoren übernehmen keinerlei Gewähr hinsichtlich der inhaltlichen Richtigkeit, Genauigkeit,
             Aktualität, Zuverlässigkeit und Vollständigkeit der Informationen. Haftungsansprüche gegen den
             Autor wegen Schäden materieller oder immaterieller Art, welche aus dem Zugriff oder der Nutzung
             bzw. Nichtnutzung der veröffentlichten Informationen, durch Missbrauch der Verbindung oder durch
             technische Störungen entstanden sind, werden ausgeschlossen. Alle Angebote sind unverbindlich.
             Der Autor behält es sich ausdrücklich vor, Teile der Seiten oder das gesamte Angebot ohne
             gesonderte Ankündigung zu verändern, zu ergänzen, zu löschen oder die Veröffentlichung zeitweise
             oder endgültig einzustellen.
          </p>

          <h2>Haftung für Links</h2>
          <p>Verweise und Links auf Webseiten Dritter liegen ausserhalb unseres Verantwortungsbereichs.
             Es wird jegliche Verantwortung für solche Webseiten abgelehnt. Der Zugriff und die Nutzung
             solcher Webseiten erfolgen auf eigene Gefahr des Nutzers oder der Nutzerin.
          </p>

          <h2>Datenschutz</h2>
          <p>Gestützt auf Artikel 13 der schweizerischen Bundesverfassung und die datenschutzrechtlichen
             Bestimmungen des Bundes (Datenschutzgesetz, DSG) hat jede Person Anspruch auf Schutz ihrer
             Privatsphäre sowie auf Schutz vor Missbrauch ihrer persönlichen Daten. Wir halten diese
             Bestimmungen ein. Persönliche Daten werden streng vertraulich behandelt und weder an Dritte
             verkauft noch weitergegeben. In enger Zusammenarbeit mit unseren Hosting-Providern bemühen
             wir uns, die Datenbanken so gut wie möglich vor fremden Zugriffen, Verlusten, Missbrauch oder
             vor Fälschung zu schützen. Beim Zugriff auf unsere Webseiten werden folgende Daten in
             Logfiles gespeichert: IP-Adresse, Datum, Uhrzeit, Browser-Anfrage und allg. übertragene
             Informationen zum Betriebssystem resp. Browser. Diese Nutzungsdaten bilden die Basis für
             statistische, anonyme Auswertungen, so dass Trends erkennbar sind, anhand derer wir unsere
             Angebote entsprechend verbessern können.

          </p>











			</div>
      <button type="button" class="btn btn-modal2" data-dismiss="modal" aria-label="Close">Schliessen</button>
		</div>
	</div>
</div>
</html>
