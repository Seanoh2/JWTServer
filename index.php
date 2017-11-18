<?php
require_once 'JWT_class.php';
$secret = "Peter's Key";
$api_key = filter_input(INPUT_GET, 'api_key');
$Service = filter_input(INPUT_GET, 'Service');

if($api_key == NULL) {
    // possible its going to request for key
    if($Service != "RequestKey") {
        $response = "Sorry incorrect format";
        echo json_encode($response);
        exit;
    }
}
switch ($Service) :
    
    case 'RequestKey' :
        $token = array();
        $token['username'] = filter_input(INPUT_GET, 'username');
        $token['memType'] = filter_input(INPUT_GET, 'memType');
        $jwt = JWT::encode($token, $secret);
        echo $jwt;
        break;
    
    case 'Service1' :
        //Check the api key.
        $api_key  = filter_input(INPUT_GET, 'api_key');
        try{
            $token = JWT::decode($api_key, $secret);
        } catch (ErrorException $ex) {
            return -1;
        }
        echo "This service is free to " . $token->username;
        
        break;
    
    case 'Service2' :
        //Check the api key.
        $api_key  = filter_input(INPUT_GET, 'api_key');
        try{
            $token = JWT::decode($api_key, $secret);
        } catch (ErrorException $ex) {
            return -1;
        }
        if($token->memType == "Paid") {
            echo "Thank you for buying our service " . $token->username . ".";
        } else {
            echo "Sorry, this service is only for paid members.";
        }
        break;
        
    default:
        echo "ERROR";
        break;
endswitch;