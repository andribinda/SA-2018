// Script starter
$(document).ready(function() {
  console.log("ready!");
  var latitude = 0;
  var longitude = 0;
  getLocation();
  prepareButtons();
  console.log("Page location is " + window.location.href);
});

tMin = "<i data-eva='thermometer-minus' data-eva-fill='#d8eaf1' data-eva-height='24' data-eva-width='24'></i> ";
tMax = "<i data-eva='thermometer-plus' data-eva-fill='#d8eaf1' data-eva-height='24' data-eva-width='24'></i> ";
tNormal = "<i data-eva='thermometer' data-eva-fill='#d8eaf1' data-eva-height='24' data-eva-width='24'></i> ";
manualSelection = true;

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
    $("#heuteInfo").html("<li><h5>" + tMin + data["main"]["temp_min"] + " °C</h5></li><li><h5>" + tMax + data["main"]["temp_max"] + " °C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " +
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

    setItems5day(data, weatherIcons);
  });
}

function ortSuche() {
              var options = {
              types: ['(regions)'],
              componentRestrictions: {country: 'CH'}
            };

            var input = document.getElementById('inputTextNav');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener('place_changed', getPlaceSearch);

            google.maps.event.addDomListener(input, 'keydown', function(e) {
              if (e.keyCode == 13 && $('.pac-container:visible').length) {
                  e.preventDefault();
                  manualSelection = false;
                  var firstChoice = $(".pac-container .pac-item:first").text();
                  console.log(firstChoice);
                  var geocode = new google.maps.Geocoder();
                  geocode.geocode({"address":firstChoice }, function(resultat, status) {
                      if (status == google.maps.GeocoderStatus.OK) {
                        lat = resultat[0].geometry.location.lat();
                        lng = resultat[0].geometry.location.lng();
                        $("input").val(firstChoice.match(/[A-Z][a-z]+|[0-9]+/g).join(", "));
                        getWeather(lat,lng);
                      }
                  });
              } else {manualSelection = true;}
          })
};

function getPlaceSearch() {
      if (manualSelection == true) {
        var place = this.getPlace();
        lng = place.geometry.location.lng();
        lat = place.geometry.location.lat();
        getWeather(lat,lng);
      }
      }


function getWeather() {
    $.ajax({
      url: "https://api.openweathermap.org/data/2.5/weather?lat=" + lat + "&lon=" + lng +
        "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
      context: document.body,
      dataType: 'json'
    }).done(function(data) {
      setItems(data, weatherIcons);

      tRise = data["sys"]["sunrise"];
      tSet = data["sys"]["sunset"];

      $("#actualPlace").html(data["name"] + " / " + data["sys"]["country"]);
      $("#heuteTemp").html("<h3><li> " + Math.round(data["main"]["temp"]) + "°C</h3></li><li><h5>" + data["weather"]["0"]["description"] + "</h5></li>");
      $("#heuteInfo").html("<li><h5>" + tMin + data["main"]["temp_min"] + " °C</h5></li><li><h5>" + tMax + data["main"]["temp_max"] + " °C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " +
        data["wind"]["speed"] + " m/s</li><li><h5><i class='wi wi-sunrise'></i> " + Unix_timestamp(tRise) + "</h5></li><li><h5><i class='wi wi-sunset'></i> " + Unix_timestamp(tSet) + "</h5></li>");
    });

    $.ajax({
      url: "https://api.openweathermap.org/data/2.5/forecast?lat=" + lat + "&lon=" + lng +
        "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
      context: document.body,
      dataType: 'json'
    }).done(function(data) {
      setItems5day(data, weatherIcons);
    });
}

//Icon abfragen und setzen (Heute)
function setItems(data,weatherIcons) {
    var prefix = 'wi wi-';
    var weatherid = data.weather[0].id;
    var wIcon = weatherIcons[weatherid].icon;

    if (!(weatherid > 699 && weatherid < 800) && !(weatherid > 899 && weatherid < 1000)) {
      wIcon = 'day-' + wIcon;
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
function prepareButtons() {
  $('.btn-Navbar').on('click', function setModalTab() {
    var tabTarget = $(this).data('tab');
      console.log(tabTarget);
    $('.modalRegLog').modal({'backdrop':'static'});
    $('.modalRegTabBar a[href="#' + tabTarget + '"]').tab('show');
  });

  $('.modalRegLog').on('shown.bs.modal', function () {
      $('#emailInputLogin').focus();
  });

  $('.modalRegTabBar a[href="#modalTabLogin"]').on('shown.bs.tab', function () {
      $('#emailInputLogin').focus();
  });

  $('.modalRegTabBar a[href="#modalTabReg"]').on('shown.bs.tab', function () {
    $('#emailInput').focus();
  });

  if (window.location.href == 'https://weather.zubler.ch/index.php?error-login') {
    $('.modalRegLog').modal({'backdrop':'static'});
    $('.modalRegTabBar a[href="#modalTabLogin]').tab('show');
  } else if (window.location.href.match(/error-reg/gi)) {
    $('.modalRegLog').modal({'backdrop':'static'});
    $('.modalRegTabBar a[href="#modalTabReg"]').tab('show');
  }

    google.maps.event.addDomListener(window, 'load', ortSuche);
}

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
