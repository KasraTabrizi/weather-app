let apiKey = "ef560ab659e3a9522467daea187b0400";
let cityId = "2797657";
let apiLink = `http://api.openweathermap.org/data/2.5/forecast?id=${cityId}&units=metric&APPID=${apiKey}`;

fetch(apiLink)
    .then(res => res.json())
    .then(weatherObj => console.log(weatherObj));