<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 05/04/2018
 * Time: 13:43
 */

    try {
    require_once("util.php");
    getAllContacts();
} catch (Exception $e) {
    header('Unauthorized', true, 401);
    echo 'Something went wrong';
}