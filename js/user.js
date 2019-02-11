// Script starter
$(document).ready(function() {
  var latitude = 0;
  var longitude = 0;
  getLocation();
  setBackground() ;
  prepareButtons();
  console.log(modalSelection);
});

dataDay = 0;
data5Day = 0;
dataHomeDay = 0;
data5HomeDay = 0;
lat = 0;
lng = 0;
plz = 5400;
modalSelection = "none";
manualSelection = true;

tMin = "<i data-eva='thermometer-minus' data-eva-fill='#d8eaf1' data-eva-height='24' data-eva-width='24'></i> ";
tMax = "<i data-eva='thermometer-plus' data-eva-fill='#d8eaf1' data-eva-height='24' data-eva-width='24'></i> ";
tNormal = "<i data-eva='thermometer' data-eva-fill='#d8eaf1' data-eva-height='24' data-eva-width='24'></i> ";

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showError(error) {
  console.log(error);
}

function showPosition(position) {
  lat = position.coords.latitude;
  lng = position.coords.longitude;
  getWeatherToday(lat,lng);
  getWeather5Day(lat,lng);
  getWeatherHomeToday(plz);
}

function getWeatherHomeToday(plz){
  $.ajax({
    type: "GET",
     url: "/user.php",
     data: {requestplz: 'plz'},
     dataType: 'json',
     success: function(data){
        alert(data);
        alert("Test");
      }}).done(function(data){
        alert(data);
        alert("Test");
      });
    $.ajax({
       url: "https://api.openweathermap.org/data/2.5/weather?zip=" + plz + ",ch" +
         "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
       context: document.body,
       dataType: 'json'
     }).done(function(dataHomeDay) {
       console.log("homebase");
       console.log(dataHomeDay);
       setItemsHome(dataHomeDay, weatherIcons);
   });
}

function getWeatherHome5Day(plz) {
        $.ajax({
          url: "https://api.openweathermap.org/data/2.5/forecast?zip=" + plz + ",ch" +
            "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
          context: document.body,
          dataType: 'json'
        }).done(function(dataHome5Day) {
          console.log(dataHome5Day);
          setItems5day(dataHome5Day, weatherIcons);
      });
    }

function getWeatherToday(latitude,longitude) {
       $.ajax({
          url: "https://api.openweathermap.org/data/2.5/weather?lat=" + latitude + "&lon=" + longitude +
            "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
          context: document.body,
          dataType: 'json'
        }).done(function(dataDay) {
          setItems(dataDay, weatherIcons);
        });
  }

function getWeather5Day(latitude,longitude) {
        $.ajax({
          url: "https://api.openweathermap.org/data/2.5/forecast?lat=" + latitude + "&lon=" + longitude +
            "&units=metric&lang=de&appid=6012cf5997f032d2c82563e60ef96a56",
          context: document.body,
          dataType: 'json'
        }).done(function(data5Day) {
          setItems5day(data5Day, weatherIcons);
      });
    }

function drawChartDetail(weatherData) {
            var ctx = document.getElementById('tempChart').getContext('2d');
            Chart.defaults.global.defaultFontColor = 'white';
            Chart.defaults.global.defaultFontSize = '12';

            //Wetterdaten richtig formatieren für Chart - Push in 2 neue Arrays
            var timestamp = [];
            var wetterDaten = [];
            for (var i = 0; i < weatherData["list"].length; i = (i+2)) {
                timestamp.push(weatherData.list[i].dt_txt);
                wetterDaten.push(Math.round(weatherData.list[i].main.temp * 10) / 10);
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
            //setBackground();
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
                        getWeatherToday(lat,lng);
                        getWeather5Day(lat,lng);
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
        getWeatherToday(lat,lng);
        getWeather5Day(lat,lng);
      }
      }

