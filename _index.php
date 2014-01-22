<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width" />

	<title id="title">Channel 599</title>

	<link rel="icon" href="http://ch599.com/favicon.ico" type="image/ico">
	
	<script type="text/javascript" src="//use.typekit.net/upu6ymf.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<style>

		#logo, #countdown {
			color: #333;
			font-family: 'futura-pt', futura, sans-serif;
			font-weight: 500;
			line-height: 1.5;
			text-transform: uppercase;
			text-align: center;
		}

		#logo {
			font-size: 60px;
		}

		#logo small {
			color: #999;
			font-size: 24px;
		}

		#countdown {
			font-size: 32px;
		}

		.time {
			display: inline-block;
			width: 100px;
		}

	</style>
</head>
<body>
	
	<h1 id="logo">Channel 599</h1>
	<p id="countdown">
		<span class="time">
			<span id="hours">00</span>h
		</span>
		<span class="time">
			<span id="minutes">00</span>m
		</span>
		<span class="time">
			<span id="seconds">00</span>s
		</span>
	</p>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script>

		var end = new Date('08/25/2013 11:59 PM');

		var _second = 1000;
		var _minute = _second * 60;
		var _hour = _minute * 60;
		var _day = _hour * 24;
		var timer;

		function showRemaining() {
		    var now = new Date();
		    var distance = end - now;
		    if (distance < 0) {

		        clearInterval(timer);
		        document.getElementById('countdown').innerHTML = 'EXPIRED!';

		        return;
		    }
		    var days = Math.floor(distance / _day);
		    var hours = Math.floor((distance % _day) / _hour);
		    var minutes = Math.floor((distance % _hour) / _minute);
		    var seconds = Math.floor((distance % _minute) / _second);

		    $('#days').text(days);
		    $('#hours').text(hours);
		    $('#minutes').text(minutes);
		    $('#seconds').text(seconds);
		}

		timer = setInterval(showRemaining, 1000);

	</script>
	
</body>
</html>