const apiKey = "ef560ab659e3a9522467daea187b0400";
let cityId = 0;
let apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
let cityObj;
const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
let locationImage = document.createElement('img');
locationImage.src = "https://img.icons8.com/pastel-glyph/32/ffffff/place-marker.png";


document.getElementById("searchButton").addEventListener("click", () => {
    let checkCity = false;
    //get city name from input text box
    let cityName = document.getElementById("searchTerm").value;
    //parse json file with all the citynames and id
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cityObj = JSON.parse(this.responseText);
            for (element of cityObj) {
                if (element.name == cityName) {
                    cityId = String(element.id);
                    checkCity = true;
                    break;
                }
            }
            if (!checkCity) {
                alert("City doesn't exist or is mistyped");
            }
            apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
            //Fetch data from openweathermap API
            fetch(apiLink)
                .then(res => res.json())
                .then(weatherObj => {
                    console.log(weatherObj);
                    document.getElementById("cityname").innerHTML = `${weatherObj.city.name}, ${weatherObj.city.country}`;
                    let i = 0;
                    for (data of weatherObj.list) {
                        console.log(data);
                        let dateTime = data.dt_txt.split(" ");
                        if (dateTime[1] === "18:00:00") {
                            //push date and time
                            document.getElementsByClassName("datum")[i].innerHTML = `${dateTime[0]}`;
                            let date = new Date(dateTime[0]);
                            document.getElementsByClassName("nameday")[i].innerHTML = `${days[date.getDay()]}`;
                            document.getElementsByClassName("hour")[i].innerHTML = `${dateTime[1].slice(0,2)} O'clock`;
                            //get image icon
                            let icon = data.weather[0].icon;
                            console.log(icon);
                            document.getElementsByTagName("img")[i].src = `http://www.openweathermap.org/img/w/${icon}.png`;
                            //push main temp
                            document.getElementsByClassName("maintemp")[i].innerHTML = `${data.main.temp} °C`;
                            //push cloudiness description
                            document.getElementsByClassName("cloud")[i].innerHTML = data.weather[0].description;
                            //push humidity
                            document.getElementsByClassName("humidity")[i].innerHTML = `${data.main.humidity} %`;
                            //push pressure
                            document.getElementsByClassName("pressure")[i].innerHTML = `${data.main.pressure} hpa`;
                            //push wind speed
                            document.getElementsByClassName("wind")[i].innerHTML = `${data.wind.speed} m/s`;
                            // document.getElementById("cityname").appendChild(locationImage);
                            i++;
                        }
                        //make animation that makes the box visible by icrementing the opacity.
                        for (let i = 0; i < 5; i++) {
                            document.querySelectorAll(".box")[i].style = "visibility: visible";
                            document.querySelectorAll(".box")[i].animate([
                                // keyframes
                                { opacity: '0%' },
                                { opacity: '100%' }
                            ], {
                                // timing options
                                duration: 500,
                            });
                        }
                    }
                });
        }
    };
    xmlhttp.open("GET", "script/citylist.json", true);
    xmlhttp.send();
});