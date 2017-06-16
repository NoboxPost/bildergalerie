<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 22.01.2017
 * Time: 11:37
 */


require_once($_SESSION["mypath"] . "\\model\\db.php");
require_once($_SESSION["mypath"] . "\\model\\dbconfig.php");


if (isset($_POST["createuser"]))
{
    $db = new db($servername, $dbusername, $dbpwd, $dbname, $port);
    $errorcreateuser = $db->createuser($_POST);
}
if (isset($_POST["login"]))
{
    $db = new db($servername, $dbusername, $dbpwd, $dbname, $port);
    $errorlogin = $db->login($_POST);
}


?>
<header>
    <a href="#signupform">SIGN UP</a>
    <div class="signupform" id="signupform">
        <form action="" method="post">
            <p>
                <?php
                if (isset($_SESSION["username"]) && empty($errorcreateuser))
                {
                    echo "Willkommen " . $_SESSION["username"];
                }
                elseif (isset($errorcreateuser))
                {
                    if (strpos($errorcreateuser, "uk_user_email") !== false)
                    {
                        echo "Diese E-Mail-Adresse wird bereits verwendet!";
                    }
                    elseif (strpos($errorcreateuser, "uk_user_username") !== false)
                    {
                        echo "Dieser Benutzername wird bereits verwendet!";
                    }

                }
                else
                {
                    echo "Registrieren!";
                }
                ?>
            </p>
            <input type="hidden" name="createuser" value="true">
            <input type="text" name="username" placeholder="Benutzername" required>
            <input type="email" name="email" placeholder="E-Mail" required>
            <input type="password" name="pwd" placeholder="Passwort" required>
            <input type="submit" value="Registrieren">
        </form>
        <form action="" method="post">
            <p>
                <?php
                if (isset($_SESSION["username"]))
                {
                    echo "Willkommen " . $_SESSION["username"];
                }
                elseif (isset($_SESSION["loginsuccess"])&&$_SESSION["loginsuccess"]==false)
                {
                    echo "Benutzername oder Passwort falsch";
                    session_destroy();
                }
                else
                {
                    echo "Login!";
                }
                ?>

            </p><br>
            <input type="hidden" name="login" value="true">
            <input type="text" name="username" placeholder="Benutzername" required>
            <input type="password" name="pwd" placeholder="Passwort" required>
            <input type="submit" value="Login">
        </form>
    </div>
    <form action="../../controller/logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</header>

