<?php
/**
 * Created by PhpStorm.
 * User: Vanonir
 * Date: 26.01.2017
 * Time: 13:05
 */



require_once("../model/db.php");
require_once("../model/dbconfig.php");
require_once("../controller/sessionhandler.php");

db::configconn($servername, $dbusername, $dbpwd, $dbname);

if (isset($_POST["form"]))
{

    foreach ($_POST as $key => $value)
    {
        $_POST[$key]= htmlentities($value);
    }


    switch ($_POST["form"])
    {
        case "createuser":
        {
            $passwordvalid = true;

            if(isset($_POST["pwd"])){
                $pwd = $_POST["pwd"];
                if(preg_match('/[a-z]+/',$pwd)===0){
                    $passwordvalid = false;
                }elseif (preg_match('/[A-Z]+/',$pwd)===0){
                    $passwordvalid = false;
                }elseif (preg_match('/[0-9]+/',$pwd)===0){
                    $passwordvalid = false;
                }elseif (strlen($pwd)<=8){
                    $passwordvalid = false;
                }elseif ($passwordvalid){
                $dbresult = db::createuser($_POST);
                sessinonhandler::login($dbresult);
                }
            }
            break;

        }
        case "login":
        {
            $dbresult = db::login($_POST);
            sessinonhandler::login($dbresult);
            break;
        }
        case "logout":
        {

            sessinonhandler::logout();
            break;
        }
        case "createmaincollection";
        {
            $dbresult = db::createcollection($_POST,0);
            $_SESSION["actualboxid"] = $dbresult["newboxid"];
            break;
        }

        case "createimage";
        {
            $dbresult = db::createimage($_POST,$_FILES);
            $dbresult["test"]="test";

            var_dump($dbresult["debug"]);

            break;
        }

        case "createnote";
        {
            $dbresult = db::createnote($_POST);
            break;
        }
        case "updatecollection":{
            $dbresult = db::updatecollection($_POST);
            break;
        }
        case "deletecollection":{
            $dbresult = db::deletecollection($_POST);
            sessinonhandler::releaseboxid();

            break;
        }
        case "deleteimage":{
            db::deletetypecontent($_POST);
            break;
        }
    }
}