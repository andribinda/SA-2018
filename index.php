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
	<?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
  ?>
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
									<input type="email" name='email' class="form-control" id="emailInputLogin" placeholder="Email-Adresse">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-8">
									<label for="passwordInput" class="modalFormLabel">Passwort</label>
									<input type="password" name='password' class="form-control" id="passwordInputLogin" placeholder="Passwort">
								</div>
							</div>
                    <?php
										 if (isset($_GET['error'])) {echo '<p class="error">Error Logging In!</p>';}
                 ?>
							<button type="button" class="btn btn-primary btn-modal1">Login</button>
              <!-- onclick="formhash(this.form, this.form.password)" -->
							<button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Schliessen</button>
						</form>
					</div>
					<div id="modalTabReg" class="container tab-pane fade"><br>
						<form action="<?php echo clean_php_url($_SERVER['PHP_SELF']); ?>"
							method="post"
							name="registration_form">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="nameInput" class="modalFormLabel">Name</label>
									<input type="text" name='name' class="form-control" id="nameInput" placeholder="Name">
								</div>
								<div class="form-group col-sm-6">
									<label for="vornameInput" class="modalFormLabel">Vorname</label>
									<input type="text" name='vorname'class="form-control" id="vornameInput" placeholder="Vorname">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="emailInput" class="modalFormLabel">Email</label>
									<input type="email" name='email' class="form-control" id="emailInput" placeholder="Email-Adresse">
								</div>
								<div class="form-group col-sm-6">
									<label for="homebaseInput" class="modalFormLabel">Homebase</label>
									<input type="text" name='homebase'class="form-control" id="homebaseInput" placeholder="Homebase">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="passwordInput" class="modalFormLabel">Passwort</label>
									<input type="password" name='password1' class="form-control" id="passwordInput" placeholder="Passwort">
								</div>
								<div class="form-group col-sm-6">
									<label for="passwordInput2" class="modalFormLabel">Passwort erneut eingeben</label>
									<input type="password" name='password1' class="form-control" id="passwordInput2" placeholder="Passwort">
								</div>
							</div>
							<button type="button" class="btn btn-primary btn-modal1"
															onclick="return regformhash(this.form,
                                   this.form.name,
																	 this.form.vorname,
                                   this.form.email,
																	 this.form.homebase,
                                   this.form.password,
                                   this.form.confirmpwd);">Registrieren</button>
							<button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Schliessen</button>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</html>
