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
	<nav class="navbar navbar-expand-md navbar-dark bg-dark justify-content-center">
				<a href="#" class="btn btn-secondary btn-lg btn-NavbarSearch" role="button" aria-pressed="true">S</a>
				<form class="form-inline searchTop justify-content-center">
					<input class="form-control formNavSearch" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
				</form>
		</div>
	</nav>
	<div class="container-fluid">
        <div class="row">
          <div class="col-sm-2 sidebar h-100">
              <ul class="nav flex-sm-column sideNav justify-content-center">
                <a href="#" class="sideNavItem"><span class="d-none d-lg-block"><h3>Profil  <img src="img/person-outline.png" alt=""></h3></span><span class="d-md-none"><img src="img/person-outline.png" alt=""></span></a>
                <a href="#" class="sideNavItem"><span class="d-none d-lg-block"><h3>Einstellungen<img src="img/settings-2-outline.png" alt=""></h3></span><span class="d-md-none"><img src="img/settings-2-outline.png" alt=""></span></a>
                <a href="#" class="sideNavItem"><span class="d-none d-lg-block"><h3>Logout   <img src="img/power-outline.png" alt=""></h3></span><span class="d-md-none"><img src="img/power-outline.png" alt=""></span></a>
              </ul>
          </div>
            <div class="col-sm content">
              <div class=".container">
                	<div class="row">
                	 <div class="col-sm-4 standort">
                		<h1>Aktueller Standort</h1>
                		<div class=".container">
                				<div class= "row justify-content-center">
                            <div class="col-sm-4">
                          <a href="https://placeholder.com" id="piktogrammWMain"><img src="https://via.placeholder.com/100" id="piktogrammWMain"></a>
                            </div>
                            <div class="col-sm-4">
                          <ul>
                						<li><h3>Baden</h3></li>
                						<li><h3>7.2°C</h3></li>
                					</ul>
                          </div>
                				</div>
                			</div>
                	 </div>
                   <div class="col-sm-2">
                   </div>
                   <div class="col-sm-4 homebase">
                    <h1>Homebase</h1>
                		<div class=".container">
                				<div class= "row justify-content-center">
                						<div class="col-sm">
                					<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                						</div>
                						<div class="col-sm">
                					<ul>
                						<li><h3>Baden</h3></li>
                						<li><h3>7.2°C</h3></li>
                					</ul>
                					</div>
                				</div>
                			</div>
                   </div>
                	 </div>
                		<div class="row">
                			<div class="col-sm-10 favoriten">
                				<h1>Favoriten</h1>
                        <div class="d-flex flex-wrap align-items-start favoriten-container">
                				<div class="p-2 favorit">
                					<div class=".container">
                					<div class="row">
                					<div class="col-sm">
                				<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                					</div>
                					<div class="col-sm">
                				<ul>
                				<li><h3>Baden</h3></li>
                				<li><h3>7.2°C</h3></li>
                				</ul>
                				</div>
                			 </div>
                      </div>
                      </div>

                			<div class="p-2 favorit">
                				<div class=".container">
                				<div class="row">
                				<div class="col-sm">
                			<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                				</div>
                				<div class="col-sm">
                			<ul>
                			<li><h3>Baden</h3></li>
                			<li><h3>7.2°C</h3></li>
                			</ul>
                			</div>
                		 </div>
                		</div>
                		</div>

                		<div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>

                		<div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>

                		<div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>

                		<div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>

                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>
                    <div class="p-2 favorit">
                			<div class=".container">
                			<div class="row">
                			<div class="col-sm">
                		<a href="https://placeholder.com"><img src="https://via.placeholder.com/100"></a>
                			</div>
                			<div class="col-sm">
                		<ul>
                		<li><h3>Baden</h3></li>
                		<li><h3>7.2°C</h3></li>
                		</ul>
                		</div>
                		</div>
                		</div>
                		</div>

                			</div>
                	 </div>
                 </div>
                </div>
              </div>
          </div>
        </div>
  </body>
  <footer class="footer">
        <div class="container-footer">
          <span class="text-muted">Place sticky footer content here.</span>
        </div>
      </footer>
</html>
