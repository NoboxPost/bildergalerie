<?php
/**
 * Created by PhpStorm.
 * User: Rino
 * Date: 22.01.2017
 * Time: 22:07
 */


$servername = "127.0.0.1";
$username = "root";
$password = "";
$datbasename = "nobox";
$port = "3307";
$conn = new mysqli("$servername", "$username", "$password", "$datbasename","$port");


if (!$conn)
{
    die("connection faildes: " . $conn->connect_error);
}

