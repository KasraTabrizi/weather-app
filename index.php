<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Alata&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/css/main_styles.css">
</head>

<body>
    <div id="wrapper">
        <h1>Weather App</h1>
        <div id="Search">
            <div class="searchbox">
            <form action="" method="post" target="_blank">
                <input type="text" id="searchTerm" name="cityname" placeholder="Enter your city">
                <button type="submit value="Submit" id="searchButton">Search</button>
                </form>
            </div>
        </div>
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
            $jsonCityList = file_get_contents('script/citylist.json');
            
            $arrayCityList = json_decode($jsonCityList, true);
            //echo var_dump($arrayCityList);
            //loop through all the citynames untill you find a match and then return id
            foreach( $arrayCityList as $value){
                if ($value['name'] == $cityName){
                    //echo $value['name'];
                    //echo $value['id'];
                    $cityId = $value['id'];
                break;
                }
            }

            $apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $cityId . '&units=metric&APPID=' . apiKey;
            //fetch data from the weather app
            $json_data = file_get_contents($apiLink);

            $user_data = json_decode($json_data, true); //decode json into an array
            //echo var_dump($user_data['list']['0']['weather']['0']['description']);
            //echo var_dump($user_data);
            $user_data_length = count($user_data['list']); //get the lenght of the list
            //echo $user_data_length;
            for ($x = 0; $x < $user_data_length; $x++) {
                //echo var_dump($user_data['list'][strval($x)]['main']['temp']);
            }
            //echo var_dump($user_data['city']['id']);
           
        }

        ?>

        <h2 id="cityname"><?php echo $user_data['city']['name'] . ', ' . $user_data['city']['country'];?></h2>
        <div id="wrapperbox">
            <div class="box">
                <?php 
                    $datum = $user_data['list']['0']['dt_txt'];
                    $split = explode(" ", $datum);
                    $dayName = date('l', strtotime($split[0]));
                ?>
                <h3 class="datum"><?php echo $split[0]; ?></h3>
                <h3 class="nameday"><?php echo $dayName; ?></h3>
                <div class="day">
                    <p class="hour"><?php echo $split[1]; ?></p>
                    <?php 
                        $iconName = $user_data['list']['0']['weather']['0']['icon'];
                        $iconLink = "http://www.openweathermap.org/img/w/".$iconName.".png";
                    ?>
                    <div class="image"></div><img src=<?php echo $iconLink;?> alt="icon">
                </div>
                <p class="maintemp"><?php echo $user_data['list']['0']['main']['temp'];?>°C</p>
                <table class="customers">
                    <tr>
                        <td>Cloudiness</td>
                        <td class="cloud"><?php echo $user_data['list']['0']['weather']['0']['description'];?></td>
                    </tr>
                    <tr>
                        <td>Humidity</td>
                        <td class="humidity"><?php echo $user_data['list']['0']['main']['humidity'];?>%</td>
                    </tr>
                    <tr>
                        <td>Pressure</td>
                        <td class="pressure"><?php echo $user_data['list']['0']['main']['pressure'];?>hpa</td>
                    </tr>
                    <tr>
                        <td>Wind</td>
                        <td class="wind"><?php echo $user_data['list']['0']['wind']['speed'];?>m/s</td>
                    </tr>
                </table>
            </div>
            <div class="box">
                <h3 class="datum">Datum</h3>
                <h3 class="nameday">Day</h3>
                <div class="day">
                    <p class="hour">hour</p>
                    <div class="image"><img src="" alt="icon"></div>
                    <p class="maintemp"></p>
                    <table class="customers">
                        <tr>
                            <td>Cloudiness</td>
                            <td class="cloud">/</td>
                        </tr>
                        <tr>
                            <td>Humidity</td>
                            <td class="humidity">/</td>
                        </tr>
                        <tr>
                            <td>Pressure</td>
                            <td class="pressure">/</td>
                        </tr>
                        <tr>
                            <td>Wind</td>
                            <td class="wind">/</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <h3 class="datum">Datum</h3>
                <h3 class="nameday">Day</h3>
                <div class="day">
                    <p class="hour">hour</p>
                    <div class="image"><img src="" alt="icon"></div>
                    <p class="maintemp"></p>
                    <table class="customers">
                        <tr>
                            <td>Cloudiness</td>
                            <td class="cloud">/</td>
                        </tr>
                        <tr>
                            <td>Humidity</td>
                            <td class="humidity">/</td>
                        </tr>
                        <tr>
                            <td>Pressure</td>
                            <td class="pressure">/</td>
                        </tr>
                        <tr>
                            <td>Wind</td>
                            <td class="wind">/</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <h3 class="datum">Datum</h3>
                <h3 class="nameday">Day</h3>
                <div class="day">
                    <p class="hour">hour</p>
                    <div class="image"><img src="" alt="icon"></div>
                    <p class="maintemp"></p>
                    <table class="customers">
                        <tr>
                            <td>Cloudiness</td>
                            <td class="cloud">/</td>
                        </tr>
                        <tr>
                            <td>Humidity</td>
                            <td class="humidity">/</td>
                        </tr>
                        <tr>
                            <td>Pressure</td>
                            <td class="pressure">/</td>
                        </tr>
                        <tr>
                            <td>Wind</td>
                            <td class="wind">/</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="box">
                <h3 class="datum">Datum</h3>
                <h3 class="nameday">Day</h3>
                <div class="day">
                    <p class="hour">hour</p>
                    <div class="image"><img src="" alt="icon"></div>
                    <p class="maintemp"></p>
                    <table class="customers">
                        <tr>
                            <td>Cloudiness</td>
                            <td class="cloud">/</td>
                        </tr>
                        <tr>
                            <td>Humidity</td>
                            <td class="humidity">/</td>
                        </tr>
                        <tr>
                            <td>Pressure</td>
                            <td class="pressure">/</td>
                        </tr>
                        <tr>
                            <td>Wind</td>
                            <td class="wind">/</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>