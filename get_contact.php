<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 09/04/2018
 * Time: 14:09
 */

require_once("util.php");

if( $_GET["guid"] )
{
   // echo "ID: ". $_GET['guid']. "<br />";
   $contact = getContact( $_GET["guid"]);
}else{
    header('Guid invalid', true, 403);
    echo 'Guid is empty, please insert guid';
}