function setItems(wetterDaten,icons) {
          var prefix = 'wi wi-';
          var weatherid = wetterDaten.weather[0].id;
          var wIcon = weatherIcons[weatherid].icon;

          if (!(weatherid > 699 && weatherid < 800) && !(weatherid > 899 && weatherid < 1000)) {
            wIcon = 'day-' + wIcon;
          }
          wIcon = prefix + wIcon;
          $("#standortIcon").addClass(wIcon);
          setHTML(wetterDaten);
        }

function setItemsHome(wetterDaten,icons) {
        var prefix = 'wi wi-';
        var weatherid = wetterDaten.weather[0].id;
        var wIcon = weatherIcons[weatherid].icon;

        if (!(weatherid > 699 && weatherid < 800) && !(weatherid > 899 && weatherid < 1000)) {
          wIcon = 'day-' + wIcon;
        }
        wIcon = prefix + wIcon;
        $("#homebaseIcon").addClass(wIcon);
        setHTMLHome(wetterDaten);
      }

function setItems5day(daten5tage, icons){
          //Icons setzen für 5-Tages-Vorhersage evtl als Array mit Loop zum setzen der Icons
          var prefix = 'wi wi-';
          var weatheridD1 = daten5tage.list[0]["weather"]["0"].id;
          var weatheridD2 = daten5tage.list[8]["weather"]["0"].id;
          var weatheridD3 = daten5tage.list[16]["weather"]["0"].id;
          var weatheridD4 = daten5tage.list[24]["weather"]["0"].id;
          var weatheridD5 = daten5tage.list[32]["weather"]["0"].id;

          var wIconD1 = icons[weatheridD1].icon;
          var wIconD2 = icons[weatheridD2].icon;
          var wIconD3 = icons[weatheridD3].icon;
          var wIconD4 = icons[weatheridD4].icon;
          var wIconD5 = icons[weatheridD5].icon;

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

          setHTML5day(daten5tage, wIconD1, wIconD2, wIconD3, wIconD4, wIconD5);
        }

function setHTML(dataDay) {

  tRise = dataDay["sys"]["sunrise"];
  tSet = dataDay["sys"]["sunset"];

  $("#standortOrt").html(dataDay["name"] + " / " + dataDay["sys"]["country"]);
  $("#standortTemperatur").html(Math.round(dataDay["main"]["temp"]) + "°C");
  $("#standortBeschreibung").html(dataDay["weather"]["0"]["description"]);
  $("#standortInfo").html("<li><h4>" + tMin + dataDay["main"]["temp_min"] + " °C</h4></li><li><h4>" + tMax + dataDay["main"]["temp_max"] +
  " °C</h4></li><li><h4><i class='wi wi-strong-wind'></i> " + dataDay["wind"]["speed"] + " m/s</li><li><h4><i class='wi wi-sunrise'></i> " +
  Unix_timestamp(tRise) + "</h4></li><li><h4><i class='wi wi-sunset'></i> " + Unix_timestamp(tSet) + "</h4></li>");
  eva.replace()
}

function setHTMLHome(dataDay) {

  tRise = dataDay["sys"]["sunrise"];
  tSet = dataDay["sys"]["sunset"];

  $("#homebaseOrt").html(dataDay["name"] + " / " + dataDay["sys"]["country"]);
  $("#homebaseTemperatur").html(Math.round(dataDay["main"]["temp"]) + "°C");
  $("#homebaseBeschreibung").html(dataDay["weather"]["0"]["description"]);
  $("#homebaseInfo").html("<li><h4>" + tMin + dataDay["main"]["temp_min"] + " °C</h4></li><li><h4>" + tMax + dataDay["main"]["temp_max"] +
  " °C</h4></li><li><h4><i class='wi wi-strong-wind'></i> " + dataDay["wind"]["speed"] + " m/s</li><li><h4><i class='wi wi-sunrise'></i> " +
  Unix_timestamp(tRise) + "</h4></li><li><h4><i class='wi wi-sunset'></i> " + Unix_timestamp(tSet) + "</h4></li>");
  eva.replace()
}

