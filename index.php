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
            <form action="/php/main.php" method="post" target="_blank">
                <input type="text" id="searchTerm" name="cityname" placeholder="Enter your city">
                <button type="submit value="Submit" id="searchButton">Search</button>
                </form>
            </div>
        </div>
        
        <!-- <h2 id="cityname"></h2>
        <div id="wrapperbox">
            <div class="box">
                <h3 class="datum">Datum</h3>
                <h3 class="nameday">Day</h3>
                <div class="day">
                    <p class="hour">hour</p>
                    <div class="image"></div><img src="" alt="icon">
                </div>
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
        </div> -->
    </div>
    
    <!-- <script src="script/citylist.json"></script>
    <script src="script/script.js"></script> -->
    <?php include 'php/main.php'; ?>
</body>

</html>