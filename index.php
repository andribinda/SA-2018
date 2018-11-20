<!DOCTYPE html>

<?php
//include_once 'config/config.php';
//require 'vendor/autoload.php';
//session_start();
?>

<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Deine Wetter-App</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
			<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
			<link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
			<link rel="stylesheet" type="text/css" href="css/weather-icons-wind.min.css">
			<link rel="stylesheet" type="text/css" href="css/main.css">
			
  </head>
  <body>
	<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
		<ul class="nav justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="https://weather.zubler.ch"> <i class="wi wi-day-sunny" id="wi-day-sunny-NavBar"></i></a>
            </li>
		</ul>
		<ul class="nav abs-center-x">
				<a href="#" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true"><img style="width:200%;" src="img/Suche.png"></a>
				<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
				</form>
		</ul>
		<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="nav justify-content-center">
			 <li class="nav-item">
                <a class="nav-link" href="#">Registrieren</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>
			</ul>
		</div>
	</nav>
	<div class="container-fluid">
	<div class="row">
	 <div class="col-sm">
		<h1>Heute</h1>
				<ul>
					<li>7.2°C</li>
					<li>Regen</li>
					<li>min.</li>
					<li>max.</li>
					<li>SoAuf</li>
					<li>SoAb</li>
					<li>Wind</li>
				</ul>
	 </div>
	 </div>
		<div class="row">
			<div class="col-sm">
				<h1>Montag</h1>
				<ul>
					<li>7.2°C</li>
					<li>Regen</li>
					<li>min.</li>
					<li>max.</li>
					<li>SoAuf</li>
					<li>SoAb</li>
					<li>Wind</li>
				</ul>
			</div>
			<div class="col-sm">
				<h1>Dienstag</h1>
				<ul>
					<li>7.2°C</li>
					<li>Regen</li>
					<li>min.</li>
					<li>max.</li>
					<li>SoAuf</li>
					<li>SoAb</li>
					<li>Wind</li>
				</ul>
			</div>
			<div class="col-sm">
				<h1>Mittwoch</h1>
				<ul>
					<li>7.2°C</li>
					<li>Regen</li>
					<li>min.</li>
					<li>max.</li>
					<li>SoAuf</li>
					<li>SoAb</li>
					<li>Wind</li>
				</ul>
			</div>
			<div class="col-sm">
				<h1>Donnerstag</h1>
				<ul>
					<li>7.2°C</li>
					<li>Regen</li>
					<li>min.</li>
					<li>max.</li>
					<li>SoAuf</li>
					<li>SoAb</li>
					<li>Wind</li>
				</ul>
			</div>
			<div class="col-sm">
				<h1>Freitag</h1>
				<ul>
					<li>7.2°C</li>
					<li>Regen</li>
					<li>min.</li>
					<li>max.</li>
					<li>SoAuf</li>
					<li>SoAb</li>
					<li>Wind</li>
				</ul>
			</div>
	</div>
		<div class="row">
	 <div class="col-sm">
		<h2>
			GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH
			GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH
			GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH
			GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH GRAPH
		</h2>
	</div>
	 </div>
	 </div>
  </body>
</html>