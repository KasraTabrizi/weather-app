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
                <button type="submit" value="Submit" id="searchButton">Search</button>
                </form>
            </div>
        </div>
    <?php
        define("apiKey","ef560ab659e3a9522467daea187b0400"); //declare constant variable for the API key
        $cityId = ''; 
        $apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $cityId . '&units=metric&APPID=' . apiKey;

        if (isset($_POST["cityname"])) { //get the cityname from the form
            $cityName = $_POST["cityname"];
            //fetch data from citylist.json to find the id of the city
            $jsonCityList = file_get_contents('script/citylist.json');
            
            //fetch jsoncitylist and convert it into an array
            $arrayCityList = json_decode($jsonCityList, true); 
            //echo var_dump($arrayCityList);
            //loop through all the citynames untill you find a match and then return id
            foreach( $arrayCityList as $value){
                if ($value['name'] == $cityName){
                    $cityId = $value['id'];
                break;
                }
            }
            $apiLink = 'http://api.openweathermap.org/data/2.5/forecast?id=' . $cityId . '&units=metric&APPID=' . apiKey;
            //fetch data from the weather app
            $json_data = file_get_contents($apiLink);

            $user_data = json_decode($json_data, true); //decode json into an array
            $user_data_length = count($user_data['list']); //get the lenght of the list

            //HTML TABLE SECTION
            echo '<h2 id="cityname">';
            echo $user_data['city']['name'] . ', ' . $user_data['city']['country'];
            echo '</h2>';

            echo '<div id="wrapperbox">';
            //for loop
            for ($x = 0; $x < $user_data_length; $x++) {
                //split dt_txt into date and time = $split[0] = date & $split[1] = time
                $datum = $user_data['list'][strval($x)]['dt_txt'];
                $split = explode(" ", $datum);
                $dayName = date('l', strtotime($split[0]));
                if ( $split[1] == "15:00:00" ){ //only print when the time is equal to the desired time.
                    echo '<div class="box">';
                    echo '<h3 class="datum">';
                    echo $split[0];
                    echo '</h3>';
                    echo '<h3 class="nameday">';
                    echo $dayName;
                    echo '</h3>';

                    echo '<div class="day">';
                    echo'<p class="hour">';
                    echo $split[1]; 
                    echo'</p>'; //end class hour
                    $iconName = $user_data['list'][strval($x)]['weather']['0']['icon'];
                    $iconLink = 'http://www.openweathermap.org/img/w/' . $iconName . '.png';
                    echo '<div class="image">';
                    echo '<img src=' . $iconLink . ' alt="icon">';
                    echo '</div>'; //end class image
                    echo '</div>'; //end class day
                    echo '<p class="maintemp">';
                    echo $user_data['list'][strval($x)]['main']['temp'];
                    echo '°C</p>'; // end class maintemp
                    
                    echo '<table class="customers">';

                    echo '<tr>';
                    echo '<td>Cloudiness</td>';
                    echo '<td class="cloud">';
                    echo $user_data['list'][strval($x)]['weather']['0']['description'];
                    echo '</td>';
                    echo '</tr>'; //end tr 1
                    
                    echo '<tr>';
                    echo '<td>Humidity</td>';
                    echo '<td class="humidity">';
                    echo $user_data['list'][strval($x)]['main']['humidity'];
                    echo '%</td>';
                    echo '</tr>'; //end tr 2

                    echo '<tr>';
                    echo '<td>Pressure</td>';
                    echo '<td class="pressure">';
                    echo $user_data['list'][strval($x)]['main']['pressure'];
                    echo 'hpa</td>';
                    echo '</tr>'; //end tr 3

                    echo '<tr>';
                    echo '<td>Wind</td>';
                    echo '<td class="wind">';
                    echo $user_data['list'][strval($x)]['wind']['speed'];
                    echo 'm/s</td>';
                    echo '</tr>'; //end tr 4

                    echo '</table>'; //end table element
                    echo '</div>'; //end div class box
                } 
            }
            echo '</div>'; //end wrapperbox
        }
        ?>
    </div>
</body>

</html>