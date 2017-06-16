<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 18:13
 */
?>
<form action="" method="post" id='register' class='notclicked'>
    <a class="exitbutton" href='javascript:void(0);' onclick='closepopup("register")'>
        <svg width="40" height="40">
            <g fill="none" stroke="#CCCCCC " stroke-width="4" stroke-linecap="round">
                <path d="M7 7 L33 33"/>
                <path d="M33 7 L7 33"/>
            </g>
        </svg>
    </a>
    <h3>
        <?php
        if (isset($_SESSION["username"])) {
            $error = "Willkommen " . $_SESSION["username"];
            echo $error;
        } elseif (isset($dbresult["dbmessage"])) {

            if
            (strpos($dbresult["dbmessage"], "uk_user_email") !== false
            ) {
                $error = "Diese E-Mail-Adresse wird bereits verwendet!";
                echo $error;
            } elseif (strpos($dbresult["dbmessage"], "uk_user_username") !== false) {
                $error = "Dieser Benutzername wird bereits verwendet!";
                echo $error;
            }
        } else {
            echo "Registrieren!";

        }
        ?>

    </h3>
    <script>
        function Validatepw(input){

            var input = document.getElementById("passwordinput");
            var input = input;
            var password = input.value;
            input.className = "true";
            if (password == "") {
                input.className = "";
            } else if (!/[a-z]+/.test(password)) {
                input.className = "false";
            } else if (!/[A-Z]+/.test(password)) {
                input.className = "false";
            } else if (!/[0-9]+/.test(password)) {
                input.className = "false";
            }else if (password.length<=8) {
                input.className = "false";
            } else {
                input.className = "true";
            }

        }
    </script>
    <input type="hidden" name="form" value="createuser">
    <input type="text" name="username" placeholder="Benutzername" required>
    <input type="email" name="email" placeholder="E-Mail" required>
    <input type="password" class="" id="passwordinput" onkeyup="Validatepw(this)" name="pwd" placeholder="Passwort[a-z][A-Z][0-9]"
           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
           title="Dass Passwort benötigt min. 8 Zeichen und min. je ein Klein-, Grossbuchtaben und Zahl"
            required/>
    <br>
    <input class="button-primary" type="submit" value="Registrieren">
</form>
