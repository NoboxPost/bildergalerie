<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 22.01.2017
 * Time: 11:37
 */


//require_once("../../controller/posthandler.php");
require_once('../controller/posthandler.php');


?>
<header>
    <nav class="mainnav"></nav>

    <?php if (isset($_SESSION["id"])) {
        echo "<div class=\"sidenavdisplaybutton\"><a id=\"sidenavburger\" class=\"snbnotclicked\" href=\"javascript:void(0);\" onclick=\"opensidenav()\">&#9776;</a><a id=\"sidenavclose\" class=\"snbnotclicked\" href=\"javascript:void(0);\" onclick=\"closesidenav()\">&#10005;</a></div>";
    }else{
        echo "<div class='sidenavbuttonplaceholder'></div>";
    }

    ?>

    <h1>NOBOX</h1>

    <?php if (isset($_SESSION["id"])) {
        require_once("logoutform.php");
    } else {
        echo "<a class='button' href='javascript:void(0);' onclick='openpopup(\"login\")'>Login</a>";
        require_once("loginform.php");
        echo "<a class='button' href='javascript:void(0);' onclick='openpopup(\"register\")'>Registrieren</a>";
        require_once("createuserform.php");
        echo "<a class='button' href='./impressum.php'>Impressum</a>";

        if(isset($error)) {
            echo "<p id='error'>$error</p>";
        }
    } ?>


    </nav>

</header>

