/**
 * Created by gallatib on 01.02.2017.
 */

function openpopup(idName) {
    var x = document.getElementById(idName);

    x.className = "clicked";
}

function closepopup(idName) {
    var x = document.getElementById(idName);

    x.className = "notclicked";
}

function closeallpopups() {
    var x = document.getElementsByClassName('clicked');
    x.className = "notclicked";
}
