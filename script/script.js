const apiKey = "ef560ab659e3a9522467daea187b0400";
let gentID = "2797657";
let cityId = 0;
let apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
let cityName = "Amsterdam";
let cityObj;

//parse json file with all the citynames and id
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        cityObj = JSON.parse(this.responseText);
        for (element of cityObj) {
            if (element.name == cityName) {
                cityId = String(element.id);
            }
        }
        apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;
        console.log(apiLink);

        //Fetch data from openweathermap API
        fetch(apiLink)
            .then(res => res.json())
            .then(weatherObj => console.log(weatherObj));




    }
};
xmlhttp.open("GET", "script/citylist.json", true);
xmlhttp.send();