<?php

include './_access.php';

function getNewUserAccessToken(){
    /* Get oauth2 token using a POST request */
    $curlPostToken = curl_init();

    curl_setopt_array($curlPostToken, array(

    CURLOPT_URL => "https://login.windows.net/common/oauth2/token",

    CURLOPT_RETURNTRANSFER => true,

    CURLOPT_ENCODING => "",

    CURLOPT_MAXREDIRS => 10,

    CURLOPT_TIMEOUT => 30,

    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

    CURLOPT_CUSTOMREQUEST => "POST",

    CURLOPT_POSTFIELDS => array(

    grant_type => 'password',

    scope => 'openid',

    resource => 'https://analysis.windows.net/powerbi/api',

    client_id => global $access_client_id, // Registered App ApplicationID

    username => global $access_username, // for example john.doe@yourdomain.com

    password => global $access_password // Azure password for above user

    )


    ));


    $tokenResponse = curl_exec($curlPostToken);


    $tokenError = curl_error($curlPostToken);


    curl_close($curlPostToken);

    return $tokenResponse;

}

function decodeResultToken($tokenResponse){
    // decode result, and store the access_token in $embeddedToken variable:

    $tokenResult = json_decode($tokenResponse, true);

    $token = $tokenResult["access_token"];

    $embeddedToken = "Bearer "  . ' ' .  $token;

    return $embeddedToken;
}
?>