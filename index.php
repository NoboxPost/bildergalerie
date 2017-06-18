<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 20.01.2017
 * Time: 18:36
 */




//KONFIGURATION

session_abort();
session_start();

require_once("./model/db.php");
require_once("./config.php");

if (!isset($_SESSION["started"]))
{
    $_SESSION["started"] = date ("d m H i s");
}


$url = explode("/", trim($_SERVER["REQUEST_URI"], "/"));

$_SESSION["request"] =$_SESSION["REQUEST_URI"];
$_SESSION["url"] = $url;

if ($url[$urlpartnumber] != "")
{

    switch ($url[$urlpartnumber])
    {
        case "index":
        {
            header("Location: " . $pathToRoot.  "/view/home.php");
            break;
        }
        case "home":
        {
            header("Location: " . $pathToRoot.  "/view/home.php");
            break;
        }
        case "collection": {

            $_SESSION["actualboxid"] = $url[$urlpartnumber+1];
            header("Location: $pathToRoot/view/home.php");
            break;
        }
        case "impressum":{
            header("Location: " . $pathToRoot.  "/view/impressum.php");
            break;
        }
        default:
        {
            header("Location: " . $pathToRoot.  "/view/home.php");
            break;
        }
    }
}


else
{

    header("Location: " . $pathToRoot.  "/view/home.php");

}

exit();