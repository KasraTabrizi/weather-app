const apiKey = "ef560ab659e3a9522467daea187b0400";
let gentID = "2797657";
let cityId = 0;
let apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
let cityName = "Gent";
let cityObj;
const arrayData = [];


document.getElementById("").addEventListener("click", () => {

    //get city name from input text box
    let inputText = document.getElementById("").value;

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
                    arrayData.push(weatherObj.city.name);
                    arrayData.push(weatherObj.city.country);
                    for (data of weatherObj.list) {
                        console.log(data);
                        let dateTime = data.dt_txt.split(" ");
                        if (dateTime[1] === "18:00:00") {
                            //push date and time
                            arrayData.push(dateTime[0]);
                            arrayData.push(dateTime[1]);
                            //push main temp
                            arrayData.push(`${data.main.temp} °C`);
                            //push cloudiness description
                            arrayData.push(data.weather[0].description);
                            //push humidity
                            arrayData.push(`${data.main.humidity} %`);
                            //push pressure
                            arrayData.push(`${data.main.pressure} hpa`);
                            //push wind speed
                            arrayData.push(`${data.wind.speed} m/s`);
                        }
                    }
                });
            console.log(arrayData);
        }
    };
    xmlhttp.open("GET", "script/citylist.json", true);
    xmlhttp.send();
});