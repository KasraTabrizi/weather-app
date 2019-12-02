<?php

define("apiKey","ef560ab659e3a9522467daea187b0400"); //declare constant variable for the API key
define("days",["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"] ); //declare constant variable for the days of the week
$cityId = "3130625";
//$apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . urlencode($cityId) . '&units=metric&APPID=' . urlencode(apiKey);
$apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $cityId . '&units=metric&APPID=' . apiKey;
$cityObj;

$json_data = file_get_contents($apiLink);

$user_data = json_decode($json_data, true); //decode json into an array
echo var_dump($user_data);
$user_data_length = count($user_data['list']); //get the lenght of the list
//echo $user_data_length;
for ($x = 0; $x < $user_data_length; $x++) {
    echo var_dump($user_data['list'][strval($x)]['main']['temp']);
}
//echo var_dump($user_data['city']['id']);

?>