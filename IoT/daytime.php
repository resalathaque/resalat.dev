<?php

$endpoint = 'https://api.sunrisesunset.io/json?lat=26.1231326&lng=88.7604353&timezone=Asia/Dhaka';

$start = $month = time();
$end = strtotime('+1 year');

$times = [];

while($month < $end)
{
	$uri = $endpoint .'&date='. date('Y-m-d', $month);
	echo $uri;

	$json = file_get_contents($uri);
	$data = json_decode($json, True);

	$times[date('Y-W', $month)] = [
		 date("H:i", strtotime($data['results']['sunrise'])),
		 date("H:i", strtotime($data['results']['sunset']))
	];

	print_r($times);

	$month = strtotime("+1 week", $month);
}

file_put_contents('daytime.json', json_encode($times));

?>