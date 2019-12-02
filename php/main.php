<?php

define("apiKey","ef560ab659e3a9522467daea187b0400"); //declare constant variable for the API key
define("days",["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"] ); //declare constant variable for the days of the week
$cityId = "2797657"; //ID Gent
//$apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . urlencode($cityId) . '&units=metric&APPID=' . urlencode(apiKey);
$apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $cityId . '&units=metric&APPID=' . apiKey;
$cityObj;

if (isset($_POST["cityname"])) { //get the cityname from the form
    $cityName = $_POST["cityname"];
    //fetch data from citylist.json to find the id of the city
    $jsonCityList = file_get_contents('../script/citylist.json');
    
    $arrayCityList = json_decode($jsonCityList, true);
    //echo var_dump($arrayCityList);
    //loop through all the citynames untill you find a match and then return id
    foreach( $arrayCityList as $value){
        if ($value['name'] == $cityName){
            echo $value['name'];
            echo $value['id'];
            $cityId = $value['id'];
        break;
        }
    }
    $apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $cityId . '&units=metric&APPID=' . apiKey;
    //fetch data from the weather app
    $json_data = file_get_contents($apiLink);

    $user_data = json_decode($json_data, true); //decode json into an array
    echo var_dump($user_data['city']);
    $user_data_length = count($user_data['list']); //get the lenght of the list
    //echo $user_data_length;
    for ($x = 0; $x < $user_data_length; $x++) {
        echo var_dump($user_data['list'][strval($x)]['main']['temp']);
    }
    //echo var_dump($user_data['city']['id']);
}
?>