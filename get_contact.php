<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 09/04/2018
 * Time: 14:09
 */

require_once("util.php");

if( $_GET["id"] )
{
    echo "ID: ". $_GET['id']. "<br />";
   
}else{
    header('Not found', true, 404);
    echo 'Not found';
}

