<?php
require_once 'JWTClass.php';
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
    
    
endswitch;