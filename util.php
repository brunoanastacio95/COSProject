<?php
/**
 * Created by PhpStorm.
 * User: bruno
 * Date: 09/04/2018
 * Time: 10:54
 */

    function getInputParam($inputParamName, $default = null)
    {
        $input = file_get_contents('php://input');
        $post = json_decode($input, true);
        if (is_array($post)) {
            if (array_key_exists($inputParamName, $post)) {
                return $post[$inputParamName];
            }
        }
        return $default;
    }


    function getAllContacts(){
        try {
            $json_contacts = [];
            $url = 'http://contactsqs.apphb.com/Service.svc/rest/contacts';
            $response = callAPI('GET',$url, '');
            $json_contacts = json_decode($response, true);

          /* foreach($json_contacts as $contact)
            {
                echo $contact['Company']. "\n";
                echo $contact['City'];
            }
            */

            include 'index.html';
            return $json_contacts;
        } catch (Exception $e) {
            header('Unauthorized', true, 401);
            echo 'Something went wrong';
        }
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
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }
