<?php
/**
 * Created by PhpStorm.
 * User: vanonir
 * Date: 27.01.2017
 * Time: 08:14
 */

echo "<br><br><hr> Session: ";
if (!empty($_SESSION))var_dump($_SESSION);

echo "<br> dbresult: ";
if (!empty($dbresult)) var_dump($dbresult);

echo "<br>Post: ";
if(!empty($_POST));