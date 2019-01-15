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
	<nav class="navbar navbar-expand-md navbar-dark bg-dark justify-content-center">
				<form class="form-inline searchTop">
					<input class="form-control formNavSearch" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
				</form>
		</div>
	</nav>
	<div class="container-fluid">
        <div class="row">
          <div class="col-sm-2 sidebar h-100">
              <ul class="nav flex-sm-column sideNav justify-content-center">
                <a href="#" class="sideNavItem"><i data-eva="person-outline" data-eva-height="48" data-eva-width="48"></i></a>
                <a href="#" class="sideNavItem"<span class="d-none d-lg-block"><i data-eva="settings-2" data-eva-height="48" data-eva-width="48"></i></a>
                <a href="#" class="sideNavItem"><i data-eva="power" data-eva-height="48" data-eva-width="48"></i></a>

              </ul>
          </div>
            <div class="col-sm content">
              <div class=".container">
                	<div class="row">
                	 <div class="col-sm-4 standort">
						<a href="https://ch.wetter.com/" class="emptyLink"></a>
                		<h1>Aktueller Standort</h1>
                		<div class=".container">
                				<div class= "row justify-content-center">
                            <div class="col-xs-4">
                          <i class="wi wi-night-sleet" id="piktogrammWMain"></i>
                            </div>
                            <div class="col-xs-4">
                          <ul>
                						<li><h3>Baden</h3></li>
                						<li><h3>7.2°C</h3></li>
                            <li><h3>12:16</h3></li>
                					</ul>
                          </div>
                				</div>
                			</div>
                	 </div>
                   <div class="col-sm-2">
                   </div>
                   <div class="col-sm-4 homebase">
					<a href="https://ch.wetter.com/" class="emptyLink"></a>
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
                				<i class="wi wi-night-sleet"></i>
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
							<a href="https://ch.wetter.com/" class="emptyLink"></a>
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
						<a href="https://ch.wetter.com/" class="emptyLink"></a>
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
          <span class="text-muted">weather.zubler.ch - Wetterapp für Semesterarbeit ABB TS 2018 - AB. DW. MG. PB.</span>
        </div>
      </footer>

      <script>
            eva.replace()
            console.log("script start")
      </script>
</html>
