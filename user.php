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
  <link rel="stylesheet" type="text/css" href="css/weather-icons.min.css">
  <link rel="stylesheet" type="text/css" href="css/weather-icons-wind.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <?php if (userlogin_check($mysqli) == true) : ?>
</head>
<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark justify-content-center topNav">
    <form class="form-inline searchTop justify-content-center">
      <input class="form-control-lg formNavSearch" id="inputTextNav" type="search" placeholder="PLZ / Ort eingeben" aria-label="Search">
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
				<a href="#" class="btn btn-primary btn-modal1">Speichern</a>
				<button type="button" class="btn btn-primary btn-modal1" data-dismiss="modal" aria-label="Close">Abbrechen</button>
			</div>
		</div>
	</div>
</div>
<?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
<?php endif; ?>

<script>
eva.replace()
console.log("script start")

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
    setItems(data, weatherIcons);
    $("#standortOrt").html(data["name"] + " / " + data["sys"]["country"]);
    $("#standortTemperatur").html("<h2>" + Math.round(data["main"]["temp"]) + "°C </h2>");
    $("#standortBeschreibung").html(data["weather"]["0"]["description"]);
  });
}

  function ortSuche() {
      var options = {
        types: ['(regions)'],
        componentRestrictions: {country: 'CH'}
      };

      var input = document.getElementById('inputTextNav');
      var autocomplete = new google.maps.places.Autocomplete(input, options);

      autocomplete.addListener('place_changed', getWeather);
    }
    google.maps.event.addDomListener(window, 'load', ortSuche);

  function getWeather() {
      // Get the place details from the autocomplete object.
      var place = this.getPlace();
      var long = place.geometry.location.lng();
      var lat = place.geometry.location.lat();
      console.log(lat, long);

      $.ajax({
        url: "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + long +
          "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
        context: document.body,
        dataType: 'json'
      }).done(function(data) {
        setItems(data, weatherIcons);
        $("#standortBeschreibung").html(data["weather"]["0"]["description"]);
        $("#standortTemperatur").html("<h2>" + Math.round(data["main"]["temp"]) + "°C </h2>");
        $("#standortOrt").html(data["name"] + " / " + data["sys"]["country"]);
      });
  }

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
$('#menuUser').on('click', function showModalUser() {
  $('#modalUser').modal('show');
});
$('#menuAbout').on('click', function showModalAbout() {
  $('#modalAbout').modal('show');
});
$('#modalLaunchStandort').on('click', function showModalAbout() {
  $('#modalStandort').modal('show');
});

var pattern = Trianglify({
		cell_size: 500,
		variance: 1,
		x_colors: ['#526b7b', '#6691ab', '#375b5f'],
		width: window.innerWidth,
		height: window.innerHeight
	});
	document.body.style.backgroundImage =  "url(" + pattern.png() + ")";

var weatherIcons =  {
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