function setHTML5day(wetter, wIconD1, wIconD2, wIconD3, wIconD4, wIconD5) {

        $("#wIconD1").addClass(wIconD1);
        $("#d1Temp").html("<h4><li>" +  Math.round(wetter["list"]["0"]["main"]["temp"]) + "°C</h4></li><li><h6>" + wetter["list"]["0"]["weather"]["0"]["description"] +"</h6></li>");
        $("#d1Info").html("<li><h5>" + tMin +	Math.round(wetter["list"]["0"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(wetter["list"]["0"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + wetter["list"]["0"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD2").addClass(wIconD2);
        $("#d2Temp").html("<h4><li> " + Math.round(wetter["list"]["8"]["main"]["temp"]) + "°C</h4></li><li><h6>" + wetter["list"]["8"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d2Info").html("<li><h5>" + tMin +	Math.round(wetter["list"]["8"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(wetter["list"]["8"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + wetter["list"]["8"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD3").addClass(wIconD3);
        $("#d3Temp").html("<li><h4>" + Math.round(wetter["list"]["16"]["main"]["temp"]) + "°C</h4></li><li><h6>" + wetter["list"]["16"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d3Info").html("<li><h5>" + tMin +	Math.round(wetter["list"]["16"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(wetter["list"]["16"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + wetter["list"]["16"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD4").addClass(wIconD4);
        $("#d4Temp").html("<li><li><h4>" + Math.round(wetter["list"]["24"]["main"]["temp"]) + "°C</h4></li><h6>" + wetter["list"]["24"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d4Info").html("<li><h5>" + tMin +	Math.round(wetter["list"]["24"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(wetter["list"]["24"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + wetter["list"]["24"]["wind"]["speed"] + "m/s</li>");

        $("#wIconD5").addClass(wIconD5);
        $("#d5Temp").html("<li><h4>" + Math.round(wetter["list"]["32"]["main"]["temp"]) + "°C</h4></li><li><h6>" + wetter["list"]["32"]["weather"]["0"]["description"] + "</h6></li>");
        $("#d5Info").html("<li><h5>" + tMin +	Math.round(wetter["list"]["32"]["main"]["temp_min"]) + "°C</h5></li><li><h5>" + tMax +
        Math.round(wetter["list"]["32"]["main"]["temp_max"]) + "°C</h5></li><li><h5><i class='wi wi-strong-wind'></i> " + wetter["list"]["32"]["wind"]["speed"] + "m/s</li>");

        //Header Detailansicht nur setzen wenn das Modal auf der User-Site geöffnet wird
        var onUserPage = document.getElementById("userPageDetailHeader");
          if(onUserPage){
              $("#userPageDetailHeader").html(wetter["city"]["name"]);
            }

        eva.replace()
        setDay();
        drawChartDetail(wetter);
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
    });
    $('#menuAbout').on('click', function showModalAbout() {
      $('#modalAbout').modal('show');
    });
    $('#modalLaunchStandort').on('click', function () {
        modalSelection = "standort";
        $('#modalDetail').modal('show');
    });
    $('#modalLaunchHomebase').on('click', function () {
        modalSelection = "home";
        console.log("home click");
        $('#modalDetail').modal('show');
    });

    $('#modalDetail').on('shown.bs.modal', function () {
      if (modalSelection == "standort") {
        getWeather5Day(lat,lng)
      } else if (modalSelection == "home") {
        getWeatherHome5Day(plz);
      };

    });

    $('#menuLogout').click(function(e){
      e.preventDefault();
      $.ajax({
        url: "/includes/logout.php",
        type:"POST",
        data: { 'action': $('#menuLogout').val()}
        });
     });
    google.maps.event.addDomListener(window, 'load', ortSuche);
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

function Unix_timestamp(t) {
      var dt = new Date(t * 1000);
      var hr = dt.getHours();
      var m = "0" + dt.getMinutes();
      return hr + ':' + m.substr(-2);
    }

function setDay() {
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
}

weatherIcons = {
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
