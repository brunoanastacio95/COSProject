<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 05/04/2018
 * Time: 13:43
 */
require_once("util.php");

try {
    getAllContacts();
} catch (Exception $e) {
    header('Unauthorized', true, 401);
    echo 'Something went wrong';
}