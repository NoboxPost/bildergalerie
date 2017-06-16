<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 25.01.2017
 * Time: 18:14
 */

?>
    <form action="" method="post" id='login' class='notclicked'>
        <a class="exitbutton" href='#javascript:void(0);' onclick='closepopup("login")'>
            <svg width="40" height="40">
                <g fill="none" stroke="#CCCCCC " stroke-width="4" stroke-linecap="round">
                    <path d="M7 7 L33 33"/>
                    <path d="M33 7 L7 33"/>
                </g>
            </svg>
        </a>

        <h3>
            <?php
            if (isset($_SESSION["loginsuccess"]) && $_SESSION["loginsuccess"]) {
                $error =  "Willkommen " . $_SESSION["username"];
                echo $error;
            } elseif (isset($_SESSION["loginsuccess"]) && !$_SESSION["loginsuccess"]) {
                $error = "Benutzername oder Passwort falsch";
                echo $error;
            } else {
                echo "Login!";
            }
            ?>
<!--TODO: colums von scelecton einfügen-->
        </h3><br>
        <input type="hidden" name="form" value="login">
        <input type="text" name="username" placeholder="Benutzername" required>
        <input type="password" name="pwd" placeholder="Passwort" required>
        <br>
        <input class="button-primary" type="submit" value="Login">
    </form>
<?php
