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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/eva-icons"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/2.0.0/trianglify.min.js"></script>
	<script src="js/crypt.js"></script>
	<script src="js/form.js"></script>
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
				<input class="form-control-lg formNavSearch" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
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
                 if (isset($_GET['error'])) {
                     echo '<p class="error">Error Logging In!</p>';
                 }
                 ?>
							<button class="btn btn-primary btn-modal1" onclick="formhash(this.form, this.loginForm.form)">Login</button>
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
							<button class="btn btn-primary btn-modal1"
															onclick="return regformhash(this.form,
                                   this.form.name,
																	 this.form.vorname,
                                   this.form.email,
																	 this.form.homebase,
                                   this.form.password,
                                   this.form.confirmpwd);">Registrieren</button>
						</form>
					</div>
				</div>
				<button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Abbrechen</button>
			</div>
		</div>
	</div>
</div>

<script>
	// Script starter
	$(document).ready(function() {
		console.log("ready!");
		var latitude = 0;
		var longitude = 0;
		getLocation();
	});

	function getLocation() {
		console.log("get location ready");
		if (navigator.geolocation) {
			console.log("navigator ready");
			navigator.geolocation.getCurrentPosition(showPosition, showError);
		} else {
			x.innerHTML = "Geolocation is not supported by this browser.";
		}
	}

	function showError(error) {
		console.log(error);
	}

	function showPosition(position) {
		console.log("get postition ready");
		latitude = position.coords.latitude;
		longitude = position.coords.longitude;
		console.log(latitude);
		console.log(longitude);

		$.ajax({
			url: "https://api.openweathermap.org/data/2.5/weather?lat=" + latitude + "&lon=" + longitude +
				"&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
			context: document.body,
			dataType: 'json'
		}).done(function(data) {

			// shows days
			ShowDay();
			setItems(data, weatherIcons);

			console.log(data);
			console.log("max:  " + data["main"]["temp_max"] + " min: " + data["main"]["temp_min"]);
			console.log(data["name"]);

			tRise = data["sys"]["sunrise"];
			tSet = data["sys"]["sunset"];

			$("#actualPlace").html(data["name"] + " / " + data["sys"]["country"]);
			$("#heuteTemp").html("<h3><li> " + Math.round(data["main"]["temp"]) + "°C</h3></li><li><h5>" + data["weather"]["0"]["description"] + "</h5></li>");
			$("#heuteInfo").html("<li><h5><i class='wi wi-thermometer tempMin'></i> " + data["main"]["temp_min"] + " °C</h5></li><li><h5><i class='wi wi-thermometer tempMax'></i> " + data["main"]["temp_max"] + " °C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " +
				data["wind"]["speed"] + " m/s</li><li><h5><i class='wi wi-sunrise'></i> " + Unix_timestamp(tRise) + "</h5></li><li><h5><i class='wi wi-sunset'></i> " + Unix_timestamp(tSet) + "</h5></li>");
		});
		$.ajax({
			url: "https://api.openweathermap.org/data/2.5/forecast?lat=" + latitude + "&lon=" + longitude +
				"&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
			context: document.body,
			dataType: 'json'
		}).done(function(data) {
			console.log(data);
			console.log("max:  " + data["list"]["0"]["main"]["temp_max"] + " min: " + data["list"]["0"]["main"]["temp_min"]);
			console.log(data["city"]["name"]);

			//Icons setzen für 5-Tages-Vorhersage evtl als Array mit Loop zum setzen der Icons
			var prefix = 'wi wi-';
			var weatheridD1 = data.list[0]["weather"]["0"].id;
			var weatheridD2 = data.list[8]["weather"]["0"].id;
			var weatheridD3 = data.list[16]["weather"]["0"].id;
			var weatheridD4 = data.list[24]["weather"]["0"].id;
			var weatheridD5 = data.list[32]["weather"]["0"].id;

			var wIconD1 = weatherIcons[weatheridD1].icon;
			var wIconD2 = weatherIcons[weatheridD2].icon;
			var wIconD3 = weatherIcons[weatheridD3].icon;
			var wIconD4 = weatherIcons[weatheridD4].icon;
			var wIconD5 = weatherIcons[weatheridD5].icon;

			if (!(weatheridD1 > 699 && weatheridD1 < 800) && !(weatheridD1 > 899 && weatheridD1 < 1000)) {
				wIconD1 = 'day-' + wIconD1;
			}
			if (!(weatheridD2 > 699 && weatheridD2 < 800) && !(weatheridD2 > 899 && weatheridD2 < 1000)) {
				wIconD2 = 'day-' + wIconD2;
			}
			if (!(weatheridD3 > 699 && weatheridD3 < 800) && !(weatheridD3 > 899 && weatheridD3 < 1000)) {
				wIconD3 = 'day-' + wIconD3;
			}
			if (!(weatheridD4 > 699 && weatheridD4 < 800) && !(weatheridD4 > 899 && weatheridD4 < 1000)) {
				wIconD4 = 'day-' + wIconD4;
			}
			if (!(weatheridD5 > 699 && weatheridD5 < 800) && !(weatheridD5 > 899 && weatheridD5 < 1000)) {
				wIconD5 = 'day-' + wIconD5;
			}
			wIconD1 = prefix + wIconD1;
			wIconD2 = prefix + wIconD2;
			wIconD3 = prefix + wIconD3;
			wIconD4 = prefix + wIconD4;
			wIconD5 = prefix + wIconD5;

			$("#wIconD1").addClass(wIconD1)
			$("#d1Temp").html("<h4><li>" + Math.round(data["list"]["0"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["0"]["weather"]["0"]["description"] +"</h6></li>");
			$("#d1Info").html("<li><h5><i class='wi wi-thermometer tempMin'></i> " +	Math.round(data["list"]["0"]["main"]["temp_min"]) + "°C</h5></li><li><h5><i class='wi wi-thermometer tempMax'></i> " +
			Math.round(data["list"]["0"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["0"]["wind"]["speed"] + "m/s</li>");

			$("#wIconD2").addClass(wIconD2)
			$("#d2Temp").html("<h4><li> " + Math.round(data["list"]["8"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["8"]["weather"]["0"]["description"] + "</h6></li>");
			$("#d2Info").html("<li><h5><i class='wi wi-thermometer tempMin'></i> " +	Math.round(data["list"]["8"]["main"]["temp_min"]) + "°C</h5></li><li><h5><i class='wi wi-thermometer tempMax'></i> " +
			Math.round(data["list"]["8"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["8"]["wind"]["speed"] + "m/s</li>");

			$("#wIconD3").addClass(wIconD3)
			$("#d3Temp").html("<li><h4>" + Math.round(data["list"]["16"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["16"]["weather"]["0"]["description"] + "</h6></li>");
			$("#d3Info").html("<li><h5><i class='wi wi-thermometer tempMin'></i> " +	Math.round(data["list"]["16"]["main"]["temp_min"]) + "°C</h5></li><li><h5><i class='wi wi-thermometer tempMax'></i> " +
			Math.round(data["list"]["16"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["16"]["wind"]["speed"] + "m/s</li>");

			$("#wIconD4").addClass(wIconD4)
			$("#d4Temp").html("<li><li><h4>" + Math.round(data["list"]["24"]["main"]["temp"]) + "°C</h4></li><h6>" + data["list"]["24"]["weather"]["0"]["description"] + "</h6></li>");
			$("#d4Info").html("<li><h5><i class='wi wi-thermometer tempMin'></i> " +	Math.round(data["list"]["24"]["main"]["temp_min"]) + "°C</h5></li><li><h5><i class='wi wi-thermometer tempMax'></i> " +
			Math.round(data["list"]["24"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["24"]["wind"]["speed"] + "m/s</li>");

			$("#wIconD5").addClass(wIconD5)
			$("#d5Temp").html("<li><h4>" + Math.round(data["list"]["32"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["32"]["weather"]["0"]["description"] + "</h6></li>");
			$("#d5Info").html("<li><h5><i class='wi wi-thermometer tempMin'></i> " +	Math.round(data["list"]["32"]["main"]["temp_min"]) + "°C</h5></li><li><h5><i class='wi wi-thermometer tempMax'></i> " +
			Math.round(data["list"]["32"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["32"]["wind"]["speed"] + "m/s</li>");

			drawChartDetail(data);
		});
	}


	//Icon abfragen und setzen (Heute)
	function setItems(data,weatherIcons) {
			var prefix = 'wi wi-';
			var weatherid = data.weather[0].id;
			var wIcon = weatherIcons[weatherid].icon;
			console.log(weatherid);
			console.log(wIcon)

			if (!(weatherid > 699 && weatherid < 800) && !(weatherid > 899 && weatherid < 1000)) {
				wIcon = 'day-' + wIcon;
				console.log(weatherid)
			}
			wIcon = prefix + wIcon;
			$("#heuteIcon").addClass(wIcon);
		}

	function Unix_timestamp(t) {
			var dt = new Date(t * 1000);
			var hr = dt.getHours();
			var m = "0" + dt.getMinutes();
			return hr + ':' + m.substr(-2);
		}

	// Funktion von Marek Datum
	function ShowDay() {
		var dt_today = new Date;
		var day_ShowDay = dt_today.getDay();
		var name_day0 = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][day_ShowDay];
		var name_day1 = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][(day_ShowDay + 1) % 7];
		var name_day2 = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][(day_ShowDay + 2) % 7];
		var name_day3 = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][(day_ShowDay + 3) % 7];
		var name_day4 = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][(day_ShowDay + 4) % 7];
		var name_day5 = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"][(day_ShowDay + 5) % 7];

		$("#day_name1").html(name_day1);
		$("#day_name2").html(name_day2);
		$("#day_name3").html(name_day3);
		$("#day_name4").html(name_day4);
		$("#day_name5").html(name_day5);
		console.log("get name day ready");

	}

	function drawChartDetail(data) {
		console.log("Starte drawChart")
			var ctx = document.getElementById('tempChart').getContext('2d');
			Chart.defaults.global.defaultFontColor = 'white';
			Chart.defaults.global.defaultFontSize = '12';

			//Wetterdaten richtig formatieren für Chart - Push in 2 neue Arrays
			var timestamp = [];
			var wetterDaten = [];
			for (var i = 0; i < data["list"].length; i = (i+2)) {
					timestamp.push(data.list[i].dt_txt);
					wetterDaten.push(Math.round(data.list[i].main.temp * 10) / 10);
			}
			var chart1 = new Chart(ctx, {
				  type: 'line',
			    data: {
			        labels: timestamp,
			        datasets: [{
			            label: "Temperatur",
									yAxisID: 'TemperaturY',
									backgroundColor: '#f44256',
			            borderColor: '#f44256',
									fill: false,
			            data: wetterDaten,
									datalabels: {
										align: 'center',
										anchor: 'center',
										offset: 5,
										borderRadius: 1,
										backgroundColor:'#f44256',
										color: 'white',
										font: {
											weight: 'bold'
										},
									}
			        }]
			    },
			    // Configuration options go here
			    options: {
						maintainAspectRatio: false,
						responsive: true,
						legend: {
							position: 'top',
							labels: {
								fontColor: '#d8eaf1',
								fontSize: 16,
							}
					  }, scales: {
								yAxes: [{
									type: 'linear',
									display: true,
									position: 'left',
									id: 'TemperaturY',
									gridLines: {
											display: true,
									}, ticks: {
										display: false,
											fontColor: "white",
											min: Math.round(Math.min.apply(this, wetterDaten)) - 5,
	         						max: Math.round(Math.max.apply(this, wetterDaten)) + 5,
											stepSize: 2,
						        }, scaleLabel: {
											fontColor: 'white',
											fontSize: 14,
											display: false,
											labelString: 'Temperatur °',
										},
								}],
					    xAxes: [{
								id: 'xAxis-Zeit',
									ticks:{
	            			callback:function(label){
	              		var datum = label.split(" ")[0];
			              var zeit = (label.split(" ")[1]).substring(0,5);
			              return zeit;
										}
									},
								gridLines: {
									display: false,
								}
							}, {
								id: 'xAxis-Datum',
									drawOnChartArea: true,
									ticks:{
	            			callback:function(label){
	              		var datum = label.split(" ")[0];
			              var zeit = label.split(" ")[1];
			              return datum;
										}
									},
								gridLines: {
									display: true,
								}
							}]
					  }
					}
			});
			setBackground();
		}

		//Verknüpfen der Registration/LoginButtons mit den entsprechenden Tabs im Login-Modal
		$('.btn-Navbar').on('click', function setModalTab() {
			console.log("Navbar-Buttons ok");
			var tabTarget = $(this).data('tab');
			$('.modalRegLog').modal('show');
			$('.modalRegTabBar a[href="#' + tabTarget + '"]').tab('show');
		});

		function setBackground() {var pattern = Trianglify({
				cell_size: 500,
				variance: 1,
				x_colors: ['#526b7b', '#6691ab', '#375b5f'],
				width: window.innerWidth,
				height: window.innerHeight
				});
			document.body.style.backgroundImage = "url(" + pattern.png() + ")"
		}

		var weatherIcons = {
		"200": {
		  "label": "thunderstorm with light rain",
		  "icon": "storm-showers"
		},

		"201": {
		  "label": "thunderstorm with rain",
		  "icon": "storm-showers"
		},

		"202": {
		  "label": "thunderstorm with heavy rain",
		  "icon": "storm-showers"
		},

		"210": {
		  "label": "light thunderstorm",
		  "icon": "storm-showers"
		},

		"211": {
		  "label": "thunderstorm",
		  "icon": "thunderstorm"
		},

		"212": {
		  "label": "heavy thunderstorm",
		  "icon": "thunderstorm"
		},

		"221": {
		  "label": "ragged thunderstorm",
		  "icon": "thunderstorm"
		},

		"230": {
		  "label": "thunderstorm with light drizzle",
		  "icon": "storm-showers"
		},

		"231": {
		  "label": "thunderstorm with drizzle",
		  "icon": "storm-showers"
		},

		"232": {
		  "label": "thunderstorm with heavy drizzle",
		  "icon": "storm-showers"
		},

		"300": {
		  "label": "light intensity drizzle",
		  "icon": "sprinkle"
		},

		"301": {
		  "label": "drizzle",
		  "icon": "sprinkle"
		},

		"302": {
		  "label": "heavy intensity drizzle",
		  "icon": "sprinkle"
		},

		"310": {
		  "label": "light intensity drizzle rain",
		  "icon": "sprinkle"
		},

		"311": {
		  "label": "drizzle rain",
		  "icon": "sprinkle"
		},

		"312": {
		  "label": "heavy intensity drizzle rain",
		  "icon": "sprinkle"
		},

		"313": {
		  "label": "shower rain and drizzle",
		  "icon": "sprinkle"
		},

		"314": {
		  "label": "heavy shower rain and drizzle",
		  "icon": "sprinkle"
		},

		"321": {
		  "label": "shower drizzle",
		  "icon": "sprinkle"
		},

		"500": {
		  "label": "light rain",
		  "icon": "rain"
		},

		"501": {
		  "label": "moderate rain",
		  "icon": "rain"
		},

		"502": {
		  "label": "heavy intensity rain",
		  "icon": "rain"
		},

		"503": {
		  "label": "very heavy rain",
		  "icon": "rain"
		},

		"504": {
		  "label": "extreme rain",
		  "icon": "rain"
		},

		"511": {
		  "label": "freezing rain",
		  "icon": "rain-mix"
		},

		"520": {
		  "label": "light intensity shower rain",
		  "icon": "showers"
		},

		"521": {
		  "label": "shower rain",
		  "icon": "showers"
		},

		"522": {
		  "label": "heavy intensity shower rain",
		  "icon": "showers"
		},

		"531": {
		  "label": "ragged shower rain",
		  "icon": "showers"
		},

		"600": {
		  "label": "light snow",
		  "icon": "snow"
		},

		"601": {
		  "label": "snow",
		  "icon": "snow"
		},

		"602": {
		  "label": "heavy snow",
		  "icon": "snow"
		},

		"611": {
		  "label": "sleet",
		  "icon": "sleet"
		},

		"612": {
		  "label": "shower sleet",
		  "icon": "sleet"
		},

		"615": {
		  "label": "light rain and snow",
		  "icon": "rain-mix"
		},

		"616": {
		  "label": "rain and snow",
		  "icon": "rain-mix"
		},

		"620": {
		  "label": "light shower snow",
		  "icon": "rain-mix"
		},

		"621": {
		  "label": "shower snow",
		  "icon": "rain-mix"
		},

		"622": {
		  "label": "heavy shower snow",
		  "icon": "rain-mix"
		},

		"701": {
		  "label": "mist",
		  "icon": "sprinkle"
		},

		"711": {
		  "label": "smoke",
		  "icon": "smoke"
		},

		"721": {
		  "label": "haze",
		  "icon": "day-haze"
		},

		"731": {
		  "label": "sand, dust whirls",
		  "icon": "cloudy-gusts"
		},

		"741": {
		  "label": "fog",
		  "icon": "fog"
		},

		"751": {
		  "label": "sand",
		  "icon": "cloudy-gusts"
		},

		"761": {
		  "label": "dust",
		  "icon": "dust"
		},

		"762": {
		  "label": "volcanic ash",
		  "icon": "smog"
		},

		"771": {
		  "label": "squalls",
		  "icon": "day-windy"
		},

		"781": {
		  "label": "tornado",
		  "icon": "tornado"
		},

		"800": {
		  "label": "clear sky",
		  "icon": "sunny"
		},

		"801": {
		  "label": "few clouds",
		  "icon": "cloudy"
		},

		"802": {
		  "label": "scattered clouds",
		  "icon": "cloudy"
		},

		"803": {
		  "label": "broken clouds",
		  "icon": "cloudy"
		},

		"804": {
		  "label": "overcast clouds",
		  "icon": "cloudy"
		},


		"900": {
		  "label": "tornado",
		  "icon": "tornado"
		},

		"901": {
		  "label": "tropical storm",
		  "icon": "hurricane"
		},

		"902": {
		  "label": "hurricane",
		  "icon": "hurricane"
		},

		"903": {
		  "label": "cold",
		  "icon": "snowflake-cold"
		},

		"904": {
		  "label": "hot",
		  "icon": "hot"
		},

		"905": {
		  "label": "windy",
		  "icon": "windy"
		},

		"906": {
		  "label": "hail",
		  "icon": "hail"
		},

		"951": {
		  "label": "calm",
		  "icon": "sunny"
		},

		"952": {
		  "label": "light breeze",
		  "icon": "cloudy-gusts"
		},

		"953": {
		  "label": "gentle breeze",
		  "icon": "cloudy-gusts"
		},

		"954": {
		  "label": "moderate breeze",
		  "icon": "cloudy-gusts"
		},

		"955": {
		  "label": "fresh breeze",
		  "icon": "cloudy-gusts"
		},

		"956": {
		  "label": "strong breeze",
		  "icon": "cloudy-gusts"
		},

		"957": {
		  "label": "high wind, near gale",
		  "icon": "cloudy-gusts"
		},

		"958": {
		  "label": "gale",
		  "icon": "cloudy-gusts"
		},

		"959": {
		  "label": "severe gale",
		  "icon": "cloudy-gusts"
		},

		"960": {
		  "label": "storm",
		  "icon": "thunderstorm"
		},

		"961": {
		  "label": "violent storm",
		  "icon": "thunderstorm"
		},

		"962": {
		  "label": "hurricane",
		  "icon": "cloudy-gusts"
		}
	}
</script>

</html>
