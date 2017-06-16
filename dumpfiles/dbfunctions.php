<?php

/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 22.01.2017
 * Time: 11:43
 */




function createuser($conn,$username, $email, $pwd)
{
   $conn->query("INSERT INTO USERS (Username,Emailaddress,Hash) VALUES ('$username','$email','$pwd') ");
   $_SESSION["username"]=$username;
   $_SESSION["id"]=$conn->insert_id;
    return $conn->error;
}
