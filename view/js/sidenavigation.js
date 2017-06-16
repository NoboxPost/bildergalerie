// better use an array, those lines are not edited just for better understandig

function opensidenav() {
    var w = document.getElementsByTagName("article")[0];
    var x = document.getElementById("sidenav");
    var y = document.getElementById("sidenavburger");
    var z = document.getElementById("sidenavclose");

    w.style.paddingLeft = "3%";
    x.className = "snbclicked";
    y.className = "snbclicked";
    z.className = "snbclicked";

}

function closesidenav() {
    var w = document.getElementsByTagName("article")[0];
    var x = document.getElementById("sidenav");
    var y = document.getElementById("sidenavburger");
    var z = document.getElementById("sidenavclose");

    w.style.paddingLeft = "5%";
    x.className = "snbnotclicked";
    y.className = "snbnotclicked";
    z.className = "snbnotclicked";

}