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
		<button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<ul class="nav abs-center-x">
				<a href="#" class="btn btn-secondary btn-lg btn-NavbarSearch" role="button" aria-pressed="true">S</a>
				<form class="form-inline">
					<input class="form-control mr-sm-2 formNavSearch" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
				</form>
		</ul>
	<div class="collapse navbar-collapse" id="navbarCollapse">
		<ul class="nav justify-content-center">
			 <li class="nav-item">
                <button type="button" class="btn btn-primary btn-Navbar1" data-toggle="modal" data-target="#modalRegistration">
					Registrieren
				</button>
				<button type="button" class="btn btn-primary btn-Navbar1" data-toggle="modal" data-target="#modalRegistration">
					Login
				</button>
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

  <div class="modal fade" id="modalRegistration" tabindex="-1" role="dialog" aria-labelledby="modalRegistration" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalRegistrationTitle">Boah modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


					<form>
			  <div class="form-group">
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" autofocus>
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
			  </div>
			  <button type="submit" class="btn btn-primary btn-modal1">Login</button>
        <button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Abbrechen</button>
			</form>
      </div>
    </div>
  </div>
</div>
</html>