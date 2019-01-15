<!DOCTYPE html>

<?php
//include_once 'config/config.php';
//require 'vendor/autoload.php';
//session_start();
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
	 crossorigin="anonymous"></script>
	<script src="https://unpkg.com/eva-icons"></script>
	<link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
	<link rel="stylesheet" type="text/css" href="css/weather-icons-wind.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>
	<nav class="navbar navbar-expand-sm navbar-dark">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent"
		 aria-expanded="false" aria-label="Toggle navigation">
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
		<div class="row">
			<div class="col-sm">
				<h1 id="actualPlace"></h1>
				<ul id="heute">
				</ul>

			</div>
		</div>
		<div class="row">
			<div class="col-sm">
				<h1 id="day_name1"></h1>
				<ul id="day1">
				</ul>
			</div>
			<div class="col-sm">
				<h1 id="day_name2"></h1>
				<ul id="day2">
				</ul>
			</div>
			<div class="col-sm">
				<h1 id="day_name3"></h1>
				<ul id="day3">
				</ul>
			</div>
			<div class="col-sm">
				<h1 id="day_name4"></h1>
				<ul id="day4">
				</ul>
			</div>
			<div class="col-sm">
				<h1 id="day_name5"></h1>
				<ul id="day5">
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="col-sm">
				<div id="curve_chart" style="width: 900px; height: 500px"></div>
			</div>
		</div>
	</div>
</body>

<div class="modal fade modalRegLog" id="modalRegistration" tabindex="-1" role="dialog" aria-labelledby="modalRegistration"
 aria-hidden="true">
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
						<form>
							<div class="form-row">
								<div class="form-group col-sm-8">
									<label for="emailInput" class="modalFormLabel">Email</label>
									<input type="email" class="form-control" id="emailInputLogin" placeholder="Email-Adresse">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-8">
									<label for="passwordInput" class="modalFormLabel">Passwort</label>
									<input type="password" class="form-control" id="passwordInputLogin" placeholder="Passwort">
								</div>
							</div>
						</form>
					</div>
					<div id="modalTabReg" class="container tab-pane fade"><br>
						<form>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="nameInput" class="modalFormLabel">Name</label>
									<input type="text" class="form-control" id="nameInput" placeholder="Name">
								</div>
								<div class="form-group col-sm-6">
									<label for="vornameInput" class="modalFormLabel">Vorname</label>
									<input type="text" class="form-control" id="nameInput" placeholder="Vorname">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="emailInput" class="modalFormLabel">Email</label>
									<input type="email" class="form-control" id="emailInput" placeholder="Email-Adresse">
								</div>
								<div class="form-group col-sm-6">
									<label for="homebaseInput" class="modalFormLabel">Homebase</label>
									<input type="text" class="form-control" id="homebaseInput" placeholder="Homebase">
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="passwordInput" class="modalFormLabel">Passwort</label>
									<input type="password" class="form-control" id="passwordInput" placeholder="Passwort">
								</div>
								<div class="form-group col-sm-6">
									<label for="passwordInput2" class="modalFormLabel">Passwort erneut eingeben</label>
									<input type="password" class="form-control" id="passwordInput2" placeholder="Passwort">
								</div>
							</div>
						</form>
					</div>
				</div>
				<a href="user.html" class="btn btn-primary btn-modal1">Login</a>
				<button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Abbrechen</button>
			</div>
		</div>
	</div>
</div>

