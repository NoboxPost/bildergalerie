<?php

/**
 * Created by PhpStorm.
 * User: Vanonir
 * Date: 26.01.2017
 * Time: 14:43
 */
class sessinonhandler
{
    public static function login($dbresult)
    {
        if (isset($dbresult["id"])) $_SESSION["id"] = $dbresult["id"];
        if (isset($dbresult["username"])) $_SESSION["username"] = $dbresult["username"];
        if (isset($dbresult["loginsuccess"])) $_SESSION["loginsuccess"] = $dbresult["loginsuccess"];

//        TODO: Anpassung fèr fehlerausgabe bei registrierung nétig.
    }

    public static function logout()
    {
        $_SESSION["id"] = null;
        $_SESSION["username"] = null;
        session_destroy();
        session_start();
        header("Location: ../index.php");
    }

    public static function releaseboxid()
    {
        $_SESSION["actualboxid"]= null;
    }
}