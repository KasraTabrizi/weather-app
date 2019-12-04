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
            <form action="" method="post" action="index.php">
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
    ?>
            <!-- HTML TABLE SECTION -->
            <h2 id="cityname"><?php echo $user_data['city']['name'] . ', ' . $user_data['city']['country']; ?></h2>
    
            <div id="wrapperbox">
            
            <?php
            //for loop
            for ($x = 0; $x < $user_data_length; $x++) {
                //split dt_txt into date and time = $split[0] = date & $split[1] = time
                $datum = $user_data['list'][strval($x)]['dt_txt'];
                $split = explode(" ", $datum);
                $dayName = date('l', strtotime($split[0]));
                if ( $split[1] == "15:00:00" ){ //only print when the time is equal to the desired time.

                    echo '<div class="box">';
                    echo '<h3 class="datum">'. $split[0] . '</h3>';
                    echo '<h3 class="nameday">' . $dayName . '</h3>';

                    echo '<div class="day">';
                    echo'<p class="hour">' . $split[1] . '</p>';

                    $iconName = $user_data['list'][strval($x)]['weather']['0']['icon'];
                    $iconLink = 'http://www.openweathermap.org/img/w/' . $iconName . '.png';
                    echo '<div class="image">';
                    echo '<img src=' . $iconLink . ' alt="icon">';
                    echo '</div>'; //end class image
                    echo '</div>'; //end class day
                    echo '<p class="maintemp">' . $user_data['list'][strval($x)]['main']['temp'] . '°C</p>';

                    echo '<table class="customers">';

                    generateTR('Cloudiness', $user_data['list'][strval($x)]['weather']['0']['description']);
                    generateTR('Humidity', $user_data['list'][strval($x)]['main']['humidity']);
                    generateTR('Pressure', $user_data['list'][strval($x)]['main']['pressure']);
                    generateTR('Wind', $user_data['list'][strval($x)]['wind']['speed']);

                    // echo '<tr>';
                    // echo '<td>Cloudiness</td>';
                    // echo '<td class="cloud">' . $user_data['list'][strval($x)]['weather']['0']['description'] . '</td>';
                    // echo '</tr>'; //end tr 1
                    
                    // echo '<tr>';
                    // echo '<td>Humidity</td>';
                    // echo '<td class="humidity">' . $user_data['list'][strval($x)]['main']['humidity'] . '%</td>';
                    // echo '</tr>'; //end tr 2

                    // echo '<tr>';
                    // echo '<td>Pressure</td>';
                    // echo '<td class="pressure">' . $user_data['list'][strval($x)]['main']['pressure'] . 'hpa</td>';
                    // echo '</tr>'; //end tr 3

                    // echo '<tr>';
                    // echo '<td>Wind</td>';
                    // echo '<td class="wind">' . $user_data['list'][strval($x)]['wind']['speed'] . 'm/s</td>';
                    // echo '</tr>'; //end tr 4

                    echo '</table>'; //end table element
                    echo '</div>'; //end div class box
                } 
            }
        }
        ?>
        <?php 
            function generateTR($dataName, $data){
                $unit = '';
                switch($dataName){
                    case 'Cloudiness':
                    break;
                    case 'Humidity':
                        $unit = '%';
                    break;
                    case 'Pressure':
                        $unit = 'hpa';
                    break;
                    case 'Wind':
                        $unit = 'm/s';
                    break;
                    default:
                    break;
                }
                echo '<tr>';
                echo '<td>' . $dataName . '</td>';
                echo '<td class="$dataName">' . $data . $unit .'</td>';
                echo '</tr>'; //end tr 4
            }
        ?>
        </div>
    </div>
</body>

</html>