<script>
	// Script starter
	$(document).ready(function () {
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
			url: "http://api.openweathermap.org/data/2.5/weather?lat=" + latitude + "&lon=" + longitude +
				"&units=metric&appid=6012cf5997f032d2c82563e60ef96a56",
			context: document.body,
			dataType: 'json'
		}).done(function (data) {

			// shows days
			ShowDay();

			console.log(data);
			console.log("max:  " + data["main"]["temp_max"] + " min: " + data["main"]["temp_min"]);
			console.log(data["name"]);

			tRise = data["sys"]["sunrise"];
			tSet = data["sys"]["sunset"];
			$("#actualPlace").html(data["name"]);
			$("#heute").html("<li> Temp: " + data["main"]["temp"] + " °C</li><li> Condition: " + data[
					"weather"]["0"]["main"] + "</li><li> Min: " + data["main"]["temp_min"] +" °C</li><li> Max: " + data["main"]["temp_max"] + " °C</li><li> Wind: " +
					data["wind"]["speed"] + " m/s</li><li> Sunrise: " + Unix_timestamp(tRise) + "  Uhr</li><li> Sunset: " + Unix_timestamp(tSet) + "  Uhr</li>");
		});
		$.ajax({
			url: "https://api.openweathermap.org/data/2.5/forecast?lat=" + latitude + "&lon=" + longitude +
				"&units=metric&appid=6012cf5997f032d2c82563e60ef96a56",
			context: document.body,
			dataType: 'json'
		}).done(function (data) {
			console.log(data);
			console.log("max:  " + data["list"]["0"]["main"]["temp_max"] + " min: " + data["list"]["0"]["main"]["temp_min"]);
			console.log(data["city"]["name"]);
			$("#day1").html("<li> Temp: " + data["list"]["0"]["main"]["temp"] + " °C</li><li> Condition: " + data["list"]["0"]["weather"]["0"]["main"] + "</li><li> Min: " +
				data["list"]["0"]["main"]["temp_min"] + " °C</li><li> Max: " + data["list"]["0"]["main"]["temp_max"] +
				" °C</li><li> Wind: " + data["list"]["0"]["wind"]["speed"] + " m/s</li>");
			$("#day2").html("<li> Temp: " + data["list"]["8"]["main"]["temp"] + " °C</li><li> Condition: " + data["list"]["8"]["weather"]["0"]["main"] + "</li><li> Min: " +
				data["list"]["8"]["main"]["temp_min"] + " °C</li><li> Max: " + data["list"]["8"]["main"]["temp_max"] +
				" °C</li><li> Wind: " + data["list"]["8"]["wind"]["speed"] + " m/s</li>");
			$("#day3").html("<li> Temp: " + data["list"]["16"]["main"]["temp"] + " °C</li><li> Condition: " + data["list"]["16"]["weather"]["0"]["main"] + "</li><li> Min: " +
				data["list"]["16"]["main"]["temp_min"] + " °C</li><li> Max: " + data["list"]["16"]["main"]["temp_max"] +
				" °C</li><li> Wind: " + data["list"]["16"]["wind"]["speed"] + " m/s</li>");
			$("#day4").html("<li> Temp: " + data["list"]["24"]["main"]["temp"] + " °C</li><li> Condition: " + data["list"]["24"]["weather"]["0"]["main"] + "</li><li> Min: " +
				data["list"]["24"]["main"]["temp_min"] + " °C</li><li> Max: " + data["list"]["24"]["main"]["temp_max"] +
				" °C</li><li> Wind: " + data["list"]["24"]["wind"]["speed"] + " m/s</li>");
			$("#day5").html("<li> Temp: " + data["list"]["32"]["main"]["temp"] + " °C</li><li> Condition: " + data["list"]["32"]["weather"]["0"]["main"] + "</li><li> Min: " +
				data["list"]["32"]["main"]["temp_min"] + " °C</li><li> Max: " + data["list"]["32"]["main"]["temp_max"] +
				" °C</li><li> Wind: " + data["list"]["32"]["wind"]["speed"] + " m/s</li>");
		});

		function Unix_timestamp(t) {
			var dt = new Date(t * 1000);
			var hr = dt.getHours();
			var m = "0" + dt.getMinutes();
			var s = "0" + dt.getSeconds();
			return hr + ':' + m.substr(-2) + ':' + s.substr(-2);
		}

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

	google.charts.load('current', {
		'packages': ['corechart']
	});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {
		console.log("draw chart ready");
		var data = google.visualization.arrayToDataTable([
			["Tag", "Temparatur"],
			["Montag", 100],
			["Dienstag", 1170],
			["Mittwoch", 400],
			["Donnerstag", 600],
			["Freitag", 100],
		]);

		var options = {
			title: 'Temperatur Verlauf',
			curveType: 'function',
			legend: {
				position: 'bottom'
			}
		};

		var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
		chart.draw(data, options);
	}


	//Verknüpfen der Registration/LoginButtons mit den entsprechenden Tabs im Login-Modal
	$('.btn-Navbar1').on('click', function setModalTab() {
		var tabTarget = $(this).data('tab');
		$('.modalRegLog').modal('show');
		$('.modalRegTabBar a[href="#' + tabTarget + '"]').tab('show');
	}
);
</script>

</html>


</html>
