<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 09/04/2018
 * Time: 10:54
 */

    function getAllContacts(){
        try {
            $url = 'http://contactsqs.apphb.com/Service.svc/rest/contacts';
            $response = callAPI('GET',$url, '');

            if($response['result'] == -1){
                $title = "Contacts not available";
                $error = "Error in access Rest Contacts API ";
                showErrorMessage($title, $error, 200);
                return;
            }

            $json_contacts = json_decode($response['result'], true);
            include 'contacts.html';
            return $json_contacts;
        } catch (Exception $e) {
            header('Unauthorized', true, 401);
            echo 'Something went wrong';
        }
    }

    function getContact($guid){
        try {
            $json_contact = null;
            $url = 'http://contactsqs.apphb.com/Service.svc/rest/contact/byguid/'.$guid;
            $response = callAPI('GET',$url, '');

            if($response['result'] == -1){
                $title = "Profile not exists!";
                $error = "Guid invalid, profile not exists!";
                showErrorMessage($title, $error, 200);
                return;
            }

            $json_contact = json_decode($response['result'], true);
            include 'show_contact.html';
            return $json_contact;
        } catch (Exception $e) {
            header('Unauthorized', true, 401);
            echo 'Something went wrong';
        }
    }

    function showErrorMessage($title, $error, $status_code){
        header('error page', true, $status_code);
        include 'error.html';
        return array ($title, $error);
    }

    function callAPI($method, $url, $data){
        $curl = curl_init();

        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        // EXECUTE:
        $result = curl_exec($curl);

        // verificar o status code
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($http_code != 200){
            $result = -1;
        }

        // se o resultado for vazio
        if(!$result){
            $result = -1;
        }
        curl_close($curl);

        $response['result'] = $result;
        $response['http_code'] = $http_code;
        return $response;
    }
