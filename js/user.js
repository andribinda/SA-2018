// Script starter
$(document).ready(function() {
  console.log("ready!");
  var latitude = 0;
  var longitude = 0;
  getLocation();
  setBackground() ;
  prepareButtons();
});

tMin = "<i data-eva='thermometer-minus' data-eva-height='24' data-eva-width='24'></i> ";
tMax = "<i data-eva='thermometer-plus' data-eva-height='24' data-eva-width='24'></i> ";
tNormal = "<i data-eva='thermometer' data-eva-height='36' data-eva-width='36'></i> "

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
          $("#standortTemperatur").html("<h2>" + tNormal + Math.round(data["main"]["temp"]) + "°C </h2>");
          $("#standortBeschreibung").html(data["weather"]["0"]["description"]);
          eva.replace();
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
          console.log(tNormal);
          $("#standortBeschreibung").html(data["weather"]["0"]["description"]);
          $("#standortTemperatur").html("<h2>" + tNormal + Math.round(data["main"]["temp"]) + "°C </h2>");
          $("#standortOrt").html(data["name"] + " / " + data["sys"]["country"]);
          eva.replace();
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

function prepareButtons() {
    $('.btn-Navbar').on('click', function setModalTab() {
      var tabTarget = $(this).data('tab');
      $('.modalRegLog').modal('show');
      $('.modalRegTabBar a[href="#' + tabTarget + '"]').tab('show');
    });

    $('#menuUser').on('click', function showModalUser() {
      $('#modalUser').modal('show');
    });
    $('#menuAbout').on('click', function showModalAbout() {
      $('#modalAbout').modal('show');
    });
    $('#modalLaunchStandort').on('click', function showModalAbout() {
      $('#modalStandort').modal('show');
    });
}

function setBackground() {
  var pattern = Trianglify({
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
