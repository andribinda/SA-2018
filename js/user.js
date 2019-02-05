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

function setItems5day(data, weatherIcons){
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

          console.log(data);
          console.log("Help");
          setHTML5day(data, wIconD1, wIconD2, wIconD3, wIconD4, wIconD5);
        }

function setHTML5day(data, wIconD1, wIconD2, wIconD3, wIconD4, wIconD5) {

        $("#wIconD1").addClass(wIconD1);
        $("#d1Temp").html("<h4><li>" +  Math.round(data["list"]["0"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["0"]["weather"]["0"]["description"] +"</h6></li>");
        $("#d1Info").html("<li><h5>" + tMin +	Math.round(data["list"]["0"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(data["list"]["0"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["0"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD2").addClass(wIconD2);
        $("#d2Temp").html("<h4><li> " + Math.round(data["list"]["8"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["8"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d2Info").html("<li><h5>" + tMin +	Math.round(data["list"]["8"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(data["list"]["8"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["8"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD3").addClass(wIconD3);
        $("#d3Temp").html("<li><h4>" + Math.round(data["list"]["16"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["16"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d3Info").html("<li><h5>" + tMin +	Math.round(data["list"]["16"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(data["list"]["16"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["16"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD4").addClass(wIconD4);
        $("#d4Temp").html("<li><li><h4>" + Math.round(data["list"]["24"]["main"]["temp"]) + "°C</h4></li><h6>" + data["list"]["24"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d4Info").html("<li><h5>" + tMin +	Math.round(data["list"]["24"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(data["list"]["24"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["24"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD5").addClass(wIconD5);
        $("#d5Temp").html("<li><h4>" + Math.round(data["list"]["32"]["main"]["temp"]) + "°C</h4></li><li><h6>" + data["list"]["32"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d5Info").html("<li><h5>" + tMin +	Math.round(data["list"]["32"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(data["list"]["32"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + data["list"]["32"]["wind"]["speed"] + "m/s</li>");

        drawChartDetail(data);
        eva.replace()
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
    $('#modalUser').on('shown.bs.modal', function () {
        $('#emailInputUser').focus()
      })

    $('#menuAbout').on('click', function showModalAbout() {
      $('#modalAbout').modal('show');
    });
    $('#modalLaunchStandort').on('click', function showModalAbout() {
      $('#modalStandort').modal('show');
    });

    $('#modalStandort').on('shown.bs.modal', function () {
      setItems5day(data, weatherIcons);
      setHTML5day(data, wIconD1, wIconD2, wIconD3, wIconD4, wIconD5);
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
