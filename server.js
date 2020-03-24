const express = require("express");
const app = express();

app.use(express.static("dist"));

app.get("/", function (req, res) {
    res.sendFile(__dirname + "/index.html");
});

app.listen(process.env.POST || 3000, function () { console.log("Server up and running") });