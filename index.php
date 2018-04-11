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
    echo ($e);
    $title = "Unauthorized";
    $error = "Something went wrong!";
    $status_code = "401";
    showErrorMessage($title, $error, $status_code);
    return;
}