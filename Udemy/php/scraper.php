<?php

	$city = $_GET['city'];
	
	$city = str_replace(" ", "", $city);
	$contents = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");


	echo $contents;
		

?>