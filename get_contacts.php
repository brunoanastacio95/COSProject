<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 09/04/2018
 * Time: 12:13
 */
    require_once("util.php");

    try {
        $json_contacts = [];
        $url = 'http://contactsqs.apphb.com/Service.svc/rest/contacts';
        $response = callAPI('GET',$url, '');
        $json_contacts = json_decode($response, true);

        echo(json_encode($json_contacts));
    } catch (Exception $e) {
        header('Unauthorized', true, 401);
        echo 'Something went wrong';
    }

