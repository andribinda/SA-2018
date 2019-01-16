<script>

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
	$('.btn-Navbar').on('click', function setModalTab() {
		console.log("Navbar-Buttons ok");
		var tabTarget = $(this).data('tab');
		$('.modalRegLog').modal('show');
		$('.modalRegTabBar a[href="#' + tabTarget + '"]').tab('show');
	}
);
</script>
