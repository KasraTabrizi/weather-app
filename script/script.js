const apiKey = "ef560ab659e3a9522467daea187b0400";
let gentID = "2797657";
let cityId = 0;
let apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
let cityName = "Gent";
let cityObj;
const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];


document.getElementById("searchButton").addEventListener("click", () => {

    //get city name from input text box
    let inputText = document.getElementById("searchTerm").value;
    console.log(inputText);
    //parse json file with all the citynames and id
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cityObj = JSON.parse(this.responseText);
            for (element of cityObj) {
                if (element.name == inputText) {
                    cityId = String(element.id);
                }
            }
            apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
            console.log(apiLink);

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
                        if (dateTime[1] === "15:00:00") {
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
                            i++;
                        }
                    }
                });
        }
    };
    xmlhttp.open("GET", "script/citylist.json", true);
    xmlhttp.send();
});